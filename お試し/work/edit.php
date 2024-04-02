<?php
session_start();

require_once(__DIR__ . '/../app/config.php');

createToken();

$pdo = getPdoInstance();

$id = (int)$_GET['id'];
$sql = 'SELECT * FROM kakeibo WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$pdo = null;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>編集画面</title>
</head>

<body>
    <header>
        <h1>編集フォーム</h1>
    </header>
    <form method="post" action="update.php?id=<?= h($result['id']) ?>">
        <table>
            <tr>
                <th>日付</th>
                <th>勘定科目</th>
                <th>内容</th>
                <th>収入</th>
                <th>支出</th>
            </tr>
            <tr>
                <td><input type="date" name="date" placeholder="日付" Value="<?php echo h($result['date']); ?>"></td>
                <td>
                    <select name="Aitem" placeholder="勘定科目">
                        <option value="資産" <?php if ($result['Aitem'] == '資産') echo 'selected' ?>>資産</option>
                        <option value="負債" <?php if ($result['Aitem'] == '負債') echo 'selected' ?>>負債</option>
                        <option value="収益" <?php if ($result['Aitem'] == '収益') echo 'selected' ?>>収益</option>
                        <option value="費用" <?php if ($result['Aitem'] == '費用') echo 'selected' ?>>費用</option>
                    </select>
                </td>
                <td><input type="text" name="content" placeholder="内容" Value="<?php echo h($result['content']); ?>"></td>
                <td><input type="number" name="incomes" placeholder="収益" Value="<?php echo h($result['incomes']); ?>"></td>
                <td><input type="number" name="expenses" placeholder="支出" Value="<?php echo h($result['expenses']); ?>"></td>
            </tr>
        </table>
        <input type="hidden" name="id" value="<?php echo h($result['id']); ?>">
        <input type="submit" value="送信">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <button onclick="location.href='list.php'">戻る</button>
</body>