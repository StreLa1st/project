// window.onload = function(){
// 	var newsBlock = document.getElementsByClassName('newsBlock')[0];
// 	if(newsBlock.style.overflowY == "scroll"){
// 		alert('asd');
// 		this.style.width = newsBlock.offsetWidth+17+"px";
// 	}
// }
window.onload = function(){
  var newsBlock = document.getElementsByClassName('newsBlock')[0];
  alert(newsBlock.children.length);
  if(newsBlock.children.length > 4){
    newsBlock.style.width = newsBlock.offsetWidth+17+'px';
  }
}