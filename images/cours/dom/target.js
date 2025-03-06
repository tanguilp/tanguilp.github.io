// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents(){
	circleList = document.getElementsByTagNameNS(svgNS, 'circle');
	// circleList est de type NodeList
	// parcourons le

	for(i=0;i<=circleList.length-1;i++)
	{
		// on ajoute un observeur sur chaque cercle
		circleList.item(i).addEventListener('click', augmenterRayon, false);
	}
}

function augmenterRayon(evt){
	// on récupère le cercle cible
	cible = evt.target;

	// on récupère son rayon
	rayon = cible.getAttributeNS(null, 'r');

	// on l'agrandit de 10px
	cible.setAttributeNS(null, 'r', parseInt(rayon) + 10);
	// le parseInt convertit une chaîne en entier, sinon c'est une concaténation
}