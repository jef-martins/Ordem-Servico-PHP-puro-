<h2>Lista de Ordens de Serviço</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data Abertura</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody id="tabelaOS">
        <script type="module">
            import { fetchData } from '../request.js';
            //Populando a tabela de ordens de serviço
                fetchData('../../api/orderservice/listOS.php', 'GET')
                .then(res => {
                    const tabelaOS = document.getElementById('tabelaOS');
                    res.data.forEach(os => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${os.id}</td>
                            <td>${os.dataabertura}</td>
                            <td>${os.nome}</td>
                            <td>${os.descricao}</td>
                            <td>
                                <form class="OSExcluiForm">
                                    <input type="hidden" name="txtOrderServiceId" value="${os.id}">
                                    <button type="submit" class="btn btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        `;
                        tabelaOS.appendChild(row);

                        row.querySelector('.OSExcluiForm').addEventListener('submit', function(event) {
                            event.preventDefault(); 

                            const osId = this.querySelector('input[name="txtOrderServiceId"]').value;
                            console.log(osId)
                            const dados = {
                                txtOrderServiceId: osId
                            };
                            fetch('../../api/orderservice/excluirOS.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify(dados)
                            })
                            .then(response => response.json())
                            .then(res => {
                                console.log(res)
                                row.remove();
                            })
                            .catch(error => {
                                console.error('Erro:', error);
                            });
                        });
                    });
                })
                .catch(error => console.error('Erro ao obter dados:', error));
        </script>
    </tbody>
</table>