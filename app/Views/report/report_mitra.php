<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Mitra</title>
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
                <td>Laporan Data Mitra</td>
            </tr>
        </table>
        <table border="1" class="body" width="625">
            <thead>
                <tr style="height: 25px;">
                    <th>No.</th>
                    <th>Email</th>
                    <th>Nama Mitra</th>
                    <th>Direktur</th>
                    <th>No Telepon</th>
                    <th>Status</th>
                    <th>Tanggal Bergabung</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                foreach ($mitra as $row) : $no++ ?>
                    <tr style="height: 30px; text-align: center;">
                        <td> <?= $no; ?></td>
                        <td> <?= $row['mitra_email']; ?></td>
                        <td> <?= $row['mitra_nama']; ?></td>
                        <td> <?= $row['mitra_direktur']; ?></td>
                        <td> <?= $row['mitra_nohp']; ?></td>
                        <td> <?php if ($row['mitra_status'] == 1) { ?>
                                Active
                            <?php } else { ?>
                                Non Active
                            <?php } ?></td>
                        <td> <?= $row['mitra_join_at']; ?></td>
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