<?php

/**
* 
*/
include_once("database.php");
class dosen extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("dosen");
		$this->set_order("dosenId asc");
	}
}