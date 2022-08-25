<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Sampah</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/logo.png">
    <style type="text/css">
        .head {
            border-style: double;
            border-width: 3px;
            border-color: white;
        }

        .body {
            border-collapse: collapse;
            border: 1px;
            border-color: black;
        }

        table tr .text2 {
            text-align: right;
            font-size: 13px;
        }

        table tr .text {
            text-align: center;
            font-size: 13px;
        }

        table tr td {
            font-size: 13px;
        }
    </style>
</head>

<body>
    <center>
        <table class="head" width="625">
            <tr>
                <td><img src="<?= base_url(); ?>/assets/images/logo.png" width="90" height="90"></td>
                <td>
                    <center>
                        <font size="5"><b>BANK SAMPAH</b></font><br>
                        <font size="2">Alamat : Jalan Alai Timur No. 30 C Padang</font><br>
                        <font size="2"><i>Email : banksampah@gmail.com Kode Pos : 25171 Telp. (0821) 71538532</i></font>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <table width="625" class="head">
                <tr>
                    <td class="text2">Padang, <?= date("d M Y"); ?></td>
                </tr>
            </table>
        </table>
        <table class="head" style="margin-bottom: 20px;">
            <tr>
                <td>Laporan Data Sampah</td>
            </tr>
        </table>
        <table border="1" class="body" width="625">
            <thead>
                <tr style="height: 25px;">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($sampah as $row) : $no++ ?>
                    <tr style="height: 20px; text-align: center;">
                        <td> <?= $no; ?></td>
                        <td> <?= $row['sampah_nama']; ?></td>
                        <td> <?= $row['kategori_nama']; ?></td>
                        <td> <?= $row['sampah_satuan']; ?></td>
                        <td> <?= $row['sampah_harga']; ?></td>
                        <td>
                            <?php if ($row['sampah_status'] == 1) { ?>
                            <span class="badge bg-success">Active</span>
                            <?php } else if ($row['sampah_status'] == 0) { ?>
                            <span class="badge bg-info">Non Active</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </center>
</body>

<script>
    window.print();
</script>

</html>