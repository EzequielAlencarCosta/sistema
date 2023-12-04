<?php
    include_once('config.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM venda_finalizada WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {

                $id_pedido = $user_data['id'];
                $cliente_nome = $user_data['nome'];
                $cliente_endereco = $user_data['endereco'];
                $cliente_cpf = $user_data['cpf'];
                $valor_total = $user_data['total'];
                $iss = $user_data['total']*30/100;
                              
            }
        }
        else
        {
            header('Location: notaEmissaoPesquisa.php');
        }
    }
    else
    {
        header('Location: notaEmissaoPesquisa.php');
    }


    $sqlSelectEmpresa = "SELECT * FROM empresa";
        $resultEmpresa = $conexao->query($sqlSelectEmpresa);
        if($resultEmpresa->num_rows > 0)
        {
            while($user_data1 = mysqli_fetch_assoc($resultEmpresa))
            {
                $empresa_nome = $user_data1['nome'];
                $empresa_cnpj = $user_data1['cnpj'];
         
                              
            }
        }
        date_default_timezone_set('America/Sao_Paulo');
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
    <a href="notaEmissaoPesquisa.php">Voltar</a>
    <div class="box">
        <form action="notaSaveEdit.php" method="POST">
            <fieldset>
                <legend><b>Emitir Nota Fiscal</b></legend>
                <br>
        
              
                <div class="inputBox">
                    <input type="text" name="id_pedido" id="id_pedido" class="inputUser" value="<?php echo $id_pedido;?>" required>
                    <label for="id_pedido" class="labelInput">Nro pedido</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="cliente_nome" id="cliente_nome" class="inputUser" value="<?php echo $cliente_nome;?>" required>
                    <label for="cliente_nome" class="labelInput">Nome Cliente</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cliente_endereco" id="cliente_endereco" class="inputUser" value="<?php echo $cliente_endereco;?>" required>
                    <label for="cliente_endereco" class="labelInput">Endereço Cliente</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cliente_cpf" id="cliente_cpf" class="inputUser" value="<?php echo $cliente_cpf;?>" required>
                    <label for="cliente_cpf" class="labelInput">CPF</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="valor_total" id="valor_total" class="inputUser" value="<?php echo $valor_total;?>" required>
                    <label for="valor_total" class="labelInput">Total</label>
                </div>
                <br><br>
                <div class="inputBox">
                <label for="data_emissao"><b>Data de Emissão:</b></label>
                <input type="date" name="data_emissao" id="data_emissao" value="<?php echo date('Y-m-d'); ?>" required>
    </div><br><br>
             <input type="hidden" name="empresa_nome" value=<?php echo $empresa_nome;?>>
             <input type="hidden" name="empresa_cnpj" value=<?php echo $empresa_cnpj;?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>