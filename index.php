<?php
$albuns = ['fotos', 'eventos', 'modelos', 'casais'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galeria de Fotos</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Galeria de Fotos</h1>
    <nav>
      <?php foreach ($albuns as $album): ?>
        <a href="?album=<?php echo $album; ?>"><?php echo ucfirst($album); ?></a>
      <?php endforeach; ?>
    </nav>
  </header>

  <main class="galeria">
    <?php
      $album = isset($_GET['album']) ? $_GET['album'] : 'fotos';
      $dir = "fotos/$album/";
      if (is_dir($dir)) {
          $files = scandir($dir);
          foreach ($files as $file) {
              if ($file != '.' && $file != '..') {
                  echo "<div class='foto'><img src='$dir$file' alt='$file'></div>";
              }
          }
      } else {
          echo "<p>Álbum não encontrado.</p>";
      }
    ?>
  </main>

  <script src="js/script.js"></script>
</body>
</html>
