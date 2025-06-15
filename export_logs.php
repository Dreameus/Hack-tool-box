<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('HTTP/1.1 403 Forbidden');
    exit('Доступ запрещен');
}

$zipFile = 'logs/hacktoolbox_logs_' . date('YmdHis') . '.zip';
$logFiles = glob('logs/*.log');

if (count($logFiles) > 0) {
    $zip = new ZipArchive();
    if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE) {
        foreach ($logFiles as $logFile) {
            $zip->addFile($logFile, basename($logFile));
        }
        $zip->close();
        
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($zipFile) . '"');
        header('Content-Length: ' . filesize($zipFile));
        readfile($zipFile);
        unlink($zipFile); // Удалить временный файл
        exit();
    } else {
        die('Не удалось создать ZIP-архив');
    }
} else {
    die('Логи не найдены');
}
?>
