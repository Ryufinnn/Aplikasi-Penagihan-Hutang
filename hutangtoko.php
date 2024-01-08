<?php
include "connect.php";

$query=mysql_query("SELECT max(id_hutangtoko) as maxKode FROM hutangtoko");
$data=mysql_fetch_array($query);
$id_hutangtoko = $data['maxKode'];

$nourut = (int) substr($id_hutangtoko, 3, 3);
$nourut++;

$kode = "HT";
$kodehutangtoko = $kode . sprintf("%03s", $nourut);

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Hutang
        <small>Dari Toko</small>
      </h1>
    </section>

    <section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Hutang Toko</h3>
            </div>
            <!-- form start -->
            <form class="form-horizontal" method="POST">
              <div class="box-body">
                <div class="form-group">

                  <label  class="col-sm-4 control-label">Hutang Ke</label>

                  <div class="col-sm-6">
                    <input type="hidden" name="id_hutangtoko" class="form-control" value="<?php echo $kodehutangtoko; ?>">
                    <input type="text" name="hutangke" class="form-control"  placeholder="Hutang Ke ...">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label">Keterangan</label>

                  <div class="col-sm-6">
                    <textarea name="ket" class="form-control" placeholder="Keterangan"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label">Nominal</label>

                  <div class="col-sm-6">
                    <input type="text" name="nominal" class="form-control" placeholder="Nominal">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label"></label>
                  <div class="col-sm-6">
                    <button type="submit" name="save" class="btn btn-info pull-center">Simpan</button>
                  </div>
                </div>
              </div>

            </form>
          </div> 
        </div>      
    </div>

<?php 

include"connect.php";
if(isset($_POST['save'])){

  $tgl=date("Y-m-d");

  $save=mysql_query("INSERT INTO hutangtoko VALUES('$kodehutangtoko','$_POST[hutangke]','$tgl','$_POST[ket]','$_POST[nominal]','$_POST[nominal]')");

  if($save) {
  echo"<script language=javascript>
        window.location='?p=hutangtoko';
        </script>";
        exit;
      }else{
        echo"gagal";
      }
}
?>


    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-responsive no-padding table-striped">
                <thead>
                <tr>
                  <th>Kode</th>
                  <th>Hutang Ke</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Nominal Hutang</th>
                  <th>Sisa Hutang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $query=mysql_query("SELECT * FROM hutangtoko order by tanggal desc");
                    while ($data=mysql_fetch_array($query)) {
                      $nominal=$data['nominal'];
                      $sisa=$data['sisa'];
                  ?>

                <tr>
                  <td><?php echo $data['id_hutangtoko'];?></td>
                  <td><?php echo $data['hutangke'];?></td>
                  <td><?php echo $data['tanggal'];?></td>
                  <td><?php echo $data['ket'];?></td>
                  <td><?php echo "Rp. ".number_format($nominal,0,"",'.').",-"?></td>
                  <td><?php echo "Rp. ".number_format($sisa,0,"",'.').",-"?></td>
                  <td>
                    <a href="?p=detailtoko&id_hutangtoko=<?php echo $data['id_hutangtoko']; ?>"><button type="submit" class="btn btn-primary" title="Lihat Angsuran">Angsuran</button></a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode</th>
                  <th>Hutang Ke</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Nominal Hutang</th>
                  <th>Sisa Hutang</th>
                  <th>Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
