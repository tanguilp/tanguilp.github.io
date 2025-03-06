// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents(){
	eventsOnMouseOver();
	countryClick();
}

function eventsOnMouseOver()
{
	groups = document.getElementsByTagNameNS(svgNS, 'g');
	for(i=0;i<groups.length;i++)
	{
		groups.item(i).addEventListener('mouseover', appendAreaName, true);
	}
	countries = document.getElementsByTagNameNS(svgNS, 'path');
	for(i=0;i<countries.length;i++)
	{
		countries.item(i).addEventListener('mouseover', appendAreaName, false);
	}
}

function appendAreaName(evt){
	/*if(evt.target.tagName == 'path')
	{
		arrow = ' ';
	}
	else
	{
		arrow = ' -> ';
	}

	txt = document.createTextNode(evt.target.getAttributeNS(null, 'id') + arrow);

	loc = document.getElementById('loc');
	loc.appendChild(txt);*/
}

function countryClick(){
	countries = document.getElementsByTagNameNS(svgNS, 'path');
	for(i=0;i<countries.length;i++)
	{
		countries.item(i).addEventListener('click', zoomToCountry2, false);
	}
}

function zoomToCountry(evt){
	box = evt.target.getBBox();
	newViewBox = box.x + ' ' + box.y + ' ' + box.width + ' ' + box.height;

	oldViewBox = document.rootElement.getAttributeNS(null, 'viewBox');

	document.rootElement.setAttributeNS(null, 'viewBox', newViewBox);

	anim = document.getElementById('zoom');
	anim.setAttributeNS(null, 'from', oldViewBox);
	anim.setAttributeNS(null, 'to', newViewBox);

	//alert('old : ' + oldViewBox);
	//alert('new : ' + newViewBox);

	anim.beginElementAt(0.1);
}

function max(a, b){
	if(a > b)
		return a;
	else
		return b;
}

function min(a, b){
	if(a > b)
		return b;
	else
		return a;
}

function zoomToCountry2(evt){
	box = evt.target.getBBox();

	xScale = 800 / box.width;
	yScale = 600 / box.height;

	scale = min(xScale, yScale);

	document.rootElement.currentScale = 2;
	document.rootElement.currentTranslate.x = -100;
	document.rootElement.currentTranslate.y = -100;
}
