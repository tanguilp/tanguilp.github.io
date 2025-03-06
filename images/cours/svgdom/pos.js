// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

function setup()
{
	updateViewportText();

	// mise à jour lorsque la souris bouge
	document.rootElement.addEventListener('mousemove', updateMousePosText, false);

	// mise à jour lorsque la fenêtre est redimenssionée
	document.rootElement.addEventListener('SVGResize', updateViewportText, false);
}

function updateMousePosText(evt)
{
	// mise à jour des 4 textes
	document.getElementById('clientX').firstChild.data = 'clientX : ' + evt.clientX;
	document.getElementById('clientY').firstChild.data = 'clientY : ' + evt.clientY;
	document.getElementById('screenX').firstChild.data = 'screenX : ' + evt.screenX;
	document.getElementById('screenY').firstChild.data = 'screenY : ' + evt.screenY;
}

function updateViewportText()
{
	// on enregistre le viewport
	// vp est de type SVGRect
	vp = document.rootElement.viewport;

	// on concaténe les qutre composante de l'objet SVGRect
	vpText = 'viewport : ' + vp.x + ' ' + vp.y + ' '
		+ vp.width + ' ' + vp.height;

	// on met à jour le texte
	document.getElementById('viewport').firstChild.data = vpText;
}