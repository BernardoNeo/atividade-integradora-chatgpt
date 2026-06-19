<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/ChatGPTService.php';

class ChatGPTServiceTest extends TestCase
{
    public function testEnvioDeMensagem()
    {
        $service = new ChatGPTService();

        $result = $service->sendMessage("oi");

        // garante que retorna algo válido (string)
        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }

    public function testRecebimentoDeMensagem()
    {
        $service = new ChatGPTService();

        $result = $service->sendMessage("teste");

        // valida comportamento sem depender da API externa
        $this->assertIsString($result);
        $this->assertNotEmpty($result);
    }
}