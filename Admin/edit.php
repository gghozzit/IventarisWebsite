<?php 
	$br = new lsp();
	if ($_SESSION['level'] != "admin") {
    header("location:../index.php");
  	}
	$table    = "table_barang";
	$data     = $br->selectWhere($table,"kode_barang",$_GET['id']);
	$getUnit = $br->select("unit");
	$getKond = $br->select("kondisi");
	$waktu    = date("Y-m-d");
	if (isset($_POST['getSimpan'])) {
		$kode_barang  = $br->validateHtml($_POST['kode_barang']);
        $nama_barang  = $br->validateHtml($_POST['nama_barang']);
        $unit_fakultas= $br->validateHtml($_POST['unit_fakultas']);
        $nilai        = $br->validateHtml($_POST['nilai_perolehan']);
        $pemakai      = $br->validateHtml($_POST['pemakai']);
        $lokasi       = $br->validateHtml($_POST['lokasi']);
        $kondisi      = $br->validateHtml($_POST['kondisi']);
        $catatan      = $br->validateHtml($_POST['catatan']);

        include_once("includes/koneksi.php");

        $update = mysqli_query($con,"UPDATE table_barang 
        SET kode_barang='$kode_barang',nama_barang='$nama_barang',
        unit_fakultas='$unit_fakultas',kondisi='$kondisi',nilai_perolehan='$nilai'
        ,pemakai='$pemakai',lokasi='$lokasi',catatan='$catatan' WHERE id=$_GET");
    }
 ?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
            	<div class="col-md-12">
            		<form method="post" enctype="multipart/form-data">
            			<div class="card">
            				<div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
	                            <div class="bg-overlay bg-overlay--blue"></div>
	                            <h3>
	                            <i class="zmdi zmdi-account-calendar"></i>Data Barang</h3>
                        	</div>
                        	<div class="card-body">
                        		<div class="col-12">
                        			<div class="row">
                        				<div class="col-md-6">
                        					<div class="form-group">
												<label for="">Kode barang</label>
												<input type="text" class="form-control" name="kode_barang" value="<?php echo $data['kode_barang']; ?>">
											</div>
											<div class="form-group">
												<label for="">Nama barang</label>
												<input type="text" class="form-control" name="nama_barang" value="<?php echo @$data['nama_barang'] ?>">
											</div>
											<div class="form-group">
												<label for="">Unit / Fakultas</label>
												<select name="unit_fakultas" class="form-control">
													<option value=" ">Pilih Unit / Fakultas</option>
													<?php foreach($getUnit as $mr) { ?>
													<?php if ($mr['unit_fakultas'] == $data['unit_fakultas']){ ?>
														<option value="<?= $mr['unit_fakultas'] ?>" selected><?= $mr['unit_fakultas'] ?></option>
													<?php }else{ ?>
													<option value="<?= $mr['unit_fakultas'] ?>"><?= $mr['unit_fakultas'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="form-group">
												<label for="">Kondisi</label>
												<select name="kondisi" class="form-control">
													<option value=" ">Pilih Kondisi</option>
													<?php foreach($getKond as $dr) { ?>
													<?php if ($dr['kondisi'] == $data['kondisi']){ ?>
													<option value="<?= $dr['kondisi_barang'] ?>" selected><?= $dr['kondisi_barang'] ?></option>
													<?php }else{ ?>
													<option value="<?= $dr['kondisi_barang'] ?>"><?= $dr['kondisi_barang'] ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Nilai Perolehan</label>
												<input type="number" class="form-control" name="nilai_perolehan" value="<?php echo $data['nilai_perolehan'] ?>">
											</div>
											<div class="form-group">
												<label for="">Pemakai</label>
												<input type="text" class="form-control" name="pemakai" value="<?php echo $data['pemakai'] ?>">
											</div>
											<div class="form-group">
												<label for="">lokasi</label>
												<input type="text" class="form-control" name="lokasi" value="<?php echo $data['lokasi'] ?>">
											</div>
											<div class="form-group">
												<label for="">catatan</label>
												<input type="text" class="form-control" name="catatan" value="<?php echo $data['catatan'] ?>">
											</div>
										</div>
                        			</div>
                        		</div>
                        	</div>
                        	<div class="card-footer">
                        		<button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Update</button>
                        		<a href="?page=viewBarang" class="btn btn-danger"><i class="fa fa-repeat"></i> Kembali</a>
                        	</div>
            			</div>
            		</form>
            	</div>
            </div>
        </div>
    </div>
</div>