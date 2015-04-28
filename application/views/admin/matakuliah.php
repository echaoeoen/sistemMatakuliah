 
  <h1>Administrator > Mata Kuliah</h1>
  <button class="positive ui button" id="btn-Tambah">Tambah Mata Kuliah</button>
  <table class="ui table">
  <thead>
    <tr>
      <th>Nama Mata Kuliah</th>
      <th>Jumlah SKS</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      foreach ($mataKuliah as $key) {
        echo "
          <tr>
            <td id='namaMataKuliah-".$key->mataKuliahId."'>".$key->namaMataKuliah."</td>
            <td ><div id='sksId-".$key->mataKuliahId."' style='display:none'>".$key->sksId."</div>".$key->jmlSks." ".$key->jenisSks."</td>
            <td ><a class='positive ui button' onclick=\"updateForm('".$key->mataKuliahId."')\">Update</a><a href=\"".site_url("administrator/submitMataKuliah/delete/".$key->mataKuliahId)."\" class='negative ui button'>Delete</a></td>
          </tr>
        ";
      }
    ?>
  </tbody>
</table>
<script type="text/javascript">
  $("#btn-Tambah").on("click",function(){
    $("form").attr("action","<?php echo site_url("administrator/submitMataKuliah/simpan") ?>");
      $("input[name=namaMataKuliah]").val("");
    $("select[name=sks]").val("");
    $(".text").html("Pilih SKS: ");
    $(".text").addClass("default");
    $(".item").removeClass("active");
    $(".item").removeClass("selected");
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
      if($("input[name=namaMataKuliah").val()==""){
        $("input[name=namaMataKuliah]").attr("style","background:#f9acac");
        return false;
      }
      if($("select[name=sks").val()==""){
        $("select[name=sks]").attr("style","background:#f9acac");
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
var listsks = <?php echo json_encode($sks) ?>;
function getsks(sksId){
  for (var i = listsks.length - 1; i >= 0; i--) {
    if(listsks[i].sksId == sksId)
      return listsks[i];
  };
  return false;
}
function updateForm(mataKuliahId){
    $("form").attr("action","<?php echo site_url("administrator/submitmataKuliah/edit") ?>/"+mataKuliahId);
    $("#mataKuliahId").val(mataKuliahId);
    $("input[name=namaMataKuliah]").val($("#namaMataKuliah-"+mataKuliahId).html());
    $("#opt-"+$("#sksId-"+mataKuliahId).html()).prop("selected",true);
    $("select[name=sks]").val($("#sksId-"+mataKuliahId).html());

    var sks = getsks($("select[name=sks]").val());
    $(".text").html(sks.jmlSks+" - "+sks.jenisSks);
    $(".text").removeClass("default");
    $("div[data-value="+ $("select[name=sks]").val()+"]").addClass("active");
    $("div[data-value="+ $("select[name=sks]").val()+"]").addClass("selected");
    
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
     if($("input[name=namaMataKuliah").val()==""){
        $("input[name=namaMataKuliah]").attr("style","background:#f9acac");
        return false;
      }
      if($("select[name=sks").val()==""){
        $("select[name=sks]").attr("style","background:#f9acac");
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
    Form mataKuliah
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitmataKuliah/simpan") ?>" class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="mataKuliahId" id="mataKuliahId">
     
      <div class="field">
        <div class="ui input"><input type="text" name="namaMataKuliah" placeholder="Nama mataKuliah"></div>
      </div>
      <div class="field">
        <div class="ui input">
          <select name="sks">
            <option value= "">Pilih SKS:</option>
            <?php 
            foreach ($sks as $key) {
              # code...
                echo "<option id='opt-".$key->sksId."' value='".$key->sksId."'>".$key->jmlSks." - ".$key->jenisSks."</option>";
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
