<!DOCTYPE html>
<html>
<head>
    <title>Welcome!</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        h1, h2 { color: #333; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Hello from Nginx & PHP-FPM!</h1>
    <p>If you see this page, Nginx is correctly serving PHP files processed by PHP-FPM.</p>

    <h2>PHP Info</h2>
    <?php ?>

    <h2>MySQL Connection Test</h2>
    <?php
    $host = 'db'; 
    $port = '3306';
    $db   = getenv('MYSQL_DATABASE');
    $user = getenv('MYSQL_USER');
    $pass = getenv('MYSQL_PASSWORD');
    $dsn = "mysql:host={$host};port={$port};dbname={$db};charset=utf8mb4";

    try {
         $pdo = new PDO($dsn, $user, $pass);
         echo "<p class='success'>Successfully connected to the MySQL database '{$db}' as user '{$user}'!</p>";
    } catch (\PDOException $e) {
         echo "<p class='error'>Database Connection Failed: " . $e->getMessage() . "</p>";
         echo "<p><i>Check docker-compose logs (`docker-compose logs db`) and ensure the 'db' service is running and healthy. Also verify environment variables (MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD) are correctly set and passed.</i></p>";
    }
    ?>
</body>
</html>
