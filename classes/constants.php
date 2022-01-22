<?php
class Constants {
	//データベース名
	const DB_NAME = "aki_db";
	//データベースがあるサーバーの場所
	const DB_HOST = "160.16.148.161";
	//データベースのポート番号
	const DB_PORT = "3306";
	//データベースのユーザー名
	const DB_USER = "aki";
	//データベースのパスワード
	const DB_PASS = "AKIaki3!";
	//ルートディレクトリのURL
	const ROOT_URL = "/~testaki";
	//login.phpのURL
	const LOGIN_URL = Self::ROOT_URL."/aki/login.php";
	//top.phpのURL
	const TOP_URL = Self::ROOT_URL."/aki/top.php";
	//delete.phpのURL
	const DELETE_URL = Self::ROOT_URL."/aki/delete.php";
	//delete2.phpのURL
	const DELETE2_URL = Self::ROOT_URL."/aki/delete2.php";
	//edit.phpのURL
	const EDIT_URL = Self::ROOT_URL."/aki/edit.php";
	//entry.phpのURL
	const ENTRY_URL = Self::ROOT_URL."/aki/entry.php";
	//pass_change.phpのURL
	const PASS_CHANGE_URL = Self::ROOT_URL."/aki/pass_change.php";
	//pass_change_done.phpのURL
	const PASS_CHANGE_DONE_URL = Self::ROOT_URL."/aki/pass_change_done.php";
	//user_edit.phpのURL
	const USER_EDIT_URL = Self::ROOT_URL."/aki/user_edit.php";
	//last_name_edit.phpのURL
	const LAST_NAME_EDIT_URL = Self::ROOT_URL."/aki/last_name_edit.php";
	//first_name_edit.phpのURL
	const FIRST_NAME_EDIT_URL = Self::ROOT_URL."/aki/first_name_edit.php";
	//department_edit.phpのURL
	const DEPARTMENT_EDIT_URL = Self::ROOT_URL."/aki/department_edit.php";
	//post_edit.phpのURL
	const POST_EDIT_URL = Self::ROOT_URL."/aki/post_edit.php";
	//birth_edit.phpのURL
	const BIRTH_EDIT_URL = Self::ROOT_URL."/aki/birth_edit.php";
	//mail_edit.phpのURL
	const MAIL_EDIT_URL = Self::ROOT_URL."/aki/mail_edit.php";
	//new_account_done.phpのURL
	const NEW_ACCOUNT_DONE_URL = Self::ROOT_URL."/aki/new_account_done.php";
	//new_account.phpのURL
	const NEW_ACCOUNT_URL = Self::ROOT_URL."/aki/new_account.php";
	//pass_forget.phpのURL
	const PASS_FORGET_URL = Self::ROOT_URL."/aki/pass_forget.php";
	//サーバー上の動物の写真の登録フォルダ
	const ANIMAL_PHOTO_SERVER = "/home/testaki/animal_photo/";
}
?>