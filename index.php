<?php
	session_start();
 	$mysqli = new mysqli("localhost", "root", "", "mysite-local");
    $result_set = $mysqli->query('SELECT `new` FROM `news`');
    $table = [];
    while(($row = $result_set->fetch_assoc()) != false){
      $table[] = $row;
    }
    if(isset($_POST['news'])){
    	$mysqli->query("INSERT INTO `news` (`new`) VALUES ('".$_POST['news']."')");
    }
    if(isset($_POST['textNewForDelete'])){
    	$mysqli->query("DELETE FROM `news` WHERE `new` = '".$_POST['textNewForDelete']."'");
    }
    if(isset($_POST['textNewForEdit']) && isset($_POST['textNewText'])){
    	$mysqli->query("UPDATE `news` SET `new` = '".$_POST['textNewText']."' WHERE `new` = '".$_POST['textNewForEdit']."'");
    }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<script type = "text/javascript" src = "javascript/news.js"></script>
 	<script type = "text/javascript" src = "javascript/menu.js"></script>
 	<script src = "jquery.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/background.css">
 	<link rel="stylesheet" type="text/css" href="css/menu.css">
 </head>
 <style type="text/css">
 	body{
 		background-image: url("images/Фон.png");
 		background-size: cover;
 		margin: 0px;
 		padding: 0px;
 		font-family: "Times New Roman";
 		user-select: none;
 	}
 	.metalV{
 		background-image: url("images/MetalV.png");
 		width: 222px;
 		height: 222px;
 		position: absolute;
 		top: 26px;
 		left: 46px;
 	}
 	.content{

 	}
 	.titleMetal{
 		font-size: 60px;
 		text-align: center;
 	}
 	ul{
 		margin: 37px 0px 0px 0px;
 	}
 	li{
 		font-weight: bold;
 	}
 	.liParagraph{
 		margin: 0px;
 	}
 	.sizeText48{
 		font-size: 48px;
 		margin-left: 100px;
 	}
 	.news{
 		position: absolute;
 		top: 219px;
 		left: 1472px;
 		font-size: 48px;
 	}
 	.newsBlock{
 		background-image: url("images/newsBlock.png");
 		background-size: 100% 100%;
 		width: 612px;
 		height: 500px;
 		position: absolute;
 		top: 335px;
 		left: 1241px;
 		overflow-y: auto;
 		z-index: 1;
 	}
 	.newsChildBlock{
 		background-image: url("images/newsChildBlock.png");
 		width: 612px;
 		height: 125.71px;
 		position: relative;
 		margin: -1px 0px 0px 0px;
 		font-size: 30px;
 	}
 	.newsChildBlock:first-child{
 		margin: 0px 0px 0px 0px;
 	}
 	.newsParagraph{
 		margin: 0px 0px 0px 8px;
 		padding-top: 5px;
 	}
 	.oNasTitle{
 		font-size: 48px;
 		font-weight: bold;
 		text-align: center;
 	}
 	.oNasContent{
 		font-size: 48px;
 		text-align: center;
 		margin: 0px 0px 53px 0px;
 	}
 	.addNewDiv{
 		background-color: black;
 		width: 250px;
 		height: 50px;
 		position: absolute;
 		top: 870px;
 		right: 235px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		font-size: 30px;
 	}
 	.deleteNewDiv{
 		background-color: black;
 		width: 250px;
 		height: 50px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		position: absolute;
 		right: 30px;
 		top: 8px;
 	}
 	.editNewDiv{
 		background-color: black;
 		width: 250px;
 		height: 50px;
 		border-radius: 10px;
 		color: white;
 		text-align: center;
 		line-height: 47px;
 		cursor: pointer;
 		position: absolute;
 		right: 30px;
 		top: 68px;
 	}
 </style>
 <body>
 	<div class = "metalV"></div>
 	<div class = "menu">
 		<a href = "#" class = "menuLinks"><div class = "menuButtons activeMenuButton">Общая информация</div></a>
 		<a href = "service.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Наши услуги</div></a>
 		<a href = "vacancy.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Вакансии</div></a>
 		<a href = "contact.php" class = "menuLinks"><div class = "menuButtons notActiveMenuButton">Контакты</div></a>
 	</div>
 	<a href = "login.php"><div class = "profileImage"></div></a>
 	<div class = "content">
 		<p class = 'titleMetal'>МЕТАЛЛООБРАБОТКА</p>
 		<!-- <div class = "lIandPDiv"> -->
	 		<ul type = "square">
	 			<li class = "sizeText48">Экономия</li>
	 		</ul>
	 		<p class = "sizeText48 liParagraph">Вы оплачиваете только реально проделанную работу.</p>
	 		<ul type = "square">
	 			<li class = "sizeText48">Индивидуальный подход</li>
	 		</ul>
	 		<p class = "sizeText48 liParagraph">Передав нам свои работы, Вы сможете сосредоточить<br /> 
			силы, время и средства на профильных и ключевых.</p>
	 		<ul type = "square">
	 			<li class = "sizeText48">Забота</li>
	 		</ul>
	 		<p class = "sizeText48 liParagraph">Универсальность наших работ не отменяет личного<br /> 
				участия и понимания.</p>
		<!-- </div> -->
		<p class = "news">Новости</p>
		<div class = "newsBlock">
	<?php
	if(isset($_SESSION['godSite']) == 1){
	    foreach ($table as $key => $value) {
	    	foreach ($value as $v) {
	    		echo "<div class = 'newsChildBlock'><p class = 'newsParagraph'>".$value['new']."</p><div class = 'deleteNewDiv' id='v-".$value['id']."'>Удалить новость</div><div class = 'editNewDiv' id='ve-".$value['id']."'>Изменить новость</div></div>";
	    	}
	    }
	  } else if(isset($_SESSION['godSite']) != 1){
	  	foreach ($table as $key => $value) {
	    	foreach ($value as $v) {
	    		echo "<div class = 'newsChildBlock'><p class = 'newsParagraph'>".$value['new']."</p></div>";
	    	}
	    }
	  }
 	?>
		</div>
 	</div>
 	<p class = "oNasTitle">О нас</p>
 	<?php
		if(isset($_SESSION['godSite']) == 1){
		?>
	<script type="text/javascript">
 	window.onload = function(){
 		var newsDiv = document.getElementsByClassName('addNewDiv')[0];
 		newsDiv.addEventListener('click',function(){
 			var news = prompt('Введите новость');
 			if(news == null || news == undefined || news == ''){
 				alert('0');
 			} else{
 				$.ajax({
				    type: "POST",
				    data: {
				      "news" : news
				    },
				    success: function(data){
				      
				    }
				  });
 				location.reload()
 			}
 		});

 		var newsDeleteDiv = document.getElementsByClassName('deleteNewDiv');
		var newsParagr = document.getElementsByClassName('newsParagraph');
		for (let i = 0; i < newsDeleteDiv.length; i++) {
			newsDeleteDiv[i].addEventListener('click',function() {
				var vId = this.id.split('-')[1];
				var par = $(this).parent('.newsChildBlock');
				var textNew = newsParagr[i].textContent;
				$.ajax({
				    type: "POST",
				    data: {
				      "textNewForDelete" : textNew
				    },
				    success: function(data){
				      par.remove();
				    }
				 });
				location.reload()
			});
		}

		var newsEditDiv = document.getElementsByClassName('editNewDiv');
		var newsParagr = document.getElementsByClassName('newsParagraph');
		for (let i = 0; i < newsDeleteDiv.length; i++) {
			newsEditDiv[i].addEventListener('click',function() {
				var textNewText = prompt('Введите новость для ее изменения', newsParagr[i].textContent);
				var newsEdit = newsParagr[i].textContent;
				$.ajax({
				    type: "POST",
				    data: {
				      "textNewForEdit" : newsEdit,
				      "textNewText" : textNewText
				    },
				    success: function(data){
				      
				    }
				 });
				location.reload()
			});
		}
 	}
 	</script>
 	<div class = "addNewDiv">Добавить новость</div>
 	<?php
	  }  
 	?>
 	<p class = "oNasContent">Существуя на российском рынке, компания успешно<br />
	зарекомендовала себя как надежная, стабильная и успешная организация.</p>
 </body>
 </html>