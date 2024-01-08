<?php
include "connect.php";

$query=mysql_query("SELECT max(id_angsurantoko) as maxKode FROM angsurantoko");
$data=mysql_fetch_array($query);
$id_angsurantoko = $data['maxKode'];

$nourut = (int) substr($id_angsurantoko, 3, 3);
$nourut++;

$kode = "AP";
$kodeangsurantoko = $kode . sprintf("%03s", $nourut);
?>

<?php
$sql=mysql_query("SELECT * FROM hutangtoko where id_hutangtoko='$_GET[id_hutangtoko]'; ");
$data=mysql_fetch_array($sql);
$nominal=$data['nominal'];

$sql2=mysql_query("SELECT sum(angsuran) as jumlah FROM angsurantoko WHERE id_hutangtoko='$_GET[id_hutangtoko]';");
$data2=mysql_fetch_array($sql2);
$sisa=$data['nominal']-$data2['jumlah'];
mysql_query("UPDATE hutangtoko SET sisa='$sisa' where id_hutangtoko='$_GET[id_hutangtoko]';");
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Angsuran
        <small>Dari Toko</small>
      </h1>
    </section>
    <section class="content">
	<div class="row">
      <div class="col-xs-12">
       <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Angsuran</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <form method="POST">
                <div class="col-xs-2">
                  <input type="hidden" name="id_angsurantoko" class="form-control" value="<?php echo $kodeangsurantoko; ?>">
                  <input type="hidden" name="id_hutangtoko" class="form-control" value="<?php echo $_GET['id_hutangtoko'] ?>">
                  <label>Masukkan Angsuran</label>
                </div>
                <div class="col-xs-3">
                  <input type="text" name="angsuran" class="form-control" placeholder="Angsuran">
                </div>
                <div class="col-xs-1">
                  <button type="submit" name="save" class="btn btn-primary">Submit</button>
                </div>
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div> 
        </div>      
    </div>

<?php 

include"connect.php";
if(isset($_POST['save'])){

  $tgl=date("Y-m-d");

  $save=mysql_query("INSERT INTO angsurantoko VALUES('$kodeangsurantoko','$_POST[id_hutangtoko]','$tgl','$_POST[angsuran]')");
  


  if($save) {
  echo"<script language=javascript>
        window.location='?p=detailtoko&id_hutangtoko=".$_POST['id_hutangtoko']."';
        </script>";
        exit;
      }else{
        echo"gagal";
      }
}
?>

	<div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
            <div class="box-body">
              <div class="row">
                <div class="col-xs-1">
                  <label>Hutang Ke</label>
                </div>
                <div class="col-xs-2">
                  <input type="text" value="<?php echo $data['hutangke'] ?>" class="form-control" readonly>
                </div>
                <div class="col-xs-6">
                  
                </div>
                <div class="col-xs-1">
                  <label>Nominal</label>
                </div>
                <div class="col-xs-2">
                  <input type="text" value="<?php echo "Rp. ".number_format($nominal,0,"",'.').",-" ?>" name="notelp" class="form-control" readonly>
                </div>
              </div><br>
              <div class="row">
                <div class="col-xs-1">
                  <label>Keterangan</label>
                </div>
                <div class="col-xs-2">
                  <input type="text" value="<?php echo $data['ket'] ?>" class="form-control" readonly>
                </div>
                <div class="col-xs-6">
                  
                </div>
                <div class="col-xs-1">
                  <label>Sisa</label>
                </div>

                <div class="col-xs-2">
                  <input type="text" value="<?php echo "Rp. ".number_format($sisa,0,"",'.').",-" ?>" name="notelp" class="form-control" readonly>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
          </div> 
        </div>      
    </div>


    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Angsuran</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $no=1;
                    $query=mysql_query("SELECT * FROM angsurantoko WHERE id_hutangtoko='$_GET[id_hutangtoko]' order by tanggal desc");
                    while ($data=mysql_fetch_array($query)) {
                      $angsuran=$data['angsuran'];
                  ?>

                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data['tanggal'];?></td>
                  <td><?php echo "Rp. ".number_format($angsuran,0,"",'.').",-"?></td>
                  
                </tr>
                <?php $no++; } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

    </section>
