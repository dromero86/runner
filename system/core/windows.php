<?php

class windows
{
	public static function MsgBox($title, $message)
	{
		$wnd = new GtkWindow();
		$wnd->set_title($title);
		$wnd->show_all();
		
		$dialog = new GtkMessageDialog($wnd, Gtk::DIALOG_MODAL,  Gtk::MESSAGE_ERROR, Gtk::BUTTONS_OK, $title);
        $dialog->set_markup($message);
        $dialog->run();
        $dialog->destroy();
		
	}


}
  
