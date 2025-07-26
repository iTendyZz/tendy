<?php
header('Content-Type: application/json');

// Конфигурация БД
$host = 'localhost';
$dbname = 'feedback_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(['error' => 'Connection failed: ' . $e->getMessage()]));
}

// Получаем данные
$data = json_decode(file_get_contents('php://input'), true);

// Валидация
if (empty($data['name']) || empty($data['mail']) || empty($data['message'])) {
    http_response_code(400);
    die(json_encode(['error' => 'Все поля обязательны для заполнения']));
}

// Запись в БД
try {
    $stmt = $pdo->prepare("INSERT INTO data (name, mail, message) VALUES (:name, :mail, :message)");
    $stmt->execute([
        ':name' => htmlspecialchars($data['name']),
        ':mail' => htmlspecialchars($data['mail']),
        ':message' => htmlspecialchars($data['message'])
    ]);
    
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>