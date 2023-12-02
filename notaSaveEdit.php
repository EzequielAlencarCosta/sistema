<?php
    // isset -> serve para saber se uma variável está definida
    include_once('config.php');
    if(isset($_POST['update']))
    {
        $id_pedido = $_POST['id_pedido'];
        $cliente_nome = $_POST['cliente_nome'];
        $cliente_endereco = $_POST['cliente_endereco'];
        $cliente_cpf = $_POST['cliente_cpf'];
        $empresa_nome = $_POST['empresa_nome'];
        $empresa_cnpj = $_POST['empresa_cnpj'];
        $valor_total = $_POST['valor_total'];
        $iss=$valor_total*30/100;
        
    
       

        $sqlInsert = "INSERT into NOTA_FISCAL (pedido_id,cliente_nome,cliente_endereco,cliente_cpf,empresa_nome,empresa_cnpj,valor_total,iss,status_nf)
        VALUES('$id_pedido','$cliente_nome','$cliente_endereco','$cliente_cpf','$empresa_nome','$empresa_cnpj','$valor_total','$iss','E')";
       
        $result = $conexao->query($sqlInsert);
        print_r($result);

        $sqlUpdate = "update pedidos set status_nf='E' where  id='$id_pedido'" ;
        $result2=$conexao->query($sqlUpdate);
       

        header('Location: nfSucesso.php');
    exit();
    }
    header('Location: notaEmissao.php');

?>


