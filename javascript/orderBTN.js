window.onload = function(){
	var orderBTN = document.getElementsByClassName('orderButton')[0];
		orderBTN.addEventListener('mousedown', function(){
			this.style.backgroundImage = 'url(images/orderActiveButton.png)';
		});
		orderBTN.addEventListener('mouseup', function(){
			this.style.backgroundImage = 'url(images/orderNotActiveButton.png)';
		});
}
