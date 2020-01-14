<?php

    class Logar{

        public function executar(){

            $pessoa = new Pessoa();
            $pessoa->setNome(Valida::Entrada($_POST[sha1('nome')]));
            $pessoa->setSenha(Valida::Entrada($_POST[sha1('pwd')]));

            $p = PessoaDAO::logar($pessoa);

            if(sizeof($p) == 0){
                header("Location: 404.php");
            }else{
                $_SESSION[sha1('dadosLogin')] = array();
                $_SESSION[sha1('dadosLogin')] = $p[0];
                header("Location: index.php");
            }
        }

    }
    

?>