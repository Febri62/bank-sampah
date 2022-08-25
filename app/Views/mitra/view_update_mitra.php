<?= $this->extend('home/main'); ?>

<?= $this->section('menu'); ?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="<?= base_url('/'); ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="nav-icon fas fa fa-th-list"></i>
            <p>
                Master
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview ">
            <?php if (session()->get('userLevel') == 0) { ?>
            <li class="nav-item">
                <a href="<?= base_url('administrator'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Administrator</p>
                </a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="<?= base_url('mitra'); ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mitra</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('nasabah'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nasabah</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('kategori'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Kategori</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa fa-file"></i>
            <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="<?= base_url('pegawai'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('tujuan'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Keluar</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa fa-th-list"></i>
            <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="<?= base_url('pegawai'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Master</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('tujuan'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Transaksi</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('profile'); ?>" class="nav-link">
            <i class="nav-icon far fa fa-user"></i>
            <p>
                Profile
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('logout'); ?>" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p>
                Logout
            </p>
        </a>
    </li>
</ul>

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
            
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Master</a></li>
                    <li class="breadcrumb-item active">Mitra</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="card">
    
        <?php if (session()->getFlashdata('success')) { ?>
        <div class="alert alert-success icons-alert m-2">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo session()->getFlashdata('success'); ?>
        </div>
        <?php } else if (session()->getFlashdata('failed')) { ?>
        <div class="alert alert-danger icons-alert m-2">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php echo session()->getFlashdata('failed'); ?>
        </div>
        <?php } ?>
        <div class="card-header">
            <h6> Form Edit Mitra</h6>
            
        </div>
        
<?php foreach ($mitra as $row) : ?>
<form action="<?= base_url('mitra/edit'); ?>" enctype="multipart/form-data" method="POST">
    <?= csrf_field(); ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email"
                                    class="form-control" readonly value="<?= $row['mitra_email']; ?>"
                                    placeholder="Masukan email" id="email" name="email" required autocomplete="off"
                                    autofocus>
                                <div class="invalid-feedback">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text"
                                    class="form-control" value="<?= $row['mitra_nama']; ?>"
                                    placeholder="Masukan nama" id="nama" name="nama" required autocomplete="off">
                                <div class="invalid-feedback">
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control" value="<?= $row['mitra_nohp']; ?>" onkeypress="return onlyNumber(event)"
                                    placeholder="Masukan nomor telepon" id="notelp" name="notelp" required
                                    autocomplete="off">
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Direktur</label>
                                <input type="text" class="form-control" value="<?= $row['mitra_direktur']; ?>" placeholder="Masukan pimpinan" id="direktur"
                                    name="direktur" required autocomplete="off">
                            </div>
                        </div>
                        <?php
                                        $db = db_connect();
                                        $query = $db->query("SELECT * FROM tb_kecamatan");
                                        $query1 = $db->query("SELECT * FROM tb_kota");
                                    ?>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Kota</label>
                                <select class="form-control" name="kota" id="kota" >
                                
                                    <option value="" selected disabled>Kota</option>
                                    
                                    <?php
                                        foreach ($query1->getResult() as $data) : ?>
                                            <option value="<?php echo $data->kota_id ?>"> <?php echo $data->kota_nama ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                            <label>Kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan">
                                
                                    <option value="" selected disabled>Kecamatan</option>
                                    
                                    <?php
                                        foreach ($query->getResult() as $data) : ?>
                                            <option value="<?php echo $data->kecamatan_id ?>"> <?php echo $data->kecamatan_nama ?></option>
                                    <?php endforeach; ?>
                                    
                                </select>

                                <!-- <input type="text" class="form-control" placeholder="Masukan Kecamatan" id="kecamatan" name="kecamatan" required autocomplete="off"> -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Alamat</label>
                                <input type="text" class="form-control" placeholder="Masukan Alamat" id="alamat"
                                    name="alamat" required autocomplete="off">
                                    <input type="hidden" class="form-control" id="join"
                                    name="join" required autocomplete="off" value="<?php echo date('Y-m-d') ?>">
                            </div>

                        </div>



                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" id="status" required
                                    class="form-control ">
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                                <div class="invalid-feedback">
                                   
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('mitra'); ?>" class="btn btn-secondary mt-2 mb-2"> Batal</a> 
                    <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
                                        <?php endforeach; ?>
<?= $this->endsection(); ?>

