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
                
                    <div class="col-lg-12">
                        <h1 class="page-header">Kneader Chart B-Line</h1>
                    </div><!-- /.col-lg-12 -->
               
				
				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-striped table-bordered table-hover" id="tabel-data">
									<thead>
										<tr>
											<th width="1%">No</th>
											<th width="10%">ID Grade</th>
											<th width="10%">Nama Grade</th>
											<th width="10%">Line</th>
											<th width="10%">Lot No</th>
											<th width="10%">Approved</th>
											<th width="10%">Opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$i = 1;
											$sql = "SELECT * FROM grade_b ORDER BY id_grade ASC";
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
													  <a href="viewb.php?id_grade='. $data['id_grade'].'" class="btn btn-primary btn-xs">Detail</a>';
													  
													  ?>
												<?php
													  echo '</td>';
												echo '</tr>';												
												$i++;
											}
										?>
									</tbody>
								</table>
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
						$($this.data('remote-target')).load('grade_view.php?code='+code);
						app.code = code;
						
					}
		});		
    </script>

<?php
	include("layout_bottom.php");
?>