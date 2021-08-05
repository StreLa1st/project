window.onload = function(){
	var findBTN = document.getElementsByClassName('findButton')[0];
		findBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/findButtonActive.png)';
		});
		findBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/findButton.png)';
		});
}
