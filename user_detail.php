<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
// SESSIONチェック＆リジェネレイト
checkSessionId();

$user_menu = user_menu();
// var_dump($_GET);
// exit();
// getで送信されたidを取得
// if (!isset($_GET['id'])) {
//   exit("Error");
// }
// $id = $_GET['id'];

//DB接続します
$pdo = connectToDb();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM user_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//データ表示
if ($status == false) {
  showSqlErrorMsg($stmt);
} else {
  $rs = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>user更新</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>

<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">user更新</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <?= $user_menu ?>
        </ul>
      </div>
    </nav>
  </header>

  <form method="post" action="user_update.php">
    <div class="form-group">
      <label for="name">ユーザー名</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?= $rs['name'] ?>">
    </div>
    <div class="form-group">
      <label for="lid">LoginID</label>
      <input type="date" class="form-control" id="lid" name="lid" value="<?= $rs['lid'] ?>">
    </div>
    <div class="form-group">
      <label for="lpw">Pass</label>
      <textarea class="form-control" id="lpw" name="lpw" rows="3"><?= $rs['lpw'] ?></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <input type="hidden" name="id" value="<?= $rs['id'] ?>">
  </form>

</body>

</html>