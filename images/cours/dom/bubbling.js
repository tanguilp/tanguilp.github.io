// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents()
{
	// ajout de l'évènement sur <g id="g"/>
	g = document.getElementById('g');
	g.addEventListener('click', gClick, false);

	// ajout de l'évènement sur le carré
	carré = document.getElementById('carré');
	carré.addEventListener('click', carréClick, false);
}

function gClick()
{
	alert('Clic sur le <g/>');
}

function carréClick()
{
	alert('Clic sur le carré');
}