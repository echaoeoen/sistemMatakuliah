
    <style type="text/css">

</style>
<div class="ui menu">
  <div class="item">
    <img style="height:50px" src="<?php echo base_url("public/images/logo.png") ?>">
  </div>
  <div class="item">
      <h1>Sistem Jadwal</h1>
  </div>

</div>

<div class=" successSignup ui two column centered grid">
    <div class="column">
      <form method="post" action="<?php echo site_url("administrator/process") ?>" class="ui form segment">
      <div class="field">
        <label>Username</label>
        <div class="ui left icon input">
          <input type="text" name="userName" placeholder="Username">
          <i class="user icon"></i>
        </div>
      </div>
      <div class="field">
        <label>Password</label>
        <div class="ui left icon input">
          <input type="password" name="password" placeholder="Password">
          <i class="lock icon"></i>
        </div>
      </div>
      <button class="ui blue submit button">Login</button>
    </form>
    <div class="ui ignored info attached message">
      <p> <?php if(isset($pesan)) echo $pesan ?></p>
    </div>
    </div>
    <div class="four column centered row">
      <div class="column"></div>
     </div>
    </div>
  </div>
