<?php
    include_once('Produto.php');
    include_once('ProdutoDAO.php');

    $produto = new Produto(0, "cama", 287.50);
    $produto = new Produto(0, "dado invalido", 321);

			
    $dao= new ProdutoDAO;    
    $produto = $dao->inserir($produto);

    $produto = $dao->buscarPorId(4);
    $produto = new Produto(4, "cama solteiro", 227.50);
    $dao->atualizar($produto);

    $dao->deletar(5);				


    $produtos =  $dao->listar();	
    print_r($produtos);
?>