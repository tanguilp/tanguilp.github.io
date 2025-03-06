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
<h2>Clip/Mask</h2>

<p>Je reprends l’écriture de ce tutoriel plusieurs années après l’avoir commencé. Les visionneurs SVG de référence sont maintenant Gecko (moteur de rendu de Firefox) et surtout Opera (qui gère même les animations !). Nous reprenons donc avec la technique du découpage (clip) et du masquage (mask). La technique du découpage permet de dire que l’on veut dessiner une forme SVG seulement dans un espace restreint, décrit par des formes SVG (formes de bases, chemins et même textes !). La technique du masquage est plus fine. On affiche une forme SVG selon la valeur de transparence du masque. Si le masque est opaque à un endroit donné, la forme sera affiché mais s’il est transparent, la forme ne sera pas affichée.</p>


<ul class="sommaire">
<li><a href="#découp">Le découpage</a></li>
<li><a href="#masques">Les masques</a></li>
</ul>


<h3 id="découp">Le découpage</h3>

<p>Le découpage permet de n’afficher du SVG uniquement s’il est situé dans la zone de découpage, qui est elle même un ensemble de formes SVG : formes de bases, tracés et texte.</p>

<p>Pour cela, on définit d’abord le découpage (dans <span class="balise">defs</span> évidemment) grâce à l’élément <span class="balise">clipPath</span>. On inclut dans cet élément (identifié par un… identifiant !) les différentes formes qui constituent notre découpe. Ensuite, on utilise la propriété CSS <span class="csspropertie">clip-path</span> pour indiquer qu’on veut appliquer cette découpe sur une portion de dessin SVG.</p>

<p>Appliquons une découpe sur une image :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="clipPath.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation d’une découpe grâce à l’élément clipPath</title>

<defs>
	<!-- définition de la découpe -->
	<clipPath id="decoupe">
		<circle cx="300" cy="100" r="90"/>
		<text x="200" y="270">SVGround</text>
	</clipPath>
</defs>

<image xlink:href="clipPath.jpg" width="400" height="300"/>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:75px;
	}

image{
	/* on définie la découpe utilisée */
	clip-path:url(clipPath.svg#decoupe);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/clip-et-mask/clipPath.svg">Une découpe sur une image</object>
</div>

<p>La découpe ne fonctionne pas uniquement sur les images : ça fonctionne sur toutes les formes SVG et même sur les groupes de formes (les fameux <span class="balise">g</span>).</p>

<p>On peut aussi animer les formes composant la découpe. Essayez, on peut faire plein de choses amusantes !</p>

<p>Le seul problème qu’on peut constater, c’est que la taille des formes de la découpe sont fixes. Il faut donc connaître la taille de la forme sur laquelle on veut appliquer la découpe avant de l’effectuer. Vous vous souvenez de <span class="attribute">objectBoundingBox</span> ? Et bien cette valeur va encore nous servir ! Elle permet de spécifier, grâce à l’attribut <span class="attribute">clipPathUnits</span>, que la découpe s’effectue par rapport à la plus grandes boîte englobant la cible de la découpe. On a donc une découpe qui s’adapte à la taille de sa cible et on doit par conséquent spécifier les coordonnées des formes en pourcentages.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="clipPathUnits.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Découpe s’ajustant à la taille de l’objet sur lequel elle est appliquée</title>

<defs>
	<!-- définition de la découpe -->
	<clipPath id="decoupe" clipPathUnits="objectBoundingBox">
		<!-- on note que 0.05 = 5% ! -->
		<rect x="0.05" y="0.05" width="0.9" height="0.9" rx="0.2" ry="0.2"/>
	</clipPath>
</defs>

<image xlink:href="window-horizontal.jpg" x="10" y="10" width="180" height="120"/>

<image xlink:href="window-vertical.jpg" x="210" y="10" width="180" height="270"/>

</svg>]]></div>

<div class="csscode"><![CDATA[image{
	clip-path:url(clipPathUnits.svg#decoupe);
	}]]></div>

<div class="object-example">


<object type="image/svg+xml" data="images/cours/clip-et-mask/clipPathUnits.svg">Découpe s’ajustant à la taille de l’objet sur lequel elle est appliquée</object>
</div>

<p>Vous pouvez donc créer des cadres réutilisables, quelle que soit la taille de vos photos.</p>


<p>Les découpes fonctionnent de manière binaire : soit on affiche le point (s’il est dans la zone de découpe), sinon on ne l’affiche pas. Il existe un moyen plus fin qui se servent de l’opacité pour dessiner plus ou moins un dessin : les masques.</p>

<h3 id="masques">Les masques</h3>

<p class="rappel">Une couleur CSS a quatre composantes : le rouge, le vert, le bleu et l’opacité (ou canal alpha). D’ou la notation RGBA : Red, Green, Blue, Alpha).</p>

<p>Les masques utilisent principalement le canal alpha pour déterminer comment est affiché un pixel, mais pas seulement. On doit commencer par remplir l’élément <span class="balise">mask</span> de formes (formes de base, tracés <span class="balise">path</span> et texte) : ces formes définiront notre masques. Seulement, on doit aussi spécifier des valeurs de couleur et d’opacité pour ces formes.</p>

<p>Il y a différentes manières de définir l’opacité d’un dessin :</p>

<ul class="list-css-values">
<li><span class="csspropertie">fill-opacity</span> et <span class="csspropertie">stroke-opacity</span> pour l’opacité du remplissage et du contour d’une forme ;</li>
<li><span class="csspropertie">stop-opacity</span> pour définir l’opacité d’un dégradé ;</li>
<li><span class="csspropertie">opacity</span> qui permet de définir l’opacité d’une forme ou d’un groupe de formes.</li>
</ul>

<p>Nous utiliserons les deux premières manières de décrire l’opacité, la troisième étant un masque spécifique.</p>

<p>Le principe est simple et très semblable aux découpes. Si à un endroit donné, le masque est opaque, alors le pixel en dessous est dessiné à l’identique. Si à un endroit donné, le masque est transparent (ou non opaque), le pixel en dessous n’est pas dessiné. C’est très semblable au découpage jusque là. Sauf que si à un endroit donné, le masque est transparent à 50%, alors le pixel en-dessous sera dessiné avec une opacité de 50%.</p>

<p>J’ai dit que les masques n’utilisaient pas seulement la composante alpha (bref, l’opacité) pour déterminer l’opacité général d’un point précis d’un masque. En fait, SVG utilise aussi les trois couleurs (rouge, vert, bleu), mais avec des coefficients différents puisque l’oeil ne voit pas la luminosité des ces trois couleurs de la même façon. Mais pour ne pas nous compliquer la vie, nous utiliserons du blanc et seulement du blanc.</p>

<p>Dans l’exemple suivant, on applique un masque composé de petits carrés sur une image. On fait décroître l’opacité des carrés (l’intérieur seulement, les bords restent opaques) et l’image va progressivement devenir opaque et sa couleur va se mélanger avec ce qu’il y a derrière. Et derrière, c’est plus blanc que blanc <object type="image/gif" data="images/smileys/biggrin.gif">:D</object> !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="mask.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Création et utilisation d’un masque</title>

<defs>
	<!-- on définit un carré de 100px par 100px qu’on réutilisera dans notre masque -->
	<rect id="carré" width="100" height="100"/>

	<!-- définition du masque -->
	<mask id="masque">
		<use xlink:href="#carré" transform="translate(0, 0)" fill-opacity="1"/>
		<use xlink:href="#carré" transform="translate(100, 0)" fill-opacity="0.95"/>
		<use xlink:href="#carré" transform="translate(200, 0)" fill-opacity="0.90"/>
		<use xlink:href="#carré" transform="translate(300, 0)" fill-opacity="0.8"/>
		<use xlink:href="#carré" transform="translate(0, 100)" fill-opacity="0.7"/>
		<use xlink:href="#carré" transform="translate(100, 100)" fill-opacity="0.6"/>
		<use xlink:href="#carré" transform="translate(200, 100)" fill-opacity="0.5"/>
		<use xlink:href="#carré" transform="translate(300, 100)" fill-opacity="0.4"/>
		<use xlink:href="#carré" transform="translate(0, 200)" fill-opacity="0.3"/>
		<use xlink:href="#carré" transform="translate(100, 200)" fill-opacity="0.2"/>
		<use xlink:href="#carré" transform="translate(200, 200)" fill-opacity="0.1"/>
		<use xlink:href="#carré" transform="translate(300, 200)" fill-opacity="0"/>
	</mask>
</defs>

<image xlink:href="clipPath.jpg" width="400" height="300"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#carré{
	fill:white;
	stroke:white;
	stroke-width:5px;
	/* l’opacité par défaut est 1, et le restera pour stroke */
	}

image{
	mask:url(mask.svg#masque);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/clip-et-mask/mask.svg">Création et utilisation d’un masque en SVG</object>
</div>

<p>Mais le plus intéressant reste de combiner deux images en utilisant un dégradé. On utilise dans ce cas la propriété CSS <span class="csspropertie">stop-opacity</span> pour définir l’opacité.</p>

<p>Nous allons utiliser une image d’<a href="images/cours/clip-et-mask/building.jpg">immeubles</a> et par dessus une image d’<a href="images/cours/clip-et-mask/ocean.jpg">océan</a>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="mask2.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Combinaison de deux images grâce à un masque</title>

<defs>
	<!-- définition du dégradé qui nous servira pour le filtre -->
	<!-- on joue sur l’opacité -->
	<linearGradient id="degrade" x1="0%" y1="0%" x2="0%" y2="100%">
		<!--correspond au haut de l’image sur l’axe vertical -->
		<stop id="stop1" offset="0%"/>
		<!-- un peu plus du milieu de l’image -->
		<stop id="stop2" offset="70%"/>
		<!-- fin de l’image -->
		<stop id="stop3" offset="100%"/>
	</linearGradient>

	<!-- définition du masque -->
	<mask id="masque">
		<rect width="400" height="300" style="fill:url(#degrade)"/>
	</mask>
</defs>

<image xlink:href="building.jpg" width="400" height="300"/>

<image id="imageToMask" xlink:href="ocean.jpg" width="400" height="300" preserveAspectRatio="none"/>

</svg>]]></div>

<div class="csscode"><![CDATA[stop{
	/* on fixe la couleur en blanc pour tous les <stop/> */
	stop-color:white;
	}

/* on ne voit pas l’image du dessus */
#stop1, #stop2{
	stop-opacity:0;
	}

/* on voit l’image du dessus */
#stop3, #stop4{
	stop-opacity:1;
	}

#imageToMask{
	mask:url(mask2.svg#masque);
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/clip-et-mask/mask2.svg">Combinaison de deux images grâce à un masque</object>
</div>



<p>Bien sûr, comme pour les découpes, il existe un moyen de dire que l’on veut travailler dans la boîte englobant l’objet sur lequel on applique le masque. Vous me suivez ? En fait c’est simple. Si on place l’attribut <span class="attribute">maskContentUnits</span> à la valeur <span class="attribute">objectBoundingBox</span> (la valeur par défaut est <span class="attribute">userSpaceOnUse</span>), alors les formes qui vont décrire notre masque auront des coordonnées exprimées en pourcentage de la boîte englobante (quand je parle de boîte englobante, il s’agit évidemment du plus petit rectangle contenant la forme sur laquelle on applique le masque). On peut donc reprendre notre exemple de tout à l’heure :</p>


<div class="xmlcode">&lt;?xml version="1.0" encoding="utf-8"?>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="maskContentUnits.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Masque s’ajustant à la taille de l’objet sur lequel il est appliqué</title>

<defs>
	<radialGradient id="degrade_du_masque">
		<stop offset="0%" id="stop1"/>
		<stop offset="65%" id="stop2"/>
		<stop offset="100%" id="stop3"/>
	</radialGradient>

	<!-- définition de la découpe -->
	<mask id="masque" maskContentUnits="objectBoundingBox">
		<ellipse cx="0.5" cy="0.5" rx="0.5" ry="0.5"/>
	</mask>
</defs>

<image xlink:href="window-horizontal.jpg" x="10" y="10" width="180" height="120"/>

<image xlink:href="window-vertical.jpg" x="210" y="10" width="180" height="270"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#masque ellipse
	{
	/* on applique le dégradé au masque */
	fill:url(maskContentUnits.svg#degrade_du_masque);
	}

image{
	mask:url(maskContentUnits.svg#masque);
	}

stop{
	stop-color:white;
	}

#stop1{
	stop-opacity:1;
	}

#stop2{
	stop-opacity:0.5;
	}

#stop3{
	stop-opacity:0;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/clip-et-mask/maskContentUnits.svg">Masque s’ajustant à la taille de l’objet sur lequel il est appliqué</object>
</div>

<p>Nous avons fait le tour de ce sujet fascinant (si, si <object type="image/gif" data="images/smileys/blink.gif">O,o</object>) que sont les découpes et les masques. Ils vous seront très utiles alors mêmes s’il ne sont pas forcément facile à appréhender, ne les oubliez pas !</p>

<p>Maintenant, vous allez devoir vous accrochez. Nous allons entrer dans un chapitre qui est une spécificité de SVG, qui est long et encore plus difficile : les filtres !</p>

<div class="previouspage"><a href="degrades.php" title="cours précédent">Les dégradés</a></div>
<div class="nextpage"><a href="filtres.php" title="cours suivant">Les filtres</a></div>

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
