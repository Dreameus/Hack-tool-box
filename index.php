<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HackToolBox</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzMCIgaGVpZ2h0PSIzMCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJ3aGl0ZSI+PHBhdGggZD0iTTIxIDE2djFhMiAyIDAgMCAxLTIgMkg1YTIgMiAwIDAgMS0yLTJWNWEyIDIgMCAwIDEgMi0yaDZ2NUg5djJoNlY1aDJ2Nmg0djFoLTJ2MmgydjFoLTR2Mmg0djFoLTR2Mmg0djFoLTR2Mmg0djFoLTR2Mmg0djFoLTJ6Ii8+PC9zdmc+" alt="Logo" width="30" height="30" class="d-inline-block align-text-top me-2">
                HackToolBox
            </a>
            <div class="d-flex">
                <span class="navbar-text me-3">Привет, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="btn btn-outline-light">Выйти</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row">
            <div class="col-lg-3">
                <div class="list-group">
                    <a href="#sqlmap" class="list-group-item list-group-item-action active" data-bs-toggle="tab">SQLMap</a>
                    <a href="#port-scanner" class="list-group-item list-group-item-action" data-bs-toggle="tab">Сканер портов (Nmap)</a>
                    <a href="#subdomain-scanner" class="list-group-item list-group-item-action" data-bs-toggle="tab">Сканер поддоменов (Sublist3r)</a>
                    <a href="#export-logs" class="list-group-item list-group-item-action" data-bs-toggle="tab">Экспорт логов</a>
                </div>
            </div>
            
            <div class="col-lg-9">
                <div class="tab-content">
                    <!-- SQLMap Tab -->
                    <div class="tab-pane fade show active" id="sqlmap">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">SQLMap - Инъекция SQL</h5>
                            </div>
                            <div class="card-body">
                                <form id="sqlmapForm">
                                    <div class="mb-3">
                                        <label for="targetUrl" class="form-label">Целевой URL</label>
                                        <input type="url" class="form-control" id="targetUrl" name="url" placeholder="http://example.com/page.php?id=1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Опции</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="options[]" value="--dbs" id="dbsOption">
                                            <label class="form-check-label" for="dbsOption">Показать базы данных</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="options[]" value="--tables" id="tablesOption">
                                            <label class="form-check-label" for="tablesOption">Показать таблицы</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="options[]" value="--dump" id="dumpOption">
                                            <label class="form-check-label" for="dumpOption">Экспортировать данные</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Запустить SQLMap</button>
                                </form>
                                <div id="sqlmapResults" class="mt-4"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Port Scanner Tab -->
                    <div class="tab-pane fade" id="port-scanner">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">Сканер портов (Nmap)</h5>
                            </div>
                            <div class="card-body">
                                <form id="portScannerForm">
                                    <div class="mb-3">
                                        <label for="targetHost" class="form-label">Целевой хост</label>
                                        <input type="text" class="form-control" id="targetHost" name="host" placeholder="example.com или IP-адрес" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="portRange" class="form-label">Диапазон портов (например: 1-1000)</label>
                                        <input type="text" class="form-control" id="portRange" name="ports" value="1-1000">
                                    </div>
                                    <button type="submit" class="btn btn-success">Запустить сканирование</button>
                                </form>
                                <div id="portScannerResults" class="mt-4"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Subdomain Scanner Tab -->
                    <div class="tab-pane fade" id="subdomain-scanner">
                        <div class="card">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">Сканер поддоменов (Sublist3r)</h5>
                            </div>
                            <div class="card-body">
                                <form id="subdomainScannerForm">
                                    <div class="mb-3">
                                        <label for="targetDomain" class="form-label">Домен</label>
                                        <input type="text" class="form-control" id="targetDomain" name="domain" placeholder="example.com" required>
                                    </div>
                                    <button type="submit" class="btn btn-info">Запустить сканирование</button>
                                </form>
                                <div id="subdomainScannerResults" class="mt-4"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Export Logs Tab -->
                    <div class="tab-pane fade" id="export-logs">
                        <div class="card">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0">Экспорт логов</h5>
                            </div>
                            <div class="card-body">
                                <p>Нажмите кнопку ниже, чтобы экспортировать все логи в ZIP-архив:</p>
                                <a href="export_logs.php" class="btn btn-warning">Экспортировать логи</a>
                                <div class="mt-4">
                                    <h6>Последние логи:</h6>
                                    <div class="list-group">
                                        <?php
                                        $logFiles = glob('logs/*.log');
                                        rsort($logFiles);
                                        $logFiles = array_slice($logFiles, 0, 5);
                                        foreach ($logFiles as $logFile) {
                                            echo '<a href="#" class="list-group-item list-group-item-action">' . basename($logFile) . '</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-3 mt-4">
        <div class="container text-center">
            <p class="mb-0">HackToolBox &copy; <?= date('Y') ?> - Инструменты для этичного хакинга</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
