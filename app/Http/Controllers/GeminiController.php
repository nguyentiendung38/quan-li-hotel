<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class GeminiController extends Controller
{
    public function generateContent(Request $request)
    {
        try {
            // Validate request
            if (!$request->has('message')) {
                return response()->json([
                    'success' => false,
                    'error' => 'Content parameter is required'
                ], 400);
            }

            $apiKey = Config::get('services.gemini.key');
            $model = Config::get('services.gemini.model');
            $contents = $request->input('message');

            $requestData = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $contents]
                        ]
                    ]
                ]
            ];

            $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

            // Debug log the request
            Log::info('Gemini API Request', [
                'model' => $model,
                'url' => $url,
                'api_key_length' => strlen($apiKey),
                'request_data' => $requestData
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($url, $requestData);

            // Log the raw response
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

            // Debug log the result
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

    public function testConnection()
    {
        try {
            Log::debug('Starting Gemini test connection...');

            $apiKey = Config::get('services.gemini.key');
            $model = Config::get('services.gemini.model');

            $requestData = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => 'Test message']
                        ]
                    ]
                ]
            ];

            Log::info('Sending test request to Gemini API', [
                'url' => "https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent",
                'request' => json_encode($requestData, JSON_PRETTY_PRINT)
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1/models/{$model}:generateContent?key={$apiKey}", $requestData);

            Log::info('Received Gemini API response', [
                'status' => $response->status(),
                'headers' => $response->headers(),
                'body' => $response->body()
            ]);

            if (!$response->successful()) {
                $errorMessage = json_decode($response->body(), true);
                Log::error('Gemini test failed', [
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

            return response()->json([
                'success' => true,
                'status' => $response->status(),
                'response' => $response->json(),
                'raw_response' => $response->body()
            ]);

        } catch (\Exception $e) {
            Log::error('Gemini test failed', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function chat(Request $request)
    {
        return $this->generateContent($request);
    }
}
