<?php
		require_once(__DIR__."/../classes/Dao.php");
		require_once(__DIR__."/../classes/constants.php");
		session_start();
		//ログアウトボタン押下後、セッションIDを削除する
		if( !empty($_GET['btn_logout']) ) {
			unset($_SESSION['login']);
		}

		//セッションIDがセットされていなかったらログインページに戻る
		if(! isset($_SESSION['login'])){
			header("Location:".Constants::LOGIN_URL);
			exit();
		}
		//データベースに接続し、テーブルに登録されているユーザーの知ってる動物データを抽出
		$animal_sql = 'select * from users inner join animal on users.id = animal.memberid  where user_id = ?';
		$animals = Dao::db()->show_any_rows($animal_sql,array($_SESSION['login']));
		//登録されている動物件数
		$count = Dao::db()->count_row($animal_sql,array($_SESSION['login']));
		//ログインユーザー情報
		$users_sql = 'select * from users where user_id = ?' ;
		$users = Dao::db()->show_one_row($users_sql,array($_SESSION['login']));
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="./top.css">
		<title>ログイン</title>
	</head>
	<body>
		<div class = "titlebar">
			<p class="top">トップページ</p>
			<p class="account">ようこそ！ <?php echo $users['data']['first_name']?>さん</p>

			<form method="get" action="">
    			<input type="submit" class="btn_logout" name="btn_logout" value="ログアウト">
			</form>
			<br>
			<a href='<?php echo Constants::USER_EDIT_URL?>' class="user">ユーザー情報の編集</a>
		</div>
		<div>
			<?php echo $_REQUEST["update_message"] ?>
		</div>
			<h2>
				<center>
					<img src= "../image/inu.png"  class=""animal" alt = "犬" title = "犬" width = 60 height = 60 >知ってる動物一覧
					<img src= "../image/neko.png"  class="animal" alt = "猫" title = "猫" width = 60 height = 60 >
				</center>
			</h2>
				<center>
					<table border = "1" style = "border-collapse: collapse">
						<tr bgcolor="#dcdcdc"><th>No</th><th>イメージ</th><th>名称</th><th>科</th><th>特徴</th><th>知った日</th><th>編集</th></tr>

						<?php for($i = 0;$i < $count; $i++): ?>
						<tr height=80px><td>
						<?=$i+1 ;?>
						</td><td>
						<div style="text-align:center;">
						<?php
						$filename = Constants::ANIMAL_PHOTO_SERVER.$animals['data'][$i]['no'].'_animal.jpg';
						//__DIR__ .'/../animal_photo/'.$animals[$i]['no'].'_animal.jpg';
						?>
						<?php if(file_exists($filename)): ?>
						<img src='/~testaki/animal_photo/<?php echo $animals['data'][$i]['no'] ?>_animal.jpg?<?php echo date("YmdHis");?>' width=auto height=80px />
						<?php else: ?>
							<img src='/~testaki/animal_photo/no_image.jpeg?<?php echo date("YmdHis");?>' width=auto height=80px>
						<?php endif; ?>
						</div>
						</td><td>
						<?= $animals['data'][$i]['name']; ?>
						</td><td>
						<?php
						 echo $animals['data'][$i]['family'];
						 ?>
						 </td><td>
						 <?php
						 echo $animals['data'][$i]['features'];
						 ?>
						 </td><td>
						 <?php
						 echo $animals['data'][$i]['date'];
						 ?>
						 </td><td>
						 <button type="submit" onclick="location.href='<?php echo Constants::EDIT_URL?>?update_animal=<?php echo $animals['data'][$i]['no'] ?>'">更新</button>

						 <button type="submit" onclick="window.open('<?php echo Constants::DELETE_URL?>?update_animal=<?php echo $animals['data'][$i]['no'] ?>','Delete','width=800,height=600')">削除</button>
						 </td></tr>
						 <?php endfor; ?>
						</table>
						<br>
							 <button type=“button” onclick="location.href='<?php echo Constants::ENTRY_URL?>'">新規登録</button>
				</center>
	</body>
</html>
