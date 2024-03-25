<?php

function getPdoInstance() {
  try {
    $pdo = new PDO(
    DSN,
    USER,
    PASS,
    [
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]
    );
    return $pdo;
  } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
  }
}

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

function getDatas($pdo) {
  $stmt = $pdo->query("SELECT * FROM kakeibo");
  $data = $stmt->fetchAll();
  return $data;
}

function addDATE($pdo) {
  $date = trim(filter_input(INPUT_POST, 'date'));
  $Aitem = trim(filter_input(INPUT_POST, 'Aitem'));
  $content = trim(filter_input(INPUT_POST, 'content'));
  $incomes = trim(filter_input(INPUT_POST, 'incomes'));
  $expenses = trim(filter_input(INPUT_POST, 'expenses'));

  if($date === ''){
    return;
  }

  $stmt = $pdo->prepare("INSERT INTO kakeibo (date, Aitem, content, incomes, expenses) VALUES (:date, :Aitem, :content, :incomes, :expenses)");
  $stmt->bindValue('date', $date, PDO::PARAM_STR);
  $stmt->bindValue('Aitem', $Aitem, PDO::PARAM_STR);
  $stmt->bindValue('content', $content, PDO::PARAM_STR);
  $stmt->bindValue('incomes', $incomes, PDO::PARAM_INT);
  $stmt->bindValue('expenses', $expenses, PDO::PARAM_INT);
  $stmt->execute();
}