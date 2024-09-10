<?php
require_once "modelo/banco.php";

class genero implements JsonSerializable
{
    private $tipo;


public function jsonSerialize()
{
    $array = array();
    if (isset($this->tipo)) $array['tipo'] = $this->tipo;

    return $array;
}

public function readAll()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM generos");
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $generos = array();
        while ($tuplaBanco = $matrizResultados->fetch_object()) {
            $tipo = new tipo();
            $tipo->setNomeAutor($tuplaBanco->tipo);
            $generos[] = $tipo;
        }
        $prepararSql->close();
        return $generos;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

}

    ?>