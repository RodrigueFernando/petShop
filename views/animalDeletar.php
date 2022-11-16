<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href ='./../views/animalCadastro.php'> Voltar ao index</a>
    <?php
           require_once "./../configs/utils.php";
           require_once "./../model/Funcionario.php";
           require_once "./../model/Animal.php";
           require_once "./../model/Atende.php";
         // deleta animal
      if (isMetodo("GET")) {
            if (parametrosValidos($_GET, ["deletarAnimal"])) {
                print_r($_GET);
                $id = $_GET["deletarAnimal"];
                if (Animal::existeId($id)) {
                    Atende::removeByIdAnimal($id);
                    $resultado = Animal::deletar($id);
                    if ($resultado) {
                        echo "<p>Animal deletada com sucesso!</p>";
                    } else {
                        echo "<p>Deu ruim!</p>";
                    }
                } else {
                    echo "<p>Essa Animal não existe!</p>";
                    die;
                }
             }
        }
    ?>
    
</body>
</html>
