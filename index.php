<?php

// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:banco_de_dados.sqlite');

// Função para cadastrar um novo usuário
function cadastrarUsuario($nome, $email, $senha) {
  global $db;

  // Validação básica dos dados (você deve aprimorar essa validação)
  if (empty($nome) || empty($email) || empty($senha)) {
    return false;
  }

  // Verifica se o email já existe na tabela 'usuarios'
  $sql = "SELECT * FROM usuarios WHERE email = :email";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $usuarioExistente = $stmt->fetch();

  if ($usuarioExistente) {
    return false; // Email já cadastrado
  }

  // Criptografa a senha antes de armazenar
  $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

  // Insere o novo usuário na tabela 'usuarios'
  $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':nome', $nome);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':senha', $senhaHash);
  $stmt->execute();

  return true; // Cadastro realizado com sucesso
}

// Função para autenticar um usuário
function autenticarUsuario($email, $senha) {
  global $db;

  // Consulta o usuário na tabela 'usuarios' pelo email
  $sql = "SELECT * FROM usuarios WHERE email = :email";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $usuario = $stmt->fetch();

  if (!$usuario) {
    return false; // Usuário não encontrado
  }

  // Verifica se a senha informada corresponde à senha armazenada
  if (!password_verify($senha, $usuario['senha'])) {
    return false; // Senha incorreta
  }

  // Usuário autenticado com sucesso
  return $usuario; // Retorna os dados do usuário autenticado
}

// Roteamento de ações

if (isset($_POST['acao'])) {
  switch ($_POST['acao']) {
    case 'cadastrar':
      // Tenta cadastrar um novo usuário
      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      if (cadastrarUsuario($nome, $email, $senha)) {
        echo "<p>Usuário cadastrado com sucesso!</p>";
      } else {
        echo "<p>Erro ao cadastrar usuário. Tente novamente.</p>";
      }
      break;

    case 'login':
      // Tenta autenticar um usuário
      $email = $_POST['email'];
      $senha = $_POST['senha'];

      $usuarioAutenticado = autenticarUsuario($email, $senha);

      if ($usuarioAutenticado) {
        // Usuário autenticado com sucesso: inicia sessão e redireciona
        session_start();
        $_SESSION['usuario'] = $usuarioAutenticado;
        header('Location: tarefas.php'); // Redireciona para tarefas.php
      } else {
        echo "<p>Credenciais inválidas. Tente novamente.</p>";
      }
      break;
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>To-Do List - Cadastro e Login</title>
</head>
<body>
  <h1>To-Do List</h1>

  <h2>Cadastro</h2>
  <form method="post" action="">
    <input type="hidden" name="acao" value="cadastrar">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" required>
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <br>
    <button type="submit">Cadastrar</button>
  </form>

  <h2>Login</h2>
  <form method="post" action="">
    <input type="hidden" name="acao" value="login">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>
    <br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
