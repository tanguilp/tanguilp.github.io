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
<h2>Les filtres</h2>

<p>Malgré toutes ses qualités, le dessin vectoriel semble souvent trop géométrique, trop mathématique. Les filtres, qui viennent du monde bitmap, peuvent aider à résoudre ce problème.</p>

<ul class="sommaire">
<li><a href="#gen">Fonctionnement général des filtres</a></li>
<li><a href="#base">Les primitives de base</a></li>
<li><a href="#gauss">Le flou gaussien</a></li>
<li><a href="#morph">Morphologie</a></li>
<li><a href="#conv">Matrices de convolution</a></li>
<li><a href="#matcouleur">Matrice de couleur</a></li>
<li><a href="#transf">Transfert de composante</a></li>
<li><a href="#turbulence">Turbulences</a></li>
<li><a href="#mélange">Mélange</a></li>
<li><a href="#comp">Composition</a></li>
<li><a href="#éclairage">Effets d’éclairage</a></li>
<li><a href="#deplace">feDisplacementMap</a></li>
<li><a href="#example">Exemple de filtre évolué</a></li>
</ul>

<h3 id="gen">Fonctionnement général des filtres</h3>

<p>Les filtres s’utilisent comme les masques, les motifs ou encore les dégradés. On commence par les définir au début du document puis on les utilise sur autant de tracés qu’on veut.</p>

<p>Les filtres sont définis grâce à l’élément <span class="balise">filter</span> qu’on placera par convention dans les définitions (<span class="balise">defs</span>). On n’oublie pas de lui attribuer un identifiant grâce auquel on l’appellera. Les fils de <span class="balise">filter</span> seront les différentes primitives du filtres, c’est à dire les différentes opérations réalisées sur l’image de départ qui aboutiront à une image modifiée.</p>

<p>Enfin, on appelle le filtre grâce à la propriété CSS <span class="csspropertie">filter</span> qui prend en parmêtre le chemin vers le filtre, qui peut être dans un autre fichier. Voici le squelette de l’utilisation de filtres :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="squel.css" charset="utf-8"?>

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les filtres</title>

<defs>

<filter id="filtre1">
	<!-- primitives -->
</filtre>

</defs>



<path id="path1" d="…"/>

</svg>

]]></div>

<div class="csscode"><![CDATA[path#path1{
	filter:url(squel.svg#filtre1);
	}]]></div>


<h3 id="base">Les primitives de base</h3>

<p>Avant de rentrer dans le vif du sujet, il est important de connaître plusieurs primitives de base qui ont des fonctions basiques mais qui sont néanmoins indispensables dans quasiment tous les filtres. Nous en profiterons pour appréhender la manière dont les différentes primitives sont chaînées.</p>

<h4>La primitive <span class="balise">feFlood</span></h4>

<p>La primitive <span class="balise">feFlood</span> permet de remplir uniformément une région d’une couleur… La couleur et son opacité sont indiquées grâce aux propriétés CSS <span class="csspropertie">flood-color</span> et <span class="csspropertie">flood-opacity</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feFlood.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feFlood</title>

<defs>
	<filter id="remplissage">
		<feFlood/>
	</filter>
</defs>

<circle cx="100" cy="150" r="50"/>
<circle id="filtre" cx="300" cy="150" r="50"/>

</svg>

]]></div>

<div class="csscode"><![CDATA[feFlood{
	flood-color:lightcoral;
	flood-opacity:0.7;
	}

circle{
	fill:none;
	stroke:black;
	stroke-width:7px;
	}

circle#filtre{
	filter:url(feFlood.svg#remplissage);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feFlood.svg">La primitive feFlood</object>
</div>

<p>Jusque là, rien de transcendant je vous l’accorde. En plus, l’image source (le cercle de droite) n’apparaît même pas.</p>

<h4>La primitive <span class="balise">feImage</span></h4>

<p>La primitive <span class="balise">feImage</span> permet d’importer une image dans un filtre. En effet, l’image d’entré par défaut est la région sur laquelle on applique le filtre. Dans l’exemple précédent, l’image d’entrée, où image source, est le cercle de droite (qui n’apparaît pas au final). <span class="balise">feImage</span> permet d’appeler une autre image, quelquesoit son format (JPG, PNG ou SVG). En effet, nous verrons plus loin qu’on peut combiner différentes images.</p>

<p>Cette primitive se comporte exactement comme l’élément <span class="balise">image</span> que nous avons déjà vu, et on peut donc utiliser les attributs <span class="attribute">x</span>, <span class="attribute">y</span>, <span class="attribute">width</span>, <span class="attribute">height</span>, <span class="attribute">preserveAspectRatio</span> et bien entendu <span class="attribute">xlink:href</span>. Reprenons l’exemple précédent :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feImage.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feImage</title>

<defs>
	<filter id="hermine">
		<feImage xlink:href="hermine.png" width="50px" height="50px"/>
	</filter>
</defs>

<circle cx="100" cy="150" r="50"/>
<circle id="filtre" cx="300" cy="150" r="50"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[feFlood{
	flood-color:lightcoral;
	flood-opacity:0.7;
	}

circle{
	fill:none;
	stroke:black;
	stroke-width:7px;
	}

circle#filtre{
	filter:url(feImage.svg#hermine);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feImage.svg">La primitive feImage</object>
</div>


<h4>La primitive <span class="balise">feTile</span></h4>

<p>Grâce à la primitive <span class="balise">feImage</span> et à <span class="balise">feTile</span>, on va pouvoir créer des motifs très facilement. En effet, <span class="balise">feTile</span> se contente de répéter horizontalement et verticalement l’image qu’elle a en entrée.</p>

<p>La plupart des primitives ont une entrée et une sortie. Jusqu’ici, nous n’avons pas nommé ces entrées et ces sorties ce qui fait que c’est le comportement par défaut qui s’est appliqué. Mais il est possible de préciser pour chaque primitive l’image d’entrée (grâce à l’attribut <span class="attribute">in</span>) et le résultat de sortie (grâce à <span class="attribute">result</span>) de telle sorte qu’on puisse l’appeler par la suite.</p>

<p>Si l’attribut <span class="attribute">in</span> n’est pas précisé, alors c’est le résultat de la primitive précédente qui est utilisé. C’est un peu particulier pour la première primitive. En effet, à tout moment, on peut appeler des valeurs spéciales pour l’attribut <span class="attribute">in</span> : <span class="attribute">SourceGraphic</span>, <span class="attribute">SourceAlpha</span>, <span class="attribute">BackgroundImage</span>, <span class="attribute">BackgroundAlpha</span>, <span class="attribute">FillPaint</span> ou <span class="attribute">StrokePaint</span>. Nous n’utiliserons pour le moment que les deux premières. Pour la valeur <span class="attribute">SourceGraphic</span>, on prend comme image d’entrée le dessin SVG sur lequel on appelle le filtre (c’est la valeur par défaut). Pour la valeur <span class="attribute">SourceAlpha</span>, on utilise le canal alpha seulement, c’est à dire la transparence. Retenez bien ça pour la suite.</p>

<p>Pour faire un motif, on va utiliser <span class="balise">feImage</span> comme image d’entrée de <span class="balise">feTile</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feTile.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feTile</title>

<defs>
	<filter id="motif">
		<feImage xlink:href="hermine.png" result="hermine"
			width="30px" height="30px"/>
		<feTile in="hermine"/>
	</filter>
</defs>

<circle cx="100" cy="150" r="50"/>
<circle id="filtre" cx="300" cy="150" r="50"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[circle{
	fill:none;
	stroke:black;
	stroke-width:7px;
	}

circle#filtre{
	filter:url(feTile.svg#motif);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feTile.svg">La primitive feTile</object>
</div>


<h4>La primitive <span class="balise">feOffset</span></h4>

<p>La primitive <span class="balise">feOffset</span> décale tout simplement l’image d’entrée selon les attributs <span class="attribute">dx</span> et <span class="attribute">dy</span>. Cette primitive est très utile pour les effets d’ombrage, que nous verrons plus loin.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feOffset.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feOffset</title>

<defs>
	<filter id="décalage">
		<feOffset dx="15" dy="15"/>
	</filter>
</defs>

<circle cx="100" cy="150" r="50"/>
<circle id="filtre" cx="300" cy="150" r="50"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:none;
	stroke:black;
	stroke-width:7px;
	}

circle#filtre{
	filter:url(feOffset.svg#décalage);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feOffset.svg">La primitive feOffset</object>
</div>

<p>On remarque que le bord en bas à droite est tronqué. C’est du au fonctionnement intrisèque des filtres et il est possible d’y remédier. Nous verrons plus tard comment. Avec Firefox, les autres bords sont tronqués ce qui n’est pas le comportement normal.</p>


<h4>La primitive <span class="balise">feMerge</span></h4>

<p>La dernière primitive de base, <span class="balise">feMerge</span> sert à empiler les résultats de différents filtres. On l’utilise la plupart du temps comme dernière primitive d’un filtre pour assembler les différents résultats précédents. On voit donc l’intérêt de pouvoir nommer les résultats de chaque primitive.</p>

<p><span class="balise">feMerge</span> contient plusieurs <span class="balise">feMergeNode</span> dont l’attribut <span class="attribute">in</span> indique l’image à prendre en entrée.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feMerge.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feMerge</title>

<defs>
	<filter id="composition">
		<feFlood result="remplissage"/>

		<feImage xlink:href="hermine.png" width="20px" height="20px" result="hermine"/>
		<feTile in="hermine" result="pavage"/>

		<feOffset in="SourceGraphic" dx="5" dy="7" result="cercle"/>

		<feMerge>
			<feMergeNode in="pavage"/>
			<feMergeNode in="remplissage"/>
			<feMergeNode in="cercle"/>
			<feMergeNode in="SourceGraphic"/>
		</feMerge>
	</filter>
</defs>

<circle cx="100" cy="150" r="50"/>
<circle id="filtre" cx="300" cy="150" r="50"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[circle{
	fill:none;
	stroke:black;
	stroke-width:2px;
	}

circle#filtre{
	filter:url(feMerge.svg#composition);
	}

feFlood{
	flood-color:darkorange;
	flood-opacity:0.8;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feMerge.svg">La primitive feMerge</object>
</div>

<p>Notons que l’ordre dans lequel on appelle les différents résultats est très important puisque <span class="balise">feMerge</span> empile les différents résultats. Dans cet exemple, on a d’abord le pavage sur lequel on empile le résultat de <span class="balise">feFlood</span> (avec une opacité différente de 1 pour que ce qu’il y a derrière soit visible). On empile ensuite le cercle décalé par <span class="balise">feOffset</span> puis enfin le graphique d’origine, grâce au mot-clé <span class="balise">SourceGraphic</span>.</p>

<p>Maintenant que nous avons vu les primitives de base, passons aux primitives un peu plus complexes mais bien plus puissantes.</p>

<h3 id="gauss">Le flou gaussien</h3>

<p>La première primitive intéressante que nous allons voir est <span class="balise">feGaussianBlur</span>. Elle permet d’obtenir une image plus ou moins floue. Elle est très simple d’utilisation puisqu’elle n’utilise qu’un seul attribut : <span class="attribute">stdDeviation</span>. <span class="attribute">stdDeviation</span> prend en paramêtre la déviation standard qui est un réel positif. Plus ce nombre est grand, plus l’effet de flou est important. Il est possible d’indiquer deux valeurs séparées pour le flou horizontal et le flou vertical. Dans ce cas on écrira deux valeurs dans l’attribut <span class="attribute">stdDeviation</span> : la première concerne l’axe x et la seconde l’axe y.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feGaussianBlur.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feGaussianBlur</title>

<defs>
	<filter id="flou1">
		<feGaussianBlur stdDeviation="1"/>
	</filter>

	<filter id="flou2">
		<feGaussianBlur stdDeviation="2"/>
	</filter>

	<filter id="flou3">
		<feGaussianBlur stdDeviation="3 0.1"/>
	</filter>

	<g id="bouton" transform="translate(-80, -30)">
		<rect width="160" height="60" rx="12" ry="12"/>
		<text x="80" y="40">Push me</text>
	</g>
</defs>

<use xlink:href="#bouton" transform="translate(100,75)"/>

<use id="b1" xlink:href="#bouton" transform="translate(300,75)"/>

<use id="b2" xlink:href="#bouton" transform="translate(100,225)"/>

<use id="b3" xlink:href="#bouton" transform="translate(300,225)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:lightskyblue;
	stroke:lime;
	stroke-width:8px;
	stroke-opacity:0.4;
	}

text{
	font-size:30px;
	text-anchor:middle;
	}

#b1{
	filter:url(feGaussianBlur.svg#flou1);
	}

#b2{
	filter:url(feGaussianBlur.svg#flou2);
	}

#b3{
	filter:url(feGaussianBlur.svg#flou3);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feGaussianBlur.svg">La primitive feGaussianBlur</object>
</div>

<p>On voit bien que sur le dernier bouton, le flou ne se fait que horizontalement, selon l’axe x.</p>

<p>Cette primitive est très intéressante pour obtenir des effets d’ombrage. La technique est simple : on crée l’ombre grâce à <span class="balise">feGaussianBlur</span>, on la décale puis on empile l’ombre puis l’image d’origine. L’astuce est d’utiliser comme source d’entrée la composante alpha (c’est à dire la transparence) avec le mot-clé <span class="attribute">SourceAlpha</span> et non l’image entière. Ainsi l’ombre est en niveaux de gris et non en couleur. Essayons les deux cas (<span class="attribute">SourceGraphic</span> et <span class="attribute">SourceAlpha</span>) sur notre bouton :</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="ombrage.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Effet d’ombrage avec feGaussianBlur</title>

<defs>
	<filter id="flou1">
		<feGaussianBlur in="SourceGraphic" stdDeviation="1.5" result="flou"/>
		<feOffset in="flou" dx="3" dy="3" result="flouDécalé"/>

		<feMerge>
			<feMergeNode in="flouDécalé"/>
			<feMergeNode in="SourceGraphic"/>
		</feMerge>
	</filter>

	<filter id="flou2">
		<feGaussianBlur in="SourceAlpha" stdDeviation="1.5" result="flou"/>
		<feOffset in="flou" dx="3" dy="3" result="flouDécalé"/>

		<feMerge>
			<feMergeNode in="flouDécalé"/>
			<feMergeNode in="SourceGraphic"/>
		</feMerge>
	</filter>

	<g id="bouton" transform="translate(-80, -30)">
		<rect width="160" height="60" rx="12" ry="12"/>
		<text x="80" y="40">Push me</text>
	</g>
</defs>

<use id="b1" xlink:href="#bouton" transform="translate(200,75)"/>

<use id="b2" xlink:href="#bouton" transform="translate(200,225)"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[rect{
	fill:lightskyblue;
	stroke:lime;
	stroke-width:5px;
	stroke-opacity:0.8;
	}

text{
	font-size:30px;
	text-anchor:middle;
	}

#b1{
	filter:url(ombrage.svg#flou1);
	}

#b2{
	filter:url(ombrage.svg#flou2);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/ombrage.svg">Effet d’ombrage avec feGaussianBlur</object>
</div>

<p>Le résultat est beaucoup plus convaincant avec <span class="attribute">SourceAlpha</span>. Vous pouvez donc écrire un filtre générique pour avoir un effet d’ombrage et ceci très simplement.</p>



<h3 id="morph">Morphologie</h3>

<p>La primitive <span class="balise">feMorphology</span> permet de modifier la morphologie de l’image d’entrée du filtre. Deux opérations sont possibles : la dilatation et la contraction des formes SVG. On le précisera grâce à l’attribut <span class="attribute">operator</span> qui peut prendre la valeur <span class="attribute">erode</span> ou <span class="attribute">dilate</span>. On peut contrôler le niveau de contraction ou de dilatation grâce à l’attribut <span class="attribute">radius</span> qui doit être une valeur positive (on peut en mettre deux valeur et dans ce cas la première concerne l’axe des x et la seconde l’axe des y).</p>

<p>Prenons par exemple cette image de départ :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feMorphology.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feMorphology - Image de départ</title>

<g id="dessin">

	<image xlink:href="Lihgthouse_Pellworm_P5232341_jm.jpg" x="0" y="130" width="400" height="165"/>

	<text x="3" y="40">Primitive feMorphology</text>

	<circle cx="60" cy="185" r="80"/>

	<path d="M 170,125 L 240,100 C 520,50 375,340 240,270"/>

	<rect x="215" y="135" width="60" height="120"/>

</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	font-size:36px;
	fill:darkred;
	}

circle{
	fill:lavender;
	fill-opacity:0.8;
	stroke:lightseagreen;
	stroke-width:8px;
	stroke-dasharray:38,10;
	stroke-linecap:round;
	}

path{
	fill:none;
	stroke:turquoise;
	stroke-width:10px;
	stroke-linecap:round;
	}

rect{
	fill:none;
	stroke:black;
	stroke-width:2px;
	stroke-dasharray:1,3;
	stroke-linecap:round;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feMorphology.svg">La primitive feMorphology - Image de départ</object>
</div>

<p>Appliquons-y maintenant un filtre de dilatation :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feMorphology-dilate.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feMorphology - Dilatation</title>

<defs>
	<filter id="dilatation">
		<feMorphology operator="dilate" radius="2.2"/>
	</filter>
</defs>

<g id="dessin">

	<image xlink:href="Lihgthouse_Pellworm_P5232341_jm.jpg" x="0" y="130" width="400" height="165"/>

	<text x="3" y="40">Primitive feMorphology</text>

	<circle cx="60" cy="185" r="80"/>

	<path d="M 170,125 L 240,100 C 520,50 375,340 240,270"/>

	<rect x="215" y="135" width="60" height="120"/>

</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[g#dessin{
	filter:url(feMorphology-dilate.svg#dilatation);
	}

text{
	font-size:36px;
	fill:darkred;
	}

circle{
	fill:lavender;
	fill-opacity:0.8;
	stroke:lightseagreen;
	stroke-width:8px;
	stroke-dasharray:38,10;
	stroke-linecap:round;
	}

path{
	fill:none;
	stroke:turquoise;
	stroke-width:10px;
	stroke-linecap:round;
	}

rect{
	fill:none;
	stroke:black;
	stroke-width:2px;
	stroke-dasharray:1,3;
	stroke-linecap:round;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feMorphology-dilate.svg">La primitive feMorphology - Dilatation</object>
</div>

<p>Essayons pour finir la contraction :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feMorphology-erode.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La primitive feMorphology - Contraction</title>

<defs>
	<filter id="contraction">
		<feMorphology operator="erode" radius="1"/>
	</filter>
</defs>

<g id="dessin">

	<image xlink:href="Lihgthouse_Pellworm_P5232341_jm.jpg" x="0" y="130" width="400" height="165"/>

	<text x="3" y="40">Primitive feMorphology</text>

	<circle cx="60" cy="185" r="80"/>

	<path d="M 170,125 L 240,100 C 520,50 375,340 240,270"/>

	<rect x="215" y="135" width="60" height="120"/>

</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[g#dessin{
	filter:url(feMorphology-erode.svg#contraction);
	}

text{
	font-size:36px;
	fill:darkred;
	}

circle{
	fill:lavender;
	fill-opacity:0.8;
	stroke:lightseagreen;
	stroke-width:8px;
	stroke-dasharray:38,10;
	stroke-linecap:round;
	}

path{
	fill:none;
	stroke:turquoise;
	stroke-width:10px;
	stroke-linecap:round;
	}

rect{
	fill:none;
	stroke:black;
	stroke-width:2px;
	stroke-dasharray:1,3;
	stroke-linecap:round;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feMorphology-erode.svg">La primitive feMorphology - Contraction</object>
</div>

<p>Dans les deux cas, l’effet sur l’image bitmap a un côté artistique intéressant. À vous de tester différentes valeurs pour voir ce qu’on peut faire avec ce filtre.</p>


<h3 id="conv">Matrices de convolution</h3>

<p>Les filtres de convolution permettent d’appliquer sur des images divers effets très utiles comme le floutage, l’embossage, la détection des contours ou le rehaussement des détails.</p>

<h4>Un peu de théorie</h4>

<p>Mais tout d’abord, comment fonctionne les filtres de convolution ? Le principe est le suivant : pour chaque pixel de l’image de départ, la nouvelle valeur du pixel est calculée en fonction de sa valeur et de celles des pixels voisins.</p>

<p>Pour le traitement d’image, on utilise des matrices. Par défaut, on utilise une matrice <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mn>3</mn>
  <mo>×</mo>
  <mn>3</mn>
</math> où le pixel que l’on traite est le pixel du centre de la matrice. Les 8 autres valeurs de la matrice correspondent aux valeurs des pixels voisins du pixel traité.</p>

<p>Imaginons que nous souhaitons traiter le pixel <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>p</mi>
    <mn>0</mn>
  </msub>
</math> d’une image que voici : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mtable>
    <mtr>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
    </mtr>
    <mtr>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>1</mn>
        </msub>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>2</mn>
        </msub>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>3</mn>
        </msub>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
    </mtr>
    <mtr>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>4</mn>
        </msub>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>0</mn>
        </msub>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>5</mn>
        </msub>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
    </mtr>
    <mtr>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>6</mn>
        </msub>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>7</mn>
        </msub>
      </mtd>
      <mtd>
        <msub>
          <mi>p</mi>
          <mn>8</mn>
        </msub>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
    </mtr>
    <mtr>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
      <mtd>
        <mo>.</mo>
      </mtd>
    </mtr>
  </mtable>
</math></p>

<p>Les points sont les pixels voisins des pixels voisin de <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>p</mi>
    <mn>0</mn>
  </msub>
</math>.</p>

<p>Voici notre matrice de convolution (qui est de taille <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mn>3</mn>
  <mo>×</mo>
  <mn>3</mn>
</math>) : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>1</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>2</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>3</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>4</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>0</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>5</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>6</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>7</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>8</mn>
          </msub>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Cette matrice est appelée noyau.</p>

<p>Pour obtenir la nouvelle valeur de <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>p</mi>
    <mn>0</mn>
  </msub>
</math>, on effectue le produit de convolution (différent du produit vectoriel) des pixels concernés dans l’image (qui dépend de la taille de la matrice de convolution mais pour le moment on ne travaille que sur des matrices <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mn>3</mn>
  <mo>×</mo>
  <mn>3</mn>
</math>) et de la matrice de convolution renversée. Ainsi on a : <math xmlns="http://www.w3.org/1998/Math/MathML" style="display:block">
  <msub>
    <mi>p</mi>
    <mn>0</mn>
  </msub>
  <mo>=</mo>
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>1</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>2</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>3</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>4</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>0</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>5</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>6</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>7</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>p</mi>
            <mn>8</mn>
          </msub>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
  <mo>×</mo>
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>8</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>7</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>6</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>5</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>0</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>4</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>3</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>2</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>m</mi>
            <mn>1</mn>
          </msub>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
  <mo>=</mo>
  <msub>
    <mi>p</mi>
    <mn>1</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>1</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>2</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>2</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>3</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>3</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>4</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>4</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>0</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>0</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>5</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>5</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>6</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>6</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>7</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>7</mn>
  </msub>
  <mo>+</mo>
 <msub>
    <mi>p</mi>
    <mn>8</mn>
  </msub>
  <mo>×</mo>
  <msub>
    <mi>m</mi>
    <mn>8</mn>
  </msub>

</math></p>

<p>Cette opération est effectuée sur tous les pixels de l’image. Pour finir, ajoutons que le résultat est normalisé, c’est à dire qu’il est divisé par la somme des coefficients de la matrice de convolution.</p>

<p>Pour appliquer un tel filtre dans SVG, on se sert de la primitive <span class="balise">feConvolveMatrix</span> et de son attribut <span class="balise">kernelMatrix</span> pour les valeurs de la matrice de convolution.</p>

<h4>Le filtre moyen</h4>

<p>Le filtre moyen est un filtre qui permet le floutage de l’image d’entrée. Son noyau est le suivant : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Le filtre étant automatiquement normalisé, le résultat de produit de convolution est divisé par 9 qui est la somme des coefficients. En réalité, la valeur finale de <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>p</mi>
    <mn>0</mn>
  </msub>
</math> est calculée grâce à la matrice suivante : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
        <mtd>
          <mfrac>
            <mn>1</mn>
            <mn>9</mn>
          </mfrac>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Il s’agit donc d’un filtre qui fait la moyenne des pixels voisins et du pixel traité, d’où son nom. Ce genre de filtre est utilisé quand une image à des défauts qu’il faut effacer.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="moyen.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Filtre moyen avec une matrice de convolution</title>

<defs>
	<filter id="moyen">
		<feConvolveMatrix
			kernelMatrix="1 1 1
				      1 1 1
				      1 1 1"/>
	</filter>
</defs>

<image xlink:href="Kirche_Laibaroes_1949_b.jpg"
	x="5" y="5" width="390" height="140"/>

<image xlink:href="Kirche_Laibaroes_1949_b.jpg" id="filt"
	x="5" y="155" width="390" height="140"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[image#filt{
	filter:url(moyen.svg#moyen);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/moyen.svg">Filtre moyen avec une matrice de convolution</object>
</div>

<h4>Le filtre gaussien</h4>

<p>Il existe un filtre de floutage réputé pour donner un meilleur résultat pour éliminer le bruit d’une image : le filtre gaussien. Le principe est de donner un poids plus fort au pixel traité et aux pixels qui lui sont le plus proche. Voici son noyau :
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>2</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>2</mn>
        </mtd>
        <mtd>
          <mn>4</mn>
        </mtd>
        <mtd>
          <mn>2</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>2</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Reprenons l’exemple précédent :</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="gauss.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Filtre gaussien avec une matrice de convolution</title>

<defs>
	<filter id="gauss">
		<feConvolveMatrix
			kernelMatrix="1 2 1
				      2 4 2
				      1 2 1"/>
	</filter>
</defs>

<image xlink:href="Kirche_Laibaroes_1949_b.jpg"
	x="5" y="5" width="390" height="140"/>

<image xlink:href="Kirche_Laibaroes_1949_b.jpg" id="filt"
	x="5" y="155" width="390" height="140"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(gauss.svg#gauss);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/gauss.svg">Filtre gaussien avec une matrice de convolution</object>
</div>

<h4>Détection des contours</h4>

<p>Il est possible de détecter les contours avec des filtres de convolution, appelés filtres laplaciens. Il en existe plusieurs mais le principe reste le même : la somme de tous les coefficients doit être nulle. Voici quelques un des noyaux possibles :
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>4</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>,

<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>4</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>,

<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>8</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>.</p>

<p>Voici l’image dont on cherche à déterminer le contour :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="laplace.base.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Filtre laplacien avec une matrice de convolution - Image d’origine</title>

<image xlink:href="Lotus_berthelotii_2.jpg" id="filt"
	x="5" y="5" width="390" height="290"/>

<text x="200" y="285">Lotus Berthelotii</text>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:30px;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/laplace.base.svg">Filtre laplacien avec une matrice de convolution - Image d’origine</object>
</div>

<p>Appliquons y un filtre laplacien :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="laplace.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Filtre laplacien avec une matrice de convolution</title>

<defs>
	<filter id="laplace">
		<feConvolveMatrix preserveAlpha="true"
			kernelMatrix="-1 -1 -1
					-1  8 -1
					-1 -1 -1"/>

	</filter>
</defs>

<g id="filt">
	<image xlink:href="Lotus_berthelotii_2.jpg"
		x="5" y="5" width="390" height="290"/>

	<text x="200" y="285">Lotus Berthelotii</text>
</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:30px;
	}

#filt{
	filter:url(laplace.svg#laplace);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/laplace.svg">Filtre laplacien avec une matrice de convolution</object>
</div>

<p>Vous avez sans doute remarqué la présence de l’attribut <span class="attribute">preserveAlpha</span> à la valeur <span class="attribute">true</span>. Cela indique qu’on n’applique pas le filtre de convolution sur la couche alpha. Dans ce cas précis, vu le noyau, la couche alpha se retrouve forcément à zéro ! D’où l’utilisation de cet attribut.</p>

<p>On peut adapter ces filtres pour qu’ils ne détectent les contours que dans une direction. Par exemple, si on ne veut que les contours sur l’axe y, on aura pour noyau :
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>6</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>.</p>

<h4>Le rehaussement des contours</h4>

<p>Pour rehausser les contours, il suffit de superposer l’image avec le résultat de la détection des contours. Il faut donc additionner le noyau du filtre laplacien au filtre unité. Comment coder le filtre unité ? C’est très simple: <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Ainsi, on doit écrire :


<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>8</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
  <mo>+</mo>
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
  <mo>=</mo>
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>9</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Et voici notre image avec ses contours réhaussés :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="sharpness.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Rehaussement des contours avec une matrice de convolution</title>

<defs>
	<filter id="sharpness">
		<feConvolveMatrix
			kernelMatrix="-1 -1 -1
						-1  9 -1
						-1 -1 -1"/>
	</filter>
</defs>

<g id="filt">
	<image xlink:href="Lotus_berthelotii_2.jpg"
		x="5" y="5" width="390" height="290"/>

	<text x="200" y="285">Lotus Berthelotii</text>
</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:30px;
	}

#filt{
	filter:url(sharpness.svg#sharpness);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/sharpness.svg">Rehaussement des contours avec une matrice de convolution</object>
</div>

<p>En changeant le coefficient du pixel traité (le coefficient central) on décide de montrer plus ou moins les contours. Si ce coefficient est plus élevé, alors l’image aura plus d’importance que les contours. Ça peut être utile pour réhausser légèrement les contours. Au contraire, si ce coefficient est faible, les contours auront plus d’importance. Voici ce qu’on obtient avec un noyau <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>6.5</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math> :</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/sharpness2.svg">Rehaussement des contours avec une matrice de convolution</object>
</div>


<h4>Embossage</h4>

<p>L’embossage est un effet permettant d’obtenir un pseudo effet 3D. Les contours sont rehaussés selon une direction. Par exemple, avec ce noyau, <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>-2</mn>
        </mtd>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>-1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>2</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>, on a un embossage sur la diagonale de haut en bas et de gauche à droite.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="emboss.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Embossage avec une matrice de convolution</title>

<defs>
	<filter id="emboss">
		<feConvolveMatrix
			kernelMatrix="-2 -1 0
						-1 2 1
						0 1 2"/>
	</filter>
</defs>

<g id="filt">
	<image xlink:href="Lotus_berthelotii_2.jpg"
		x="5" y="5" width="390" height="290"/>

	<text x="200" y="285">Lotus Berthelotii</text>
</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:30px;
	}

#filt{
	filter:url(emboss.svg#emboss);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/emboss.svg">Embossage avec une matrice de convolution</object>
</div>

<p>Comme toujours, on peut jouer sur le coefficient central pour atténuer ou accentuer l’effet de l’embossage. De plus, on peut changer la direction de l’embossage (bien visible sur le texte) en modifiant le noyau.</p>

<h4>Aller plus loin</h4>

<p>L’élément <span class="balise">feConvolveMatrix</span> peut avoir plusieurs attributs qui permettent de modifier différents paramêtres du filtre de convolution.</p>

<p>Le premier est l’attribut <span class="attribute">order</span>. Jusqu’ici, la matrice de base était de taille <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mn>3</mn>
  <mo>×</mo>
  <mn>3</mn>
</math> mais grâce à <span class="attribute">order</span> on peut donner la taille que l’on souhaite à notre matrice de convolution. Il prend en paramêtre un ou deux entiers strictement positifs (forcément !). Avec un nombre n, on obtient une matrice carré <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mn>n</mn>
  <mo>×</mo>
  <mn>n</mn>
</math> et avec deux nombres n et m on obtient une matrice de n colonnes et m lignes. Attention, de grandes matrices impliquent beaucoup de calculs en plus, alors limitez vous !</p>

<p>On peut aussi choisir la position du pixel cible dans la matrice. En effet, jusqu’à maintenant il s’agissait du pixel central (2<sup>e</sup> colonne 2<sup>e</sup> ligne) et c’est le comportement par défaut quelquesoit la taille de la matrice. Avec les attributs <span class="attribute">targetX</span> et <span class="attribute">targetY</span> on peut choisir une position arbitraire pour le pixel cible.</p>

<p>Je vous ai déjà dit que le résultat était normalisé en étant divisé par la somme des coefficients de la matrice appelé diviseur. On peut modifier ce diviseur avec l’attribut <span class="attribute">divisor</span>. Enfin, l’attribut <span class="attribute">bias</span> permet d’ajouter, après normalisation, un nombre au résultat final de chaque pixel traité.</p>

<p>Avec ces attributs, on peut réaliser un flou unidirectionnel avec ce noyau :
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>
.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="motionblur.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Flou unidirectionnel avec une matrice de convolution</title>

<defs>
	<filter id="motionblur">
		<feConvolveMatrix order="9" divisor="6" bias="-0.2"
			kernelMatrix="1 0 0 0 0 0 0 0 0
				      		  0 1 0 0 0 0 0 0 0
				      		  0 0 1 0 0 0 0 0 0
				      		  0 0 0 1 0 0 0 0 0
				      		  0 0 0 0 1 0 0 0 0
				      		  0 0 0 0 0 1 0 0 0
				      		  0 0 0 0 0 0 1 0 0
				      		  0 0 0 0 0 0 0 1 0
				      		  0 0 0 0 0 0 0 0 1"/>
	</filter>
</defs>

<g id="filt">
	<image xlink:href="Lotus_berthelotii_2.jpg"
		x="5" y="5" width="390" height="290"/>

	<text x="200" y="285">Lotus Berthelotii</text>
</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:30px;
	}

#filt{
	filter:url(motionblur.svg#motionblur);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/motionblur.svg">Flou unidirectionnel avec une matrice de convolution</object>
</div>

<p>Ici, on utilise le biais pour assombrir l’image (en simplifiant, 0 étant le noir et 1 le blanc en enlevant 0.2 on assombrit bien l’ensemble de l’image).</p>

<p>Avec un peu d’imagination, on peut trouver bien d’autres filtres. Il faut procéder par tâtonnement. Voici un dernier filtre j’ai nommé le flou multi-directionnel, dont le noyau est : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn style="font-weight:bold">1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="motionblur2.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Flou multidirectionnel avec une matrice de convolution</title>

<defs>
	<filter id="motionblur">
		<feConvolveMatrix order="9" bias="-0.2"
			kernelMatrix="1 0 0 0 0 0 0 0 0
				      		  0 1 0 0 0 0 0 0 0
					          0 0 1 0 0 0 0 1 1
					          0 0 0 1 0 1 1 0 0
					          0 0 0 0 1 0 0 0 0
					          0 0 1 1 0 1 0 0 0
					          1 1 0 0 0 0 1 0 0
					          0 0 0 0 0 0 0 1 0
					          0 0 0 0 0 0 0 0 1"/>
	</filter>
</defs>

<g id="filt">
	<image xlink:href="Lotus_berthelotii_2.jpg"
		x="5" y="5" width="390" height="290"/>

	<text x="200" y="285">Lotus Berthelotii</text>
</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:30px;
	}

#filt{
	filter:url(motionblur2.svg#motionblur);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/motionblur2.svg">Flou multidirectionnel avec une matrice de convolution</object>
</div>

<p>Les deux directions du flou sont bien visibles. On aurait pu rajouter une détection de contour ou de l’embossage.</p>


<h3 id="matcouleur">Matrice de couleur</h3>

<p>Tout comme le filtre de convolution, la primitive matrice de couleur permet de recalculer la valeur de chaque pixel de l’image. Mais ce n’est pas par rapport aux pixels voisins qu’on va calculer la nouvelle valeur du pixel (comme c’est le cas pour la convolution) mais c’est à partir des quatre composantes : rouge, vert, bleu, canal alpha (opacité). La méthode de base consiste à définir une matrice. De plus la primitive <span class="balise">feColorMatrix</span> met à disposition trois raccourcis. On le détermine grâce à l’attribut <span class="attribute">type</span> qui peut prendre les valeurs <span class="attribute">matrix</span>, <span class="attribute">saturate</span>, <span class="attribute">hueRotate</span>, <span class="attribute">luminanceToAlpha</span>.</p>


<h4>Matrice</h4>

<p>La spécification donne la définition suivant pour le calcul des composantes du pixel : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <msub>
            <mi>R</mi>
            <mi>final</mi>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>V</mi>
            <mi>final</mi>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>B</mi>
            <mi>final</mi>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>A</mi>
            <mi>final</mi>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
  <mo>=</mo>
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>00</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>01</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>02</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>03</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>04</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>10</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>11</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>12</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>13</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>14</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>20</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>21</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>22</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>23</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>24</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>30</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>31</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>32</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>33</mn>
          </msub>
        </mtd>
        <mtd>
          <msub>
            <mi>a</mi>
            <mn>34</mn>
          </msub>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
  <mo>×</mo>
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mi>R</mi>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mi>V</mi>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mi>B</mi>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mi>A</mi>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Ce sont les a indicés que l’on devra renseigner. Les 0 et 1 supplémentaires sont là pour conserver la compatibilité de la multiplication matricielle.</p>

<p>En faisant le produit matriciel, on obtient la formule pour chaque composante : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mrow>
    <mo>{</mo>
    <mrow>
      <mtable>
        <mtr>
          <mtd>
            <msub>
              <mi>R</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <msub>
              <mi>a</mi>
              <mn>00</mn>
            </msub>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>01</mn>
            </msub>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>02</mn>
            </msub>
            <mo>×</mo>
            <mi>B</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>03</mn>
            </msub>
            <mo>×</mo>
            <mi>A</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>04</mn>
            </msub>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>V</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <msub>
              <mi>a</mi>
              <mn>10</mn>
            </msub>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>11</mn>
            </msub>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>12</mn>
            </msub>
            <mo>×</mo>
            <mi>B</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>13</mn>
            </msub>
            <mo>×</mo>
            <mi>A</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>14</mn>
            </msub>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>B</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <msub>
              <mi>a</mi>
              <mn>20</mn>
            </msub>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>21</mn>
            </msub>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>22</mn>
            </msub>
            <mo>×</mo>
            <mi>B</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>23</mn>
            </msub>
            <mo>×</mo>
            <mi>A</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>24</mn>
            </msub>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>A</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <msub>
              <mi>a</mi>
              <mn>30</mn>
            </msub>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>31</mn>
            </msub>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>32</mn>
            </msub>
            <mo>×</mo>
            <mi>B</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>33</mn>
            </msub>
            <mo>×</mo>
            <mi>A</mi>
            <mo>+</mo>
            <msub>
              <mi>a</mi>
              <mn>34</mn>
            </msub>
          </mtd>
        </mtr>
      </mtable>
    </mrow>
  </mrow>
</math>.</p>

<p>Ça peut paraître compliqué au premier abord mais en fait c’est très simple.</p>

<p>Première remarque : il y a pour chaque composante un biais (les <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>a</mi>
    <mrow>
      <mi>n</mi>
      <mn>4</mn>
    </mrow>
  </msub>
</math> en dernier) qui permettent d’ajouter sans prendre en compte les canaux de couleur une quantité. Si la quantité est positive, on éclaircit le dessin. Sinon, on l’assombrit. Ce qui est intéressant c’est qu’il y a un biais pour chaque composante. On peut donc décider de relever le biais pour une seule composante.</p>

<p><img src="images/cours/filtres/DaylesfordWarMemorial.jpg" alt="War memorial at Daylesford, Victoria" style="float:right;margin:18px"/>Prenons la photo suivante. Il fait trop beau, ça ne vas pas. Qu’à cela ne tienne, assombrissons le ciel ! Pour cela, enlevons une petite quantité à la composante bleue de cette image. On utilise cette matrice : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mo>&minus;</mo>
          <mn>0.3</mn>
        </mtd>
      </mtr>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. La diagonale de 1 est là pour conserver la valeur d’origine du pixel (c’est la matrice unité). En redécomposant les différantes composantes on voit très vite pourquoi : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mrow>
    <mrow>
      <mo>{</mo>
      <mrow>
        <mtable>
          <mtr>
            <mtd>
              <msub>
                <mi>R</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mn>1</mn>
              <mo>×</mo>
              <mi>R</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>V</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>B</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>A</mi>
            </mtd>
          </mtr>
          <mtr>
            <mtd>
              <msub>
                <mi>V</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>R</mi>
              <mo>+</mo>
              <mn>1</mn>
              <mo>×</mo>
              <mi>V</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>B</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>A</mi>
            </mtd>
          </mtr>
          <mtr>
            <mtd>
              <msub>
                <mi>B</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>R</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>V</mi>
              <mo>+</mo>
              <mn>1</mn>
              <mo>×</mo>
              <mi>B</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>A</mi>
              <mo>+</mo>
              <mo>(</mo>
              <mo>&minus;</mo>
              <mn>0.2</mn>
              <mo>)</mo>
            </mtd>
          </mtr>
          <mtr>
            <mtd>
              <msub>
                <mi>A</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>R</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>V</mi>
              <mo>+</mo>
              <mn>0</mn>
              <mo>×</mo>
              <mi>B</mi>
              <mo>+</mo>
              <mn>1</mn>
              <mo>×</mo>
              <mi>A</mi>
            </mtd>
          </mtr>
        </mtable>
      </mrow>
    </mrow>
    <mo>&rArr;</mo>
    <mrow>
      <mo>{</mo>
      <mrow>
        <mtable>
          <mtr>
            <mtd>
              <msub>
                <mi>R</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mi>R</mi>
            </mtd>
          </mtr>
          <mtr>
            <mtd>
              <msub>
                <mi>V</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mi>V</mi>
            </mtd>
          </mtr>
          <mtr>
            <mtd>
              <msub>
                <mi>B</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mi>B</mi>
              <mo>&minus;</mo>
              <mn>0.2</mn>
            </mtd>
          </mtr>
          <mtr>
            <mtd>
              <msub>
                <mi>A</mi>
                <mi>final</mi>
              </msub>
              <mo>=</mo>
              <mi>A</mi>
            </mtd>
          </mtr>
        </mtable>
      </mrow>
    </mrow>
  </mrow>
</math>.</p>
<p>Je vous bichonne là <object type="image/gif" data="images/smileys/001_cool.gif">B-)</object>. C’est l’attribut <span class="attribute">values</span> qui reçoit les valeurs de la matrice. Comme la dernière ligne ne sert à rien, on ne donne que les 20 premiers coefficients (ceux en gras ci-dessus). Regardons cet exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-blue.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Assombrissement de la composante bleue avec feColorMatrix</title>

<defs>
	<filter id="assombrit-bleu">
		<feColorMatrix type="matrix"
			values="1 0 0 0 0
				       0 1 0 0 0
				       0 0 1 0 -0.3
				       0 0 0 1 0"/>
	</filter>
</defs>

<image xlink:href="DaylesfordWarMemorial.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="DaylesfordWarMemorial.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-blue.svg#assombrit-bleu);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-blue.svg">Assombrissement de la composante bleue avec feColorMatrix</object>
</div>

<p>Le ciel est plus sombre, la composante bleue a bien été diminuée. Mais dans le reste de l’image les couleurs ont aussi changé. C’est normal car les couleurs sont en fait des mélanges de plusieurs couleurs. Ainsi le blanc est la somme des trois couleurs (rouge, vert, bleu) et diminuer le bleu agit aussi sur le blanc, qui voit sa composante bleue diminuer.</p>

<p>Il y a un autre moyen pour renforcer ou diminuer une composante. Il suffit de modifier les coefficients de la matrice unitaire. Prenons cette matrice : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>1.3</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1.1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0.7</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. La composante rouge (couleur chaude) est renforcé (+30%) tandis que la bleue (couleur froide) est attenuée (-30%). On peut donc s’attendre à ce que l’image se réchauffe. Testons ce filtre :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-balance.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Balance des couleurs avec feColorMatrix</title>

<defs>
	<filter id="balance">
		<feColorMatrix type="matrix"
			values="1.3 0 0 0 0
				       0 1.1 0 0 0
				       0 0 0.7 0 0
				       0 0 0 1 0"/>
	</filter>
</defs>

<image xlink:href="DaylesfordWarMemorial.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="DaylesfordWarMemorial.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-balance.svg#balance);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-balance.svg">Balance des couleurs avec feColorMatrix</object>
</div>

<p>L’effet obtenue est bien celui souhaité. On vient de faire la balance des couleurs. En associant le biais et cette méthode, on peut contrôler finement chaque composante.</p>

<p>Mais les possibilités de la matrice de couleur ne s’arrête pas là, bien heureusement ! Nous n’avons pas encore utilisé les coefficients hors diagonale (hormis les biais). Grâce à ces coefficients, on peut prendre en compte toutes les composantes pour calculer la nouvelle !</p>

<p>Dans le prochain exemple, on effectue une rotation sur les composantes. La composante bleue reçoit la rouge, la rouge reçoit la verte et la vert reçoit la bleue. La matrice est la suivante : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. En reprenant, une dernière fois, le développement du produit matriciel, on obtient : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mrow>
    <mo>{</mo>
    <mrow>
      <mtable>
        <mtr>
          <mtd>
            <msub>
              <mi>R</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mi>V</mi>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>V</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mi>B</mi>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>B</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mi>R</mi>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <mi>A</mi>
            <mo>=</mo>
            <mi>A</mi>
          </mtd>
        </mtr>
      </mtable>
    </mrow>
  </mrow>
</math>. Ce qui est vert va donc devenir rouge, ce qui est bleu va devenir vert et ce qui est rouge va devenir bleu.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-inversion.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Rotation des composantes avec feColorMatrix</title>

<defs>
	<filter id="balance">
		<feColorMatrix type="matrix"
			values="0 1 0 0 0
				       0 0 1 0 0
				       1 0 0 0 0
				       0 0 0 1 0"/>
	</filter>
</defs>

<image xlink:href="Aframomum_angustifolium_fruit.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="Aframomum_angustifolium_fruit.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-inversion.svg#balance);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-inversion.svg">Rotation des composantes avec feColorMatrix</object>
</div>

<p>On le voit bien, la végétation verte donne après application du filtre dans les tons rouges et surtout les fruits rouges donnent un beau bleu.</p>

<p>On n’est pas obligé de conserver toutes les composantes. Dans l’exemple suivant, on ne conserve que la composante verte, en assombrissant le tout un petit peu (le -0.2).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-green.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Tout en vert avec feColorMatrix</title>

<defs>
	<filter id="envert">
		<feColorMatrix type="matrix"
			values="0 0 0 0 0
				       1 1 1 0 -0.2
				       0 0 0 0 0
				       0 0 0 1 0"/>
	</filter>
</defs>

<image xlink:href="Aframomum_angustifolium_fruit.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="Aframomum_angustifolium_fruit.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-green.svg#envert);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-green.svg">Tout en vert avec feColorMatrix</object>
</div>

<p>Étudions maintenant la manipulation canal alpha, ce que nous n’avons pas encore fait. Avec la matrice <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr style="font-weight:bold">
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mo>&minus;</mo>
          <mn>0.2</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>, on décide de conserver les couleurs (les trois 1 en diagonale) mais on modifie la transparence. On a <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>A</mi>
    <mi>final</mi>
  </msub>
  <mo>=</mo>
  <mi>R</mi>
  <mo>+</mo>
  <mi>V</mi>
  <mo>&minus;</mo>
  <mn>0.2</mn>
</math>, c’est à dire que l’opacité sera maximale (A = 1) là ou il y a du rouge et du vert. Par contre, s’il n’y a que du bleu, la valeur de la composante alpha sera nulle et il y aura donc transparence. De plus, rappelez-vous qu’une couleur a le plus souvent un peu des trois composantes. Ainsi, la couleur CSS3 <span class="csspropertie">turquoise</span> a pour notation <span class="csspropertie">rgb(64,224,208)</span> : beaucoup de vert (224), beaucoup de bleu (208) et un peu de rouge (64) ! C’est pourquoi j’ai mis un -0.2 comme biais pour la transparence : même si un bleu a un peu des composantes rouge et verte, la somme de ces deux composantes sera annulée et on aura bien de la transparence. Afin de bien voir l’effet de la transparence, j’ai ajouté un quadrillage en fond.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-Alpha.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Manipulation du canal alpha avec feColorMatrix</title>

<defs>
	<filter id="alpha">
		<feImage xlink:href="damier.png" width="8" height="8"/>

		<feTile result="fond"/>

		<feColorMatrix in="SourceGraphic" result="alphaImg"
			type="matrix"
			values="1 0 0 0 0
				       0 1 0 0 0
				       0 0 1 0 0
				       1 1 0 0 -0.2"/>

		<feMerge>
			<feMergeNode in="fond"/>
			<feMergeNode in="alphaImg"/>
		</feMerge>
	</filter>
</defs>

<image xlink:href="Jelly_cc13.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="Jelly_cc13.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-Alpha.svg#alpha);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-Alpha.svg">Manipulation du canal alpha avec feColorMatrix</object>
</div>

<p>Enfin, et nous finirons par là, on peut convertir une image en niveaux de gris très facilement. La caractéristique d’un gris (quelle que soit son intensité) c’est que ses trois composantes rouge, verte et bleue sont égales. Ainsi, <span class="csspropertie">rgb(133,133,133)</span>, <span class="csspropertie">rgb(95,95,95)</span> et <span class="csspropertie">rgb(212,212,212)</span> sont des gris. Pour convertir une image en niveaux de gris, il suffit donc que les trois composantes R, V et B soient égales.</p>

<p>Le plus intuitif serait de mettre <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfrac bevelled="true">
    <mn>1</mn>
    <mn>3</mn>
  </mfrac>
</math> de chaque composante dans le nouveau pixel, par exemple avec cette matrice : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0.33</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
	</math>. En développant le produit matriciel, on obtient :<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mrow>
    <mo>{</mo>
    <mrow>
      <mtable>
        <mtr>
          <mtd>
            <msub>
              <mi>R</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>B</mi>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>V</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>B</mi>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>B</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>R</mi>
            <mo>+</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>V</mi>
            <mo>+</mo>
            <mfrac>
              <mn>1</mn>
              <mn>3</mn>
            </mfrac>
            <mo>×</mo>
            <mi>B</mi>
          </mtd>
        </mtr>
        <mtr>
          <mtd>
            <msub>
              <mi>A</mi>
              <mi>final</mi>
            </msub>
            <mo>=</mo>
            <mi>A</mi>
          </mtd>
        </mtr>
      </mtable>
    </mrow>
  </mrow>
</math>. Les trois composantes de couleur ont bien la même valeur et il s’agit donc d’un niveau de gris. Appliqué à tous les pixels de l’image, ce filtre nous donnera bien une image en niveaux de gris.</p>

<p>Néanmoins, il y a une meilleur manière de faire. L’œil ne perçoit pas la luminosité de la même façon selon la couleur. On peut donc utiliser la luminance des couleurs pour convertir une image en niveaux de gris. Dans ce cas, on prendra 30 % de rouge, 59 % de vert et 11 % de bleu. Consultez <a href="http://fr.wikipedia.org/wiki/Luminance">l’article de wikipédia sur la luminance</a> pour en savoir plus. Nous allons donc plutôt prendre cette matrice : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <mfenced>
    <mtable>
      <mtr>
        <mtd>
          <mn>0.299</mn>
        </mtd>
        <mtd>
          <mn>0.587</mn>
        </mtd>
        <mtd>
          <mn>0.114</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0.299</mn>
        </mtd>
        <mtd>
          <mn>0.587</mn>
        </mtd>
        <mtd>
          <mn>0.114</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0.299</mn>
        </mtd>
        <mtd>
          <mn>0.587</mn>
        </mtd>
        <mtd>
          <mn>0.114</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
      </mtr>
      <mtr>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>0</mn>
        </mtd>
        <mtd>
          <mn>1</mn>
        </mtd>
      </mtr>
    </mtable>
  </mfenced>
</math>. Testons la sur la méduse :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-gris.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Niveaux de gris avec feColorMatrix</title>

<defs>
	<filter id="gris">
		<feColorMatrix type="matrix"
			values="0.299 0.587 0.114 0 0
				       0.299 0.587 0.114 0 0
				       0.299 0.587 0.114 0 0
				       0 0 0 1 0"/>
	</filter>
</defs>

<image xlink:href="Jelly_cc13.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="Jelly_cc13.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-gris.svg#gris);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-gris.svg">Niveaux de gris avec feColorMatrix</object>
</div>

<p>Nous avons a peu près fait le tour de ce qu’on peut faire avec les matrices de couleur. Presque, car on n’a modifié que quelques coefficients à la fois alors qu’il est possible de tous les modifier en une fois (il y en a 20).</p>

<h4>Rotation</h4>

<p>Quand l’attribut <span class="attribute">type</span> prend la valeur <span class="attribute">hueRotate</span>, la primitive effectue une rotation sur les couleurs. Que donne une rotation sur des couleurs ? Il s’agit en fait d’une rotation sur le <a href="http://fr.wikipedia.org/wiki/Cercle_chromatique">cercle chromatique</a>. Tout ce que vous devez savoir, c’est que l’attribut <span class="attribute">values</span> prend la rotation en degrées à effectuer et qu’une rotation de 360° équivaut a une rotation de 0°. Testons 3 rotations, d’un quart de tour, d’un demi tour et de trois quarts de tour.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-rotation.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Rotation avec feColorMatrix</title>

<defs>
	<filter id="rotation90">
		<feColorMatrix type="hueRotate" values="90"/>
	</filter>
	<filter id="rotation180">
		<feColorMatrix type="hueRotate" values="180"/>
	</filter>
	<filter id="rotation270">
		<feColorMatrix type="hueRotate" values="270"/>
	</filter>
</defs>

<image xlink:href="Jelly_cc13.jpg"
		x="5" y="5" width="190" height="140"/>

<image xlink:href="Jelly_cc13.jpg" id="filt90"
		x="205" y="5" width="190" height="140"/>

<image xlink:href="Jelly_cc13.jpg" id="filt180"
		x="5" y="155" width="190" height="140"/>

<image xlink:href="Jelly_cc13.jpg" id="filt270"
		x="205" y="155" width="190" height="140"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt90{
	filter:url(feColor-rotation.svg#rotation90);
	}

#filt180{
	filter:url(feColor-rotation.svg#rotation180);
	}

#filt270{
	filter:url(feColor-rotation.svg#rotation270);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-rotation.svg">Rotation avec feColorMatrix</object>
</div>

<p>On voit bien que la rotation d’un demi tour fait apparaître les <a href="http://fr.wikipedia.org/wiki/Couleur_complémentaire">couleurs complémentaires</a> (à l’image du bleu qui devient orange).</p>


<h4>Saturation</h4>

<p>La saturation permet d’abaisser l’intensité des couleurs d’une image. On fixe <span class="attribute">type</span> à la valeur <span class="attribute">saturate</span> et <span class="attribute">values</span> prend une valeur entre 0 et 1. Pour la valeur 1, il n’y a aucun changement. Plus on va vers 0, l’image se ternit, devient fade et à 0, on a une image en niveaux de gris.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-saturation.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Saturation avec feColorMatrix</title>

<defs>
	<filter id="saturation">
		<feColorMatrix type="saturate" values="0.6"/>
	</filter>
</defs>

<image xlink:href="Jelly_cc13.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="Jelly_cc13.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-saturation.svg#saturation);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-saturation.svg">Saturation avec feColorMatrix</object>
</div>

<h4>Luminance vers alpha</h4>

<p>Le dernier mot-clé disponible est <span class="attribute">luminanceToAlpha</span>. Chaque pixel reçoit en composante alpha la somme de ses différentes composantes. Les composantes sont nulles. Il reste donc un squelette opaque là où les couleurs étaient claires et transparent là où les couleurs étaient foncées, proches du noir.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feColor-luminance.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>luminanceToAlpha avec feColorMatrix</title>

<defs>
	<filter id="luminance">
		<feColorMatrix type="luminanceToAlpha" result="lum"/>

		<!-- quadrillage en arrière plan -->
		<feImage xlink:href="damier.png" width="8" height="8"/>
		<feTile result="fond"/>

		<feMerge>
			<feMergeNode in="fond"/>
			<feMergeNode in="lum"/>
		</feMerge>

	</filter>
</defs>

<image xlink:href="Jelly_cc13.jpg"
		x="5" y="5" width="190" height="290"/>

<image xlink:href="Jelly_cc13.jpg" id="filt"
		x="205" y="5" width="190" height="290"/>
</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feColor-luminance.svg#luminance);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feColor-luminance.svg">luminanceToAlpha avec feColorMatrix</object>
</div>

<p>Nous avons fait le tour de cette primitive mais nous allons le voir, ce n’est pas la seule à pouvoir travailler sur les couleurs.</p>




<h3 id="transf">Transfert de composante</h3>

<p>Il existe une autre primitive, <span class="balise">feComponentTransfer</span>, qui permet de jouer sur chaque composante (rouge, verte, bleue et alpha) d’une image. On manipule ces composantes via les quatre éléments fils <span class="balise">feFuncR</span>, <span class="balise">feFuncG</span>, <span class="balise">feFuncB</span>, <span class="balise">feFuncA</span> respectivement pour le rouge, le vert, le bleu et l’opacité. On peut traiter un ou plusieurs canaux.</p>

<p>Ces quatre éléments portent l’attribut <span class="attribute">type</span> qui définit le type de transfert à effectuer : <span class="attribute">identity</span>, <span class="attribute">linear</span>, <span class="attribute">gamma</span>, <span class="attribute">table</span> et <span class="attribute">discrete</span>. Vous aurez deviné qu’avec <span class="attribute">identity</span>, rien ne se passe.</p>

<h4>Avec le mot-clé <span class="attribute">linear</span></h4>

<p>Nous avons déjà vu l’utilisation de ce mot-clé… avec <span class="balise">feColorMatrix</span> ! En effet, il sert à faire une balance des couleurs avec coefficient (attribut <span class="attribute">slope</span>) et un biais (attribut <span class="attribute">intercept</span>). L’opération réalisée est pour un pixel p : <math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>p</mi>
    <mi>final</mi>
  </msub>
  <mo>=</mo>
  <mi>slope</mi>
  <mo>×</mo>
  <mi>p</mi>
  <mo>+</mo>
  <mi>intercept</mi>
</math>.</p>

<p>Profitons de cette fonction très simple pour voir comment utiliser les différents éléments. Nous allons rendre une image plus chaude en augmentant la valeur du rouge et en diminuant légèrement les autres.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComp-lin.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Balance des couleurs avec feComponentTransfer</title>

<defs>
	<filter id="lin">
		<feComponentTransfer>
			<feFuncR type="linear" slope="1.2" intercept="0"/>
			<feFuncG type="linear" slope="0.8" intercept="-0.01"/>
			<feFuncB type="linear" slope="0.8" intercept="0"/>
		</feComponentTransfer>
	</filter>
</defs>

<image xlink:href="Bonifacio_to_Seaside.jpg"
		x="5" y="5" width="390" height="140"/>

<image xlink:href="Bonifacio_to_Seaside.jpg" id="filt"
		x="5" y="155" width="390" height="140"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feComp-lin.svg#lin);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-lin.svg">Balance des couleurs avec feComponentTransfer</object>
</div>

<h4>Avec le mot-clé <span class="attribute">gamma</span></h4>

<p>Le mot-clé <span class="attribute">gamma</span> permet d’effectuer lui aussi des ajustement de luminosité mais d’une autre manière, non linéaire. C’est un opérateur bien connu (correction gamma pour les écrans par exemple).</p>

<p>L’ajustement se base sur l’exponentiation. Le changement de couleur d’un pixel se traite de a façon suivante :<br/>
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <msub>
    <mi>p</mi>
    <mi>final</mi>
  </msub>
  <mo>=</mo>
  <mi>amplitude</mi>
  <mo>×</mo>
  <msup>
    <mi>p</mi>
    <mi>exponent</mi>
  </msup>
  <mo>+</mo>
  <mi>offset</mi>
</math> où <span class="attribute">amplitude</span>, <span class="attribute">exponent</span> (le plus important) et <span class="attribute">offset</span> sont les attributs utilisables. Vous l’aurez compris, <span class="attribute">offset</span> peut être assimilé à un biais.</p>

<p>Attention : les valeurs de couleurs vont de 0 à 1. Par conséquent, un exposant supérieur à 1 va assombrir le canal. Au contraire, un exposant inférieur à 1 va éclaircir le canal. On le voit clairement dans la figure suivante :<br/>
<object data="images/cours/filtres/exposant.svg">Différents exposants entre 0 et 1</object></p>

<p>La photo utilisée précédemment est trop claire. Utilisons cet opérateur pour assombrir l’image.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textArea.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Balance des couleurs avec feComponentTransfer (gamma)</title>

<defs>
	<filter id="gamma">
		<feComponentTransfer>
			<feFuncR type="gamma" amplitude="1" exponent="2.2"/>
			<feFuncG type="gamma" amplitude="1" exponent="2.2"/>
			<feFuncB type="gamma" amplitude="1" exponent="2"/>
		</feComponentTransfer>
	</filter>
</defs>

<image xlink:href="Bonifacio_to_Seaside.jpg"
		x="5" y="5" width="390" height="140"/>

<image xlink:href="Bonifacio_to_Seaside.jpg" id="filt"
		x="5" y="155" width="390" height="140"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feComp-gamma.svg#gamma);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-gamma.svg">Balance des couleurs avec feComponentTransfer (gamma)</object>
</div>

<p>Bien sûr, vu que l’on a baissé la valeur du bleu un peu moins que les autres, cette couleur ressort plus.</p>


<h4>Avec le mot-clé <span class="attribute">discrete</span></h4>

<p>L’opération permise par le mot-clé <span class="attribute">discrete</span> n’est absolument pas possible à effectuer avec une matrice de couleur, et c’est pourquoi elle est intéressante. Il s’agit ici de découper la plage d’une couleur en plusieurs portions (de taille égale) et de lui assigner une valeur discrete (fixe).</p>

<p>Pour mieux comprendre, prenons un exemple. Les valeurs discrètes sont à indiquer dans l’attribut <span class="attribute">tableValues</span>. Le nombre de portions sera égale au nombres de valeurs. En prenant <span class="attribute">tableValues="1 0 0.5"</span> pour le canal du vert, le filtre va traiter chaque pixel de la façon suivante :</p>

<ul class="list-attributes">
<li>si la valeur de vert est entre 0 et 0.333 (premier tiers) la nouvelle valeur du vert sera <strong>1</strong> ;</li>
<li>si la valeur de vert est entre 0.333 et 0.666 (second tiers) la nouvelle valeur du vert sera <strong>0</strong> ;</li>
<li>si la valeur de vert est entre 0.666 et 1 (dernier tiers) la nouvelle valeur du vert sera <strong>0.5</strong>.</li>
</ul>

<p>On peut diviser l’intervalle de valeur autant que l’on veut. Afin de bien visualiser le fonctionnement de ce filtre, appliquons le sur des dégradés pur. J’entends par là des dégradés qui vont du noir (0 de couleur partout) à une des trois composantes de couleur (rouge, vert, bleu).</p>

<p>Un petit détail cependant. Vous remarquerez que dans la feuille de style CSS, j’ai utilisé une propriété jusque là inconnue : <span class="csspropertie">color-interpolation</span>. La raison est la suivante : il existe différents espaces de couleurs. Les dégradés utilisent l’espace de couleur qui se nomme <span class="csspropertie">sRGB</span> parcequ’il donne des résultats plus naturels qu’avec la valeur <span class="csspropertie">linearRGB</span>. Au milieu d’un dégradé de vert (par exemple), on peut s’attendre à avoir un valeur de vert de 0.5, mais ce n’est justement pas le cas avec <span class="csspropertie">sRGB</span>. C’est pourquoi on utilise dans notre cas <span class="csspropertie">linearRGB</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComp-discrete.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Discrete avec feComponentTransfer</title>

<defs>
	<filter id="discrete-rouge">
		<feComponentTransfer>
			<feFuncR type="discrete" tableValues="0.3 0.7 1"/>
		</feComponentTransfer>
	</filter>

	<filter id="discrete-vert">
		<feComponentTransfer>
			<feFuncG type="discrete" tableValues="0 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9 1"/>
		</feComponentTransfer>
	</filter>

	<filter id="discrete-bleu">
		<feComponentTransfer>
			<feFuncB type="discrete" tableValues="1 0.24 0.5 0.9 0.1"/>
		</feComponentTransfer>
	</filter>

	<linearGradient id="degRouge">
		<stop stop-color="rgb(0,0,0)" offset="0%"/>
		<stop stop-color="rgb(255,0,0)" offset="100%"/>
	</linearGradient>

	<linearGradient id="degVert">
		<stop stop-color="rgb(0,0,0)" offset="0%"/>
		<stop stop-color="rgb(0,255,0)" offset="100%"/>
	</linearGradient>

	<linearGradient id="degBleu">
		<stop stop-color="rgb(0,0,0)" offset="0%"/>
		<stop stop-color="rgb(0,0,255)" offset="100%"/>
	</linearGradient>
</defs>

<!-- sans filtre -->

<rect x="5" y="5" width="390" height="42" fill="url(#degRouge)"/>
<rect x="5" y="52" width="390" height="42" fill="url(#degVert)"/>
<rect x="5" y="99" width="390" height="42" fill="url(#degBleu)"/>

<!-- avec filtres -->

<rect id="filt-rouge" x="5" y="155" width="390" height="42" fill="url(#degRouge)"/>
<rect id="filt-vert" x="5" y="202" width="390" height="42" fill="url(#degVert)"/>
<rect id="filt-bleu" x="5" y="249" width="390" height="42" fill="url(#degBleu)"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt-rouge{
	filter:url(feComp-discrete.svg#discrete-rouge);
	}

#filt-vert{
	filter:url(feComp-discrete.svg#discrete-vert);
	}

#filt-bleu{
	filter:url(feComp-discrete.svg#discrete-bleu);
	}

rect{
	color-interpolation:linearRGB;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-discrete.svg">Discrete avec feComponentTransfer</object>
</div>

<p>Pour le dégradé rouge, on a les valeurs <span class="attribute">tableValues="0.3 0.7 1"</span> et on observe bien :</p>

<ul class="list-attributes">
<li>premier tiers : 0.3 de rouge (rouge sombre) ;</li>
<li>second tiers : 0.7 de rouge (rouge assez clair) ;</li>
<li>troisième tiers : 1 de rouge (soit du rouge pur).</li>
</ul>

<p>Pour le vert, on a divisé le spectre en 11 plages (<span class="attribute">tableValues="0 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9 1"</span>) que l’on observe bien.</p>

<p>Avec le bleu, on voit que la liste n’a pas l’obligation d’être croissante. En fait on peut mettre les valeurs qu’on souhaite. Avec les 5 valeurs <span class="attribute">tableValues="1 0.24 0.5 0.9 0.1"</span> le transfert se fait de la façon suivante :</p>

<ul class="list-attributes">
<li>valeur du bleu de 0.0 à 0.2 : valeur finale à 1;</li>
<li>valeur du bleu de 0.2 à 0.4 : valeur finale à 0.24;</li>
<li>valeur du bleu de 0.4 à 0.6 : valeur finale à 0.5;</li>
<li>valeur du bleu de 0.6 à 0.8 : valeur finale à 0.9;</li>
<li>valeur du bleu de 0.8 à 1.0 : valeur finale à 0.1.</li>
</ul>

<p>Que faire si on veut des plages pas forcément de même taille, par exemple si on veut traiter le premier tiers et le dernier cinquième ? La solution est mathématique et je vous donne un indice : <a href="http://fr.wikipedia.org/wiki/Ppcm">le ppcm</a>.</p>

<p>Ce mot-clé permet d’obtenir des effets sympas sur les images bitmaps en combinant les trois canaux de couleur.</p>

<p class="rappel">Bien sûr, on peut utiliser des mot-clé différents sur <span class="balise">feFuncR</span>, <span class="balise">feFuncG</span>, <span class="balise">feFuncB</span> et <span class="balise">feFuncA</span>.</p>

<p>Voici un exemple sur cette image : <img style="float:right;width:50%" src="images/cours/filtres/Poospiza_nigrorufa_siete_vestidos.jpg" alt="Photo d’un oiseau"/></p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComp-discrete-bitmap.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Discrete avec feComponentTransfer sur une image raster</title>

<defs>
	<filter id="discrete">
		<feComponentTransfer>
			<feFuncR type="discrete" tableValues="0 0.7 0 1 1 0.3"/>
			<feFuncG type="discrete" tableValues="0 1 1 0"/>
			<feFuncB type="discrete" tableValues="0.2 0.7 0.5 0.3 0.2"/>
		</feComponentTransfer>
	</filter>
</defs>

<image x="5" y="5" width="390" height="290"
	xlink:href="Poospiza_nigrorufa_siete_vestidos.jpg" id="filt"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feComp-discrete-bitmap.svg#discrete);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-discrete-bitmap.svg">Discrete avec feComponentTransfer sur une image raster</object>
</div>

<p>Nous avons utilisé des valeurs discrètes pour toutes les composantes ce qui conduit à avoir un nombre de couleur fixe. Pour ce filtre ci, il y a une palette de 120 couleurs possibles. Je vous laisse chercher pourquoi !</p>

<h4>Avec le mot-clé <span class="attribute">table</span></h4>

<p>L’utilisation de cette primitive avec le mot-clé <span class="attribute">table</span> ressemble à son utilisation avec le mot-clé <span class="attribute">discrete</span>. La couleur traitée est séparée en plages et chaque plage va subir une transformation. Dans le cas de <span class="attribute">discrete</span>, la transformation est simple : c’est le remplacement avec une valeur discrète. Avec <span class="attribute">table</span>, il s’agit d’une transformation linéaire. Une plage est étirée linéairement entre deux valeurs. Prenons un exemple simple (on réutilise le même attribut <span class="attribute">tableValues</span>) : <span class="attribute">tableValues="0 0.3 0.9"</span>.</p>

<p>La première différence est qu’ici, il y a une plage en moins puisque les flottants spécifiés sont des bornes. On a donc 2 plages pour trois valeurs : première moitié et seconde moitié. Voici comment la transformation s’effectue si on prend par exemple le canal de bleu :</p>

<ul class="list-attributes">
<li>pour les valeurs de bleu de <strong>0 à 0.5</strong> (première moitié), les valeurs sont rétrécies sur l’intervalle de <strong>0 à 0.3</strong>. (la transformation étant linéaire, une valeur de bleu de 0.25 au départ prendra à l’arivée la valeur 0.15) ;</li>
<li>pour les valeurs de bleu de <strong>0.5 à 1</strong> (seconde moitié), les valeurs sont étirées sur l’intervalle de <strong>0.3 à 0.9</strong>. (la transformation étant linéaire, une valeur de bleu de 0.75 au départ prendra à l’arivée la valeur 0.6).</li>
</ul>

<p>Comme il n’y a rien de mieux que l’expérimentation lorsqu’on travaille avec les filtres, reprenons nos dégradés de couleur pure :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComp-table.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Table avec feComponentTransfer</title>

<defs>
	<filter id="table-rouge">
		<feComponentTransfer>
			<feFuncR type="table"
				tableValues="0 0.1 0.9 1"/>
		</feComponentTransfer>
	</filter>

	<filter id="table-vert">
		<feComponentTransfer>
			<feFuncG type="table"
				tableValues="1 0.2 0.2 0.2 0.2 0 0.2 0.2 0.2 0.2 1"/>
		</feComponentTransfer>
	</filter>

	<filter id="table-bleu">
		<feComponentTransfer>
			<feFuncB type="table"
				tableValues="1 0 1 0.1 1 0.3 1 0.4 1"/>
		</feComponentTransfer>
	</filter>

	<linearGradient id="degRouge">
		<stop stop-color="rgb(0,0,0)" offset="0%"/>
		<stop stop-color="rgb(255,0,0)" offset="100%"/>
	</linearGradient>

	<linearGradient id="degVert">
		<stop stop-color="rgb(0,0,0)" offset="0%"/>
		<stop stop-color="rgb(0,255,0)" offset="100%"/>
	</linearGradient>

	<linearGradient id="degBleu">
		<stop stop-color="rgb(0,0,0)" offset="0%"/>
		<stop stop-color="rgb(0,0,255)" offset="100%"/>
	</linearGradient>
</defs>

<!-- sans filtre -->

<rect x="5" y="5" width="390" height="42" fill="url(#degRouge)"/>
<rect x="5" y="52" width="390" height="42" fill="url(#degVert)"/>
<rect x="5" y="99" width="390" height="42" fill="url(#degBleu)"/>

<!-- avec filtres -->

<rect id="filt-rouge" x="5" y="155" width="390" height="42" fill="url(#degRouge)"/>
<rect id="filt-vert" x="5" y="202" width="390" height="42" fill="url(#degVert)"/>
<rect id="filt-bleu" x="5" y="249" width="390" height="42" fill="url(#degBleu)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#filt-rouge{
	filter:url(feComp-table.svg#table-rouge);
	}

#filt-vert{
	filter:url(feComp-table.svg#table-vert);
	}

#filt-bleu{
	filter:url(feComp-table.svg#table-bleu);
	}

rect{
	color-interpolation:linearRGB;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-table.svg">Table avec feComponentTransfer</object>
</div>

<p>Le canal rouge est traité par tiers :</p>

<ul class="list-attributes">
<li>premier tiers (valeurs de <strong>0 à 0.33</strong>) : rétrécissement vers la plage de <strong>0 à 0.1</strong>. Le premier tiers est sombre ;</li>
<li>second tiers (valeurs de <strong>0.33 à 0.66</strong>) : dilatation vers la plage de <strong>0.1 à 0.9</strong>. Dégradé normal sur le second tiers ;</li>
<li>dernier tiers (valeurs de <strong>0.66 à 1</strong>) : rétrécissement vers la plage de <strong>0.9 à 1</strong>. Rouge très clair sur le dernier tiers.</li>
</ul>

<p>En ce qui concerne le dégradé vert, le traitement est divisé en dixième (puisqu’il y a 11 valeurs). Cet exemple montre qu’on n’est pas obligé d’avoir un ordre croissant. Mais mieux encore, la transformation tient compte de la pente puisque c’est une transformation linéaire.</p>

<ul class="list-attributes">
<li>Ainsi, pour le premier dixième, les valeurs vont de l’intervalle <strong>0 0.1</strong> sur l’intervalle <strong>1 0.2</strong>. L’ordre est important ! En effet, le noir (valeur 0) est envoyé sur du vert pur (valeur 1) tandis que la valeur 0.1 devient 0.2. Si vous avez bien compris, une valeur de 0.05 (milieu de l’intervalle de départ) deviendra une valeur de vert de 0.6 (milieu de l’intervalle d’arrivé) ;</li>
<li>de <strong>0.1 à 0.4</strong> la valeur du vert devient <strong>0.2</strong> (vert foncé);</li>
<li>de <strong>0.4 à 0.5</strong> la valeur du vert est projeté sur l’intervalle <strong>0.2 0</strong> (dégradé vers le noir);</li>
<li>de <strong>0.5 à 0.6</strong> la valeur du vert est projeté sur l’intervalle <strong>0 0.2</strong> (inverse du précédent);</li>
<li>de <strong>0.6 à 0.9</strong> la valeur du vert devient <strong>0.2</strong> (vert foncé);</li>
<li>enfin de <strong>0.9 à 1</strong> la valeur du vert est projeté sur l’intervalle <strong>0.2 1</strong> (dégradé vers les clair).</li>
</ul>

<p>Pour le bleu, c’est un enchaînement de dégradés vert des bleus de plus en plus clairs.</p>

<p>Reprenons la photo précédente et changeons toutes les couleurs avec le mot-clé <span class="attribute">table</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComp-table-bitmap.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>table avec feComponentTransfer sur une image raster</title>

<defs>
	<filter id="table">
		<feComponentTransfer>
			<feFuncR type="table" tableValues="0.5 0 0.9 0.6 1"/>
			<feFuncG type="table" tableValues="0.7 0.2 0.6 0.9 1 1 1"/>
			<feFuncB type="table" tableValues="0 0.8 1 0.5"/>
		</feComponentTransfer>
	</filter>
</defs>

<image x="5" y="5" width="390" height="290"
	xlink:href="Poospiza_nigrorufa_siete_vestidos.jpg" id="filt"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feComp-table-bitmap.svg#table);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-table-bitmap.svg">table avec feComponentTransfer sur une image raster</object>
</div>

<p>Vous savez même inverser les couleurs d’une image. Si, je vous jure ! Il suffit d’utiliser <span class="attribute">tableValues="1 0"</span> sur les trois composantes de couleur !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComp-table-inverse.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Inversion des couleurs avec feComponentTransfer sur une image raster</title>

<defs>
	<filter id="inverse">
		<feComponentTransfer>
			<feFuncR type="table" tableValues="1 0"/>
			<feFuncG type="table" tableValues="1 0"/>
			<feFuncB type="table" tableValues="1 0"/>
		</feComponentTransfer>
	</filter>
</defs>

<image x="5" y="5" width="390" height="290"
	xlink:href="Poospiza_nigrorufa_siete_vestidos.jpg" id="filt"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feComp-table-inverse.svg#inverse);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComp-table-inverse.svg">Inversion des couleurs avec feComponentTransfer sur une image raster</object>
</div>

<p>Nous avons fait le tour de cette primitive. Les deux derniers mot-clés sont sans aucun doute les plus puissants alors modifier les valeurs de ces exemples pour voir ce que l’on peut faire avec.</p>

<h3 id="turbulence">Turbulences</h3>

<p>La primitive <span class="balise">feTurbulence</span> est très utile pour créer des motifs que l’on trouve dans la nature : eau, ciel, bois, marbre, etc. Il s’agit donc d’une primitive qui ne prend rien en entrée, comme <span class="balise">feFlood</span>. C’est une primitive à la fois très simple, il y a peu d’attributs, et complexe : on met souvent beaucoup de temps avant de trouver le résultat souhaité.</p>

<p>Il y a deux algorithmes pour générer du bruit. Le premier est accessible via le mot-clé <span class="attribute">fractalNoise</span> et le second via le mot-clé <span class="attribute">turbulence</span> avec l’attribut <span class="attribute">type</span>.</p>

<p>L’attribut <span class="attribute">baseFrequency</span> sert à déterminer la vitesse de variations des couleurs. Il s’agit d’un décimal supérieur ou égal à 0. On peut aussi renseigner deux nombres et dans ce cas le premier est pour l’axe x et le second pour l’axe y. Plus la fréquence est grande, plus les couleurs changent vite.</p>

<p>L’attribut <span class="attribute">numOctaves</span> qui vaut 1 par défaut permet de régler la finesse des détails. Plus cet entier est grand, plus les détails seront fin.</p>

<p>Enfin, l’attribut <span class="attribute">seed</span> est la valeur d’initialisation du générateur de nombre aléatoire. Changer ce nombre change totalement le dessin mais on garde la même texture.</p>

<p>Dans l’exemple suivant on peut visualiser la différence entre les deux types de turbulences (en haut <span class="attribute">fractalNoise</span>, en bas <span class="attribute">turbulence</span>).</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feTurbulence.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feTurbulence : les deux types de turbulence</title>

<defs>
	<filter id="fractalNoise1">
		<feTurbulence type="fractalNoise"
			baseFrequency="0.05" numOctaves="1"/>

	</filter>

	<filter id="fractalNoise2">
		<feTurbulence type="fractalNoise"
			baseFrequency="0.05" numOctaves="6"/>

	</filter>

	<filter id="fractalNoise3">
		<feTurbulence type="fractalNoise"
			baseFrequency="0.05 0.15" numOctaves="2"/>

	</filter>

	<filter id="turbulence1">
		<feTurbulence type="turbulence"
			baseFrequency="0.05" numOctaves="2"/>

	</filter>

	<filter id="turbulence2">
		<feTurbulence type="turbulence"
			baseFrequency="0.2" numOctaves="4"/>

	</filter>

	<filter id="turbulence3">
		<feTurbulence type="turbulence"
			baseFrequency="0.15 0.015" numOctaves="2"/>

	</filter>

	<rect id="rect" width="80" height="80"/>
</defs>

<use id="f1" xlink:href="#rect" transform="translate(25,35)"/>

<use id="f2" xlink:href="#rect" transform="translate(155,35)"/>

<use id="f3" xlink:href="#rect" transform="translate(285,35)"/>

<use id="f4" xlink:href="#rect" transform="translate(25,185)"/>

<use id="f5" xlink:href="#rect" transform="translate(155,185)"/>

<use id="f6" xlink:href="#rect" transform="translate(285,185)"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#f1{
	filter:url(feTurbulence.svg#fractalNoise1);
	}

#f2{
	filter:url(feTurbulence.svg#fractalNoise2);
	}

#f3{
	filter:url(feTurbulence.svg#fractalNoise3);
	}

#f4{
	filter:url(feTurbulence.svg#turbulence1);
	}

#f5{
	filter:url(feTurbulence.svg#turbulence2);
	}

#f6{
	filter:url(feTurbulence.svg#turbulence3);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feTurbulence.svg">feTurbulence : les deux types de turbulence</object>
</div>

<p>Comme vous le voyez, il vaut mieux utiliser de petites valeurs. Sinon, le résultat est décevant.</p>

<p>On peut aussi remarquer que si <span class="attribute">numOctaves</span> est proche de 1, le résultat peut paraître flou (comme pour le premier carré).</p>

<p>Maintenant, une remarque importante pour la suite : le blanc que vous voyez n’est pas du blanc mais <em>de la transparence</em> et c’est donc le blanc du fond de la page que vous voyez entre les couleurs. Vous aller voir que ça a très vite son importance, mais avant voici un exemple pour vous en convaincre :</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feTurbulence.svg" style="background-color:black">feTurbulence : les deux types de turbulence</object>
</div>

<p>C’est important car il va bien sûr falloir transformer le résultat de <span class="balise">feTurbulence</span> pour obtenir les textures qu’on veut. Les primitives qui nous aiderons le plus sont <span class="balise">feColorMatrix</span> et <span class="balise">feComponentTransfer</span>. Normal puisqu’on va juste faire des conversions de couleur.</p>

<p>Voici un premier exemple qui donne un résultat ressemblant à un liquide :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feTurbulence-eau.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Texture d’eau avec feTurbulence</title>

<defs>
	<filter id="eau">
		<feTurbulence type="turbulence"
			baseFrequency="0.05 0.15" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0 0 0
					0 0 0.3 0 0
					0 0 1 0 0.5
					0 0 0 1 0"/>
	</filter>
</defs>

<rect id="filt" x="100" y="100" width="200" height="100"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feTurbulence-eau.svg#eau);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feTurbulence-eau.svg">Texture d’eau avec feTurbulence</object>
</div>

<p>Le principe est simple : on ne garde que le bleu que l’on relève (biais de 0.5). Pour avoir du cyan, on rajoute un peu de vert mais <strong>là où il y a du bleu</strong> (0.3).</p>

<p>On peut aussi obtenir des textures végétales, par exemple du bois. En essayant de trouver comment faire pour avoir du bois, j’ai trouvé une texture ressemblant à des végétaux tressés. Je vous laisse juge.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Texture végétale avec feTurbulence</title>

<defs>
	<filter id="v">
		<feTurbulence baseFrequency="0.03 1"
			type="turbulence" numOctaves="1" seed="0"/>
		<feColorMatrix type="matrix"
		values="
			0,0,0,1,0,
			0,0,0,0.53,0,
			0,0,0,0.13,0,
			0,0,0,1,1"/>
	</filter>
</defs>

<rect filter="url(#v)" x="100" y="100" width="200" height="100"/>

</svg>

]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feTurbulence-vegetal.svg">Texture végétale avec feTurbulence</object>
</div>

<p>Enfin, par hasard, j’ai trouvé une manière de faire des nuages dans un ciel bleu. Il y a peut être d’autres méthodes plus simples mais je vous livre celle-ci :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feTurbulence-nuages.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Texture de nuage avec feTurbulence</title>

<defs>
	<filter id="nuages">
		<feTurbulence baseFrequency="0.04,0.05"
			type="fractalNoise" numOctaves="4" seed="2"/>
		<feComponentTransfer>
			<feFuncR type="discrete" tableValues="0 0"/>
			<feFuncG type="discrete" tableValues="0 0"/>
			<feFuncB type="discrete" tableValues="0.2 0.2"/>
		</feComponentTransfer>
		<feColorMatrix type="matrix" values="
			0 0 0 1 0
			0 0 0 1 0
			0 0 2 1 0
			0 0 0 0 1"/>
	</filter>
</defs>

<rect id="filt" x="100" y="100" width="200" height="100"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[#filt{
	filter:url(feTurbulence-nuages.svg#nuages);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feTurbulence-nuages.svg">Texture de nuage avec feTurbulence</object>
</div>

<p>Ici, le principe est de répandre du bleu partout et de supprimer les autres couleurs (transfert de composante) et ensuite de jouer sur le canal alpĥa (auquel on n’a pas touché avant).</p>

<h3 id="mélange">Mélange</h3>

<h4>Fonctionnement</h4>

<p>Grâce à la primitive <span class="balise">feBlend</span>, on peut mélanger deux images selon quatre modes différents : <span class="attribute">multiply</span>, <span class="attribute">screen</span>, <span class="attribute">darken</span> et <span class="attribute">lighten</span> (en utilisant l’attribut <span class="attribute">mode</span>).</p>

<p>Cette primitive est très simple. En effet, il suffit de renseigner les attributs <span class="attribute">in</span> et <span class="attribute">in2</span> qui désignent les deux images à mélanger (peu importe l’ordre ici).</p>

<p>Dans les exemples suivants, on utilise la texture d’eau vue précédemment et le graphique sur lequel on applique le filtre grâce â <span class="attribute">SourceGraphic</span>. Voici l’image de test, avec <span class="attribute">mode="normal"</span> qui signifie qu’on ne fait rien :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feBlend.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feBlend normal</title>

<defs>
	<filter id="melange">
		<feTurbulence type="turbulence"
			baseFrequency="0.05 0.15" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0 0 0
					0 0 0.3 0 0
					0 0 1 0 0.8
					0 0 0 1 0" result="textureEau"/>
		<feBlend mode="normal" in="SourceGraphic" in2="textureEau"/>
	</filter>
</defs>

<text x="200" y="120" style="fill:yellowgreen">SVGround</text>

<text x="200" y="240" style="fill:black">SVGround</text>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	filter:url(feBlend.svg#melange);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feBlend.svg">feBlend normal</object>
</div>

<h4>Avec le mot-clé <span class="attribute">multiply</span></h4>

<p>Le mot-clé <span class="attribute">multiply</span> va provoquer la multiplication des couleurs de chaque pixel, en prenant compte de l’opacité.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feBlend-multiply.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feBlend multiply</title>

<defs>
	<filter id="melange">
		<feTurbulence type="turbulence"
			baseFrequency="0.05 0.15" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0 0 0
					0 0 0.3 0 0
					0 0 1 0 0.8
					0 0 0 1 0" result="textureEau"/>
		<feBlend mode="multiply" in="SourceGraphic" in2="textureEau"/>
	</filter>
</defs>

<text x="200" y="120" style="fill:yellowgreen">SVGround</text>

<text x="200" y="240" style="fill:black">SVGround</text>

</svg>

]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	filter:url(feBlend-multiply.svg#melange);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feBlend-multiply.svg">feBlend multiply</object>
</div>

<h4>Avec le mot-clé <span class="attribute">screen</span></h4>

<p>Ici, le pixel résultant sera la somme des deux pixels d’entrée moins leur produit. L’opacité n’est pas prise en compte.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feBlend-screen.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feBlend screen</title>

<defs>
	<filter id="melange">
		<feTurbulence type="turbulence"
			baseFrequency="0.05 0.15" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0 0 0
					0 0 0.3 0 0
					0 0 1 0 0.8
					0 0 0 1 0" result="textureEau"/>
		<feBlend mode="screen" in="SourceGraphic" in2="textureEau"/>
	</filter>
</defs>

<text x="200" y="120" style="fill:yellowgreen">SVGround</text>

<text x="200" y="240" style="fill:black">SVGround</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	filter:url(feBlend-screen.svg#melange);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feBlend-screen.svg">feBlend screen</object>
</div>

<h4>Avec le mot-clé <span class="attribute">darken</span></h4>

<p>Avec <span class="attribute">darken</span>, c’est le pixel le plus sombre des deux images d’entrée qui est sélectionne. Ce mot-clé a donc tendance à assombrir les images.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feBlend-darken.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feBlend darken</title>

<defs>
	<filter id="melange">
		<feTurbulence type="turbulence"
			baseFrequency="0.05 0.15" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0 0 0
					0 0 0.3 0 0
					0 0 1 0 0.8
					0 0 0 1 0" result="textureEau"/>
		<feBlend mode="darken" in="SourceGraphic" in2="textureEau"/>
	</filter>
</defs>

<text x="200" y="120" style="fill:yellowgreen">SVGround</text>

<text x="200" y="240" style="fill:black">SVGround</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	filter:url(feBlend-darken.svg#melange);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feBlend-darken.svg">feBlend darken</object>
</div>

<h4>Avec le mot-clé <span class="attribute">lighten</span></h4>

<p>Enfin, le mot-clé <span class="attribute">lighten</span> réalise l’inverse de <span class="attribute">darken</span> : il sélectionne le pixel le plus clair des deux.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feBlend-lighten.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feBlend lighten</title>

<defs>
	<filter id="melange">
		<feTurbulence type="turbulence"
			baseFrequency="0.05 0.15" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0 0 0
					0 0 0.3 0 0
					0 0 1 0 0.8
					0 0 0 1 0" result="textureEau"/>
		<feBlend mode="lighten" in="SourceGraphic" in2="textureEau"/>
	</filter>
</defs>

<text x="200" y="120" style="fill:yellowgreen">SVGround</text>

<text x="200" y="240" style="fill:black">SVGround</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	filter:url(feBlend-lighten.svg#melange);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feBlend-lighten.svg">feBlend lighten</object>
</div>

<h3 id="comp">Composition</h3>

<h4>Introduction, coordonnées du filtre</h4>

<p>Il est possible d’appliquer différents opérateur arithmétiques avec la primitive <span class="balise">feComposite</span>. On utilisera l’attribut <span class="attribute">operator</span> qui prendra une des valeurs suivantes : <span class="attribute">over</span> (valeur par défaut), <span class="attribute">in</span>, <span class="attribute">out</span>, <span class="attribute">atop</span>, <span class="attribute">xor</span>, <span class="attribute">arithmetic</span>. Comme pour le mélange, il y a deux image d’entrée qu’on indique grâce à <span class="attribute">in</span> et <span class="attribute">in2</span> à la différence qu’ici, <strong>l’ordre à son importance</strong>. Pour faire simple, l’image renseigné par <span class="attribute">in</span> est au-dessus de celle renseignée par <span class="attribute">in2</span>.</p>

<p>Dans la suite nous prendrons cet exemple. L’attribut <span class="attribute">over</span> ne fait rien que dessiner la première image sur la seconde.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComposite.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feComposite avec l’opérateur over</title>

<defs>
	<filter id="comp" filterUnits="userSpaceOnUse"
		x="100" y="20" width="300" height="260">
		<feFlood flood-color="yellowgreen" result="fond"
			x="200" y="20" width="120" height="260"/>
		<feComposite operator="over"
			in="SourceGraphic" in2="fond"/>
	</filter>
</defs>

<text x="200" y="140">SVGround</text>

</svg>

]]></div>

<div class="csscode"><![CDATA[text{
	filter:url(feComposite.svg#comp);
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	fill:black;
	}

rect{
	fill:yellowgreen;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComposite.svg">feComposite avec l’opérateur over</object>
</div>

<p>La première image est le texte (entrée du filtre) et la seconde un rectangle obtenu avec <span class="balise">feFlood</span>.</p>

<p>Cet exemple est le prétexte pour vous introduire de nouveaux attributs pour l’élément <span class="balise">filter</span>.</p>

<p>Jusqu’ici nous avons utilisé la valeur <span class="attribute">objectBoundingBox</span> de l’attribut <span class="attribute">filterUnits</span>. De ce fait, le filtre était appliqué sur la boîte englobant l’élément filtré, ou plus exactement une boîte 10% plus grande que la boîte englobante. Ainsi, on peut faire un petit décalage avec <span class="balise">feOffset</span> sans dépasser du filtre. Par défaut, les valeurs sont <span class="attribute">x="-10%" y="-10%" width="120%" height="120%"</span>. Vous pouvez bien sûr modifier ces attributs, et c’est parfois nécessaire (par exemple si on veut faire un décalage de plus de 10%).</p>

<p>Dans l’exemple précédent, j’ai utilisé <span class="attribute">userSpaceOnUse</span> à la place d’<span class="attribute">objectBoundingBox</span>. Dans ce cas, le système de coordonnées n’est plus fonction de la taille de la boîte englobante mais il s’agit du système de coordonnées de l’élément <span class="balise">svg</span>, c’est à dire celui dont on se sert habituellement. C’est pourquoi le bout gauche du filtre est tronqué.</p>

<p>Observons maintenant ce qui se passe avec les différents opérateurs.</p>

<h4>Avec l’opérateur <span class="attribute">in</span></h4>

<p>Avec l’opérateur <span class="attribute">in</span>, le résultat est la partie de la première image qui se trouve dans la second image :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComposite-in.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feComposite avec l’opérateur in</title>

<defs>
	<filter id="comp" filterUnits="userSpaceOnUse"
		x="100" y="20" width="300" height="260">
		<feFlood flood-color="yellowgreen" result="fond"
			x="200" y="20" width="120" height="260"/>
		<feComposite operator="in"
			in="SourceGraphic" in2="fond"/>
	</filter>
</defs>

<text x="200" y="140">SVGround</text>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	filter:url(feComposite.svg#comp);
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	fill:black;
	}

rect{
	fill:yellowgreen;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComposite-in.svg">feComposite avec l’opérateur in</object>
</div>



<h4>Avec l’opérateur <span class="attribute">out</span></h4>

<p>Son inverse est l’opérateur <span class="attribute">out</span> : le résultat est la partie de la première image <strong>qui n’est pas</strong> dans la seconde image.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComposite-out.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feComposite avec l’opérateur out</title>

<defs>
	<filter id="comp" filterUnits="userSpaceOnUse"
		x="100" y="20" width="300" height="260">
		<feFlood flood-color="yellowgreen" result="fond"
			x="200" y="20" width="120" height="260"/>
		<feComposite operator="out"
			in="SourceGraphic" in2="fond"/>
	</filter>
</defs>

<text x="200" y="140">SVGround</text>

</svg>

]]></div>

<div class="csscode"><![CDATA[text{
	filter:url(feComposite-out.svg#comp);
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	fill:black;
	}

rect{
	fill:yellowgreen;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComposite-out.svg">feComposite avec l’opérateur out</object>
</div>



<h4>Avec l’opérateur <span class="attribute">atop</span></h4>

<p>Avec <span class="attribute">atop</span>, on sélectionne la partie de la première image au-dessus de la seconde (comme <span class="attribute">in</span>) plus la seconde image.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComposite-atop.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feComposite avec l’opérateur atop</title>

<defs>
	<filter id="comp" filterUnits="userSpaceOnUse"
		x="100" y="20" width="300" height="260">
		<feFlood flood-color="yellowgreen" result="fond"
			x="200" y="20" width="120" height="260"/>
		<feComposite operator="atop"
			in="SourceGraphic" in2="fond"/>
	</filter>
</defs>

<text x="200" y="140">SVGround</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	filter:url(feComposite-atop.svg#comp);
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	fill:black;
	}

rect{
	fill:yellowgreen;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComposite-atop.svg">feComposite avec l’opérateur atop</object>
</div>


<h4>Avec l’opérateur <span class="attribute">xor</span></h4>

<p>L’opérateur <span class="attribute">xor</span> très connu fait ce qu’il indique : il sélectionne la partie de la première image qui n’est pas dans la seconde et la partie de la seconde image qui n’est pas dans la première.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComposite-xor.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feComposite avec l’opérateur xor</title>

<defs>
	<filter id="comp" filterUnits="userSpaceOnUse"
		x="100" y="20" width="300" height="260">
		<feFlood flood-color="yellowgreen" result="fond"
			x="200" y="20" width="120" height="260"/>
		<feComposite operator="xor"
			in="SourceGraphic" in2="fond"/>
	</filter>
</defs>

<text x="200" y="140">SVGround</text>

</svg>

]]></div>

<div class="csscode"><![CDATA[text{
	filter:url(feComposite-xor.svg#comp);
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	fill:black;
	}

rect{
	fill:yellowgreen;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComposite-xor.svg">feComposite avec l’opérateur xor</object>
</div>


<h4>Avec l’opérateur <span class="attribute">arithmetic</span></h4>

<p>Ce dernier opérateur est générique car il nous permet de mélanger les deux images à notre guise, avec les attributs <span class="attribute">k1</span>, <span class="attribute">k2</span>, <span class="attribute">k3</span> et <span class="attribute">k4</span>. Le résultat est donné selon la formule : 
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <mi>result</mi>
  <mo>=</mo>
  <mi>k1</mi>
  <mo>×</mo>
  <mi>i1</mi>
  <mo>×</mo>
  <mi>i2</mi>
  <mo>+</mo>
  <mi>k2</mi>
  <mo>×</mo>
  <mi>i1</mi>
  <mo>+</mo>
  <mi>k3</mi>
  <mo>×</mo>
  <mi>i2</mi>
  <mo>+</mo>
  <mi>k4</mi>
</math> où <span class="attribute">i1</span> est le pixel de la première image et <span class="attribute">i2</span> le pixel de la seconde image. On voit donc que</p>

<ul class="list-attributes">
<li><span class="attribute">k1</span> prend en compte les deux images. De plus si une des deux entrées est à 0, on obtient 0 ;</li>
<li><span class="attribute">k2</span> ne concerne que la première image, celle du dessus ;</li>
<li><span class="attribute">k3</span> ne concerne que la seconde image, celle du dessous ;</li>
<li><span class="attribute">k4</span> est une sorte de biais. Comme d’habitude, une valeur grande éclaircira l’image.</li>
</ul>

<p>Testons cet opérateur :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="feComposite-arithmetic.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

<title>feComposite avec l’opérateur arithmetic</title>

<defs>
	<filter id="comp" filterUnits="userSpaceOnUse"
		x="100" y="20" width="300" height="260">
		<feFlood flood-color="yellowgreen" result="fond"
			x="200" y="20" width="120" height="260"/>
		<feComposite operator="arithmetic"
		k1="0.5" k2="0.3" k3="0.2" k4="0"
			in="SourceGraphic" in2="fond"/>
	</filter>
</defs>

<text x="200" y="140">SVGround</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	filter:url(feComposite-arithmetic.svg#comp);
	text-anchor:middle;
	font-size:70px;
	font-weight:bold;
	fill:black;
	}

rect{
	fill:yellowgreen;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/feComposite-arithmetic.svg">feComposite avec l’opérateur arithmetic</object>
</div>

<p>On a bien 30% du texte (<span class="attribute">k2</span>), 20% du rectangle (<span class="attribute">k3</span>) et 40% de plus là où il y a les deux images à la fois (<span class="attribute">k1</span>).</p>

<h3 id="éclairage">Effets d’éclairage</h3>

<p>À venir.</p>

<h3 id="deplace">feDisplacementMap</h3>

<p>À venir.</p>

<h3 id="example">Exemple de filtre évolué</h3>

<p>En chaînant les différentes primitives, on peut obtenir des filtres très puissants et en même temps génériques. Nous allons voir comment arriver à ce résultat :</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.svg">Un filtre évolué</object>
</div>


<p>On reprend le rendu obtenu par turbulence (l’eau) mais on change les couleurs pour avoir du jaune-orange.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="filtre-texte.css" charset="utf-8"?>
<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gros filtre</title>

<defs>
	<filter id="filtre-texte">
		<feTurbulence type="turbulence"
			baseFrequency="0.20 0.06" numOctaves="2"/>
		<feColorMatrix type="matrix"
			values="
				0 0 0.3 0 1
				0 0 0.5 0 0.2
				0 0 0 0 0
				0 0 0 1 0.7"/>
	</filter>
</defs>



<text x="200" y="180" filter="url(#filtre-texte)">SVGround</text>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.etape1.svg">Un filtre évolué, étape 1</object>
</div>

<p>Ensuite, on compose avec l’opérateur <span class="attribute">in</span> le résultat précédent (les primitives qui ont un attribut <span class="attribute">in</span> prennent par défaut le résultat de la primitive précédente) et le texte en entrée (<span class="attribute">SourceGraphic</span>).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="filtre-texte.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gros filtre</title>

<defs>
	<filter id="filtre-texte">
		<feTurbulence type="turbulence"
			baseFrequency="0.20 0.06" numOctaves="2"/>
		<feColorMatrix type="matrix"
				values="
					0 0 0.3 0 1
					0 0 0.5 0 0.2
					0 0 0 0 0
					0 0 0 1 0.7"/>
		<feComposite operator="in"
			in2="SourceGraphic"/>
	</filter>
</defs>



<text x="200" y="180" filter="url(#filtre-texte)">SVGround</text>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.etape2.svg">Un filtre évolué, étape 2</object>
</div>

<p>On mélange ensuite le résultat obtenu avec l’image d’entrée. Là, j’avoue qu’on ne voit pas trop la différence…</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="filtre-texte.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gros filtre</title>

<defs>
	<filter id="filtre-texte">
		<feTurbulence type="turbulence"
			baseFrequency="0.20 0.06" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0.3 0 1
					0 0 0.5 0 0.2
					0 0 0 0 0
					0 0 0 1 0.7"/>
		<feComposite operator="in"
			in2="SourceGraphic"/>
		<feBlend mode="lighten" in2="SourceGraphic"/>
	</filter>
</defs>



<text x="200" y="180" filter="url(#filtre-texte)">SVGround</text>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.etape3.svg">Un filtre évolué, étape 3</object>
</div>

<p>Avec une matrice de convolution, on effectue un détection de contour. On sauvegarde le résultat de cette primitive dans <span class="attribute">txt</span> pour usage ultérieur.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="filtre-texte.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gros filtre</title>

<defs>
	<filter id="filtre-texte">
		<feTurbulence type="turbulence"
			baseFrequency="0.20 0.06" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0.3 0 1
					0 0 0.5 0 0.2
					0 0 0 0 0
					0 0 0 1 0.7"/>
		<feComposite operator="in"
			in2="SourceGraphic"/>
		<feBlend mode="lighten" in2="SourceGraphic"/>
		<feConvolveMatrix
			kernelMatrix="-1 -1 -1
						-1  6 -1
						-1 -1 -1" result="txt"/>
	</filter>
</defs>



<text x="200" y="180" filter="url(#filtre-texte)">SVGround</text>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.etape4.svg">Un filtre évolué, étape 4</object>
</div>

<p>À partir de l’image d’entrée, on crée un flou que l’on décale. On sauvegarde le résultat dans <span class="attribute">flou</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="filtre-texte.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gros filtre</title>

<defs>
	<filter id="filtre-texte">
		<feTurbulence type="turbulence"
			baseFrequency="0.20 0.06" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0.3 0 1
					0 0 0.5 0 0.2
					0 0 0 0 0
					0 0 0 1 0.7"/>
		<feComposite operator="in"
			in2="SourceGraphic"/>
		<feBlend mode="lighten" in2="SourceGraphic"/>
		<feConvolveMatrix
			kernelMatrix="-1 -1 -1
						-1  6 -1
						-1 -1 -1" result="txt"/>
		<feGaussianBlur in="SourceAlpha" stdDeviation="1.5"/>
		<feOffset dx="3" dy="3" result="flou"/>
	</filter>
</defs>



<text x="200" y="180" filter="url(#filtre-texte)">SVGround</text>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.etape5.svg">Un filtre évolué, étape 5</object>
</div>

<p>Enfin, on fusionne les deux résultats intermédiaires et le tour est joué !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="filtre-texte.css" charset="utf-8"?>

<svg version="1.1" baseProfile="full" width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" onload="">

<title>Gros filtre</title>

<defs>
	<filter id="filtre-texte">
		<feTurbulence type="turbulence"
			baseFrequency="0.20 0.06" numOctaves="2"/>
			<feColorMatrix type="matrix"
				values="
					0 0 0.3 0 1
					0 0 0.5 0 0.2
					0 0 0 0 0
					0 0 0 1 0.7"/>
		<feComposite operator="in"
			in2="SourceGraphic"/>
		<feBlend mode="lighten" in2="SourceGraphic"/>
		<feConvolveMatrix
			kernelMatrix="-1 -1 -1
						-1  6 -1
						-1 -1 -1" result="txt"/>
		<feGaussianBlur in="SourceAlpha" stdDeviation="1.5"/>
		<feOffset dx="3" dy="3" result="flou"/>
		<feMerge>
			<feMergeNode in="flou"/>
			<feMergeNode in="txt"/>
		</feMerge>
	</filter>
</defs>



<text x="200" y="180" filter="url(#filtre-texte)">SVGround</text>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/filtre-texte.svg">Un filtre évolué, étape finale</object>
</div>



<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!--
<span class="attribute"></span>
<span class="balise"></span>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textArea.css" charset="utf-8"?>

]]></div>

<div class="csscode"><![CDATA[]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/filtres/"></object>
</div>
-->


<div class="previouspage"><a href="clip-et-mask.php" title="cours précédent">Clip/mask</a></div>
<div class="nextpage"><a href="viewbox-et-ratio.php" title="cours suivant">Ratio, symboles</a></div>


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
