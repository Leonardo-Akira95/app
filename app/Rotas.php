<?php

// Model
include 'Model/Pessoa.php';

// DAOS
include 'DAO/PessoaDAO.php';

// Utils
include 'Conexao/Conexao.php';
include 'Util/Valida.php';

//Controllers
include 'Controller/RotasController.php';

// Esta classe � respons�vel por receber qual opera��o de qual classe queremos executar
// e chamar o m�todo encaminhar do RotasController

session_start();
if(isset($_POST[sha1("operacao")])){
    $_SESSION[sha1("acao")] = $_POST[sha1("operacao")];
    RotasController::Encaminhar();
}

if(isset($_GET[sha1("operacaoConsulta")])){
    $_SESSION[sha1("acao")] = $_GET[sha1("operacaoConsulta")];
    RotasController::Encaminhar();
}

?>