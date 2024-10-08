<?php
require_once ("modelo/Banco.php");

class Livro implements JsonSerializable
{
    private $idlivros;
    private $nomeLivro;
    private $autores_idautores;
    private $editoraLivro; // Novo campo

    public function jsonSerialize()
    {
        $objetoResposta = new stdClass();
        $objetoResposta->idlivros = $this->idlivros;
        $objetoResposta->nomeLivro = $this->nomeLivro;
        $objetoResposta->autores_idautores = $this->autores_idautores;
        $objetoResposta->editoraLivro = $this->editoraLivro; // Adicionado

        return $objetoResposta;
    }

    public function create()
    {
        $conexao = Banco::getConexao();
        $SQL = "INSERT INTO livros (nomeLivro, autores_idautores, editoraLivro) VALUES (?, ?, ?);"; // Atualizado
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("sis", $this->nomeLivro, $this->autores_idautores, $this->editoraLivro); // Atualizado
        $executou = $prepareSQL->execute();
        $idCadastrado = $conexao->insert_id;
        $this->setidlivros($idCadastrado);
        return $executou;
    }

    public function delete()
    {
        $conexao = Banco::getConexao();
        $SQL = "DELETE FROM livros WHERE idlivros=?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("i", $this->idlivros);
        return $prepareSQL->execute();
    }

    public function update()
    {
        $conexao = Banco::getConexao();
        $SQL = "UPDATE livros SET nomeLivro=?, autores_idautores=?, editoraLivro=? WHERE idlivros=?"; // Atualizado
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("sisi", $this->nomeLivro, $this->autores_idautores, $this->editoraLivro, $this->idlivros); // Atualizado
        $executou = $prepareSQL->execute();
        return $executou;
    }

    public function isLivro()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT COUNT(*) AS qtd FROM livros WHERE nomeLivro = ?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("s", $this->nomeLivro);
        $executou = $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        $objTupla = $matrizTuplas->fetch_object();
        return $objTupla->qtd > 0;
    }

    public function readAll()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT * FROM livros ORDER BY nomeLivro";
        $prepareSQL = $conexao->prepare($SQL);
        $executou = $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        $vetorLivro = array();
        $i = 0;
        while ($tupla = $matrizTuplas->fetch_object()) {
            $vetorLivro[$i] = new Livro();
            $vetorLivro[$i]->setidlivros($tupla->idlivros);
            $vetorLivro[$i]->setnomeLivro($tupla->nomeLivro);
            $vetorLivro[$i]->setautores_idautores($tupla->autores_idautores);
            $vetorLivro[$i]->seteditoraLivro($tupla->editoraLivro); // Adicionado

            $i++;
        }
        return $vetorLivro;
    }

    public function readByID()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT * FROM livros WHERE idlivros=?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("i", $this->idlivros);
        $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        
        if ($tupla = $matrizTuplas->fetch_object()) {
            $this->setidlivros($tupla->idlivros);
            $this->setnomeLivro($tupla->nomeLivro);
            $this->setautores_idautores($tupla->autores_idautores);
            $this->seteditoraLivro($tupla->editoraLivro); // Adicionado

            return array($this); // Retorna um vetor com um único livro
        }

        return array(); // Retorna um vetor vazio se o livro não for encontrado
    }

    public function getidlivros()
    {
        return $this->idlivros;
    }

    public function setidlivros($idlivros)
    {
        $this->idlivros = $idlivros;
        return $this;
    }

    public function getnomeLivro()
    {
        return $this->nomeLivro;
    }

    public function setnomeLivro($nomeLivro)
    {
        $this->nomeLivro = $nomeLivro;
        return $this;
    }

    public function getautores_idautores()
    {
        return $this->autores_idautores;
    }

    public function setautores_idautores($autores_idautores)
    {
        $this->autores_idautores = $autores_idautores;
        return $this;
    }

    public function geteditoraLivro()
    {
        return $this->editoraLivro;
    }

    public function seteditoraLivro($editoraLivro) // Novo método
    {
        $this->editoraLivro = $editoraLivro;
        return $this;
    }
}
?>
