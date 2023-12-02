<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Produtos</title>
    <style>
        #search-container {
            text-align: center;
            margin-top: 50px;
        }
        #search-input {
            padding: 10px;
            width: 300px;
            font-size: 16px;
        }
        #search-results {
            margin-top: 10px;
            text-align: left;
        }
        .result-item {
            cursor: pointer;
            padding: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div id="search-container">
    <label for="search-input">Pesquisar Produto:</label>
    <input type="text" id="search-input" autocomplete="off">
    <div id="search-results"></div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Evento de digitação no campo de pesquisa
        $('#search-input').on('input', function () {
            var query = $(this).val().toLowerCase();

            // Faz a solicitação Ajax para obter os produtos correspondentes à consulta
            $.ajax({
                url: 'busca_produtos.php',
                method: 'POST',
                data: { query: query },
                success: function (resultados) {
                    exibirResultados(resultados);
                },
                error: function (erro) {
                    console.error('Erro na solicitação Ajax:', erro);
                }
            });
        });

        // Função para exibir os resultados na página
        function exibirResultados(resultados) {
            var resultadosContainer = $('#search-results');
            resultadosContainer.empty();

            resultados.forEach(function (item) {
                var resultadoItem = $('<div class="result-item"></div>');
                resultadoItem.text(item.nome_produto);

                resultadoItem.on('click', function () {
                    preencherCampo(item.nome_produto);
                });

                resultadosContainer.append(resultadoItem);
            });
        }

        // Função para preencher o campo de pesquisa com o item clicado
        function preencherCampo(item) {
            $('#search-input').val(item);
            $('#search-results').empty();
        }

        // Evento de clique fora do campo de pesquisa para fechar os resultados
        $(document).on('click', function (event) {
            if (!$(event.target).closest('#search-container').length) {
                $('#search-results').empty();
            }
        });
    });
</script>

</body>
</html>
