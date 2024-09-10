<?php

    class Banco{

        private static $host = "127.0.0.1";
        private static $usuario = "root";
        private static $senha = "";
        private static $banco = "projeto_web";
        private static $porta = "3306";
        private static $con = null;

        public static function conectar(){
            self::$con = new mysqli(self::$host, self::$usuario, self::$senha, self::$banco, self::$porta);
            if(self::$con->connect_error){
                $arrayResposta['status'] = "erro";
                $arrayResposta['cod'] = "1";
                $arrayResposta['msg'] = "Erro ao estabelecer conexao";
                echo json_encode($arrayResposta);
                die();
            }
        }

        public static function getConexao(){
            if(self::$con == null){
                self::conectar();
            }
            return self::$con;
        }
    }


?>