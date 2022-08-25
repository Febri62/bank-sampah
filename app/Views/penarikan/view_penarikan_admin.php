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
    <li class="nav-item has-treeview menu-close">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa fa-file"></i>
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
                <a href="<?= base_url('sampah'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sampah</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="nav-icon fas fa fa-th-list"></i>
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
                <a href="<?= base_url('penarikan'); ?>" class="nav-link active">
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
                    <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                    <li class="breadcrumb-item active">Penarikan</li>
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
            <!-- <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#addModal"><i
                    class="fa fa-plus mr-2"></i> Data Baru</a> -->
            <a href="<?= base_url('penarikan/report'); ?>" target="__blank" class="btn btn-sm btn-info"><i
                    class="fa fa-print mr-2"></i> Cetak</a>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <table id="table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Nasabah</th>
                        <th>Nama Bank</th>
                        <th>Nomor Rekening</th>
                        <th>Nama Rekening</th>
                        <th>Jumlah Penarikan</th>
                        <th>Bukti Transfer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($penarikan->getResult() as $row) : $no++ ?>
                    <tr>
                        <td> <?= $no; ?></td>
                        <td> <?= $row->penarikan_tanggal; ?></td>
                        <td> <?= $row->nasabah_nama; ?></td>
                        <td> <?= $row->penarikan_nama_bank; ?></td>
                        <td> <?= $row->penarikan_nomor_rekening; ?></td>
                        <td> <?= $row->penarikan_nama_rekening; ?></td>
                        <td> <?= $row->penarikan_jumlah_penarikan; ?></td>
                        
                        <td style="text-align: center;">
                            <img src="<?= base_url('assets/images/'. $row->penarikan_bukti_transfer) ?>" alt="images" width="30px">
                        </td>
                        <td>
                            <?php if ($row->penarikan_status == 0) { ?>
                                    <span class="badge bg-info">PENDING</span>
                                <?php } else if ($row->penarikan_status == 1) { ?>
                                    <span class="badge bg-success">SUKSES</span>
                                <?php } else { ?>
                                    <span class="badge bg-danger">DITOLAK</span>
                                <?php } ?>
                        </td>
                        <td style="text-align: center;" class="row" width="100px">
                            <?php if ($row->penarikan_status == 0) { ?>
                                    <a class="btn-sm btn-success btn-update" style="cursor: pointer;" data-toggle="modal" data-target="#updateModal<?= $row->penarikan_nomor; ?>"><i class="fa fa-edit"></i></a>
                                <?php } ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<?php foreach($penarikan->getResult() as $row) : ?>
<form action="<?= base_url('penarikan/edit'); ?>" enctype="multipart/form-data" method="POST">
    <?= csrf_field(); ?>
    <div class="modal" tabindex="-1" id="updateModal<?= $row->penarikan_nomor ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Update Status</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" required value="<?= $row->penarikan_nomor ?>" />
                    <h6>Proses Pesanan <strong><?= $row->penarikan_nomor ?></strong>?</h6>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" id="status" required class="form-control">
                            <option value="" selected disabled>Pilih</option>
                            <?php if ($row->penarikan_status == 0) { ?>
                                <option value="0">Sukses</option>
                            <?php } else if ($row->penarikan_status == 1){ ?>
                                <option value="1">Tolak</option>
                            <?php } else ?>
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-sm btn-success mr-2">Yakin</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form action="<?= base_url('penarikan/save'); ?>" enctype="multipart/form-data" method="POST">
    <?= csrf_field(); ?>
    <div class="modal" tabindex="-1" id="tambahModal<?= $row->penarikan_nomor ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Bukti Transfer</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" required value="<?= $row->penarikan_nomor ?>" />
                    <h6>Upload Bukti <strong><?= $row->penarikan_nomor ?></strong>?</h6>
                </div>
                <div class="col-lg-12">

                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="inputGroupFile02" name="bukti">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-sm btn-success mr-2">Yakin</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach; ?>
<?= $this->endSection(); ?>