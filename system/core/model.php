<?php


class model
{
	public $db=NULL;

	function __construct()
	{
		$this->db = kernel::getCoreInstance('mysql');
	
	}

}
