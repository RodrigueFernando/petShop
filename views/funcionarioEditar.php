<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionario</title>
</head>
<body>
      <a href ='./../views/funcionarioCadastro.php'> Voltar ao index</a>
      <?php
        require_once "./../index.php";
        require_once "./../configs/utils.php";
        require_once "./../model/Funcionario.php";
        require_once "./../model/Animal.php";
        require_once "./../model/Atende.php";
       
        
        $funcionario = null;
    
        if(isMetodo("POST")){
          
            if(parametrosValidos($_POST,["id","nome","email","dataCadastro"])){
                $resultado = Funcionario::editar($_POST["id"],$_POST["nome"],$_POST["email"],$_POST["dataCadastro"]);
                if($resultado){
                    echo "<h1>Funcionario editado com sucesso!</h1>";
                    echo "<a href ='index.php'>Voltar ao index</a>";
                    exit;
                }else{
                    echo "<h1>Erro ao editar o funcionario</h1>";
                    echo "<a href ='index.php'>Voltar ao index</a>";
                    exit;
                }
            }else{
                echo "<h1>Problemas na requisição de editar</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
      
                die;
            }
        }

        if(isMetodo("GET")){
            if(parametrosValidos($_GET,["id"])){
                $id = $_GET["id"];
                if(Funcionario::existeId($id)){
                    $funcionario =Funcionario::getFuncionarioById($id);
                }else{
                    echo "<h1>Esta funcionario não existe</h1>";
                    echo "<a href='index.php'>Voltar ao index</a>";
                    exit;
                }
            }else {
                echo "<h1>Você deve dizer qual funcionario deve ser editada</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                exit;
            }
        }

      ?>
        <h1>Editando as informações de <?= $funcionario["nome"] ?></h1>

        <form method="POST">
        <input type="hidden" name="id" value="<?=$funcionario["id"] ?>" required>
            <p>Digite nome</p>
            <input type="text" name="nome" value="<?=$funcionario["nome"] ?>" required>
      
            <p>Digite email</p>
            <input type ="email" name="email" value="<?=$funcionario["email"]?>" required><br>

            <input type ="hidden" name="dataCadastro" value="<?=$funcionario["dataCadastro"]?>" required><br>


            <button>Editar</button>
        </form>
</body>
</html>