<?php

/**
* 
*/
include_once("database.php");
class kelas extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("kelas");
		$this->set_order("kelasId asc");
	}
}