	<h1>Administrator > Ruangan</h1>
  <button class="positive ui button" id="btn-Tambah">Tambah Ruangan</button>
  <table class="ui table">
  <thead>
    <tr>
      <th>Nama Ruangan</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		foreach ($ruangan as $key) {
  			echo "
  				<tr>
            <td id='namaRuangan-".$key->ruanganId."'>".$key->namaRuangan."</td>
         		<td><a class='positive ui button' onclick=\"updateForm('".$key->ruanganId."')\">Update</a><a href=\"".site_url("administrator/submitRuangan/delete/".$key->ruanganId)."\" class='negative ui button'>Delete</a></td>
  				</tr>
  			";
  		}
  	?>
  </tbody>
</table>
<script type="text/javascript">
  $("#btn-Tambah").on("click",function(){
    $("form").attr("action","<?php echo site_url("administrator/submitRuangan/simpan") ?>");
      $("input[name=namaRuangan]").val("");
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
      if($("input[name=namaRuangan").val()==""){
        $("input[name=namaRuangan]").attr("style","background:#f9acac");
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

function updateForm(ruanganId){
    $("form").attr("action","<?php echo site_url("administrator/submitRuangan/edit") ?>/"+ruanganId);
    $("#ruanganId").val(ruanganId);
    $("input[name=namaRuangan]").val($("#namaRuangan-"+ruanganId).html());
    
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
     if($("input[name=namaRuangan").val()==""){
        $("input[name=namaRuangan]").attr("style","background:#f9acac");
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
    Form Ruangan
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitRuangan/simpan") ?>" class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="ruanganId" id="ruanganId">
     
      <div class="field">
        <div class="ui input"><input type="text" name="namaRuangan" placeholder="Nama Ruangan"></div>
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
