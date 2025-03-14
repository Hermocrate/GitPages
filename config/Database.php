<?php

/**
 * @remark Mettre le bon chemin d'accès à votre fichier contenant les constantes
 */
require_once 'ConnectionParam.php';

/**
 * @brief	Helper class encapsulating
 * 			the PDO object
 * @remark	
 */
class Database
{
	private static $objInstance;
	/**
	 * @brief	Class Constructor - Create a new database connection if one doesn't exist
	 * 			Set to private so no-one can create a new instance via ' = new EDatabase();'
	 */
	private function __construct()
	{
	}
	/**
	 * @brief	Like the constructor, we make __clone private so nobody can clone the instance
	 */
	private function __clone()
	{
	}
	/**
	 * @brief	Returns DB instance or create initial connection
	 * @return $objInstance;
	 */
	public static function getInstance()
	{
		if (!self::$objInstance) {
			try {

				$dsn = ConnectionParam::EDB_DBTYPE . ':host=' . ConnectionParam::EDB_HOST . ';port=' . ConnectionParam::EDB_PORT . ';dbname=' . ConnectionParam::EDB_DBNAME . ';charset=utf8' ;
				self::$objInstance = new PDO($dsn, ConnectionParam::EDB_USER, ConnectionParam::EDB_PASS);
				self::$objInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "EDatabase Error: " . $e;
			}
		}
		return self::$objInstance;
	} # end method
	/**
	 * @brief	Passes on any static calls to this class onto the singleton PDO instance
	 * @param 	$chrMethod		The method to call
	 * @param 	$arrArguments	The method's parameters
	 * @return 	$mix			The method's return value
	 */
	final public static function __callStatic($chrMethod, $arrArguments)
	{
		$objInstance = self::getInstance();
		return call_user_func_array(array($objInstance, $chrMethod), $arrArguments);
	} # end method
}
