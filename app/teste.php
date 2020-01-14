<?php

require_once 'Conexao/Conexao.php';
require_once 'Model/Pessoa.php';
require_once 'DAO/PessoaDAO.php';
require_once 'Util/Valida.php';

?>

<div class="container h-100">
    <div class="row main align-items-center h-100">
        <div class="col-12 mx-auto">
            <div class="main-title text-center">
                <h1>Smart Control PRO</h1>
                <img src="https://image.flaticon.com/icons/svg/1246/1246273.svg" alt="Icon Button Power Off"
                    width="100px" height="100px">
            </div>
            <div class="main-body">
                <form action="Rotas.php" method="POST">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" aria-describedby="emailHelp"
                            placeholder="Insira nome">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="pass" name="pwd" placeholder="Insira senha">
                    </div>
                    <button type="submit" name="operacao" value="Logar" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php


$pessoa = new Pessoa();
$pessoa->setNome(Valida::Entrada("asd"));
$pessoa->setSenha(Valida::Entrada("123"));

$p = PessoaDAO::logar($pessoa);

$_SESSION['dadosLogin'] = array();
$_SESSION['dadosLogin'] = $p[0];


header("Location: testeLogado.php");

?>