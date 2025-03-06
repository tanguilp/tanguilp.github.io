// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

var position = 0;

function setup(){
	document.rootElement.addEventListener('click', animPath, false);
}

function animPath(){
	alert('Longueur du tracé : ' + document.getElementById('tracé').getTotalLength());
	timer = setInterval(displayCircle, 200);
}

function displayCircle(){
	// on récupère le point à la distance position
	point = document.getElementById('tracé').getPointAtLength(position);

	// on récupère le cercle
	cercle = document.getElementById('cercle');
	// on met à jour la position du cercle
	cercle.cx.baseVal.value = point.x;
	cercle.cy.baseVal.value = point.y;

	// on incrémente le compteur de distance
	position = (position + 50) % document.getElementById('tracé').getTotalLength();
}
