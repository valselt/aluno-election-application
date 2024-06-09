<?php
require_once('config.php');
require_once('session.php');
check_login();

$nim = $_SESSION['nim'];

// Tampilkan nama mahasiswa
$sqlNamaMahasiswa = "SELECT nama_mahasiswa FROM pemilih WHERE nim = '$nim'";
$resultNamaMahasiswa = $conn->query($sqlNamaMahasiswa);

if ($resultNamaMahasiswa->num_rows == 1) {
    $rowNamaMahasiswa = $resultNamaMahasiswa->fetch_assoc();
    $namaMahasiswa = $rowNamaMahasiswa['nama_mahasiswa'];
} else {
    $namaMahasiswa = "Undefined";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemilu - Hasil Pemilihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body{
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            margin: 0 auto;
            background: url('pic/bg_login.jpg') no-repeat;
            background-size: cover;
            font-family: 'Outfit', sans-serif;
            
        }

        @font-face {
            font-family: 'Outfit';
            src: url('font/Outfit.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .wrapper {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            border-radius: 10px;
            padding: 40px;
            
        }

        .wrapper2{
            background: white;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            padding: 20px;
            margin-bottom:30px;
            margin-top:20px;
            position: relative;
            width: 250px;
            height: 145px;

        }
        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        .button2 {
            width: 250px;
            height: 80px;
            background: #fff;
            color: #00007f;
            border: none;
            outline: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            transition-duration: 0.2s;
            margin-bottom: 20px;
            margin-top:30px;
        }

        .button2:hover{
            background-color: #00007f;
            color : #fff;

        }

        .inlineBlock {
            display: inline-block;  
            background-color: #00007f;
        }
        h2 {
            font-size: 40px;
            font-weight: bold;
        }
        h2:hover{
            background-color: #fff;
            color : #00007f;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="wrapper2">
            <img class="logo" src="pic/logo.png" alt="Logo">
        </div>
        <h1>Terimakasih telah melakukan pemilihan umum, </h1>
        <h2 class="inlineBlock"> <?php echo $namaMahasiswa; ?>! </h2>

        <form action="index.php" method="get">
            <button type="submit" class="button2">Kembali Ke Dashboard</button>
        </form>
    </div>
</body>
</html>
