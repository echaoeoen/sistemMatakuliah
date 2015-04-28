	<h1>Administrator > kelas</h1>
  <button class="positive ui button" id="btn-Tambah">Tambah kelas</button>
  <table class="ui table">
  <thead>
    <tr>
      <th>Nama Kelas</th>
      <th>Dosen Wali</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		foreach ($kelas as $key) {
  			echo "
  				<tr>
            <td id='namaKelas-".$key->kelasId."'>".$key->namaKelas."</td>
            <td ><div id='dosenId-".$key->kelasId."' style='display:none'>".$key->dosenId."</div>".$key->nama."</td>
  					<td><a class='positive ui button' onclick=\"updateForm('".$key->kelasId."')\">Update</a><a href=\"".site_url("administrator/submitKelas/delete/".$key->kelasId)."\" class='negative ui button'>Delete</a></td>
  				</tr>
  			";
  		}
  	?>
  </tbody>
</table>
<script type="text/javascript">
  $("#btn-Tambah").on("click",function(){
    $("form").attr("action","<?php echo site_url("administrator/submitkelas/simpan") ?>");
      $("input[name=namaKelas]").val("");
    $("select[name=dosenWali]").val("");
    $(".text").html("Pilih Dosen Wali: ");
    $(".text").addClass("default");
    $(".item").removeClass("active");
    $(".item").removeClass("selected");
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
      if($("input[name=namaKelas").val()==""){
        $("input[name=namaKelas]").attr("style","background:#f9acac");
        return false;
      }
      if($("select[name=dosenWali").val()==""){
        $("select[name=dosenWali]").attr("style","background:#f9acac");
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
var listDosen = <?php echo json_encode($dosen) ?>;
function getDosen(dosenId){
  for (var i = listDosen.length - 1; i >= 0; i--) {
    if(listDosen[i].dosenId == dosenId)
      return listDosen[i];
  };
  return false;
}
function updateForm(kelasId){
    $("form").attr("action","<?php echo site_url("administrator/submitkelas/edit") ?>/"+kelasId);
    $("#kelasId").val(kelasId);
    $("input[name=namaKelas]").val($("#namaKelas-"+kelasId).html());
    $("#opt-"+$("#dosenId-"+kelasId).html()).prop("selected",true);
    $("select[name=dosenWali]").val($("#dosenId-"+kelasId).html());
    var dosen = getDosen($("select[name=dosenWali]").val());
    $(".text").html(dosen.kodeDosen+" - "+dosen.nama);
    $(".text").removeClass("default");
    $("div[data-value="+ $("select[name=dosenWali]").val()+"]").addClass("active");
    $("div[data-value="+ $("select[name=dosenWali]").val()+"]").addClass("selected");
    
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
     if($("input[name=namaKelas").val()==""){
        $("input[name=namaKelas]").attr("style","background:#f9acac");
        return false;
      }
      if($("select[name=dosenWali").val()==""){
        $("select[name=dosenWali]").attr("style","background:#f9acac");
        return false;
      }
        $("form").submit();

    }
  })
    .modal('show') ;
}
$(document).ready(function(){
  $("select").dropdown();
});
</script>
  <div class="ui modal" id="modalAdd">
  <i class="close icon"></i>
  <div class="header">
    Form Kelas
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitKelas/simpan") ?>" class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="kelasId" id="kelasId">
     
      <div class="field">
        <div class="ui input"><input type="text" name="namaKelas" placeholder="Nama Kelas"></div>
      </div>
      <div class="field">
        <div class="ui input">
          <select name="dosenWali">
            <option value= "">Pilih Dosen Wali:</option>
            <?php 
            foreach ($dosen as $key) {
              # code...
                echo "<option id='opt-".$key->dosenId."' value='".$key->dosenId."'>".$key->kodeDosen." - ".$key->nama."</option>";
              }
            ?>
          </select>
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
