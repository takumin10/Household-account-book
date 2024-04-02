<?php

session_start();

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  validateToken();
  addDATA($pdo);

  header('Location: http://localhost/お試し/work/Newinput.php');
  exit;
  
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規入力画面</title>
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <header>
    <h1>新規入力画面</h1>
    <img src="../image/Newinput.png" class="newinput">
  </header>

  <main>
    <h2>収支入力欄</h2>
    <form action="" method="post">
      <table>
        <tr>
          <th>日付</th>
          <th>勘定科目</th>
          <th>内容</th>
          <th>収入</th>
          <th>支出</th>
        </tr>
        <tr>
          <td><input type="date" name="date" placeholder="日付"></td>
          <td>
            <select name="Aitem" placeholder="勘定科目">
            <option value="資産">資産</option>
            <option value="負債">負債</option>
            <option value="収益">収益</option>
            <option value="費用">費用</option>
            <option value="" selected></option>
          </td>
          <td><input type="text" name="content" placeholder="内容"></td>
          <td><input type="number" name="incomes" placeholder="収益"></td>
          <td><input type="number" name="expenses" placeholder="支出"></td>
        </tr>
      </table>
      <input type="submit" value="送信">
      <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <button onclick="location.href='Home.php'">戻る</button>
  </main>
  
</body>
</html>