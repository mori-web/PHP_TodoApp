<?php

session_start();

$self_url = $_SERVER['PHP_SELF']; //現在のファイルパスを取得
// echo var_dump($self_url);
?>

<form action="<?php echo $self_url; ?>" method="post">
  <input type="text" name="title">
  <input type="submit" name="type" value="create">
</form>

<?php

if (isset($_POST['type'])) {
  if ($_POST['type'] == 'create') { //もし作成のボタンからであれば。。。
    $_SESSION['todos'][] = $_POST['title']; //titleを追加
    echo "新しいタスク[{$_POST['title']}]が追加されました。";
  } elseif($_POST['type'] == 'update') {
    $_SESSION['todos'][$_POST['id']] = $_POST['title']; //titleを編集
    echo "タスク[{$_POST['title']}]の名前が変更されました。";
  } elseif($_POST['type'] == 'delete') {
    array_splice($_SESSION['todos'], $_POST['id'],1); //titleを削除
    echo "タスク[{$_POST['title']}]が削除されました。";
  } 
}
if (empty($_SESSION['todos'])) {
  $_SESSION['todos'] = [];
  echo 'タスクを入力しましょう！';
  die(); //このコード以降のphpの処理を止める
}
?>

<ul>
  <?php for ($i = 0; $i < count($_SESSION['todos']); $i++) : ?>
    <li>
      <form action="<?php echo $self_url; ?>" method="post">
        <input type="hidden" name="id" value="<?php echo $i; ?>">
        <input type="text" name="title" value="<?php echo $_SESSION['todos'][$i] ?>">
        <input type="submit" name="type" value="delete">
        <input type="submit" name="type" value="update">
      </form>
    </li>
  <?php endfor; ?>
</ul>