<?php

/**
 * Slouží pro práci s databází. Zajišťuje veškerou komunikaci, připojování i
 * odpojování od databáze.
 *
 * @author Petr Kukrál
 */

class Model_db {
	/* server například localhost */
	private $host;
	/* jméno databáze */
	private $dbname;
	/* uživatelské jméno pod kterým se přihlásíte do databáze */
	private $user;
	/* heslo uživatele pro připojení k databázi */
	private $password;
	/* id konkrétního připojení do databáze */
	private $id_connect;
	/* výsledná data - řádky - z databáze */
	private $rows;
	/* jediná instance této třídy podle modelu jedináček */
	private static $instance = NULL;

	/**
	 * privátní konstruktor podle modelu jedináček 
	 */
	private function __construct()
	{
	}
	
	/**
	 * statická metoda pro vrácení instance třídy
	 * 
	 * @return instance této třídy
	 */
	
	public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new self();
			self::$instance->rows = NULL;
        }
        return self::$instance;
    }
	
	/**
	 * setter pro nastavování parametrů třídy
	 * 
	 * @param host server například localhost
	 * @param dbname jméno databáze
	 * @param uživatelské jméno pod kterým se přihlásíte do databáze
	 * @param heslo uživatele pro připojení k databázi
	 */
	public function setParam($host, $dbname, $user, $password)
	{
		$this->host = $host;
		$this->dbname = $dbname;
		$this->user = $user;
		$this->password = $password;
	}
	
	/**
	 * metoda sloužící k provádění dotazů
	 * 
	 * @param query konkrétní dotaz např. SELECT...
	 * @return výsledek dotazu, nutno použít fetch pro vrácení řádků v objektu
	 */
	public function query($query)
	{
	    $this->connect();
	    
	    $this->rows = mysql_query($query,  $this->id_connect);
		
		if (!$this->rows) 
			die("Nepodaril se poslat SQL dotaz do databaze." . $query);
		
	    $this->disconnect();
		
		return $this;
	}
	
	/**
	 * metoda obalující funkci mysql_fetch_object()
	 */
	
	public function fetch()
	{
		return mysql_fetch_object($this->rows);
	}
	
	/**
	 * předáví výsledky z databáze do formátu JSON
	 * 
	 * @return data z databáze ve formátu JSON
	 */
	
	public function getJSON()
	{
		$rs = array();
		while($rs[] = mysql_fetch_assoc($this->rows)) {
		   // zde se skutečně nemá nic dělat
		}
		return json_encode($rs);
	}
	
	/**
	 * slouží pro připojení k databázi
	 */

	private function connect()
	{
		$this->id_connect = mysql_connect($this->host,$this->user,$this->password);

		mysql_select_db($this->dbname,$this->id_connect);
	}
	
	/**
	 * slouží k odpojení od databáze
	 */
	
	private function disconnect()
	{
		mysql_close($this->id_connect);
	}
    
}

?>
