<?php
include("sess_check.php");


// deskripsi halaman
$pagedesc = "WI";
include("layout_top.php");
include("dist/function/format_tanggal.php");
include("dist/function/format_rupiah.php");
?>
<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">PT. ELASTOMIX INDONESIA - WORK INSTRUCTIONS</h1>
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->

		<div class="row">
			<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a href="tambahwi.php" class="btn btn-success">Tambah</a>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" id="tabel-data">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="10%">No Dokumen</th>
									<th width="10%">Nama Dokumen</th>
									<th width="10%">Departemen</th>
									<th width="10%">Tahun Dokumen</th>
									<th width="10%">Keterangan</th>
									<th width="10%">Opsi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$sql = "SELECT * FROM wi ORDER BY id_dokumen ASC";
								$ress = mysqli_query($conn, $sql);
								while ($data = mysqli_fetch_array($ress)) {
									echo '<tr>';
									echo '<td class="text-center">' . $i . '</td>';
									echo '<td class="text-center">' . $data['id_dokumen'] . '</td>';
									echo '<td class="text-center">' . $data['nama'] . '</td>';
									echo '<td class="text-center">' . $data['departemen'] . '</td>';
									echo '<td class="text-center">' . $data['status'] . '</td>';
									echo '<td class="text-center">' . $data['keterangan'] . '</td>';
									echo '<td class="text-center"> <a href="wiview.php?id_dokumen='. $data['id_dokumen'].'" class="btn btn-primary btn-xs">Detail</a>';

									/*
												echo '<a href="video/' . $data['video'] .'" class="btn btn-warning btn-xs">Detail Video</a>';

										*/

									echo '<a href="wivideo.php?video=' . urlencode($data['video']) . '" class="btn btn-warning btn-xs">Lihat Video</a>';

									/*
												echo '<a href="grade_hapus.php?id_grade='. $data['id_grade'] .'" onclick="return confirm(\'Apakah anda yakin akan menghapus '. $data['nama'] .'?\');" class="btn btn-danger btn-xs">Hapus</a>';
												*/

									echo '</td>';
									echo '</tr>';
									$i++;
								}
								?>
							</tbody>
						</table>

					</div>
					<!-- Large modal -->
					<div class="modal fade bs-example-modal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-body">
									<p>One fine body…</p>
								</div>
							</div>

						</div>
					</div>
				</div><!-- /.panel -->
			</div><!-- /.col-lg-12 -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#tabel-data').DataTable({
			"responsive": true,
			"processing": true,
			"columnDefs": [{
				"orderable": false,
				"targets": [6]
			}]
		});

		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
<script>
	var app = {
		code: '0'
	};

	$('[data-load-code]').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if (code) {
			$($this.data('remote-target')).load('wiview.php?code=' + code);
			app.code = code;

		}
	});
</script>
<script>
	var app = {
		code: '0'
	};

	$('[data-load-video]').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var code = $this.data('load-code');
		if (code) {
			$($this.data('remote-target')).load('wiview.php?code=' + code);
			app.code = code;

		}
	});
</script>
<?php
include("layout_bottom.php");
?>