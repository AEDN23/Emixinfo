 <?php
    include("sess_check.php");

    $id_dokumen = $_POST['id_dokumen'];
    $nama       = $_POST['nama'];
    $departemen = $_POST['departemen'];
    $status     = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    // $approved = $_POST['approved'];

    $aktif = "Aktif";

    // ------ Fungsi tambah pdf ------
    $pdf_ext = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);
    $newpdf  = "pdf" . $id_dokumen . "." . $pdf_ext;

    // ------   Fungsi tambah video ------
    $video_ext = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
    $newvideo  = "video-" . $id_dokumen . "." . $video_ext;


    $sqlcek = "SELECT * FROM std WHERE id_dokumen='$id_dokumen'";
    $resscek = mysqli_query($conn, $sqlcek);
    $rowscek = mysqli_num_rows($resscek);

    if ($rowscek < 1) {
        $sql = "INSERT INTO std (id_dokumen,nama,departemen,status,keterangan,  file,video,active)
            VALUES('$id_dokumen','$nama','$departemen','$status','$keterangan', '$newpdf','$newvideo','$aktif')";
        $ress = mysqli_query($conn, $sql);

        if ($ress) {

            if ($_FILES["pdf"]["error"] == 0) {
                move_uploaded_file($_FILES["pdf"]["tmp_name"], "pdf/std/" . $newpdf);
            }

            if ($_FILES["video"]["error"] == 0) {
                move_uploaded_file($_FILES["video"]["tmp_name"], "video/std/" . $newvideo);
            }

            echo "<script>alert('Tambah Data Berhasil!');</script>";
            echo "<script type='text/javascript'> document.location = 'std.php'; </script>";
        } else {
            echo ("Error description: " . mysqli_error($conn));
            echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
            echo "<script type='text/javascript'> document.location = 'stdtambah.php'; </script>";
        }
    } else {
        header("location: std.php?act=add&msg=double");
    }
    ?>