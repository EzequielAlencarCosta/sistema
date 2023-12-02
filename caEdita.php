<?php
    include_once('config.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuarios WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {
                $id = $user_data['id'];
                $nome = $user_data['nome'];
                               
            }
        }
        else
        {
            header('Location: caPesquisa.php');
        }
    }
    else
    {
        header('Location: caPesquisa.php');
    }

    if (isset($_POST['update'])) {
        $selectedFunctions = array();
    
        // Verifica se cada checkbox está marcado
        $functions = array("funcionario", "fornecedor", "materiaPrima", "admin", "receita", "Produtos", "estoque", "vendas", "usuarios", "comissao", "financeiro");
        foreach ($functions as $function) {
            if (isset($_POST[$function])) {
                $selectedFunctions[] = $function;
            }
        }
    
        // Insere as funções selecionadas na tabela usuario_funcoes
        foreach ($selectedFunctions as $selectedFunction) {
            $sqlInsertFunction = "INSERT INTO usuario_funcoes (id_usuario, nome_funcao) VALUES ($id, '$selectedFunction')";
            $conexao->query($sqlInsertFunction);
        }
    
        // Agora, você pode redirecionar ou realizar ações adicionais conforme necessário.
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
    <a href="caPesquisa.php">Voltar</a>
    <div class="box">
        <form action="caSaveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Usuario</b></legend>
                <br>
                
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" value="<?php echo $nome;?>" required>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br>
               
                
  <p>Escolha as funções :</p>

  <div>
    <input type="checkbox" id="funcionario" name="funcionario" value="funcionario"  > 
    <label for="funcionario">funcionarios</label>
    
    <input type="checkbox" id="fornecedor" name="fornecedor" value="fornecedor"  > 
    <label for="fornecedor">fornecedor</label>
    
    <input type="checkbox" id="materiaPrima" name="materiaPrima" value="materiaPrima"  > 
    <label for="materiaPrima">materiaPrima</label>
    <br>
    <input type="checkbox" id="admin" name="admin" value="admin"  > 
    <label for="admin">admin</label>
    
    <input type="checkbox" id="receita" name="receita" value="receita"  > 
    <label for="receita">receita</label>
    
    <input type="checkbox" id="Produtos" name="Produtos" value="Produtos"  > 
    <label for="Produtos">Produtos</label>
    <br>
    <input type="checkbox" id="estoque" name="estoque" value="estoque"  > 
    <label for="estoque">estoque</label>
    
    <input type="checkbox" id="vendas" name="vendas" value="vendas"  > 
    <label for="vendas">vendas</label>
    
    <input type="checkbox" id="usuarios" name="usuarios" value="usuarios"  > 
    <label for="usuarios">usuarios</label>
    <br> 
    <input type="checkbox" id="comissao" name="comissao" value="comissao"  > 
    <label for="comissao">comissao</label>
    
    <input type="checkbox" id="financeiro" name="financeiro" value="financeiro" > 
    <label for="financeiro">financeiro</label>
    <br>
</div>

                <br><br>
                <input type="hidden" name="id" value=<?php echo $id;?>>
                <input type="submit" name="update" id="submit">
            </fieldset>
        </form>
    </div>
</body>
</html>