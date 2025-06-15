<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 403 Forbidden');
    exit('Доступ запрещен');
}

$host = escapeshellarg($_POST['host']);
$ports = !empty($_POST['ports']) ? '-p ' . escapeshellarg($_POST['ports']) : '';

$logFile = 'logs/nmap_' . date('YmdHis') . '.log';
$command = "nmap $ports $host 2>&1 | tee $logFile";

// Запуск команды и захват вывода
$output = shell_exec($command);

// Запись в лог
file_put_contents($logFile, "Команда: $command\n\nРезультат:\n$output", FILE_APPEND);

echo '<div class="alert alert-info">Выполнена команда: <code>' . htmlspecialchars($command) . '</code></div>';
echo '<pre class="bg-dark text-light p-3 rounded">' . htmlspecialchars($output) . '</pre>';
echo '<a href="' . $logFile . '" class="btn btn-sm btn-secondary mt-2" download>Скачать лог</a>';
?>
