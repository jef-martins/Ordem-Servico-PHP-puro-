<h2>Formulário de Cliente</h2>
<form id="clienteForm">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="txtNome" name="txtNome" required>
    </div>
    <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="text" class="form-control" id="txtCpf" name="txtCpf" required>
    </div>
    <div class="form-group">
        <label for="endereco">Endereço:</label>
        <textarea class="form-control" id="txtEndereco" name="txtEndereco" rows="3"></textarea>
    </div>
    <br>
    <button type="submit" class="btn btn-primary" name="btnSalvarCliente">Salvar</button>
</form>

<script type="module">
    import { fetchData } from '../request.js';
            
    //Fazendo a requisição POST para a api
    document.getElementById('clienteForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        
        const nome = document.getElementById('txtNome').value;
        const cpf = document.getElementById('txtCpf').value;
        const endereco = document.getElementById('txtEndereco').value;

        
        const dados = {
            txtNome: nome,
            txtCpf: cpf,
            txtEndereco: endereco
        };

        fetchData('../../api/cliente/addCliente.php', 'POST', dados)
        .then(res => {
            //Joga usuario cadastrado na tabela
            const tabelaclientes = document.getElementById('tabelaClientes');
            res.data.forEach(cliente => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${cliente.id}</td>
                    <td>${cliente.nome}</td>
                    <td>${cliente.cpf}</td>
                `;
                tabelaclientes.appendChild(row);
            });

            document.getElementById('clienteForm').reset();
            document.getElementById('txtNome').value = '';
            document.getElementById('txtCpf').value = '';
            document.getElementById('txtEndereco').value = '';
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
</script>