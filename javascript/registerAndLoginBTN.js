window.onload = function(){
	var registerBTN = document.getElementsByClassName('registerButton')[0];
		registerBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/registerAndLoginButtonActive.png)';
		});
		registerBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/registerAndLoginButtonNotActive.png)';
		});
	var loginBTN = document.getElementsByClassName('loginButton')[0];
		loginBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/registerAndLoginButtonActive.png)';
		});
		loginBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/registerAndLoginButtonNotActive.png)';
		});
}
