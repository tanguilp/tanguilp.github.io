// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents()
{
	// ajout de l'évènement sur le <g id="g"/>
	g = document.getElementById('g');
	// !!! en mode capure !!!
	g.addEventListener('click', gClick, true);

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