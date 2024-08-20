<?php
$env = parse_ini_file('../.env');

// Asigna las variables de entorno a constantes
define('DB_HOST', $env['DB_HOST']);
define('DB_PORT', $env['DB_PORT']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
define('FILE_ROOT', $env['File_Root']);

class Connection {
 
    private $server;
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	);
    private $sslOptions = array(
        PDO::MYSQL_ATTR_SSL_CA => FILE_ROOT, 
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
    );
	protected $conn;
 
    public function __construct() {
        $this->server = DB_HOST;
    }
 
    public function open() {
        try {
		
            $this->conn = new PDO("mysql:host=" . $this->server . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, array_merge($this->options, $this->sslOptions));
            return $this->conn;
			
        } catch (PDOException $e) {
            echo "Hubo un problema con la conexión: " . $e->getMessage();
        }
    }
 
    public function close() {
        $this->conn = null;
    }
}
 

/* Class Connection{
 
	private $server = "mysql:host=68.178.207.10:3306;dbname=unixfyonecom_db";
	private $username = "unixfyonecom_creverol";
	private $password = "+y&xZ%AunyNZ";
	private $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
	protected $conn;
 	
	public function open(){
 		try{
 			$this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
 			return $this->conn;
 		}
 		catch (PDOException $e){
 			echo "Hubo un problema con la conexión: " . $e->getMessage();
 		}
 
    }
 
	public function close(){
   		$this->conn = null;
 	}
 
} */
 
?>