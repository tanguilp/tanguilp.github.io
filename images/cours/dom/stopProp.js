// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents()
{
	// ajout des observeurs sur le premier carré
	g1 = document.getElementById('g1');
	g1.addEventListener('click', click1, false);

	carré1 = document.getElementById('carré1');
	carré1.addEventListener('click', click1, false);

	// ajout des observeurs sur le second carré
	g2 = document.getElementById('g2');
	g2.addEventListener('click', click2, true);

	carré2 = document.getElementById('carré2');
	carré2.addEventListener('click', click2, false);
}

function click1(evt)
{
	alert('Clic sur ' + evt.currentTarget.getAttributeNS(null, 'id'));
}

function click2(evt)
{
	alert('Clic sur ' + evt.currentTarget.getAttributeNS(null, 'id'));

	// arrêt de la propagation de l'évènement
	evt.stopPropagation();
}