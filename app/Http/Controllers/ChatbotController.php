<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        // 1. Lấy tin nhắn từ người dùng
        $userMessage = $request->input('message');
        
        // 2. Lấy API Key từ file .env
        $apiKey = env('GEMINI_API_KEY');

        if (!$apiKey) {
            return response()->json(['reply' => 'Lỗi: Chưa cấu hình API Key trong .env'], 500);
        }

        // 3. Cấu hình vai trò cho Bot (System Prompt)
        $systemPrompt = "Bạn là trợ lý ảo của FishShop - cửa hàng chuyên bán đồ câu cá. " .
                        "Hãy trả lời ngắn gọn, thân thiện bằng tiếng Việt. " .
                        "Chỉ tư vấn về cần câu, máy câu, mồi câu. " .
                        "Nếu khách hỏi chuyện khác, hãy lái khéo về chuyện đi câu.";

        // 4. Gọi Google Gemini API
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'role' => 'user',
                        'parts' => [
                            ['text' => $systemPrompt . "\n\nKhách hàng hỏi: " . $userMessage]
                        ]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $botReply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, cá to quá làm đứt dây mạng rồi!';
                return response()->json(['reply' => $botReply]);
            } else {
                // Log lỗi để debug nếu cần
                \Log::error('Gemini API Error: ' . $response->body());
                return response()->json(['reply' => 'Bot đang gỡ rối cước, vui lòng thử lại sau.'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['reply' => 'Lỗi kết nối server: ' . $e->getMessage()], 500);
        }
    }
}