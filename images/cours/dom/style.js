// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', changeStroke, false);

function changeStroke(){
	var rect = document.getElementById('rect');

	// on récupère la valeur de la propriété CSS stroke-dasharray
	valeur = rect.style.getPropertyValue('stroke-dasharray');

	// on montre la valeur
	alert(valeur);

	// modification de la valeur
	if(valeur == '8, 20')
	{
		rect.style.setProperty('stroke-dasharray', '20, 8', null);
	}
	else
	{
		rect.style.setProperty('stroke-dasharray', '8, 20', null);
	}
}
