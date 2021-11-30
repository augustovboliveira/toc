DROP DATABASE IF EXISTS toc;
CREATE DATABASE IF NOT EXISTS toc;
USE toc;

CREATE TABLE `estudante` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `escola` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY(id),
  CONSTRAINT estudante_unique UNIQUE(email, senha)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `lista` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_estudante` int NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `data_criacao` date NOT NULL,
  PRIMARY KEY(id),
  CONSTRAINT lista_id__estudante_id FOREIGN KEY (id_estudante) 
  REFERENCES estudante(id) ON UPDATE RESTRICT ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `tarefa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_lista` int NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `data_criacao` date NOT NULL,
  `prazo` date,
  `realizada` tinyint(1),
  `descricao` text,
  PRIMARY KEY(id),
  CONSTRAINT tarefa_id_lista__lista_id FOREIGN KEY (id_lista)
  REFERENCES lista(id) ON UPDATE RESTRICT ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Armazenamento do chat
CREATE TABLE `sala` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `data_criacao` date NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `participantes` (
  `id_estudante` int NOT NULL,
  `id_sala` int NOT NULL,
  CONSTRAINT participantes_id_estudante__estudante_id FOREIGN KEY(id_estudante)
  REFERENCES estudante(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT participantes_id_sala__sala_id FOREIGN KEY(id_sala)
  REFERENCES sala(id) ON UPDATE RESTRICT ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `mensagem` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_remetente` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `data_criacao` date NOT NULL,
  `hora_envio` time NOT NULL,
  PRIMARY KEY(id),
  CONSTRAINT mensagem_id_remetente__estudante_id FOREIGN KEY(id_remetente)
  REFERENCES estudante(id) ON UPDATE RESTRICT ON DELETE RESTRICT,
  CONSTRAINT mensagem_id_sala__sala_id FOREIGN KEY(id_sala)
  REFERENCES sala(id) ON UPDATE RESTRICT ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Inserções de teste
INSERT INTO `estudante` (`email`, `senha`, `nome`, `escola`) VALUES
('bob@bob.com', 'Bobfofo10', 'Bob', 'Asaemy'),
('teste3@etec.sp.gov.br', 'testes6', 'Teste3', 'teste3'),
('teste6@etec.sp.gov.br', 'testes9', 'Teste6', 'teste6'),
('teste7@etec.sp.gov.br', 'TESTES11', 'Teste7', 'teste7'),
('teste10@etec.sp.gov.br', 'teste11', 'Teste10', 'teste10');


INSERT INTO `lista` (`id_estudante`, `titulo`, `data_criacao`) VALUES
(1, "coolist", DATE(NOW()));


INSERT INTO `tarefa` (`id_lista`, `titulo`, `data_criacao`) VALUES
(1,"comer bananas", DATE(NOW())),
(1,"arrumar a cama", DATE(NOW()));


-- Caso for uma conversa privada entre duas pessoas, o 'titulo' seria o nome do destinatário
-- se for mais de uma pessoa na sala, o titulo seria um escolhido pelo user
INSERT INTO sala (titulo, data_criacao) 
VALUES ("bananinhas", DATE(NOW())), ((SELECT nome FROM estudante WHERE id = 1), DATE(NOW()));


INSERT INTO participantes(id_estudante, id_sala) 
VALUES (2,1), (3,1), (4,1);


INSERT INTO mensagem(id_remetente, id_sala, conteudo, data_criacao, hora_envio)
VALUES (3, 1, "mensagem funciona brother", DATE(NOW()), TIME(NOW())),
	(4, 1, "funciona mesmo?", DATE(NOW()), TIME(NOW())),
	(3, 1, "funciona sim mano, confia", DATE(NOW()), TIME(NOW())),
	(4, 1, "pode pá meu consagrado, teste de sobrevivência shitt!!!", DATE(NOW()), TIME(NOW()));
    
