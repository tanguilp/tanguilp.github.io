// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', supprCercle, false);

function supprCercle(){
	cercles = document.getElementsByTagNameNS(svgNS, 'circle');

	// on supprime seulement s'il y a encore des cercles
	if(cercles.length > 0)
	{
		// on sélectionne le premier cercle
		toRemove = cercles.item(0);

		// on sélectionne le père
		parentCircle = toRemove.parentNode;

		// on supprime le cercle
		parentCircle.removeChild(toRemove);
	}
}
