// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', changeStroke, false);

function changeStroke(){
	// on récupère le rectangle
	rectangle = document.getElementById('rect');

	// on récupère le style calculé
	var véritableStyle = document.defaultView.getComputedStyle(rectangle, null);

	alert('Valeur de \'fill\' : ' + véritableStyle.getPropertyValue('fill'));
	alert('Valeur de \'stroke\' : ' + véritableStyle.getPropertyValue('stroke'));
	alert('Valeur de \'stroke-width\' : ' + véritableStyle.getPropertyValue('stroke-width'));
	alert('Valeur de \'stroke-dasharray\' : ' + véritableStyle.getPropertyValue('stroke-dasharray'));
	alert('Valeur de \'stroke-linecap\' : ' + véritableStyle.getPropertyValue('stroke-linecap'));
}
