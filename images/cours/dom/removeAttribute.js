// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var circles = document.getElementsByTagNameNS(svgNS, 'circle');

	for(i=0;i<circles.length;i++)
	{
		circles.item(i).removeAttributeNS(null, 'cx');
	}
}
