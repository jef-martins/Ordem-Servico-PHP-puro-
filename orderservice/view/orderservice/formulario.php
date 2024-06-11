<h2>Formulário de Ordem de Serviço</h2>
<form id="OSform">
    <div class="form-group">
        <label for="txtNomeCliente">Nome Cliente:</label>
        <input type="text" class="form-control" id="txtNomeCliente" name="txtNomeCliente" disabled>
    </div>
    <div class="form-group">
        <label for="txtDescricaoProduto">Descrição Produto:</label>
        <input type="text" class="form-control" id="txtDescricaoProduto" name="txtDescricaoProduto" disabled>
    </div>
    <div class="form-group">
        <label for="clienteSelect">Cliente:</label>
        <select class="form-select" id="clienteSelect" name="clienteSelect" required aria-label="Floating label select example">
            <option selected>Selecione...</option>
        </select>
    </div>
    <div class="form-group">
        <label for="produtoSelect">Produto:</label>
        <select class="form-select" id="produtoSelect" name="produtoSelect" required aria-label="Floating label select example">
            <option selected>Selecione...</option>
        </select>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="btnSalvarOS">Salvar</button>
</form>

<script type="module">
    import { fetchData } from '../request.js';

    //Populando o campo de clientes
    fetchData('../../api/cliente/listCliente.php', 'GET')
    .then(res => {
        const input = document.getElementById("txtNomeCliente");
        const select = document.getElementById('clienteSelect');
        res.data.forEach(cliente => {
            const option = document.createElement('option');
            option.value = cliente.id;
            option.textContent = cliente.nome;
            select.appendChild(option);
        });
        select.addEventListener("change", function() {
            input.value = this.options[this.selectedIndex].text;
        });
    })
    .catch(error => console.error('Erro ao obter dados:', error));

    //Populando o campo de produtos
    fetchData('../../api/produto/listproduto.php', 'GET')
    .then(res => {
        const input = document.getElementById("txtDescricaoProduto");
        const select = document.getElementById('produtoSelect');
        res.data.forEach(produto => {
            const option = document.createElement('option');
            option.value = produto.id;
            option.textContent = produto.descricao;
            select.appendChild(option);
        });
        select.addEventListener("change", function() {
            input.value = this.options[this.selectedIndex].text;
        });
    })
    .catch(error => console.error('Erro ao obter dados:', error));

    //Fazendo a requisição POST para a api
    document.getElementById('OSform').addEventListener('submit', function(event) {
        event.preventDefault();

        const nomeCliente = document.getElementById('txtNomeCliente').value;
        const descricaoProduto = document.getElementById('txtDescricaoProduto').value;
        const clienteId = document.getElementById('clienteSelect').value;
        const produtoId = document.getElementById('produtoSelect').value;

        const dados = {
            txtNomeCliente: nomeCliente,
            txtDescricaoProduto: descricaoProduto,
            clienteSelect: clienteId,
            produtoSelect: produtoId
        };

        fetchData('../../api/orderservice/addOS.php', 'POST', dados)
        .then(res => {
            // Atualize a tabela de ordens de serviço, se necessário
            const tabelaOS = document.getElementById('tabelaOS');
            res.data.forEach(os => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${os.id}</td>
                    <td>${os.dataabertura}</td>
                    <td>${os.nome}</td>
                    <td>${os.descricao}</td>
                `;
                tabelaOS.appendChild(row);
            });
            document.getElementById('OSform').reset();
            document.getElementById('txtNomeCliente').value = '';
            document.getElementById('txtDescricaoProduto').value = '';
            document.getElementById('clienteSelect').value = 'Selecione...';
            document.getElementById('produtoSelect').value = 'Selecione...';
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
</script>