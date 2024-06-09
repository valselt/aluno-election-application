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
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pemilu Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" type="text/css" href="style.css">
        <style>
            body {
            height: 100%
            }
            
            
            .bg {
            height: 100vh;
            background-image: url('pic/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100%;
            }

            .tengah {
            margin-right: 50px;
            margin-left: 50px;
            color: #FFFFFF;
            }

            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            }

            @font-face {
            font-family: 'Outfit';
            src: url('font/Outfit.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            } 

            header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 50px 10%;
            margin-bottom: 70px;
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
            font-family: 'Outfit', sans-serif;
            
            }


            .logo {
            cursor: pointer;
            order: 1;
            margin-right: auto;
            }

            nav {
            order: 3;
            color: #2b2b2b;
            overflow: hidden;
            border: 2px solid #2b2b2b; /* Add a 2px solid border around the nav element */
            border-radius: 5px; /* Optional: Add border-radius for rounded corners */
            }

            nav a {
                float: left;
                display: block;
                color: #2b2b2b;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                border: none;
                border-radius: 5px;
            }

            nav a:hover {
                background-color: #FFFFFF;
                color: black;
            }

            .buttonPlace {
                margin-top: 40px;
                display: flex;
                flex-direction: row;
                justify-content: start;
            }
            .button {
                background-color: rgba(255, 255, 255, 0.5);
                backdrop-filter: blur(20px);
                width: 300px;
                border: none;
                color: #00007f;
                padding: 70px;
                margin-right: 25px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 5px;
                cursor: pointer;
                box-shadow: 0 0 10px rgba(0,0,0,0.15);
                -webkit-transition-duration: 0.3s;
                transition-duration: 0.3s;
                -webkit-transition-property: box-shadow, transform;

            }
            .button:hover, .button:focus, .button:active {
                box-shadow: 0 0 20px rgba(0,0,0,0.5);
                -webkit-transform: scale(1.1);
                transform: scale(1.1);

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
        <div class="bg">
            <header>
                <a class="logo" href="/"><img src="pic/logo_small.png" alt="Logo"></a>
                <nav>
                    <a href="logout.php" style="float: right;">Logout</a>
                </nav>
            </header>
            
            <div class="tengah">
                <h2>Selamat datang, <?php echo $namaMahasiswa; ?>!</h2>
                <p>Ini adalah halaman dashboard Pemilu.</p>

                <!-- Tombol ke halaman pemilihan dan Record -->
                <div class="buttonPlace">
                    <form action="pemilihan.php" method="get">
                        <button class="button">
                            <div class="col">
                                <span class="material-symbols-outlined">
                                    person_add
                                </span>
                                <p>Pemilihan Kandidat</p>
                            </div>
                        </button>
                    </form>
                    <form  action="record.php" method="get">
                        <button class="button">
                            <div class="col">
                                <span class="material-symbols-outlined">
                                    preview
                                </span>
                                <p>Record Pemilu</p>
                            </div>
                        </button>
                    </form>
                </div>
                
                <!-- end for "tombol" -->

            </div>
            
            <script type="text/javascript" src="mobile.js"></script>
        </div>
    </body>
</html>