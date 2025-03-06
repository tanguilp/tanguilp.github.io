// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

function setup(){
	setInterval(checkEnclosureAndIntersect, 50);
}

function checkEnclosureAndIntersect(){
	circles = document.getElementsByTagNameNS(svgNS, 'circle');

	// initialisation, on donne la couleur rose à tous les cercles
	for(i=0; i<circles.length; i++)
	{
		circles.item(i).style.setProperty('fill', 'deeppink', null);
	}

	// on crée le SVGRect qui sert de référence
	area = document.rootElement.createSVGRect();
	area.x = 100;
	area.y = 100;
	area.width = 200;
	area.height = 200;

	// intersection : couleur rouge
	intersect = document.rootElement.getIntersectionList(area, document.getElementById('rect'));
	for(i=0; i<intersect.length; i++)
	{
		intersect.item(i).style.setProperty('fill', 'red', null);
	}

	// inclusion : couleur verte
	inside = document.rootElement.getEnclosureList(area, null);
	for(i=0; i<inside.length; i++)
	{
		inside.item(i).style.setProperty('fill', 'greenyellow', null);
	}
}

// seconde version utilisant une autre méthode
function checkEnclosureAndIntersect2(){
	area = document.rootElement.createSVGRect();
	area.x = 100;
	area.y = 100;
	area.width = 200;
	area.height = 200;

	circles = document.getElementsByTagNameNS(svgNS, 'circle');
	for(i=0; i<circles.length; i++)
	{
		if(document.rootElement.checkEnclosure(circles.item(i), area))
		{
			circles.item(i).style.setProperty('fill', 'greenyellow', null);
		}
		else if(document.rootElement.checkIntersection(circles.item(i), area))
		{
			circles.item(i).style.setProperty('fill', 'red', null);
		}
		else{
			circles.item(i).style.setProperty('fill', 'deeppink', null);
		}
	}
}
