<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if ($_GET) {
    $id_dokumen = $_GET['code'];
    $sql = "SELECT * FROM std WHERE id_dokumen='" . $_GET['code'] . "'";
    $query = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($query);
} else {
    echo "ID Tidak Terbaca";
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dokumen Detail</title>
    <style type="text/css">
        body {
            font-family: verdana;
            position: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <hr>
    <?php
    $id_dokumen = mysqli_real_escape_string($conn, $_GET['code']);
    $sql = "SELECT * FROM std WHERE id_dokumen='$id_dokumen' ";
    $query = mysqli_query($conn, $sql);
    $data  = mysqli_fetch_array($query);
    ?>
    <table width="100%" border="0">
        <tr>
            <td width="120">Nama Dokumen</td>
            <td>: <?php echo $data['nama']; ?></td>
        </tr>
        <tr>
            <td width="120">No Dokumen</td>
            <td>: <?php echo $data['id_dokumen']; ?></td>
        </tr>

    </table>
    <embed type="application/pdf" src="pdf/std/<?php echo $data['file']; ?>" width="100%" height="500"></embed>
    <hr>

    <hr>
    <td>
        <tr>
            <td width="120"><a href="std.php">CLOSE</a></td>
        </tr>
    </td>
</body>

</html>