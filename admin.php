<?php
// Подключение к БД
$host = 'localhost';
$dbname = 'feedback_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT id, name, mail, message FROM data ORDER BY id DESC");
    $messages = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iTendyZz</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="icon" type="image/png" href="images/icons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="images/icons/favicon.svg" />
    <link rel="shortcut icon" href="images/icons/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/icons/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="iTendyZz" />
    <link rel="manifest" href="site.webmanifest" />
</head>
<body>
    <header>
        <a href="https://github.com/iTendyZz">iTendyZz</a>
    </header>
    <nav>
        <a href="index.html">Назад на сайт</a>
    </nav>

    <main>
        <div class="feedback-info">
            <?php if (empty($messages)): ?>
                <p>Нет сообщений</p>
            <?php else: ?>
                <?php foreach ($messages as $message): ?>
                    <div class="message">
                        <h3><?= htmlspecialchars($message['name']) ?></h3>
                        <p>Email: <?= htmlspecialchars($message['mail']) ?></p>
                        <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>