// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	// obtenir la valeur d'un attribut
	var g1Circles = document.getElementById('g1').getElementsByTagNameNS(svgNS, 'circle');
	for(i=0;i<=g1Circles.length - 1;i++)
	{
		alert('Rayon du cercle : '+g1Circles.item(i).getAttributeNS(null, 'r'));
	}

	// modifier la valeur d'un attribut
	var g2Circles = document.getElementById('g2').getElementsByTagNameNS(svgNS, 'circle');
	for(i=0;i<=g2Circles.length - 1; i++)
	{
		g2Circles.item(i).setAttributeNS(null, 'r', '40');
	}
}
