<?php
include "page/header.php";
include "database.php";
if (isset($_GET["userid"])) {
  $serial = $_GET["userid"];
} else {
  die('Ditemukan parameter primarykey yang masuk');
}
$query =  " SELECT NAMA, USERID, AKROUNIT, NMGROUP, BLOKID, TRANSECURE, STINSERT, STUPDATE, STDELETE, (NMUNIT+' '+ALAMAT+' '+TELEPON) AS ALAMAT
            FROM WEBUSER a
            LEFT JOIN TAHAP b     ON a.KDTAHAP=b.KDTAHAP
            LEFT JOIN DAFTUNIT c  ON a.UNITKEY=c.UNITKEY
            LEFT JOIN WEBGROUP d  ON a.GROUPID=d.GROUPID  
            WHERE USERID = ? 
          ";
$params = array($serial);
$result = sqlsrv_query($conn2, $query, $params);
while ($r = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
  if ($r['BLOKID'] == '3') {
    $b = '<font color="red">Diblokir</font>';
  } else {
    $b = '<font color="blue">Tidak Diblokir</font>';
  }
  if ($r['TRANSECURE'] == '1') {
    $t = '<font color="blue">Bisa Transfer</font>';
  } else {
    $t = '<font color="red">Tidak Bisa Transfer</font>';
  }
  if ($r['STINSERT'] == '1') {
    $i = '<font color="blue">Bisa Insert</font>';
  } else {
    $i = '<font color="red">Tidak Bisa Insert</font>';
  }
  if ($r['STUPDATE'] == '1') {
    $u = '<font color="blue">Bisa Update</font>';
  } else {
    $u = '<font color="red">Tidak Bisa Update</font>';
  }
  if ($r['STDELETE'] == '1') {
    $d = '<font color="blue">Bisa Delete</font>';
  } else {
    $d = '<font color="red">Tidak Bisa Delete</font>';
  }
  if ($r['AKROUNIT'] == NULL) {
    $skpd = 'SELURUH SKPD';
  } else {
    $skpd = $r["AKROUNIT"];
  }
  if (isset($r['ALAMAT'])) {
    $alamat = $r["ALAMAT"];
  } else {
    $alamat = "Tidak ada alamat";
  }
?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <hr>
        <h1>Userid : <b><?php echo $r['USERID']; ?></b></h1>
        <hr>
      </div>
      <div class="login-box-body">
        <div class="social-auth-links text-center">
          <div id="dynamic-content">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered">
                    <tr>
                      <th>Penanggungjawab</th>
                      <td align="left"><?php echo $r['NAMA']; ?></td>
                    </tr>
                    <tr>
                      <th>SKPD Yang Bisa Diakses</th>
                      <td align="left"><?php echo $skpd; ?></td>
                    </tr>
                    <tr>
                      <th>Group Akses</th>
                      <td align="left"><?php echo $r['NMGROUP']; ?></td>
                    </tr>
                    <tr>
                      <th rowspan="5">Permission Action</th>
                      <th><?php echo $b; ?></th>
                    </tr>
                    <tr>
                      <th><?php echo $t; ?></th>
                    </tr>
                    <tr>
                      <th><?php echo $i; ?></th>
                    </tr>
                    <tr>
                      <th><?php echo $u; ?></th>
                    </tr>
                    <tr>
                      <th><?php echo $d; ?></th>
                    </tr>
                    <tr>
                      <th>Alamat</th>
                      <td align="left"><?php echo $alamat; ?></td>
                    </tr>
                  </table>
                  <div class="social-auth-links text-center">
                    <a href="index.php" class="btn btn-block btn-social btn-facebook btn-flat"><i class="glyphicon glyphicon-home"></i> Kembali</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
<?php
}
sqlsrv_close($conn2);
?>