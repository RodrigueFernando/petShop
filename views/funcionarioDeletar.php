<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <a href ='./../views/funcionarioCadastro.php'>Voltar ao Cadastro</a>
     <?php
       
      
          require_once "./../configs/utils.php";
          require_once "./../model/Funcionario.php";
          require_once "./../model/Animal.php";
          require_once "./../model/Atende.php";
         
       // deleta funcionario
    
    
        if (isMetodo("GET")) {
            print_r($_GET);
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
     ?>
</body>
</html>