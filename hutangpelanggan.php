<?php
include "connect.php";

$query=mysql_query("SELECT max(id_hutangpel) as maxKode FROM hutangpelanggan");
$data=mysql_fetch_array($query);
$id_hutangpel = $data['maxKode'];

$nourut = (int) substr($id_hutangpel, 3, 3);
$nourut++;

$kode = "HP";
$kodehutangpel = $kode . sprintf("%03s", $nourut);

?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Hutang
        <small>Dari Supplier</small>
      </h1>
    </section>

    <section class="content">
  <div class="row">
      <div class="col-xs-12">
       <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Hutang Supplier</h3>
            </div>
            <!-- form start -->
            <form class="form-horizontal" method="POST">
              <div class="box-body">
                <div class="form-group">

                  <label  class="col-sm-4 control-label">Nama</label>

                  <div class="col-sm-6">
                    <input type="hidden" name="id_hutangpel" class="form-control" value="<?php echo $kodehutangpel; ?>">
                    <input type="text" name="namapel" class="form-control"  placeholder="Nama">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label">Alamat</label>

                  <div class="col-sm-6">
                    <textarea name="alamat" class="form-control" placeholder="Alamat"></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label">No. Telepon</label>

                  <div class="col-sm-6">
                    <input type="text" name="notelp" class="form-control" placeholder="Telepon">
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

  $save=mysql_query("INSERT INTO hutangpelanggan VALUES('$kodehutangpel','$_POST[namapel]','$_POST[alamat]','$_POST[notelp]','$tgl','$_POST[ket]','$_POST[nominal]','$_POST[nominal]')");

  if($save) {
  echo"<script language=javascript>
        window.location='?p=hutangpelanggan';
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
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Nominal Hutang</th>
                  <th>Sisa Hutang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $query=mysql_query("SELECT * FROM hutangpelanggan order by tanggal desc");
                    while ($data=mysql_fetch_array($query)) {
                      $nominal=$data['nominal'];
                      $sisa=$data['sisa'];
                  ?>

                <tr>
                  <td><?php echo $data['id_hutangpel'];?></td>
                  <td><?php echo $data['namapel'];?></td>
                  <td><?php echo $data['alamat'];?></td>
                  <td><?php echo $data['notelp'];?></td>
                  <td><?php echo $data['tanggal'];?></td>
                  <td><?php echo $data['ket'];?></td>
                  <td><?php echo "Rp. ".number_format($nominal,0,"",'.').",-"?></td>
                  <td><?php echo "Rp. ".number_format($sisa,0,"",'.').",-"?></td>
                  <td>
                    <a href="?p=detailpelanggan&id_hutangpel=<?php echo $data['id_hutangpel']; ?>"><button type="submit" class="btn btn-primary" title="Lihat Angsuran">Angsuran</button></a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Telepon</th>
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
