<?php
// 共通で使うものを別ファイルにしておきましょう。

// DB接続関数（PDO）
function connectToDb()
{
  $db = 'mysql:dbname=gsacfl02_07;charset=utf8;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($db, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}

// SQL処理エラー
function showSqlErrorMsg($stmt)
{
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
}

// SESSIONチェック＆リジェネレイト
function checkSessionId()
{
  // ログイン失敗時の処理（ログイン画面に移動）
  if (!isset($_SESSION['session_id']) || $_SESSION['session_id'] != session_id()) {
    // var_dump('ok');
    // exit();
    header('Location: login.php');
  } else {  // ログイン成功時の処理（一覧画面に移動）
    session_regenerate_id(true); // セッションidの再生成
    // var_dump('ng');
    // exit();
    $_SESSION['session_id'] = session_id();
  }
  // var_dump('ko');
  // exit();
}

// menuを決める
function menu()
{
  $menu = '<li class="nav-item"><a class="nav-link" href="index.php">todo登録</a></li><li class="nav-item"><a class="nav-link" href="select.php">todo一覧</a></li>';
  $menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
  return $menu;
}

function nologin_menu()
{
  $nologin_menu = '<li class="nav-item"><a class="nav-link" href="login.php">ログインページ</a></li>';
  $nologin_menu .= '<li class="nav-item"><a class="nav-link" href="nologin_select.php">一覧ページ</a></li>';

  return $nologin_menu;
}

function user_menu()
{
  $user_menu = '<li class="nav-item"><a class="nav-link" href="user_index.php">todo登録</a></li>';
  $user_menu .= '<li class="nav-item"><a class="nav-link" href="user_select.php">todo一覧</a></li>';
  $user_menu .= '<li class="nav-item"><a class="nav-link" href="user_entryindex.php">user登録</a></li>';
  $user_menu .= '<li class="nav-item"><a class="nav-link" href="user_list.php">user一覧</a></li>';
  // $user_menu .= '<li class="nav-item"><a class="nav-link" href="user_detail.php">user更新</a></li>';
  $user_menu .= '<li class="nav-item"><a class="nav-link" href="logout.php">ログアウト</a></li>';
  return $user_menu;
}
