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
<h2>Les motifs de remplissage</h2>

<p>Jusqu’à maintenant, nous n’avons pu remplir nos formes qu’avec une couleur unie. Cela va changer : les deux prochains chapitres
traitent en profondeur des motifs (ou textures) et des dégradés.</p>

<ul class="sommaire">
<li><a href="#pattern">L’élément <span class="balise">pattern</span></a></li>
<li><a href="#baseattr">Les attributs de base</a></li>
<li><a href="#pcu">L’attribut <span class="attribute">patternContentUnits</span></a></li>
<li><a href="#transf">Transformation de motifs</a></li>
<li><a href="#motmot">Des motifs dans des motifs</a></li>
</ul>

<h3 id="pattern">L’élément <span class="balise">pattern</span></h3>

<p>L’élément <span class="balise">pattern</span> sert à définir un motif. Il n’est jamais affiché directement mais nous le
placerons tout de même dans <span class="balise">defs</span> car c’est à cet endroit que viennent se placer les éléments
réutilisables.</p>

<p>Si on veut pouvoir utiliser un <span class="balise">pattern</span>, il faut pouvoir l’identifier grâce à un identifiant.
Il portera donc toujours un attribut <span class="attribute">id</span>.</p>

<p>On peut utiliser un motif pour remplir un objet, c’est à dire avec la propriété CSS <span class="csspropertie">fill</span>,
mais aussi pour remplir la bordure d’un objet, avec <span class="csspropertie">stroke</span>. Au lieu d’un nom de couleur, on écrira :
<span class="csspropertie">url(fichier.svg#identifiant)</span> où l’identifiant désigne un <span class="balise">pattern</span> dans le fichier adéquat (qui n’est pas forcément le même que celui ou l’on dessine, on peut donc facilement réutiliser ses <span class="balise">pattern</span>).
Par exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="maFeuilleDeStyle.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Comment utiliser un motif</title>

<defs>

<pattern id="monMotif">
<!-- ici viendront les formes -->
</pattern>

</defs>


<rect x="10" width="100" y="10" height="100"/>


</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:url(fichier.svg#monMotif);
}

/* ainsi, tous les rectangles seront texturés selont notre pattern */]]></div>

<h3 id="baseattr">Les attributs de base</h3>

<p>Tout d’abord, il faut définir la taille de notre motif ainis que son point de départ. Il sera par la suite répété indéfiniment
dans toutes les directions pour former une mosaïque. On définit le point de départ grâce aux attributs
<span class="attribute">x</span> et <span class="attribute">y</span>. Puis on défini la taille du motif grâce aux attributs
<span class="attribute">width</span> et <span class="attribute">height</span>. Ça, vous connaissez déjà. Enfin, vous mettez entre
la balise de début et la balise de fin de <span class="balise">pattern</span> les formes qui composeront votre motif, par
exemple un <span class="balise">circle</span>, ou un <span class="balise">path</span>, etc. Vous pouvez les
styler à votre guise avec CSS et les animer autant que vous voulez !</p>

<p>Mais au fait, les attributs <span class="attribute">x</span>, <span class="attribute">y</span>,
<span class="attribute">width</span> et <span class="attribute">height</span>, à quoi font-t-ils référence ? C’est là que débutent
les problèmes : cela dépend de la valeur de l’attribut <span class="attribute">patterUnits</span>.</p>

<h4>Avec <span class="attribute">patterUnits</span> à <span class="attribute">userSpaceOnUse</span></h4>

<p>Lorsque l’attribut <span class="attribute">patterUnits</span> de <span class="balise">pattern</span> est positionné à la
valeur <span class="attribute">userSpaceOnUse</span>, les quatre attributs listé ci-dessus font référence au système de coordonné
courrant, c’est à dire dans la plupart des cas à l’élément <span class="balise">svg</span> le plus proche. SVG va donc
commencer à dessiner notre motif, qui est un rectangle, à partir du point de coordonnées donné par les attributs
<span class="attribute">x</span> et <span class="attribute">y</span>. Il va ensuite répéter le motif pour créer une mosaïque.
Les coordonnées <em>n’ont donc aucun rapport</em> avec la forme sur laquelle on applique la texture !</p>

<p>Pour ce shcéma, on a pris <span class="attribute">x="10"</span>, <span class="attribute">y="0"</span>,
<span class="attribute">width="40"</span> et <span class="attribute">height="20"</span> :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/patterns/userSpaceOnUse-schema.svg">Schéma décrivant l’utilisation d’un motif avec
l’attribut patterUnits réglé à userSpaceOnUse</object>
</div>

<p>Remarquez comme le premier motif est décalé de 10 pixels par rapport au point 0,0</p>

<h4>Avec <span class="attribute">patterUnits</span> à <span class="attribute">objectBoundingBox</span></h4>

<p>Lorsque <span class="attribute">patterUnits</span> est fixé à <span class="attribute">objectBoundingBox</span>, le processeur SVG
commence par déterminer la boîte englobante de la forme sur laquelle on applique la texture, c’est à dire le plus petit rectangle
contenant cet objet. Ensuite, on ne résonne plus en fonction du système de coordonné courrant mais en fonction de cette boîte
englobante. Les attributs <span class="attribute">x</span>, <span class="attribute">y</span>,
<span class="attribute">width</span> et <span class="attribute">height</span> font à présent référence aux dimensions de la boîte
englobante. Dans ce cas, les attributs <span class="attribute">width</span> et <span class="attribute">height</span> sont exprimés
en pourcentage de la boîte englobante. Dans l’exemple suivant, on a à chaque fois un motif qui se répète cinq fois horizontalement
(à cause du <span class="attribute">width="20%"</span>) et quatre fois verticalement
(<span class="attribute">height="25%"</span>).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="patternUnits-objectBoundingBox.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de motif avec patternUnits positionné à objectBoundingBox</title>

<defs>

<pattern id="motif" x="0" y="0" width="20%" height="25%" patternUnits="objectBoundingBox">
<rect id="patternRect" x="0" y="0" width="30" height="30"/>
<polyline points="7,7 10,17 20,9"/>
</pattern>

</defs>

<rect x="10" y="10" width="100" height="100"/>

<ellipse cx="300" cy="150" rx="40" ry="120"/>

<rect x="10" y="150" width="200" height="140"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect, ellipse{
	fill:url(patternUnits-objectBoundingBox.svg#motif);
	stroke:black;
	stroke-width:1px;
}

#patternRect{
	fill:none;
}

polyline{
	fill:none;
	stroke:mediumseagreen;
	stroke-width:3px;
	stroke-linejoin:round;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/patterns/patternUnits-objectBoundingBox.svg">Utilisation de motif avec patternUnits
positionné à objectBoundingBox</object>
</div>

<p>Notez bien qu’<span class="attribute">objectBoundingBox</span> est la valeur par défaut !</p>

<h3 id="pcu">L’attribut <span class="attribute">patternContentUnits</span></h3>

<p>Par défaut, les unités des objets qui constituent un <span class="balise">pattern</span> sont exprimées dans le système
de coordonnées de l’élément <span class="balise">svg</span> parent. Dans ce cas, l’attribut
<span class="attribute">patternContentUnits</span> vaut <span class="attribute">userSpaceOnUse</span>. Cependant, on peut vouloir
que les unités soient précisées en fonction de la boîte englobante de l’objet sur lequel on applique la texture. Dans ce cas, on
fixe <span class="attribute">patternContentUnits</span> à <span class="attribute">objectBoundingBox</span> et on spécifie les
valeurs en pourcentages. C’est très utile quand on veut qu’un motif se répète en entier un nombre de fois précis, horizontalement
et verticalement, et quelque soit le motif sur lequel on l’applique :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="patternContentUnits-objectBoundingBox.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Texture avec l’attribut patternContentUnits à objectBoundingBox</title>

<defs>

<pattern id="motif" x="0" y="0" width="0.2" height="0.25"
patternUnits="objectBoundingBox" patternContentUnits="objectBoundingBox">
<rect id="patternRect" x="0" y="0" width="0.2" height="0.25"/>
<path d="M 0,0 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025 h 0.02 v 0.025"/>
</pattern>

</defs>

<rect x="10" y="20" width="200" height="80"/>

<rect x="10" y="110" width="200" height="180"/>

<rect x="220" y="10" width="170" height="280"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:url(patternContentUnits-objectBoundingBox.svg#motif);
}

#patternRect, path{
	fill:none;
	stroke:deepskyblue;
	stroke-width:0.005;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/patterns/patternContentUnits-objectBoundingBox.svg">Texture avec l’attribut
patternContentUnits à objectBoundingBox</object>
</div>

<p>Si vous avez des objets qui se remplissent uniformément d’une seule couleur, c’est sans doute que la valeur de votre
<span class="csspropertie">stroke-width</span> est trop grande : elle est aussi exprimée en pourcentage de la boîte englobante !</p>

<h3 id="transf">Transformation de motifs</h3>

<p>SVG permet d’appliquer des transformations sur des motifs. On se sert alors de l’attribut
<span class="attribute">patternTransform</span> qui prend en paramêtre une liste de transformations. Effectuons un skewX puis un
skewY sur un rectangle en motif :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="patternTransform.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Transformation de motif avec patternTransform</title>

<defs>
<pattern id="motif" x="0" y="0" width="30" height="24"
patternUnits="userSpaceOnUse" patternTransform="skewY(20)">

<rect x="2" y="2" width="26" height="20"/>

</pattern>
</defs>

<polygon points="10,10 380,10 300,150 380,290 10,290"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:none;
	stroke:lightgreen;
	stroke-width:1.5px;
	stroke-linejoin:bevel;
}

polygon{
	stroke:black;
	stroke-width:3px;
	stroke-linejoin:round;
	fill:url(patternTransform.svg#motif);
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/patterns/patternTransform.svg">Transformation de motif avec patternTransform</object>
</div>

<p>Vous n’êtes bien sur pas limité à une seule transformation.</p>

<p>Notez que la transformation est effectuée sur la texture en entier, et non pas sur le contenu du
<span class="balise">pattern</span>.</p>

<h3 id="motmot">Des motifs dans des motifs</h3>

<p>L’inclusion de motifs dans des motifs se fait de façon très intuitives. En fait, on utilise toujours les mêmes propriétés CSS
(à savoir <span class="csspropertie">fill</span> et <span class="csspropertie">stroke</span>, pour effectuer le texturage. Voici un
exemple plutôt sympathique et qui serait quasiment impossible à obtenir sans l’inclusion de motif dans un motif :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="motif-dans-un-motif.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des motifs dans des motifs</title>

<defs>

<pattern id="petitsPoints" x="0" y="0" width="2" height="2" patternUnits="userSpaceOnUse">
<circle cx="1" cy="1" r="0.5"/>
</pattern>

<pattern id="motifEntier" x="0" y="0" width="140" height="60"
patternUnits="userSpaceOnUse" patternTransform="scale(2) rotate(-45) translate(40,0)">
<text x="70" y="30"><tspan>SVGround</tspan></text>
</pattern>

</defs>

<rect x="10" y="10" width="380" height="280"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:url(motif-dans-un-motif.svg#motifEntier);
	stroke:black;
	stroke-width:2px;
	stroke-linejoin:round;
}

/* petits points */

#petitsPoints circle{
	fill:slategray;
}

/* motif en entier */

#motifEntier text{
	font-size:20px;
	font-weight:bold;
	/* on le centre */
	text-anchor:middle;
	/* et on applique la texture petitsPoints dessus */
	fill:url(motif-dans-un-motif.svg#petitsPoints);
}
#motifEntier text > tspan{
	baseline-shift:-0.6ex;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/patterns/motif-dans-un-motif.svg"></object>
</div>

<p>Et voilà le travail ! Et vous pourrez faire bien mieux, j’en suis sur !</p>

<p>Ce chapitre touche à sa fin, mais en fait, le prochain traite de quelquechose d’assez proche, qui permet aussi le remplissage :
les dégradés. Prenez une pause de cinq minutes, souﬄez un peu et on repart !</p>

<div class="previouspage"><a href="animations-chapitre-1.php" title="cours précédent">Les animations (partie 1)</a></div>
<div class="nextpage"><a href="degrades.php" title="cours suivant">Les dégradés</a></div>

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
