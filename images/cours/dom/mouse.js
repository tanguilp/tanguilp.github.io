// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', listeners, false);

function listeners()
{
	cercle = document.getElementById('cercle');

	cercle.addEventListener('mousedown', setListener, false);
	cercle.addEventListener('mouseup', removeListener, false);
}

function setListener(){
	cercle = document.getElementById('cercle');
	cercle.addEventListener('mousemove', bougerCercle, false);
}

function removeListener(){
	cercle = document.getElementById('cercle');
	cercle.removeEventListener('mousemove', bougerCercle, false);
}

function bougerCercle(evt){
	cercle = document.getElementById('cercle');

	svgWidth = document.rootElement.viewport.width;
	posX = (evt.clientX - document.rootElement.currentTranslate.x) / document.rootElement.currentScale / svgWidth * 400;

	svgHeight = document.rootElement.viewport.height;
	posY = (evt.clientY - document.rootElement.currentTranslate.y) / document.rootElement.currentScale / svgHeight * 300;

	cercle.setAttributeNS(null, 'cx', posX);
	cercle.setAttributeNS(null, 'cy', posY);
}