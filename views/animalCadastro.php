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
           
            //require_once "./../processar.php";
            require_once "./../views/animalCadastro.php";
             $telDono=null;
            // cadastro animal
            if(isMetodo("POST")){
                if(parametrosValidos($_POST, ["nome","raca","telDono"])) {
                    // Fazer checagens avançadas...
                    $nome = $_POST["nome"];
                    $raca = $_POST["raca"];
                    $telDono = $_POST["telDono"];
                    print_r($telDono);
    
                    if ($telDono != null){
                        if (Animal::cadastrar($nome,$raca,$telDono)) {
                            echo "<p>Animal <b>$nome</b> foi cadastrado com sucesso!</p>";
                        } else {
                            echo "<p>Erro ao cadastrar o carro <b>$nome</b></p>";
                        }
                    } else {
                        echo "<p>Não existe essa animal no sistema!</p>";
                    }
                }
            }
               
     ?>
     <h1 class="tabTitulo">Cadastro Animais </h1>
  
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text"name="nome" required>
        <p>Digite a raca</p>
        <input type="text"name="raca" required>
        <p>Digite o telDono</p>
        <input type="tel"name="telDono" required >
        

      
        <button>Cadastrar</button>
        
    </form>
     
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
                <a href='animalEditar.php?id=$id'>Editar</a> | 
                <a href='animalDeletar.php?deletarAnimal=$id'>Deletar</a>
        
            </td>";
        
        
            echo "</tr>";
        }
    // print_r($lista);
    
    ?>
    </tbody>
</table>

    
</body>
</html>