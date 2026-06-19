<?php

class ChatGPTService
{
    private string $apiKey;
    private $httpClient;

    public function __construct($httpClient = null)
    {
        $this->apiKey = getenv('GEMINI_API_KEY');
        $this->httpClient = $httpClient;
    }

    public function sendMessage(string $message): string
    {
        if ($this->httpClient) {
            return $this->httpClient->send($message);
        }

        return "Resposta simulada para: " . $message;
    }
}