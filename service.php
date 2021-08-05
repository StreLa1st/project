<?php
	session_start();
 	$mysqli = new mysqli("localhost", "root", "", "mysite-local");

	if (isset($_POST['searchValue'])) {
		$query = trim($_POST['searchValue']);
		$answer = '';

		if (!empty($query))
			$search = $mysqli->query("SELECT `id`,`title`,`description`,`price` FROM `services` WHERE `title` LIKE '%".$query."%' OR  `description` LIKE '%".$query."%' OR  `price` LIKE '%".$query."%'");
		else
			$search = $mysqli->query("SELECT `id`,`title`,`description`,`price` FROM `services`");

		$tableSearch = [];
		while (($rowSearch = $search->fetch_assoc()) != false)
			$tableSearch[] = $rowSearch;

		if (isset($_SESSION['godSite']) == 1) {
			$n = 1;
			foreach ($tableSearch as $key => $value) {
				$answer .=
					"<div class = 'serviceDiv ".$n."s'>
						 <div class = 'plusDiv'><p class = 'plusParagraph'>+</p></div>
						 <div class = 'serviceDivParagraph'>
							 <p class = 'serviceParagraph'><span class = 'boldSpan a'>".$value['title']."</span><br /><span class = 'descriptionService'>".$value['description']."</span><br />
							 	<span class = 'boldSpan'>Стоимость: </span><span class = 'price'><span class = 'priceNumber'>".$value['price']."</span> рублей</span>
							 </p>
						 </div>
						 <div class = 'deleteNewService'>Удалить услугу</div>
						 <div class = 'editNewService'>Изменить услугу</div>
					 </div>";
				$n++;
			}
		} else {
			$n = 1;
			foreach ($tableSearch as $key => $value) {
				$answer .=
					"<div class = 'serviceDiv ".$n."s'>
						 <div class = 'plusDiv'><p class = 'plusParagraph'>+</p></div>
						 <div class = 'serviceDivParagraph'>
							 <p class = 'serviceParagraph'><span class = 'boldSpan a'>".$value['title']."</span><br /><span class = 'descriptionService'>".$value['description']."</span><br />
							 	<span class = 'boldSpan'>Стоимость: </span><span class = 'price'><span class = 'priceNumber'>".$value['price']."</span> рублей</span>
							 </p>
						 </div>
					 </div>";
				$n++;
			}
		}

		echo $answer.'<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>';
		exit();
	}

    $result_set = $mysqli->query('SELECT `id`,`title`,`description`,`price` FROM `services`');

    $table = [];
    while(($row = $result_set->fetch_assoc()) != false){
      $table[] = $row;
    }

    if(isset($_POST['serviceTitle']) && isset($_POST['serviceDescription']) && isset($_POST['servicePrice'])){
    	$mysqli->query("INSERT INTO `services` (`title`,`description`,`price`) VALUES ('".$_POST['serviceTitle']."','".$_POST['serviceDescription']."','".$_POST['servicePrice']."')");
    }
    if (isset($_POST['idVacancyForDelete'])) {
    	$mysqli->query("DELETE FROM `services` WHERE `id` = '".$_POST['idVacancyForDelete']."'");
    	exit();
    }
    if(isset($_POST['textServiceTitleForEdit']) && isset($_POST['textService1'])){
    	$mysqli->query("UPDATE `services` SET `title` = '".$_POST['textServiceTitleForEdit']."' WHERE `title` = '".$_POST['textService1']."'");
    }
    if(isset($_POST['textServiceDescriptionForEdit']) && isset($_POST['textService2'])){
    	$mysqli->query("UPDATE `services` SET `description` = '".$_POST['textServiceDescriptionForEdit']."' WHERE `description` = '".$_POST['textService2']."'");
    }
    if(isset($_POST['textServicePriceForEdit']) && isset($_POST['textService3'])){
    	$mysqli->query("UPDATE `services` SET `price` = '".$_POST['textServicePriceForEdit']."' WHERE `price` = '".$_POST['textService3']."'");
    }
	if(isset($_POST['serviceSelect']) && isset($_POST['priceServiceSelect'])) {
		$result_set4 = $mysqli->query("SELECT `id` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
		$d5 = $result_set4->fetch_assoc();
		$idUser = $d5['id'];
		$result_set3 = $mysqli->query("SELECT `id` FROM `orders` WHERE `userid` = '".$idUser."' AND `service` = '".$_POST['serviceSelect']."'");
    	if($result_set3->num_rows == 0) {
	    	$result_set2 = $mysqli->query("SELECT `id` FROM `users` WHERE `login` = '".$_SESSION['loginn']."'");
		    $d = $result_set2->fetch_assoc();
		    $idUser = $d['id'];
		    $mysqli->query("INSERT INTO `orders` (`userid`,`service`,`dateOrder`,`datePerformance`,`price`) VALUES ('".$idUser."','".$_POST['serviceSelect']."','".date('d.m.Y H:i:s')."','awgag','".$_POST['priceServiceSelect']."')");
    		echo 'true';
	    } else{
	    	echo 'false';
	    }
	    exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type = "text/javascript" src = "javascript/menu2.js"></script>
	<script type = "text/javascript" src = "javascript/findBTN.js"></script>
	<script type = "text/javascript" src = "javascript/plusBTN.js"></script>
	<script src = "jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/background.css">
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<style type="text/css">
		body{
			font-family: "Times New Roman";
			user-select: none;
		}
		.content{
			position: absolute;
			left: 36px;
			top:188px;
			width: 1810px;
			height: 822px;
		}
		.findBlock{
			width: 1810px;
			font-size: 40px;
		}
		.findButton{
			background-image: url("images/findButton.png");
			width: 230px;
			height: 59px;
			text-align: center;
			color: white;
			line-height: 55px;
			cursor: pointer;
			float: right;
			margin-right: 16px;
		}
		.findPole{
			background-image: url("images/findPole.png");
			background-size: 100% 100%;
			width: 342px;
			height: 59px;
			outline: none;
			border: none;
			font-size: 40px;
			padding: 0px 0px 0px 10px;
			float: right;
		}
		.clearfix{
			clear: both;
		}
		.servicesDiv{
			width: 1809px;
			/*height: 556px;*/
			height: 695px;
			margin-top: 10px;
			overflow-y: auto;
			overflow-x: hidden;
			margin-left: 1px;
		}
		.serviceDiv{
			background-image: url("images/serviceBlock.png");
			background-size: 100% 100%;
			width: 1809px;
			height: 139px;
			position: relative;
		}
		.plusDiv{
			background-image: url("images/plusDiv.png");
			background-size: 100% 100%;
			width: 45px;
			height: 139px;
			text-align: center;
			font-size: 48px;
			font-weight: bold;
			cursor: pointer;
			float: left;
		}
		.plusParagraph{
			margin: 0px;
			padding: 0px;
			line-height: 133px;
		}
		.serviceDivParagraph{
			overflow-y: auto;
			width: 1748px;
			height: 138px;
		}
		.serviceParagraph{
			font-size: 40px;
			margin: 0;
			padding: 0px 0px 5px 10px;
		}
		.boldSpan{
			font-weight: bold;
		}
		.priceDiv{
			width: 45px;
			height: 139px;
			text-align: center;
			font-size: 40px;
			font-weight: bold;
		}
	.addNewService{
 		background-color: black;
 		width: 250px;
 		height: 50px;
 		position: absolute;
 		top: 5px;
 		right: 614px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		font-size: 30px;
 	}
 	.deleteNewService{
 		background-color: black;
 		width: 250px;
 		height: 50px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		position: absolute;
 		right: 50px;
 		top: 15px;
 		font-size: 30px;
 	}
 	.editNewService{
 		background-color: black;
 		width: 250px;
 		height: 50px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		position: absolute;
 		right: 50px;
 		top: 75px;
 		font-size: 30px;
 	}
	</style>
</head>
<body>
	<div class = "menu">
 		<a href = "index.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Общая информация</div></a>
 		<a href = "#" class = "menuLinks"><div class = "menuButtons activeMenuButton">Наши услуги</div></a>
 		<a href = "vacancy.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Вакансии</div></a>
 		<a href = "contact.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Контакты</div></a>
 	</div>
 	<a href = "login.php"><div class = "profileImage"></div></a>
 	<div class = "content">
 		<div class = "findBlock">
 			<input class = "findPole">
 			<div class = "findButton">Поиск</div>
 			<?php
				if(isset($_SESSION['godSite']) == 1){
		    ?>
		    <div class = "addNewService">Добавить услугу</div>
		    <?php
		  		}
	 		?>
 			<div class = "clearfix"></div>
 		</div>
 		<div class = "servicesDiv">
 			<?php
				if(isset($_SESSION['godSite']) == 1) {
					$n = 1;
					foreach ($table as $key => $value) {
						foreach ($value as $k => $v) {
							if($k == 'id'){
								$idVvalue = $v;
							} else if($k == 'title'){
								$title = $v;
							} else if($k == 'description'){
								$description = $v;
							} else if($k == 'price'){
								$price = $v;
							}
						}
						echo "<div class = 'serviceDiv ".$n."s'>
							<div class = 'plusDiv'><p class = 'plusParagraph'>+</p></div>
							<div class = 'serviceDivParagraph'>
							<p class = 'serviceParagraph'><span class = 'boldSpan a'>".$title."</span><br /><span class = 'descriptionService'>".$description."</span><br />
							<span class = 'boldSpan'>Стоимость: </span><span class = 'price'><span class = 'priceNumber'>".$price."</span> рублей</span>
							</p>
							</div>
							<div class = 'deleteNewService' id='v-".$idVvalue."'>Удалить услугу</div>
							<div class = 'editNewService' id='ve-".$idVvalue."'>Изменить услугу</div>
							</div>";
						$n++;
					}
				} else if(isset($_SESSION['godSite']) != 1) {
					$n = 1;
					foreach ($table as $key => $value) {
						foreach ($value as $k => $v) {
							if($k == 'title'){
								$title = $v;
							} else if($k == 'description'){
								$description = $v;
							} else if($k == 'price'){
								$price = $v;
							}
						}
						echo "<div class = 'serviceDiv ".$n."s'>
							<div class = 'plusDiv'><p class = 'plusParagraph'>+</p></div>
							<div class = 'serviceDivParagraph'>
							<p class = 'serviceParagraph'><span class = 'boldSpan a'>".$title."</span><br /><span class = 'descriptionService'>".$description."</span><br />
							<span class = 'boldSpan'>Стоимость: </span><span class = 'price'><span class = 'priceNumber'>".$price."</span> рублей</span>
							</p>
							</div>
							</div>";
						$n++;
					}
				}
 			?>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 			<div class = "serviceDiv">
 				<div class = "plusDiv"><p class = "plusParagraph">+</p></div>
 			</div>
 		</div>
 	</div>
 	<?php
		if(isset($_SESSION['godSite']) == 1){
		?>
	<script type="text/javascript">
 	$(function(){
 		var servicesDiv = document.getElementsByClassName('addNewService')[0];
 		servicesDiv.addEventListener('click',function(){
 			var serviceTitle = prompt('Введите название услуги');
 			var serviceDescription = prompt('Введите описание услуги');
 			var servicePrice = prompt('Введите стоимость услуги');
 				$.ajax({
				    type: "POST",
				    data: {
				      "serviceTitle" : serviceTitle,
				      "serviceDescription" : serviceDescription,
				      "servicePrice" : servicePrice,
				    },
				    success: function(data){

				    }
				  });
 				location.reload()
 		});

 		var servicesDeleteDiv = document.getElementsByClassName('deleteNewService');
		for (let i = 0; i < servicesDeleteDiv.length; i++) {
			servicesDeleteDiv[i].addEventListener('click',function() {
				var vId = this.id.split('-')[1];
				var par = $(this).parent('.serviceDiv');
				$.ajax({
				    type: "POST",
				    data: {
				      "idVacancyForDelete" : vId
				    },
				    success: function(data){
				    	par.remove();
				    }
				 });
				location.reload()
			});
		}

		var servicesDeleteDiv = document.getElementsByClassName('editNewService');
		var servicesParagr1 = document.getElementsByClassName('boldSpan a');
		var servicesParagr2 = document.getElementsByClassName('descriptionService');
		var servicesParagr3 = document.getElementsByClassName('priceNumber');
		for (let i = 0; i < servicesDeleteDiv.length; i++) {
			servicesDeleteDiv[i].addEventListener('click',function() {
				var textService1 = servicesParagr1[i].textContent;
				var textService2 = servicesParagr2[i].textContent;
				var textService3 = servicesParagr3[i].textContent;
				var textServiceTitleForEdit = prompt('Введите название услуги для ее изменения', servicesParagr1[i].textContent);
				var textServiceDescriptionForEdit = prompt('Введите описание услуги для ее изменения', servicesParagr2[i].textContent);
				var textServicePriceForEdit = prompt('Введите стоимость услуги для ее изменения', servicesParagr3[i].textContent);
				$.ajax({
				    type: "POST",
				    data: {
				    	"textService1" : textService1,
				    	"textService2" : textService2,
				    	"textService3" : textService3,
				      "textServiceTitleForEdit" : textServiceTitleForEdit,
				      "textServiceDescriptionForEdit" : textServiceDescriptionForEdit,
				      "textServicePriceForEdit" : textServicePriceForEdit
				    },
				    success: function(data){

				    }
				 });
				location.reload()
			});
		}
 	});
 	</script>
 	<?php
	  }
	?>
	<?php
	  if(isset($_SESSION['info']) == 1){
	  ?>
	  	<script type="text/javascript">
	  		$(function(){
	  			var servicesAddUser = document.getElementsByClassName('plusDiv');
				var servicesParagr1 = document.getElementsByClassName('boldSpan a');
				var servicesParagr2 = document.getElementsByClassName('priceNumber');
				for (let i = 0; i < servicesAddUser.length; i++) {
					servicesAddUser[i].addEventListener('click',function() {
						var serviceSelect = servicesParagr1[i].textContent;
						var priceServiceSelect = servicesParagr2[i].textContent;
						$.ajax({
						    type: "POST",
						    data: {
						    	"serviceSelect" : serviceSelect,
						    	"priceServiceSelect" : priceServiceSelect
						    },
						    success: function(data) {
						    	if (data == 'true'){
						    		alert('Услуга добавлена в корзину!');
						    	} else if(data == 'false'){
						    		alert('Эта услуга уже есть в корзине!');
						    	}
						    }
						 });
					});
				}
	  		});
	  	</script>
	  	<script type="text/javascript">
	  		$(function(){
	  			var searchButton = document.getElementsByClassName('findButton');
	  			var searchArea = document.getElementsByTagName('input')[0];
	  			searchButton[0].addEventListener('click',function() {
	  				var divService = $('.servicesDiv');
	  				var searchValue = searchArea.value;
	  				$.ajax({
						    type: "POST",
						    data: {
						    	"searchValue" : searchValue
						    },
						    success: function(data) {
								divService.empty();
								divService.append(data);
						    }
					});
	  			});
	  		});
	  	</script>
	 <?php
	  }
 	?>
</body>
</html>
