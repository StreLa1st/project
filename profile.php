<?php
session_start();
if(isset($_SESSION['info']) != 1){
header('Location: login.php');
?>
 <?php
}
 if(isset($_POST['textServiceTitle'])){
 		$mysqli2 = new mysqli("localhost", "root", "", "mysite-local");
		$result_set5 = $mysqli2->query("SELECT `id` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
		$d4 = $result_set5->fetch_assoc();
		$idUserr = $d4['id'];
 		$mysqli2->query("DELETE FROM `orders` WHERE `userid` = '".$idUserr."' AND `service` = '".$_POST['textServiceTitle']."'");
    	exit;
}  
if(isset($_GET['f']) && $_GET['f'] == 'logout'){
unset($_SESSION['godSite']);
unset($_SESSION['loginn']);
unset($_SESSION['passwordd']);
unset($_SESSION['info']);
header('Location: login.php');
}
$mysqli = new mysqli("localhost", "root", "", "mysite-local");
  $result_set = $mysqli->query('SELECT `id`,`firstName`,`lastName`,`patronymic`,`address`,`tel`,`email`,`login`,`pass` FROM `users`');
  $table = [];
  while(($row = $result_set->fetch_assoc()) != false){
    $table[] = $row;
  }
  foreach($table as $key => $d){
    foreach ($d as $l) {
      if($_SESSION['loginn'] === $l){
      	$idUser = $d['id'];
      	$k = $key;
        $login = $l;
        $bool1 = true;
        $fName = $d["firstName"];
        $lName = $d["lastName"];
        $patr = $d["patronymic"];
        $address = $d["address"];
        $tel = $d["tel"];
        $email = $d["email"];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type = "text/javascript" src = "javascript/orderBTN.js"></script>
	<script src = "jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/background.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<style type="text/css">
	body{
			font-family: "Times New Roman";
			font-size: 48px;
			user-select: none;
		}
	.content{

	}
	.profileTextDiv{

		margin: 70px 0px 0px 430px;
	}
	.profileParagraph{

	}
	.profile2Paragraph{
		width: 390px;
		margin: -31px auto 0px auto;
	}
	.servicesBlock{
		background-image: url("images/servicesBlock.png");
		background-size: 100% 100%;
		width: 1173px;
		height: 264px;
		margin: 19px auto 0px auto;
		overflow-y: auto;
		overflow-x: hidden;
	}
	.selectServiceBlock{
		background-image: url("images/selectServiceBlock.png");
		background-size: 100% 100%;
		width: 1163px;
		height: 66px;
		padding: 0px 0px 0px 10px;
		position: relative;
	}
	.selectServiceSpan{
		line-height: 65px;
	}
	.orderButton{
		background-image: url("images/orderNotActiveButton.png");
		background-size: 100%;
		width: 302px;
		height: 68px;
		margin: 29px auto 29px auto;
		color: white;
		line-height: 62px;
		text-align: center;
		cursor: pointer;
	}
	.exitButton{
		background-image: url("images/orderNotActiveButton.png");
		background-size: 100% 100%;
		width: 302px;
		height: 68px;
		margin: 0px auto 80px auto;
		color: white;
		line-height: 62px;
		text-align: center;
		cursor: pointer;
	}
	.exitButton > a{
		text-decoration: none;
		color: white;
	}
	.cross{
		background-image: url('images/cross.png');
		background-size: 100% 100%;
		width: 15px;
		height: 15px;
		position: absolute;
		top: 25px;
		right: 35px;
		cursor: pointer;
	}
	.total{
		margin: 0px;
		padding: 0px;
		text-align: center;
	}
</style>
<body>
	<div class = "menu">
 		<a href = "index.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Общая информация</div></a>
 		<a href = "service.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Наши услуги</div></a>
 		<a href = "vacancy.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Вакансии</div></a>
 		<a href = "contact.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Контакты</div></a>
 	</div>
 	<div class = "profileImage"></div>
 	<div class = "content">
 		<div class = "profileTextDiv">
 			<p class = "profileParagraph">
<!--  				<?php
					if(isset($_SESSION['info']) == 1){
				?>
				<p style = 'color:white;'><b>Здравствуйте, <?=$login?>!</b></p>
				<?php
					}
				?> -->
		<?php
		if(isset($_SESSION['godSite']) == 1){
		?>
			<p style = 'color:red;'><b>Здравствуйте, администратор сайта!</b></p>
		<?php
			}
		?>
 				ФИО: <span><?=$lName?> <?=$fName?> <?=$patr?></span><br />
				Адрес: <span><?=$address?></span><br />
				Телефон: <span><?=$tel?></span><br />
				E-mail: <span><?=$email?></span><br />
				<span></span><br />
 			</p>
 		</div>
 		<p class = "profile2Paragraph">Выбранные услуги</p>
 		<div class = "servicesBlock">
 		<?php
 			$n = 0;
			$result_set2 = $mysqli->query("SELECT `userid`,`service`,`dateOrder`,`datePerformance`,`price` FROM `orders`");
					  $table2 = [];
					  while(($row2 = $result_set2->fetch_assoc()) != false){
					    $table2[] = $row2;
					  }
					  $n = 1;
					   foreach ($table2 as $key => $value) {
					   		if($idUser == $value['userid']) {
					   			$userid = $value['userid'];
					   			$service = $value['service'];
					   			$massiveServices .= $service.'<br />';
					   			$dateOrder = $value['dateOrder'];
					   			$datePerformance = $value['datePerformance'];
					   			$priceSelectService = $value['price'];
					   			echo "<div class = 'selectServiceBlock'><span class = 'numberSelectService'>".$n."</span>. <span class = 'selectServiceSpan'>".$service."</span><div class = 'cross'></div></div>";
								$n++;
								$sum += $value['price'];
				    		}
						}
      }
    }
  }		
		?>
		</div>
		<?php
			echo '<p class = "total"><strong>Итого:</strong> '.$sum.' рублей</p>';
			if(isset($_POST['dataOrder'])){
		    	$result_setmail = $mysqli->query("SELECT `firstName`,`lastName`,`patronymic`,`address`,`tel`,`email` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
				$tablemail = [];
			    while(($rowmail = $result_setmail->fetch_assoc()) != false){
			      $tablemail[] = $rowmail;
			    }
			    foreach($tablemail as $key => $d){
					foreach($d as $key => $l){
						$fName = $d["firstName"];
				        $lName = $d["lastName"];
				        $patr = $d["patronymic"];
				        $address = $d["address"];
				        $tel = $d["tel"];
				        $email = $d["email"];
					}
				}
				$headers = 'Content-type: text/html; charset=utf-8';
		    	mail("therussiangui1010@gmail.com", "Vacancy", $fName.' '.$lName.' '.$patr.' c логином '.$_SESSION['loginn'].' и телефонным номером '.$tel.' сделал заказ!<br />'.$massiveServices.'Итоговая стоимость составила: '.$sum, $headers);
		    	exit;
    		}
		?>
	 		<div class = "orderButton">Заказать</div>
			<div class = "exitButton"><a href = "profile.php?f=logout" class = 'login'>Выйти</a></div>		
 	</div>
 	<?php
		if(isset($_SESSION['info']) == 1 && $sum != 0 && $n > 0){
	?>
		<script type="text/javascript">
			var queryBtn = document.getElementsByClassName('orderButton')[0].addEventListener('click', function(){
				var c = confirm('Вы действительно хотите сделать заказ?');
				if(c){
						var dataOrder = 'Услуги';
						$.ajax({
						    type: "POST",
						    data: {
						      'dataOrder':dataOrder
						    },
						    success: function(data){
						      alert('Ваш заказ успешно оформлен!');
						    }
						});
						location.reload()
				} else if(!c){
					return false;
				}
				
			});
		var servicesDeleteCross = document.getElementsByClassName('cross');
		var servicesTitle = document.getElementsByClassName('selectServiceSpan');
		for (let i = 0; i < servicesDeleteCross.length; i++) {
			servicesDeleteCross[i].addEventListener('click',function() {
				var textServiceTitle = servicesTitle[i].textContent;
				$.ajax({
				    type: "POST",
				    data: {
				      "textServiceTitle" : textServiceTitle
				    },
				    success: function(data){
				      // alert('Услуга была убрана из корзины!');
				    }
				 });
				location.reload()
			});
		}
		</script>
	<?php
		} 
	?>
</body>
</html>