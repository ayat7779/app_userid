<?php
include 'page/header.php';
include 'database.php';
$userid = $_POST['userid'];
$tahap	= $_POST['tahap'];
$skpd	= $_POST['skpd'];
$group 	= $_POST['group'];
$nama 	= $_POST['nama'];
$blok 	= $_POST['blok'];
$trans 	= $_POST['transfer'];
$insert	= $_POST['insert'];
$update = $_POST['update'];
$delete	= $_POST['delete'];
$ket 	= $_POST['keterangan'];
if ($skpd == 'NULL') {
	$sql = "UPDATE WEBUSER 
					SET USERID='$userid', KDTAHAP='$tahap', UNITKEY=NULL, NIP=NULL, GROUPID='$group', NAMA='$nama', BLOKID=$blok, TRANSECURE=$trans, STINSERT= $insert, STUPDATE=$update, STDELETE=$delete, KET='$ket'
			        WHERE USERID='$userid' 
			       ";
} else {
	$sql = "UPDATE WEBUSER 
					SET USERID='$userid', KDTAHAP='$tahap', UNITKEY='$skpd', NIP=NULL, GROUPID='$group', NAMA='$nama', BLOKID=$blok, TRANSECURE=$trans, STINSERT=$insert, STUPDATE=$update, STDELETE=$delete, KET='$ket'
			        WHERE USERID='$userid'
			       ";
}
$query = $sql;
$stmt = sqlsrv_query($conn2, $query);
?>
	<div class="container">
		<hr>
		<h2>Perhatian</h2>
		<hr>
		<div class="alert alert-success">
			<strong>Success !!!</strong> merubah data userID <?php echo '<b>' . $userid . '</b> dengan nama pemilik <b>' . $nama . '</b>'; ?> berhasil dilakukan......
		</div>
		<div class="alert alert-warning">
			<strong>Warning !!!</strong> Apabila terdapat kekeliruan data pada userID <?php echo '<b>' . $userid . '</b> dengan nama pemilik <b>' . $nama . '</b>'; ?> agar segera melapor ke </b>'; ?>............. <a href='user_daftar.php' class='alert-link'>Kembali</a>
		</div>
	<?php
	include 'page/footer.php';
sqlsrv_close($conn2);
?>