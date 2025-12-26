 <?php
    include("sess_check.php");

    $id_coa         = $_POST['id_coa'];
    $nama_coa       = $_POST['nama_coa'];
    $departemen     = $_POST['departemen'];
    $status         = $_POST['status'];
    $keterangan     = $_POST['keterangan'];
    // $approved       = $_POST['approved'];

    $aktif = "Aktif";

    // ------ Fungsi tambah pdf ------
    $pdf_ext = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);
    $newpdf  = "pdf" . $id_coa . "." . $pdf_ext;

    // ------   Fungsi tambah video ------
    $video_ext = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
    $newvideo  = "video-" . $id_coa . "." . $video_ext;


    $sqlcek = "SELECT * FROM coa WHERE id_coa='$id_coa'";
    $resscek = mysqli_query($conn, $sqlcek);
    $rowscek = mysqli_num_rows($resscek);

    if ($rowscek < 1) {
        $sql = "INSERT INTO coa (id_coa,nama_coa,departemen,status,keterangan,  file,video,active)
            VALUES('$id_coa','$nama_coa','$departemen','$status','$keterangan', '$newpdf','$newvideo','$aktif')";
        $ress = mysqli_query($conn, $sql);

        if ($ress) {

            if ($_FILES["pdf"]["error"] == 0) {
                move_uploaded_file($_FILES["pdf"]["tmp_name"], "pdf/coa/" . $newpdf);
            }

            if ($_FILES["video"]["error"] == 0) {
                move_uploaded_file($_FILES["video"]["tmp_name"], "video/coa/" . $newvideo);
            }

            echo "<script>alert('Tambah Data Berhasil!');</script>";
            echo "<script type='text/javascript'> document.location = 'coa.php'; </script>";
        } else {
            echo ("Error description: " . mysqli_error($conn));
            echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
            echo "<script type='text/javascript'> document.location = 'coatambah.php'; </script>";
        }
    } else {
        header("location: coa.php?act=add&msg=double");
    }
    ?>