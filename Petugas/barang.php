<?php 
    $qb = new lsp();
    $dataB = $qb->select("table_barang");
    if ($_SESSION['level'] != "petugas") {
    header("location:index.php");
    }
    if (isset($_GET['delete'])) {
        $response = $qb->delete("table_barang","kode_barang",$_GET['id'],"?page=viewBarang");
    }
 ?>
<section class="au-breadcrumb m-t-75">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="au-breadcrumb-content">
                       <div class="au-breadcrumb-left">
                            <ul class="list-unstyled list-inline au-breadcrumb__list">
                                <li class="list-inline-item active">
                                    <a href="#">Home</a>
                                </li>
                                <li class="list-inline-item seprate">
                                    <span>/</span>
                                </li>
                                <li class="list-inline-item">Tambah Inventaris</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-content" style="margin-top: -60px;">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="au-card-title">                            
                            <h3 style="color:#72777a;">
                            <i class="zmdi zmdi-account-calendar" style="color:#72777a;"></i>Tambah Data Inventaris Barang Milik Negara</h3>
                        </div>
                        <div class="card-body">
                            <a href="?page=addBarang" class="btn btn-primary"><i class="fa fa-plus"></i> Input Inventaris Baru</a>
                           </button>
                           <br>
                           <br>
                           <div class="table-responsive">
                               <table id="example" class="table table-borderless table-striped table-earning">
                                    <thead>
                                        <tr>
                                            <th>Kode barang</th>
                                            <th>Nama barang</th>
                                            <th>Unit/Fakultas</th>
                                            <th>Nilai Perolehan</th>
                                            <th>Lokasi</th>
                                            <th>Pemakai</th>
                                            <th>Kondisi</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($dataB as $ds) { 
                                         ?>
                                        <tr>
                                            <td><?= $ds['kode_barang'] ?></td>
                                            <td><?= $ds['nama_barang'] ?></td>
                                            <td><?= $ds['unit_fakultas'] ?></td>
                                            <td><?= number_format($ds['nilai_perolehan']) ?></td>
                                            <td><?= $ds['lokasi'] ?></td>
                                            <td><?= $ds['pemakai'] ?></td>
                                            <td><?= $ds['kondisi'] ?></td>
                                            <td><?= $ds['catatan'] ?></td>
                                        </tr>
                                        <script src="vendor/jquery-3.2.1.min.js"></script>
                                        <?php $no++; } ?>
                                    </tbody>
                               </table>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
