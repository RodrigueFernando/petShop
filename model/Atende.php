<?php
  require_once __DIR__."/../configs/BancoDados.php"; 

class Atende
 {
    public static function cadastrar($idFuncionario,$idAnimal)
    {

      try{
        $conexao = Conexao::getConexao();
        $data = date ('Y-m-d H:i:s');
        $stmt = $conexao->prepare(
          "INSERT INTO atende (idFuncionario,idAnimal,data) values(?,?,?)"
        );
        $stmt->execute([
          $idFuncionario,$idAnimal,$data
        ]);
        
        if($stmt->rowCount() > 0){
          return true;
        }else{
          return false;
        }
        
        
      }catch(Exception $e){
        echo $e->getMessege();
        echo " não atende try catch";
      }


    }
    public static function removeByIdFuncionario($idFuncionario)
    {
      try {
        $conexao = Conexao::getConexao();
        $stmt = $conexao->prepare(
            "DELETE FROM atende WHERE idFuncionario= ?"
        );
        $stmt->execute([$idFuncionario]);

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

    public static function removeByIdAnimal($idAnimal)
    {
      try {
        $conexao = Conexao::getConexao();
        $stmt = $conexao->prepare(
            "DELETE FROM atende WHERE idAnimal= ?"
        );
        $stmt->execute([$idAnimal]);

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
      try {
        $conexao = Conexao::getConexao();
        $stmt = $conexao->prepare(
          "SELECT * FROM atende ORDER BY id"
        );
        $stmt->execute();
        return $stmt->fetchAll();

      }catch (Exception $e) {
        echo $e->getMessage();
        exit;
      }
    }
    public static function listarNomeAnimal(){
      try{   
          $conexao = Conexao:: getConexao();
          $stmt = $conexao->prepare(
              "SELECT al.nome 
              FROM funcionario f inner join atende a
              on f.id = a.idFuncionario
              inner join animal al  on a.idAnimal = al.id
              ORDER BY  al.nome"
          );
          $stmt->execute();

          return $stmt->fetchAll();
      }catch (Exception $e){
          echo $e->getMessage();
          exit;
      }
  }
      public static function deletar($id)
        {
          try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
              "DELETE FROM atende WHERE id = ?"
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
        public static function existeId($id)
        {
          try {
              $conexao = Conexao::getConexao();
              $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM atende WHERE id = ?"
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

  
      

 }

  

  


