<?php

/**
* 
*/
include_once("database.php");
class user extends database
{
	
	function __construct()
	{
		parent::__construct();
		$this->set_table("user");
		$this->set_order("userId asc");
	}
}