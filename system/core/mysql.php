<?php  

class mysql {

    private $user= config::mysql_user;
    private $pass= config::mysql_pass;
    private $db  = config::mysql_db;
    
    private $link = NULL;

    function __construct()
    {
        $this->link = mysql_connect("localhost",$this->user,$this->pass) or die('No se pudo conectar');
        mysql_select_db($this->db,$this->link) or die('La base no existe');
    }
     
    public function query($str)
    {
        $rdata = new mysql_result();
        
        $rdata->link = $this->link;
        
        $rdata->source = mysql_query($str,$this->link ) or die( $str." - ".mysql_error() );
 
        return $rdata;
    }
    
    function __destruct()
    {
        if(isset($rdata)) if($rdata->link) mysql_close( $rdata->link );
    } 
}    
    
    
    
class mysql_result
{
    public $link;
    public $source;
    
    function result()
    {
        $data = array();
        
        while( $rs = mysql_fetch_assoc($this->source) )
        {
            $o = new stdClass;
            
            foreach($rs as $k=>$v)
            {
                $o->$k = $v;
            }
            
            $data[] = $o;
        }
        
        return $data;
    }
    
}
