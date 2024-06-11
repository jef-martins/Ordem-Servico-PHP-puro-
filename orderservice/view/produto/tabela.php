<h2>Lista de Produtos</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Tempo Garantia (dias)</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody id="tabelaProdutos">
        <script type="module">
            import { fetchData } from '../request.js';
            //Populando a tabela de produtos
                fetchData('../../api/produto/listproduto.php', 'GET')
                .then(res => {
                    const tabelaprodutos = document.getElementById('tabelaProdutos');
                    res.data.forEach(produto => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${produto.id}</td>
                            <td>${produto.descricao}</td>
                            <td>${produto.status}</td>
                            <td>${produto.tempogarantia}</td>
                            <td>
                                <form class="produtoExcluiForm">
                                    <input type="hidden" name="txtProdutoId" value="${produto.id}">
                                    <button type="submit" class="btn btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        `;
                        tabelaprodutos.appendChild(row);

                        row.querySelector('.produtoExcluiForm').addEventListener('submit', function(event) {
                            event.preventDefault(); 

                            const produtoId = this.querySelector('input[name="txtProdutoId"]').value;
                            
                            const dados = {
                                txtProdutoId: produtoId
                            };
                            fetch('../../api/produto/excluirProduto.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(dados)
                            })
                            .then(response => response.json())
                            .then(res => {
                                row.remove();
                            })
                            .catch(error => {
                                console.error('Erro:', error);
                                alert('Ocorreu um erro ao excluir o produto. Verifique se ele está em uma OS');
                            });
                        });
                    });
                })
                .catch(error => console.error('Erro ao obter dados:', error));
        </script>
    </tbody>
</table>