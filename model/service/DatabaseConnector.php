<?php
/*
 * File: model/service/DatabaseConnector.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */

/**
 * Abstrakte Datenbank Verbindungsklasse
 * <p>
 * Subklasse stellt Verbindung mit Datenbank-Typ her (z.B. MySQLConnector, SQLiteConnector..)
 * </p>
 * 
 * @author Heiko Dreyer
 *
 */
abstract class DatabaseConnector
{		
	/**
	 * Id zur DB Verbindung
	 * 
	 * @var int
	 */
	protected $linkId;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{	
		// Template Methoden
		$this->linkId = $this->connect();
	}
	
	/**
	 * Mit der Datenbank verbinden
	 * und Verbindungs-ID zurückgeben.
	 * 
	 * @return int
	 */
	protected abstract function connect();	
	
	/**
	* Setter
	*
	* @param string $linkId
	* @return void
	*/
	public function setLinkId($linkId)
	{
		$this->linkId = $linkId;
	}
	
	/**
	* Getter
	*
	* @return string
	*/
	public function getLinkId()
	{
		return $this->linkId;
	}
}

/*
 * File: model/DatabaseConnector.php
 *  
 *  Autor		: Heiko Dreyer
 *  eMail		: mail@boxedfolder.com
 *  Datum		: 11.07.2010
 *
 */
?>