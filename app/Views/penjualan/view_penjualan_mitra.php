<?= $this->extend('mainmitra'); ?>

<?= $this->section('menu'); ?>

<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="<?= base_url('/mitra/mitra'); ?>" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
                Dashboard
            </p>
        </a>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa fa-sitemap"></i>
            <p>
                Master
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="<?= base_url('mitra/nasabah'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nasabah</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('mitra/sampah'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sampah</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
            <i class="nav-icon fas fa fa-receipt"></i>
            <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="<?= base_url('mitra/penjualan'); ?>" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penjualan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('mitra/penarikan'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Penarikan</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
            <i class="nav-icon fas fa fa-chart-area"></i>
            <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview ">
            <li class="nav-item">
                <a href="<?= base_url('mitra/laporan-master'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Master</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('mitra/laporan-transaksi'); ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Laporan Transaksi</p>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('mitra/profil'); ?>" class="nav-link">
            <i class="nav-icon far fa fa-user"></i>
            <p>
                Profil
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('mitra/logout'); ?>" class="nav-link">
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
                    <li class="breadcrumb-item active">Penjualan</li>
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
            <a href="<?= base_url('mitra/penjualan/report'); ?>" target="__blank" class="btn btn-sm btn-info"><i class="fa fa-print mr-2"></i> Cetak</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>INV</th>
                        <th>Tanggal</th>
                        <th>Nasabah</th>
                        <th>Item</th>
                        <th>Total Harga</th>
                        <th>Metode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0;
                    foreach ($penjualan as $row) : $no++ ?>
                        <tr>
                            <td> <?= $row['penjualan_nomor']; ?></td>
                            <td> <?= $row['penjualan_tanggal']; ?></td>
                            <td> <?= $row['nasabah_nama']; ?></td>
                            <td> <?= $row['penjualan_total_item']; ?></td>
                            <td>Rp. <?= $row['penjualan_total_harga']; ?></td>
                            <td> <?= $row['penjualan_metode']; ?></td>
                            <td>
                                <?php if ($row['penjualan_status'] == 0) { ?>
                                    <span class="badge bg-info">PENDING</span>
                                <?php } else if ($row['penjualan_status'] == 1) { ?>
                                    <span class="badge bg-info">DIJEMPUT BANK SAMPAH</span>
                                <?php } else if ($row['penjualan_status'] == 2) { ?>
                                    <span class="badge bg-info">MENUNGGU SAMPAH DIANTAR</span>
                                <?php } else if ($row['penjualan_status'] == 3) { ?>
                                    <span class="badge bg-success">SELESAI</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning">TRANSAKSI BATAL</span>
                                <?php } ?>
                            </td>
                            <td style="text-align: center;">
                                <a class="btn-sm btn-success btn-update" style="cursor: pointer;" data-toggle="modal" data-target="#updateModal<?= $row['penjualan_nomor']; ?>"><i class="fa fa-edit"></i></a>
                                <a class="btn-sm btn-warning text-white btn-delete" style="cursor: pointer;" href="<?= base_url() ?>/mitra/penjualan/detail/<?= $row['penjualan_nomor']; ?>"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<?php foreach ($penjualan as $row) : ?>
    <form action="<?= base_url('mitra/penjualan/edit'); ?>" enctype="multipart/form-data" method="POST">
        <?= csrf_field(); ?>
        <div class="modal fade" id="updateModal<?= $row['penjualan_nomor']; ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Status Penjualan</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id" value="<?= $row['penjualan_nomor']; ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Status</label>
                                    <select name="status" id="status" required class="form-control">
                                        <?php if ($row['penjualan_status'] == 0 && $row['penjualan_metode'] == 'Diantar Nasabah') { ?>
                                            <option selected value="0">PENDING</option>
                                            <option value="2">MENUNGGU SAMPAH DIANTAR</option>
                                        <?php } else if ($row['penjualan_status'] == 0 && $row['penjualan_metode'] == 'Dijemput Bank Sampah') { ?>
                                            <option selected value="0">PENDING</option>
                                            <option value="1">DIJEMPUT BANK SAMPAH</option>
                                        <?php } else if ($row['penjualan_status'] == 1) { ?>
                                            <option selected value="1">DIJEMPUT BANK SAMPAH</option>
                                            <option value="3">SELESAI</option>
                                            <option value="4">TRANSAKSI BATAL</option>
                                        <?php } else if ($row['penjualan_status'] == 2) { ?>
                                            <option selected value="2">MENUNGGU SAMPAH DIANTAR</option>
                                            <option value="3">SELESAI</option>
                                            <option value="4">TRANSAKSI BATAL</option>
                                        <?php } else if ($row['penjualan_status'] == 3) { ?>
                                            <option selected value="3">SELESAI</option>
                                        <?php } else { ?>
                                            <option selected value="4">TRANSAKSI BATAL</option>
                                        <?php } ?>
                                    </select>
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
<?php endforeach; ?>

<?= $this->endSection(); ?>