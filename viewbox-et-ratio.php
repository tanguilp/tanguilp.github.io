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

<h2>viewBox, conservation du ratio, symboles et autres gourmandises</h2>


<ul class="sommaire">
<li><a href="#zdd">La zone de dessin</a></li>
<li><a href="#cdr">Contrôle du ratio</a></li>
<li><a href="#symb">Symboles</a></li>
<li><a href="#vues">Les vues SVG</a></li>
</ul>


<h3 id="zdd">La zone de dessin</h3>

<p>Tout d’abord, sachez que depuis le début de ce cours, je vous trompe. Les plus curieux d’entre vous l’auront sans doute remarqué en regardant le code source des exemples : ce n’est pas le même code source que ce que j’ai recopié sur ces pages. En effet, vous avez dû remarquer que les exemples affichés en SVG tiennent miraculeusement bien dans les cadres prévus à cet effet. Ni trop grands, ni trop petits, ils tiennent pile-poil dans l’espace prévu ! Cette fonctionnalité que j’ai préféré vous cacher car elle est un peu compliquée à comprendre est vraiment très très utile. La preuve : je vous bluffe depuis le début <object type="image/gif" data="images/smileys/001_cool.gif">B-)</object>.</p>

<p>À vrai dire le coup de bluff n’est pas très difficile puisqu’une seule ligne de code SVG change, et c’est la première :</p>

<div class="xmlcode"><![CDATA[<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">]]></div>

<p>devient</p>

<div class="xmlcode"><![CDATA[<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">
]]></div>

<p>ce qui est légèrement différent !</p>

<p>Avant de vous expliquer tout ça, reprenons dès le début. Lorsqu’on faisait </p>

<div class="xmlcode"><![CDATA[<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">]]></div>

<p>on pense demander un document SVG de largeur 400 pixels (le pixel est l’unité par défaut) et de 300 pixels de hauteur. Et on a tout à fait raison ! Mais comme par hasard, la zone dans laquelle nous dessinons (quand on fait <span class="balise"><![CDATA[rect x="12" y="50" width="7000" height="10"]]></span>) mesure 400 sur 300… Étrange <object type="image/gif" data="images/smileys/huh.gif">:|</object>.</p>

<p>En fait, point de complot. D’ailleurs, ce comportement est celui auquel on s’attend. Mais SVG permet quelque chose de bien plus puissant et flexible : on peut demander à ce que la taille réelle du dessin SVG soit différente des coordonnées de la zone de dessin. La taille réelle du dessin SVG sera exprimée grâce aux attributs <span class="attribute">width</span> et <span class="attribute">height</span> que vous connaissez déjà, alors que la zone de dessin sera déterminée par la valeur de l’attribut <span class="attribute">viewBox</span>. Ensuite, <strong>absolument toutes</strong> les coordonnées données dans la suite du document seront fixées dans les coordonnées de la zone de dessin, donc par la fameuse <span class="attribute">viewBox</span>. Les valeurs de <span class="attribute">width</span> et de <span class="attribute">height</span> n’ont plus aucune importance. L’attribut <span class="attribute">viewBox</span> doit préciser quatre valeur (sans unités) : le point x minimum, le point y minimum, la largeur et la hauteur.</p>

<p>À quoi ça sert ? Et bien dans beaucoup de cas, ça simplifie grandement les choses. Imaginez que vous voulez coder une carte de votre ville en SVG. Le choix le plus judicieux pour n’importe système de cartographie est d’utiliser les coordonnées GPS. Mais imaginez que vous voulez en même temps avoir une taille fixe pour votre plan : 400 pixels sur 300. Il suffit d’utiliser ces mesures pour la taille réelle du dessin SVG (les attributs <span class="attribute">width</span> et <span class="attribute">height</span>) et de spécifier une <span class="attribute">viewBox</span> dans le système de coordonnées du GPS :</p>

<div class="xmlcode"><![CDATA[<svg width="400px" height="300px" viewBox="-48 -1.7 0.4 0.3"
xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">]]></div>

<p>Second exemple : imaginez que vous écrivez un cours sur SVG (tiens tiens <object type="image/gif" data="images/smileys/sweatdrop.gif">^^'</object>) et qu’une des caractéristique du site sur lequel vous le publiez est d’avoir un design extensible, c’est à dire qui s’adapte à la taille de l’écran. Dans ce cas, les exemples en SVG doivent aussi s’adapter à la taille de leur conteneur (un <span class="balise">object</span> spécifié en pourcentage). Dans ce cas, le coup de génie est d’utiliser tout simplement une largeur et une hauteur de 100%, et de spécifier une <span class="attribute">viewBox</span> adaptée à nos besoin. Dans l’exemple suivant, le point d’origine (0, 0) ne se trouve plus, comme d’habitude, en haut à gauche mais au milieu :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="viewbox.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" viewBox="-20 -15 40 30"
xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Une viewBox centrée en zéro</title>

<circle cx="0" cy="0" r="10"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:none;
	stroke:blue;
	stroke-width:1;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/viewbox.svg">Une viewBox centrée en zéro</object>
</div>

<p>Remarquer que le ratio est ici de 4/3 pour la taille réelle du dessin (400px/300px) et également de 4/3 pour la zone de dessin en coordonnées utilisateur (40/30 de la viewBox). Mais que se passe-t-il si ce ratio ne coïncide pas ?</p>

<h3 id="cdr">Contrôle du ratio</h3>

<p>La réponse est qu’on décide entre trois scénarii :</p>

<ul class="list-attributes">
<li>on peut étirer ce qu’on a dessiné dans la viewBox afin d’arriver à remplir la surface dans les deux sens. Cette option ne conserve pas le ratio. Ainsi, un cercle dessiné dans la zone de dessin en coordonnées utilisateur n’apparaîtra pas comme un cercle : il sera étiré ;</li>
<li>on étire le dessin jusqu’à ce qu’il tienne entièrement dans la zone décrite par les attributs <span class="attribute">width</span> et <span class="attribute">height</span>, sans dépasser et en conservant le ratio ;</li>
<li>troisième méthode : … hmmm mieux vaut, dans ce cas, un petit dessin <object type="image/gif" data="images/smileys/sweatdrop.gif">^^'</object>.</li>
</ul>

<p>L’attribut permettant de contrôler ce comportement est <span class="attribute">preserveAspectRatio</span>.</p>

<h4><span class="attribute">preserveAspectRatio</span> à <span class="attribute">none</span></h4>

<p>Rien de plus simple quand <span class="attribute">preserveAspectRatio</span> est fixé à la valeur <span class="attribute">none</span> : le dessin est étiré de manière à remplir tout l’espace disponible. Voici un exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="preserveAspectRatioNone.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none"
xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>preserveAspectRatio fixé à la valeur none</title>

<!-- bordure -->
<rect width="100" height="100"/>

<circle cx="50" cy="50" r="40"/>


</svg>
]]></div>

<div class="csscode"><![CDATA[*{
	fill:none;
	stroke:black;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/preserveAspectRatioNone.svg">preserveAspectRatio fixé à la valeur none</object>
</div>

<p>Dans cet exemple, on a <span class="attribute">viewBox="0 0 100 100"</span> et donc la zone de dessin en coordonnées utilisateurs est un carré. On y dessine un cercle en plein milieu. Lors de l’affichage, le dessin réel prend toute la place disponible en hauteur et en largeur, qui n’a presque aucune chance d’être un carré (ou alors votre écran est sacrément bizarre !). Le graphique est alors étiré pour occuper l’espace, et le cercle affiché n’a rien d’un cercle : le ratio n’est pas conservé.</p>

<p>Heureusement il est possible de conserver le ratio, et ce grâce aux spécificateurs <span class="attribute">meet</span> et <span class="attribute">slice</span>.</p>

<h4><span class="attribute">preserveAspectRatio</span> à <span class="attribute">meet</span></h4>

<p>Avec le spécificateur <span class="attribute">meet</span>, le dessin contenu dans la zone de dessin en coordonnées utilisateur (<span class="attribute">viewBox</span>) sera totalement visible. Il est étiré ou rétréci pour tenir dans le dessin SVG en taille réelle, et il a sa taille maximale. Mais il reste une question. Si les ratios ne sont pas les mêmes, il y a forcément rétrécissement ou étirement. Dans ce cas, ou est placé le dessin en coordonnées utilisateur ?</p>

<p>Il faut concaténer deux mots clefs entre :</p>

<ul class="list-attributes">
<li>xMin, xMid, xMax et</li>
<li>YMin, YMid, YMax.</li>
</ul>

<p>Ainsi en reprenant l’exemple précédent mais en remplaçant la valeur de <span class="attribute">preserveAspectRatio</span> par <span class="attribute">xMaxYMid meet</span> on obtient :</p>

<div class="xmlcode"><![CDATA[<svg width="100%" height="100%"
viewBox="0 0 100 100" preserveAspectRatio="xMaxYMid meet"…]]></div>

<div class="csscode"><![CDATA[*{
	fill:none;
	stroke:black;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/preserveAspectRatioMeet.svg">preserveAspectRatio fixé à la valeur meet</object>
</div>

<p>Si le dessin se retrouve à droite, c’est à cause de <span class="attribute">xMax</span>. Si on avait mis <span class="attribute">xMid</span>, le dessin aurait été centré et avec <span class="attribute">xMin</span>, à gauche. Par contre, la valeur <span class="attribute">YMid</span> ne sert à rien ici puisque le dessin SVG est plus large que haut. Mais si ce n’est pas le cas, regardez ce qui se passe (il s’agit de même dessin) :</p>

<div class="object-example" style="width:15em">
<object type="image/svg+xml" data="images/cours/viewbox/preserveAspectRatioMeet.svg">preserveAspectRatio fixé à la valeur meet</object>
</div>

<p>Là c’est le <span class="attribute">YMid</span> qui est utilisé, et le dessin est centré verticalement.</p>

<h4><span class="attribute">preserveAspectRatio</span> à <span class="attribute">slice</span></h4>

<p>Inversez le tout, dites que c’est le zone de dessin à taille réelle qui doit tenir dans la zone de dessin en coordonnées utilisateurs et vous obtenez le spécificateur <span class="attribute">slice</span>. Quoi, ce n’est pas clair ? <object type="image/gif" data="images/smileys/wacko.gif">%)</object></p>

<p>En fait, avec <span class="attribute">slice</span>, le dessin est étiré, sort de la zone de dessin en taille réelle mais en largeur uniquement, ou en hauteur uniquement. Bref, d’une mais pas des deux. On perd donc une partie du dessin, d’ou le nom du spécificateur (slice signifie tranche).  Reprenons les exemples précédents en remplaçant <span class="attribute">meet</span> par <span class="attribute">slice</span> :</p>

<div class="xmlcode"><![CDATA[<svg width="100%" height="100%"
viewBox="0 0 100 100" preserveAspectRatio="xMaxYMid slice"…]]></div>

<div class="csscode"><![CDATA[*{
	fill:none;
	stroke:black;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/preserveAspectRatioSlice.svg">preserveAspectRatio fixé à la valeur slice</object>
</div>

<p>Retournement de situation, ici c’est <span class="attribute">YMid</span> qui est déterminant. Que se passe-t-il lorsque la hauteur est supérieure à la largeur ? Si vous le devinez sans regarder l’exemple, c’est que vous avez tout compris à la conservation du ratio !</p>

<p style="height:20em">…</p>

<div class="object-example" style="width:15em">
<object type="image/svg+xml" data="images/cours/viewbox/preserveAspectRatioSlice.svg">preserveAspectRatio fixé à la valeur slice</object>
</div>

<p>C’est donc bien <span class="attribute">xMax</span> qui détermine la position du cercle. Rien ne vaut un exemple récapitulatif pour toutes les valeurs possibles (celui-ci fait partie de la <a href="http://www.w3.org/Graphics/SVG/Test/20061213/htmlObjectHarness/full-index.html">suite de test de SVG</a> du W3C) :</p>

<div class="object-example" style="height:30em">
<object type="image/svg+xml" data="http://www.w3.org/Graphics/SVG/Test/20061213/svggen/coords-viewattr-01-b.svg">Exemple récapitulatif</object>
</div>

<p class="rappel">Pour ouvrir le document seul dans votre navigateur, clic droit puis « Ce cadre » -> « Afficher ce cadre uniquement » sous Firefox, « Open image » ou « Ouvrir l’image » sous Opera.</p>


<h3 id="symb">Symboles</h3>

<p>Les symboles sont destiné à représenter un modèle qui sera réutilisé souvent dans le document, ou dans d’autres documents, et est voué à être utilisé avec <span class="balise">use</span> puisqu’ils ne sont jamais affichés tel quel. La balise correspondante est <span class="balise">symbol</span> et peut contenir une description (avec <span class="balise">desc</span>). D’ailleurs, c’est mieux !</p>

<p>En plus de tout cela, on utilise les deux attributs <span class="attribute">viewBox</span> et <span class="attribute">preserveAspectRatio</span> respectivement pour fixer la taille de la zone de dessin et le comportement lors de l’utilisation avec <span class="balise">use</span>. En effet, lorsqu’on l’appelle avec cet élément, on doit renseigner les attributs <span class="attribute">width</span> et <span class="attribute">height</span>. Et dans le cas ou le ratio de ces deux attributs n’est pas le même que celui de la <span class="attribute">viewBox</span> du symbole, c’est <span class="attribute">preserveAspectRatio</span> qui détermine le comportement à adopter.</p>

<p>Dessinons grossièrement le symbole d’un avion et utilisons le (les symboles sont très utiles en cartographie) :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="symbol.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid"
xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation d’un symbole</title>


<defs>
	<symbol id="avion" viewBox="-50 0 100 100" preserveAspectRatio="xMidYMid meet">
		<!-- avec cette valeur de preserveAspectRatio,
			le symbole sera toujours centré -->

		<desc>Aéroport</desc>
		<!-- fuselage -->
		<ellipse cx="0" cy="50" rx="8" ry="48"/>

		<!-- ailes -->
		<ellipse cx="0" cy="35" rx="46" ry="6"/>

		<!-- ailerons -->
		<ellipse cx="0" cy="80" rx="19" ry="2"/>
	</symbol>
</defs>

<rect x="10" y="10" width="100" height="100"/>
<use xlink:href="#avion" x="10" y="10" width="100" height="100"/>

<rect x="10" y="180" width="200" height="100"/>
<use xlink:href="#avion" x="10" y="180" width="200" height="100"/>

<rect x="240" y="40" width="100" height="200"/>
<use xlink:href="#avion" x="240" y="40" width="100" height="200"/>

</svg>
]]></div>

<div class="csscode"><![CDATA[rect{
	fill:none;
	stroke:black;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/symbol.svg">Utilisation d’un symbole</object>
</div>

<p>Bien sûr, ce dessin est hideux mais rien ne vous empêche de vous écrire une petite bibliothèque de sigles et de les réutiliser ensuite dans vos documents !</p>

<h3 id="vues">Les vues SVG</h3>

<p>Les vues SVG permettent de modifier le rendu d’un fichier SVG via son URI. Il est notamment possible de redéfinir la <span class="attribute">viewBox</span>, le contrôle du ratio ainsi que d’effectuer des transformation.</p>

<p>Dans la pratique, on ajoute <span class="attribute">#svgView()</span> à la fin du nom de fichier SVG. Il vient entre parenthèses les différentes opérations à effectuer, dont ces trois que nous allons étudier (car ce sont les plus intéressantes) :</p>

<ul class="list-attributes">
<li>viewBox()</li>
<li>preserveAspectRatio()</li>
<li>transform()</li>
</ul>

<p>N’oubliez pas que les espaces ne sont pas autorisés dans les URI, donc utilisez les virgules pour séparer les valeurs numériques.</p>

<p>Prenons un document SVG de référence :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="reference.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Document de référence pour expérimentations de vues SVG</title>

<text x="10" y="30">Coucou !</text>

<polygon points="40,50 220,120 220,40 280,150 220,260 220,180 40,250"/>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:3px;
	}

polygon{
	fill:none;
	stroke:lime;
	stroke-width:4;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/reference.svg">Document de référence pour expérimentations de vues SVG</object>
</div>

<p>Comme vous pouvez le constater, il y a un texte illisible car trop petit en haut à gauche. Changeons la <span class="attribute">viewBox</span> grâce à une vue SVG pour pouvoir le lire. L’URL devient images/cours/viewbox/reference.svg#svgView(viewBox(8,25,40,30)).</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/reference.svg#svgView(viewBox(8,25,40,30))">Changement de viewBox avec une vue SVG</object>
</div>

<p>Il devient tout aussi simple de renverser le dessin, grâce à une simple rotation. L’URL est images/cours/viewbox/reference.svg#svgView(transform(rotate(180,200,150)))</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/reference.svg#svgView(transform(rotate(180,200,150)))">Retournement d’un dessin SVG grâce à une vue SVG</object>
</div>

<p>Enfin on peut enchaîner les différentes possibilités. Prenons cette URI :</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/viewbox/reference.svg#svgView(viewBox(8,25,40,30);transform(skewX(15)))">Plusieurs options pour une vue</object>
</div>

<p>Ce chapitre touche à sa fin mais n’hésitez pas à le relire car c’est assez complexe. Et il serait dommage de passer à côté : c’est vraiment très utile. Dans le prochain chapitre, il est question d’animation et croyez moi, vous aller découvrir des trucs vraiment kewl <object type="image/gif" data="images/smileys/001_cool.gif">B-)</object>.</p>

<div class="previouspage"><a href="filtres.php" title="cours précédent">Les filtres</a></div>
<div class="nextpage"><a href="animations-chapitre-2.php" title="cours suivant">Aller plus loin avec les animations</a></div>


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
