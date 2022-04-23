<?php
include 'database.php';
$sql 	= "SELECT a.USERID AS USERID, b.URAIAN AS tahap, c.AKROUNIT AS skpd, NMGROUP AS akses, NAMA, a.KET AS ket 
				   FROM WEBUSER a
				   LEFT JOIN TAHAP b ON a.KDTAHAP=b.kdtahap
				   LEFT JOIN DAFTUNIT c ON a.UNITKEY=c.UNITKEY
				   LEFT JOIN WEBGROUP d ON a.GROUPID=d.GROUPID
				   ORDER BY c.KDUNIT, a.USERID, d.GROUPID";
$params	= array();
$options = array("scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt 	= sqlsrv_query($conn2, $sql, $params, $options);
$jumlah = sqlsrv_num_rows($stmt);
$no     = 1;
if ($jumlah == true) {
	$jml = "<font style='background:;' color='black'>$jumlah</font>";
} else {
	$jml = "Tidak ditemukan UserID";
}
?>
<div class="container">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin SIPKD</h1>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manajemen Pengelolaan Userid SIPKD</h3>
              </div>
              <div class="card-body">
			          <a href="user_tambah.php" class="btn btn-success btn-md mb-3" role="button"><i class=' glyphicon glyphicon-pencil'></i>Tambah Data</a>
                <table id="example" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>UserID</th>
                    <th>Tahap</th>
                    <th>SKPD</th>
                    <th>GROUP</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php while ($r = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) { ?>
                        <tr>
                          <td><?php echo $no; ?>.</td>
                          <td><?php echo $r['USERID']; ?></td>
                          <td><?php echo $r['tahap']; ?></td>
                          <td><?php if ($r["skpd"] == NULL) {
                                echo 'Seluruh SKPD';
                              } else {
                                echo $r["skpd"];
                              } ?></td>
                          <td><?php echo $r['akses']; ?></td>
                          <td>
                            <div class='btn-group'>
                              <a href='user_ubah.php?userid=<?php echo $r['USERID']; ?>' class='btn btn-primary' role='button'><i class=' glyphicon glyphicon-pencil'></i> Ubah</a>
                              <a href='action_rincian.php?userid=<?php echo $r['USERID']; ?>' class='btn btn-warning' role='button'><i class='glyphicon glyphicon-list-alt'></i> Rincian</a>
                              <a href='action_hapus.php?userid=<?php echo $r['USERID']; ?>' class='btn btn-danger' role='button' onclick='return confirm("Apakah Anda Yakin menghapus userid <?php echo $r['USERID']; ?> ??")'><i class='glyphicon glyphicon-trash'></i> Delete</a>
                            </div>
                          </td>
                        </tr>
                      <?php
                      $no++;
                    }
                    ?>
                  </tbody>
                      <tfoot>
                          <tr>
                            <th>No</th>
                            <th>UserID</th>
                            <th>Tahap</th>
                            <th>SKPD</th>
                            <th>GROUP</th>
                            <th>Aksi</th>
                          </tr>
                      </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>
<?php sqlsrv_close($conn2); ?>
</div>