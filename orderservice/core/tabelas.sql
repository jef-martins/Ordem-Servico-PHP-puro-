
CREATE TABLE cliente (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    endereco TEXT
);

CREATE TABLE produto (
    id SERIAL PRIMARY KEY,
    Codigo VARCHAR(50) NOT NULL,
    Descricao TEXT,
    Status VARCHAR(20),
    TempoGarantia INT
);

CREATE TABLE ordem_de_servico (
    id SERIAL PRIMARY KEY,
    DataAbertura DATE NOT NULL,
    NomeConsumidor VARCHAR(255) NOT NULL,
    ClienteID INT REFERENCES cliente(id) ON DELETE CASCADE,
    ProdutoID INT REFERENCES produto(id) ON DELETE CASCADE
);

SELECT setval(pg_get_serial_sequence('cliente', 'id'), coalesce(max(id),0) + 1, false) FROM cliente;
SELECT setval(pg_get_serial_sequence('ordem_de_servico', 'id'), coalesce(max(id),0) + 1, false) FROM ordem_de_servico;
SELECT setval(pg_get_serial_sequence('produto', 'id'), coalesce(max(id),0) + 1, false) FROM produto;
