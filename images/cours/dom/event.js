// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', listeners, false);

function listeners()
{
	rect = document.getElementById('rect');

	// ajout de deux évènements sur le carré
	rect.addEventListener('mouseover', setBlueFill, false);
	rect.addEventListener('mouseout', setGreenFill, false);
}

function setBlueFill(){
	rect = document.getElementById('rect');
	rect.style.setProperty('fill', 'cadetblue', null);
}

function setGreenFill(){
	rect = document.getElementById('rect');
	rect.style.setProperty('fill', 'greenyellow', null);
}
