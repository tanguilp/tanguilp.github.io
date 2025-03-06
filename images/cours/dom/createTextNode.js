// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', addText, false);

function addText(){
	// création du nœud texte "tout sur SVG"
	tspanText = document.createTextNode('tout sur SVG');

	// création de l'élément tspan (avec les bons attributs)
	tspan = document.createElementNS(svgNS, 'tspan');
	tspan.setAttributeNS(null, 'x', '200');
	tspan.setAttributeNS(null, 'y', '200');

	// insertion du texte dans le tspan
	tspan.appendChild(tspanText);

	// création du nœud texte "SVGround"
	textText = document.createTextNode('SVGround ');

	// création de l'élément text (avec les bons attributs)
	textElt = document.createElementNS(svgNS, 'text');
	textElt.setAttributeNS(null, 'x', '200');
	textElt.setAttributeNS(null, 'y', '120');

	// ajout du œud texte à text
	textElt.appendChild(textText);

	// ajout du tspan à la fin de text
	textElt.appendChild(tspan);

	// insertion du tout dans le document
	document.rootElement.appendChild(textElt);
}
