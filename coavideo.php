<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");

if (isset($_GET['video'])) {
    $video = mysqli_real_escape_string($conn, $_GET['video']);

    // Query cari data berdasarkan nama video
    $sql = "SELECT * FROM coa WHERE video='$video' LIMIT 1";
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
    <h2><?php echo $data['nama_coa']; ?></h2>
    <video width="800" controls>
        <source src="video/std/<?php echo $data['video']; ?>" type="video/mp4">
        Browser tidak mendukung video tag.
    </video>
    <br><br>
    <a href="coa.php" class="btn btn-warning btn-xl">⬅ Kembali</a>
</body>

</html>