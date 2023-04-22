<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kunjungan</title>

	<style type="text/css" media="screen">
		thead {
			border-bottom-style: solid;
			border-top-style: solid;
			border-width: thin; 
		}
		td {
			padding:  5px;
            font-size: 12px;
        }
        th {
           padding: 5px;
           font-size: 12px;
       }

   </style>

</head>
<body>

    <h5 class="mt-3" align="center" style="font-weight: bold; color: black;">LAPORAN KUNJUNGAN</h5>

    <table>
      <tr>
         <td style="font-weight: bold; color: black;">PERIODE</td>
         <td style="font-weight: bold; color: black;">:</td>
         <td style="color: black;"><?= date('d-m-Y', strtotime($tgl1)); ?> <?= $tgl2; ?></td>
     </tr>
 </table>

 <br>

 <table class="table-bordered" style="width: 100%; border-collapse: collapse !important; color: black;">
    <thead>
        <tr>
            <th width="5%" style="text-align: center;">No</th>
            <th>Nama Anggota</th>
            <th>Tanggal Kunjungan</th>
            <th>Tujuan Kunjungan</th>
        </tr>
    </thead>
    <tbody>

        <?php if(!empty($get_laporan)): ?>
        <?php $no=1; foreach($get_laporan as $gl) : ?>
        <tr>
           <td style="text-align: center;"><?= $no++ ?></td>
           <td><?= $gl->nama ?> / <?= $gl->kode_anggota ?></td>
           <td><?= $gl->tanggal_kunjungan ?></td>
           <td><?= $gl->tujuan_kunjungan ?></td>
       </tr>
       <?php endforeach; ?>

       <?php else: ?>
       <td colspan="9" style="text-align: center;">Laporan Kunjungan Tidak Ada, Silahkan Pilih Tanggal lain.</td>
       <?php endif; ?>

   </tbody>
</table>

</body>
</html>