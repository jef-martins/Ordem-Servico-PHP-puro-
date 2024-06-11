<h2>Lista de Produtos</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody id="tabelaClientes">
        <script type="module">
            import { fetchData } from '../request.js';
            //Populando a tabela de produtos
            fetchData('../../api/cliente/listCliente.php', 'GET')
                .then(res => {
                    const tabelaClientes = document.getElementById('tabelaClientes');
                    res.data.forEach(cliente => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${cliente.id}</td>
                            <td>${cliente.nome}</td>
                            <td>${cliente.cpf}</td>
                            <td>
                                <form class="clienteExcluiForm">
                                    <input type="hidden" name="txtClienteId" value="${cliente.id}">
                                    <button type="submit" class="btn btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        `;
                        tabelaClientes.appendChild(row);

                        row.querySelector('.clienteExcluiForm').addEventListener('submit', function(event) {
                            event.preventDefault(); 

                            const clienteId = this.querySelector('input[name="txtClienteId"]').value;
                            
                            const dados = {
                                txtClienteId: clienteId
                            };
                            fetchData('../../api/cliente/excluirCliente.php', 'POST', dados)
                            .then(res => {
                                row.remove();
                            })
                            .catch(error => {
                                console.error('Erro:', error);
                                alert('Ocorreu um erro ao excluir o cliente. Verifique se ele está em uma OS');
                            });
                        });
                    });
                })
                .catch(error => console.error('Erro ao obter dados:', error));
        </script>
    </tbody>
</table>