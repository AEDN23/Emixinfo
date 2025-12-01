 <?php
    include("sess_check.php");

    $id_msds = $_POST['id_msds'];
    $nama_msds      = $_POST['nama_msds'];
    $departemen = $_POST['departemen'];
    $status     = $_POST['status'];
    $keterangan = $_POST['keterangan'];
    $approved = $_POST['approved'];

    $aktif = "Aktif";

    // ------ Fungsi tambah pdf ------
    $pdf_ext = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);
    $newpdf  = "pdf" . $id_msds . "." . $pdf_ext;

    // ------   Fungsi tambah video ------
    $video_ext = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
    $newvideo  = "video-" . $id_msds . "." . $video_ext;


    $sqlcek = "SELECT * FROM msds WHERE id_msds='$id_msds'";
    $resscek = mysqli_query($conn, $sqlcek);
    $rowscek = mysqli_num_rows($resscek);

    if ($rowscek < 1) {
        $sql = "INSERT INTO msds (id_msds,nama_msds,departemen,status,keterangan, approved, file,video,active)
            VALUES('$id_msds','$nama_msds','$departemen','$status','$keterangan','$approved', '$newpdf','$newvideo','$aktif')";
        $ress = mysqli_query($conn, $sql);

        if ($ress) {

            if ($_FILES["pdf"]["error"] == 0) {
                move_uploaded_file($_FILES["pdf"]["tmp_name"], "pdf/msds/" . $newpdf);
            }

            if ($_FILES["video"]["error"] == 0) {
                move_uploaded_file($_FILES["video"]["tmp_name"], "video/msds/" . $newvideo);
            }

            echo "<script>alert('Tambah Data Berhasil!');</script>";
            echo "<script type='text/javascript'> document.location = 'msds.php'; </script>";
        } else {
            echo ("Error description: " . mysqli_error($conn));
            echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
            echo "<script type='text/javascript'> document.location = 'msdstambah.php'; </script>";
        }
    } else {
        header("location: msds.php?act=add&msg=double");
    }
    ?>