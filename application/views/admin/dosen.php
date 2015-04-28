	<h1>Administrator > Dosen</h1>
  <button class="positive ui button" id="btn-Tambah">Tambah Dosen</button>
  <table class="ui table">
  <thead>
    <tr>
      <th>Kode Dosen</th>
      <th>NIDN</th>
      <th>Nama Dosen</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		foreach ($dosen as $key) {
  			echo "
  				<tr>
  					<td id='kodeDosen-".$key->dosenId."'>".$key->kodeDosen."</td>
            <td id='NIDN-".$key->dosenId."'>".$key->NIDN."</td>
  					<td id='namaDosen-".$key->dosenId."'>".$key->nama."</td>
  					<td><a onClick = 'manageMataKuliah(\"".$key->dosenId."\")' class='positive ui button'>Atur Matakuliah</a><a class='positive ui button' onclick=\"updateForm('".$key->dosenId."')\">Update</a><a href=\"".site_url("administrator/submitDosen/delete/".$key->dosenId)."\" class='negative ui button'>Delete</a></td>
  				</tr>
  			";
  		}
  	?>
  </tbody>
</table>
<script type="text/javascript">
var res= false;
function setRes(req){
  res = req;
}
function getRes(){return res}
function checkNIDNDosen(dosenId){
  res=false;
  var nidn = $("input[name=NIDN]").val();
  $.ajax({
    async:false,
    type:"get",
    cache:false,
    url:"<?php echo site_url("administrator/cekNIDNDosen") ?>?NIDN="+nidn+"&dosenId="+dosenId,
    data:"",
    success:function(data){
      if(data=="true")
        setRes(true);
      else
        setRes(false)
    }
  });
  return res;
}

function checkKodeDosen(dosenId){
  res=false;
  var kodeDosen = $("input[name=kodeDosen]").val();

  $.ajax({  
    async:false,
    type:"get",
    cache:false,
    url:"<?php echo site_url("administrator/cekKodeDosen") ?>?kodeDosen="+kodeDosen+"&dosenId="+dosenId,
    data:"",
    success:function(data){

      if(data=="true")
        setRes(true);
      else
        setRes(false);
    }
  });
  return res;

}
  $("#btn-Tambah").on("click",function(){
    $("form").attr("action","<?php echo site_url("administrator/submitDosen/simpan") ?>");
     $("#dosenId").val("");
    $("input[name=NIDN]").val("");
    $("input[name=nama]").val("");
    $("input[name=kodeDosen]").val("");
    $('#modalAdd')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {

      if($("input[name=kodeDosen]").val()==""){
        $(".error").html("Kode Dosen harus di isi");
        return false;  
      }
      else if($("input[name=NIDN]").val()==""){

        $(".error").html("NIDN harus di isi");
        return false;
      }
      else if($("input[name=nama]").val()==""){
        $(".error").html("Nama harus di isi");
        return false;
      }
      else if(!checkKodeDosen("")){
        $(".error").html("Kode dosen sudah ada");
        return false;
      }
      else if(!checkNIDNDosen("")){
        $(".error").html("NIDN sudah ada");
        return false;
      }
      else
        $("#form").submit();

    }
  })
    .modal('show') ;

  });
  $('.ui input')
  .checkbox()
;

function updateForm(dosenId){
    $("#form").attr("action","<?php echo site_url("administrator/submitDosen/edit") ?>/"+dosenId);
    $("#dosenId").val(dosenId);
    $("input[name=NIDN]").val($("#NIDN-"+dosenId).html());
    $("input[name=nama]").val($("#namaDosen-"+dosenId).html());
    $("input[name=kodeDosen]").val($("#kodeDosen-"+dosenId).html());
    
     $('#modalAdd')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
     
      if($("input[name=kodeDosen]").val()==""){
        $(".error").html("Kode Dosen harus di isi");
        return false;  
      }
      else if($("input[name=NIDN]").val()==""){

        $(".error").html("NIDN harus di isi");
        return false;
      }
      else if($("input[name=nama]").val()==""){
        $(".error").html("Nama harus di isi");
        return false;
      }
      else if(!checkKodeDosen(dosenId)){
        $(".error").html("Kode dosen sudah ada");
        return false;
      }
      else if(!checkNIDNDosen(dosenId)){
        $(".error").html("NIDN sudah ada");
        return false;
      }
      else
        $("#form").submit();
    }
  })
    .modal('show') ;
}
var jlm = 0;
var listMatakuliah = <?php echo json_encode($matakuliah) ?>;
function tambahBaris(){
  var html = "<tr id='baris-"+jlm+"'><td><select id='sel-"+jlm+"' name='mataKuliahId[]'><option value=''>Pilih Mata Kuliah: </option>";
  for (var i = listMatakuliah.length - 1; i >= 0; i--) {
   html += "<option value ='"+listMatakuliah[i].mataKuliahId+"'>"+listMatakuliah[i].namaMataKuliah + "</option>";
  };
  html+="</select></td><td><a class='ui positive button' onclick='hapusBaris(\""+jlm+"\")'>-</a></td></tr>";
  $("#baris").append(html);
  $("#sel-"+jlm).dropdown();
  jlm++;
}
function hapusBaris(baris){
  $("#baris-"+baris).remove();  
}
function manageMataKuliah(dosenId){
  $("#baris").html("");
    $("#form-mangajar").attr("action","<?php echo site_url("administrator/submitDosen/inputMengajar") ?>/"+dosenId);
    $.ajax({
      url:"<?php  echo site_url("administrator/getMengajar") ?>?dosenId="+dosenId,
      cache:false,
      type:"get",
      data:"",
      success:function(data){
        data = JSON.parse(data);
        for (var x =0; x <  data.length ; x++) {
           var html = "<tr id='baris-"+jlm+"'><td><select id='sel-"+jlm+"' name='mataKuliahId[]'><option value=''>Pilih Mata Kuliah: </option>";
            for (var i = listMatakuliah.length - 1; i >= 0; i--) {
              sel='';
              if(data[x].mataKuliahId==listMatakuliah[i].mataKuliahId)
                sel="selected";
             html += "<option "+sel+" value ='"+listMatakuliah[i].mataKuliahId+"'>"+listMatakuliah[i].namaMataKuliah + "</option>";
            };
            html+="</select></td><td><a class='ui positive button' onclick='hapusBaris(\""+jlm+"\")'>-</a></td></tr>";
            $("#baris").append(html);
            $("#sel-"+jlm).dropdown();
            jlm++;
        };
      }
    });
    $('#modalMengajari')
    .modal({
    closable  : false,
    onDeny    : function(){
    },
    onApprove : function() {
      $("#form-mangajar").submit();
    }
  })
    .modal('show') ;
}
</script>
  <div class="ui modal" id="modalAdd">
  <i class="close icon"></i>
  <div class="header">
    Form Dosen
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitDosen/simpan") ?>" id="form"class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="dosenId" id="dosenId">
      
      <div class="field">
        <div class="ui input"><input type="text" name="kodeDosen" placeholder="Kode Dosen"></div>
      </div>
      <div class="field">
        <div class="ui input"><input type="text" name="NIDN" placeholder="NIDN"></div>
      </div>
      <div class="field">
        <div class="ui input"><input type="text" name="nama" placeholder="Nama Lengkap"></div>
      </div>
    </form>
  <p class="error"></p>    

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
 <div class="ui modal" id="modalMengajari">
  <i class="close icon"></i>
  <div class="header">
    Dosen Mengajari
  </div>
  <div class="content">
    <form method="post" action="<?php echo site_url("administrator/submitDosen/inputMengajar") ?>" id="form-mangajar" class="ui form" id="formSignUp">
      <input type="hidden" style="display:none" name="dosenId" id="dosenId">
      
     <table >
      <thead><tr><td>Mata kuliah yang diajar</td><td></td></tr></thead>
      <tbody id="baris"></tbody>
    </table>

    </form>
     <button class="ui positive right ok labeled icon button" onClick="tambahBaris()">
      Tambah
      <i class="checkmark icon"></i>
    </button>
  <p class="error"></p>    

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

