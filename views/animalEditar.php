<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditarAnimal</title>
</head>
<body>
      <a href ='./../views/animalCadastro.php'>Voltar ao index</a>
     <?php
           require_once "./../configs/utils.php";
           require_once "./../model/Animal.php";
          
           $animal= null;
         
           if(isMetodo("POST")){
              print_r($_POST);
                if(parametrosValidos($_POST,["id","nome","telDono","dataCadastro"])){
                    $resultado =Animal::editar($_POST["id"],$_POST["nome"],$_POST["telDono"],$_POST["dataCadastro"]);
                    if($resultado){
                        echo "<h1>Animal editado com sucesso!</h1>";
                        echo "<a href = 'index.php> Voltar ao index</a>";
                        exit;
                    }else{
                        echo "<h1>Erro ao editar o animal</h1>";
                        echo "<a href = 'index.php> Voltar ao index</a>";
                        exit;
                    }
                    
                }else{
                    echo "<h1>Problemas na requisição de editar</h1>";
                    echo "<a href='index.php'>Voltar ao index</a>";
                    exit;
                
                }
           }

           if(isMetodo("GET")){
              if(parametrosValidos($_GET,["id"])){
                    $id = $_GET["id"];
                    if(Animal::existeId($id)){
                        $animal = Animal::getAnimalById($id);
                    }else{
                        echo "<h1>Esta animal não existe</h1>";
                        echo "<a href='index.php'>Voltar ao index</a>";
                        exit;
                    }
               }else{
                echo "<h1>Você deve dizer qual animal deve ser editada</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                exit; 
               }
           }
        
     ?>

        <h1>Editando as informações de <?= $animal["nome"] ?></h1>

        <form method="POST">
            <input type="hidden" name="id" value="<?=$animal["id"] ?>" required>

            <p>Digite nome</p>
            <input type="text" name="nome" value="<?=$animal["nome"] ?>" required>

            <p>Digite telefone</p>
            <input type ="text" name="telDono" value="<?=$animal["telDono"]?>" required><br>

            <input type ="hidden" name="dataCadastro" value="<?=$animal["dataCadastro"]?>" required><br>


            <button>Editar</button>
        </form>
        </body>
</html>