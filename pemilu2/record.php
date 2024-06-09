<?php
require_once('config.php');
require_once('session.php');
check_login();

// Ambil data dari tabel hasil_suara
$sqlHasilSuara = "SELECT nim, id_tps, id_pemilu, id_kandidat FROM hasil_suara";
$resultHasilSuara = $conn->query($sqlHasilSuara);

// Hitung banyaknya suara untuk setiap kandidat
$countKandidat01 = $countKandidat02 = $countKandidat03 = 0;
while ($rowHasilSuara = $resultHasilSuara->fetch_assoc()) {
    if ($rowHasilSuara['id_kandidat'] == '01') {
        $countKandidat01++;
    } elseif ($rowHasilSuara['id_kandidat'] == '02') {
        $countKandidat02++;
    } elseif ($rowHasilSuara['id_kandidat'] == '03') {
        $countKandidat03++;
    }
}

// Hitung total suara
$totalSuara = $countKandidat01 + $countKandidat02 + $countKandidat03;

// Hitung presentase suara untuk setiap kandidat
$percentageKandidat01 = ($countKandidat01 / $totalSuara) * 100;
$percentageKandidat02 = ($countKandidat02 / $totalSuara) * 100;
$percentageKandidat03 = ($countKandidat03 / $totalSuara) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemilu - Record Pemilihan</title>
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
            background-position: top;
            font-family: 'Outfit', sans-serif;
            
        }
        .wrapper {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(50px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            color: #ffffff;
            border-radius: 10px;
            padding: 40px;
            margin: 20px;
            
        }

        .center {
            display: grid;
            place-items: center;
        }
        .wrapperBase {
            margin: 30px;
        }
        
        .wrapper2{
            background: white;
            width: 100vh;
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
            width: 100%;
            height: 50px;
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

        .table {
            border: 2px solid;
            font-weight: 500;
            margin-bottom: 20px;
            
        }
    </style>
</head>
<body>
    <div class="wrapperBase">
        <div class="wrapper">
            <div class="wrapper2 centers">
                <img class="logo" src="pic/logo.png" alt="Logo">
            </div>
            <h1>Record Pemilihan</h1>
        </div>
        <div class="wrapper">    
            <table class="table">
                <tr>
                    <th>NIM</th>
                    <th>ID TPS</th>
                    <th>ID Pemilu</th>
                    <th>ID Kandidat</th>
                </tr>
                <?php
                $resultHasilSuara = $conn->query($sqlHasilSuara);
                while ($rowHasilSuara = $resultHasilSuara->fetch_assoc()) {
                    // NIM disensor (contoh: hanya menampilkan 4 karakter pertama)
                    $nimSensored = substr($rowHasilSuara['nim'], 0, 4) . '****';

                    echo "<tr>
                            <td>{$nimSensored}</td>
                            <td>{$rowHasilSuara['id_tps']}</td>
                            <td>{$rowHasilSuara['id_pemilu']}</td>
                            <td>{$rowHasilSuara['id_kandidat']}</td>
                        </tr>";
                }
                ?>
            </table>
        
            <p>Banyaknya suara untuk setiap kandidat:</p>
            <ul>
                <li>ID Kandidat 01: <?php echo $countKandidat01; ?></li>
                <li>ID Kandidat 02: <?php echo $countKandidat02; ?></li>
                <li>ID Kandidat 03: <?php echo $countKandidat03; ?></li>
            </ul>

            <p>Presentase suara untuk setiap kandidat:</p>
            <ul>
                <li>ID Kandidat 01: <?php echo number_format($percentageKandidat01, 2); ?>%</li>
                <li>ID Kandidat 02: <?php echo number_format($percentageKandidat02, 2); ?>%</li>
                <li>ID Kandidat 03: <?php echo number_format($percentageKandidat03, 2); ?>%</li>
            </ul>

            <form action="index.php" method="get">
                <button type="submit" class="button2">Kembali Ke Dashboard</button>
            </form>
        </div>
    </div>
</body>
</html>
