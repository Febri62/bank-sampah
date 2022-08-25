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
    <li class="nav-item has-treeview menu-open">
        <a href="#" class="nav-link active">
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
                <a href="<?= base_url('laporan-transaksi'); ?>" class="nav-link active">
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
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="m-0 text-dark">Laporan</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <form action="<?= base_url('laporan-transaksi-penjualan'); ?>" target="__blank" method="POST">
                    <div class="card-header">
                        <h5>Laporan Penjualan</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col">
                        <label for="filterbulan">Pilih bulan</label>
                        <select name="filterbulan" id="filterbulan" class="form-control">
                            <option value="01">Januari </option>
                            <option value="02">Februari </option>
                            <option value="03">Maret </option>
                            <option value="04">April </option>
                            <option value="05">Mei </option>
                            <option value="06">Juni </option>
                            <option value="07">Juli </option>
                            <option value="08">Agustus </option>
                            <option value="09">September </option>
                            <option value="10">Oktober </option>
                            <option value="11">November </option>
                            <option value="12">Desember </option>
                        </select>
                        </div>
                        <div class="row ml-2 mr-2">
                        <label for="filtertahun">Pilih Tahun</label>
                        <select name="filtertahun" id="filtertahun" class="form-control">
                            <option value="2022">2022 </option>
                            <option value="2023">2023 </option>
                            <option value="2024">2024 </option>
                            <option value="2025">2025 </option>
                            <option value="2026">2026 </option>
                            <option value="2027">2027 </option>
                            <option value="2028">2028 </option>
                            <option value="2029">2029 </option>
                            <option value="2030">2030 </option>
                            <option value="2031">2031 </option>
                            <option value="2032">2032 </option>
                        </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" target="__blank" onclick="pegawaiperbulan()" class="btn btn-primary float-right">Cetak</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <form action="<?= base_url('laporan-transaksi-penarikan'); ?>" target="__blank" method="POST">
                    <div class="card-header">
                        <h5>Laporan Penarikan</h5>
                    </div>
                    <div class="card-body row">
                        <div class="col">
                        <label for="filterbulan">Pilih bulan</label>
                        <select name="filterbulan" id="filterbulan" class="form-control">
                            <option value="01">Januari </option>
                            <option value="02">Februari </option>
                            <option value="03">Maret </option>
                            <option value="04">April </option>
                            <option value="05">Mei </option>
                            <option value="06">Juni </option>
                            <option value="07">Juli </option>
                            <option value="08">Agustus </option>
                            <option value="09">September </option>
                            <option value="10">Oktober </option>
                            <option value="11">November </option>
                            <option value="12">Desember </option>
                        </select>
                        </div>
                        <div class="row ml-2 mr-2">
                        <label for="filtertahun">Pilih Tahun</label>
                        <select name="filtertahun" id="filtertahun" class="form-control">
                            <option value="2022">2022 </option>
                            <option value="2023">2023 </option>
                            <option value="2024">2024 </option>
                            <option value="2025">2025 </option>
                            <option value="2026">2026 </option>
                            <option value="2027">2027 </option>
                            <option value="2028">2028 </option>
                            <option value="2029">2029 </option>
                            <option value="2030">2030 </option>
                            <option value="2031">2031 </option>
                            <option value="2032">2032 </option>
                        </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" target="__blank" onclick="pegawaiperbulan()" class="btn btn-primary float-right">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>
   
</div>

<?= $this->endSection(); ?>
