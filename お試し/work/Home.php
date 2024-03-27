<?php

session_start();

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

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
    <h1>機能一覧画面</h1>
    <img src="../image/Top.png" class="top">
  </header>
  <main>
    <h2>家計簿システム</h2>
    <div>
      <table>
        <tr>
          <td>
            <a href="Newinput.php"><img src="../image/Newinput.png" class="newinput"></a>
          </td>
          <td>
            <a href="List.php"><img src="../image/List.png" class="list"></a>
          </td>
        </tr>
        <tr>
          <td>新規入力</td>
          <td>収支一覧</td>
        </tr>
      </table>
    </div>
  </main>

</body>
</html>