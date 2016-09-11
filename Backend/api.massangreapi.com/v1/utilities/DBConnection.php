<?php
/**
 * Clase que envuelve una instancia de la clase PDO
 * para el manejo de la base de modelos
 */

require_once './data/login_mysql.php';


class DBConnection
{

	/**
	 * Única instancia de la clase
	 */
	private static $db = null;

	/**
	 * Instancia de PDO
	 */
	private static $pdo;

	final private function __construct()
	{
		try {
			// Crear nueva conexión PDO
			self::GetDB();
		} catch (PDOException $e) {
			// Manejo de excepciones
		}


	}

	/**
	 * Retorna en la única instancia de la clase
	 * @return ConexionBD|null
	 */
	public static function GetInstance()
	{
		if (self::$db === null) {
			self::$db = new self();
		}
		return self::$db;
	}

	/**
	 * Crear una nueva conexión PDO basada
	 * en las constantes de conexión
	 * @return PDO Objeto PDO
	 */
	public function GetDB()
	{
		if (self::$pdo == null) {
			self::$pdo = new PDO(
					'mysql:dbname=' . Database .
					';host=' . Hostname . ";",
					User,
					Password,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);

			// Habilitar excepciones
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return self::$pdo;
	}

	/**
	 * Evita la clonación del objeto
	 */
	final protected function __clone()
	{
	}

	function _destructor()
	{
		self::$pdo = null;
	}
}