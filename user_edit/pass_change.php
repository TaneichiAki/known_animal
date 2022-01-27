<?php
	require_once(__DIR__."/../classes/Dao.php");
	require_once(__DIR__."/../classes/constants.php");
	session_start();
	//セッションIDがセットされていなかったらログインページに戻る
	if(! isset($_SESSION['login'])){
		header("Location:".Constants::LOGIN_URL);
		exit();
	}
	$msg = "";
	/*
	*ユーザーID
	*/
	$id = $_SESSION['login'];

	//ログインユーザーの情報を抽出
	$sql = "select * from users where user_id = ?";
	$users = Dao::db()->show_one_row($sql,array($id));
	/*
	*パスワード
	*/
	$pass = $users['data']['password'];
	//新しいパスワードが$patternの正規表現パターンにマッチしているか判定
	$pattern = '/\A(?=.*?[a-z])(?=.*?[A-Z])(?=.*?\d)[a-zA-Z\d]{8,100}+\z/';
	preg_match($pattern,$_REQUEST['new_pass'],$matches);
	/*
	*パスワード変更ファンクション
	*/
	function pass_change() {
		if($_REQUEST['current_pass'] == ""){
			return "現在のパスワードを入力してください。";
		}
		if($_REQUEST['new_pass'] == ""){
			return  "新しいパスワードを入力してください。";
		}
		if($_REQUEST['re_new_pass'] == ""){
			return "新しいパスワードを再度入力してください。";
		}
		if(password_verify($_REQUEST['current_pass'], $pass) == false){
			return "現在のパスワードが正しくありません。";
		}
		if($_REQUEST['new_pass'] != $_REQUEST['re_new_pass'] ){
			return "１回目と２回目で新しいパスワードが一致しません。";
		}
		if($matches == false){
			return "半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上のパスワードにしてください。";
		}
			try{
				$sql2 = "update users set password = ? where user_id = '".$id."'";

				$hash = password_hash($_REQUEST['new_pass'], PASSWORD_DEFAULT);
				Dao::db()->mod_exec($sql2,array($hash));
				//下記ページに遷移する
				header ('Location:'.Constants::PASS_CHANGE_DONE_URL);
				exit;
			}catch (PDOException $e) {
				print('Error:'.$e->getMessage());
				die();
			}
		}
		/*
		*POST時の処理
		*/
		function post() {
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$GLOBALS['msg'] = pass_change();
			}
		}
		/*
		*POST時処理実行
		*/
		post();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
</head>
<body>
<form method="post" enctype="multipart/form-data">
	<center>
		<h1>パスワード変更</h1>
			<?php
			if ($msg != ""){
				echo "<center><div>".$msg."</div></center>";
			}
			?>
		<div>
			<p>現在のパスワード: <input type="password" name="current_pass"></p>
		</div>
		<div>
			<p>新しいパスワード: <input type="password" name="new_pass"></p>
		</div>
		<div>
			<p>新しいパスワード: <input type="password" name="re_new_pass" placeholder="もう一度入力してください"></p>
			<p>※パスワードは半角英小文字大文字数字をそれぞれ1種類以上含む8文字以上にしてください。</p>
		</div>
		<input type="submit" value="変更">
		<br>
		<button type="button" onclick="location.href='<?php echo Constants::USER_EDIT_URL?>'">ユーザー情報へ戻る</button>
	</center>
</form>
</body>
