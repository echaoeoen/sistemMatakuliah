<?php 
  $kel=array();
  foreach ($kelas as $key) {
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
	<h1>Administrator > Jadwal</h1>
  <button class="positive ui button" id="btn-Tambah">Tambah Jadwal</button><br>
  <div class="ui top attached tabular menu">
    <?php
      foreach ($kelas as $key) {
        echo '<a class="item tabnya" data-tab="tab-'.$key->kelasId.'">'.$key->namaKelas.'</a>';
      }
    ?>
  </div>
   <?php
      foreach ($kelas as $key) {
        ?>
<div class="ui bottom attached segmennya tab segment" data-tab="tab-<?php echo $key->kelasId ?>">
    
  <table class="ui table">
  <thead>
    <tr>
      <th>Waktu</th>
      <th>Hari</th>
      <th>Ruangan</th>
      <th>Dosen</th>
      <th>Kelas</th>
      <th>Mata Kuliah</th>
      <th>Act</th>
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
          <td><a href='".site_url("administrator/submitjadwal/detete/".$k->jadwalId)."' class='negative ui button'>Delete</a></td>
        </tr>
        "
;
      }
    ?>
    <tr>
      <td>
      </td>
    </tr>
  </tbody>
</table>
  </div>

        <?php      }
    ?>

 
<script type="text/javascript">
  $("#btn-Tambah").on("click",function(){
    $("form").attr("action","<?php echo site_url("administrator/submitJadwal/simpan") ?>");
      $("input[name=namajadwal]").val("");
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
     if($("select[name=hari").val()==""){
        $("select[name=hari]").attr("style","background:#f9acac");
        return false;
      }
      else if($("select[name=jam").val()==""){
        $("select[name=jam]").attr("style","background:#f9acac");
        return false;
      }
      else if($("select[name=ruanganId").val()==""){
        $("select[name=ruanganId]").attr("style","background:#f9acac");
        return false;
      }
      else if($("select[name=kelasId").val()==""){
        $("select[name=kelasId]").attr("style","background:#f9acac");
        return false;
      }
      else if($("select[name=mataKuliahId").val()==""){
        $("select[name=mataKuliahId]").attr("style","background:#f9acac");
        return false;
      }
      else if($("select[name=dosenId").val()==""){
        $("select[name=dosenId]").attr("style","background:#f9acac");
        return false;
      }

        $("form").submit();

    }
  })
    .modal('show') ;

  });
  $('.ui input')
  .checkbox()
;
function updateForm(jadwalId){
    $("form").attr("action","<?php echo site_url("administrator/submitjadwal/edit") ?>/"+jadwalId);
    
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {


    }
  })
    .modal('show') ;
}
$(document).ready(function(){
  $('.menu .item')
  .tab()
;
$(".tabnya").first().addClass("active");
$(".segmennya").first().addClass("active");
  $("select[name=hari]").dropdown();
  $("select[name=jam]").dropdown();
  $("select[name=ruanganId]").dropdown();
  $("select[name=kelasId]").dropdown();
  $("select[name=mataKuliahId]").dropdown();
  $("select[name=dosenId]").dropdown({
    onChange:function(value, text, $selectedItem) {
      // custom action
      getMatKul(value);
    }
   
  });
});
function getMatKul(dosenId)
{
   $("#inputMatkul").html("");

    $.ajax({
          url:"<?php  echo site_url("administrator/getMengajar") ?>?dosenId="+dosenId,
          cache:false,
          type:"get",
          data:"",
          success:function(data){
            data = JSON.parse(data);
               var html = "<select id='mataKuliahId' name='mataKuliahId'><option value=''>Pilih Mata Kuliah: </option>";
                for (var i = data.length - 1; i >= 0; i--) {
                   html += "<option value ='"+data[i].mataKuliahId+"'>"+data[i].namaMataKuliah + "</option>";
                };
                html+="</select>";
                $("#inputMatkul").append(html);
                $("#mataKuliahId").dropdown();
             
            
          }
  });
}
</script>
  <div class="ui modal" id="modalAdd">
  <i class="close icon"></i>
  <div class="header">
    Form Jadwal
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitjadwal/simpan") ?>" class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="jadwalId" id="jadwalId">
     <div class="fields">
      <div class="field">
        <div class="ui input">
            <?php 
              $hari = array("Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");          
          ?>
          <select name="ruanganId">
            <option value="">Pilih ruangan :</option>
            <?php 
              foreach ($ruangan as $key) {
                 # code...
                 echo "<option id='opt-".$key->ruanganId."' value='".$key->ruanganId."'>".$key->namaRuangan."</option>";
              } 
               
            ?>
          </select>
        </div>
      </div>
      <div class="field">
       <div class="ui input">
            <?php 
              $waktu = array("06.30","08.30","10.30","12.30","14.30","16.30");          
          ?>

          <select name="hari">
            <option value="">Pilih Hari :</option>
            <?php 
              for($i=0;$i<count($hari);$i++) {

                echo "<option value='".$i."'>".$hari[$i]."</option>";
              }
            ?>
          </select>
        </div>
      </div>
    </div>
      <div class="fields">
      <div class="field">
       <div class="ui input">
          <select name="jam">
            <option value="">Pilih Waktu :</option>
            <?php 
              for($i=0;$i<count($waktu);$i++) {

                echo "<option value='".$waktu[$i]."'>".$waktu[$i]."</option>";
              }
            ?>
          </select>
        </div>
      </div>
       <div class="field">
       <div class="ui input">
          
          <select name="kelasId">
            <option value="">Pilih Kelas :</option>
            <?php 
              foreach ($kelas as $key) {
                 # code...
                 echo "<option id='opt-".$key->kelasId."' value='".$key->kelasId."'>".$key->namaKelas."</option>";
              } 
               
            ?>
          </select>
        </div>
      </div>
    </div>
    <div class="fields">
      
      <div class="field">
       <div class="ui input">
          <select name="dosenId">
            <option value="">Pilih Dosen :</option>
            <?php 
              foreach ($dosen as $key) {
                 # code...
                 echo "<option id='opt-".$key->dosenId."' value='".$key->dosenId."'>".$key->kodeDosen." - ".$key->nama."</option>";
              } 
               
            ?>
          </select>
        </div>
      </div>

      <div class="field" id="mataKuliah">
        <div class="ui input" id="inputMatkul">
          <select name="mataKuliahId">
            <option value="">Pilih Mata Kuliah:</option>
          </select>
        </div>
      </div>
    </div>
    </form>
    

  </div>
  <div class="actions">
    <div class="ui black cancel button">
      Cancel
    </div>
    <button class="ui positive right ok labeled icon button" id="buttonSubmit">
      Simpan
      <i class="checkmark icon"></i>
    </button>
  </div>

</div>
