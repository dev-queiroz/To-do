<?php

$db = new PDO('sqlite:banco_de_dados.sqlite');

session_start();

if (!isset($_SESSION['usuario'])) {
  header('Location: index.php');
  exit;
}

$usuarioLogado = $_SESSION['usuario'];

function getTarefasDoUsuario($idUsuario) {
  global $db;

  $sql = "SELECT * FROM tarefas WHERE id_usuario = :id_usuario ORDER BY data_criacao DESC";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id_usuario', $idUsuario);
  $stmt->execute();

  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cadastrarTarefa($idUsuario, $titulo, $descricao) {
  global $db;

  $sql = "INSERT INTO tarefas (id_usuario, titulo, descricao) VALUES (:id_usuario, :titulo, :descricao)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id_usuario', $idUsuario);
  $stmt->bindParam(':titulo', $titulo);
  $stmt->bindParam(':descricao', $descricao);
  $stmt->execute();
}

function marcarTarefaConcluida($idTarefa) {
  global $db;

  $sql = "UPDATE tarefas SET data_conclusao = DATETIME('now') WHERE id_tarefa = :id_tarefa";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id_tarefa', $idTarefa);
  $stmt->execute();
}

function removerTarefa($idTarefa) {
  global $db;

  $sql = "DELETE FROM tarefas WHERE id_tarefa = :id_tarefa";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id_tarefa', $idTarefa);
  $stmt->execute();
}

if (isset($_GET['acao'])) {
  switch ($_GET['acao']) {
    case 'concluir':
      $idTarefa = $_GET['id_tarefa'];
      marcarTarefaConcluida($idTarefa);
      header('Location: tarefas.php');
      break;

    case 'remover':
      $idTarefa = $_GET['id_tarefa'];
      removerTarefa($idTarefa);
      header('Location: tarefas.php');
      break;
  }
}

$tarefas = getTarefasDoUsuario($usuarioLogado['id_usuario']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/style.css">
  <title>To-Do List - Tarefas</title>
</head>
<body>
  <h1>To-Do List - Bem-vindo(a), <?php echo $usuarioLogado['nome']; ?></h1>
  <h2>Minhas Tarefas</h2>
  <ul>
    <?php foreach ($tarefas as $tarefa): ?>
      <li>
        <?php echo $tarefa['titulo']; ?>
        <?php if ($tarefa['data_conclusao']): ?>
          (Concluída em <?php echo formatarDataHora($tarefa['data_conclusao']); ?>)
        <?php else: ?>
          (Em andamento)
        <?php endif; ?>
        <a href="?acao=concluir&id_tarefa=<?php echo $tarefa['id_tarefa']; ?>">Concluir</a>
        <a href="?acao=remover&id_tarefa=<?php echo $tarefa['id_tarefa']; ?>">Remover</a>
      </li>
    <?php endforeach; ?>
  </ul>

  <h2>Adicionar Tarefa</h2>
  <form method="post" action="tarefas.php">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required>
    <br>
    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"></textarea>
    <br>
    <button type="submit">Adicionar Tarefa</button>
  </form>

  <?php

  function formatarDataHora($dataHora) {
    $dataHora = new DateTime($dataHora);
    return $dataHora->format('d/m/Y H:i');
  }

  if (isset($_POST['titulo'])) {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    if (!empty($titulo)) {
      cadastrarTarefa($usuarioLogado['id_usuario'], $titulo, $descricao);
      header('Location: tarefas.php');
    }
  }

  ?>

</body>
</html>
