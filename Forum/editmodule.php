<?php
include 'includes/DatabaseConnection.php';

if (isset($_POST['module_id'])) {
    $sql = 'UPDATE modules SET
        module_code = :module_code,
        module_name = :module_name
        WHERE module_id = :module_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':module_code', $_POST['module_code']);
    $stmt->bindValue(':module_name', $_POST['module_name']);
    $stmt->bindValue(':module_id', $_POST['module_id']);
    $stmt->execute();

    header('location: modules.php');
    exit();
}
else {
    if (!isset($_GET['id'])) {
        $title = 'Error';
        $output = 'No module ID was provided.';
    }
    else {
        $sql = 'SELECT module_id, module_code, module_name
                FROM modules
                WHERE module_id = :module_id';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':module_id', $_GET['id']);
        $stmt->execute();

        $module = $stmt->fetch();

        if (!$module) {
            $title = 'Error';
            $output = 'Module not found.';
        }
        else {
            $title = 'Edit Module';

            ob_start();
            include 'templates/editmodule.html.php';
            $output = ob_get_clean();
        }
    }
}

include 'templates/layout.html.php';