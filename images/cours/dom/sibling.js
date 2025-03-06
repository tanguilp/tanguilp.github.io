// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var g2 = document.getElementById('g2');

	// premier fils de g2
	var node = g2.firstChild;

	while(node != null)
	{
		alert('Nœud de type : ' + node);
		// on passe au frère suivant
		node = node.nextSibling;
	}
}
