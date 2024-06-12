<?php 
    $br = new lsp();
    if ($_SESSION['level'] != "admin") {
    header("location:../index.php");
    }
    $table = "table_barang";    
    $getUnit = $br->select("unit");
    $getKond = $br->select("kondisi");
?>
<div class="main-content" style="margin-top: 20px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="card">
                        <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
                            <h3 style="color: #72777a;">
                            <i class="zmdi zmdi-account-calendar" style="color:#72777a"></i>Input Data Inventaris Barang Milik Negara</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="">Kode barang</label>
                                    <input type="number" class="form-control" name="kode_barang">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" class="form-control" name="nama_barang">
                                </div>
                                <div class="form-group">
                                    <label for="">Unit / Fakultas</label>
                                    <select name="unit_fakultas" class="form-control">
                                        <option value=" ">Pilih Unit / Fakultas</option>
                                        <?php foreach($getUnit as $mr) { ?>
                                        <option value="<?= $mr['unit_fakultas'] ?>"><?= $mr['unit_fakultas'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Kondisi</label>
                                    <select name="kondisi" class="form-control">
                                        <option value=" ">Pilih Kondisi</option>
                                        <?php foreach($getKond as $dr) { ?>
                                        <option value="<?= $dr['kondisi_barang'] ?>"><?= $dr['kondisi_barang'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <div class="form-group">
                                    <label for="">Nilai Perolehan</label>
                                    <input type="number" class="form-control" name="nilai_perolehan">
                                </div>
                                <div class="form-group">
                                    <label for="">Pemakai</label>
                                    <input type="text" class="form-control" name="pemakai">
                                </div>
                                <div class="form-group">
                                    <label for="">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi">
                                </div>
                                <div class="form-group">
                                    <label for="">catatan</label>
                                    <input type="text" class="form-control" name="catatan">
                                </div>
                                </div>
                            </div>
                        </div>

<?php

    if (isset($_POST['getSimpan'])) {
        $kode_barang  = $br->validateHtml($_POST['kode_barang']);
        $nama_barang  = $br->validateHtml($_POST['nama_barang']);
        $unit_fakultas= $br->validateHtml($_POST['unit_fakultas']);
        $kondisi      = $br->validateHtml($_POST['kondisi']);
        $nilai        = $br->validateHtml($_POST['nilai_perolehan']);
        $pemakai      = $br->validateHtml($_POST['pemakai']);
        $lokasi       = $br->validateHtml($_POST['lokasi']);
        $catatan      = $br->validateHtml($_POST['catatan']);

        $redirect = "?page=viewBarang";

        include_once("includes/koneksi.php");

            $input = mysqli_query($connect,"INSERT INTO table_barang(kode_barang,nama_barang,unit_fakultas,kondisi,nilai_perolehan,pemakai,lokasi,catatan) VALUES
            ('$kode_barang','$nama_barang','$unit_fakultas','$kondisi','$nilai','$pemakai','$lokasi','$catatan')");

            if($input){
                return ['response'=>'positive','alert'=>'Berhasil Menambahkan Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($connect);
                return ['response'=>'negative','alert'=>'Gagal Menambahkan Data'];
            }
    }
?>
                        <div class="card-footer">
                            <button name="getSimpan" class="btn btn-primary"><i class="fa fa-download"></i> Simpan</button>
                            <button type="reset" class="btn btn-danger"><i class="fa fa-eraser"></i> Reset</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>