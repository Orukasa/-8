<!DOCTYPE html>
<html>
<head>
    <title>Добро пожаловать!</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        h1, h2 { color: #333; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Привет от Nginx и PHP-FPM!</h1>
    <p>Если вы видите эту страницу, Nginx правильно отдает PHP-файлы, обработанные PHP-FPM.</p>

    <h2>PHP Info</h2>
    <?php ?>

    <h2>Тест соединения с MySQL</h2>
    <?php
    $host = 'db'; 
    $port = '3306';
    $db   = getenv('MYSQL_DATABASE');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

    try {
         $pdo = new PDO($dsn, $user, $pass);
         echo "<p class='success'>Успешное подключение к базе данных MySQL '{$db}' от имени пользователя '{$user}'!</p>";
    } catch (\PDOException $e) {
         echo "<p class='error'>Ошибка подключения к базе данных: " . $e->getMessage() . "</p>";
         echo "<p><i>Проверьте логи docker-compose (`docker-compose logs db`) и убедитесь, что сервис 'db' запущен и исправен. Также проверьте, что переменные окружения (MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD) установлены и переданы корректно.</i></p>";
    }
    ?>
</body>
</html>
