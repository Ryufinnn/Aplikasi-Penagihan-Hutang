<?php
include "connect.php";

$query=mysql_query("SELECT max(id_angsuranpel) as maxKode FROM angsuranpelanggan");
$data=mysql_fetch_array($query);
$id_angsuranpel = $data['maxKode'];

$nourut = (int) substr($id_angsuranpel, 3, 3);
$nourut++;

$kode = "AP";
$kodeangsuranpel = $kode . sprintf("%03s", $nourut);
?>

<?php
$sql=mysql_query("SELECT * FROM hutangpelanggan where id_hutangpel='$_GET[id_hutangpel]'; ");
$data=mysql_fetch_array($sql);
$nominal=$data['nominal'];

$sql2=mysql_query("SELECT sum(angsuran) as jumlah FROM angsuranpelanggan WHERE id_hutangpel='$_GET[id_hutangpel]';");
$data2=mysql_fetch_array($sql2);
$sisa=$data['nominal']-$data2['jumlah'];
mysql_query("UPDATE hutangpelanggan SET sisa='$sisa' where id_hutangpel='$_GET[id_hutangpel]';");
?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Angsuran
        <small>Dari Supplier</small>
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
                  <input type="hidden" name="id_angsuranpel" class="form-control" value="<?php echo $kodeangsuranpel; ?>">
                  <input type="hidden" name="id_hutangpel" class="form-control" value="<?php echo $_GET['id_hutangpel'] ?>">
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

  $save=mysql_query("INSERT INTO angsuranpelanggan VALUES('$kodeangsuranpel','$_POST[id_hutangpel]','$tgl','$_POST[angsuran]')");
  


  if($save) {
  echo"<script language=javascript>
        window.location='?p=detailpelanggan&id_hutangpel=".$_POST['id_hutangpel']."';
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
                  <label>Nama</label>
                </div>
                <div class="col-xs-2">
                  <input type="text" value="<?php echo $data['namapel'] ?>" class="form-control" readonly>
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
                    $query=mysql_query("SELECT * FROM angsuranpelanggan WHERE id_hutangpel='$_GET[id_hutangpel]' order by tanggal desc");
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
