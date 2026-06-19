<?php

class ChatGPTService
{
    private string $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('GEMINI_API_KEY');
    }

    public function sendMessage(string $message): string
    {
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key={$this->apiKey}";

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
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        return $result['candidates'][0]['content']['parts'][0]['text']
            ?? 'Sem resposta da API';
    }
}