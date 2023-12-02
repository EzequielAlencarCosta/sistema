<?php

    if(isset($_POST['submit']))
    {
         print_r('Nome: ' . $_POST['nome']);
         print_r('<br>');
         print_r('Autor: ' . $_POST['autor']);
         print_r('<br>');
         print_r('validade_dias: ' . $_POST['Validade_dias']);
         print_r('<br>');
         print_r('Descricao: ' . $_POST['descricao']);
         print_r('<br>');
        include_once('config.php');

        $nome = $_POST['nome'];
        $autor = $_POST['autor'];
        $validade_dias = $_POST['validade_dias'];
        $descricao = $_POST['descricao'];
        

        $result = mysqli_query($conexao, "INSERT INTO receitas(nome,autor,validade_dias,descricao) 
        VALUES ('$nome','$autor','$validade_dias','$descricao')");

        header('Location: receitaPesquisa.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Receitas</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box{
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 30%;
        }
        fieldset{
            border: 3px solid dodgerblue;
        }
        legend{
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }

       
        
        #data_cadastro{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195));
        }
    </style>
</head>
<body>
    <a href="receitaPesquisa.php">Voltar</a>
    <div class="box">
        <form action="receitaCadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro Receitas</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome </label>
                </div>
                <br>
               <br>
                <div class="inputBox">
                    <input type="text" name="autor" id="autor" class="inputUser" required>
                    <label for="autor" class="labelInput">autor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="validade_dias" id="validade_dias" class="inputUser" required>
                    <label for="validade_dias" class="labelInput">validade_dias</label>
                </div>
                <br><br><br>
                <div class="inputBox">
                    <input type="textarea" name="descricao" id="descricao" class="inputUser" required>
                    <label for="descricao" class="labelInput">descricao</label>
                </div>
                <br><br>
                
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>