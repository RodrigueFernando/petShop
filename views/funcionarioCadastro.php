<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>funcionario Cadastro</title>
</head>
<body>
      <a href ='./../index.php'> Voltar ao index</a>
      <?php
             echo"<br><br>";
            require_once "./../configs/utils.php";
            require_once "./../model/Funcionario.php";
            //require_once "./../processar.php";
            require_once "./../views/funcionarioCadastro.php";

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
                }   }
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
            
            $id = $funcionario["id"];
            print_r($id);
        
            echo "<td>
           
                <a href='funcionarioEditar.php?id=$id'>Editar</a> | 
                <a href='funcionarioDeletar.php?deletarFuncionario=$id'>Deletar</a>

        
             </td>";
            echo "</tr>";
           
        
            
        }

    
     ?>
      </tbody>
    </table>

        
</body>
</html>