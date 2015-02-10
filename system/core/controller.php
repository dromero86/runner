<?php


class controller
{
	function __construct()
	{
		
	
	}
	
	public function load($type,$file)
	{
		$o = kernel::load($type,$file);
		
		if( in_array($type ,array('model','library','view')))
		{
		
			$this->$file = $o;
		}
		
	
	}
	

}
