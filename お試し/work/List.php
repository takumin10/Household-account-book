<?php

session_start();

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

if(isset($_GET['ym'])){
  $ym = $_GET['ym'];
} else {
  $ym = date('Y-m');
}

$base_date = strtotime($ym);
$prev = date('Y-m', strtotime('-1 month', $base_date));
$next = date('Y-m', strtotime('+1 month', $base_date));
$List_date = date('Y年n月', $base_date);


$datas = getDatas($pdo, $ym);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  validateToken();

  $action = filter_input(INPUT_GET, 'action');

  switch ($action) {
    case 'delete':
      $id = trim(filter_input(INPUT_POST, 'id'));
      Delete($pdo);
      break;
    default:
      break;
  }

  header('Location: http://localhost/お試し/work/List.php');
  exit;
}

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
  <a href="?ym=<?php echo $prev; ?>"><<</a>
  <?php echo $List_date; ?>
  <a href="?ym=<?php echo $next; ?>">>></a>
  <a href="?ym=<?php echo date('Y-m'); ?>">今月</a>
  <table>
    <tr>
      <th>日付</th>
      <th>勘定科目</th>
      <th>内容</th>
      <th>収入</th>
      <th>支出</th>
    </tr>
    <?php foreach ($datas as $data) : ?>
      <tr>
        <td><?= h($data->date); ?></td>
        <td><?= h($data->Aitem); ?></td>
        <td><?= h($data->content); ?></td>
        <td><?= h($data->incomes); ?></td>
        <td><?= h($data->expenses); ?></td>
        <form action="?action=delete" method="post">
          <td><button type="submit" name="id" Value="<?= h($data->id); ?>">削除</button></td>
          <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
        </form>
        <td><button onclick="location.href='edit.php?id=<?= h($data->id); ?>'">修正</button></td>
      </tr>
      </form>
    <?php endforeach; ?>
  </table>
  <button onclick="location.href='Home.php'">戻る</button>
</body>

</html>