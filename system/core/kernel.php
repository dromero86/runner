<?php
 
class kernel 
{
	public static $App = FALSE;
	
	public static function getCoreInstance($file)
	{
		require_once self::$App->BASEPATH.'core/'.$file.self::$App->EXT;
		
		eval("\$core= new ".$file.";");
		return isset($core) ? $core : FALSE;
		
	}
	
	public static function load($type,$file)
	{
		$folder ="";
	
		switch($type)
		{
			case 'model': 
			
				require_once self::$App->APPPATH.'model/'.$file.self::$App->EXT;
				
				
				eval("\$model= new ".$file.";");
				return isset($model) ? $model : FALSE;
				
			break;
			case 'view' :   
				//compat with gtk3->gtk2 
				$v = file_get_contents(self::$App->APPPATH .'views/'.$file.'.glade');
			
				$v = str_replace('<interface','<glade-interface',$v);
				$v = str_replace('</interface','</glade-interface',$v);
				$v = str_replace('<object','<widget',$v);
				$v = str_replace('</object','</widget',$v);
				
				return GladeXML::new_from_buffer($v); 
			
			
			break;
			
		}
	}
	
	public function build()
	{ 

		require self::$App->BASEPATH.'core/controller'.self::$App->EXT; 
		require self::$App->BASEPATH.'core/model'.self::$App->EXT; 
		
		require self::$App->APPPATH.'config/config'.self::$App->EXT;

		require self::$App->APPPATH.'controller/'.config::default_controller.self::$App->EXT;

		eval("\$controller = new ".config::default_controller.";");
		eval("\$controller->".config::default_method."();");
	
	}

} 
 

