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
<h2>Les dégradés de couleur</h2>

<p>Les dégradés, comme les motifs, servent à remplir une forme ou son liseré. On l’utilisera donc comme avec les motifs. Il existe deux sortes de dégradés : les dégradés linéaires et les dégradés radiaux.</p>

<ul class="sommaire">
<li><a href="#stop">Les arrêts de dégradé</a></li>
<li><a href="#lindeg">Les dégradés linéaires</a></li>
<li><a href="#raddeg">Les dégradés radiaux</a></li>
<li><a href="#transf">Transformation d’un dégradé</a></li>
</ul>

<h3 id="stop">Les arrêts de dégradé</h3>

<p>Mais avant tout, que ce soit pour les dégradés linéaires ou radiaux, il faut indiquer les couleurs que l’on veut utiliser. Un seul élément est nécessaire : <span class="balise">stop</span>.</p>

<p>Comme un dégradé demande un minimum de deux couleurs, on utilisera plusieurs <span class="balise">stop</span>, qui porteront tous l’attribut <span class="attribute">offset</span>. Celui-ci indiquera en pourcentage sa distance (et donc la distance de la couleur stop) entre le point de départ du dégradé et sa fin (nous verrons ça plus tard). Dans l’exemple suivant, le dégradé passera par une couleur centrale :</p>

<div class="xmlcode"><![CDATA[<stop offset="0%" id="deg1stop1"/>
<stop offset="50%" id="deg1stop2"/>
<stop offset="100%" id="deg1stop3"/>]]></div>

<p>Ne vous amusez pas à passer de 50% à 20%, votre dessin SVG aura des comportements bizarres. ;)</p>

<p>Vous avez remarqué que j’ai pris le soin de rajouter des <span class="attribute">id</span> aux <span class="balise">stop</span> : ceux ci vont nous servir pour utiliser les deux propriétés CSS qui permettent de contrôler la couleur : <span class="csspropertie">stop-color</span> et <span class="csspropertie">stop-opacity</span>. Vous avez tout de suite compris le mode d’utilisation : on spécifie dans <span class="csspropertie">stop-color</span> la couleur du <span class="balise">stop</span> correspondant, et dans <span class="csspropertie">stop-opacity</span> son opacité, valeur allant de 0 à 1 (inclus, 1 étant la valeur par défaut). En reprennant notre exemple, on peut écrire :</p>

<div class="xmlcode"><![CDATA[<stop offset="0%" id="deg1stop1"/>
<stop offset="50%" id="deg1stop2"/>
<stop offset="100%" id="deg1stop3"/>]]></div>

<div class="csscode">#deg1stop1{
	stop-color:darkred;
	stop-opacity:0.3;
}

#deg1stop2{
	stop-color:marron;
	stop-opacity:0.7;
}

#deg1stop3{
	stop-color:pink;
}</div>

<p>C’est simple, mais un peu lourd. On peut dans ce cas utiliser l’attribut <span class="attribute">style</span>.</p>

<h3 id="lindeg">Les dégradés linéaires</h3>

<p>On déclare un dégradé linéaire grâce à l’élément <span class="balise">linearGradient</span>, dans lequel on inclu des <span class="balise">stop</span>.</p>

<p>Comme tous les objets réutilisables, <span class="balise">linearGradient</span> doit évidemment se trouver dans <span class="balise">defs</span>.</p>

<p>Ensuite, on doit spécifier la direction, grâce à 4 attributs : <span class="attribute">x1</span>, <span class="attribute">y1</span>, <span class="attribute">x2</span> et <span class="attribute">y2</span>. La direction du dégradé sera celle du vecteur partant de <span class="attribute">x1</span>,<span class="attribute">y1</span> et allant à <span class="attribute">x2</span>,<span class="attribute">y2</span>. Mais comme pour les motifs, le système de coordonnées peut être choisi !</p>

<h4>Avec <span class="attribute">gradientUnits</span> à <span class="attribute">objectBoundingBox</span></h4>

<p>Cette valeur est la valeur par défaut. On se trouve alors non pas dans le système de coordonnées du <span class="balise">svg</span> parent mais dans la plus petite boîte rectangle qui englobe la forme sur laquelle vous appliquez le dégradé. Les valeurs prises par les attributs listés ci-dessus sont donc à écrire en pourcentage.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="linearGradient.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un dégradé linéaire dans un rectangle et dans une ellipse</title>

<defs>
	<linearGradient id="degrade" x1="0" y1="0" x2="100%" y2="100%">
		<stop offset="0%" id="stop1"/>
		<stop offset="40%" id="stop2"/>
		<stop offset="100%" id="stop3"/>
	</linearGradient>
</defs>

<rect x="50" y="50" width="200" height="120"/>

<ellipse cx="200" cy="220" rx="120" ry="70"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect, ellipse{
	fill:url(linearGradient.svg#degrade);
	stroke:black;
	stroke-width:5px;
}

#stop1{
	stop-color:chartreuse;
	stop-opacity:0.2;
}

#stop2{
	stop-color:cornflowerblue;
	stop-opacity:1;
}

#stop3{
	stop-color:chartreuse;
	stop-opacity:0.7;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/linearGradient.svg">Un dégradé linéaire dans un rectangle et dans une ellipse</object>
</div>

<h4>Avec <span class="attribute">gradientUnits</span> à <span class="attribute">userSpaceOnUse</span></h4>

<p>Dans ce cas, le système de coordonnées utilisé est le système de coordonnée courant, c’est à le <span class="balise">svg</span> parent. Cela concerne les attributs <span class="attribute">x1</span>, <span class="attribute">y1</span>, <span class="attribute">x2</span> et <span class="attribute">y2</span>. Faisons traverser notre vecteur du haut droit au bas gauche, en dessinant ça et là différentes formes :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="linearGradient2.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un autre dégradé linéaire</title>

<defs>
	<linearGradient id="degrade" gradientUnits="userSpaceOnUse" x1="400" y1="0" x2="0" y2="300">
		<stop offset="0%" id="stop1"/>
		<stop offset="100%" id="stop2"/>
	</linearGradient>
</defs>

<circle cx="50" cy="40" r="35"/>

<ellipse cx="165" cy="40" rx="70" ry="35"/>

<rect x="250" y="10" width="120" height="270"/>

<path d="M 20,290 L 240,100 L 20,100 L 60,150 Z"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect, circle, path, ellipse{
	fill:url(linearGradient2.svg#degrade);
	stroke:black;
	stroke-width:5px;
}

#stop1{
	stop-color:plum;
}

#stop2{
	stop-color:powderblue;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/linearGradient2.svg">Un autre dégradé linéaire</object>
</div>

<h3 id="raddeg">Les dégradés radiaux</h3>


<p>Il existe un second type de dégradé : le dégradé radial qui ne suit pas un vecteur mais un cercle (ou plutôt une ellipse).</p>

<p>On utilise alors l’élément <span class="balise">radialGradient</span> qui prend comme enfants, et comme pour <span class="balise">linearGradient</span>, plusieurs éléments <span class="balise">stop</span>.</p>

<p>Il faut en plus de cela indiquer le centre (attributs <span class="attribute">cx</span> et <span class="attribute">cy</span>), ainsi que le rayon (attribut <span class="attribute">r</span>).</p>

<p>Et comme pour les dégradés linéaires, ces valeurs peuvent être spécifié de deux manières…</p>

<h4>Avec <span class="attribute">gradientUnits</span> à <span class="attribute">objectBoundingBox</span></h4>

<p>Dans ce cas et comme pour les dégradés linéaires, on se place dans la plus petite boîte rectangle qui contient la forme sur laquelle on déisre appliquer le dégradé. Les valeurs des attributs <span class="attribute">cx</span>, <span class="attribute">cy</span> et <span class="attribute">r</span> sont par défaut de 50%, ce qui nous place au milieu de la boîte, avec un rayon touchant le bord. Les valeurs sont donc exprimées en pourcentages. Bien entendu si cette boîte englobante n’est pas un carré, le dégradé est tracé selon une ellipse et non plus selon un cercle.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="radialGradient.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400px" height="300px" xml:lang="fr" xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un dégradé radial</title>

<defs>
	<radialGradient id="degradeValeursParDefaut" gradientUnits="objectBoundingBox">
		<stop offset="0%" id="stop1"/>
		<stop offset="50%" id="stop2"/>
		<stop offset="100%" id="stop3"/>
	</radialGradient>

	<!-- les couleurs stop utilisées sont les mêmes pour les deux dégradés -->

	<radialGradient id="degradeAutresValeurs" cx="70%" cy="35%" r="70%" gradientUnits="objectBoundingBox">
		<stop offset="0%" id="stop1"/>
		<stop offset="50%" id="stop2"/>
		<stop offset="100%" id="stop3"/>
	</radialGradient>
</defs>

<!-- degradé 1 -->

<rect class="deg1" x="35" y="10" width="130" height="130"/>

<ellipse class="deg1" cx="100" cy="225" rx="90" ry="50"/>

<!-- dégradé 2 -->

<rect class="deg2" x="235" y="10" width="130" height="130"/>

<ellipse class="deg2" cx="300" cy="225" rx="90" ry="50"/>

</svg>]]></div>

<div class="csscode"><![CDATA[.deg1{
	fill:url(radialGradient.svg#degradeValeursParDefaut);
}

.deg2{
	fill:url(radialGradient.svg#degradeAutresValeurs);
}

.deg1, .deg2{
	stroke:black;
	stroke-width:4px;
}

#stop1{
	stop-color:lightslategray;
}

#stop2{
	stop-color:lightsteelblue;
}

#stop3{
	stop-color:lightyellow;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/radialGradient.svg">Un dégradé radial</object>
</div>

<p>C’est le dégradé radial le plus couramment utilisé.</p>

<h4>Avec <span class="attribute">gradientUnits</span> à <span class="attribute">userSpaceOnUse</span></h4>

<p>Et encore une fois, comme pour les dégradés linéaires, l’utilisation de l’attribut <span class="attribute">gradientUnits</span> fixé à <span class="attribute">userSpaceOnUse</span> provoquera l’utilisation du système de coordonnées courant (le <span class="balise">svg</span> parent le plus proche) comme système de coordonnées. Et donc on n’utilise plus forcément les pourcentages, mais une unité permise dans ce système de coorodnnées. Et comme le plus souvent, ce sont des pixels, on utilise généralement cette unité.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="radialGradient2.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un autre dégradé radial</title>

<defs>
	<radialGradient id="degrade" gradientUnits="userSpaceOnUse" cx="200" cy="150" r="150">
		<stop offset="0%" id="stop1"/>
		<stop offset="100%" id="stop2"/>
	</radialGradient>
</defs>

<rect x="20" y="20" width="160" height="110"/>
<rect x="220" y="20" width="160" height="110"/>
<rect x="20" y="170" width="160" height="110"/>
<rect x="220" y="170" width="160" height="110"/>

<rect x="160" y="110" width="80" height="80"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:url(radialGradient2.svg#degrade);
	stroke:black;
	stroke-width:2px;
}

#stop1{
	stop-color:greenyellow;
}

#stop2{
	stop-color:ivory;
}
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/radialGradient2.svg">Un autre dégradé radial</object>
</div>

<h4>Une histoire de foyer</h4>

<p>Pour les dégradés linéaires, il est facile de savoir à quoi correspondent les pourcentages des <span class="attribute">offset</span> : 0% correspond au début du vecteur (de coordonnées <span class="attribute">x1</span>,<span class="attribute">y1</span>) et 100% à la fin (<span class="attribute">x2</span>,<span class="attribute">y2</span>). Pour les dégradés radiaux, jusque là, c’était aussi simple : 0% correspondait au centre défini par les attributs <span class="attribute">cx</span> et <span class="attribute">cy</span>, tandis que 100% était atteint à la limite du cercle de rayon <span class="attribute">r</span>. Mais les choses vont se compliquer, grâce, ou à cause, des foyers !</p>

<p>Le foyer va nous servir pour spécifier un autre point de départ pour le dégradé, donc la couleur à <span class="attribute">offset="0%"</span>. Les coordonnées du cercle ne serviront plus qu’à déterminer sa taille et donc la limite <span class="attribute">offset="110%"</span> (grâce au rayon).</p>

<p>Pour spécifier le foyer, on utilise les attributs <span class="attribute">fx</span> et <span class="attribute">fy</span> sur <span class="balise">radialGradient</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="foyer.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400" height="300" xml:lang="fr" xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un dégradé radial avec un foyer différent de son centre</title>

<defs>
	<radialGradient id="degrade" cx="50%" cy="50%" r="50%" fx="20%" fy="30%">
		<stop offset="0%" id="stop1"/>
		<stop offset="100%" id="stop2"/>
	</radialGradient>
</defs>

<circle cx="200" cy="150" r="145"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:url(foyer.svg#degrade);
	stroke:black;
	stroke-width:3px;
}

#stop1{
	stop-color:blueviolet;
}

#stop2{
	stop-color:cornsilk;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/foyer.svg">Un dégradé radial avec un foyer différent de son centre</object>
</div>

<p>On peut même animer ces attributs :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="foyerAnimation.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un dégradé radial avec un foyer différent de son centre</title>

<defs>
	<radialGradient id="degrade" cx="50%" cy="50%" r="50%" fx="20%" fy="50%">
		<animate attributeName="fx" attributeType="XML" values="10%;30%;50%;70%;90%;70%;50%;30%;10%" begin="0s" dur="10s" repeatCount="indefinite"/>
		<animate attributeName="fy" attributeType="XML" values="50%;30%;10%;30%;50%;70%;90%;70%;50%" begin="0s" dur="10s" repeatCount="indefinite"/>

		<stop offset="0%" id="stop1"/>
		<stop offset="100%" id="stop2"/>
	</radialGradient>
</defs>

<circle cx="200" cy="150" r="145"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:url(foyerAnimation.svg#degrade);
	stroke:black;
	stroke-width:3px;
}

#stop1{
	stop-color:blueviolet;
}

#stop2{
	stop-color:cornsilk;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/foyerAnimation.svg">Un dégradé radial avec un foyer différent de son centre, et animé</object>
</div>

<h4>Et une autre de remplissage !</h4>

<p>On a vu à quoi correspondent les valeurs des offset, que ce soit pour les dégradés radiaux ou pour les dégradés linéaires.</p>

<p>Seulement, avec l’esprit un peu tordu, on pourrait se demander ce qui se passe lorsque les valeurs du vecteur pour les dégradés linéaires et du cercle pour les dégradés radiaux ne prennent pas l’intégralité de la boîte.</p>

<p>Pour contrôler ce comportement, on utilise l’attribut <span class="attribute">spreadMethod</span>, ce qui traduit donne : « méthode d’étalage » !</p>

<p>La première valeur possible (il y en a trois) est <span class="attribute">pad</span>. C’est la valeur par défaut, et elle a la propriété de dessiner uniformément de la même couleur avant le dégradé (en prenant la couleur du premier <span class="balise">stop</span>), idem après le dégradé (mais en prenant cette fois-ci la couleur du dernier <span class="balise">stop</span>). Le comportement est bien sûr le même pour les deux types de dégradés.</p>

<p>La seconde valeur est <span class="attribute">repeat</span> et n’est pas très esthétique. Elle a pour effet de répéter le dégradé, simplement.</p>

<p>La troisième et dernière valeur, plus intéressante, est <span class="attribute">reflect</span> : le dégradé est réfléchi, c’est à dire qu’une fois arrivé à la fin, il repart vers le début, puis repart vers la fin, etc etc jusqu’à ce que la limite du dégradé soit atteinte.</p>

<div class="xmlcode">&lt;?xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?&gt;
&lt;<![CDATA[?xml-stylesheet type="text/css" href="spreadMethod.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’attribut spreadMethod et son effet sur les dégradés</title>

<defs>
	<!-- pad -->
	<linearGradient x1="25%" y1="0" x2="75%" y2="0" spreadMethod="pad" id="linearPad">
		<stop offset="0%" class="stop1"/>
		<stop offset="50%" class="stop2"/>
		<stop offset="100%" class="stop3"/>
	</linearGradient>

	<radialGradient r="25%" spreadMethod="pad" id="radialPad">
		<stop offset="0%" class="stop1"/>
		<stop offset="50%" class="stop2"/>
		<stop offset="100%" class="stop3"/>
	</radialGradient>

	<!-- repeat -->
	<linearGradient x1="25%" y1="0" x2="75%" y2="0" spreadMethod="repeat" id="linearRepeat">
		<stop offset="0%" class="stop1"/>
		<stop offset="50%" class="stop2"/>
		<stop offset="100%" class="stop3"/>
	</linearGradient>

	<radialGradient r="25%" spreadMethod="repeat" id="radialRepeat">
		<stop offset="0%" class="stop1"/>
		<stop offset="50%" class="stop2"/>
		<stop offset="100%" class="stop3"/>
	</radialGradient>

	<!-- reflect -->
	<linearGradient x1="25%" y1="0" x2="75%" y2="0" spreadMethod="reflect" id="linearReflect">
		<stop offset="0%" class="stop1"/>
		<stop offset="50%" class="stop2"/>
		<stop offset="100%" class="stop3"/>
	</linearGradient>

	<radialGradient r="25%" spreadMethod="reflect" id="radialReflect">
		<stop offset="0%" class="stop1"/>
		<stop offset="50%" class="stop2"/>
		<stop offset="100%" class="stop3"/>
	</radialGradient>
</defs>

<!-- pad -->
<text x="65" y="40">pad</text>
<rect x="10" y="60" width="120" height="80" id="rectPad"/>
<circle cx="65" cy="225" r="60" id="circlePad"/>

<!-- repeat -->
<text x="200" y="40">repeat</text>
<rect x="140" y="60" width="120" height="80" id="rectRepeat"/>
<circle cx="200" cy="225" r="60" id="circleRepeat"/>

<!-- reflect -->
<text x="335" y="40">reflect</text>
<rect x="270" y="60" width="120" height="80" id="rectReflect"/>
<circle cx="335" cy="225" r="60" id="circleReflect"/>


</svg>]]></div>

<div class="csscode"><![CDATA[rect, circle{
	stroke:black;
	stroke-width:3px;
}

text{
	font-size:26px;
	text-anchor:middle;
}

/* stop colors */

.stop1{
	stop-color:crimson;
}

.stop2{
	stop-color:white;
}

.stop3{
	stop-color:cornflowerblue;
}

/* dégradés */

#rectPad{
	fill:url(spreadMethod.svg#linearPad);
}

#circlePad{
	fill:url(spreadMethod.svg#radialPad);
}

#rectRepeat{
	fill:url(spreadMethod.svg#linearRepeat);
}

#circleRepeat{
	fill:url(spreadMethod.svg#radialRepeat);
}

#rectReflect{
	fill:url(spreadMethod.svg#linearReflect);
}

#circleReflect{
	fill:url(spreadMethod.svg#radialReflect);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/spreadMethod.svg">L’attribut spreadMethod et son effet sur les dégradés</object>
</div>

<p>Oui, ça commence à devenir long !</p>

<h3 id="transf">Transformation d’un dégradé</h3>

<p>Comme pour les motifs, on peut effectuer une ou plusieurs transformations sur un dégradé (linéaire ou radial) grâce à l’attribut <span class="attribute">gradientTransform</span>. Essayons d’incliner un dégradé horizontal, cette fois-ci en utilisant <span class="csspropertie">stroke</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="gradientTransform.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Transformation de dégradé</title>

<defs>
	<linearGradient id="degrade" gradientTransform="rotate(45)">
		<stop offset="0%" id="stop1"/>
		<stop offset="100%" id="stop2"/>
	</linearGradient>
</defs>

<text x="200" y="150"><tspan>SVG</tspan></text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:110px;
	font-weight:bold;
	text-anchor:middle;
	fill:none;
	stroke:url(gradientTransform.svg#degrade);
	stroke-width:5px;
}

tspan{
	baseline-shift:-0.5ex;
	}

#stop1{
	stop-color:forestgreen;
}

#stop2{
	stop-color:gainsboro;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/degrades/gradientTransform.svg">Transformation de dégradé</object>
</div>

<p>Ce passinant chapître est enfin terminé, et vu le temps qu’il faut pour écrire un tel cours je m’offre de petites vacances à partir de maintenant !</p>

<p>Le prochain chapitre traite du clipping et du masquage, qui consiste en… hmmm… bon rendez-vous au prochain chapitre. ^^</p>

<div class="previouspage"><a href="motifs.php" title="cours précédent">Les motifs</a></div>
<div class="nextpage"><a href="clip-et-mask.php" title="cours suivant">Clip/Mask</a></div>

<!-- fin -->

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
