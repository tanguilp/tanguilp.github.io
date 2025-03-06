// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	g = document.getElementById('g2');
	// g correspond maintenant a <g id="g2"/>

	circleList = g.getElementsByTagNameNS(svgNS, 'circle');
	// circleList est de type NodeList
	// parcourons le

	for(i=0;i<=circleList.length-1;i++)
	{
		alert(circleList.item(i));
	}
}
