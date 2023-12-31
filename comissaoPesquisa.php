<?php
    session_start();
    include_once('config.php');
    // print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)|| (!isset($_SESSION['id'])== true)|| (!isset($_SESSION['nome'])== true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        unset($_SESSION['id']);
        unset($_SESSION['nome']);
        header('Location: login.php');
        print_r($_SESSION);
    }
    $logado = $_SESSION['email'];
    $nome_usuario = $_SESSION['nome'];
  

    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];

        $sql="select * from (select id_pedido,nome, comissao,'Detalhe',id_func,data_pedido from comissao 
        union all
        select id_pedido,nome ,sum(comissao)  as comissão , 'SOMA TOTAL',id_func ,data_pedido
        from comissao where data_pedido like '%$data%' or nome like '%$data%' group by nome order by 2,4) tbs where data_pedido like '%$data%' or nome like '%$data%'";



        //$sql1 = "SELECT * FROM comissao_detalhe WHERE id_pedido LIKE '%$data%' or nome LIKE '%$data%' or data_pedido like '%$data%' ";
    }
    else
    {
        $sql = "SELECT * FROM comissao_detalhe ";
    }
    $result = $conexao->query($sql);
    
    





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>SISTEMA | Pesquisa contas a pagar</title>
    <style>
        body{
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
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
   /* background-color: #4CAF50; /* Green */
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="principal.php">PAGINA INICIAL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
       
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <br>
    <?php
        echo "<h4>COMISSÃO FUNCIONÁRIOS </h4>
        <h5> Usuário: <u>$nome_usuario</u></h5>";
       
    ?>
        <br>
       
     
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar por  nome ou data " id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
        </button>
    </div>
    <br>
    


        <!--id_pedido
    comissao
    nome
    Detalhe
    id_func
    data_pedido-->
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">Id Pedido</th>
                    <th scope="col">Funcionario</th>
                    <th scope="col">Comissão</th>
                    <th scope="col">Data</th>

                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id_pedido']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['comissao']."</td>";
                        echo "<td>".$user_data['data_pedido']."</td>";
                        echo "<td>".$user_data['Detalhe']."</td>";
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'comissaoPesquisa.php?search='+search.value;
    }
</script>
</html>