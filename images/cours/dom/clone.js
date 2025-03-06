// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', remplacer, false);

function remplacer(){
	cercles = document.getElementsByTagNameNS(svgNS, 'circle');

	// on remplace seulement s'il y a encore des cercles
	if(cercles.length > 0)
	{
		// on sélectionne le premier cercle
		cercleARemplacer = cercles.item(0);

		// on sauvegarde les coordonnées pour placer le carré à la même place
		cx = cercleARemplacer.getAttributeNS(null, 'cx');
		cy = cercleARemplacer.getAttributeNS(null, 'cy');

		// on sélectionne le père
		parentCircle = cercleARemplacer.parentNode;

		// on copie le carré prédéfini
		// ici pas besoin de copie en profondeur, <rect/> n'a pas de fils
		nouveauCarré = document.getElementById('carré').cloneNode(false);
		// on le palce au même endroit que le cercle
		nouveauCarré.setAttributeNS(null, 'x', cx - 30);
		nouveauCarré.setAttributeNS(null, 'y', cy - 30);

		// on rempalce le cercle
		parentCircle.replaceChild(nouveauCarré, cercleARemplacer);
	}
}
