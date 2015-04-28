<!DOCTYPE>
<html lang="en">
<head>
	<title>Online Camera Education - OCE</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url("public/semantic/semantic.min.css") ?>">
	<script type="text/javascript" src="<?php echo base_url("public/js/jquery.js") ?>"></script>
	<script type="text/javascript" src="<?php echo base_url("public/semantic/semantic.js") ?>"></script>
	
</head>
<body>

	<div class="ui menu">
		<div class="item">Sistem Jadwal</div>
		<a class="item right" href="<?php echo site_url("administrator/logout") ?>">Logout</a>
	</div>
	<div class="ui grid">
		<div class="three wide column">
			<div class="ui vertical menu">
				<a href="<?php echo site_url("administrator/") ?>" class="item">
					<i class="home icon"></i>Home
				</a>
				<a  href="<?php echo site_url("administrator/kelas") ?>" class="item" >
					<i class="inbox icon"></i>Kelas
				</a>
				<a href="<?php echo site_url("administrator/dosen") ?>" class="item" >
					<i class="user icon"></i>Dosen
				</a>
				<a href="<?php echo site_url("administrator/ruangan") ?>" class="item" >
					<i class="block layout icon"></i>Ruangan
				</a>
				<a href="<?php echo site_url("administrator/jadwal") ?>" class="item" >
					<i class="calendar icon"></i>Jadwal
				</a>
				<a href="<?php echo site_url("administrator/sks") ?>" class="item" >
					<i class="calendar icon"></i>SKS
				</a>
				<a href="<?php echo site_url("administrator/matakuliah") ?>" class="item" >
					<i class="calendar icon"></i>Mata Kuliah
				</a>
			</div>
		</div>
		<div class="twelve wide column">
			<?php 
				$this->load->view($page)
			?>
		</div>
	</div>
</body>