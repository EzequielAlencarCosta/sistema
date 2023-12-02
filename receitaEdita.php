<?php
    include_once('config.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM receitas WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $id = $user_data['id'];
                $nome = $user_data['nome'];
                $autor = $user_data['autor'];
                $validade_dias = $user_data['validade_dias'];
                $descricao = $user_data['descricao'];
                //print_r($user_data['descricao']);
                //print_r('<br>');
                //print_r($descricao);
                
            }
        }
        else
        {
            header('Location: receitaPesquisa.php');
        }
    }
    else
    {
        header('Location: receitaPesquisa.php');
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
    <a href="receitaPesquisa.php">Voltar</a>
    <div class="box">
        <form action="receitaSaveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Receita</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome;?>" required>
                    <label for="nome" class="labelInput">Nome </label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="autor" id="autor" class="inputUser" value="<?php echo $autor;?>" required>
                    <label for="autor" class="labelInput">Autor</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="validade_dias" id="validade_dias" class="inputUser" value="<?php echo $validade_dias;?>" required>
                    <label for="validade_dias" class="labelInput">Dias de Validade</label>
                </div>
                <br><br>
                <div class="inputBox1">
                    <input type="textarea" name="descricao" id="descricao" class="inputUser" value="<?php print_r($descricao);?>" required>
                    <label for="descricao" class="labelInput">Descricao</label>
                </div>
                
                <br><br>
                <input type="hidden" name="id" value=<?php echo $id;?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>