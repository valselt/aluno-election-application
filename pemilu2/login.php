<?php
require_once('config.php');
require_once('session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $namaMahasiswa = $_POST['nama_mahasiswa'];

    $sql = "SELECT * FROM pemilih WHERE nim = '$nim' AND nama_mahasiswa = '$namaMahasiswa'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['nim'] = $nim;
        header("Location: index.php");
        exit();
    } else {
        $error = "NIM atau nama mahasiswa salah.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pemilu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }
        
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('pic/bg_login.jpg') no-repeat;
            background-size: cover;
            background-position: center;

        }

        .wrapper {
            width: 420px;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #00007f;
            border-radius: 10px;
            padding: 30px 40px;

        }

        .wrapper h1{
            font-size: 36px;
            text-align: left;
            color: #ffffff;

        }

        
        .wrapper .input-box{
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
            

        }

        .input-box input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgba(255,255, 255, 0.2);
            border-radius: 25px;
            font-size: 16px;
            color :#fff;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder{
            color :#fff;
        } 

        .input-box span {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color :#fff;
        }

        .wrapper .loginButton{
            width: 100%;
            height: 45px;
            background: #fff;
            color: #00007f;
            border: none;
            outline: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 50px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
            transition-duration: 0.2s;
            
        }
        .wrapper .loginButton:hover{
            background-color: #00007f;
            color : #fff;

        }

        @font-face {
            font-family: 'Outfit';
            src: url('font/Outfit.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        

        .error {
            color: red;
        }

        .logo {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
      
        .material-symbols-outlined {
            font-variation-settings:
            'FILL' 1,
            'wght' 400,
            'GRAD' 0,
            'opsz' 24
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <form action="login.php" method="post">
            <img class="logo" src="pic/logo.png" alt="Logo">
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <h1>Login Pemilu</h1>
            <div class="input-box">
                <input type="text" placeholder="Nama Mahasiswa" name="nama_mahasiswa" oninvalid="this.setCustomValidity('Silahkan masukkan Nama Mahasiswa yang terdaftar!')" required>
                <span class="material-symbols-outlined">person</span>
            </div>
            <div class="input-box">
                <input type="text" placeholder="NIM" name="nim" oninvalid="this.setCustomValidity('Silahkan masukkan NIM Mahasiswa yang terdaftar!')" required>
                <span class="material-symbols-outlined">password</span>
            </div>
            <button type="submit" class="loginButton">Login</button>
        </form>
    </div>
</body>
</html>
