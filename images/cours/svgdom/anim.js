// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

function setup(){
	document.getElementById('begin').addEventListener('click', begin, false);
	document.getElementById('beginat').addEventListener('click', beginat, false);
	document.getElementById('stop').addEventListener('click', stop, false);
	document.getElementById('stopat').addEventListener('click', stopat, false);
}

function begin(){
	document.getElementById('anim').beginElement();
	}

function beginat(){
	document.getElementById('anim').beginElementAt(2);
	}

function stop(){
	document.getElementById('anim').endElement();
	}

function stopat(){
	document.getElementById('anim').endElementAt(2);
	}
