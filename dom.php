<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<title>SVGround : tout sur SVG</title>
<?php
require('inc/xhtml_head.php');
?>
</head>
<body>

<h1>
<object type="image/svg+xml" data="images/svground.svg">
<p>SVGround : cours SVG</p>
</object></h1>

<div id="contenu">
<h2>Le DOM avec JavaScript</h2>

<ul class="sommaire">
<li><a href="#intro">Introduction</a></li>
<li><a href="#arbre">Le modèle d’arbre</a></li>
<li><a href="#nav">Naviguer dans le document</a></li>
<li><a href="#attr">Manipuler les attributs</a></li>
<li><a href="#elem">Manipuler les éléments</a></li>
<li><a href="#txt">Les nœuds de texte</a></li>
<li><a href="#clonage">Clonage</a></li>
<li><a href="#style">Style</a></li>
<li><a href="#events">Gestion des évènements</a></li>
</ul>

<h3 id="intro">Introduction</h3>

<p>Si vous êtes arrivés jusqu’ici, vous savez à peu près tout sur SVG. Ça tombe bien, c’est le but de ce cours !</p>

<p>Néanmoins, SVG ne peut pas tout faire à lui tout seul. C’est un langage de dessin vectoriel et il se débrouille plutôt bien pour ça, mais il lui manque l’<strong>interactivité</strong>.</p>

<p>Même si la partie animation permet un peu d’interactivité (démarrage au clic par exemple), certaines choses demeurent impossibles avec SVG seul. Par exemple, comment agrandir le rayon d’un cercle de 10 pixels à chaque clic ? C’est impossible avec SVG seul.</p>

<p>La solution se nomme ECMAScript, plus connu sous le nom de JavaScript. C’est un langage de script compatible avec SVG.</p>

<p>JavaScript est en fait plutôt vieux. Il a fait son apparition en 1995 et est très utilisé aujourd’hui avec HTML.</p>

<p>JavaScript permet de manipuler des document HTML ou XML, de répondre à des interactions avec l’utilisateur, de communiquer sur le réseau (le fameux AJAX), etc. Mais dans cette partie, nous allons exclusivement voir comment manipuler la structure d’un document SVG.</p>

<p>Et nous allons nous servir de DOM, l’acronyme de Document Object Model. DOM est un ensemble d’interfaces définies par le W3C, le consortium qui se charge de publier les normes du Web. Plus précisément nous allons étudier le DOM Level 2 (qui contrairement au DOM Level 1 peut gérer les espaces de noms).</p>

<p>Il faut savoir que JavaScript a une mauvaise réputation, et ce pour plusieurs raisons. La première est c’est un langage interprété qui a longtemps été lent (puisqu’interprété). Vu les progrès réalisés par les navigateurs, c’est un problème en passe d’être résolu. La seconde raison est que ce langage a été utilisé à tort et à travers et d’une manière très sale. Les navigateurs n’ont pas tous des implémentations compatibles et pour beaucoup JavaScript rime avec galère.</p>

<p>Point de cela ici : je vais vous apprendre à manipuler les documents XML (SVG, XHTML, XForms, XBL, MathML, etc.) via le DOM ce qui est la manière la plus propre (et d’ailleurs la seule) de faire. Le gros avantage, c’est que le DOM est utilisable dans quasiment tous les langages de programmation. Ainsi, ce que vous aller apprendre ici vous pourrez vous en servir en PHP, Perl, Java, … C’est un investissement que vous ne regretterez pas !</p>

<p>Cette partie n’est pas un tutoriel sur JavaScript. Si vous ne le connaissez pas, je vous conseille d’aller voir un ou deux tutorials sur le Web. Mais rassurez vous, c’est un langage très facile à apprendre. De plus, vous devez connaître les bases de la syntaxe XML. Si vous avez besoin de vous rafraîchir la mémoire, consulter <a href="http://www.siteduzero.com/tutoriel-3-33440-le-point-sur-xml.html">ce tutorial sur XML</a>.</p>


<h3 id="arbre">Le modèle d’arbre</h3>

<p>Le DOM représente le document XML en une structure arborescente. Cet arbre contient des nœuds, chaque nœud possède zéro, un ou plusieurs fils. Voilà, vous connaissez le DOM. Tout, absolument tout, est un nœud : éléments (on ne dit pas balise mais élément), attributs, commentaires, processing-instructions et <strong>texte</strong> pour les principaux. Une chose que vous devez intégrer est qu’un nœud élément n’est pas le texte qu’il contient. Ainsi dans le document XML suivant :</p>

<div class="xmlcode"><![CDATA[<text>Du texte</text>]]></div>

<p>il y a deux nœuds et non un seul.</p>

<p>Prenons un document SVG basique et voyons comment il se décompose en arbre :</p>

<div class="xmlcode"><![CDATA[<svg>
<title>Document SVG de test</title>

<text>Du texte <tspan>en SVG</tspan></text>

</svg>
]]></div>


<p>Ce document est simplifié à l’extrème. Voici comment il est représenté dans l’arborescence du DOM :</p>


<p>Voici l’arbre correspondant :<br/>
<object data="images/cours/dom/arbre_dom.svg"><img style="display:block;margin:auto" src="images/cours/dom/arbre_dom.png" alt="Arbre du document XML"/></object></p>

<p>Notez que l’ordre est important : le nœud texte <span class="balise" xml:space="preserve">"Du texte "</span> précède le nœud <span class="balise">tspan</span>. C’est donc dans cet arbre que nous allons apprendre à naviguer, insérer et supprimer des éléments, modifier les attributs, etc.</p>


<h3 id="nav">Naviguer dans le document</h3>

<p>Mais pour commencer, où met-on le script ? C’est très simple : on utilise l’élément <span class="balise">script</span>. On peut inclure le script directement entre les deux balises où utiliser un script d’un autre fichier. Nous avons pris l’habitude de tout séparer et nous allons donc continuer ainsi. Le fichier JavaScript en question est pointé par l’attribut <span class="attribute">xlink:href</span>.</p>

<h4><span class="js">getElementById</span></h4>

<p>La manière la plus simple et la plus utilisée pour se rendre à un élément précis du document est d’utiliser <span class="js">getElementById(identifiant)</span>. Cette méthode va tout simplement retourner l’élément qui à l’identifiant indiqué (via l’attribut <span class="attribute">id</span>). Essayons avec ette ellipse :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="getElementById.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>getElementById avec le DOM</title>

<script xlink:href="getElementById.js"/>

<ellipse id="ellipse" cx="200" cy="150" rx="120" ry="50"/>

</svg>]]></div>

<div class="csscode"><![CDATA[ellipse{
	fill:none;
	stroke:cadetblue;
	stroke-width:110;
	stroke-dasharray:5, 5;
	}]]></div>

<div class="jscode"><![CDATA[document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	ellipse = document.getElementById('ellipse');
	alert(ellipse);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/getElementById.svg">getElementById avec le DOM</object>
</div>

<p>À présent, cliquez sur le dessin SVG : il doit apparaître <code>[object SVGEllipseElement]</code> ou quelque chose comme ça.</p>

<p>Regardons le script de plus près. Laissons tomber la première ligne pour le moment, nous y reviendrons plus tard. Elle est juste chargée de lancer la fonction <span class="jscode">myAlert</span> lorsqu’on clique sur le dessin SVG. La première chose intéressante est que nous n’avons pas utilisé <span class="js">getElementById</span> mais <span class="js">document.getElementById</span>. <span class="js">document</span> est un objet un peu spécial puisque vous y avez accès quand vous voulez ! Il représente le document par lequel le script a été appelé. C’est donc souvent par <span class="js">document</span> que <strong>tout commence pour manipuler le DOM</strong>. Un détail important : <span class="js">document</span> <strong>n’est pas</strong> la racine du document. C’est juste l’objet via lequel on va manipuler le document. La seconde chose intéressante c’est que la variable <span class="js">ellipse</span> correspond maintenant à notre ellipse sur le dessin. Cette variable est en fait un objet : tout est objet avec DOM. Et comme tout objet, notre variable a des <strong>propriétés</strong> et des <strong>méthodes</strong>. Nous verrons lesquelles (enfin en partie).</p>

<h4><span class="js">getElementsByTagNameNS</span>, espace de nom et liste de nœuds</h4>

<p>Une des grandes différences entre le DOM niveau 1 et le DOM niveau 2 tient au fait que ce dernier sait gérer les espaces de noms (namespaces). Toutes les méthodes qui finissent par NS ont une sœur sans ce NS. Mais je vous en conjure, ne les utilisez pas : les espaces de noms sont vraiment une caractéristique fondamentale de XML alors ne les ignorons pas. Toutes ces méthodes qui finissent par NS prennent en paramètre la chaîne identifiant l’espace de nom (qui n’a rien à voir avec le préfixe qui lui peut être quelconque et variable). Pour ne pas s’embêter avec eux, le mieux et d’intégrer ceux qu’on utilise en début de document, dans des constantes.</p>

<p>Revenons à notre méthode. <span class="js">getElementsByTagNameNS(espace de nom, nom de l’élément)</span> retourne la liste des éléments portant le nom indiqué dans l’espace de nom indiqué. Une liste ? Oui, il s’agit d’un objet (encore un) nommé <span class="js">NodeList</span> et on ne peut accéder aux éléments qu’à travers cet objet.</p>

<p>Vous vous servirez souvent de cet objet. <span class="js">NodeList</span> est simple à utiliser : il a une propriété, <span class="js">length</span>, qui donne la taille de la liste et une méthode, <span class="js">item(i)</span>, qui renvoie le i<sup>ème</sup> élément. Attention, ça commence à 0 et ça va jusqu’à <span class="js">length</span> - 1.</p>

<p>Le bonus, c’est qu’on peut appeler cette méthode aussi bien sur <span class="js">document</span> que sur n’importe quel élément du document. Dans ce dernier cas, seul les descendants correspondant à l’élément recherché seront sélectionnés.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="getElementsByTagNameNS.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>getElementsByTagNameNS avec le DOM</title>

<script xlink:href="getElementsByTagNameNS.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<circle cx="238" cy="37" r="20"/>
	<circle cx="32" cy="87" r="20"/>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
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
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/getElementsByTagNameNS.svg">getElementsByTagNameNS avec le DOM</object>
</div>

<p>Lors du clic, on a quatre fenêtres indiquant un <span class="js">[object SVGCircleElement]</span>, on n’a donc sélectionné que ceux qui sont dans le second <span class="balise">g</span>. Notez aussi qu’on aurait pu écrire directement <span class="js">document.getElementById('g2').getElementsByTagNameNS(svgNS, 'circle')</span>.</p>

<h4>Descendre et remonter</h4>

<p>Le DOM ayant un modèle d’arbre, on souhaite souvent descendre dans l’arborescence et, parfois, remonter.</p>

<p>Pour descendre, il y a trois possibilités :</p>

<ul class="list-attributes">
<li>avec <span class="js">childNodes</span> qui renvoie une liste de nœuds (<span class="js">NodeList</span>) que nous savons maintenant manipuler ;</li>
<li>avec <span class="js">firstChild</span> qui renvoie le premier fils directement ;</li>
<li>avec <span class="js">lastChild</span> qui renvoie le dernier fils directement.</li>
</ul>

<p>Pour cet exemple, nous allons partir de la racine du document. On peut y accéder facilement via <span class="js">document.rootElement</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="descendreRemonter.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Descendre et remonter dans le DOM</title>

<script xlink:href="descendreRemonter.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
		<rect x="200" y="99" width="57" height="57"/></g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var root = document.rootElement;
	alert('On est sur la racine : ' + root);

	// on sélectionne <g id="g2"/> qui est le huitième fils de <svg/>
	var g2 = root.childNodes.item(7);

	var firstCircle = g2.firstChild;
	alert('À présent sur le premier fils de g2 : ' + firstCircle);

	// on va sur le g imbriqué
	var g = g2.getElementsByTagNameNS(svgNS, 'g').item(0);
	alert('Le dernier nœud de ce <g/> est : ' + g.lastChild);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/descendreRemonter.svg">Descendre et remonter dans le DOM</object>
</div>

<p>Je vois déjà votre étonnement. Pourquoi <span class="attribute">g2</span> est il le huitième fils de <span class="balise">svg</span> ? Et pourquoi le premier fils de <span class="attribute">g2</span> n’est il pas de type <span class="js">SVGCircleElement</span> ? Simplement parceque les espaces, tabulations et sauts à la ligne sont des nœuds textes ! Ce qui fait qu’il n’est finalement pas très facile de naviguer dans le document de cette manière…</p>

<p>Le premier nœud (<span class="js">firstChild</span>) correspond donc au saut à la ligne plus la tabulation consécutive au tag <span class="balise sanslt">&lt;g id="g2"></span>. Par contre, le dernier enfant du <span class="balise">g</span> imbriqué est bien le rectangle puisqu’il n’y a pas de texte entre les deux tags <span class="balise">rect x="200" y="99" width="57" height="57"</span> et <span class="balise sanslt">&lt;/g></span>.</p>

<p>Il n’y a pas ce genre de soucis avec la remontée. on peut accéder au père (qui est unique) de chaque nœud avec <span class="js">parentNode</span>. Voici un exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="parentNode.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>parentNode avec le DOM</title>

<script xlink:href="parentNode.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
		<rect x="200" y="99" width="57" height="57"/>
	</g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var g2 = document.getElementById('g2');
	alert('Père de g2 : ' + g2.parentNode);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/parentNode.svg">parentNode avec le DOM</object>
</div>

<p>Le père de <span class="attribute">g2</span> est bien la racine <span class="balise">svg</span> du document.</p>

<h4>Passer par les frères</h4>

<p>Toutes les méthodes et propriétés utilisées précédemment renvoient <span class="js">null</span> lorsque l’élément n’existe pas. Par exemple, <span class="js">document.getElementBy('identifiant inexistant')</span> ou <span class="js">document.getElementsByTagNameNS(svgNS, 'circle').item(500)</span> renvoient <span class="js">null</span> dans le document précédent.</p>

<p>On peut accéder au frère suivant et au frère précédent grâce aux propriétés <span class="js">nextSibling</span> et <span class="js">previousSibling</span>. Les frères sont les nœuds qui se situent strictement au <strong>même niveau</strong>. On ne descend pas ni ne remonte avec ces propriétés. Ces deux propriétés renvoient <span class="js">null</span> si on est, selon le cas, sur le dernier nœud ou sur le premier. Parcourons le second <span class="balise">g</span> du document précédent frère par frère.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="sibling.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Parcourir les frères avec le DOM</title>

<script xlink:href="sibling.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
		<rect x="200" y="99" width="57" height="57"/>
	</g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var g2 = document.getElementById('g2');

	// premier fils de g2
	var node = g2.firstChild;

	while(node != null)
	{
		alert('Nœud de type : ' + node);
		// on passe au frère suivant
		node = node.nextSibling;
	}
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/sibling.svg">Parcourir les frères avec le DOM</object>
</div>

<!-- getElementById, getElementsByTagNameNS (nodeList),
	firstChild, lastChild, childNodes, parentNode,
	nextSibling, previousSibling, rootElement -->

<h3 id="attr">Manipuler les attributs</h3>

<p>Maintenant que nous savons comment naviguer dans le document, modifions le. Et pour commencer, les attributs.</p>

<p>Pour obtenir la valeur d’un attribut sur un élément, on appelle la méthode <span class="js">getAttributeNS(espace de nom, nom de l’attribut)</span>. Pour changer sa valeur, on utilise <span class="js">setAttributeNS(espace de nom, nom de l’attribut, nouvelle valeur)</span>.</p>

<p>Attention, il y a une étrangeté avec le DOM à ce sujet. Si l’attribut qu’on modifie est dans le même espace de nom (donc est du même langage) que son élément, alors on doit mettre la valeur <span class="js">null</span> pour son espace de nom. C’est le cas dans l’exemple suivant puisque les attributs modifiés le sont dans l’espace de nom de SVG.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="setGetAttr.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Modifier la valeurs des attributs</title>

<script xlink:href="setGetAttr.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="35"/>
	<circle cx="25" cy="276" r="45"/>
	<circle cx="157" cy="155" r="15"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
		<rect x="200" y="99" width="57" height="57"/>
	</g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	// obtenir la valeur d’un attribut
	var g1Circles = document.getElementById('g1').getElementsByTagNameNS(svgNS, 'circle');
	// on parcourt tous les cercles de g1
	for(i=0;i<=g1Circles.length - 1;i++)
	{
		alert('Rayon du cercle : '+g1Circles.item(i).getAttributeNS(null, 'r'));
	}

	// modifier la valeur d’un attribut
	var g2Circles = document.getElementById('g2').getElementsByTagNameNS(svgNS, 'circle');
	// on parcourt tous les cercles de g2
	for(i=0;i<=g2Circles.length - 1; i++)
	{
		g2Circles.item(i).setAttributeNS(null, 'r', '40');
	}
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/setGetAttr.svg">Modifier la valeurs des attributs</object>
</div>

<p>Grâce à ces deux méthodes, on peut quasiment tout faire sur les attributs, à part les supprimer. Pour supprimer un attribut, on utilise la méthode <span class="js">removeAttributeNS(espace de nom, nom de l’attribut)</span> de l’élément qui le porte.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="removeAttribute.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Supprimer un attribut</title>

<script xlink:href="removeAttribute.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="35"/>
	<circle cx="25" cy="276" r="45"/>
	<circle cx="157" cy="155" r="15"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
		<rect x="200" y="99" width="57" height="57"/>
	</g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	var circles = document.getElementsByTagNameNS(svgNS, 'circle');

	for(i=0;i<circles.length;i++)
	{
		circles.item(i).removeAttributeNS(null, 'cx');
	}
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/removeAttribute.svg">Supprimer un attribut</object>
</div>

<p>La valeur par défaut de <span class="attribute">cx</span> est 0 et c’est la valeur que prend l’attribut lorsqu’il est supprimé. Remarquer qu’on a aussi mis <span class="js">null</span> comme espace de nom.</p>

<!-- getAttributeNS, setAttributeNS, removeAttributeNS -->

<h3 id="elem">Manipuler les éléments</h3>

<!-- createElementNS, appendChild, insertBefore, removeChild -->

<h4>Créer des éléments</h4>

<p>Avant d’insérer des éléments dans un document, il faut les créer. Et pour créer un élément, il faut le demander à <span class="js">document</span> via la méthode <span class="js">createElementNS(espace de nom, nom de l’élément)</span> qui va donc renoyer le nouvel élément. On peut ensuite ajouter des attributs avec <span class="js">setAttributeNS</span> avant d’insérer le nouvel élément dans le document.</p>

<h4>Insérer des éléments dans le documents</h4>

<p>Il existe deux manières d’ajouter : insérer à la fin d’un élément et insérer avant un élément.</p>

<p>Pour ajouter à la fin d’un élément <span class="js">elt</span>, on utilise la méthode <span class="js">elt.appendChild(élément à ajouter)</span> où <span class="js">elt</span> est l’élément dans lequel on insère le nœud. Le nœud ajouté sera donc le dernier fils de <span class="js">elt</span>.</p>

<p>Dans l’exemple suivant, cliquez pour insérer 100 cercles !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="appendChild.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Créer et insérer des nœuds avec appendChild</title>

<script xlink:href="appendChild.js"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
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

		// on ajoute directement dans l’élément <svg/>
		document.rootElement.appendChild(nouveauCercle);
	}
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/appendChild.svg">Créer et insérer des nœuds avec appendChild</object>
</div>

<p>Pour insérer un nœud à un élément <span class="js">elt</span>, on utilise <span class="js">elt.insertBefore(élément à insérer, élément de référence)</span> et le nœud s’ajoute comme frère avant le nœud de référence.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="insertBefore.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Insérer des nœuds avec insertBefore</title>

<script xlink:href="insertBefore.js"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', myAlert, false);

function myAlert(){
	do
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
		nouveauCercle.setAttributeNS(null, 'r', 50);

		// on ajoute directement dans l’élément <svg/>
		document.rootElement.insertBefore(nouveauCercle, document.rootElement.firstChild);

		insert = confirm('Ajouter un autre élément ?');
	}while(insert);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/insertBefore.svg">Insérer des nœuds avec insertBefore</object>
</div>

<p>Quelle est la différence avec <span class="js">appendChild</span> ? Les formes SVG étant dessinée dans l’ordre du document, les éléments insérés seront dessinés derrière ceux qui sont déjà là. Insérez-en plusieurs et vous le verrez.</p>

<h4>Supprimer un élément</h4>

<p>Pour terminer, il est possible de supprimer des éléments avec <span class="js">removeChild</span> qui s’utilise sur le père de l’élément à supprimer (ce qui est un peu contraignant) : <span class="js">père.removeChild(élément à supprimer)</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="removeChild.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Supprimer un élément</title>

<script xlink:href="removeChild.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
		<rect x="200" y="99" width="57" height="57"/>
	</g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', supprCercle, false);

function supprCercle(){
	cercles = document.getElementsByTagNameNS(svgNS, 'circle');

	// on supprime seulement s’il y a encore des cercles
	if(cercles.length > 0)
	{
		// on sélectionne le premier cercle
		toRemove = cercles.item(0);

		// on sélectionne le père
		parentCircle = toRemove.parentNode;

		// on supprime le cercle
		parentCircle.removeChild(toRemove);
	}
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/removeChild.svg">Supprimer un élément</object>
</div>


<h3 id="txt">Les nœuds de texte</h3>

<p>Il ne manque plus qu’une chose pour pouvoir manipuler un document XML comme on veut : la gestion des nœuds de texte dans les éléments.</p>

<p>Un nœud texte a deux propriétés : <span class="js">data</span> et <span class="js">length</span>. Grâce à <span class="js">data</span> on peut obtenir et modifier le texte du nœud. Avec <span class="js">length</span> on obtient le nombre de lettres du nœud.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="chdata.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Modification de texte</title>

<script xlink:href="chdata.js"/>

<text x="200" y="170">SVGround</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	fill:turquoise;
	text-anchor:middle;
	font-size:40px;
	stroke:black;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', modifyText, false);

function modifyText(){
	texte = document.getElementsByTagNameNS(svgNS, 'text').item(0);
	// texte correspond à l’élément text (<text/>)
	// on veut le nœud texte donc le premier fils de <text/>
	texte = texte.firstChild;

	alert('Texte : ' + texte.data + '\nLongueur : '+texte.length);

	// modification du texte
	texte.data = 'Le SVG c’est kewl';

	alert('Texte : ' + texte.data + '\nLongueur : '+texte.length);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/chdata.svg">Modification de texte</object>
</div>

<p>Parfois vous aurez besoin de créer des nœuds texte. En effet, dans l’exemple précédent, on a pu manipuler le nœud texte parcequ’il existait déjà. Mais si ce n’est pas le cas, il faut le créer et l’ajouter à l’élément.</p>

<p>Comme pour la création d’élément, la création d’un nouveau nœud texte se fait via <span class="js">document</span> et la méthode <span class="js">createTextNode('Nouveau texte')</span> qui renvoie le nœud texte.</p>

<p>Je vous propose de créer et d’ajouter a un document SVG le texte suivant : <span class="balise"><![CDATA[<text x="200" y="120">SVGround <tspan x="200" y="200">tout sur SVG</tspan></text>]]></span>. Les différentes étapes pour obtenir ceci sont :</p>

<ul class="list-attributes">
<li>création du nœud texte "tout sur SVG" ;</li>
<li>création de l’élément <span class="balise">tspan</span> (avec les bons attributs) ;</li>
<li>insertion du texte dans le <span class="balise">tspan</span> ;</li>
<li>création du nœud texte "SVGround" ;</li>
<li>création de l’élément <span class="balise">text</span> (avec les bons attributs) ;</li>
<li>ajout du œud texte à <span class="balise">text</span> ;</li>
<li>ajout du <span class="balise">tspan</span> à la fin de <span class="balise">text</span> ;</li>
<li>insertion du tout dans le document.</li>
</ul>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="createTextNode.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Création de nœuds de texte</title>

<script xlink:href="createTextNode.js"/>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	fill:turquoise;
	text-anchor:middle;
	font-size:40px;
	stroke:black;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', addText, false);

function addText(){
	// création du nœud texte "tout sur SVG"
	tspanText = document.createTextNode('tout sur SVG');

	// création de l’élément tspan (avec les bons attributs)
	tspan = document.createElementNS(svgNS, 'tspan');
	tspan.setAttributeNS(null, 'x', '200');
	tspan.setAttributeNS(null, 'y', '200');

	// insertion du texte dans le tspan
	tspan.appendChild(tspanText);

	// création du nœud texte "SVGround"
	textText = document.createTextNode('SVGround ');

	// création de l’élément text (avec les bons attributs)
	textElt = document.createElementNS(svgNS, 'text');
	textElt.setAttributeNS(null, 'x', '200');
	textElt.setAttributeNS(null, 'y', '120');

	// ajout du œud texte à text
	textElt.appendChild(textText);

	// ajout du tspan à la fin de text
	textElt.appendChild(tspan);

	// insertion du tout dans le document
	document.rootElement.appendChild(textElt);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/createTextNode.svg">Création de nœuds de texte</object>
</div>

<p>Avec de la méthode, vous ne ferez normalement pas d’erreur. Pour débugger, je vous conseille d’utiliser la console d’erreur de Firefox.</p>

<!-- createTextNode -->

<h3 id="clonage">Clonage</h3>

<p>Dans l’exemple précédent, on a vu que le DOM était assez verbeux. C’est inévitable mais on peut parfois réutiliser des éléments qui sont déjà dans le document.</p>

<p>Pour cela, on appelle la méthode <span class="js">cloneNode(profondeur)</span> sur l’élément que l’on veut cloner. Cette méthode renvoie le nouvel élément (la copie donc) et le paramêtre <span class="js">profondeur</span> est un booléen qui indique si on doit copier les fils de cet élément. On peut donc copier tout un groupe <span class="balise">g</span> en mettant ce paramêtre à <span class="js">true</span>.</p>

<p>Dans l’exemple suivant, on utilisera un <span class="balise">rect</span> déjà défini dans <span class="balise">defs</span>.</p>

<p>Une dernière méthode pourra vous être utile pour remplacer un élément par un autre. Il s’agit de <span class="js">père.replaceChild(nouvel élément, élément à remplacer)</span> qui s’appelle sur le père de l’élément à remplacer.</p>

<p>Dans l’exemple suivant, nous allons remplacer tous les cercles par des carrés.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="clone.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Copie et remplacement d’éléments</title>

<script xlink:href="clone.js"/>

<defs>
	<rect id="carré" width="60" height="60"/>
</defs>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<g>
		<circle cx="238" cy="37" r="20"/>
		<circle cx="32" cy="87" r="20"/>
	</g>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', remplacer, false);

function remplacer(){
	cercles = document.getElementsByTagNameNS(svgNS, 'circle');

	// on remplace seulement s’il y a encore des cercles
	if(cercles.length > 0)
	{
		// on sélectionne le premier cercle
		cercleARemplacer = cercles.item(0);

		// on sauvegarde les coordonnées pour placer le carré à la même place
		cx = cercleARemplacer.getAttributeNS(null, 'cx');
		cy = cercleARemplacer.getAttributeNS(null, 'cy');

		// on sélectionne le père
		parentCircle = cercleARemplacer.parentNode;

		// on copie le carré prédéfini
		// ici pas besoin de copie en profondeur, <rect/> n’a pas de fils
		nouveauCarré = document.getElementById('carré').cloneNode(false);
		// on le place au même endroit que le cercle
		nouveauCarré.setAttributeNS(null, 'x', cx - 30);
		nouveauCarré.setAttributeNS(null, 'y', cy - 30);

		// on rempalce le cercle
		parentCircle.replaceChild(nouveauCarré, cercleARemplacer);
	}
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/clone.svg">Copie et remplacement d’éléments</object>
</div>
<!-- cloneNode, replaceChild -->

<p>Voilà, vous connaissez le DOM Level 2 Core. Enfin les parties les plus importantes parcequ’il y a en fait beaucoup plus de méthodes et de propriétés mais celles dont vous vous servirez dans 99% des cas ont été présentées ici. Tout ce que vous avez appris jusqu’à cette phrase, vous pouvez le réutiliser quasiment à l’identique dans n’importe quel langage de programmation.</p>

<h3 id="style">Style</h3>

<p>Passons maintenant au DOM Level 2 Style (ça en jette). Il s’agit d’une API très volumineuse et complexe pour gérer les styles et les feuilles de style d’un document XML. Il est par exemple possible de créer sa feuille de style et d’écrire les règles une par une… Heureusement, nos besoins en la matière sont très simples : tout ce que nous voulons et de pouvoir récupérer un style précis d’un élément et de le modifier.</p>

<p>À part une subtilité que nous verrons plus tard, c’est très simple. Chaque élément à une propriété <span class="js">style</span> qui renvoie un objet <span class="js">CSSStyleDeclaration</span>. Cet objet à deux méthode qui nous intéressent :</p>

<ul class="list-attributes">
<li><span class="js">getPropertyValue(propriété CSS)</span> qui renvoie la valeur d’une propriété CSS ;</li>
<li><span class="js">setProperty(propriété CSS, nouvelle valeur, null)</span> qui fixe une nouvelle valeur pour une propriété.</li>
</ul>

<p>Pour résumer, on obtient la valeur d’une propriété CSS sur un élément <span class="js">elt</span> en écrivant <span class="js">elt.style.getPropertyValue('nom de la propriété')</span> et on la change en écrivant <span class="js">elt.style.setProperty('nom de la propriété', 'nouvelle valeur', null)</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="style.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Accéder au style et le modifier avec le DOM</title>

<script xlink:href="style.js"/>

<rect id="rect" x="100" y="100" width="200" height="100"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	stroke-dasharray:20, 8;
	stroke-linecap:round;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
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
}]]></div>

<p>Cliquez plusieurs fois :</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/style.svg">Accéder au style et le modifier avec le DOM</object>
</div>

<p>Avez vous remarqué la subtilité ? Lors du premier clic, la valeur de la propriété CSS ne s’est pas affiché, ce qui signifie que <span class="js">getPropertyValue(prop)</span> a renvoyé une chaîne vide, alors que la feuille de style donnait pourtant une valeur pour cette propriété.</p>

<p>En fait c’est le comportement normal. <span class="js">getPropertyValue(prop)</span> ne renvoie une valeur que si le style a été indiqué via <span class="js">setProperty()</span> ou via l’attribut <span class="attribute">style</span> sur l’élément. Il n’est donc pas possible de récupérer la valeur pourtant bien réelle spécifiée dans la feuille de style avec <span class="js">getPropertyValue(prop)</span>.</p>

<p>Pour récupérer de telles valeurs, il faut utiliser, accrochez vous, la méthode <span class="js">document.defaultView.getComputedStyle(élément dont on veut récupérer le style, null)</span> qui renvoie un objet <span class="js">CSSStyleDeclaration</span> qui, si vous avez bien suivi, possède la méthode <span class="js">getPropertyValue(propriété CSS)</span> que nous avons déjà vu. C’est de cette manière que l’on peut récupérer les véritables valeurs calculées (après avoir appliqué les styles) par le moteur de rendu SVG.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="getComputedStyle.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Accéder aux véritables valeurs du style calculées</title>

<script xlink:href="getComputedStyle.js"/>

<rect id="rect" x="100" y="100" width="200" height="100"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	stroke-dasharray:20, 8, 40, 8;
	stroke-linecap:round;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('click', changeStroke, false);

function changeStroke(){
	// on récupère le rectangle
	rectangle = document.getElementById('rect');

	// on récupère le style calculé
	var véritableStyle = document.defaultView.getComputedStyle(rectangle, null);

	alert('Valeur de “fill” : ' + véritableStyle.getPropertyValue('fill'));
	alert('Valeur de “stroke” : ' + véritableStyle.getPropertyValue('stroke'));
	alert('Valeur de “stroke-width” : ' + véritableStyle.getPropertyValue('stroke-width'));
	alert('Valeur de “stroke-dasharray“ : ' + véritableStyle.getPropertyValue('stroke-dasharray'));
	alert('Valeur de “stroke-linecap” : ' + véritableStyle.getPropertyValue('stroke-linecap'));
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/getComputedStyle.svg">Accéder aux véritables valeurs du style calculées</object>
</div>

<p>En principe, nous n’aurons pas besoin des autres propriétés et méthodes. Nous pouvons donc passer à un autre module de DOM…</p>

<!-- getComputStyle, getPropertyValue, setStyle -->

<h3 id="events">Gestion des évènements</h3>

<p>… le DOM Level 2 Events. Décidemment, ça en jette !</p>

<p>Cette partie du DOM est celle qui permet de répondre directement aux actions de l’utilisateur. Ils existent une série d’évènements que l’on peut capturer afin d’agir en conséquence. Parmi ceux ci, nous allons traiter pour l’instant les suivants :</p>

<ul class="list-attributes">
<li><span class="js">click</span> qui est déclenché lors du clic sur un élément ;</li>
<li><span class="js">mousedown</span> qui est déclenché lorsqu’on appuie sur le bouton de la souris ;</li>
<li><span class="js">mouseup</span> qui est déclenché lorsqu’on relâche le bouton de la souris ;</li>
<li><span class="js">mouseover</span> qui est déclenché quand le curseur de la souris commence à survoler un élément ;</li>
<li><span class="js">mouseout</span> qui est déclenché quand le curseur de la souris sort d’un élément ;</li>
<li><span class="js">mousemove</span> qui est déclenché à chaque fois que le curseur bouge au dessus d’un élément ;</li>
<li><span class="js">SVGLoad</span> qui est déclenché sur un élément <span class="balise">svg</span> lorsque son chargement s’est fini (tout est affiché). C’est à ce moment que les animations débutent ;</li>
<li><span class="js">SVGUnload</span> qui est déclenché sur un élément <span class="balise">svg</span> lorsqu’on le quitte ;</li>
<li><span class="js">SVGAbort</span> qui est déclenché sur un élément <span class="balise">svg</span> lorsque son chargement est annulé ;</li>
<li><span class="js">SVGResize</span> qui est déclenché quand l’élément <span class="balise">svg</span> racine est redimensionné ;</li>
<li><span class="js">SVGScroll</span> qui est déclenché sur l’élément <span class="balise">svg</span> racine lors d’un déplacement sur l’axe X ou Y (scroll, translation via <span class="js">currentTranslate</span>.</li>
</ul>

<p>Tous ces évènements sont disponible dans des documents XHTML à la seule différence des évènements commençant par SVG. <span class="js">SVGLoad</span> devient <span class="js">load</span> et aisni de suite.</p>

<p>Il existe d’autres évènements spécifiques à SVG que nous verrons dans le prochain chapitre.</p>

<p>Pour enregistrer un évènement sur un élément <span class="js">elt</span>, on utilise la méthode <span class="js">elt.addEventListener(nom de l’évènement, function à éxecuter, booléen phase)</span>. Le nom de l’évènement correspond à un des évènement ci-dessus. À chaque fois que l’évènement est déclenché (par exemple à chaque clic), la fonction à éxécuter est éxécutée. Nous laisserons le dernier paramêtre à <span class="js">false</span> pour le moment.</p>

<p>Dans l’exemple suivant, on change la couleur de remplissage lorsque le pointeur survol ou finit de survoler le rectangle. C’est la propriété CSS <span class="css">pointer-events</span> qui détermine sous quelle condition l’évènement est déclenché (voir le second chapitre sur les animations).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="event.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gestion des évènements avec le DOM Events</title>

<script xlink:href="event.js"/>

<rect id="rect" x="100" y="100" width="200" height="100"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	stroke-dasharray:20, 8, 40, 8;
	stroke-linecap:round;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', listeners, false);

function listeners()
{
	rect = document.getElementById('rect');

	// ajout de deux évènements sur le carré
	rect.addEventListener('mouseover', setBlueFill, false);
	rect.addEventListener('mouseout', setGreenFill, false);
}

function setBlueFill(){
	rect = document.getElementById('rect');
	rect.style.setProperty('fill', 'cadetblue', null);
}

function setGreenFill(){
	rect = document.getElementById('rect');
	rect.style.setProperty('fill', 'greenyellow', null);
}]]></div>



<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/event.svg">Gestion des évènements avec le DOM Events</object>
</div>

<p>Vous remarquez qu’on ajoute les observeurs d’évènement après que le fichier SVG soit prêt (<span class="js">SVGLoad</span>) et c’est pour une bonne raison. En effet, si on le fait avant, il y a un risque que le script soit éxécuté avant que le moteur de rendu ait créé le rectangle. Ainsi, impossible de lui ajouter un observeur (<span class="js">rect.addEventListener()</span>) puisqu’il n’existe pas encore ! En réalité, ça arrive dans quasiment tous les cas.</p>

<p>Qu’en est-il du troisième paramêtre ? Pour bien comprendre à quoi il sert, il faut comprendre comment les évènements cheminent à travers tout le document. En fait, l’évènement n’est pas déclenché que sur la cible (ici le rectangle). Il parcourt tout le document de la racine jusqu’à l’élément cible avant de remonter jusqu’à la racine par le même chemin. Il y a trois phases :</p>

<ul class="list-attributes">
<li>la phase de <strong>capture</strong> : l’évènement se déclenche sur la racine puis sur tous les éléments sur le chemin de la cible jusqu’à son père ;</li>
<li>la phase <strong>cible</strong> : l’évènement se déclenche sur la cible ;</li>
<li>la phase de <strong>bouillonement</strong> : l’évènement se déclenche sur le père de la cible, puis sur le père du père et ainsi de csuite jusqu’à la racine.</li>
</ul>

<p>Ainsi dans l’exemple précédent, les évènements <span class="js">mouseover</span> et <span class="js">mouseout</span> sont aussi passés par les éléments <span class="balise">svg</span> et <span class="balise">g</span>, et même deux fois : une fois en descendant et une fois en remontant ! Le parcours a été le suivant : <span class="balise">svg</span> puis <span class="balise">g</span> puis <span class="balise">rect</span> puis <span class="balise">g</span> puis enfin <span class="balise">svg</span>.</p>

<p>Pour enfoncer le clou, car c’est très important, voici le schéma de ce qui s’est passé (sans les nœuds de texte) :</p>

<object data="images/cours/dom/events.svg" style="padding-bottom:20px;margin:auto;display:block;">Le modèle DOM Level 2 Events</object>

<p>Et justement, le dernier paramêtre de <span class="js">addEventListener</span> est un booléen qui détermine si l’évènement doit être déclenché pendant la phase de capture (<span class="js">true</span>) ou pendant la phase de bouillonement (<span class="js">false</span>). Dans l’exemple suivant, on place deux observeurs, un sur le <span class="balise">g</span> et un sur le <span class="balise">rect</span>. L’observeur placé sur le <span class="balise">g</span> a son troisième paramêtre à <span class="js">false</span> et se déclenchera donc pendant la phase de bouillonnement, donc après le déclenchement sur le carré.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="bubbling.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Bouillonement avec le DOM Events</title>

<script xlink:href="bubbling.js"/>

<g id="g">
	<rect id="carré" x="160" y="110" width="80" height="80"/>
</g>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents()
{
	// ajout de l’évènement sur <g id="g"/>
	g = document.getElementById('g');
	g.addEventListener('click', gClick, false);

	// ajout de l’évènement sur le carré
	carré = document.getElementById('carré');
	carré.addEventListener('click', carréClick, false);
}

function gClick()
{
	alert('Clic sur le <g/>');
}

function carréClick()
{
	alert('Clic sur le carré');
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/bubbling.svg">Bouillonement avec le DOM Events</object>
</div>

<p>Pour bien visualiser, voici dans le schéma suivant les deux observeurs schématisés en ronds bleus :</p>

<object data="images/cours/dom/bubblingSch.svg" style="padding-bottom:20px;display:block;margin:auto;">Bouillonnement avec le DOM Level 2 Events</object>

<p>Mais on peut décider de placer l’observeur lors de la phase de descente (la phase de capture). Dans ce cas le troisème paramêtre doit être <span class="js">true</span>.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="capture.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Capture avec le DOM Events</title>

<script xlink:href="capture.js"/>

<g id="g">
	<rect id="carré" x="160" y="110" width="80" height="80"/>
</g>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}

rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents()
{
	// ajout de l’évènement sur le <g id="g"/>
	g = document.getElementById('g');
	// !!! en mode capure !!!
	g.addEventListener('click', gClick, true);

	carré = document.getElementById('carré');
	carré.addEventListener('click', carréClick, false);
}

function gClick()
{
	alert('Clic sur le <g/>');
}

function carréClick()
{
	alert('Clic sur le carré');
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/capture.svg">Capture avec le DOM Events</object>
</div>

<p>Et dans ce cas, l’évènement du <span class="balise">g</span> se déclenche bien avant celui du <span class="balise">rect</span>.</p>

<object data="images/cours/dom/captureSch.svg" style="padding-bottom:20px;display:block;margin:auto;">Capture avec le DOM Level 2 Events</object>

<p>Vous avez remarqué qu’on ne peut pas passer des paramêtres aux fonctions qu’on appelle avec les observeurs. Une propriété géniale de ceux-ci est qu’ils envoient automatiquement à la fonction qu’on appelle un paramêtre de type <span class="js">Event</span> qui contient plusieurs informations intéressantes, dont la cible de l’évènement via l’attribut <span class="js">target</span>. Ainsi, on n’a pas besoin de savoir quel élément a intercepté l’évènement, il suffit de le demander de cette façon : <span class="js">event.target</span>.</p>

<p>Pour que ça fonctionne, il faut néanmoins déclaré l’évènement comme premier paramêtre de la fonction appelée : <span class="js">function(evt){ /* code de la fonction */ }</span>.</p>

<p>Dans l’exemple suivant, on place un observeur sur chaque cercle une fois le chargement fini. Ensuite, on agrandit le rayon du cercle de 10 pixels à chaque clic en récupérent le cercle en question grâce à <span class="js">evt.target</span>.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="target.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Récupération de la cible avec le DOM</title>

<script xlink:href="target.js"/>

<g id="g1">
	<circle cx="285" cy="156" r="20"/>
	<circle cx="25" cy="276" r="20"/>
</g>

<g id="g2">
	<circle cx="123" cy="200" r="20"/>
	<circle cx="345" cy="245" r="20"/>
	<circle cx="238" cy="37" r="20"/>
	<circle cx="32" cy="87" r="20"/>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:orangered;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents(){
	circleList = document.getElementsByTagNameNS(svgNS, 'circle');
	// circleList est de type NodeList
	// parcourons le

	for(i=0;i<=circleList.length-1;i++)
	{
		// on ajoute un observeur sur chaque cercle
		circleList.item(i).addEventListener('click', augmenterRayon, false);
	}
}

function augmenterRayon(evt){
	// on récupère le cercle cible
	cible = evt.target;

	// on récupère son rayon
	rayon = cible.getAttributeNS(null, 'r');

	// on l’agrandit de 10px
	cible.setAttributeNS(null, 'r', parseInt(rayon) + 10);
	// le parseInt convertit une chaîne en entier, sinon c’est une concaténation
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/target.svg">Récupération de la cible avec le DOM</object>
</div>


<p>Petit détail : la cible <span class="js">event.target</span> d’un évènement est toujours le dernier fils de l’arbre. Ainsi, si on place l’observeur sur l’élément <span class="balise">g</span>, la cible <span class="js">target</span> sera le cercle et non le <span class="balise">g</span>. Alors qu’en réalité, on a cliqué sur le cercle <span class="balise">circle</span> mais aussi sur l’élément <span class="balise">g</span> et sur l’élément <span class="balise">svg</span>. Pour récupérer l’élément sur lequel on a placé l’observeur, on doit utiliser non pas <span class="js">target</span> mais la propriété <span class="js">currentTarget</span>.</p>

<p>Une dernière méthode qui peut être utile est <span class="js">evt.stopPropagation</span> qui s’appelle sur un évènement. Elle met simplement fin à la propagation de l’évènement lors de sa descente ou de sa remontée. Pour être plus précis, l’évènement n’ira pas plus loin que l’élément sur lequel est placé l’observeur mais les observeurs restants (car on peut en mettre plusieurs sur un élément) seront exécutés.</p>

<p>Dans l’exemple suivant, on stoppe la propagation de l’évènement sur le carré de droite lors de la descente (phase de capture, le dernier paramêtre de <span class="js">addEventListener</span> est <span class="js">true</span>). De plus, on utilise <span class="js">currentTarget</span> pour avoir l’élément sur lequel a été placé l’observeur.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="stopProp.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Arrêt de la propagation avec le DOM Events</title>

<script xlink:href="stopProp.js"/>

<g id="g1">
	<rect id="carré1" x="60" y="110" width="80" height="80"/>
</g>

<g id="g2">
	<rect id="carré2" x="260" y="110" width="80" height="80"/>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:greenyellow;
	stroke:black;
	stroke-width:5;
	}]]></div>

<div class="jscode"><![CDATA[// constantes
const svgNS = 'http://www.w3.org/2000/svg';

document.rootElement.addEventListener('SVGLoad', setupEvents, false);

function setupEvents()
{
	// ajout des observeurs sur le premier carré
	g1 = document.getElementById('g1');
	g1.addEventListener('click', click1, false);

	carré1 = document.getElementById('carré1');
	carré1.addEventListener('click', click1, false);

	// ajout des observeurs sur le second carré
	g2 = document.getElementById('g2');
	g2.addEventListener('click', click2, true);

	carré2 = document.getElementById('carré2');
	carré2.addEventListener('click', click2, false);
}

function click1(evt)
{
	alert('Clic sur ' + evt.currentTarget.getAttributeNS(null, 'id'));
}

function click2(evt)
{
	alert('Clic sur ' + evt.currentTarget.getAttributeNS(null, 'id'));

	// arrêt de la propagation de l’évènement
	evt.stopPropagation();
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/stopProp.svg">Arrêt de la propagation avec le DOM Events</object>
</div>

<p>Voici le schéma de ce qui se passe pour le carré de droite. En rouge, l’endroit où la propagation de l’évènement est stoppé.</p>

<object data="images/cours/dom/stopPropSch.svg" style="padding-bottom:20px;display:block;margin:auto;">Capture avec le DOM Level 2 Events</object>

<p>Enfin, la dernière méthode dont vous aurez besoin permet de retirer un observeur et s’écrit : <span class="js">elt.removeEventListener()</span>, s’effectue au même endroit que l’observeur qu’on veut retirer et prend exactement les mêmes paramêtres.</p>

<p>En effet, on peut mettre une multitude d’observeur sur un élément. Il suffit de changer un seul paramêtre. Par exemple, on peut changer la fonction a appeler pour éxécuter différentes fonctions lors du clic, ou encore changer le dernier paramêtre et avoir ainsi deux appels différents : un lors de la phase de capture (à la descente) et un lors de la phase de bouillonement (à la remontée).</p>

<p>Tout ce qui a été dit ici est valable pour XHTML, à quelques détails près. Notamment pour le nom de évènements (<span class="js">SVGLoad</span> devient <span class="js">load</span>, etc.).</p>

<p>La partie traitant du DOM classique est terminée mais SVG étend ce DOM avec des propriétés et des méthodes spécifiques à ce langage : il s’agit du DOM SVG.</p>

<!-- addEventListener, removeEventListener, stopPropagation, target -->


<div class="previouspage"><a href="xslt-pour-svg.php" title="cours précédent">XSLT pour SVG</a></div>
<div class="nextpage"><a href="svgdom.php" title="cours suivant">Le DOM SVG</a></div>

<!-- fin -->

<!--
<span class="attribute"></span>
<span class="balise"></span>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href=".css" charset="utf-8"?>

]]></div>

<div class="csscode"><![CDATA[]]></div>

<div class="jscode"><![CDATA[]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/"></object>
</div>
-->
</div>

<ol id="menu">
<?php
require('inc/menu.inc');
?>
</ol>

<div id="footer">
<?php
require('inc/footer.inc');
?>
</div>

</body>
</html>
