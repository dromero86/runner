<?php

class runner extends model
{
	public function onlogin($view){ 
	
		$username = $view->get_widget('txtuser')->get_text();
		$password = $view->get_widget('txtpass')->get_text();
		
		echo "{$username} : {$password} \n"; 
		
		
	}
	
 


}
