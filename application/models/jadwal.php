<?php

/**
* 
*/
include_once("database.php");
class jadwal extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("jadwal");
		$this->set_order("jadwalId asc");
	}
}