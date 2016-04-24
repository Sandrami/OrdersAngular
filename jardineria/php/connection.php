<?php
class DataBase {

	public function searchClients($param) {
		$connection = $this -> openConnection();
    	try {
	        $query = $connection -> prepare("SELECT * FROM Clientes WHERE NombreContacto LIKE :buscar OR Ciudad LIKE :buscar;");
	        $query -> bindValue(':buscar', "%$param%", PDO::PARAM_STR);
	        $query -> execute();
	        $result = $query -> fetchAll(PDO::FETCH_ASSOC);

	        return json_encode($result);
	    } catch(PDOException $error){
			echo "ERROR: " . $error->getMessage();
		}
    }

	public function searchProducts($param) {
		$connection = $this -> openConnection();
    	try {
	        $query = $connection -> prepare("SELECT * FROM Productos WHERE CodigoProducto LIKE :buscar OR Gama LIKE :buscar  OR Nombre LIKE :buscar;");
	        $query -> bindValue(':buscar', "%$param%", PDO::PARAM_STR);
	        $query -> execute();
	        $result = $query -> fetchAll(PDO::FETCH_ASSOC);

	        return json_encode($result);
	    } catch(PDOException $error){
			echo "ERROR: " . $error->getMessage();
		}
    }    

    private function openConnection() {
		 include("config.php");
		 try {
			 $connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"));
			 $connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			 return $connection;
		 } catch(PDOException $error){
						 echo "ERROR: " . $error->getMessage();
		 }
	}

	private function closeConnection($connection) {
		$connection = null;
	}
}
?>
