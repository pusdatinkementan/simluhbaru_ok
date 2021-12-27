<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; Filename=daftar_poktan_tanaman_pangan.xls");
?>

<html>

<body>
    <div align="center">
        <table border="0" cellpadding="0" style="border-collapse: collapse" width="100%" id="table1">
            <tr>
                <td>
                    <p align="center">
                        <font color='6'><b>Daftar Kelompok Tani Tanaman Pangan</b>
                </td>
            </tr>


            <div align="center">
                <table width=100% border=1 align=left>
                    <thead>
                        <tr>
                            <td align=center>
                                <font face=verdana size=2><b>No</b></font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Propinsi</font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Kabupaten</font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Kecamatan</font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Desa</font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Nama Poktan</font>
                            </td>
                            <td align=center valign=middle><b>Ketua</b></font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Alamat</b></font>
                            </td>
                            <td align=center>
                                <font face=verdana size=2><b>Tahun Pembentukan</b></font>
                            </td>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($rgjenispokexcel as $row => $item) {
                        ?>
                            <tr>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $i++ ?></p>
                                </td>
                                <td class="align-middle text-sm" align="center">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['nama_prop']; ?>
                                    </p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['nama_kab']; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['deskripsi']; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['nm_desa']; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['nama_poktan']; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['ketua_poktan']; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['alamat']; ?></p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <p class="text-xs font-weight-bold mb-0"><?= $item['simluh_tahun_bentuk']; ?></p>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
</body>

</html>