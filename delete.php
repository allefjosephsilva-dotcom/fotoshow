<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['album']) && isset($_POST['file'])) {
    $album = $_POST['album'];
    $file = $_POST['file'];
    $file_path = "fotos/" . $album . "/" . $file;

    if (file_exists($file_path)) {
        unlink($file_path);
        echo "Foto excluída com sucesso! <a href='painel.php'>Voltar</a>";
    } else {
        echo "Erro: Arquivo não encontrado.";
    }
} else {
    echo "Erro: Dados inválidos.";
}
?>
