<?php
    class Produto{
        public $id;
        public $nome;
        public $preco;

        function __construct($id, $nome, $preco){
            $this->id = $id;
            $this->nome = $nome;
            $this->preco = $preco;
        }
        function getId(){
            return $this->id;
        }
        function getNome(){
            return $this->nome;
        }
        function getPreco(){
            return $this->preco;
        }
        function setNome($nome){
            $this->nome = $nome;
        }
        function setPreco($preco){
            $this->preco = $preco;
        }
    }

?>