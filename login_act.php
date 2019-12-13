<?php

// var_dump($_POST);
// exit('ok');
//最初にSESSIONを開始！！
session_start();

//0.外部ファイル読み込み
include('functions.php');

//1.  DB接続&送信データの受け取り
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];
// $kanri_flg = $_POST['kanri_flg'];
$pdo = connectToDb();
//2. データ登録SQL作成&実行
$sql = 'SELECT * FROM user_table WHERE lid=:lid
 AND lpw=:lpw';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
// $stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$res = $stmt->execute();

//3. SQL実行時にエラーがある場合
if ($res == false) {
  showSqlErrorMsg($stmt);
}

//4. データを取得した場合
$val = $stmt->fetch(); // 該当レコードだけ取得
// var_dump($val);
// exit();
//5. 該当レコードがあればSESSIONに値を代入
if ($val['id'] != '') {
  // ログイン成功の場合はセッション変数に値を代入

  $_SESSION = array();  // session変数を空にする
  $_SESSION['session_id'] = session_id();  // idを格納
  $_SESSION['kanri_flg'] = $val['kanri_flg'];  // 管理者かどうかの判定
  // $_SESSION['life_flg'] = $val['life_flg'];
  $_SESSION['name'] = $val['name'];
  // var_dump($val['kanri_flg']);
  // exit();
  if ($_SESSION['kanri_flg'] == 1) {
    // $_SESSION['name'] = $val['name'];
    header('Location: user_select.php');
  } else {
    // $_SESSION['name'] = $val['name'];
    header('Location: select.php');
  }
} else {
  header('Location: login.php');
}
exit();
