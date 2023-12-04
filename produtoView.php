<?php


include_once('config.php');

if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sqlSelect = "SELECT a.*,b.descricao FROM produtos a INNER JOIN receitas b on a.id_receita=b.id WHERE a.id=$id";
    
    $result = $conexao->query($sqlSelect);
    if($result->num_rows > 0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
        $id = $user_data['id'];
        $produto = $user_data['produto'];
        $quantidade =$user_data['quantidade'];
        $data_validade = $user_data['data_validade'];
        $descricao = $user_data['descricao'];
        $preco = $user_data['preco'];
       
        }
    }
    else
    {
        print_r($user_data);
        header('Location: produtoView.php');
    }
}
else
{
    header('Location: produtoPesquisa.php');
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
/* Estilo para o botão */
.botao-verde {
  position: absolute;
  top: 01px; /* Ajuste conforme necessário para a posição vertical desejada */
  /*right: 100px;  Ajuste conforme necessário para a posição horizontal desejada */
  background-color: #4CAF50; /* Cor verde */
  border: none; /* Remove a borda */
  color: white; /* Cor do texto no botão */
  padding: 10px 20px; /* Espaçamento interno do botão */
  border-radius: 15px; /* Cantos arredondados */
  text-align: center; /* Centralizar o texto horizontalmente */
  text-decoration: none; /* Remover sublinhado do texto */
  display: inline-block;
  font-size: 16px;
  margin: 10px 2px;
  cursor: pointer;
}

/* Estilo para o botão quando o cursor passa por cima */
.botao-verde:hover {
  background-color: #45a049; /* Cor verde mais escura quando hover */
}

/* Estilo para o botão vermelho */
.botao-vermelho {
  position: absolute;
  top: 10px; /* Ajuste conforme necessário para a posição vertical desejada */
  right: 10px; /* Ajuste conforme necessário para a posição horizontal desejada */
  background-color: #FF0000; /* Cor vermelha */
  border: none; /* Remove a borda */
  color: white; /* Cor do texto no botão */
  padding: 10px 20px; /* Espaçamento interno do botão */
  border-radius: 15px; /* Cantos arredondados */
  text-align: center; /* Centralizar o texto horizontalmente */
  text-decoration: none; /* Remover sublinhado do texto */
  display: inline-block;
  font-size: 16px;
  cursor: pointer;
}

/* Estilo para o botão vermelho quando o cursor passa por cima */
.botao-vermelho:hover {
  background-color: #FF3333; /* Cor vermelha mais escura quando hover */
}

        
    </style>
</head>
<body>
<div class="d-flex">
            <a href="sair.php" class="botao-vermelho">Sair</a>
        </div>

    
<div class="d-flex">
            <a href="produtoPesquisa.php" class="botao-verde"> Voltar </a>
        </div>
        <br>

    <div class="m-5">
   <!-- <a href="produtoPesquisa.php">Voltar</a>-->
    <div class="box">
        <form ><!--action="funcionarioPesquisa.php" method="POST">-->
            <fieldset>
                <legend><b>Detalhes do produto</b></legend>
                <br><!--//produto,quantidade,data_validade,descricao-->
                <div class="inputBox">
                    <input type="text" name="produto" id="produto" class="inputUser" value="<?php echo $produto;?>" required>
                    <label for="produto" class="labelInput">Produto</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="quantidade" id="quantidade" class="inputUser" value="<?php echo $quantidade;?>" required>
                    <label for="quantidade" class="labelInput">Quantidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="date" name="data_validade" id="data_validade" class="inputUser" value="<?php echo $data_validade;?>"required>
                    <label for="data_validade" class="labelInput">Data Validade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="descricao" id="descricao" class="inputUser" value="<?php echo $descricao;?>"required>
                    <label for="descricao" class="labelInput">Ingredientes</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="number" name="descricao" id="preco" class="inputUser" value="<?php echo $preco;?>"required>
                    <label for="preco" class="labelInput">Preço</label>
                </div>
                <br><br>
                <!--<input type="submit" name="submit" id="submit">-->
            </fieldset>
        </form>
    </div>
</body>
</html>