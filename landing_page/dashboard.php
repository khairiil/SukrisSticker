<?php
require './nodes/connection.php';
require './nodes/session-track.php';

// if ($role !== 'Admin') {
//     header("Location: index.php");  // gak perlu
//     exit();
// }

// error_reporting(E_ALL); // done, masalah di js, ke reload sebelum di POST
// ini_set('display_errors', 1);

// tambah
if (isset($_POST['add_sticker'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $file = $_FILES['image'];

    $file_name = basename($file['name']);
    $file_size = $file['size'];
    $temp_name = $file['tmp_name'];
    $upload_path = "stickers/" . $file_name;
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if ($file_size > 999999999) {
        echo "<script>alert('Error: Ukuran file terlalu besar.');</script>";
    } elseif (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Error: Ekstensi file tidak valid! Ekstensi valid: JPG, PNG, JPEG, WEBP, or SVG files.');</script>";
    } else {
        if (move_uploaded_file($temp_name, $upload_path)) {
            $stmt = $conn->prepare("INSERT INTO stickers (sticker_name, description, price, image_filename) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssds", $name, $description, $price, $file_name);
            if ($stmt->execute()) {
                echo "<script>alert('Stiker berhasil di tambah ke katalog!');</script>";
            } else {
                echo "<script>alert('Error: Insert gagal: " . $stmt->error . "');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error : ???.');</script>";
        }
    }
}

// update
if (isset($_POST['update_sticker'])) {
    $id = $_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $sql = "UPDATE stickers SET sticker_name = '$name', description = '$description', price = '$price' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Stiker berhasil di update!');</script>";
    } else {
        echo "<script>alert('Update gagal! Silahkan coba lagi.');</script>";
    }
}

// delete
if (isset($_POST['delete_sticker'])) {
    $id = $_POST['id'];
    $result = mysqli_query($conn, "SELECT image_filename FROM stickers WHERE id = '$id'");
    $sticker = mysqli_fetch_assoc($result);
    $image_path = "stickers/" . $sticker['image_filename'];
    $sql = "DELETE FROM stickers WHERE id = '$id'";
    if (mysqli_query($conn, $sql))
        unlink($image_path);
    echo "<script>alert('Sticker berhasil di hapus!');</script>";
} else {
    echo "<script>alert('Hapus gagal! Silahkan coba lagi.');</script>";
}

$transactions_result = mysqli_query($conn, "SELECT * FROM transaction ORDER BY created_at DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Sukri's Stickers</title>
    <link rel="icon" href="./assets/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body>
    <?php require './nodes/navbar.php'; ?>

    <div class="container">
        <div class="sidebar">
            <h2>Navigasi</h2>
            <br>
            <a href="#" data-action="add">Tambah Stiker</a>
            <a href="#" data-action="update">Update Stiker</a>
            <a href="#" data-action="delete">Hapus Stiker</a>
            <a href="#" data-action="transactions">Lihat Transaksi</a>
        </div>

        <div class="action">
            <h2>Admin Dashboard</h2>
            <p>Silahkan pilih opsi dari sidebar.</p>

            <!-- tambah -->
            <div class="addForm">
                <form id="addStickerForm" method="POST" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Nama Sticker" required><br>
                    <textarea name="description" placeholder="Deskripsi" required></textarea><br>
                    <input type="number" name="price" placeholder="Harga" required><br>
                    <input type="file" name="image" required><br>
                    <button type="submit" name="add_sticker">Tambah Stiker</button>
                </form>
            </div>

            <!-- update -->
            <div id="updateStickerSection" class="action-section">
                <h3>Update Sticker</h3>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM stickers");
                while ($sticker = mysqli_fetch_assoc($result)): ?>
                    <div class="sticker-card">
                        <img src="stickers/<?= htmlspecialchars($sticker['image_filename']) ?>" alt="<?= htmlspecialchars($sticker['sticker_name']) ?>">
                        <div class="sticker-info">
                            <h3><?= htmlspecialchars($sticker['sticker_name']) ?></h3>
                            <p><?= htmlspecialchars($sticker['description']) ?></p>
                            <p>Rp. <?= htmlspecialchars($sticker['price']) ?></p>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $sticker['id'] ?>">
                            <input type="text" name="name" value="<?= htmlspecialchars($sticker['sticker_name']) ?>">
                            <input type="text" name="description" value="<?= htmlspecialchars($sticker['description']) ?>">
                            <input type="number" name="price" value="<?= htmlspecialchars($sticker['price']) ?>">
                            <button type="submit" name="update_sticker">Update</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- delete -->
            <div id="deleteStickerSection" class="action-section">
                <h3>Hapus Sticker</h3>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM stickers");
                while ($sticker = mysqli_fetch_assoc($result)): ?>
                    <div class="sticker-card">
                        <img src="stickers/<?= htmlspecialchars($sticker['image_filename']) ?>" alt="<?= htmlspecialchars($sticker['sticker_name']) ?>">
                        <div class="sticker-info">
                            <h3><?= htmlspecialchars($sticker['sticker_name']) ?></h3>
                            <p><?= htmlspecialchars($sticker['description']) ?></p>
                            <p>Rp. <?= htmlspecialchars($sticker['price']) ?></p>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?= $sticker['id'] ?>">
                            <button type="submit" name="delete_sticker">Hapus</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>

            <div id="transactionsSection" class="action-section">
                <h3>Record Transaksi</h3>
                <?php if (mysqli_num_rows($transactions_result) > 0): ?>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Nama Stiker</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Metode Pembayaran</th>
                            <th>Tanggal</th>
                        </tr>
                        <?php while ($transaction = mysqli_fetch_assoc($transactions_result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['username']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['sticker_name']); ?></td>
                                <td>Rp. <?php echo htmlspecialchars($transaction['sticker_price']); ?></td>
                                <td>Rp. <?php echo htmlspecialchars($transaction['total_price']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['payment_method']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['created_at']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                <?php else: ?>
                    <p>Belum ada transaksi ...</p>
                <?php endif; ?>
            </div>


            <script src="./scripts/script.js"></script>
            <script src="./scripts/dashboard.js"></script>
</body>

</html>