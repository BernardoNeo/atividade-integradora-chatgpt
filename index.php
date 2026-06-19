<?php
require_once __DIR__ . '/src/ChatGPTService.php';

$service = new ChatGPTService();
$response = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $_POST["message"] ?? "";
    $response = $service->sendMessage($message);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Integradora Chat IA</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Chat com IA</h1>

    <form method="POST">
        <textarea name="message" placeholder="Digite sua pergunta..."></textarea>
        <button type="submit">Enviar</button>
    </form>

    <div class="response">
        <h3>Resposta:</h3>
        <p><?= htmlspecialchars($response) ?></p>
    </div>
</div>

</body>
</html>