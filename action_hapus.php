<?php
include 'page/header.php';
include 'database.php';
$userid = $_GET['userid'];
$sql 	= "DELETE WEBUSER WHERE USERID = '$userid' ";
$stmt 	= sqlsrv_query($conn2, $sql);
if ($stmt === false) {
	die('Terjadi kesalahan pada ' . print_r(sqlsrv_errors(), true));
} else { ?>
<div class="wrapper mt-4">
	<div class="container">
		<div class="alert alert-success">
			<strong>Success !!!</strong> Userid <b><?= $userid; ?></b> Berhasil Terhapus dari Database !!!.......<a href="#" class="alert-link"></a>
		</div>
		<div class="alert alert-warning">
			<strong>Warning !!!</strong> Untuk mengembalikan userid <b><?= $userid; ?></b> agar entry kembali oleh <b>AdminSIPKD</b><br>
			<a href="index.php" class="alert-link">Kembali</a>.
		</div>
	</div>
</div>
<?php

}
sqlsrv_close($conn2);
?>