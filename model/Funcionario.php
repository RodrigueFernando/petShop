<?php
   require_once __DIR__. "/../configs/BancoDados.php";
   require_once "./../model/Animal.php";
   require_once "./../model/Atende.php";
 
  class Funcionario
  {
        public static function cadastrar($nome,$email)
        { 
            try {
                $conexao = Conexao::getConexao();
                $dataCadastro = date ('Y-m-d H:i:s');
                $stmt = $conexao->prepare(
                    "INSERT INTO Funcionario (nome,email,dataCadastro) VALUES (?,?,?)"
                );
                $stmt->execute([$nome, $email,$dataCadastro]);
    
                if ($stmt->rowCount() > 0) {
                    return true;
                  
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
     


        public static function listar(){
            try{   
                $conexao = Conexao:: getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM Funcionario ORDER BY id"
                );
                $stmt->execute();

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
        
        public static function existeEmail($email)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT COUNT(*) FROM Funcionario WHERE email = ?"
                );
                $stmt->execute([$email]);

                $quantidade = $stmt->fetchColumn();
                if ($quantidade > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
        public static function existeId($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT COUNT(*) FROM Funcionario WHERE id = ?"
                );
                $stmt->execute([$id]);

                $quantidade = $stmt->fetchColumn();
                if ($quantidade > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        
        public static function editar($id,$nome,$email,$dataCadastro)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "UPDATE Funcionario SET nome = ?, email = ?, dataCadastro =? WHERE id = ?"
                );
                $stmt->execute([ $nome,$email,$dataCadastro,$id]);


                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                return false;
            }
        }

        public static function deletar($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "DELETE FROM Funcionario WHERE id = ?"
                );
                $stmt->execute([$id]);

                if ($stmt->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {

                //echo $e->getMessage();
           
                return false;
                exit;
            }
        }

        public static function getFuncionarioById($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM Funcionario WHERE id = ?"
                );
                $stmt->execute([$id]);

                return $stmt->fetchAll()[0];
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function listarNomeAnimal($email){
            try{   
                $conexao = Conexao:: getConexao();
                $stmt = $conexao->prepare(
                    "SELECT al.nome
                    FROM atende a inner join animal al on a.idAnimal = al.id
                    join funcionario f on   f.id = a.idFuncionario
                    where f.email = ?
                    ORDER BY  nome"
                );
                $stmt->execute([$email]);

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
       
        public static function listarNomeFuncionario($nome){
            try{   
                $conexao = Conexao:: getConexao();
                $stmt = $conexao->prepare(
                    "SELECT f.nome
                    FROM funcionario f join atende a on   f.id = a.idFuncionario
                    join animal al on  al.id = a.idAnimal
                    where al.nome = ?"
                );
                $stmt->execute([$nome]);

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }