<?php

/**
 * Slouží pro práci s databází. Zajišťuje veškerou komunikaci, připojování i
 * odpojování od databáze.
 *
 * @author Petr Kukrál
 */

class BookingSystemDatabase {
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
	    $this->rows = mysql_query($query,  $this->id_connect);
		
		if (!$this->rows) 
			die("Nepodaril se poslat SQL dotaz do databaze." . $query);
		
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

	public function connect()
	{
		$this->id_connect = mysql_connect($this->host,$this->user,$this->password);

		if (!$this->id_connect) {
			die('Připojení se nezdařilo: ' . mysql_error());
		}
		
		$db_selected = mysql_select_db($this->dbname,$this->id_connect);
		
		if (!$db_selected) {
			die ('Nezdařilo se připojení databázi: ' . mysql_error());
		}
	}
	
	/**
	 * slouží k odpojení od databáze
	 */
	
	public function disconnect()
	{
		mysql_close($this->id_connect);
	}
	
	/* ochrana proti SQL injection */

	function gpc_addslashes($str) {
		return (get_magic_quotes_gpc() ? $str : addslashes($str));
	}
	
	/* metody pro konkretni nacitani dat z databaze */
	
	/**
	 * nacteni vstupu ze souboru
	 * 
	 * @param input id souboru, ze kterého se má načítat rozmístění sedadel
	 * @return jméno souboru, ze kterého se má načítat rozmístění sedadel
	 */
	
	public function loadInputFromFile($input)
	{
		$input = $this->gpc_addslashes($input);
		
		return $this->query("SELECT file FROM " . TABLE_PLACES . " WHERE id=" . $input)
					->fetch()
					->file;
	}
	
	/**
	 * nacteni vstupu z databáze, vrací formát JSON
	 * 
	 * @param place označuje id sálu
	 * @return sedadla v sále ve formátu JSON
	 */
	
	public function loadAllSeatsFromDatabaseJSON($place)
	{
		$place = $this->gpc_addslashes($place);
		
		return $this->query("SELECT serie, type FROM " . TABLE_INPUT_ELEMENTS_FOR_JSON . " WHERE id_place=" . $place)
					->getJSON();
	}
	
	/**
	 * vraci rezervovaná sedadla v sále
	 * 
	 * @param place označuje id sálu
	 * @return sedadla v sále
	 */
	
	public function loadReservedSeatsFromDatabase($place)
	{
		$place = $this->gpc_addslashes($place);
		
		return $this->query("SELECT * FROM " . TABLE_RESERVED_ELEMENTS . " WHERE id_place=" . $place );
	}
	
	/**
	 * rezervace sedadla
	 * 
	 * @param id_place označuje id sálu
	 * @param id_user označuje id uživatele, na kterého se má sedadlo zarezervovat
	 * @param serie označuje id série sedadel
	 * @param seat označuje číslo sedadla
	 */
	
	public function bookSeats($id_place, $id_user, $serie, $seat)
	{
		$id_place = $this->gpc_addslashes($id_place);
		$id_user = $this->gpc_addslashes($id_user);
		$serie = $this->gpc_addslashes($serie);
		$seat = $this->gpc_addslashes($seat);
		
		$this->query("
			INSERT INTO " . TABLE_RESERVED_ELEMENTS . " (id_place, id_user, serie_number, element_number)
			VALUES (" . $id_place . "," . $id_user . "," . $serie . ",". $seat ." );
		");
	}
	
	/**
	 * vrátí rezervovaná sedadla daného uživatele
	 * 
	 * @param id_user označuje id uživatele, na kterého je sedadlo zarezervováno
	 * @return sedadla které má daný uživatel zarezervovaný
	 */
	
	public function userReservedSeats($id_user)
	{
		$id_user = $this->gpc_addslashes($id_user);
		
		return $this->query("SELECT * FROM " . TABLE_RESERVED_ELEMENTS . " WHERE id_user = '" . $id_user . "'");
	}
	
	/**
	 * přihlášení
	 * 
	 * @param email email daného uživatele
	 * @param password heslo uživatele
	 * @return uživatel, jestli existuje
	 */
	
	public function signIn($email, $password)
	{
		$email = $this->gpc_addslashes($email);
		$password = $this->gpc_addslashes($password);
		
		return $this->query("SELECT id FROM ". TABLE_USERS . " WHERE email = '" . $email . "' AND password = '" . md5($password) . "'")
					->fetch();
	}
	
	/**
	 * registrace
	 * 
	 * @param email email daného uživatele
	 * @param password heslo uživatele
	 */
	
	public function registration($email, $password)
	{
		$email = $this->gpc_addslashes($email);
		$password = $this->gpc_addslashes($password);
		
		return $this->query(
				"INSERT INTO " . TABLE_USERS .  " (email, password) VALUES ('" 
				. $email . "', '" . md5($password) . "')"
				);
	}
	
	/**
	 * vrací promítané filmy
	 * 
	 * @return promítané filmy
	 */
	
	public function loadMoves()
	{		
		return $this->query("SELECT * FROM " . TABLE_PLAYING_MOVIES);
	}
	
	/**
	 * vrací název filmu
	 * 
	 * @return název filmu
	 */
	
	public function getNameMovie($id_movie)
	{		
		$id_movie = $this->gpc_addslashes($id_movie);
		
		return $this->query("SELECT * FROM " . TABLE_MOVIES . "WHERE id=" . $id_movie);
	}
	
	/**
	 * zrušení rezervace
	 * 
	 * @param id_element id elementu, který se má smazat
	 */
	
	public function cancelReservation($id_element)
	{	
		$id_element = $this->gpc_addslashes($id_element);
		
		return $this->query("DELETE FROM " . TABLE_RESERVED_ELEMENTS . " WHERE id = '" . $id_element . "'");
	}
    
}

?>
