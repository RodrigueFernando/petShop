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
        $nome=null;
        if(isMetodo("GET")){
            if(parametrosValidos($_GET,["nome"])){
                 $nome = $_GET["nome"];
            }
        }
            
        
    


     ?>
    <h2> Listar todos os funcionários que cuidam de um determinado animal  </h2>

            
        <form method="GET">
            
            <p>Selecione o nome:</p>
            <select name="nome" required>
                <option value = "">----</option>
                <?php
                    $lista = Animal::listar();
                    foreach ($lista as $animal){
                       // $id =$funcionario["id"];
                        $funcNome=$animal["nome"];
                        echo"<option value='$funcNome'>$funcNome</option>";
                        
                    }

                    
                ?>
                
            </select>

            <br>
            <button> Buscar</button>
        </form>


        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                
                </tr>
            </thead>
            <tbody>
                <?php
                     
                if($nome != null){
                    //print_r($nome);
                      
                    $lista =Funcionario::listarNomeFuncionario($nome);
                    print_r($lista);
                    foreach ($lista as $funcionario) {
                        echo "<tr>";
                        echo "<td>" .$funcionario["nome"] . "</td>";
                        echo "</tr>";
                    
                    }
                }
                
                ?>
        </tbody>
        </table>
    
    
</body>
</html>