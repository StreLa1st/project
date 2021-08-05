window.onload = function(){
	var menuButtons = document.getElementsByClassName('menuButtons');
	var n = 0;
	while(n < menuButtons.length){
		menuButtons[n].addEventListener('mouseover', function(){
			this.style.backgroundImage = 'url(images/activeMenuBTN.png)';
		});
		if(n != 0){
			menuButtons[n].addEventListener('mouseout', function(){
				this.style.backgroundImage = 'url(images/notActiveMenuBTN.png)';
			});
		}
		n++;
	}
}
