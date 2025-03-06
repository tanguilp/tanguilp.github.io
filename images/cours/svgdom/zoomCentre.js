// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', timer, false);

function timer()
{
	setInterval(zoomCentré, 50);
}

function zoomCentré(){
	scale = document.rootElement.currentScale;
	document.rootElement.currentTranslate.x = 0 - 100 * (scale - 1);
	document.rootElement.currentTranslate.y = 0 - 120 * (scale - 1);
	document.rootElement.currentScale += 0.01;
}
