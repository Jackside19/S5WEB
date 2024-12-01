<?php
  require_once('provider.php');
  $data = fetch();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CV.SLVPN</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navbar -->
  <header class="navbar">
    <div class="logo">SLVPNtrackindo</div>
    <nav>
      <ul>
        <li><a href="index.html">Beranda</a></li>
        <li><a href="#katalog">Katalog</a></li>
        <li><a href="#about">Tentang Kami</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <!-- Main Content -->
  <main>
    <!-- Hero Section -->
    <section id="home" class="hero">
      <h1></h1>
      <p></p>
    </section>
    <!-- Katalog Section -->
    <section id="katalog" class="katalog">
      <h2>Katalog Alat Berat</h2>
      <?php foreach ($data ['data'] as $value) {
      ?> 
      <div class="katalog-container">
        <div class="katalog-item">
          <img src="<?= $value['image_url'] ?>" alt="Excavator">
          <h3><?= $value['name'] ?></h3>
          <p><?= $value['description'] ?></p>
          <p> Price = <?= $value['price'] ?></p>
          <button onclick="sewa('Excavator')">Sewa Sekarang</button>
        </div>
      </div>
      <?php } ?>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
      <h2>Tentang Kami</h2>
      <p>SLVPNtrackindo telah melayani kebutuhan alat berat di Indonesia selama bertahun-tahun. Kami menawarkan layanan terbaik dan alat berat berkualitas tinggi.</p>
    </section>
  </main>

  <!-- Footer -->
  <footer>
    <div class="footer-content">
      <p>&copy; 2024 Petrokopindo. All Rights Reserved.</p>
      <p>Hubungi Kami: <a href="CV.SLVPN">info@SUVERTrackindo</a></p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
