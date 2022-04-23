<?php
		include "database.php";
		$sql = "INSERT INTO WEBUSER (USERID, KDTAHAP, UNITKEY, NIP, GROUPID, PWD, NAMA, BLOKID, TRANSECURE, STINSERT, STUPDATE, STDELETE, KET)  
			VALUES (?, ?, ?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		   ";
		$params = array(
			$_POST['userid'],
			$_POST['tahap'],
			$_POST['skpd'],
			$_POST['group'],
			$_POST['password'],
			$_POST['nama'],
			$_POST['blok'],
			$_POST['transfer'],
			$_POST['insert'],
			$_POST['update'],
			$_POST['delete'],
			$_POST['keterangan']
		);
		$stmt = sqlsrv_query($conn2, $sql, $params);
		if (
			$_POST['userid'] == NULL &&
			$_POST['nama'] == NULL &&
			$_POST['keterangan'] == NULL &&
			$_POST['password'] == NULL
		) {
			header("location:user_daftar.php");
		} else {
			echo "
				<div class='container'>
  					<div class='alert alert-success'>
    					<strong>Success !!!</strong> Menambahkan data atas nama ". $_POST['userid'] . "sukses......<a href='user_daftar.php' class='alert-link'>Kembali</a>
  					</div>
  				</div>
  				";
		}
		sqlsrv_close($conn2);
		?>