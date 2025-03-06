// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setup, false);

var position = 0;

function setup(){
	document.rootElement.addEventListener('click', truncateText, false);
}

function truncateText(){
	var txtElts = document.getElementsByTagNameNS(svgNS, 'text');

	for(i=0;i<txtElts.length;i++)
	{
		txt = txtElts.item(i);
		if(txt.getComputedTextLength() > 148)
		{
			var max = 0;
			while(max < txt.getNumberOfChars() - 1 && txt.getEndPositionOfChar(max).x < 185)
			{
				max++;
			}
			txt.firstChild.data = txt.firstChild.data.substr(0, max) + '…';
		}
	}
}