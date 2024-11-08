<?php
require './nodes/session-track.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sukri's Sticker | Beranda</title>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet" />
  <link rel="icon" href="./assets/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="./styles/landing-page.css" />
</head>

<body>

  <?php require './nodes/navbar.php'; ?>

  <div class="container fade">
    <div class="content">
      <div class="text-content">
        <!-- <span>Sukri's Stickers</span> -->
        <h1>Stickers Unik untuk Gaya Gen-Z</h1>

        <p>
          Kami tahu Gen-Z punya gaya unik dan selera yang berani. Itulah
          sebabnya Sukri's Sticker menawarkan berbagai pilihan stiker yang
          kekinian, dari yang lucu hingga edgy
        </p>

        <button class="cta-button" onclick="window.location.href='katalog-page.php'">Cari Stiker!</button>
      </div>

      <div class="image-container">
        <img src="./stickers/1-removebg.png" />
      </div>
    </div>
    <div class="trusted-by">
      <span>Trusted by |</span>
      <div class="trusted-by-icons-wrapper">
        <div class="trusted-by-icons">
          <i class="fab fa-whatsapp"> </i>
          <i class="fab fa-line"> </i>
          <i class="fab fa-twitter"> </i>
          <i class="fab fa-facebook"> </i>
          <i class="fab fa-instagram"> </i>
          <i class="fab fa-kickstarter-k"> </i>
        </div>
      </div>
    </div>
    <div class="most-popular">
      <h2>Terpopuler</h2>
      <div class="cards">
        <div class="card">
          <img src="./stickers/stiker-removebg.png" />
          <h3>Emot Batu</h3>
          <div class="description">
            <p>
            Ekspresi dingin tak bergeming! Stiker Emot Batu ini cocok untuk menunjukkan perasaan yang tidak terpengaruh dalam segala situasi. Pas buat kalian yang suka memberi respons 'cool' tanpa banyak bicara!
            </p>
          </div>
          <!-- <div class="harga">Rp 10.000</div> -->
        </div>
        <div class="card">
          <img src="./stickers/stiker2.jpg" />
          <h3>Gojo Pak Vinsen</h3>
          <div class="description">
            <p>
             Kombinasi unik antara karakter Gojo Satoru dan sosok Pak Vinsen ini menambah sentuhan misteri dengan aura kekuatan yang keren. Cocok buat para penggemar anime yang ingin tampil beda di dunia chat!
            </p>
          </div>
          <!-- <div class="harga">Rp 7.000</div> -->
        </div>
        <div class="card">
          <img src="./stickers/stiker3.jpg" />
          <h3>Coach Justin</h3>
          <div class="description">
            <p>
            Motivasi unik dari Coach Justin dengan gaya santai dan cuek. Stiker ini tepat untuk mengungkapkan respon sarkas atau hanya sekedar 'no kroco allowed!' ketika mengobrol dengan teman!
            </p>
          </div>
          <!-- <div class="harga">Rp 5.000</div> -->
        </div>
        <div class="see-more-card">
          <h3>Lihat lebih banyak</h3>
          <button
            onclick="window.location.href='./katalog-page.php'"
            class="cta-button">
            See More
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="footer appear">
    <div id="about" class="about-us-container appear">
      <div class="about-us-header">
        <h1>About Us</h1>
        <p>
          Hey, selamat datang di Sukri's Sticker! Kami di sini buat kamu yang
          mau tampil beda dengan stiker kece dan berkualitas. Ekspresikan
          dirimu dan temukan stiker yang bikin harimu lebih seru
        </p>
      </div>

      <div class="profiles">
        <div class="profile">
          <div class="profile-inner">
            <div class="profile-front">
              <img src="./profile/jee.jpg" alt="Foto Jahron" />
            </div>
            <div class="profile-back">
              <div class="name">Jahron</div>
              <div class="desc">"Admin IG Kelas"</div>
              <div class="nim">037</div>
            </div>
          </div>
        </div>
        <div class="profile">
          <div class="profile-inner">
            <div class="profile-front">
              <img src="./profile/farrel.jpg" alt="Foto Farrel" />
            </div>
            <div class="profile-back">
              <div class="name">Farrel</div>
              <div class="desc">"Aslab Aselole"</div>
              <div class="nim">032</div>
            </div>
          </div>
        </div>
        <div class="profile">
          <div class="profile-inner">
            <div class="profile-front">
              <img src="./profile/sukri.jpg" alt="Foto Sukri" />
            </div>
            <div class="profile-back">
              <div class="name">Sukri</div>
              <div class="desc">"Perkap Abadi"</div>
              <div class="nim">031</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="copyright">
    <p>&copy; 2023 Sukri's Stickers</p>
  </div>

  <script src="./scripts/script.js"></script>
</body>

</html>