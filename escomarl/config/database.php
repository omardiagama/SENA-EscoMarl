<?php  

class Database {  
    private static $host = 'localhost';  
    private static $db_name = 'bdescomarl'; // O 'bdescomarl' según tu configuración local
    private static $username = 'root';  
    private static $password = '';  
    private static $instance = null;  

    public function __construct() {}  
    private function __clone() {}  

    // Retorna la conexión PDO mediante Singleton
    public static function getInstance() {  
        if (self::$instance === null) {  
            try {  
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8mb4";  
                $options = [  
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,  
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,  
                    PDO::ATTR_EMULATE_PREPARES => false,  
                ];  
                self::$instance = new PDO($dsn, self::$username, self::$password, $options);  
            } catch (PDOException $e) {  
                error_log("Connection Error: " . $e->getMessage());  
                die("Error de conexión a la base de datos: " . $e->getMessage());  
            }  
        }  
        return self::$instance;  
    }  

    public static function getConnection() {  
        return self::getInstance();  
    }  

    public function conectar() {  
        return self::getInstance();  
    }  
}