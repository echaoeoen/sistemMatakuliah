<?php

/**
* 
*/
include_once("database.php");
class sks extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("sks");
		$this->set_order("sksId asc");
	}
}