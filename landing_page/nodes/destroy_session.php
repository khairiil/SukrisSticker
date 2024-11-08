<?php
session_start();
session_unset();
session_destroy();
echo "
                <script>
                    alert('Berhasil logout!');
                    document.location.href = 'index.php';
                </script>
                ";
header("Location: ../index.php");
exit();
?>
