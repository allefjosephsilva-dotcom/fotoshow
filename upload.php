<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['album']) && isset($_FILES['fotos'])) {
    $album = $_POST['album'];
    $target_dir = "fotos/" . $album . "/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($_FILES['fotos']['name'][$key]);
        $target_file = $target_dir . $file_name;
        move_uploaded_file($tmp_name, $target_file);
    }

    echo "Fotos enviadas com sucesso! <a href='painel.php'>Voltar</a>";
} else {
    echo "Erro: Álbum ou fotos não selecionados.";
}
?>
