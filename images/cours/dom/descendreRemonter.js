// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var root = document.rootElement;
	alert('On est sur la racine : ' + root);

	// on sélectionne <g id="g2"/> qui est le huitième fils de <svg/>
	var g2 = root.childNodes.item(7);

	var firstCircle = g2.firstChild;
	alert('À présent sur le premier fils de g2 : ' + firstCircle);

	// on va sur le g imbriqué
	var g = g2.getElementsByTagNameNS(svgNS, 'g').item(0);
	alert('Le dernier nœud de ce <g/> est : ' + g.lastChild);
}
