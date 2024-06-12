<?php 
	$dt = new lsp();
	$detail = $dt->selectWhere("table_barang","kode_barang",$_GET['id']);
    if ($_SESSION['level'] != "admin") {
    header("location:../index.php");
    }
 ?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-8">
            		<div class="card">
            			<div class="card-header">
            				<h3>Detail Barang</h3>
            			</div>
            			<div class="card-body">
            				<table class="table" cellpadding="10">
	    					<tr>
	    						<td>Kode Barang</td>
	    						<td>:</td>
	    						<td style="font-weight: bold; color: green;"><?php echo $detail['kode_barang']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Nama Barang</td>
	    						<td>:</td>
	    						<td><?php echo $detail['nama_barang']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Unit / Fakultas</td>
	    						<td>:</td>
	    						<td><?php echo $detail['unit_fakultas']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Nilai Perolehan</td>
	    						<td>:</td>
	    						<td><?php echo "Rp.".number_format($detail['nilai_perolehan'])."-,"; ?></td>
	    					</tr>
	    					<tr>
	    						<td>Pemakai</td>
	    						<td>:</td>
	    						<td><?php echo $detail['pemakai']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>lokasi</td>
	    						<td>:</td>
	    						<td><?php echo $detail['lokasi']; ?></td>
	    					</tr>
	    					<tr>
	    						<td>kondisi</td>
	    						<td>:</td>
	    						<td><?php echo $detail['kondisi'] ?></td>
	    					</tr>
	    					<tr>
	    						<td>Catatan</td>
	    						<td>:</td>
	    						<td><?php echo $detail['catatan'] ?></td>
	    					</tr>
	    				</table>
            			</div>
            		</div>
            	</div>
            </div>
            <a href="?page=viewBarang" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
        </div>
    </div>
</div>