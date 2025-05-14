<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class GeminiController extends Controller
{
    public function generateContent(Request $request)
    {
        try {
            if (!$request->has('message')) {
                return response()->json([
                    'success' => false,
                    'error' => 'Content parameter is required'
                ], 400);
            }

            $message = $request->input('message');
            $responseData = $this->processMessageAndGetData($message);

            $apiKey = Config::get('services.gemini.key');
            $model = Config::get('services.gemini.model');

            $requestData = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => <<<EOT
Bạn là trợ lý AI du lịch.

Yêu cầu của khách: "{$message}"

Dữ liệu phù hợp truy xuất từ hệ thống:

{$responseData}

👉 Hãy:
- Chỉ liệt kê đúng các khách sạn hoặc tour phù hợp với yêu cầu.
- Không giải thích thêm, không chào hỏi.
- Trình bày ngắn gọn, đúng trọng tâm, bằng tiếng Việt.

Không cần tư vấn mở rộng hoặc giới thiệu thêm nếu không được yêu cầu.
EOT
                            ]

                        ]
                    ]
                ]
            ];

            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $requestData);

            Log::info('Gemini API Response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                $errorMessage = json_decode($response->body(), true);
                Log::error('Gemini API error', [
                    'status' => $response->status(),
                    'error' => $errorMessage,
                    'request' => $requestData
                ]);

                return response()->json([
                    'success' => false,
                    'error' => isset($errorMessage['error']['message']) ? $errorMessage['error']['message'] : 'Unknown API error',
                    'raw_response' => $response->body(),
                    'status' => $response->status()
                ], $response->status());
            }

            $result = $response->json();

            Log::info('Parsed response', ['result' => $result]);

            if (
                !isset($result['candidates']) ||
                !is_array($result['candidates']) ||
                empty($result['candidates']) ||
                !isset($result['candidates'][0]['content']) ||
                !isset($result['candidates'][0]['content']['parts']) ||
                !isset($result['candidates'][0]['content']['parts'][0]['text'])
            ) {

                Log::error('Invalid response structure', ['result' => $result]);
                return response()->json([
                    'success' => false,
                    'error' => 'Invalid response structure from Gemini API',
                    'raw_response' => $result
                ], 500);
            }

            return response()->json([
                'success' => true,
                'response' => $result['candidates'][0]['content']['parts'][0]['text']
            ]);
        } catch (\Exception $e) {
            Log::error('Gemini controller error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Internal server error: ' . $e->getMessage()
            ], 500);
        }
    }

    private function processMessageAndGetData($message)
    {
        $promptPrefix = $this->getPromptPrefix($message);
        $data = '';

        if (strpos(strtolower($message), 'khách sạn') !== false) {
            $data = $this->handleHotelRequest($message);
        } elseif (strpos(strtolower($message), 'tour') !== false) {
            $data = $this->handleTourRequest($message);
        } else {
            return "Xin chào! Tôi có thể giúp bạn:\n" .
                "1. Tìm khách sạn (vd: 'tìm khách sạn giá dưới 500000')\n" .
                "2. Tìm tour du lịch (vd: 'có tour nào đi Huế không?')\n" .
                "3. Xem đánh giá (vd: 'đánh giá khách sạn ABC')\n" .
                "4. Kiểm tra giá (vd: 'giá khách sạn từ 500000 đến 1000000')\n" .
                "Bạn cần hỗ trợ gì?";
        }

        return $promptPrefix . $data;
    }

    private function getPromptPrefix($message)
    {
        $message = strtolower($message);

        if (strpos($message, 'giá') !== false) {
            return "Bạn đang tìm thông tin về giá. Dựa trên dữ liệu có sẵn:\n\n";
        }

        if (strpos($message, 'đánh giá') !== false) {
            return "Dựa trên đánh giá của khách hàng trước đây:\n\n";
        }

        if (strpos($message, 'khách sạn') !== false) {
            if (strpos($message, 'phòng') !== false) {
                return "Về thông tin phòng tại các khách sạn:\n\n";
            }
            if (strpos($message, 'tiện nghi') !== false) {
                return "Các tiện nghi có sẵn tại khách sạn:\n\n";
            }
            return "Thông tin chi tiết về khách sạn:\n\n";
        }

        if (strpos($message, 'tour') !== false) {
            if (strpos($message, 'lịch trình') !== false) {
                return "Chi tiết lịch trình tour du lịch:\n\n";
            }
            if (strpos($message, 'giá') !== false) {
                return "Bảng giá tour du lịch:\n\n";
            }
            return "Thông tin về các tour du lịch:\n\n";
        }

        return "Tôi là trợ lý du lịch, tôi có thể giúp bạn:\n\n";
    }

 private function handleHotelRequest($message)
{
    $query = Hotel::with(['location', 'ratings'])->active();

    $messageLower = strtolower($message);

    // 🔍 Lọc theo đánh giá cao
    if (strpos($messageLower, 'đánh giá cao') !== false) {
        $query->orderBy('average_rating', 'desc');
    }

    // 🔍 Lọc theo giá rẻ
    if (strpos($messageLower, 'giá rẻ') !== false) {
        $query->orderBy('h_price', 'asc');
    }

    // 💰 Lọc theo giá
    if (preg_match('/giá từ (\d+) đến (\d+)/i', $message, $matches)) {
        $query->whereBetween('h_price', [$matches[1], $matches[2]]);
    } elseif (preg_match('/giá dưới (\d+)/i', $message, $matches)) {
        $query->where('h_price', '<=', $matches[1]);
    } elseif (preg_match('/giá trên (\d+)/i', $message, $matches)) {
        $query->where('h_price', '>=', $matches[1]);
    }

    // ✅ Lọc theo tiện nghi (từ h_facilities) — như "wifi", "hồ bơi", "đưa đón"
    $facilities = ['wifi', 'hồ bơi', 'đưa đón', 'máy lạnh', 'bãi đậu xe', 'gym', 'nhà hàng'];
    foreach ($facilities as $facility) {
        if (strpos($messageLower, $facility) !== false) {
            $query->where('h_facilities', 'like', "%{$facility}%");
        }
    }

    $hotels = $query->limit(5)->get();

    if ($hotels->isEmpty()) {
        return "Rất tiếc, không tìm thấy khách sạn nào phù hợp với yêu cầu của bạn.";
    }

    $formattedData = "🏨 **Danh sách khách sạn phù hợp:**\n\n";

    foreach ($hotels as $hotel) {
        $facilitiesText = is_array($hotel->translatedFacilities ?? [])
            ? implode(', ', $hotel->translatedFacilities)
            : ($hotel->h_facilities ?? 'Không rõ');

        $hotelLink = url('/hotel/' . $hotel->id);

        $formattedData .= <<<EOT
---
🏨 {$hotel->h_name}  
📍 Địa chỉ: {$hotel->h_address}  
📞 Điện thoại: {$hotel->h_phone}  
💰 Giá: {number_format($hotel->h_price, 0, ',', '.')} VNĐ  
🛏️ Loại phòng: {$hotel->roomTypeName}  
🛠️ Tiện nghi: {$facilitiesText}  
👁️ Lượt xem: {$hotel->h_view}  
⭐ Đánh giá: {$hotel->averageRating}/5 ({$hotel->totalRatings} đánh giá)  
📸 Ảnh: [Xem ảnh]({$hotel->h_image})  

👉 [🛎️ **Đặt phòng ngay**]({$hotelLink})

EOT;
    }

    return $formattedData;
}

    private function handleTourRequest($message)
    {
        $query = Tour::with(['location', 'ratings'])->where('t_status', 1);

        // ✅ Lọc theo ngày khởi hành
        if (preg_match('/ngày (khởi hành|bắt đầu)?\s*(\d{1,2}\/\d{1,2}\/\d{4})/i', $message, $matches)) {
            $date = \DateTime::createFromFormat('d/m/Y', $matches[2]);
            if ($date) {
                $searchDate = $date->format('Y-m-d');
                $query->whereJsonContains('t_start_date', $searchDate);
            }
        }

        // ✅ Lọc theo thời lượng tour (VD: "3N2Đ")
        if (preg_match('/(\d+)N(\d+)Đ/i', $message, $matchesDuration)) {
            $duration = "{$matchesDuration[1]}N{$matchesDuration[2]}Đ";
            $query->where('t_schedule', 'like', "%{$duration}%");
        }

        // ✅ Lọc theo giá người lớn
        if (preg_match('/giá (người lớn )?(từ )?(\d+)[^\d]+(đến|tới)\s*(\d+)/i', $message, $m)) {
            $query->whereBetween('t_price_adults', [(int)$m[3], (int)$m[5]]);
        } elseif (preg_match('/giá (người lớn )?(dưới|không quá)\s*(\d+)/i', $message, $m)) {
            $query->where('t_price_adults', '<=', (int)$m[3]);
        } elseif (preg_match('/giá (người lớn )?(trên|từ)\s*(\d+)/i', $message, $m)) {
            $query->where('t_price_adults', '>=', (int)$m[3]);
        }

        // ✅ Lọc theo giá trẻ em
        if (preg_match('/giá (trẻ em )?(từ )?(\d+)[^\d]+(đến|tới)\s*(\d+)/i', $message, $m)) {
            $query->whereBetween('t_price_children', [(int)$m[3], (int)$m[5]]);
        } elseif (preg_match('/giá (trẻ em )?(dưới|không quá)\s*(\d+)/i', $message, $m)) {
            $query->where('t_price_children', '<=', (int)$m[3]);
        } elseif (preg_match('/giá (trẻ em )?(trên|từ)\s*(\d+)/i', $message, $m)) {
            $query->where('t_price_children', '>=', (int)$m[3]);
        }

        $tours = $query->limit(5)->get();

        if ($tours->isEmpty()) {
            if (isset($matches[2])) {
                return "Hiện tại chưa có tour nào khởi hành vào ngày {$matches[2]}.";
            }
            if (isset($duration)) {
                return "Hiện tại chưa có tour nào với lịch trình {$duration}.";
            }
            return "Hiện tại chưa có tour nào phù hợp với yêu cầu.";
        }

        $formattedData = "🧳 **Danh sách tour phù hợp:**\n\n";

        foreach ($tours as $tour) {
            $dates = is_string($tour->t_start_date) ? json_decode($tour->t_start_date, true) : [];
            $formattedDates = is_array($dates) ? implode(', ', $dates) : $tour->t_start_date;

            $note = strip_tags($tour->t_notes ?? 'Không có');
            $tourLink = url('/tour/' . $tour->id);

            $formattedData .= <<<EOT
---
🧭 {$tour->t_title}  
🛣️ Lịch trình: {$tour->t_schedule}  
📍 Nơi khởi hành: {$tour->t_starting_gate}  
🚗 Phương tiện: {$tour->t_move_method}  
🏨 Khách sạn: {$tour->t_hotel_star} sao  
📅 Ngày khởi hành: {$formattedDates}  
👥 Số khách: {$tour->t_number_guests}  
💰 Giá người lớn: {number_format($tour->t_price_adults, 0, ',', '.')} VNĐ  
👶 Giá trẻ em: {number_format($tour->t_price_children, 0, ',', '.')} VNĐ  
🔖 Ưu đãi: {$tour->t_sale}%  
⭐ Đánh giá: {$tour->averageRating}/5 ({$tour->totalRatings} đánh giá)  
👁️ Lượt xem: {$tour->t_view}  
📝 Ghi chú: {$note}  
👉 [🌟 **Đặt tour ngay**]({$tourLink})

EOT;
        }

        return $formattedData;
    }



    public function chat(Request $request)
    {
        return $this->generateContent($request);
    }
}
