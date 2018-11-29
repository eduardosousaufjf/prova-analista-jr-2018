--
--
--

BEGIN;

--
--
--

CREATE TABLE estados
(
  estado_id    serial,
  estado_sigla varchar(2)   NOT NULL,
  estado_nome  varchar(255) NOT NULL,
  PRIMARY KEY (estado_id)
);

--
--
--

CREATE TABLE cidades
(
  cidade_id            serial,
  cidade_codigo_estado integer      NOT NULL,
  cidade_nome          varchar(255) NOT NULL,
  PRIMARY KEY (cidade_id),
  FOREIGN KEY (cidade_codigo_estado) REFERENCES estados (estado_id)
);

--
--
--

CREATE TABLE usuario
(
  usuario_email        varchar(255) NOT NULL,
  usuario_senha        varchar(255) NOT NULL,
  usuario_nome         varchar(255) NOT NULL,
  usuario_telefone     varchar(20)  NOT NULL,
  usuario_logradouro   varchar(255) NOT NULL,
  usuario_numero       int          NOT NULL,
  usuario_complemento varchar(255),
  usuario_bairro       varchar(255) NOT NULL,
  usuario_cidade_id    int          NOT NULL,
  usuario_cep          varchar(9)   NOT NULL,
  PRIMARY KEY (usuario_email),
  FOREIGN KEY (usuario_cidade_id) REFERENCES cidades (cidade_id)
);

--
--
--

INSERT INTO estados(estado_nome, estado_sigla)
VALUES ('Rio de Janeiro', 'RJ'),
       ('São Paulo', 'SP'),
       ('Minas Gerais', 'MG'),
       ('Espírito Santo', 'ES');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'RJ'),
        'Campos');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'RJ'),
        'Cabo Frio');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'MG'),
        'Juiz de Fora');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'MG'),
        'Belo Horizonte');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'SP'),
        'Campinas');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'SP'),
        'Campos do Jordão');

--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'ES'),
        'Guarapari');
--
--
--

INSERT INTO cidades (cidade_codigo_estado, cidade_nome)
VALUES ((SELECT estado_id FROM estados WHERE estado_sigla = 'ES'),
        'Vila Velha');

--
--
--


COMMIT;