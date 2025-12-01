<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Data Grade";
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
                        <h1 class="page-header">Technical QCQA. Planning - STANDARD OPERATIONAL PROCEDURE</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<a href="qctambah.php" class="btn btn-success">Tambah</a>
							</div>
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">No Dokumen</th>
											<th width="10%">Nama Dokumen</th>
											<th width="10%">Revisi</th>
											<th width="10%">Terbit</th>
											<th width="10%">Status Dokumen</th>
											<th width="10%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT * FROM grade ORDER BY id_grade ASC";
											$ress = mysqli_query($conn, $sql);
											while($data = mysqli_fetch_array($ress)) {
												echo '<tr>';
												echo '<td class="text-center">'. $i .'</td>';
												echo '<td class="text-center">'. $data['id_grade'] .'</td>';
												echo '<td class="text-center">'. $data['nama'] .'</td>';
												echo '<td class="text-center">'. $data['line'] .'</td>';
												echo '<td class="text-center">'. $data['lot'] .'</td>';
												echo '<td class="text-center">'. $data['approved'] .'</td>';
												echo '<td class="text-center">
													  <a href="#myModal" data-toggle="modal" data-load-code="'.$data['id_grade'].'" data-remote-target="#myModal .modal-body" class="btn btn-primary btn-xs">Detail Pdf</a>
													  <a href=""?id_grade='. $data['id_grade'] .'" class="btn btn-warning btn-xs">Detail Video</a>';?>
													  <a href="grade_hapus.php?id_grade=<?php echo $data['id_grade'];?>" onclick="return confirm('Apakah anda yakin akan menghapus <?php echo $data['nama'];?>?');" class="btn btn-danger btn-xs">Hapus</a></td>
												<?php
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
			"columnDefs": [
				{ "orderable": false, "targets": [6] }
			]
		});
		
		$('#tabel-data').parent().addClass("table-responsive");
	});
</script>
	<script>
		var app = {
			code: '0'
		};
		
		$('[data-load-code]').on('click',function(e) {
					e.preventDefault();
					var $this = $(this);
					var code = $this.data('load-code');
					if(code) {
						$($this.data('remote-target')).load('viewqc.php?code='+code);
						app.code = code;
						
					}
		});		
    </script>
<?php
	include("layout_bottom.php");
?>