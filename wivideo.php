<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");

if (isset($_GET['video'])) {
    $video = mysqli_real_escape_string($conn, $_GET['video']);

    // Query cari data berdasarkan nama video
    $sql = "SELECT * FROM wi WHERE video='$video' LIMIT 1";
    $query = mysqli_query($conn, $sql);
    $data  = mysqli_fetch_array($query);

    if (!$data) {
        echo "Video tidak ditemukan di database!";
        exit;
    }
} else {
    echo "Parameter video tidak ada!";
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $data['nama']; ?></title>
    <style>
        body {
            font-family: Verdana, sans-serif;
            text-align: center;
            background: #f4f4f4;
        }

        video {
            margin-top: 20px;
            border: 2px solid #333;
            border-radius: 8px;
        }

        .controls {
            margin-top: 20px;
        }

        .btn {
            margin: 5px;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Elastomix Media Info - <?php echo $pagedesc ?></title>
    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h2><?php echo $data['nama']; ?></h2>
    <video id="videoPlayer" width="800" controls>
        <source src="video/wi/<?php echo $data['video']; ?>" type="video/mp4">
        Browser tidak mendukung video tag.
    </video>

    <!-- Controls for speed and skipping -->
    <div class="controls">
        <button class="btn btn-primary" onclick="skipVideo(5)">Skip 10s Forward</button>
        <!-- <button class="btn btn-info" onclick="changeSpeed(2)">Speed 2x</button> -->
        <button class="btn btn-secondary" onclick="skipVideo(-5)">Skip 10s Backward</button>
    </div>

    <br><br>
    <a href="wi.php" class="btn btn-warning btn-xl">⬅ Kembali</a>

    <script>
        const videoPlayer = document.getElementById("videoPlayer");

        // Change video speeda
        function changeSpeed(speed) {
            videoPlayer.playbackRate = speed;
        }

        // Skip video forward or backward by a given number of seconds
        function skipVideo(seconds) {
            videoPlayer.currentTime += seconds;
        }
    </script>
</body>

</html>