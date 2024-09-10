<?php
require_once "modelo/banco.php";

class autor implements JsonSerializable
{
    private $nome_autor;
    private $nacionalidade;
    private $data_nascimento;




public function jsonSerialize()
{
    $array = array();
    if (isset($this->nome_autor)) $array['nome_autor'] = $this->nome_autor;
    if (isset($this->nacionalidade)) $array['nacionalidade'] = $this->nacionalidade;
    if (isset($this->data_nascimento)) $array['data_nascimento'] = $this->data_nascimento;
    return $array;
}

public function readAll()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM autores");
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $autores = array();
        while ($tuplaBanco = $matrizResultados->fetch_object()) {
            $autor = new autor();
            $autor->setNomeAutor($tuplaBanco->nome_autor);
            $autor->setNacionalidade($tuplaBanco->nacionalidade);
            $autor->setDataNascimento($tuplaBanco->data_nascimento);
            $autores[] = $autor;
        }
        $prepararSql->close();
        return $autores;
    }


    public function getNomeAutor() {
        return $this->nome_autor;
    }

    public function setNomeAutor($nome_autor) {
        $this->nome_autor = $nome_autor;
    }

   
    public function getNacionalidade() {
        return $this->nacionalidade;
    }

    public function setNacionalidade($nacionalidade) {
        $this->nacionalidade = $nacionalidade;
    }

 
    public function getDataNascimento() {
        return $this->data_nascimento;
    }

    public function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }
}
?>