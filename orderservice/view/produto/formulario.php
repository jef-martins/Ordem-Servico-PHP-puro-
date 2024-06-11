<h2>Formulário de Produto</h2>
<form id="produtoForm">
    <div class="form-group">
        <label for="codigo">Codigo Produto:</label>
        <input type="text" class="form-control" id="txtCodigo" name="txtCodigo" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição Produto:</label>
        <input type="text" class="form-control" id="txtDescricao" name="txtDescricao" required>
    </div>
    <div class="form-group">
        <label for="status">Status Produto:</label>
        <input type="text" class="form-control" id="txtStatus" name="txtStatus" required>
    </div>
    <div class="form-group">
        <label for="garantia">Tempo Garantia Produto (em dias):</label>
        <input type="text" class="form-control" id="txtGarantia" name="txtGarantia" required>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="btnSalvarProduto">Salvar</button>
</form>

<script type="module">
    import { fetchData } from '../request.js';
    //Fazendo a requisição POST para a api
    document.getElementById('produtoForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        
        const codigo = document.getElementById('txtCodigo').value;
        const descricao = document.getElementById('txtDescricao').value;
        const status = document.getElementById('txtStatus').value;
        const garantia = document.getElementById('txtGarantia').value;

        
        const dados = {
            txtCodigo: codigo,
            txtDescricao: descricao,
            txtStatus: status,
            txtGarantia: garantia
        };

        fetchData('../../api/produto/addProduto.php', 'POST', dados)
        .then(res => {
            //insere usuario cadastrado na tabela
            const tabelaProdutos = document.getElementById('tabelaProdutos');
            res.data.forEach(produto => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${produto.id}</td>
                    <td>${produto.descricao}</td>
                    <td>${produto.status}</td>
                    <td>${produto.tempogarantia}</td>
                `;
                tabelaProdutos.appendChild(row);
            });

            document.getElementById('produtoForm').reset();
            document.getElementById('txtCodigo').value = '';
            document.getElementById('txtDescricao').value = '';
            document.getElementById('txtStatus').value = '';
            document.getElementById('txtGarantia').value = '';
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
</script>