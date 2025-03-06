// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setListeners, false);

function setListeners()
{
	countries = document.getElementsByTagNameNS(svgNS, 'path');

	// on attache un observeur de clic sur tous les pays
	// qui sont les <path/>
	for(i=0;i<countries.length;i++)
	{
		country = countries.item(i);
		country.addEventListener('click', countryClicked, false);
	}
}

function countryClicked(evt)
{
	// l’id correspond au nom du pays
	alert('Zoom vers ' + evt.target.id);

	// on récupère l’élément <animate/> qui servira à
	// animer la viewBox (begin vaut indefinite)
	zoomAnimElt = document.getElementById('zoom');

	// on récupère la boîte englobante
	boundingBox = evt.target.getBBox();

	// on change la valeur de to
	zoomAnimElt.setAttributeNS(null, 'to',
		boundingBox.x + ' ' + boundingBox.y + ' ' + boundingBox.width + ' ' + boundingBox.height);

	// on démarre l’animation
	zoomAnimElt.beginElement();
}
