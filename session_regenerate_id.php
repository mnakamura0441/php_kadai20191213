<?php
//必ずsession_startは最初に記述
session_start();

//現在のセッションIDを取得
$old_session_id = session_id();

//新しいセッションIDを発行（前のSESSION IDは無効）
session_regenerate_id(true);

//新しいセッションIDを取得
$new_session_id = session_id();

//旧セッションIDと新セッションIDを表示
echo '<p>旧id' . $old_session_id . '</p>'; // idの確認 
echo '<p>新id' . $new_session_id . '</p>';
