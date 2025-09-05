<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}
$albuns = ['fotos', 'eventos', 'modelos', 'casais'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel do Dono</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Painel de Gerenciamento</h1>
    <a href="logout.php" class="logout-btn">Sair</a>
  </header>

  <section class="upload-section">
    <h2>Enviar Fotos</h2>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
      <label for="album">Escolha o Álbum:</label>
      <select name="album" required>
        <?php foreach ($albuns as $album): ?>
          <option value="<?php echo $album; ?>"><?php echo ucfirst($album); ?></option>
        <?php endforeach; ?>
      </select>
      <input type="file" name="fotos[]" multiple required>
      <button type="submit">Enviar</button>
    </form>
  </section>

  <section class="delete-section">
    <h2>Excluir Fotos</h2>
    <?php
    foreach ($albuns as $album) {
        echo "<h3>" . ucfirst($album) . "</h3>";
        $dir = "fotos/$album/";
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo "<div class='foto-item'>
                            <img src='$dir$file' alt='$file'>
                            <form action='delete.php' method='POST'>
                              <input type='hidden' name='album' value='$album'>
                              <input type='hidden' name='file' value='$file'>
                              <button type='submit'>Excluir</button>
                            </form>
                          </div>";
                }
            }
        }
    }
    ?>
  </section>
</body>
</html>
