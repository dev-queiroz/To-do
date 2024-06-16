CREATE TABLE tarefas (
  id_tarefa INTEGER PRIMARY KEY AUTOINCREMENT,
  id_usuario INTEGER NOT NULL,
  titulo VARCHAR(255) NOT NULL,
  descricao TEXT,
  data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  data_conclusao DATETIME,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);
