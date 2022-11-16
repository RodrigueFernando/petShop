<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href ='./../views/atendeCadastro.php'> Voltar ao index</a>
    <?php
        require_once "./../configs/utils.php";
        require_once "./../model/Funcionario.php";
        require_once "./../model/Animal.php";
        require_once "./../model/Atende.php";
        // deleta atende
      if (isMetodo("GET")) {
    
            if (parametrosValidos($_GET, ["removeFuncionario"])) {
              
                $id = $_GET["removeFuncionario"];
            
                if (Atende::existeId($id)) {
                    $count=Atende::removeByIdFuncionario($id);
                    $resultado = Atende::deletar($id);
                    if ($resultado) {
                        echo "<p>atende deletada com sucesso!</p>";
                    } else {
                        echo "<p> Algo  deu  errado!</p>";
                    }
                } else {
                    echo "<p>Essa atende não existe!</p>";
                    die;
                }
             }
        }
    ?>
    
</body>
</html>