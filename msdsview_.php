<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if ($_GET) {
    $id_msds = $_GET['code'];
    $sql = "SELECT * FROM msds WHERE id_msds='" . $_GET['code'] . "'";
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
    <title>MSDS DETAIL</title>
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
    $id_msds = mysqli_real_escape_string($conn, $_GET['code']);
    $sql = "SELECT * FROM msds WHERE id_msds='$id_msds' ";
    $query = mysqli_query($conn, $sql);
    $data  = mysqli_fetch_array($query);
    ?>
    <table width="100%" border="0">
        <tr>
            <td width="120">Nama MSDS</td>
            <td>: <?php echo $data['nama_msds']; ?></td>
        </tr>
        <tr>
            <td width="120">No MSDS</td>
            <td>: <?php echo $data['id_msds']; ?></td>
        </tr>

    </table>
    <embed type="application/pdf" src="pdf/msds/<?php echo $data['file']; ?>" width="100%" height="500"></embed>
    <hr>

    <hr>
    <td>
        <tr>
            <td width="120"><a href="msds.php">CLOSE</a></td>
        </tr>
    </td>
</body>

</html>