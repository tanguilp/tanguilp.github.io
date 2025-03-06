// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', timers, false);

function timers()
{
	setInterval(zoom, 50);
	setInterval(translate, 50);
}

function zoom(){
	document.rootElement.currentScale += 0.001;
	txt = document.getElementById('txt');
	txt.firstChild.data = 'Zoom : '+ document.rootElement.currentScale;
	txt.style.setProperty('font-size', 20 / document.rootElement.currentScale, null);
}

function translate(){
	document.rootElement.currentTranslate.x -= 0.3;
	document.rootElement.currentTranslate.y += 0.3;
	document.getElementById('transX').firstChild.data =
		'Translation sur x : ' + document.rootElement.currentTranslate.x;
	document.getElementById('transY').firstChild.data =
		'Translation sur y : ' + document.rootElement.currentTranslate.y;
}
