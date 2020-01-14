<?php

    class PessoaDAO{

        public static function logar(Pessoa $pessoa){

                $conn = Conexao::getInstance();

                $stmt = 'select pes_nome, pes_senha from pessoa where (pes_nome = :1 AND pes_senha = :2)';
                
                $sql = $conn->prepare($stmt);
                $sql->bindValue(":1", $pessoa->getNome());
                $sql->bindValue(":2", $pessoa->getSenha());

                $sql->execute();

            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }

    }

?>