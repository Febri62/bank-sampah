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
                <a href="<?= base_url('mitra'); ?>" class="nav-link">
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
            <li class="nav-item">
                <a href="<?= base_url('sampah'); ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sampah</p>
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
                <a href="<?= base_url('penjualan'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penjualan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('penarikan'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penarikan</p>
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
                <a href="<?= base_url('laporan'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Master</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('laporan-transaksi'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Transaksi</p>
                </a>
            </li>
        </ul>
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
                    <li class="breadcrumb-item active">Sampah</li>
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
            <h6>Tambah Sampah</h6>

        </div>


        <form action="<?= base_url('sampah/save'); ?>" enctype="multipart/form-data" method="POST">
            <?= csrf_field(); ?>
            <?php
                                        $db = db_connect();
                                        $query = $db->query("SELECT * FROM tb_kategori");
                                        $query1 = $db->query("SELECT * FROM tb_mitra");
                                    ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <label>Nama Sampah</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Sampah" id="nama" name="nama"
                                required>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label>Kategori</label>
                            <select class="form-control" name="kategori" id="kategori">
                                <option value="">== Pilih ==</option>
                                <?php
                                        foreach ($query->getResult() as $data) : ?>
                                <option value="<?php echo $data->kategori_id ?>"> <?php echo $data->kategori_nama ?>
                                </option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label>Satuan</label>
                            <input type="text" class="form-control " placeholder="Masukan Satuan" id="satuan"
                                name="satuan" required autocomplete="off">
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="text" class="form-control" onkeypress="return onlyNumber(event)"
                                placeholder="Masukan Harga" id="harga" name="harga" required
                                autocomplete="off">
                        </div>
                    </div>



                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label>Mitra</label>
                            <select class="form-control" name="mitra" id="mitra">
                                <option value="">== Pilih ==</option>
                                <?php
                                        foreach ($query1->getResult() as $data) : ?>
                                <option value="<?php echo $data->mitra_id ?>"> <?php echo $data->mitra_nama ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>



                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label>Deskripsi</label>

                            <textarea class="form-control mr-3" id="exampleFormControlTextarea1" rows="3"
                                placeholder="Deskripsi" name="deskripsi"></textarea>

                            <!-- <input type="text" class="form-control" placeholder="Masukan Kecamatan" id="kecamatan" name="kecamatan" required autocomplete="off"> -->
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                                    <label>Gambar</label>
                                    <input type="file" class="form-control" id="gambar" name="gambar" required autocomplete="off">
                                </div>

                    </div>



                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" id="status" required class="form-control ">
                                <option value="1">Active</option>
                                <option value="0">Non Active</option>
                            </select>
                            <input type="hidden" name="join" class="form-control">
                            <div class="invalid-feedback">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <a href="<?= base_url('sampah'); ?>" class="btn btn-secondary mt-2 mb-2"> Batal</a>
                <button type="submit" class="btn btn-primary mt-2 mb-2 mr-2">Simpan</button>
            </div>
    </div>
</div>
</div>
</form>

<?= $this->endsection(); ?>