window.onload = function(){
	var sendBTN = document.getElementsByTagName('input')[0];
		sendBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/activeSendButton.png)';
		});
		sendBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/notActiveSendButton.png)';
		});
}
