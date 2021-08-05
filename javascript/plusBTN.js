window.onload = function(){
	var plusBTN = document.getElementsByClassName('plusDiv')[0];
		plusBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/plusDivActive.png)';
		});
		plusBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/plusDiv.png)';
		});
}
