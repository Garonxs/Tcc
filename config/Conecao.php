<?php

namespace\Conecao::class;

class Conecao
{
    private $usuario;
    private  $senha;

    public function __construct( string $usuario, string $senha)
    {
        $this->usuario = $usuario;
        $this->senha = $senha;
    }

    /**
     * @return PDO|void
     */
    public function criarConexao(){

        $servername = "localhost";
        $username = "$this->usuario";
        $password = "$this->senha";
        $database = "garon";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Falha na conexão: " . $e->getMessage();
        }
    }

}