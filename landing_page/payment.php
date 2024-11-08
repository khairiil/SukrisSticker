<?php
require './nodes/session-track.php';
require './nodes/connection.php';

$username = $_SESSION['username'];
$cart_query = "
    SELECT s.sticker_name, s.price 
    FROM cart c 
    JOIN stickers s ON c.sticker_id = s.id 
    WHERE c.username = '$username'";
$cart_result = mysqli_query($conn, $cart_query);
$total_cost = 0;
$stickers = [];
while ($row = mysqli_fetch_assoc($cart_result)) {
    $stickers[] = $row;
    $total_cost += $row['price'];
}
if (isset($_POST['confirm_payment'])) {
    $payment_method = $_POST['payment_method'];
    $transaction_query = "INSERT INTO transaction (username, sticker_name, sticker_price, total_price, payment_method) VALUES ";
    foreach ($stickers as $sticker) {
        $transaction_query .= "('$username', '{$sticker['sticker_name']}', '{$sticker['price']}', '$total_cost', '$payment_method'),";
    }
    $transaction_query = rtrim($transaction_query, ',');
    mysqli_query($conn, $transaction_query);
    mysqli_query($conn, "DELETE FROM cart WHERE username = '$username'");
    echo "<script>alert('Payment successful!'); window.location.href='katalog-page.php';</script>";
}

if (isset($_POST['beli'])) {
    $sticker_name = $_POST['sticker_name'];
    $sticker_price = $_POST['sticker_price'];
    $stickers = [
        ['sticker_name' => $sticker_name, 'price' => $sticker_price]
    ];
    $total_cost = $sticker_price;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link rel="stylesheet" href="./styles/payment.css">
    <link rel="icon" href="./assets/logo.png" type="image/x-icon">
    <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet" />
</head>
<body>
    <?php include './nodes/navbar.php'; ?>
    <div class="payment-container">
        <h2>Konfirmasi Pembayaran</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
        <div class="payment-details">
            <table>
                <tr>
                    <th>Nama Sticker</th>
                    <th>Harga</th>
                </tr>
                <?php foreach ($stickers as $sticker): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sticker['sticker_name']); ?></td>
                        <td>Rp. <?php echo htmlspecialchars($sticker['price']); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td>Total:</td>
                    <td>Rp. <?php echo $total_cost; ?></td>
                </tr>
            </table>
        </div>
        <form method="POST" class="payment-form">
            <label for="payment_method">Metode Pembayaran:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="OVO">OVO</option>
                <option value="Dana">Dana</option>
                <option value="PayPal">PayPal</option>
            </select>
            <button type="submit" name="confirm_payment">Submit Payment</button>
        </form>
    </div>
    <div class="footer">
        <div class="about-us-container">
            <div class="about-us-header">
                <p>Explore the unique stickers to add style and fun to your life!</p>
                <div class="copyright">
                    <p>&copy; 2023 Sukri's Stickers</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
