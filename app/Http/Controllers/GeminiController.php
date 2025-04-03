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
                            ['text' => $responseData]
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

            if (!isset($result['candidates']) ||
                !is_array($result['candidates']) ||
                empty($result['candidates']) ||
                !isset($result['candidates'][0]['content']) ||
                !isset($result['candidates'][0]['content']['parts']) ||
                !isset($result['candidates'][0]['content']['parts'][0]['text'])) {

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
        if (strpos($message, 'khách sạn') !== false) {
            return $this->handleHotelRequest($message);
        } elseif (strpos($message, 'tour') !== false) {
            return $this->handleTourRequest($message);
        } else {
            return $message; // Nếu không khớp, gửi lại tin nhắn gốc
        }
    }

    private function handleHotelRequest($message)
    {
        $query = Hotel::with(['location', 'ratings'])->active();

        // Kiểm tra xem có yêu cầu tìm kiếm theo khoảng giá không
        if (preg_match('/giá từ (\d+) đến (\d+)/i', $message, $matches)) {
            $minPrice = $matches[1];
            $maxPrice = $matches[2];
            $query->whereBetween('h_price', [$minPrice, $maxPrice]);
        }
        else if(preg_match('/giá dưới (\d+)/i', $message, $matches)) {
            $maxPrice = $matches[1];
            $query->where('h_price', '<=', $maxPrice);
        }
        else if(preg_match('/giá trên (\d+)/i', $message, $matches)) {
            $minPrice = $matches[1];
            $query->where('h_price', '>=', $minPrice);
        }

        $hotels = $query->get();

        if ($hotels->isEmpty()) {
            return "Không tìm thấy khách sạn nào phù hợp.";
        }

        $formattedData = "";
        foreach ($hotels as $hotel) {
            $formattedData .= "Tên: " . $hotel->h_name . ", Địa chỉ: " . $hotel->h_address . ", Giá: " . $hotel->h_price . ", Phòng: " . $hotel->roomTypeName . ", Tiện nghi: " . implode(', ', $hotel->translatedFacilities) . ", Đánh giá trung bình: " . $hotel->averageRating . "/5, Số lượng đánh giá: " . $hotel->totalRatings . ", Vị trí: " . ($hotel->location ? $hotel->location->l_name : 'Không xác định') . "\n";
        }
        return $formattedData;
    }

    private function handleTourRequest($message)
    {
        $tours = Tour::with(['location', 'ratings'])->where('t_status', 1)->get(); // Lấy tour đã khởi tạo

        $formattedData = "";
        foreach ($tours as $tour) {
            $formattedData .= "Tên tour: " . $tour->t_title . ", Lịch trình: " . $tour->t_schedule . ", Giá người lớn: " . $tour->t_price_adults . ", Giá trẻ em: " . $tour->t_price_children . ", Đánh giá trung bình: " . $tour->averageRating . "/5, Số lượng đánh giá: " . $tour->totalRatings . ", Vị trí: " . ($tour->location ? $tour->location->l_name : 'Không xác định') . "\n";
        }
        return $formattedData;
    }

    public function chat(Request $request)
    {
        return $this->generateContent($request);
    }
}