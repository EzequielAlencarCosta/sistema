<?php

    if(isset($_POST['submit']))
    {
       /*  print_r('cpf: ' . $_POST['cpf']);
         print_r('<br>');
         print_r('nr_ctps: ' . $_POST['nr_ctps']);
         print_r('<br>');
         print_r('admissao: ' . $_POST['admissao']);
         print_r('<br>');
         print_r('cargo: ' . $_POST['cargo']);
         print_r('<br>');
       */

        include_once('config.php');

        if (isset($_POST['cpf'])) {
            $cpf = $_POST['cpf'];
            $query = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
            $result = mysqli_query($conexao, $query);
    
            if (mysqli_num_rows($result) == 0) {
            echo "CPF ' $cpf' NÃO CADASTRADO NA PAGINA DE USUARIOS . POR FAVOR, FAÇA O CADASTRO DO USUARIO PRIMEIRO";
            print_r('<br>');
            print_r('<br>');
            } else {
                
                $cpf = $_POST['cpf'];
                $nr_ctps =$_POST['nr_ctps'];
                $admissao =$_POST['admissao'];
                $cargo = $_POST['cargo'];
                $salario = $_POST['salario'];
                $departamento = $_POST['departamento'];

                $result = mysqli_query($conexao, "INSERT INTO funcionarios(cpf,nr_ctps,admissao,cargo,salario,departamento) VALUES ('$cpf','$nr_ctps','$admissao','$cargo','$salario','$departamento')");
                
                $postValues1 = "CPF: $cpf\nNúmero da CTPS: $nr_ctps\nData de Admissão: $admissao\nCargo: $cargo\nSalário: $salario\nDepartamento: $departamento\nID: $id\nINSERT:$result";
    
                // Caminho para o arquivo de texto onde você deseja salvar os valores
                $arquivoTexto1 = 'C:\app\xampp\htdocs\sistema\log\saida_post_insert1.txt';
            
                // Abra o arquivo para escrita (use 'a' para adicionar ao arquivo se ele já existir)
                $file1 = fopen($arquivoTexto1, 'a');
            
                // Escreva a string de valores no arquivo
                fwrite($file1, $postValues1);
            
                // Feche o arquivo
                fclose($file1);






                header('Location: funcionarioPesquisa.php');
                

                 }
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5/dist/jquery.inputmask.min.js"></script>
  
    <title>Formulário | GN</title>
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
        #data_nascimento{
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

<?php
             ;
       
    ?>
    <a href="funcionarioPesquisa.php">Voltar</a>
    <div class="box">
       
    <form action="funcionarioCadastro.php" method="POST">
            
        <fieldset>
                <legend><b>Cadastro de Funcionários</b></legend>
                <br><!--cpf,nr_ctps,admissao,cargo,salario,departamento-->
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" maxlength="14" required>
                    <label for="cpf" class="labelInput">Cpf</label>
                </div>
                <script>
      // Aplica a máscara de CPF ao campo de entrada
      $(document).ready(function(){
        $('cpf').inputmask('999.999.999-99');
      });
    </script>
                <br>
                <div class="inputBox">
                    <input type="text" name="nr_ctps" id="nr_ctps" class="inputUser" required>
                    <label for="nr_ctps" class="labelInput">Carteira de trabalho</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="admissao" id="admissao" class="inputUser" required>
                    <label for="admissao" class="labelInput">Data Admissão</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cargo" id="cargo" class="inputUser" required>
                    <label for="cargo" class="labelInput">Cargo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="salario" id="salario" class="inputUser" required>
                    <label for="salario" class="labelInput">Salario</label>
                </div>
                           
                <br><br>
                <div class="inputBox">
                    <input type="text" name="departamento" id="departamento" class="inputUser" required>
                    <label for="departamento" class="labelInput">Departamento</label>
                </div>
                <br><br>
                           
                <br><br>
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>