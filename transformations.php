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
<h2>Les transformations</h2>

<p>Il y a cinq transformations possibles en SVG : la translation (translate), la rotation (rotate), le changement d’échelle (scale),
la transformation par inclinaison de l’axe des abscisse (skewX) et celle par inclinaison de l’axe des ordonnées (skewY).<br/>
Cependant, on utilise qu’un seul attribut pour effectuer les transformations : l’attribut <span class="attribute">transform</span>.
<br/>La syntaxe pour effectuer un transformation est : <span class="attribute">transform="mot-clé(valeur<sub>1</sub>,
valeur<sub>2</sub>, valeur<sub>n</sub>)"</span>.
</p>

<ul class="sommaire">
<li><a href="#translations">La translation</a></li>
<li><a href="#rotation">La rotation</a></li>
<li><a href="#scale">Le changement d’échelle</a></li>
<li><a href="#skew">Les transformations skewX et skewY</a></li>
<li><a href="#enchainement">Les enchaînements de transformations</a></li>
<li><a href="#scale-centré">Changement d’échelle centré</a></li>
</ul>

<h3 id="translations">La translation</h3>

<p>La translation requiert deux paramètres : le premier est la translation sur l’axe des abscisses et le second sur l’axe des
ordonnées. Effectuons une translation pour placer un cercle au milieu de la zone de dessin :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Translation d’un cercle avec SVG</title>

<circle r="120"
style="fill:indigo;fill-opacity:0.22;stroke:indigo;stroke-width:3px;stroke-dasharray:5,5;"
transform="translate(200,150)"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/translation.svg">Translation d’un cercle avec SVG</object>
</div>

<p>Ici, il n’y a pas d’attributs <span class="attribute">cx</span> et <span class="attribute">cy</span> : SVG considère
qu’ils valent 0. Le centre du cercle a été déplacé au point 200,150. On aurait pu avoir le même effet en mettant
<span class="attribute">cx="200"</span> et <span class="attribute">cy="150"</span> ce qui est plus logique, mais c’est juste pour
vous montrer le principe et ne vous inquietez pas, ça nous servira dans très peu de temps
<object type="image/gif" data="images/smileys/yes.gif">:)</object>.</p>

<h3 id="rotation">La rotation</h3>

<p>La rotation prend un paramètre : l’angle de rotation en degrés. Il peut bien sur être négatif, supérieur à 360, etc. On
aimerait faire tourner un rectangle de 30° :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Rotation d’un rectangle avec SVG</title>

<!-- on dessine un cadre entourant la zone de dessin -->
<rect x="0" y="0" width="400" height="300"
style="fill:none;stroke:black;stroke-width:2px;"/>

<rect x="60" y="30" width="300" height="80"
fill:none;stroke:limegreen;stroke-width:14px;stroke-linejoin:bevel;"/>

<rect x="60" y="30" width="300" height="80"
fill:none;stroke:limegreen;stroke-width:14px;stroke-linejoin:bevel;"
transform="rotate(30)"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/rotate.svg">Rotation d’un rectangle avec SVG</object>
</div>

<p>Ce n’est pas vraiment le résultat attendu. Et pour cause : ce n’est pas seulement le rectangle qu’on a tourné : c’est toute la
zone de dessin ! Cliquez sur « rotation » pour voir l’effet d’une rotation.</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/transformations/rotate-svg.svg">Rotation d’un rectangle avec SVG</object>
</div>

<p>C’est donc toute la zone de dessin qui subit une rotation autour de son point d’origine de coordonnées 0,0. C’est d’ailleurs la
même chose avec la translation. Heureusement, il est tout à fait possible de spécifier le centre de rotation avec un second et un
troisième paramètre. Le second est l’abscisse du centre de rotation et le troisième est l’ordonnée. Par exemple, sur un carré :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Rotation d’un carré sur lui même avec SVG</title>

<rect x="150" y="100" width="100" height="100"
style="fill:none;stroke:darkmagenta;stroke-width:10px;stroke-linejoin:round;"
transform="rotate(45, 200, 150)"/>

<circle cx="200" cy="150" r="1"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/rotate-square.svg">Rotation d’un carré sur lui même avec SVG</object>
</div>

<p>Bien sur, les longueurs n’ont pas été prises au hasard : le point 200,150 est le centre du carré. Notez que la rotation se fait
dans le sens indirect, c’est à dire dans le sens des aiguilles d’une montre.</p>

<h3 id="scale">Le changement d’échelle</h3>

<p>Le changement d’échelle est réalisé grâce à scale. Il prend deux paramètres : le premier est le changement d’échelle sur les
abscisses et le second sur les ordonnées. Dans le cas ou seul le premier paramètre est spécifié, le second prend la même valeur.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Changement d’échelle avec SVG</title>

<rect x="0" y="0" width="400" height="300"
style="fill:none;stroke:black;stroke-width:2px;"/>

<polygon points="40,40 40,100 160,40"
style="fill:none;stroke:slategray;stroke-width:6px;stroke-opacity:0.5;stroke-linejoin:round;"/>

<polygon points="40,40 40,100 160,40"
style="fill:none;stroke:slategray;stroke-width:6px;stroke-opacity:0.5;stroke-linejoin:round;"
transform="scale(2)"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/scale.svg">Changement d’échelle avec SVG</object>
</div>

<p>Il n’y a rien à faire, notre rectangle n’est pas resté en place… En fait, il s’est encore passé la même chose que précédemment :
c’est la zone de dessin qui a été transformé, pas seulement le rectangle. Toutes les coordonnées ont été multipliées par 2.
Ainsi, le point d’origine qui se trouvait à 40,40 se retrouve à 80,80. La taille de la bordure
(<span class="csspropertie">stroke-width</span>) a elle aussi été multipliée par deux. Cliquez sur le boutton pour voir comment
fonctionne scale.</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/transformations/scale-svg.svg">Schéma d’un changement d’échelle avec SVG</object>
</div>

<p>On peut aussi se servir de scale pour « étirer » une forme vers le bas ou vers la droite :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Scale peut aussi servir à étirer des objets</title>

<rect x="0" y="0" width="400" height="300"
style="fill:none;stroke:black;stroke-width:2px;"/>

<circle cx="70" cy="70" r="30"
style="fill:none;stroke:thistle;stroke-width:6px;"/>

<circle cx="70" cy="70" r="30"
style="fill:none;stroke:turquoise;stroke-width:6px;"
transform="scale(2,1)"/>

<circle id="c3" cx="70" cy="70" r="30"
style="fill:none;stroke:gainsboro;stroke-width:6px;"
transform="scale(1,2.5)"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/scale-dir.svg">Scale peut aussi servir à étirer des objets</object>
</div>

<p>Mais on peut aussi mettre des valeurs négative pour, par exemple, faire de la symétrie. Pour un symétrie centrale on fera
<span class="attribute">transform="scale(-1,-1)"</span>; pour une symétrie axiale :
<span class="attribute">transform="scale(1,-1)"</span> ou <span class="attribute">transform="scale(-1,1)"</span>.<br/>
Si on met zéro pour une des deux valeur, la figure ne s’affichera pas puisqu’un produit par 0 vaut toujours 0 ! Notez aussi qu’on
utilise le point pour séparer les unités des dixièmes et non la virgule. Nous verrons plus tard qu’il est possible, comme pour la
rotation, de faire un changement d’échelle centré.</p>

<h3 id="skew">Les transformations skewX et skewY</h3>

<p>Les commandes skewX et skewY permettent, comme les autres transformations, une transformation de la zone de visualisation en
effectuant une rotation des coordonnées x pour skewX et y pour skewY de la valeur de l’angle indiqué. Prenons ces schémas :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/transformations/skewX-schema.svg">La transformation skewX en SVG</object>
</div>

<p>Dans cet exemple, les lignes verticales sont inclinées à 45° par rapport à la normale car on a appliqué un skewX(45).</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/transformations/skewY-schema.svg">La transformation skewY en SVG</object>
</div>

<p>Là, ce sont les axes horizontaux qui ont été inclinés de 30° par un skewY(30).</p>

<p>Essayez avec une valeur de 90° : on obtient plus qu’une seule ligne. Avec 180°, on revient à la position de départ et un
skewY(20) et donc égal à un skewY(200) (180 + 20). Il est bien sur possible de spécifier des valeurs négatives et décimales.
Par exemple -57275.256 est valide. Essayons avec un cercle :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>skewX et skewY sur un cercle</title>

<circle cx="200" cy="150" r="50"
style="fill:none;stroke:orchid;stroke-width:6px;stroke-opacity:0.5;"/>

<circle cx="200" cy="150" r="50"
style="fill:none;stroke:powderblue;stroke-width:6px;"
transform="skewX(-25)"/>

<circle cx="200" cy="150" r="50"
style="fill:none;stroke:palegreen;stroke-width:6px;"
transform="skewY(17.8)"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/skewX-circle.svg">skewX et skewY sur un cercle</object>
</div>

<h3 id="enchainement">Les enchaînements de transformations</h3>

<p>Il est possible d’enchaîner plusieurs transformations dans un seul attribut, ce qui peut s’avérer très utile. On peut donc faire
subir une translation puis une rotation à un objet, ou une transformation skewX suivi d’une transformation skewY pour donner un
effet <acronym title="trois dimensions">3D</acronym>. La syntaxe est :<br/>
<span class="attribute">transform="mot-clé<sub>1</sub>(valeurs) mot-clé<sub>2</sub>(valeurs) mot-clé<sub>n</sub>(valeurs)"</span>.
<br/>Essayons de changer d’échelle à un carré, de le déplacer vers la droite et le bas, de le faire pivoter et d’appliquer un
skewX, tout cela en décomposant l’enchaînement des transformations :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Multiples transformations sur un carré</title>

<rect x="0" y="0" width="400" height="300"
style="fill:aliceblue;stroke:black;stroke-width:1px;"/>

<rect x="0" y="0" width="20" height="20"
style="fill:none;stroke:turquoise;stroke-width:2px;"
transform="scale(2.3)"/>

<rect x="0" y="0" width="20" height="20"
style="fill:none;stroke:turquoise;stroke-width:2px;"
transform="scale(2.3) translate(80,50)"/>

<rect x="0" y="0" width="20" height="20"
style="fill:none;stroke:turquoise;stroke-width:2px;"
transform="scale(2.3) translate(80,50) rotate(75)"/>

<rect x="0" y="0" width="20" height="20"
style="fill:none;stroke:turquoise;stroke-width:2px;"
transform="scale(2.3) translate(80,50) rotate(75) skewX(65)"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/multiples-transformations.svg">
Multiples transformations sur un carré</object>
</div>

<p>On remarque d’ores et déjà plusieurs choses à première vue étranges. On a effectué une translation de 80 vers la droite et 50
vers le bas et notre carré se retrouve au centre de la zone de dessin alors que cette zone de dessin fait à l’origine 400 pixels de
largeur et 300 pixels de hauteur. De même, la rotation s’est faite par rapport au coin haut gauche de notre carré, et non
pas par rapport au coin haut gauche de notre zone <span class="balise">svg</span>.
</p>

<p>L’explication est en fait très simple : on sait que c’est notre zone de dessin qui subit les transformations. Or, entre 2
transformations elle <em>ne retrouve pas</em> sa forme initiale. Ainsi, après le changement d’échelle
(<span class="attribute">transform="scale(2.3)"</span>), notre zone de dessin ne fait plus 400×300 pixels mais 920×390 (les
coéfficients sont mulitpliés par 2,3) ! Cependant, on voit toujours notre dessin dans une boîte de 400 pixels de largeur et 300
pixels de hauteur. Une translation de 200 vers la droite et 200 vers le bas ferait sortir notre carré de la zone visible. Il se
passe la même chose pour la rotation, mais rien ne vaut un schéma pour visualiser ces enchaînements de transformations.</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/transformations/multiples-transformations-schema.svg">
Les enchaînements de transformation en SVG</object>
</div>

<p>La rotation s’est donc bien faite par rapport au point d’origine mais ce point avait auparavant été déplacé par la translation.</p>

<h3 id="scale-centré">Changement d’échelle centré</h3>

<p>Grâce aux enchaînements de transformations, on va pouvoir effectuer un changement d’échelle centré. La formule est assez simple :</p>

<p>Avec un changement d’échelle égal à n :<br/>
<span class="attribute">transform="translate(-centreX*(n-1), -centreY*(n-1)) scale(n)"</span></p>

<p>Essayons avec une ellipse :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Changement d’échelle centré en SVG</title>

<ellipse cx="200" cy="150" rx="40" ry="25"
style="fill:none;stroke:lightgoldenrodyellow;stroke-width:3px;"/>

<!-- scale : 2 -->
<ellipse cx="200" cy="150" rx="40" ry="25"
style="fill:none;stroke:lightgoldenrodyellow;stroke-width:3px;"
transform="translate(-200,-150) scale(2)"/>

<!-- scale : 3 -->
<ellipse cx="200" cy="150" rx="40" ry="25"
style="fill:none;stroke:lightgoldenrodyellow;stroke-width:3px;"
transform="translate(-400,-300) scale(3)"/>

<!-- scale : 4 -->
<ellipse cx="200" cy="150" rx="40" ry="25"
style="fill:none;stroke:lightgoldenrodyellow;stroke-width:3px;"
transform="translate(-600,-450) scale(4)"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/transformations/centered-scale.svg">
Changement d’échelle centré en SVG</object>
</div>

<p>Il existe encore une transformation, mais nous ne l’étudierons pas : il s’agit de la transformation matrix. C’est une
transformation générique qui fait appel au calcul matriciel pour faire tout ce que l’on a pu faire avec translate, rotate, scale,
skewX et skewY. Jusqu’ici, nous avons écrit un code assez verbeux, notamment au niveau des styles CSS. Le prochain chapitre
traite de l’optimisation du code XML et CSS.</p>

<div class="previouspage"><a href="formes-de-base.php" title="cours précédent">Les formes de base</a></div>
<div class="nextpage"><a href="structure.php" title="cours suivant">Comment bien structurer un document SVG</a></div>

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
