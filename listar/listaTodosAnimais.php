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

        require_once "./../model/Funcionario.php";
        require_once "./../model/Animal.php";
        require_once "./../configs/utils.php";
        $raca=null;
        if(isMetodo("GET")){
            if(parametrosValidos($_GET,["raca"])){
                $raca = $_GET["raca"];
                // print_r($raca);
                
            }
        }
    ?>

<h2> Listar todos os animais de uma determinada raça </h2>

            
<form method="GET">
    
    <p>Selecione o raça:</p>
    <select name="raca" required>
        <option value = "">----</option>
        <?php
            $lista = Animal::listar();
            foreach ($lista as $animal){
               // $id =$funcionario["id"];
                $animalRaca=$animal["raca"];
                echo"<option value='$animalRaca'>$animalRaca</option>";
                
            }

            
        ?>
        
    </select>

    <br>
    <button> Buscar</button>
</form>
<table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>RACA</th>
                    <th>TELDONO</th>
                    <th>DATACADASRO</th>

                    
                
                </tr>
            </thead>
            <tbody>
                <?php
                     
                if($raca!= null){
                    //print_r($nome);
                      
                    $lista = Animal::listarTodosAnimais($raca);
                    //print_r($lista);
                    foreach ($lista as $animal) {
                        echo "<tr>";
                        echo "<td>" .$animal["id"] . "</td>";
                        echo "<td>" .$animal["nome"] . "</td>";
                        echo "<td>" .$animal["raca"] . "</td>";
                        echo "<td>" .$animal["telDono"] . "</td>";
                        echo "<td>" .$animal["dataCadastro"] . "</td>";
                        echo "</tr>";
                    
                    }
                }
                
                ?>
        </tbody>
        </table>
    


    
</body>
</html>