<?php
session_start();
require_once(__DIR__ . '/../app/config.php');
createToken();
$pdo = getPdoInstance();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    validateToken();

    $id = (int)$_GET['id'];
    $date = $_POST['date'];
    $Aitem = $_POST['Aitem'];
    $content = $_POST['content'];
    $incomes = (int)$_POST['incomes'];
    $expenses = (int)$_POST['expenses'];
    try {

        $sql = 'UPDATE kakeibo set date= ?, Aitem= ?, content= ?, incomes= ?, expenses= ? WHERE id = ?';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $date, PDO::PARAM_STR);
        $stmt->bindValue(2, $Aitem, PDO::PARAM_STR);
        $stmt->bindValue(3, $content, PDO::PARAM_STR);
        $stmt->bindValue(4, $incomes, PDO::PARAM_INT);
        $stmt->bindValue(5, $expenses, PDO::PARAM_INT);
        $stmt->bindValue(6, $id, PDO::PARAM_INT);
        $stmt->execute();
        $pdo = null;
        echo '更新が完了しました';
    } catch (PDOException $e) {
        echo 'エラーが発生しました' . htmlspecialchars($e->getMessage(), ENT_QUOTES) . '<br>';
        exit;
    }


    header('Location: http://localhost/お試し/work/List.php');
    exit;
}