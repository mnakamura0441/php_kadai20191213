<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
// SESSIONチェック＆リジェネレイト
checkSessionId();
//GETデータ取得
$id   = $_GET['id'];

//DB接続
$pdo = connectToDb();

//3．データ登録SQL作成
$sql = 'DELETE FROM user_table WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: user_list.php');
  exit();
}
