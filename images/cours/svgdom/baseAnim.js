// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

var rectangle = null;
var textBaseVal = null;
var textAnimVal = null;

function setup()
{
	rectangle = document.getElementById('rectangle');
	textBaseVal = document.getElementById('baseVal');
	textAnimVal = document.getElementById('animVal');

	setInterval(showValues, 50);
}

function showValues()
{
	baseVal = rectangle.width.baseVal.value;
	animVal = rectangle.width.animVal.value;

	textBaseVal.firstChild.data = 'Valeur de base : ' + baseVal;
	textAnimVal.firstChild.data = 'Valeur d’animation : ' + parseInt(animVal);
}
