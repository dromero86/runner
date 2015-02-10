<?php

class main extends controller {


	public function index()
	{
		$this->load('view','login');
		$this->load('model','runner');
		
		$window = $this->login->get_widget('winLogin');
		$window->set_title('Ingresar');
		$window->connect_simple('destroy', array('Gtk', 'main_quit'));
		 
		$btnClose = $this->login->get_widget('btnclose');
		$btnClose->connect_simple('clicked', 'gtk::main_quit');
		
		$btnLogin = $this->login->get_widget('btnlogin');
		$btnLogin->connect_simple('clicked', array($this->runner, 'onlogin'), $this->login );
 

		$window->show_all();
		Gtk::main();
 
	} 

}
