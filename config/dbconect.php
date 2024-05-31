<?php

Class Connection{
 
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
 
}
 
?>