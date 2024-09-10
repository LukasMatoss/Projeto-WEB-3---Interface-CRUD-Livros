<?php
require_once "modelo/banco.php";

class livro implements JsonSerializable
{
    private $id_livro;
    private $nome_livro;
    private $editora_livro;
    private $id_autor;
    private $id_genero;

public function jsonSerialize()
{
    $array = array();
    if (isset($this->id_livro)) $array['id_livro'] = $this->id_livro;
    if (isset($this->nome_livro)) $array['nome_livro'] = $this->nome_livro;
    if (isset($this->editora_livro)) $array['editora_livro'] = $this->editora_livro;
    if (isset($this->id_autor)) $array['id_autor'] = $this->id_autor;
    if (isset($this->id_genero)) $array['id_genero'] = $this->id_genero;
    return $array;
}

public function readAll()
    {
        $conexao = Banco::getConexao();
        $prepararSql = $conexao->prepare("SELECT * FROM livros");
        $prepararSql->execute();
        $matrizResultados = $prepararSql->get_result();
        $livros = array();
        while ($tuplaBanco = $matrizResultados->fetch_object()) {
            $livro = new livro();
            $livro->setIdLivro($tuplaBanco->id_livro);
            $livro->setNomeLivro($tuplaBanco->nome_livro);
            $livro->setEditoraLivro($tuplaBanco->editora_livro);
            $livro->setIdAutor($tuplaBanco->id_autor);
            $livro->setIdGenero($tuplaBanco->id_genero);
            $livros[] = $livro;
        }
        $prepararSql->close();
        return $livros;
    }

    public function create() {
        $conexao = Banco::getConexao();
        $query = "INSERT INTO livros (nome_livro, editora_livro, id_autor, id_genero) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("ssii", $this->nome_livro, $this->editora_livro, $this->id_autor, $this->id_genero);
        $executou = $stmt->execute();
        $this->setIdLivro($conexao->insert_id);
        $stmt->close();
        return $executou;
    }

    public function delete() {
        $conexao = Banco::getConexao();
        $query = "DELETE FROM livros WHERE id_livro = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("i", $this->id_livro);
        $executou = $stmt->execute();
        $stmt->close();
        return $executou;
    }

    public function update() {
        $conexao = Banco::getConexao();
        $query = "UPDATE livros SET nome_livro = ?, editora_livro = ?, id_autor = ?, id_genero = ? WHERE id_livro = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("ssiii", $this->nome_livro, $this->editora_livro, $this->id_autor, $this->id_genero, $this->id_livro);
        $executou = $stmt->execute();
        $stmt->close();
        return $executou;
    }

    public function readById() {
        $conexao = Banco::getConexao();
        $query = "SELECT * FROM livros WHERE id_livro = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("i", $this->id_livro);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $livro = null;
        
        if ($row = $resultado->fetch_object()) {
            $livro = new Livro();
            $livro->setIdLivro($row->id_livro);
            $livro->setNomeLivro($row->nome_livro);
            $livro->setEditoraLivro($row->editora_livro);
            $livro->setIdAutor($row->id_autor);
            $livro->setIdGenero($row->id_genero);
        }
        
        $stmt->close();
        return $livro;
    }




// Get and Set for id_livro
public function getIdLivro() {
    return $this->id_livro;
}

public function setIdLivro($id_livro) {
    $this->id_livro = $id_livro;
}

// Get and Set for nome_livro
public function getNomeLivro() {
    return $this->nome_livro;
}

public function setNomeLivro($nome_livro) {
    $this->nome_livro = $nome_livro;
}

// Get and Set for editora_livro
public function getEditoraLivro() {
    return $this->editora_livro;
}

public function setEditoraLivro($editora_livro) {
    $this->editora_livro = $editora_livro;
}

// Get and Set for id_autor
public function getIdAutor() {
    return $this->id_autor;
}

public function setIdAutor($id_autor) {
    $this->id_autor = $id_autor;
}

// Get and Set for id_genero
public function getIdGenero() {
    return $this->id_genero;
}

public function setIdGenero($id_genero) {
    $this->id_genero = $id_genero;
}
}


?>