<?php
require_once ("modelo/Banco.php");

class Autor implements JsonSerializable
{
    private $idAutores; // Alterado
    private $nomeAutor;
    private $nacionalidade;
    private $idade;

    public function jsonSerialize()
    {
        $objetoResposta = new stdClass();
        $objetoResposta->idAutores = $this->idAutores; // Alterado
        $objetoResposta->nomeAutor = $this->nomeAutor;
        $objetoResposta->nacionalidade = $this->nacionalidade;
        $objetoResposta->idade = $this->idade;

        return $objetoResposta;
    }

    public function create()
    {
        $conexao = Banco::getConexao();
        $SQL = "INSERT INTO autores (nomeAutor, nacionalidade, idade) VALUES (?, ?, ?);";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("ssi", $this->nomeAutor, $this->nacionalidade, $this->idade);

        $executou = $prepareSQL->execute();
        $idCadastrado = $conexao->insert_id;
        $this->setidAutores($idCadastrado); // Alterado
        return $executou;
    }

    public function delete()
    {
        $conexao = Banco::getConexao();
        $SQL = "DELETE FROM autores WHERE idAutores = ?;"; // Alterado
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("i", $this->idAutores); // Alterado
        return $prepareSQL->execute();
    }

    public function update()
    {
        $conexao = Banco::getConexao();
        $SQL = "UPDATE autores SET nomeAutor = ?, nacionalidade = ?, idade = ? WHERE idAutores = ?;"; // Alterado
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("ssii", $this->nomeAutor, $this->nacionalidade, $this->idade, $this->idAutores); // Alterado
        $executou = $prepareSQL->execute();
        return $executou;
    }

    public function isAutor()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT COUNT(*) AS qtd FROM autores WHERE nomeAutor = ?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("s", $this->nomeAutor);
        $executou = $prepareSQL->execute();

        $matrizTuplas = $prepareSQL->get_result();
        $objTupla = $matrizTuplas->fetch_object();
        return $objTupla->qtd > 0;
    }

    public function readAll()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT * FROM autores ORDER BY nomeAutor;";
        $prepareSQL = $conexao->prepare($SQL);
        $executou = $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        $vetorAutor = array();
        $i = 0;
        while ($tupla = $matrizTuplas->fetch_object()) {
            $vetorAutor[$i] = new Autor();
            $vetorAutor[$i]->setidAutores($tupla->idAutores); // Alterado
            $vetorAutor[$i]->setnomeAutor($tupla->nomeAutor);
            $vetorAutor[$i]->setnacionalidade($tupla->nacionalidade);
            $vetorAutor[$i]->setidade($tupla->idade);
            $i++;
        }
        return $vetorAutor;
    }

    public function readByID()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT * FROM autores WHERE idAutores = ?;"; // Alterado
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("i", $this->idAutores); // Alterado
        $executou = $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        $vetorAutor = array();
        $i = 0;
        while ($tupla = $matrizTuplas->fetch_object()) {
            $vetorAutor[$i] = new Autor();
            $vetorAutor[$i]->setidAutores($tupla->idAutores); // Alterado
            $vetorAutor[$i]->setnomeAutor($tupla->nomeAutor);
            $vetorAutor[$i]->setnacionalidade($tupla->nacionalidade);
            $vetorAutor[$i]->setidade($tupla->idade);
            $i++;
        }
        return $vetorAutor;
    }

    public function getidAutores() // Alterado
    {
        return $this->idAutores; // Alterado
    }

    public function setidAutores($idAutores) // Alterado
    {
        $this->idAutores = $idAutores; // Alterado
        return $this;
    }

    public function getnomeAutor()
    {
        return $this->nomeAutor;
    }

    public function setnomeAutor($nomeAutor)
    {
        $this->nomeAutor = $nomeAutor;
        return $this;
    }

    public function getnacionalidade()
    {
        return $this->nacionalidade;
    }

    public function setnacionalidade($nacionalidade)
    {
        $this->nacionalidade = $nacionalidade;
        return $this;
    }

    public function getidade()
    {
        return $this->idade;
    }

    public function setidade($idade)
    {
        $this->idade = $idade;
        return $this;
    }
}
?>
