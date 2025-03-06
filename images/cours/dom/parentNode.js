// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var g2 = document.getElementById('g2');
	alert('Père de g2 : ' + g2.parentNode);
}
