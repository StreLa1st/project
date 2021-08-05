<?php
  session_start();
  $error = false;
  $bool1 = false;
  $bool2 = false;
  if(isset($_POST['auth'])){
    $_SESSION['loginn'] = $_POST['login'];
    $_SESSION['passwordd'] = md5($_POST['password']);
    $error = true;
  }


  $mysqli = new mysqli("localhost", "root", "", "mysite-local");
  $result_set = $mysqli->query("SELECT `id`,`login`,`accessUser` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
  $row = $result_set->fetch_assoc();
  $rowLoginUser = $row['login'];
  $rowAccessUser = $row['accessUser'];
    if($_SESSION['loginn'] === $rowLoginUser){
        $bool1 = true;
        if($rowAccessUser == 'a'){
        	$_SESSION['godSite'] = 1;
        } 
  	}


  $result_set2 = $mysqli->query('SELECT `pass` FROM `users`');
  $table2 = [];
  while(($row2 = $result_set2->fetch_assoc()) != false){
    $table2[] = $row2;
  }
  foreach($table2 as $d2){
    foreach ($d2 as $p) {
      if($_SESSION['passwordd'] === $p){
        $bool2 = true;
      }
    }
  }
  $auth = false;
  $iss = isset($_SESSION['loginn']) && isset($_SESSION['passwordd']);
  if($iss && $bool1 && $bool2){
    $_SESSION['info'] = 1;
    $auth = true;
    $error = false;
    header('Location: profile.php');
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type = "text/javascript" src = "javascript/registerAndLoginBTN.js"></script>
	<link rel="stylesheet" type="text/css" href="css/background.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<style type="text/css">
	body{
		font-family: "Times New Roman";
		user-select: none;
		overflow-y: scroll;
	}
	.content{

	}
	.txtPoles{
		background-image: url("images/registerPole.png");
		background-size: 100% 100%;
		width: 282px;
		height: 68px;
		outline: none;
		border: none;
		margin: 29px 0px 0px 800px;
		font-size: 40px;
		padding: 0px 10px 0px 10px;
	}
	.txtPoles.pass{
		height: 63px;
		padding: 5px 10px 0px 10px;
	}
	.txtPoles:first-child{
		background-image: url("images/registerPole.png");
		background-size: 100% 100%;
		width: 302px;
		height: 68px;
		outline: none;
		border: none;
	}
	form{
		margin-top: 205px;
	}
	form > p{
		position: absolute;
		font-size: 48px;
		margin: 34px 0px 0px 580px;
		width: 200px;
		text-align: right;
	}
	.registerButton{
		background-image: url("images/registerAndLoginButtonNotActive.png");
		background-size: 100% 100%;
		width: 302px;
		height: 61px;
		outline: none;
		border: none;
		font-size: 40px;
		color: white;
		line-height: 50px;
		margin: 29px 0px 0px 800px;
		cursor: pointer;
		font-family: "Times New Roman";
		padding-top: 7px;
	}
	.loginButton{
		background-image: url("images/registerAndLoginButtonNotActive.png");
		background-size: 100% 100%;
		width: 302px;
		height: 68px;
		outline: none;
		border: none;
		color: white;
		font-size: 40px;
		line-height: 1px;
		margin: 29px 0px 50px 800px;
		cursor: pointer;
		font-family: "Times New Roman";
		padding-bottom: 5px;
	}
	form > a{
		text-align: center;
		text-decoration: none;
	}
</style>
<body>
	<div class = "menu">
 		<a href = "index.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Общая информация</div></a>
 		<a href = "service.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Наши услуги</div></a>
 		<a href = "vacancy.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Вакансии</div></a>
 		<a href = "contact.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Контакты</div></a>
 	</div>
 	<a href = "profile.php"><div class = "profileImage"></div></a>
 	<div class = "content">
<?php
    if($_SESSION['reg_success'] == 1){
      echo "<p style = 'width:100%;color:green;text-align:center;font-size:40px;margin:0px;padding:0px;position:absolute;top:260px;'>Успешная регистрация!</p>";
      unset($_SESSION['reg_success']);
    }
?>
<?php
    if($error){
?>
   <p style = 'color:red;position: absolute;top:300px;left: 843px;'>Неверные логин и(или) пароль!</p>
<?php
    }
?>
<?php
    if(!$auth){
?>
   <form method = "post" action = "login.php" name = "auth">
 			<p>Логин:</p><input type="text" name="login" class = "txtPoles"><br />
 			<p>Пароль:</p><input type="password" name="password" class = "txtPoles pass"><br />
 			<a href = "register.php"><div class = "registerButton">Регистрация</div></a>
 			<button type = 'submit' class = "loginButton" name = "auth">Войти</buttom>
 	</form>
<?php
    }
?>
</div>
</body>
</html>



