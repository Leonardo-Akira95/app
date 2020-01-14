<?php 

class Conexao{
    
    private const host = "localhost";
    private const user = "root";
    private const pwd = "";
    private const databaseName = "smartcontrol2";
    
    private static $instance;
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            try{
                self::$instance = new PDO('mysql:host=' . self::host . ';dbname=' .
                    self::databaseName, self::user, self::pwd);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        return self::$instance;
    }
    
}

?>