<?php
    
    include_once('config.php');

    if(isset($_POST['update']))
    {
        $id = $_POST['id'];
        $cpf = $_POST['cpf'];
        $nr_ctps = $_POST['nr_ctps'];
        $admissao = $_POST['admissao'];
        $cargo = $_POST['cargo'];
        $salario = $_POST['salario'];
        $departamento = $_POST['departamento'];
       
               
        $sqlInsert = "UPDATE funcionarios SET cpf='$cpf',nr_ctps='$nr_ctps',admissao='$admissao',cargo='$cargo',salario='$salario',departamento='$departamento' WHERE id=$id";
        $result = $conexao->query($sqlInsert);

        $postValues1 = "CPF: $cpf\nNúmero da CTPS: $nr_ctps\nData de Admissão: $admissao\nCargo: $cargo\nSalário: $salario\nDepartamento: $departamento\nID: $id\nUPDATE:$result";
    
        // Caminho para o arquivo de texto onde você deseja salvar os valores
        $arquivoTexto1 = 'C:\app\xampp\htdocs\sistema\log\saida_post_save_edit1.txt';
    
        // Abra o arquivo para escrita (use 'a' para adicionar ao arquivo se ele já existir)
        $file1 = fopen($arquivoTexto1, 'a');
    
        // Escreva a string de valores no arquivo
        fwrite($file1, $postValues1);
    
        // Feche o arquivo
        fclose($file1);


              
    }
    header('Location: funcionarioPesquisa.php');

  /*  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Receba os valores enviados pelo formulário após o envio
        $id = $_POST['id'];
        $cpf = $_POST['cpf'];
        $nr_ctps = $_POST['nr_ctps'];
        $admissao = $_POST['admissao'];
        $cargo = $_POST['cargo'];
        $salario = $_POST['salario'];
        $departamento = $_POST['departamento'];

        
        $sqlInsert = "UPDATE funcionarios SET
         cpf='$cpf',
         nr_ctps='$nr_ctps',
         admissao='$admissao',
         cargo='$cargo',
         salario='$salario',
         departamento='$departamento' 
         WHERE id=$id";
    
    $result = $conexao->query($sqlInsert);
        // Crie uma string com os valores do $_POST formatados
        //$postValues = "CPF: $cpf\nNúmero da CTPS: $nr_ctps\nData de Admissão: $admissao\nCargo: $cargo\nSalário: $salario\nDepartamento: $departamento\nID: $id\nUPDATE:$result";
        $postValues = "UPDATE:$sqlInsert";
    
        // Caminho para o arquivo de texto onde você deseja salvar os valores
        $arquivoTexto = 'C:\app\xampp\htdocs\sistema\log\saida_post_save_edit.txt';
    
        // Abra o arquivo para escrita (use 'a' para adicionar ao arquivo se ele já existir)
        $file = fopen($arquivoTexto, 'a');
    
        // Escreva a string de valores no arquivo
        fwrite($file, $postValues);
    
        // Feche o arquivo
        fclose($file);
    }*/
    

?>




