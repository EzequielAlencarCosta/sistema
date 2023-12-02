<?php
    include_once('config.php');

    if(!empty($_GET['id']))
    {
        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM nota_fiscal WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0)
        {
            while($user_data = mysqli_fetch_assoc($result))
            {

                $id=$user_data['id'];
                $pedido_id=$user_data['pedido_id'];
                $cliente_nome=$user_data['cliente_nome'];
                $cliente_endereco=$user_data['cliente_endereco'];
                $cliente_cpf=$user_data['cliente_cpf'];
                $valor_total=$user_data['valor_total'];
                $status_nf=$user_data['status_nf'];
                $iss=$user_data['iss'];


                
                              
            }
        }
        else
        {
            header('Location: notaEmitidaPesquisa.php');
        }
    }
    else
    {
        header('Location: notaEmitidaPesquisa.php');
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
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
            width: 60%;
        }
        fieldset{
           
        }
        legend1{
            
            border: 1px solid dodgerblue;
            padding: 5px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
            width: 50%;
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

        @media print {
            body * {
                visibility: hidden;
            }
            #print-section, #print-section * {
                visibility: visible;
            }
            #print-section {
                position: absolute;
                left: 0;
                top: 0;
                width: 80%; /* Ajuste a largura conforme necessário */
            margin: auto; /* Centraliza a área de impressão na página */
            @page {
        size: 8.5in 11in; /* Ajuste o tamanho da página conforme necessário (exemplo: carta) */
        margin: 0.5in; /* Ajuste as margens conforme necessário */
    }   
            }
        }


    </style>

<script>
        function imprimirNota() {
            // Criar uma cópia do conteúdo que você deseja imprimir
            var conteudoImpressao = document.getElementById("print-section").innerHTML;

            // Abrir uma nova janela de impressão
            var janelaImpressao = window.open('', '', 'width=600,height=600');

            // Inserir o conteúdo na nova janela
            janelaImpressao.document.write('<html><head><title>Nota Fiscal</title></head><body>' + conteudoImpressao + '</body></html>');

            // Fechar o documento após a impressão
            janelaImpressao.document.close();

            // Imprimir o documento
            janelaImpressao.print();
        }
    </script>

</head>
<body>
    <a href="notaEmitidaPesquisa.php">Voltar</a>
    <div id="print-section">
    <div class="box">
        <form action="notaSaveEdit.php" method="POST">
            <fieldset>
                <legend><b>Nota Fiscal</b></legend>
                <br>

                <br><br>
                
                
                <label for="id" >Nro nota</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="id" id="id"  value="<?php echo $id;?>" readonly  required>
                                   
                                       
                <label for="pedido_id" >Nro pedido</label>
                    <input type="text" name="pedido_id" id="pedido_id"  value="<?php echo $pedido_id;?>" readonly required><br>
                    <br>
                   <label for="cliente_cpf" >CPF</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" name="cliente_cpf" id="cliente_cpf"  value="<?php echo $cliente_cpf;?>" readonly required>
                    
                    

                    &nbsp;
                <label for="cliente_nome" >Nome Cliente</label>
                    <input type="text" name="cliente_nome" id="cliente_nome" value="<?php echo $cliente_nome;?>" readonly required>
                
                <br><br>
                
                <label for="cliente_endereco" >Endereço Cliente</label>
                    <input type="text" name="cliente_endereco" id="cliente_endereco"  value="<?php echo $cliente_endereco;?>" readonly required>
                    
                
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                
                <label for="valor_total" >Total</label>
                    <input type="text" name="valor_total" id="valor_total" value="<?php echo $valor_total;?>" readonly required>
                    
                    <br><br>
                <label for="data_emissao"><b>Data de Emissão:</b></label>
                <input type="date" name="data_emissao" id="data_emissao" value="<?php echo $data_emissao;?>" readonly required>
             <br><br>
             <label for="empresa_nome"><b>Nome Empresa</b></label>&nbsp;
             <input  name="empresa_nome" value=<?php echo $empresa_nome;?>>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <label for="empresa_nome" ><b>&nbsp;CNPJ</b></label>
             <input  name="empresa_cnpj" value=<?php echo $empresa_cnpj;?>>
             <br><br>
             <div class="m-5" >
                <h3> Itens da Nota</h3>
<table class="table text-white table-bg">
    <tr>
        <th style=text-align:left>Produto</th>
        <th style=text-align:center>Quantidade</th>
        <th style=text-align:center>Subtotal</th>
    </tr>
    <?php
   
    // Exibir itens no pedido
    $sql_itens_pedido = "SELECT * 
                        FROM detalhes_nf where 
                        pedido_id = $pedido_id";
    $result_itens_pedido = $conexao->query($sql_itens_pedido);

    if ($result_itens_pedido->num_rows > 0) {
        while ($item = $result_itens_pedido->fetch_assoc()) {
            echo "<tr>
                    <td style=text-align:left>{$item['PRODUTO']}</td>
                    <td style=text-align:center>{$item['quantidade']}</td>
                    <td style=text-align:center>{$item['subtotal']}</td>
                </tr>";
        }
    }
    ?>
</table>
</div>
             
              
            </fieldset>
        </form>
    </div>


    
      
    </div>
    <button type="button" onclick="imprimirNota()">Imprimir Nota Fiscal</button>



</body>
</html>