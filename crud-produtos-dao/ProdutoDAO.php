<?php
    include_once 'Produto.php';
	include_once 'PDOFactory.php';

    class ProdutoDAO
    {
        public function inserir(Produto $produto)
        {
            $qInserir = "INSERT INTO produto(nome,preco) VALUES (:nome,:preco)";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qInserir);
            $comando->bindParam(":nome",$produto->nome);
            $comando->bindParam(":preco",$produto->preco);
            $comando->execute();
            $produto->id = $pdo->lastInsertId();
            return $produto;
        }

        public function deletar($id)
        {
            $qDeletar = "DELETE from produto WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qDeletar);
            $comando->bindParam(":id",$id);
            $comando->execute();
        }

        public function atualizar(Produto $produto)
        {
            $qAtualizar = "UPDATE produto SET nome=:nome, preco=:preco WHERE id=:id";            
            $pdo = PDOFactory::getConexao();
            $comando = $pdo->prepare($qAtualizar);
            $comando->bindParam(":nome",$produto->nome);
            $comando->bindParam(":preco",$produto->preco);
            $comando->bindParam(":id",$produto->id);
            $comando->execute();        
        }

        public function listar()
        {
		    $query = 'SELECT * FROM produto';
    		$pdo = PDOFactory::getConexao();
	    	$comando = $pdo->prepare($query);
    		$comando->execute();
            $produtos=array();	
		    while($row = $comando->fetch(PDO::FETCH_OBJ)){
			    $produtos[] = new Produto($row->id,$row->nome,$row->preco);
            }
            return $produtos;
        }

        public function buscarPorId($id)
        {
 		    $query = 'SELECT * FROM produto WHERE id=:id';		
            $pdo = PDOFactory::getConexao(); 
		    $comando = $pdo->prepare($query);
		    $comando->bindParam ('id', $id);
		    $comando->execute();
		    $result = $comando->fetch(PDO::FETCH_OBJ);
		    return new Produto($result->id,$result->nome,$result->preco);           
        }
    }
?>