<?php
require './nodes/connection.php';
require './nodes/session-track.php';

$query = "SELECT 
            COALESCE(sticker_name, 'default sukri') AS name,
            COALESCE(description, 'default sukri') AS description,
            COALESCE(price, '0.00') AS harga,
            image_filename,
            id
          FROM stickers";

$result = mysqli_query($conn, $query);

$user = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sticker_id'])) {
    $sticker_id = $_POST['sticker_id'];
    $check_query = "SELECT * FROM cart WHERE username = '$user' AND sticker_id = '$sticker_id'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) == 0) {
        $insert_query = "INSERT INTO cart (username, sticker_id) VALUES ('$user', '$sticker_id')";
        mysqli_query($conn, $insert_query);
        $message = "Stiker ditambahkan ke keranjangmu, $user!";
        echo "
                <script>
                    alert('$message');
                </script>
                ";
    } else {
        echo "
                <script>
                    alert('$message');
                </script>
                ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Katalog Stiker | Sukri's Stickers</title>
    <link rel="stylesheet" href="./styles/katalog-page.css">
    <link rel="icon" href="./assets/logo.png" type="image/x-icon">
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet" />
</head>

<body>

    <?php require './nodes/navbar.php' ?>

    <div class="container">
        <h1>Katalog Stiker</h1>
        <p>Jelajahi koleksi stiker unik yang kekinian, dari yang lucu hingga edgy.</p>

        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Cari Stiker...">
            <i class="fas fa-search search-icon"></i>
        </div>

        <div id="gaada" style="display: none; color: #aaa; text-align: center;">
            Tidak ada sticker yang cocok.
        </div>

        <?php if (isset($message)): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <div class="cards">
            <?php while ($sticker = mysqli_fetch_assoc($result)): ?>
                <div class="card">
                    <img src="./stickers/<?= htmlspecialchars($sticker['image_filename']) ?>" alt="Sticker Image">
                    <div class="card-name">
                        <h2><?= htmlspecialchars($sticker['name']) ?></h2>
                    </div>
                    <div class="card-desc">
                        <p><?= htmlspecialchars($sticker['description']) ?></p>
                    </div>
                    <div class="card-price">
                        <p>Rp. <?= htmlspecialchars($sticker['harga']) ?></p>
                    </div>
                    <?php if (isset($user) && $user !== 'admin'):?>
                        <div class="card-icon">
                            <div class="container-sekarang">
                                <form action="payment.php" method="post">
                                    <input type="hidden" name="sticker_id" value="<?= $sticker['id'] ?>">
                                    <input type="hidden" name="sticker_name" value="<?= htmlspecialchars($sticker['name']) ?>">
                                    <input type="hidden" name="sticker_price" value="<?= htmlspecialchars($sticker['harga']) ?>">
                                    <button type="submit" class="sekarang" name="beli">Beli Sekarang!</button>
                                </form>
                            </div>
                            <div class="container-add">
                                <form action="katalog-page.php" method="post">
                                    <input type="hidden" name="sticker_id" value="<?= $sticker['id'] ?>">
                                    <button type="submit" class="cart" title="Add to Cart">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <div class="footer">
        <div class="about-us-container">
            <div class="about-us-header">
                <p>Explore the unique stickers to add style and fun to your life! ~ Sukri</p>
                <div class="copyright">
                    <p>&copy; 2023 Sukri's Stickers</p>
                </div>
            </div>
        </div>
    </div>

    <script src="./scripts/script.js"></script>
    <script src="./scripts/katalog-page.js"></script>
</body>

</html>