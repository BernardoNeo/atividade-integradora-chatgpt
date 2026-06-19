<?php

class ChatGPTService
{
    private string $apiKey;

   public function __construct()
{
    $this->apiKey = $_ENV['GEMINI_API_KEY'] ?? null;

    if (!$this->apiKey) {
        die("API KEY NÃO CARREGADA DO .env");
    }
}

    public function sendMessage(string $message): string
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$this->apiKey}";

        $data = [
            "contents" => [
                [
                    "parts" => [
                        ["text" => $message]
                    ]
                ]
            ]
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        if ($response === false) {
            return "Erro CURL: " . curl_error($ch);
        }

        curl_close($ch);

        $result = json_decode($response, true);

        return $result['candidates'][0]['content']['parts'][0]['text']
            ?? $response;
    }
}