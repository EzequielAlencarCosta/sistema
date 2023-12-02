<?php

    if(isset($_POST['submit']))
    {
         //print_r('Nome: ' . $_POST['nome']);
         //print_r('<br>');
         //print_r('fornecedor: ' . $_POST['fornecedor']);
         //print_r('<br>');
         //print_r('quantidade: ' . $_POST['quantidade']);
         //print_r('<br>');
         //print_r('Data de validade: ' . $_POST['data_validade']);
         //print_r('<br>');
        include_once('config.php');

        if (isset($_POST['fornecedor'])) {
            $fornecedor = $_POST['fornecedor'];
            $query = "SELECT * FROM fornecedor WHERE nome = '$fornecedor'";
            $result = mysqli_query($conexao, $query);
    
            if (mysqli_num_rows($result) == 0) {
            echo "FORNECEDOR ' $fornecedor' NÃO ENCONTRADO. POR FAVOR, INSIRA UM FORNECEDOR VALIDO";
            print_r('<br>');
            print_r('<br>');
            } else {

        $nome = $_POST['nome'];
        $fornecedor = $_POST['fornecedor'];
        $quantidade = $_POST['quantidade'];
        $data_validade = $_POST['data_validade'];
       
                  
        $result = mysqli_query($conexao, "INSERT INTO materiaprima(nome,fornecedor,quantidade,data_validade) 
        VALUES ('$nome','$fornecedor','$quantidade','$data_validade')");
            
        header('Location: materiaPrimaPesquisa.php');
            }}
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Materia Prima</title>
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
            width: 20%;
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
    <a href="materiaPrimaPesquisa.php">Voltar Para Pesquisa</a>
    <div class="box">
        <form action="materiaPrimaCadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro Materia prima</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome</label>
                </div>
                <br>
               <br>
                <div class="inputBox">
                    <input type="text" name="fornecedor" id="fornecedor" class="inputUser" required>
                    <label for="fornecedor" class="labelInput">Fornecedor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="quantidade" id="quantidade" class="inputUser" required>
                    <label for="quantidade" class="labelInput">Quantidade</label>
                </div>
                             
                <br><br>
                <label for="data_validade"><b>Data de Validade:</b></label>
                <input type="date" name="data_validade" id="data_validade" required>
                <br><br><br>
                           
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>