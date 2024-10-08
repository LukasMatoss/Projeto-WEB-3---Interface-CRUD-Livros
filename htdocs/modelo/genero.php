<?php

require_once("modelo/Banco.php");

// Definição da classe Genero, que implementa a interface JsonSerializable
class Genero implements JsonSerializable
{
    // Propriedades privadas da classe
    private $idGenero;
    private $nomeGenero;

    // Método necessário pela interface JsonSerializable para serialização do objeto para JSON
    public function jsonSerialize()
    {
        // Cria um objeto stdClass para armazenar os dados do Genero
        $objetoResposta = new stdClass();
        // Define as propriedades do objeto com os valores das propriedades da classe
        $objetoResposta->idGenero = $this->idGenero;
        $objetoResposta->nomeGenero = $this->nomeGenero;

        // Retorna o objeto para serialização
        return $objetoResposta;
    }

    // Método para criar um novo genero no banco de dados
    public function create()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para inserir um novo Genero  
        $SQL = "INSERT INTO Genero (nomeGenero) VALUES (?);";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o nome do Genero  
        $prepareSQL->bind_param("s", $this->nomeGenero);
        // Executa a consulta
        $executou = $prepareSQL->execute();
        // Obtém o ID do Genero inserido
        $idCadastrado = $conexao->insert_id;
        // Define o ID do Genero na instância atual da classe
        $this->setidGenero($idCadastrado);
        // Retorna se a operação foi executada com sucesso
        return $executou;
    }

    // Método para excluir um Genero do banco de dados
    public function delete()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para excluir um Genero pelo ID
        $SQL = "DELETE FROM Genero WHERE idGenero = ?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o ID do Genero
        $prepareSQL->bind_param("i", $this->idGenero);
        // Executa a consulta
        return $prepareSQL->execute();
    }

    // Método para atualizar os dados de um Genero no banco de dados
    public function update()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para atualizar o nome do Genero pelo ID
        $SQL = "UPDATE Genero SET nomeGenero = ? WHERE idGenero = ?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define os parâmetros da consulta com o novo nome do Genero e o ID do Genero
        $prepareSQL->bind_param("si", $this->nomeGenero, $this->idGenero);
        // Executa a consulta
        $executou = $prepareSQL->execute();
        // Retorna se a operação foi executada com sucesso
        return $executou;
    }

    // Método para verificar se um Genero já existe no banco de dados
    public function isGenero()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para contar quantos Generos possuem o mesmo nome
        $SQL = "SELECT COUNT(*) AS qtd FROM Genero WHERE nomeGenero = ?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o nome do Genero
        $prepareSQL->bind_param("s", $this->nomeGenero);
        // Executa a consulta
        $prepareSQL->execute();
        
        // Obtém o resultado da consulta
        $matrizTuplas = $prepareSQL->get_result();
        // Extrai o objeto da tupla
        $objTupla = $matrizTuplas->fetch_object();
        // Retorna se a quantidade de Generos encontrados é maior que zero
        return $objTupla->qtd > 0;
    }

    // Método para ler todos os Generos do banco de dados
    public function readAll()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para selecionar todos os Generos ordenados pelo nome
        $SQL = "SELECT * FROM Genero";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Executa a consulta
        $prepareSQL->execute();
        // Obtém o resultado da consulta
        $matrizTuplas = $prepareSQL->get_result();
        // Inicializa um vetor para armazenar os Generos
        $vetorGenero = array();
        $i = 0;
        // Itera sobre as tuplas do resultado
        while ($tupla = $matrizTuplas->fetch_object()) {
            // Cria uma nova instância de Genero para cada tupla encontrada
            $vetorGenero[$i] = new Genero();
            // Define o ID e nome na instância
            $vetorGenero[$i]->setidGenero($tupla->idGenero);
            $vetorGenero[$i]->setnomeGenero($tupla->nomeGenero);
            $i++;
        }
        // Retorna o vetor com os Generos encontrados
        return $vetorGenero;
    }

    // Método para ler um Genero do banco de dados com base no ID
    public function readByID()
    {
        // Obtém a conexão com o banco de dados
        $conexao = Banco::getConexao();
        // Define a consulta SQL para selecionar um Genero pelo ID
        $SQL = "SELECT * FROM Genero WHERE idGenero = ?;";
        // Prepara a consulta
        $prepareSQL = $conexao->prepare($SQL);
        // Define o parâmetro da consulta com o ID do Genero
        $prepareSQL->bind_param("i", $this->idGenero);
        // Executa a consulta
        $prepareSQL->execute();
        // Obtém o resultado da consulta
        $matrizTuplas = $prepareSQL->get_result();
        // Inicializa um vetor para armazenar os Generos
        $vetorGenero = array();
        $i = 0;
        // Itera sobre as tuplas do resultado
        while ($tupla = $matrizTuplas->fetch_object()) {
            // Cria uma nova instância de Genero para cada tupla encontrada
            $vetorGenero[$i] = new Genero();
            // Define o ID e nome na instância
            $vetorGenero[$i]->setidGenero($tupla->idGenero);
            $vetorGenero[$i]->setnomeGenero($tupla->nomeGenero);
            $i++;
        }
        // Retorna o vetor com os Generos encontrados
        return $vetorGenero;
    }

    // Getters e Setters para as propriedades da classe
    public function getidGenero()
    {
        return $this->idGenero;
    }

    public function setidGenero($idGenero)
    {
        $this->idGenero = $idGenero;
    }

    public function getnomeGenero()
    {
        return $this->nomeGenero;
    }

    public function setnomeGenero($nomeGenero)
    {
        $this->nomeGenero = $nomeGenero;
    }
}
?>
