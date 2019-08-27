<?php
    include_once "Produto.php";

    $conexao = "mysql:host=localhost;dbname=crud_produtos";
    $usuario = "root";
    $senha = "";
    $pdo = new PDO($conexao,$usuario,$senha);

    function inserir($produto){
        $conn = $GLOBALS['pdo'];

        $sql = "INSERT INTO PRODUTO (nome,preco) ".
            "VALUES (:nome,:preco)";
        $comando = $conn->prepare($sql);

        $comando->bindParam(":nome",$produto->nome);
        $comando->bindParam(":preco",$produto->preco);

        $comando->execute();

        var_dump($conn->lastInsertId());
    }

        
    
    function buscarPorId($id){
        $conn = $GLOBALS['pdo'];
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $q = "SELECT * FROM produto WHERE id=:id";
        $comando = $conn->prepare($q);
        $comando->bindParam("id", $id);
        $comando->execute();
        $obj = $comando->fetch(PDO::FETCH_OBJ);
        return($obj);
    }

    function listar(){
        $conn = $GLOBALS['pdo'];
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        $conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES,false);
        $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        $q = "SELECT * FROM produto";
        $comando = $conn->prepare($q);
        $comando->execute();
        $objs = array();
        while($linha = $comando->fetch(PDO::FETCH_OBJ))
        {
            $objs[] = $linha;
        }
        return($objs);
    }

    function deletar($id)
    {
        $conn = $GLOBALS['pdo'];

        $qdeletar = "DELETE FROM produto WHERE id=:id";
        $comando = $conn->prepare($qdeletar);

        $comando->bindParam(':id',$id);

        $comando->execute();
    }

    function atualizar($id,Produto $produtoAlterado)
    {
        $conn = $GLOBALS['pdo'];

        $qAtualizar = "UPDATE produto SET nome=:nome, preco=:preco WHERE id=:id";            
        $comando = $conn->prepare($qAtualizar);

        $comando->bindValue(":nome",$produtoAlterado->getNome());
        $comando->bindValue(":preco",$produtoAlterado->getPreco());
        $comando->bindParam(":id",$id);
        $comando->execute(); 
        
    }


    
    inserir(new Produto(0,"mouse",20));
    inserir(new Produto(0,"teclado",70));
    inserir(new Produto(0,"TV",4000));
    inserir(new Produto(0,"celular",750));

    print_r(buscarPorId(3));

    
    deletar(3);
    
    atualizar(4,new Produto(4,"celular 2",760));

    print_r(listar());
?>