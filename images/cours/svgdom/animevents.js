// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

function setup(){
	document.getElementById('begin').addEventListener('click', begin, false);
	document.getElementById('pause').addEventListener('click', pause, false);
	document.getElementById('unpause').addEventListener('click', unpause, false);
	document.getElementById('stop').addEventListener('click', stop, false);

	var animElt = document.getElementById('anim');
	animElt.addEventListener('beginEvent', hasJustBegun, false);
	animElt.addEventListener('endEvent', hasJustEnded, false);
	animElt.addEventListener('repeatEvent', repetition, false);

	setInterval(showCurrentTime, 100);
}

function begin(){
	document.getElementById('anim').beginElement();
	}

function pause(){
	document.rootElement.pauseAnimations();
}

function unpause(){
	document.rootElement.unpauseAnimations();
}

function stop(){
	document.getElementById('anim').endElement();
	}

function hasJustBegun(){
	alert('L’animation vient de débuter');
	}

function hasJustEnded(){
	alert('L’animation vient de se terminer');
	}

function repetition(evt){
	alert('Répétition №'+evt.detail);
}

function showCurrentTime(){
	container = document.getElementById('txt');
	container.firstChild.data = 'Temps : ' + document.rootElement.getCurrentTime() + 's';
	}
