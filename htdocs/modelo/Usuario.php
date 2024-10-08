<?php
require_once ("modelo/Banco.php");

class Usuario implements JsonSerializable
{
    private $idUsuario;
    private $nomeUsuario;
    private $emailUsuario;
    private $senhaUsuario;

    public function jsonSerialize()
    {
        $objetoResposta = new stdClass();
        $objetoResposta->idUsuario = $this->idUsuario;
        $objetoResposta->nomeUsuario = $this->nomeUsuario;
        $objetoResposta->emailUsuario = $this->emailUsuario;
        $objetoResposta->senhaUsuario = $this->senhaUsuario;

        return $objetoResposta;
    }

    public function create()
    {
        $conexao = Banco::getConexao();
        $SQL = "INSERT INTO usuario (nomeUsuario, emailUsuario, senhaUsuario) VALUES (?, ?, ?);";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("sss", $this->nomeUsuario, $this->emailUsuario, $this->senhaUsuario);

        $executou = $prepareSQL->execute();
        $idCadastrado = $conexao->insert_id;
        $this->setidUsuario($idCadastrado);
        return $executou;
    }

    public function delete()
    {
        $conexao = Banco::getConexao();
        $SQL = "DELETE FROM usuario WHERE idUsuario=?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("i", $this->idUsuario);
        return $prepareSQL->execute();
    }

    public function update()
    {
        $conexao = Banco::getConexao();
        $SQL = "UPDATE usuario SET nomeUsuario=?, emailUsuario=?, senhaUsuario=? WHERE idUsuario=?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("sssi", $this->nomeUsuario, $this->emailUsuario, $this->senhaUsuario, $this->idUsuario);
        $executou = $prepareSQL->execute();
        return $executou;
    }

    public function readAll()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT * FROM usuario ORDER BY nomeUsuario;";
        $prepareSQL = $conexao->prepare($SQL);
        $executou = $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        $vetorUsuario = array();
        $i = 0;
        while ($tupla = $matrizTuplas->fetch_object()) {
            $vetorUsuario[$i] = new Usuario();
            $vetorUsuario[$i]->setidUsuario($tupla->idUsuario);
            $vetorUsuario[$i]->setnomeUsuario($tupla->nomeUsuario);
            $vetorUsuario[$i]->setemailUsuario($tupla->emailUsuario);
            $vetorUsuario[$i]->setsenhaUsuario($tupla->senhaUsuario);
            $i++;
        }
        return $vetorUsuario;
    }

    public function readByID()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT * FROM usuario WHERE idUsuario=?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("i", $this->idUsuario);
        $executou = $prepareSQL->execute();
        $matrizTuplas = $prepareSQL->get_result();
        $vetorUsuario = array();
        $i = 0;
        while ($tupla = $matrizTuplas->fetch_object()) {
            $vetorUsuario[$i] = new Usuario();
            $vetorUsuario[$i]->setidUsuario($tupla->idUsuario);
            $vetorUsuario[$i]->setnomeUsuario($tupla->nomeUsuario);
            $vetorUsuario[$i]->setemailUsuario($tupla->emailUsuario);
            $vetorUsuario[$i]->setsenhaUsuario($tupla->senhaUsuario);
            $i++;
        }
        return $vetorUsuario;
    }

    public function isUsuario()
    {
        $conexao = Banco::getConexao();
        $SQL = "SELECT COUNT(*) as count FROM usuario WHERE emailUsuario=?;";
        $prepareSQL = $conexao->prepare($SQL);
        $prepareSQL->bind_param("s", $this->emailUsuario);
        $prepareSQL->execute();
        $resultado = $prepareSQL->get_result();
        $row = $resultado->fetch_assoc();
        return $row['count'] > 0;
    }

    public function getidUsuario()
    {
        return $this->idUsuario;
    }

    public function setidUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    public function getnomeUsuario()
    {
        return $this->nomeUsuario;
    }

    public function setnomeUsuario($nomeUsuario)
    {
        $this->nomeUsuario = $nomeUsuario;
        return $this;
    }

    public function getemailUsuario()
    {
        return $this->emailUsuario;
    }

    public function setemailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;
        return $this;
    }

    public function getsenhaUsuario()
    {
        return $this->senhaUsuario;
    }

    public function setsenhaUsuario($senhaUsuario)
    {
        $this->senhaUsuario = $senhaUsuario;
        return $this;
    }
}
?>
