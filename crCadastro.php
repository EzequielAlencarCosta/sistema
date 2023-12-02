<?php

    if(isset($_POST['submit']))
    {
        include_once('config.php');


        
        $id = $_POST['id'];
        $descricao = $_POST['descricao'];
        $codpagamento = $_POST['codpagamento'];
        $valor = $_POST['valor'];
        $dt_recebimento = $_POST['dt_recebimento'];
        $formapgto = $_POST['formapgto'];
        
        $result = mysqli_query($conexao, "INSERT INTO contasreceber(descricao,codpagamento,valor,dt_recebimento,formapgto) 
        VALUES ('$descricao','$codpagamento','$valor','$dt_recebimento','$formapgto')");

        header('Location: crPesquisa.php');
    }
    date_default_timezone_set('America/Sao_Paulo');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Cadastro Contas a Pagar</title>
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
        .inputbox{
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
            width: 50%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            position: absolute;
            top: 80%;
            left: 25%;
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
            <a href="crPesquisa.php" class="botao-verde">Voltar</a>
        </div>

   
    <div class="box">
        <form action="crCadastro.php" method="POST">
            <fieldset>
                <legend><b>Cadastro contas a receber</b></legend>
                <br><br><br>
                <div class="inputbox">
                    <input type="text" name="descricao" id="descricao" class="inputUser" required>
                    <label for="descricao" class="labelInput">Descrição</label>
                </div>
                <br>
               <br>
                <div class="inputbox">
                    <input type="text" name="codpagamento" id="codpagamento" class="inputUser" required>
                    <label for="codpagamento" class="labelInput">Codigo de pagto</label>
                </div>
                             
               
                <br><br>
                <div class="inputbox">
                    <input type="text" name="formapgto" id="formapgto" class="inputUser" required>
                    <label for="formapgto" class="labelInput">Forma Pagamento</label>
                </div>
                
                <br><br>

                <div class="inputbox">
                    <input type="text" name="valor" id="valor" class="inputUser" required>
                    <label for="valor" class="labelInput">Valor</label>
                </div>
                <br>
                <label for="dt_recebimento"><b>Data do dt_recebimento:</b></label>
                <input type="date" name="dt_recebimento" id="dt_recebimento" value="<?php echo date('Y-m-d'); ?>" required>
                <br><br><br>
                <br><br><br>        
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>