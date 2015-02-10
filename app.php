#!/usr/bin/php -c/etc/php5/cli/gtk.ini
<?php

/**
 * @file 
 * All Runner code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */

	class Application
	{
	
		public $ENV 		= "DEV";
		public $APP_FOLDER 	= "application";
		public $SYS_FOLDER 	= "system";  
		public $OWN			= "";
		public $BASEPATH 	= "";
		public $FCPATH 		= "";
		public $SYSDIR		= "";
		public $APPPATH		= "";
		
		public $EXT = ".php";
		
		
		public function build()
		{  
		
			if (realpath($this->SYS_FOLDER) !== FALSE)
			{
				$this->SYS_FOLDER  = realpath($this->SYS_FOLDER).'/';
			}
			  
			// ensure there's a trailing slash
			$this->SYS_FOLDER = rtrim($this->SYS_FOLDER, '/').'/';
			 
			
			// Is the system path correct?
			if ( ! is_dir( $this->SYS_FOLDER ) )
			{
				exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
			}
			 
			// The name of THIS file
			$this->OWN = pathinfo(__FILE__, PATHINFO_BASENAME);
 
			$this->BASEPATH = str_replace("\\", "/", $this->SYS_FOLDER);

			// Path to the front controller (this file)
			$this->FCPATH = str_replace($this->OWN, '', __FILE__);

			// Name of the "system folder"
			$this->SYSDIR= trim(strrchr(trim($this->BASEPATH, '/'), '/'), '/');


			// The path to the "application" folder
			if (is_dir($this->APP_FOLDER))
			{
				$this->APPPATH = $this->APP_FOLDER.'/';
			}
			else
			{
				if ( ! is_dir($this->BASEPATH.$this->APP_FOLDER.'/'))
				{
					exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".$this->OWN);
				}

				$this->APPPATH = $this->BASEPATH.$this->APP_FOLDER.'/';
			}
			
			$kernel = $this->BASEPATH.'core/kernel.php';
			
			return file_exists($kernel); 
				//exit("Your kernel folder path does not appear to be set correctly.");	
		}
		 
	}
	
	
	$Application = new Application();
	if( $Application->build() )
	{
		require_once $Application->BASEPATH.'core/kernel.php';
		
		$kernel = new kernel();
		$kernel::$App = $Application;
		$kernel->build();
	}	

