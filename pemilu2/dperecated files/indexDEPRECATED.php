<?php
require_once('config.php');
require_once('session.php');
check_login();

$nim = $_SESSION['nim'];

$sql = "SELECT nama_mahasiswa FROM pemilih WHERE nim = '$nim'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $namaMahasiswa = $row['nama_mahasiswa'];
} else {
    $namaMahasiswa = "Undefined";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemilu Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0; /* Menghilangkan margin body default */
        }

        nav {
            background-color: #333;
            overflow: hidden;
        }

        nav a {
            float: left; /* Mengatur tautan di sisi kiri */
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
        }

        header {
            background-color: #4CAF50;
            padding: 10px;
            text-align: center;
        }

        header img {
            max-width: 100px;
            height: auto;
        }

        header h1 {
            color: white;
            margin: 0;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav>
        <a href="logout.php" style="float: right;">Logout</a>
    </nav>

    <header>
        <img src="pic/logo.png" alt="Logo">
    </header>

    <div class="content">
        <h2>Selamat datang, <?php echo $_SESSION['nim']; ?>!</h2>
        <p>Ini adalah halaman dashboard Pemilu.</p>
    </div>
</body>
</html>
