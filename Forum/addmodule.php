<?php
if (isset($_POST['module_code'])) {
    try {
        include 'includes/DatabaseConnection.php';

        $sql = 'INSERT INTO modules (module_code, module_name)
                VALUES (:module_code, :module_name)';

        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':module_code', $_POST['module_code']);
        $stmt->bindValue(':module_name', $_POST['module_name']);
        $stmt->execute();

        header('location: modules.php');
        exit();
    }
    catch (PDOException $e) {
        $title = 'An error has occurred';
        $output = 'Database error: ' . $e->getMessage();
    }
}
else {
    $title = 'Add module';

    ob_start();
    include 'templates/addmodule.html.php';
    $output = ob_get_clean();
}

include 'templates/layout.html.php';