<?php

/**
* 
*/
include_once("database.php");
class ruangan extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("ruangan");
		$this->set_order("ruanganId asc");
	}
}