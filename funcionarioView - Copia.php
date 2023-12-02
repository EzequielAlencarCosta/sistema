<?php


include_once('config.php');

if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM funcionarios WHERE id=$id";
    $result = $conexao->query($sqlSelect);
    if($result->num_rows > 0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
        $id = $user_data['id'];
        $cpf = $user_data['cpf'];
        $nr_ctps =$user_data['nr_ctps'];
        $admissao = $user_data['admissao'];
        $cargo = $user_data['cargo'];
        $salario = $user_data['salario'];
        $departamento = $user_data['departamento'];
       
        }
    }
    else
    {
        print_r($user_data);
        header('Location: funcionarioEdita.php');
    }
}
else
{
    header('Location: funcionarioPesquisa.php');
}

     


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <a href="funcionarioPesquisa.php">Voltar</a>
    <div class="box">
        <form ><!--action="funcionarioPesquisa.php" method="POST">-->
            <fieldset>
                <legend><b>Fórmulário de Funcionarios</b></legend>
                <br><!--cpf,nr_ctps,admissao,cargo,salario,departamento-->
                <div class="inputBox">
                    <input type="text" name="cpf" id="cpf" class="inputUser" value="<?php echo $cpf;?>" required>
                    <label for="cpf" class="labelInput">Cpf</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="nr_ctps" id="nr_ctps" class="inputUser" value="<?php echo $nr_ctps;?>" required>
                    <label for="nr_ctps" class="labelInput">Carteira de trabalho</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="admissao" id="admissao" class="inputUser" value="<?php echo $admissao;?>"required>
                    <label for="admissao" class="labelInput">Data Admissão</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cargo" id="cargo" class="inputUser" value="<?php echo $cargo;?>"required>
                    <label for="cargo" class="labelInput">Cargo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cargo" id="salario" class="inputUser"value="<?php echo $salario;?>" required>
                    <label for="salario" class="labelInput">Salario</label>
                </div>
                           
                <br><br>
                <div class="inputBox">
                    <input type="text" name="departamento" id="departamento" class="inputUser" value="<?php echo $departamento;?>"required>
                    <label for="departamento" class="labelInput">Departamento</label>
                </div>
                           
                <br><br>
                           
                <br><br>
                <!--<input type="submit" name="submit" id="submit">-->
            </fieldset>
        </form>
    </div>
</body>
</html>