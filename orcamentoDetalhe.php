<?php
include ('config.php');


if(!empty($_GET['id']))
{
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM pedidos  WHERE id=$id";
    
    $result = $conexao->query($sqlSelect);
    if($result->num_rows > 0)
    {
        while($user_data = mysqli_fetch_assoc($result))
        {
            $id = $user_data['id'];
            $descricao = $user_data['data_pedido'];
           
           
        }
    }
    else
    {
        print_r($user_data);
        header('Location: orcamentoDetalhe.php');
    }
}
else
{
    
    header('Location: orcamentoPesquisa.php');
}


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <title>SITE | GN</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            text-align: center;
            color: white;
        }
        .box{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 30px;
            border-radius: 10px;
        }
        a{
            text-decoration: none;
            color: white;
            border: 3px solid dodgerblue;
            border-radius: 10px;
            padding: 10px;
        }
        a:hover{
            background-color: dodgerblue;
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
        .button {
            position: absolute;
            left: 3%;
            border-radius: 8px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            background-color: #4CAF50; color: black;
        }
        .buttonFinaliza {
            position: absolute;
            left: 3%;
            border-radius: 8px;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            
        }
    </style>
</head>
<body>
<br>
<h1>Detalhes do Orçamento</h1>

<br>




<br><h3>Orçamento:<?php  echo  $id?></h3>

<!-- Lista de itens no pedido -->

<div class="m-5" >
<table class="table text-white table-bg">
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Subtotal</th>
    </tr>
    <?php
   
    // Exibir itens no pedido
    $sql_itens_pedido = "SELECT dp.*, p.produto 
                        FROM detalhes_pedido dp
                        JOIN produtos p ON dp.produto_id = p.id
                        WHERE dp.pedido_id = $id";
    $result_itens_pedido = $conexao->query($sql_itens_pedido);

    if ($result_itens_pedido->num_rows > 0) {
        while ($item = $result_itens_pedido->fetch_assoc()) {
            echo "<tr>
                    <td>{$item['produto']}</td>
                    <td>{$item['quantidade']}</td>
                    <td>{$item['subtotal']}</td>
                </tr>";
        }
    }
    ?>
</table>
</div>

</body>
</html>
