<?php
    require_once __DIR__. "/../configs/BancoDados.php";
    require_once  "./../model/Funcionario.php";
    require_once "./../model/Atende.php";

    class Animal
    {
        public static function cadastrar($nome,$raca,$telDono)
        {
            try{
               $dataCadastro = date('Y-m-d H:i:s');
               // print_r($dataCadastro);
                $conexao = Conexao:: getConexao();
                $stmt =$conexao->prepare(   
                    "INSERT INTO animal (nome, raca, telDono,dataCadastro) values(:pNome, :pRaca, 
                    :pTelDono,:pDataCadastro)"
                );
                $stmt->execute([
                   "pNome"=>$nome,
                   "pRaca"=>$raca,
                   "pTelDono"=>$telDono,
                   "pDataCadastro"=>$dataCadastro
                 
                ]);
            
    
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

        public static function listar()
        {
            try{
                $conexao =Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM Animal order by id"
                );
                $stmt->execute();

                return $stmt->fetchALL();

            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        public static function existeId($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT COUNT(*) FROM Animal WHERE $id = ?"
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

        public static function editar($id, $nome,$telDono,$dataCadastro)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "UPDATE Animal SET nome = ?,telDono = ?,dataCadastro =? WHERE id = ?"
                );
                $stmt->execute([ $nome,$telDono,$dataCadastro,$id]);


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
                    "DELETE FROM Animal WHERE id = ?"
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

        public static function getAnimalById($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * FROM animal WHERE id = ?"
                );
                $stmt->execute([$id]);

                return $stmt->fetchAll()[0];
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function listarTodosAnimais($raca){
            try{   
                $conexao = Conexao:: getConexao();
                $stmt = $conexao->prepare(
                    "SELECT * from animal
                      where raca = ?"
                );
                $stmt->execute([$raca]);

                return $stmt->fetchAll();
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    
      
        
   
    }

 

  
