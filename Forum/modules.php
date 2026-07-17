<?php
include 'includes/DatabaseConnection.php';

$title = 'Module List';

$sql = 'SELECT module_id, module_code, module_name FROM modules';
$result = $pdo->query($sql);

$modules = [];

foreach ($result as $row) {
    $modules[] = [
        'module_id' => $row['module_id'],
        'module_code' => $row['module_code'],
        'module_name' => $row['module_name']
    ];
}

ob_start();
include 'templates/modules.html.php';
$output = ob_get_clean();

include 'templates/layout.html.php';