<?php
require './nodes/connection.php';
require './nodes/session-track.php';

$username = $_SESSION['username']; 
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];
    $delete_query = "DELETE FROM cart WHERE username = '$username' AND sticker_id = '$remove_id'";
    mysqli_query($conn, $delete_query);
    echo "<script>alert('Sticker telah dihapus.');</script>";
}

$cart_query = "
    SELECT stickers.id, stickers.sticker_name, stickers.price, stickers.image_filename 
    FROM cart 
    JOIN stickers ON cart.sticker_id = stickers.id 
    WHERE cart.username = '$username'";
$cart_result = mysqli_query($conn, $cart_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | Sukri's Stickers</title>
    <link rel="stylesheet" href="./styles/katalog-page.css">
    <link rel="icon" href="./assets/logo.png" type="image/x-icon">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet" />
</head>
<body>
    <?php require './nodes/navbar.php'; ?>
    <div class="container">
        <h1>Keranjangmu, <?php echo" $username ";?></h1>
        <?php if (mysqli_num_rows($cart_result) > 0): ?>
            <div class="cards">
                <?php while ($item = mysqli_fetch_assoc($cart_result)): ?>
                    <div class="card">
                        <img src="./stickers/<?= htmlspecialchars($item['image_filename']) ?>" alt="Sticker Image">
                        <div class="card-name">
                            <h2><?= htmlspecialchars($item['sticker_name']) ?></h2>
                        </div>
                        <div class="card-price">
                            <p>Rp. <?= htmlspecialchars($item['price']) ?></p>
                        </div>
                        <a href="cart.php?remove_id=<?= $item['id'] ?>" class="remove-button">Hapus</a>
                    </div>
                <?php endwhile; ?>
            </div>
            <form action="payment.php" method="post">
                <button type="submit" class="proceed-to-payment">Pembayaran</button>
            </form>
        <?php else: ?>
            <p>Aishh masih kosong aja nich.</p>
        <?php endif; ?>
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
