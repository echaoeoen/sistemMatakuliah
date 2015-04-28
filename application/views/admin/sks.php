	<h1>Administrator > SKS</h1>
  <button class="positive ui button" id="btn-Tambah">Tambah SKS</button>
  <table class="ui table">
  <thead>
    <tr>
      <th>Jenis SKS</th>
      <th>Jumlah Jam</th>
      <th>Jumlah SKS</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		foreach ($sks as $key) {
  			echo "
  				<tr>
  					<td id='jenisSks-".$key->sksId."'>".$key->jenisSks."</td>
            <td id='jmlSks-".$key->sksId."'>".$key->jmlSks." SKS</td>
  					<td id='jmlJam-".$key->sksId."'>".$key->jmlJam." Jam</td>
  					<td><a class='positive ui button' onclick=\"updateForm('".$key->sksId."')\">Update</a><a href=\"".site_url("administrator/submitSks/delete/".$key->sksId)."\" class='negative ui button'>Delete</a></td>
  				</tr>
  			";
  		}
  	?>
  </tbody>
</table>
<script type="text/javascript">
  $("#btn-Tambah").on("click",function(){
    $("form").attr("action","<?php echo site_url("administrator/submitSks/simpan") ?>");
    $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
      if($("input[name=jmlSks").val()==""){
        $("input[name=jmlSks]").attr("style","background:#f9acac")
        return false;
      }
      if($("input[name=jmlJam").val()==""){
        $("input[name=jmlJam]").attr("style","background:#f9acac")
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

function updateForm(sksId){
    $("form").attr("action","<?php echo site_url("administrator/submitSks/edit") ?>/"+sksId);
    $("#sksId").val(sksId);
    var jmlJam =$("#jmlJam-"+sksId).html();
    $("input[name=jmlJam]").val(parseInt(jmlJam.replace(" Jam","")));
    var jmlSks =$("#jmlSks-"+sksId).html();
    $("input[name=jmlSks]").val(parseInt(jmlSks.replace(" SKS","")));

    if($("#jenisSks-"+sksId).html()=="TEORI"){
      $("#teori").prop("checked",true);
    }
    else if($("#jenisSks-"+sksId).html()=="PRAKTIKUM"){
      
      $("#praktikum").prop("checked",true);
    }


    
     $('.modal')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
      if($("input[name=jmlSks").val()==""){
        $("input[name=jmlSks]").attr("style","background:#f9acac")
        return false;
      }
      if($("input[name=jmlJam").val()==""){
        $("input[name=jmlJam]").attr("style","background:#f9acac")
        return false;
      }
        $("form").submit();

    }
  })
    .modal('show') ;
}
</script>
  <div class="ui modal" id="modalAdd">
  <i class="close icon"></i>
  <div class="header">
    Data SKS
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitSks/simpan") ?>" class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="sksId" id="sksId">
      <div class="fields">
        <div class="field">
          <div class="ui ">
            <input type="radio" name="jenisSks" id="teori" value="TEORI" checked>
            <label>TEORI</label>
          </div>
        </div>
        <div class="field">
          <div class="ui">
            <input type="radio" name="jenisSks" id="praktikum" value="PRAKTIKUM">
            <label>PRAKTIKUM</label>
          </div>
        </div>
      </div>
      <div class="field">
        <div class="ui input"><input type="number" name="jmlSks" placeholder="Jumlah SKS"></div>
      </div>
      <div class="field">
        <div class="ui input"><input type="number" name="jmlJam" placeholder="Jumlah Jam"></div>
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
