// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	// création de 100 cercles
	for(i=1;i<=100;i++)
	{
		// on crée le nouvel élément
		nouveauCercle = document.createElementNS(svgNS, 'circle');

		// on change la valeur de cx
		cx = Math.floor(Math.random() * 400);
		nouveauCercle.setAttributeNS(null, 'cx', cx);

		// on change la valeur de cy
		cy = Math.floor(Math.random() * 300);
		nouveauCercle.setAttributeNS(null, 'cy', cy);

		// on change la valeur du rayon
		nouveauCercle.setAttributeNS(null, 'r', 20);

		// on ajoute directement dans l'élément <svg/>
		document.rootElement.appendChild(nouveauCercle);
	}
}
