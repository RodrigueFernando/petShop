<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <?php
       require_once "configs/utils.php";
       require_once "model/Funcionario.php";
       require_once "model/Animal.php";
       require_once "model/Atende.php";

   

     // $dataCadastro = date ('Y-m-d H:i:s');
      // deleta funcionario
      if (isMetodo("GET")) {
            if (parametrosValidos($_GET, ["deletarFuncionario"])) {
                $id = $_GET["deletarFuncionario"];
                if (Funcionario::existeId($id)) {
                    Atende::removeByIdFuncionario($id);
                    $resultado = Funcionario::deletar($id);
                    if ($resultado) {
                        echo "<p>Funcionario deletada com sucesso!</p>";
                    } else {
                        echo "<p>Deu ruim!</p>";
                    }
                } else {
                    echo "<p>Essa funcionario não existe!</p>";
                    die;
                }
        }
     }
 
        // cadastrar funcionario
       if(isMetodo("POST")){
            if(parametrosValidos($_POST,["nome","email"])){
                $nome = $_POST["nome"];
                $email = $_POST['email'];
              

                if(!Funcionario::existeEmail($email)){
                    if(Funcionario:: cadastrar($nome,$email)){
                        echo"<p>O funcionario<b>$$nome<b> foi cadastrado  com sucesso!</p>";
                    }else{
                        echo "<p>Erro ao cadastrar funcionario <b>$nome</b></p>";
                    }
                }else {
                    echo "<p>Já existe uma funcionario com o email $email</p>";
                }
            }
   
            if (isMetodo("GET")) {
                if (parametrosValidos($_GET, ["deletarAnimal"])) {
                    $id = $_GET["deletarAnimal"];
                    if (Funcionario::existeId($id)) {
                        Atende::removeByIdAnimal($id);
                        $resultado = Funcionario::deletar($id);
                        if ($resultado) {
                            echo "<p>Funcionario deletada com sucesso!</p>";
                        } else {
                            echo "<p>Deu ruim!</p>";
                        }
                    } else {
                        echo "<p>Essa funcionario não existe!</p>";
                        die;
                    }
                }
            }
            // cadastro animal
            if(parametrosValidos($_POST, ["nome","raca","telDono"])) {
                // Fazer checagens avançadas...
                $nome = $_POST["nome"];
                $raca = $_POST["raca"];
                $telDono = $_POST["telDono"];

                if (Animal::existeId($telDono)) {
                    if (Animal::cadastrar($nome, $raca, $telDono)) {
                        echo "<p>Animal <b>$nome</b> foi cadastrado com sucesso!</p>";
                    } else {
                        echo "<p>Erro ao cadastrar o carro <b>$nome</b></p>";
                    }
                } else {
                    echo "<p>Não existe essa animal no sistema!</p>";
                }
            }

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
                
                
            }else{
                echo "Erro  no atende";
            }
       }
    ?>
    <h1>Cadastrar Funcionario</h1>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text"name ="nome" required>
        <p>Digite o email</p>
        <input type="email"name ="email" required>
  
        <br>
        <button>Cadastrar</button>
    </form>


    <h1>Cadastro Animal </h1>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text"name="nome" required>
        <p>Digite a raca</p>
        <input type="text"name="raca" required>
        <p>Digite o telDono</p>
        <input type="tel"name="telDono" required >
        

      
        <button>Cadastrar</button>
        
    </form>

        
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

   


    <h2>Tabela de funcionario cadastradas</h2>
<table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>dataCadastro</th>
            
              
            </tr>
        </thead>
        <tbody>
     <?php
        $lista = Funcionario::listar();
        foreach ($lista as $funcionario) {
            echo "<tr>";
            echo "<td>" . $funcionario["id"] . "</td>";
            echo "<td>" . $funcionario["nome"] . "</td>";
            echo "<td>" . $funcionario["email"] . "</td>";
            echo "<td>" . $funcionario["dataCadastro"] . "</td>";
            //echo "<td>" . $dataCadastro . "</td>";
            $id = $funcionario["id"];
            echo "<td>
                <a href='editarFuncionario.php?id=$id'>Editar</a> | 
                <a href='index.php?deletarFuncionario=$id'>Deletar</a>
        
             </td>";
            echo "</tr>";
            
        }

    
     ?>
      </tbody>
    </table>

    
    

    <h2>Tabela de animal cadastrados</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>RACA</th>
                <th>TELDono</th>
                <th>DATACADASTRO</th>
              
            </tr>
        </thead>
        <tbody>
     <?php
        $lista = Animal::listar();

        foreach ($lista as $animal) {
            echo "<tr>";
            echo "<td>" . $animal["id"] . "</td>";
            echo "<td>" . $animal["nome"] . "</td>";
            echo "<td>" . $animal["raca"] . "</td>";
            echo "<td>" . $animal["telDono"] . "</td>";
            echo "<td>" . $animal["dataCadastro"] . "</td>";
            $id = $animal["id"];
            echo "<td>
                <a href='editarAnimal.php?id=$id'>Editar</a> | 
                <a href='index.php?deletarAnimal=$id'>Deletar</a>
        
            </td>";
           
        
            echo "</tr>";
        }
       // print_r($lista);
      
     ?>
      </tbody>
    </table>


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
        
            echo "</tr>";
        }
    
      
     ?>
      </tbody>
    </table>


    <h2> Listar todos os animais que são cuidados por um determinado funcionário </h2>

    
    <form method="POST">
        
        <p>Selecione o email:</p>
        <select name="idFuncionario" require>
            <option value = "">----</option>
            <?php
                $lista = Funcionario::listar();
                foreach ($lista as $funcionario){
                $id =$funcionario["id"];
                $email=$funcionario["email"];
                echo"<option value='$id'>$email</option>";
                }
                $id = $funcionario["id"];
                echo "<td>
                    <a href='editarFuncionario.php?id=$id'>Editar</a> | 
                    <a href='index.php?deletarPessoa=$id'>Deletar</a>
            
                </td>";
                echo "</tr>";
            ?>
        </select>
    
        <br>
        <button> Editar</button>

    </form>  

    <table>
        <thead>
            <tr>
                <th>Nome</th>
              
            </tr>
        </thead>
        <tbody>
            <?php
             
            
                    $lista =Funcionario::listarNomeAnimal($id);
                    foreach ($lista as $funcionario) {
                        echo "<tr>";
                        echo "<td>" . $funcionario["nome"] . "</td>";
                        echo "</tr>";
                    }
                
        
                
            
            
            ?>
      </tbody>
    </table>
   
  
   
    
    <h2>Listar todos os funcionários que cuidam de um determinado animal:</h2><br>
    <select name="idFuncionario" require>
    
        <option  value = "">----</option>
        <?php
            $lista = Funcionario::listar();
            foreach ($lista as $funcionario){
            $id =$funcionario["id"];
            $nome=$funcionario["nome"];
            echo"<option name = '$id' value='$id'>$nome</option>";
            }
        ?>

    </select>
   

    <table>
        <thead>
            <tr>
            <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>dataCadastro</th>
             
              
            </tr>
        </thead>
        <tbody>
     <?php
 
         $lista =Funcionario::listarNomeAnimal($id);
         foreach ($lista as $funcionario) {
            echo "<tr>";
            echo "<td>" . $funcionario["nome"] . "</td>";
          
        
            echo "</tr>";
        }
    
      
     ?>
      </tbody>
    </table>

   


</body>
</html>