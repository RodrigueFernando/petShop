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
        require_once "./../configs/utils.php";

        if(isMetodo("POST")){
            if(parametrosValidos($_POST,["email"])){
                    $email = $_POST["email"];
                
                if(Funcionario::existeEmail($email)){
                    $email = $_POST["email"];
                   // print_r($email);
                }else{
                    echo "<h1>Esta email não existe</h1>";
                    echo "<a href='index.php'>Voltar ao index</a>";
                    exit;
                }
            }else{
                    echo"erro";
                exit;
            }
        }
    
    


     ?>
    <h2> Listar todos os animais que são cuidados por um determinado funcionário </h2>

            
        <form method="POST">
            
            <p>Selecione o email:</p>
            <select name="email" required>
                <option value ="email">----</option>
                <?php
                    $lista = Funcionario::listar();
                    foreach ($lista as $funcionario){
                       // $id =$funcionario["id"];
                        $funcEmail=$funcionario["email"];
                        echo"<option value='$funcEmail'>$funcEmail</option>";
                        
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
                    if(isMetodo("POST")){
                         
                        $lista = Funcionario::listarNomeAnimal($email);
                        //print_r($lista);
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