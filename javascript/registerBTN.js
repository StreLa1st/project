window.onload = function(){
	var registerBTN = document.getElementsByClassName('registerButton')[0];
		registerBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/registerAndLoginButtonActive.png)';
		});
		registerBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/registerAndLoginButtonNotActive.png)';
		});
}
