<?php

require_once __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . '/src/ChatGPTService.php';

$service = new ChatGPTService();
$response = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $_POST["message"] ?? "";
    $response = $service->sendMessage($message);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Chat IA - Gemini</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

    <div class="chat-box">

        <div class="header">
            🤖 Chat IA Gemini
        </div>

        <div class="messages">

            <?php if (!empty($response)): ?>
                <div class="message bot">
                    <?= htmlspecialchars($response) ?>
                </div>
            <?php endif; ?>

        </div>

        <form method="POST" class="input-area">
            <input type="text" name="message" placeholder="Digite sua mensagem..." required>
            <button type="submit">Enviar</button>
        </form>

    </div>

</div>

</body>
</html>