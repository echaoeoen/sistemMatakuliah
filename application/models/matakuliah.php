<?php

/**
* 
*/
include_once("database.php");
class matakuliah extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("matakuliah");
		$this->set_order("matakuliahId asc");
	}
}