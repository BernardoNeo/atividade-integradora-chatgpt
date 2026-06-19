<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/ChatGPTService.php';

class ChatGPTServiceTest extends TestCase
{
    public function testEnvioDeMensagem()
    {
        $mock = new class {
            public function send($message)
            {
                return "ok";
            }
        };

        $service = new ChatGPTService($mock);

        $result = $service->sendMessage("oi");

        $this->assertEquals("ok", $result);
    }

    public function testRecebimentoDeMensagem()
    {
        $service = new ChatGPTService();

        $result = $service->sendMessage("teste");

        $this->assertStringContainsString("teste", $result);
    }
}