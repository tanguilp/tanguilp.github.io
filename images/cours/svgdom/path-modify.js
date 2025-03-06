// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

function setup(){
	document.rootElement.addEventListener('click', animPath, false);
}

function animPath(){
	timer = setInterval(modifyPath, 50);
}

function modifyPath(){
	// on récupère la liste des segments
	segList = document.getElementById('tracé').pathSegList;

	// parcours de tous les segments
	// attention, on commence à 0 et on finit à n - 1
	for(i=0; i<segList.numberOfItems; i++)
	{
		// le segment courrant
		item = segList.getItem(i);

		// dans cet exemple, on n’utilise que 2
		// commandes : M (2) et C (6)
		switch(item.pathSegType)
		{
		case 2:
			// commande M
			item.x += getRandomNumber();
			item.y += getRandomNumber();
			break;
		case 6:
			// commande C
			item.x += getRandomNumber();
			item.y += getRandomNumber();
			item.x1 += getRandomNumber();
			item.y1 += getRandomNumber();
			item.x2 += getRandomNumber();
			item.y2 += getRandomNumber();
			break;
		}
	}
}

// renvoie un nombre aléatoire entre -0.5 et 0.5
function getRandomNumber(){
	return(Math.random() * 2 - 1);
}
