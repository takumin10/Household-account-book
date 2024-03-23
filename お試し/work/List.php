<?php

require_once(__DIR__ . '/../app/config.php');

$pdo = getPdoInstance();

$datas = getDatas($pdo);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>機能一覧画面</title>
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
  <header>
    <h1>収支一覧</h1>
    <img src="../image/List.png">
  </header>
  <table>
    <tr>
      <th>日付</th>
      <th>勘定科目</th>
      <th>内容</th>
      <th>収入</th>
      <th>支出</th>
    </tr>
    <?php foreach($datas as $data): ?>
      <tr>
        <td><?= h($data->date);?></td>
        <td><?= h($data->Aitem);?></td>
        <td><?= h($data->content);?></td>
        <td><?= h($data->incomes);?></td>
        <td><?= h($data->expenses);?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <button onclick="location.href='Home.php'">戻る</button>
</body>
</html>