// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', modifyText, false);

function modifyText(){
	texte = document.getElementsByTagNameNS(svgNS, 'text').item(0);
	// texte correspond à l'élément text (<text/>)
	// on veut le nœud texte donc le premier fils de <text/>
	texte = texte.firstChild;

	alert('Texte : ' + texte.data + '\nLongueur : '+texte.length);

	// modification du texte
	texte.data = 'Le SVG c\'est kewl';

	alert('Texte : ' + texte.data + '\nLongueur : '+texte.length);
}
