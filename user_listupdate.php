<?php
include('functions.php');

//入力チェック(受信確認処理追加)
if (
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['lid']) || $_POST['lid'] == '' ||
  !isset($_POST['lpw']) || $_POST['lpw'] == '' ||
  !isset($_POST['kanri_flg']) || $_POST['kanri_flg'] == ''
) {
  exit('ParamError');
}

//1. POSTデータ取得
$name = $_POST['name'];
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];

//2. DB接続します(エラー処理追加)
$pdo = connectToDb();


//3．データ登録SQL作成
$sql = 'UPDATE user_table SET name=:a1, lid=:a2, lpw=:a3, kanri_flg=a4';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1 ', $name, PDO::PARAM_STR);
$stmt->bindValue(':a2 ', $lid, PDO::PARAM_STR);
$stmt->bindValue(':a3 ', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':a4 ', $kanri_flg, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  header('Location: user_select.php');
  exit;
}
