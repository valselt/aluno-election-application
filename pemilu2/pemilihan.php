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

// Tampilkan kandidat
$sqlKandidat = "SELECT id_kandidat, nama_kandidat, visi, misi FROM kandidat";
$resultKandidat = $conn->query($sqlKandidat);

// Tampilkan TPS
$sqlTPS = "SELECT id_tps, tempat_tps FROM tps";
$resultTPS = $conn->query($sqlTPS);

// Tampilkan pemilu terakhir untuk menentukan nama pemilu berikutnya
$sqlLastPemilu = "SELECT MAX(id_pemilu) AS max_id_pemilu FROM pemilu";
$resultLastPemilu = $conn->query($sqlLastPemilu);

if ($resultLastPemilu->num_rows == 1) {
    $rowLastPemilu = $resultLastPemilu->fetch_assoc();
    $nextPemiluNumber = intval($rowLastPemilu['max_id_pemilu']) + 1;

} else {
    $nextPemiluNumber = 1;
}

$namaPemilu = "Pemilu" . $nextPemiluNumber;

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kandidat = $_POST['id_kandidat'];
    $id_tps = $_POST['id_tps'];
    $tgl_pemilu = $_POST['tgl_pemilu'];

    if (empty($id_kandidat) || empty($id_tps) || empty($tgl_pemilu)) {
        $error = "Anda belum mengisi salah satu dari beberapa requirement yang ada!";
    } else {
        // Generate unique IDs
        // Generate unique IDs
        $record_suara = bin2hex(random_bytes(8)); // 16 characters
        $id_pemilu = bin2hex(random_bytes(8)); // 16 characters

        // Insert into pemilu table
        $sqlInsertPemilu = "INSERT INTO pemilu (id_pemilu, nama_pemilu, tgl_pemilu, id_kandidat) VALUES ('$id_pemilu', '$namaPemilu', '$tgl_pemilu', '$id_kandidat')";
        $conn->query($sqlInsertPemilu);

        // Insert into hasil_suara table
        $sqlInsertHasilSuara = "INSERT INTO hasil_suara (record_suara, nim, id_tps, id_pemilu, id_kandidat) VALUES ('$record_suara', '$nim', '$id_tps', '$id_pemilu', '$id_kandidat')";
        $conn->query($sqlInsertHasilSuara);

        // Redirect to pemilihanHasil.php
        header("Location: pemilihanHasil.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Pemilihan</title>
    <style>
        :root {
  --clr-dark: #0f172a;
  --clr-light: #f1f5f9;
  --clr-accent: #e11d48;
        }

        *,
        *::before,
        *::after {
        box-sizing: border-box;
        font-family: 'Outfit', sans-serif;
        }

        @font-face {
            font-family: 'Outfit';
            src: url('font/Outfit.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        .row {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }



        body {
            
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        
            margin: 20px;
            padding: 15px;
            line-height: 1.6;
            word-spacing: 1.4px;

            background: url('pic/bg_login.jpg') no-repeat;
            background-size: cover;
            background-position: center;
            
        }

        .container {
            display: grid;
            width: 80%;
            margin: 0 auto;

            grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr;
            grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr;

            
        }

        .item-1 {
            grid-row: 1 / 2 ;
            grid-column: 1 / 4;
            width: 100vh;
        }

        .item-2 {
            grid-row: 2 / 3 ;
            grid-column:  1 / 2;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            border-radius: 10px;
            padding: 30px 40px;
            
            
        }

        .item-3 {
            grid-row: 2 / 3 ;
            grid-column:  2 / 3;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            border-radius: 10px;
            padding: 30px 40px;
            
            
        }

        .item-4 {
            grid-row: 2 / 3 ;
            grid-column:  3 / 4;
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            border-radius: 10px;
            padding: 30px 40px;
            
            
        }
        .item-5 {
            grid-row: 1 / 3 ;
            grid-column:  4 / 7;
            width: 100vh;
            height: 700px;
        }
        .item-6 {
            grid-row: 3 / 6 ;
            grid-column:  1 / 7;
            width: 20px;
        }

        .item {
            column-gap: 50px;
            margin:12px;
 
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
            margin-bottom:20px;
            position: relative;
            width: 250px;
            height: 145px;

        }

        .wrapper3 {
            display:grid;
            place-items: center;
            background: white;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
            padding: 20px;
            margin-bottom:20px;
            position: relative;
            width: 110px;


        }

        .button{
            width: 90px;
            height: 45px;
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
            margin-top: 30px;
            
        }

        .button:hover{
            background-color: #00007f;
            color : #fff;

        }

        .button2 {
            width: 150px;
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
            margin-top: 30px;
        }

        .button2:hover{
            background-color: #00007f;
            color : #fff;

        }

        .logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }

        .angkaPaslon {
            color: #00007f;
            font-size: 50px;

        }

        .namaPaslon {
            font-weight: 600;
        }

        .title {
            font-size: 80px;
            font-weight: bold;
        }

        select {
        appearance: none;
        /*  safari  */
        -webkit-appearance: none;
        /*  other styles for aesthetics */
        width: 100%;
        font-size: 1.15rem;
        padding: 0.675em 6em 0.675em 1em;
        background-color: #fff;
        border: 1px solid #caced1;
        border-radius: 15px;
        color: #000;
        cursor: pointer;
        }

        input {
            appearance: none;
        /*  safari  */
        -webkit-appearance: none;
        /*  other styles for aesthetics */
        width: 100%;
        font-size: 1.15rem;
        padding: 0.675em 6em 0.675em 1em;
        background-color: #fff;
        border: 1px solid #caced1;
        border-radius: 15px;
        color: #000;
        cursor: pointer;
        }

        p {
            font-size: 20px;
        }

        

        

    </style>
  </head>
  <body>
    <div class="container">
        
        <div class="item item-1">
            <div class="wrapper">
                <div class="row">
                    <div>
                        <div class="wrapper2">
                            <img class="logo" src="pic/logo.png" alt="Logo">
                        </div>
                    </div>
                    <div>
                        <h1 class="title">Selamat datang, <?php echo $namaMahasiswa; ?>!</h1>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $itemNumber = 2; // Nilai awal untuk item-X

            while ($rowKandidat = $resultKandidat->fetch_assoc()) {
                echo "<div class='item item-$itemNumber'>
                    <div class='wrapper3'><h1 class='angkaPaslon'>{$rowKandidat['id_kandidat']}</h1></div>
                    <h2 class='namaPaslon'>{$rowKandidat['nama_kandidat']}</h2></br>
                    <p>Visi: {$rowKandidat['visi']}</p>
                    <p>Misi: {$rowKandidat['misi']}</p>
                </div>";

            $itemNumber++; // Meningkatkan nilai untuk item-X setiap iterasi
            }
        ?>
        <div class="item item-5">
            <div class="wrapper">
                <form action="pemilihan.php" method="post">
                    <h2>Form Pemilihan:</h2>
                    <?php if (isset($error)) { ?>
                        <p style="color: red;"><?php echo $error; ?></p>
                    <?php } ?>

                    <label for="id_kandidat">Pilih Kandidat:</label>
                    <select name="id_kandidat" id="id_kandidat">
                        <?php
                        $resultKandidat = $conn->query($sqlKandidat);
                        while ($rowKandidat = $resultKandidat->fetch_assoc()) {
                            echo "<option value='{$rowKandidat['id_kandidat']}'>{$rowKandidat['id_kandidat']} - {$rowKandidat['nama_kandidat']}</option>";
                        }
                        ?>
                    </select>
                    <br />

                    <label for="id_tps">Pilih TPS:</label>
                    <select name="id_tps" id="id_tps">
                        <?php
                        $resultTPS = $conn->query($sqlTPS);
                        while ($rowTPS = $resultTPS->fetch_assoc()) {
                            echo "<option value='{$rowTPS['id_tps']}'>{$rowTPS['id_tps']} - {$rowTPS['tempat_tps']}</option>";
                        }
                        ?>
                    </select>
                    <br />

                    <label for="tgl_pemilu">Pilih Tanggal Pemilu:</label>
                    <input type="date" name="tgl_pemilu" id="tgl_pemilu" required>
                    <br />

                    <button type="submit" class="button">Submit</button>
                </form>
            </div>
        </div>
        <div class="item item-6">
            <form action="index.php" method="get">
                <button type="submit" class="button2">Kembali Ke Dashboard</button>
            </form>
        </div>
      
    </div>
</body>
</html>