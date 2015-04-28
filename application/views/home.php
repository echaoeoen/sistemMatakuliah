<!DOCTYPE>
<html lang="en">
<head>
	<title>Online Camera Education - OCE</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("public/semantic/semantic.min.css") ?>">
	<script type="text/javascript" src="<?php echo base_url("public/js/jquery.js") ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("public/semantic/semantic.js") ?>"></script>
	<style type="text/css">
	.shape .side .content .center{
		width: 100%;
	}
	</style>
</head>
<body>

  <?php 
  $kel=array();
  foreach ($kelas as $key) 
  {
    $kel[$key->kelasId]=array();
    $i=0;
    foreach ($jadwal as $keyJadwal) {
      
      if($key->kelasId==$keyJadwal->kelasId){
        $kel[$key->kelasId][$i] = $keyJadwal;
        $i++;
      }
    }
  }
?>

<?php 
	$hari = array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");          
?>

        <div class="ui cube shape">
    <div class="sides">
	<?php
      foreach ($kelas as $key) {
        ?>
      <div class="side">
        <div class="content">
          <div class="center">
              <h1><?php echo $key->namaKelas ?></h1>
  <table class="ui table">
  <thead>
    <tr>
      <th>Waktu</th>
      <th>Hari</th>
      <th>Ruangan</th>
      <th>Dosen</th>
      <th>Kelas</th>
      <th>Mata Kuliah</th>
    </tr>
  </thead>
  <tbody>
    <?php 
      foreach ($kel[$key->kelasId] as $k) {
        $k->jam = str_replace(":00", "", $k->jam);
        echo"
        <tr>
          <td>".$k->jam."</td>
          <td>".$hari[$k->hari]."</td>
          <td>".$k->namaRuangan."</td>
          <td>".$k->kodeDosen." - ".$k->nama."</td>
          <td>".$k->namaKelas."</td>
          <td>".$k->namaMataKuliah."</td>
        </tr>
        ";
      }
    ?>
  </tbody>
</table>
          </div>
        </div>
      </div>

        <?php      }
    ?>

    </div>
  </div>
   </body>
   <script type="text/javascript">

$('.shape').shape();
$('.shape').shape('flip left');
$(document).ready(function(){
   	setInterval(function(){
$('.shape').shape('flip left');
   	},5000);
   });
   </script>