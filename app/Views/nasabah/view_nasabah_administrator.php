<?= $this->extend('home/main'); ?>

<?= $this->section('menu'); ?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="<?= base_url('admin'); ?>" class="nav-link">
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
                <a href="<?= base_url('nasabah'); ?>" class="nav-link active">
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
                <a href="<?= base_url('sampah'); ?>" class="nav-link">
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
                    <li class="breadcrumb-item active">Nasabah</li>
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
            <a href="<?= base_url('tambah-data-nasabah');?>" class="btn btn-sm btn-success"><i
                    class="fa fa-plus mr-2"></i> Data Baru</a>
            <a href="<?= base_url('nasabah/report'); ?>" target="__blank" class="btn btn-sm btn-info"><i
                    class="fa fa-print mr-2"></i> Cetak</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>No. Hp</th>
                        <th>Bank Sampah</th>
                        <th>Saldo Nasabah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($nasabah as $row) : $no++ ?>
                    <tr>
                        <td> <?= $row['nasabah_email']; ?></td>
                        <td> <?= $row['nasabah_nama']; ?></td>
                        <td> <?= $row['nasabah_nohp']; ?></td>
                        <td> <?= $row['mitra_nama']; ?></td>
                        <td> <?= $row['nasabah_saldo']; ?></td>
                        <td>
                            <?php if ($row['nasabah_status'] == 1) { ?>
                            <span class="badge bg-success">Active</span>
                            <?php } else if ($row['nasabah_status'] == 0) { ?>
                            <span class="badge bg-info">Non Active</span>
                            <?php } ?>
                        <td style="text-align: center;">
                            <a class="btn-sm btn-success btn-update" data-toggle="modal"
                                data-target="#updateModal<?= $row['nasabah_id']; ?>"><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger btn-delete" data-toggle="modal"
                                data-target="#deleteModal<?= $row['nasabah_id']; ?>"><i class="fa fa-trash"></i></a>
                            <a class="btn-sm btn-success btn-update" data-toggle="modal"
                                data-target="#resetModal<?= $row['nasabah_id']; ?>"><i class="fa fa-unlock"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>


<?php foreach ($nasabah as $row) : ?>
<form action="<?= base_url('nasabah/edit'); ?>" enctype="multipart/form-data" method="POST">
    <?= csrf_field(); ?>
    <?php
                                        $db = db_connect();
                                        $query = $db->query("SELECT * FROM tb_kecamatan");
                                        $query1 = $db->query("SELECT * FROM tb_kota");
                                        $qmitra = $db->query("SELECT * FROM tb_mitra");
                                    ?>
    <div class="modal fade" id="updateModal<?= $row['nasabah_id']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Edit Nasabah</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?= $row['nasabah_id']; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" readonly value="<?= $row['nasabah_email']; ?>" class="form-control "
                                    placeholder="Masukan email" id="email" name="email" required autocomplete="off">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" value="<?= $row['nasabah_nama']; ?>" class="form-control "
                                    placeholder="Masukan nama" id="nama" name="nama" required autocomplete="off">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>No Telepon</label>
                                <input type="text" value="<?= $row['nasabah_nohp']; ?>" class="form-control "
                                    id="notelp" name="notelp" required autocomplete="off">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Mitra</label>
                                <select class="form-control" readonly name="mitra" id="mitra">
                                    <option value="<?php echo $row['mitra_id']; ?>"> <?php echo $row['mitra_nama'] ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Status</label>
                                <select name="status" id="status" required class="form-control ">
                                    <?php if ($row['nasabah_status'] == 1) { ?>
                                    <option selected value="1">Active</option>
                                    <option value="0">Non Active</option>
                                    <?php } else { ?>
                                    <option selected value="0">Non Active</option>
                                    <option value="1">Active</option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Saldo</label>
                                <div class="input-group mb-3">
                                    <span class="btn btn-success">Rp</span>
                                    <input type="text" value="<?= $row['nasabah_saldo']; ?>" class="form-control"
                                        id="saldo" name="saldo" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-2 mb-2" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success mt-2 mb-2 mr-2">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="<?= base_url('nasabah/delete'); ?>" enctype="multipart/form-data" method="POST">
    <?= csrf_field(); ?>
    <div class="modal" tabindex="-1" id="deleteModal<?= $row['nasabah_id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Konfirmasi hapus</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" required value="<?= $row['nasabah_id']; ?>" />
                    <h6>Yakin ingin menghapus data <strong><?= $row['nasabah_nama']; ?></strong>?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-sm btn-success mr-2">Yakin</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="<?= base_url('nasabah/reset'); ?>" enctype="multipart/form-data" method="POST">
    <?= csrf_field(); ?>
    <div class="modal" tabindex="-1" id="resetModal<?= $row['nasabah_id']; ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Konfirmasi reset password</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" required value="<?= $row['nasabah_id']; ?>" />
                    <h6>Password <strong><?= $row['nasabah_nama']; ?></strong> akan di reset menjadi '123456'</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-sm btn-success mr-2">Oke</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach; ?>

<?= $this->endSection(); ?>