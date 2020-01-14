<?php 

class RotasController{
    
    public static function Encaminhar(){
        
        try{
            $session = $_SESSION[sha1(("acao"))];
            include $_SESSION[sha1("acao")].".php";
            $acao = new $session;
            $acao->executar();
            unset($_SESSION[sha1("acao")]);
        }catch(Exception $e){
            $_SESSION['erro'] = $e;
            header("Location:index.php");
        }
    }
}

?>