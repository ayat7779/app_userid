<?php
include 'page/header.php';
include 'database.php';
$qthp 	= sqlsrv_query($conn2, "SELECT * FROM TAHAP");
$qskpd 	= sqlsrv_query($conn2, "SELECT * FROM DAFTUNIT WHERE KDLEVEL=3 ORDER BY KDUNIT");
$qgroup = sqlsrv_query($conn2, "SELECT * FROM WEBGROUP WHERE NMGROUP NOT IN ('Administrator','Set Up') ORDER BY NMGROUP");
?>
<div class="container">
	<form class="well form-horizontal" action="action_tambah.php" method="post" id="contact_form">
		<fieldset>
			<legend>Tambah UserID SIPKD</legend>
			<hr>
			<div class="form-group">
				<label class="col-md-4 control-label">Nama</label>
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input name='nama' id="nama" placeholder="Nama Lengkap" class="form-control" type='text' />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">UserID</label>
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input name='userid' id='userid' placeholder="UserID Name" class="form-control" type='text' />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">E-mail/HP</label>
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						<input name='keterangan' id='keterangan' placeholder="Keterangan UserID" class="form-control" type='text' />
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Password</label>
				<div class="col-md-4 inputGroupContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
						<input name="password" id='password' placeholder="Kata Sandi" class="form-control" type="text">
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Tahapan</label>
				<div class="col-md-4 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select name='tahap' class="form-control selectpicker">
							<option value=''>Silakan pilih tahapan</option>
							<?php while ($r = sqlsrv_fetch_array($qthp, SQLSRV_FETCH_ASSOC)) { ?>
								<option value="<?php echo $r['KDTAHAP']; ?>"> <?php echo $r['URAIAN']; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">OPD/Unit</label>
				<div class="col-md-4 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select name='skpd' class="form-control selectpicker">
							<option value=' '>Pilih SKPD</option>
							<?php while ($r = sqlsrv_fetch_array($qskpd, SQLSRV_FETCH_ASSOC)) { ?>
								<option value="<?php echo $r['UNITKEY']; ?>"> <?php echo $r['KDUNIT'] . " - " . $r['NMUNIT']; ?> </option>
							<?php }	?>
							<option value='NULL'>OPEN ALL 'SKPD'</option>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Akses Group</label>
				<div class="col-md-4 selectContainer">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						<select name='group' class="form-control selectpicker">
							<option value=' '>Pilih Group Akses</option>
							<?php while ($r = sqlsrv_fetch_array($qgroup, SQLSRV_FETCH_ASSOC)) { ?>
								<option value="<?php echo $r['GROUPID']; ?>"> <?php echo $r['NMGROUP']; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Akses Blocked</label>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="blok" value="3" /> Yes
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="blok" value="0" checked /> No (Default)
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Transfer Permission</label>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="transfer" value="1" /> Yes
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="transfer" value="0" checked /> No (Default)
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Insert Permission</label>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="insert" value="1" checked /> Yes (Default)
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="insert" value="0" /> No
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Update Permission</label>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="update" value="1" checked /> Yes (Default)
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="update" value="0" /> No
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label">Delete Permission</label>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="delete" value="1" checked /> Yes (Default)
						</label>
					</div>
					<div class="radio">
						<label>
							<input type="radio" name="delete" value="0" /> No
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-4 control-label"></label>
				<div class="col-md-4">
					<button type="submit" class="btn btn-warning" onClick="validasi()">Tambah <span class="glyphicon glyphicon-send"></span></button>
					<a href="index.php" class="btn btn-info" role="button"><i class=' glyphicon glyphicon-home'></i> Kembali</a>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<?php
include 'page/footer.php';
sqlsrv_close($conn2);
?>