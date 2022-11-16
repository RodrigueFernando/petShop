<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
     
<body>
      <a href ='./../index.php'> Voltar ao index</a>
      <?php
            require_once "./../configs/utils.php";
            require_once "./../model/Funcionario.php";
            require_once "./../model/Animal.php";
            //require_once "./../processar.php";
           

            //cadastro atente
            if(parametrosValidos($_POST,["idFuncionario","idAnimal"])){
                $idFuncionario =$_POST["idFuncionario"];
                $idAnimal =$_POST["idAnimal"];
             
                if (Funcionario::existeId($idFuncionario)) {
                    if(Atende::cadastrar($idFuncionario, $idAnimal)){
                        echo "<p>atende foi cadastrada com sucesso!</p>";
                    }else {
                        echo "<p>Erro no cadastro atende ></p>";
                        
                    }
                } else {
                    echo "<p>Não existe essa atende no sistema!</p>";
                }
                
                
            }
      ?>
       <h1>Cadastro Atende</h1>
  
  <form method="POST">
     
      <p>Selecione o funcionario:</p>
      <select name="idFuncionario" require>
          <option value = "">----</option>
          <?php
            $lista = Funcionario::listar();
            foreach ($lista as $funcionario){
              $id =$funcionario["id"];
              $nome=$funcionario["nome"];
              echo"<option value='$id'>$nome</option>";
            }
          ?>
      </select>
      <br>
      <p>Selecione o Animal:</p>
      <select name="idAnimal" require>
          <option value = "">----</option>
          <?php
            $lista = Animal::listar();
            foreach ($lista as $animal){
              $id =$animal["id"];
              $nome=$animal["nome"];
              echo"<option value='$id'>$nome</option>";
              
              
            }
          ?>
      </select>
      <br>
      <button>Cadastrar</button>
      
  </form>

    <h2>Tabela atende cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>IDFUNCIONARIO</th>
                <th>IDANIMAL</th>
             
              
            </tr>
        </thead>
        <tbody>
     <?php
 
         $lista = Atende::listar();
        foreach ($lista as $atende) {
            echo "<tr>";
            echo "<td>" . $atende["id"] . "</td>";
            echo "<td>" . $atende["idFuncionario"] . "</td>";
            echo "<td>" . $atende["idAnimal"] . "</td>";
            $id = $atende["id"];
            
            echo "<td>
           
                <a href='atendeDeletar.php?removeFuncionario=$id'>Deletar</a>
        
             </td>";
            echo "</tr>";
        
            
        }
    
      
     ?>
      </tbody>
    </table>
    
</body>
</html>