<?php
include 'page/header.php';
include "database.php";
if (isset($_GET["userid"])) {
  $serial = $_GET["userid"];
} else {
  die('Ditemukan parameter primarykey yang masuk');
}
$query = "SELECT a.USERID, b.KDTAHAP, b.URAIAN, c.UNITKEY as skpd, c.KDUNIT, c.NMUNIT, d.GROUPID, d.NMGROUP, NAMA, BLOKID, TRANSECURE, STINSERT, STUPDATE, STDELETE, a.KET as ket FROM WEBUSER a LEFT JOIN TAHAP b on a.KDTAHAP=b.kdtahap LEFT JOIN DAFTUNIT c on a.UNITKEY=c.UNITKEY LEFT JOIN WEBGROUP d on a.GROUPID=d.GROUPID WHERE USERID = ? ";
$params = array($serial);
$result = sqlsrv_query($conn2, $query, $params);
while ($r = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
  $qthp   = sqlsrv_query($conn2, "SELECT * FROM TAHAP");
  $qskpd  = sqlsrv_query($conn2, "SELECT * FROM DAFTUNIT WHERE KDLEVEL=3 ORDER BY KDUNIT");
  $qgroup = sqlsrv_query($conn2, "SELECT * FROM WEBGROUP ORDER BY NMGROUP");
?>
  <div class="container">
    <hr />
    <h2>Editing Userid</h2>
    <hr />
    <form class="form-horizontal" action="action_ubah.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label class="control-label col-sm-2" for="nama">Nama :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nama" value='<?php echo $r["NAMA"]; ?>'>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="userid">UserID :</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="userid" value='<?php echo $r['USERID']; ?>'>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="tahapan">Tahapan :</label>
        <div class="col-sm-10">
          <select class='form-control' name='tahap'>
            <option value="<?php echo $r['KDTAHAP']; ?>"><?php echo $r['URAIAN']; ?></option>
            <?php while ($r1 = sqlsrv_fetch_array($qthp, SQLSRV_FETCH_ASSOC)) { ?>
              <option value="<?php echo $r1['KDTAHAP']; ?>"> <?php echo $r1['URAIAN']; ?> </option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="skpd">SKPD :</label>
        <div class="col-sm-10">
          <select class='form-control' name='skpd'>
            <option value="<?php if ($r['skpd'] == NULL) {
                              echo 'NULL';
                            } else {
                              echo $r['skpd'];
                            } ?>">
              <?php
              if ($r['skpd'] == NULL) {
                echo 'Seluruh SKPD';
              } else {
                echo $r['KDUNIT'] . ' - ' . $r['NMUNIT'];
              }
              ?>
            </option>
            <?php while ($r2 = sqlsrv_fetch_array($qskpd, SQLSRV_FETCH_ASSOC)) { ?>
              <option value="<?php echo $r2['UNITKEY']; ?>"> <?php echo $r2['KDUNIT'] . " - " . $r2['NMUNIT'] ?> </option>
            <?php } ?>
            <option value='NULL'>Semua SKPD</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="group">Group :</label>
        <div class="col-sm-10">
          <select class='form-control' name='group'>
            <option value='<?php echo $r["GROUPID"]; ?>'><?php echo $r["NMGROUP"]; ?></option>
            <?php while ($r3 = sqlsrv_fetch_array($qgroup, SQLSRV_FETCH_ASSOC)) { ?>
              <option value="<?php echo $r3['GROUPID']; ?>"> <?php echo $r3['NMGROUP']; ?> </option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="blokir">Blokir :</label>
        <div class="col-sm-10">
          <input type='radio' name='blok' value='3' <?php if ($r['BLOKID'] == 3) {
                                                      echo 'checked';
                                                    } ?> /> Diblokir<br />
          <input type='radio' name='blok' value='0' <?php if ($r['BLOKID'] == 0) {
                                                      echo 'checked';
                                                    } ?> /> Tidak
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="transfer">Transfer :</label>
        <div class="col-sm-10">
          <input type='radio' name='transfer' value='1' <?php if ($r['TRANSECURE'] == 1) {
                                                          echo 'checked';
                                                        } ?> /> Izinkan<br />
          <input type='radio' name='transfer' value='0' <?php if ($r['TRANSECURE'] == 0) {
                                                          echo 'checked';
                                                        } ?> /> Tidak
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="insert">Insert :</label>
        <div class="col-sm-10">
          <input type='radio' name='insert' value='1' <?php if ($r['STINSERT'] == 1) {
                                                        echo 'checked';
                                                      } ?> /> Izinkan<br />
          <input type='radio' name='insert' value='0' <?php if ($r['STINSERT'] == 0) {
                                                        echo 'checked';
                                                      } ?> /> Tidak
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="update">Update :</label>
        <div class="col-sm-10">
          <input type='radio' name='update' value='1' <?php if ($r['STUPDATE'] == 1) {
                                                        echo 'checked';
                                                      } ?> /> Izinkan<br />
          <input type='radio' name='update' value='0' <?php if ($r['STUPDATE'] == 0) {
                                                        echo 'checked';
                                                      } ?> /> Tidak
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="delete">Delete :</label>
        <div class="col-sm-10">
          <input type='radio' name='delete' value='1' <?php if ($r['STDELETE'] == 1) {
                                                        echo 'checked';
                                                      } ?> /> Izinkan<br />
          <input type='radio' name='delete' value='0' <?php if ($r['STDELETE'] == 0) {
                                                        echo 'checked';
                                                      } ?> /> Tidak
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-2" for="keterangan">Keterangan :</label>
        <div class="col-sm-10">
          <input class='form-control' type='text' name='keterangan' size='100%' value="<?php echo $r["ket"]; ?>" />
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Ubah</button>
          <a href="index.php" class="btn btn-info" role="button">Kembali</a>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
}
include 'page/footer.php';
sqlsrv_close($conn2);
?>