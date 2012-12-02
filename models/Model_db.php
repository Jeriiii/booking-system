<?php

/**
 * Description of Model_db
 *
 * @author Petr Kukrál
 */

class Model_db {
	
	private $host;
	private $dbname;
	private $user;
	private $password;
	private $id_connect;
	private $rows;
	private static $instance = NULL;

	private function __construct()
	{
	}
	
	public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new self();
			self::$instance->rows = NULL;
        }
        return self::$instance;
    }
	
	public function setParam($host, $dbname, $user, $password)
	{
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->password = $password;
	}
	
	public function query($query)
	{
	    $this->connect();
	    
	    $this->rows = mysql_query($query,  $this->id_connect);
		
		if (!$this->rows) 
			die("Nepodaril se poslat SQL dotaz do databaze.");
		
	    $this->disconnect();
		
		return $this;
	}
	
	public function fetch()
	{
		return mysql_fetch_object($this->rows);
	}
	
	public function getJSON()
	{
		$rs = array();
		while($rs[] = mysql_fetch_assoc($this->rows)) {
		   // you don´t really need to do anything here.
		}
		return json_encode($rs);
	}

	private function connect()
	{
		$this->id_connect = mysql_connect($this->host,$this->user,$this->password);

		mysql_select_db($this->dbname,$this->id_connect);
	}
	
	private function disconnect()
	{
		mysql_close($this->id_connect);
	}
    
}

?>
