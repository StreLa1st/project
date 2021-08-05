window.onload = function(){
	var findBTN = document.getElementsByClassName('queryButton')[0];
		findBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/queryButtonActive.png)';
		});
		findBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/queryButtonNotActive.png)';
		});
}
