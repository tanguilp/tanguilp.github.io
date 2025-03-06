<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
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
<h2>Les chemins (path)</h2>

<p>Vous souvenez vous des transformations ? Je vous avais dit qu’il existait une autre transformation, générique, que translate,
rotate, scale, skewX et skewY : matrix. Étant donné que nous pouvions déjà tout faire et que je ne comprends pas un pet de calcul
matriciel, nous l’avions passé. Maintenant, repensons aux formes. L’intitulé du chapitre était
<q cite="http://127.0.0.1/SVGround/formes-de-base.php"><a href="http://127.0.0.1/SVGround/formes-de-base.php">Les
formes de base</a></q>. Et c’est vrai que ce n’était que des formes de base : on ne pouvait pas, jusqu’ici, dessiner de courbes,
d’arcs, bref : des formes compliquées. C’est là qu’intervient <span class="balise">path</span> : c’est une balise
générique qui permet de tracer toutes les formes possibles et imaginables ! Pourquoi alors avoir étudier des formes qu’on va de toute
façon pouvoir créer avec <span class="balise">path</span> ? Et bien pour deux raisons. La première est qu’un
<span class="balise">rect</span> désigne un rectangle tandis qu’un <span class="balise">path</span> désigne une
forme : sémantiquement parlant, on utilise <span class="balise">rect</span> pour dessiner un rectangle et
<span class="balise">path</span> pour dessiner une forme (qui peut être un rectangle mais on n’en sait rien). La seconde,
c’est qu’utiliser des balises appropriées permet une relecture beaucoup plus facile.
</p>

<ul class="sommaire">
<li><a href="#path">La balise <span class="balise">path</span></a></li>
<li><a href="#movetolineto">Les commandes Moveto et Lineto</a></li>
<li><a href="#closepath">La commande Closepath</a></li>
<li><a href="#linetohv">Les Lineto horizontaux et verticaux</a></li>
<li><a href="#sub">Plusieurs sous-tracés</a></li>
<li><a href="#relat">Des coordonnées relatives</a></li>
<li><a href="#arc">Les arcs elliptiques</a></li>
<li><a href="#quadra">Les courbes de Bézier quadratiques</a></li>
<li><a href="#cubi">Les courbes de Bézier cubiques</a></li>
<li><a href="#simplif">Simplification de la notation des <span class="balise">path</span></a></li>
<li><a href="#marqueurs">Les marqueurs</a></li>
</ul>

<h3 id="path">La balise <span class="balise">path</span></h3>

<p>Ça en étonnera peut être certains, mais il suffit d’une balise pour dessiner un <span xml:lang="en">path</span> : c’est
<span class="balise">path</span>. Cette balise accepte bien sur tous les attributs qui nous permettent de styler nos formes,
c’est à dire <span class="attribute">style</span>, <span class="attribute">class</span> et <span class="attribute">id</span>.
Elle n’a qu’un attribut obligatoire : <span class="attribute">d</span> pour <span xml:lang="en">datas</span> (données).</p>

<p>Les <span xml:lang="en">paths</span>, ou plus particulièrement les données contenues dans l’attribut
<span class="attribute">d</span> sont organisées par commandes. Il y a dix commandes, chacune représentée par une lettre
(M, Z, L, H, V, C, S, Q, T ou A). Chacune de ces commandes donne le tracé d’une ligne grâce à un ou plusieurs couples de coordonnées
(ça dépend de la commande).</p>

<h3 id="movetolineto">Les commandes Moveto et Lineto</h3>

<p>Première commande : la commande Moveto, notée M, qui prend en paramêtre les coordonnées du premier point du chemin. Elle peut être
décrite par cette phrase : <span id="moveto-comment">« Je déplace le crayon jusqu’au point des coordonnées indiquées et je le
pose. »</span>. La seconde commande est la commande Lineto, notée L, qui trace une ligne des dernières coordonnées aux coordonnées
indiqués. Avec ces deux commandes, on peut faire tout ce qu’on faisait avec <span class="balise">polyline</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="moveto-lineto.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les commandes Moveto et Lineto des paths SVG</title>

<path d="M 120,200 L 140,120 L 180,280 L 220,120 L 260,280 L 300,120"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:darkviolet;
	fill:lavenderblush;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/moveto-lineto.svg">Les commandes Moveto et Lineto des paths SVG</object>
</div>

<p>Rien de bien compliqué : ça marche comme <span class="balise">polyline</span>, avec les L en plus. Vous remarquerez que
notre figure a été remplie d’une manière un peu étrange. En fait, pour la remplir, le processeur SVG a tracé une ligne de la dernière
paire de coordonnées à la toute première. Si on ne veut pas de remplissage, on doit mettre
<span class="csspropertie">fill:none;</span>.</p>

<h3 id="closepath">La commande Closepath</h3>

<p>Si les commandes Moveto et Lineto suffisent à émuler un <span class="balise">polyline</span>, il faut une troisième
commande pour avoir le même résultat qu’un <span class="balise">polygon</span> qui, rappelons le, a pour seule différence de
« fermer » le chemin en traçant une ligne du dernier couple de points au premier. Cette commande s’appelle Closepath et la lettre qui
la désigne est Z.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="closepath.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La commande Closepath</title>

<!-- path non fermé -->
<path d="M 40,40 L 150,100 L 100,280"/>

<!-- path fermé -->
<path d="M 240,40 L 350,100 L 300,280 Z"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:darkviolet;
	fill:lavenderblush;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/closepath.svg">La commande Closepath</object>
</div>

<p>Simplissime ! Utilisez cette commande à <em>chaque</em> que vous voulez clore un path. Je m’explique : certains d’entre vous se
sont sans doute dit que cette commande ne servait pas à grand chose puisqu’on pouvait aisément tracer la ligne fermante, en
quelque sorte fermer le chemin « manuellement ». C’est une erreur : dans le cas ou on ferme le chemin manuellement, les deux segments
vont se superposer, mais il y aura deux extrémités ; dans le cas ou c’est fait proprement, avec la commande appropriée (cest à dire
la commande Closepath), la forme n’a pas d’extrémité. sans importance ? N’oubliez pas que deux propriétés CSS existent pour contrôler
le rendu des extrémités et des jointures : <span class="csspropertie">stroke-linecap</span> et
<span class="csspropertie">stroke-linejoin</span>. Exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="closepath-manuel.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Problème lors de la fermeture manuelle d’un path</title>

<!-- path fermé manuellement -->
<path d="M 180,150 L 20,20 L 20,280 L 180,150"/>

<!-- path bien fermé -->
<path d="M 380,150 L 220,20 L 220,280 Z"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:darkviolet;
	stroke-width:18;
	stroke-linejoin:round;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/closepath-manuel.svg">Problème lors de la fermeture manuelle d’un path</object>
</div>

<h3 id="linetohv">Les Lineto horizontaux et verticaux</h3>

<p>Il y a deux raccourcis pour tracer des lignes horizontales ou verticales : les Lineto horizontaux (commande H) et les Lineto
verticaux (commande V). Préférez toujours ces commandes à la commande Lineto (lettre L) qui est moins lisible et moins rapide. Les
commandes H et V doivent être suivis d’un seul nombre : la coordonnée en abscisse (pour la commande H) ou en ordonnée (pour la
commande V) du point d’arrivée. On peut ainsi facilement tracer un carré comme ceci :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="lineto-h-v.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Tracer des lignes horizontales et verticales avec les commandes H et V</title>

<path d="M 100,100 H 200 V 200 H 100 Z"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:black;
	stroke-linejoin:bevel;
	stroke-width:6px;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/linto-h-v.svg">
Tracer des lignes horizontales et verticales avec les commandes H et V</object>
</div>

<h3 id="sub">Plusieurs sous-tracés</h3>

<p>Les possibilités de SVG ne s’arrêtent pas là. Il est possible, grâce à la commande M, de dessiner plusieurs sous-tracés dans un
seul <span class="balise">path</span>. Même si ça ne paraît pas forcément utile, vous verez qu’on pourra s’en servir
pour mettre du texte sur un <span class="balise">path</span> ou faire de l’animation. En ce qui concerne les possibilités
de la commande Moveto, je vous avais dit que M x,y correspondait à la phrase <q cite="#moveto-comment">Je déplace le crayon jusqu’au
point de coordonnées x,y et je le pose</q>. La formulation peut paraître puérile mais la commande Moveto fonctionne exactement comme
ça (en supposant qu’à l’apparition d’un M, le crayon est levé). Voici un exemple d’utilisation :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="multiples-traces.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Plusieurs sous-tracés avec la commande M</title>

<path d="M 100,100 H 150 L 100,200 Z M 300,100 H 250 L 300,200 Z"/>

</svg>]]></div>

<div class="csscode">path{
	stroke:palevioletred;
	stroke-linejoin:round;
	stroke-width:6px;
	fill:none;
}</div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/multiples-traces.svg">Plusieurs sous-tracés avec la commande M</object>
</div>

<p>On peut bien sur faire une infinité de sous-tracés. L’avantage est qu’on peut dessiner plusieurs formes avec un seul tracé et
qu’on pourra changer le style de toutes ces formes en même temps, en attribuant le style adéquat au
<span class="balise">path</span>.</p>

<h3 id="relat">Des coordonnées relatives</h3>

<p>Il est possible, et ça va nous simplifier la vie, de préciser que les coordonnées qu’on indique dans un
<span class="balise">path</span> sont relatives. Il suffit pour cela de mettre les lettres qui indiquent les comamndes
en… minuscule ! On peut bien sur varier, et spécifier que certaines coordonnées sont relatives tandis que d’autres sont absolues.
</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="relative-paths.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des coordonnées relatives pour l’élément path</title>

<!-- dessin d’un escalier -->
<path d="M 10,10 h 20 v 20 h 20 v 20 h 20 v 20 h 20 v 20 h 20 v 20 h 20 v 20 h 20 v 20 h 20 v 20 h 20 v 20 h 20"/>

<!-- zigzags avec la commande Lineto -->
<path d="M 10,280 l 20, -20 l 20,20 l 20, -20 l 20,20 l 20, -20 l 20,20 l 20, -20 l 20,20
l 20, -20 l 20,20 l 20, -20 l 20,20 l 20, -20 l 20,20 l 20, -20 l 20,20"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:springgreen;
	stroke-width:9px;
	stroke-linejoin:round;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/relative-paths.svg">Des coordonnées relatives pour l’élément path</object>
</div>

<p>Les coordonnées relatives sont quand il s’agit de répéter un motif. Dans notre cas, après avoir écrit
<span class="attribute">h 20 v 20 </span>, il suffit de faire des copier/coller pour finir le dessin, d’où un important gain de
temps. Avec des coordonnées absolues, on aurait du écrire quelquechose commençant par
<span class="attribute">d="M 10,10 H 30 V 30 H 50 V 50…"</span>. Fastidieux.</p>

<p>On peut se demander ce qui se passerait si on mettais un m minuscule pour la commande Moveto. En fait, c’est assez simple : si ce
m minscule est la première commande du tracé, SVG considère que les coordonnées sont absolues. Sinon, elle considère que les
coorodnnées sont relatives et agit en conséquence en ajoutant les coordonnées aux dernières coordonnées indiqués. Par exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="relative-moveto.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des coordonnées relatives pour la commande Moveto</title>

<path d="m 100,100 L 230,140 m -200,100 h 300"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:steelblue;
	stroke-width:6px;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/relative-moveto.svg">Des coordonnées relatives pour la commande Moveto</object>
</div>

<p>Le tracé commence au point de coordonnées 100,100, même si m est en minuscule (parceque de toute façon, quand c’est la première
commande, ça ne peut être relatif à rien) puis va jusqu’au point de coordonnée 230,140 (<span class="attribute">L 230,140</span>).
Ensuite, le second sous-tracé commence au point de coordonnées
x<sub>dernier point</sub>+x<sub>m</sub>,y<sub>dernier point</sub>+y<sub>m</sub> soit 230+(-200),140+100 soit 30,240. Puis une
ligne horizontale de 300 pixels est tracée.</p>

<p>Pour la commande Closepath (lettre Z), la casse (entendez : le fait que la lettre soit majuscule ou minuscule) ne change rien :
la commande va fermer le sous-tracé courrant en rejoignant le dernier point au premier.</p>

<h3 id="arc">Les arcs elliptiques</h3>

<p>Comme vous venez de vous en rendre compte, c’est maintenant que ça se corse
<object type="image/gif" data="images/smileys/devil.gif">>:D</object> ! Pour commencer par le début, qu’est ce qu’un arc
elliptique ? Vous vous souvenez d’avoir tracé des ellipses ? Et bien un arc elliptique est un morceau, une portion d’ellipse.</p>

<p>Tracer un arc elliptique requiert beaucoup d’informations. Alors qu’il n’en fallait que deux (au maximum) pour tracer un ligne <!-- FIXME: pas clair -->
droite, il en faut maintenant sept ! Il faut déjà deux points, soit quatres nombres, pour tracer les deux ellipses dont l’axe des
x est parallèle à l’axe des ordonnées. Mais comme ce n’est pas toujours le cas, il faut aussi connaître l’inclinaison de cet axe !
</p>

<p>Commençons par le début : la lettre qui commande le tracé d’un arc elliptique est A (ou a minuscule pour des coordonnées
relatives). Les deux premiers paramêtres sont respectivement la longueur du rayon x et la longueur du rayon y (ces deux rayons
restent perpendiculaires).<br/>
Le troisième est la rotation (sens direct, inverse des aiguilles d’une montre) en degrés de l’axe x de l’ellipse par
rapport à l’axe des ordonnées.<br/>
Le quatrième paramêtre, appelé large-arc-flag, indique si on doit afficher l’arc dont la mesure fait plus de la moitié du périmètre
de l’ellipse (dans ce cas, la valeur est 1), ou l’arc dont la mesure fait moins de la moitié du périmètre (valeur : 0).<br/>
Le cinquième paramêtre, appelé sweep-flag, indique quant à lui si l’arc doit être dessiné dans la direction négative des angles (dans
lequel cas sa valeur est 0) ou dans la direction positive des angles (valeur : 1).
Les deux derniers sont les coordonnées du point d’arrivée, les coordonnées du point de départ étant données par la commande
précédent la commande A.</p>

<p>La commande d’arc elliptique est à mon sens assez difficile à comprendre, mais une fois assimilée, elle est très simple
d’utilisation. Il faut souvent beaucoup de tests avant de comprendre comment elle fonctionne. Voici un exemple très simple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="ellip-arc-1.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des arcs elliptiques simples</title>

<!-- arc №1 -->
<ellipse cx="60" cy="50" rx="50" ry="20"/>
<path d="M 10,50 A 50 20 0 0 0 110,50"/>

<!-- arc №2 -->
<ellipse cx="230" cy="50" rx="50" ry="20"/>
<path d="M 180,50 a 50 20 0 0 1 100,0"/>

<!-- arc №3 -->
<path d="M 10,150 a 60 25 0 0 0 100,50"/>

<!-- arc №4 -->
<path d="M 110,150 a 60 25 0 1 1 100,50"/>

<!-- arc №5 -->
<path d="M 10,215 a 60 25 45 1 0 100,50"/>

<!-- arc №6 -->
<path d="M 350,290 a 45 280 0 0 1 -40,-280"/>

<!-- arc №7 -->
<path d="M 350,290 a 45 280 0 0 0 -40,-280" style="stroke-dasharray:10,10"/>

</svg>]]></div>

<div class="csscode"><![CDATA[ellipse{
	stroke:black;
	fill:none;
}

path{
	stroke:darkturquoise;
	stroke-linejoin:bevel;
	stroke-width:4px;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/ellip-arc-1.svg">Des arcs elliptiques simples</object>
</div>

<p>À vous de tester toutes les possibilités, elles sont énormes. On peut d’ailleurs facilement créer un cercle avec cette
commande :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="ellip-arc-cercle.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un cercle grâce à la commande d’arc elliptique</title>

<path d="M 100,150 a 100 100 0 0 0 200,0 a 100 100 0 0 0 -200,0"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:darkturquoise;
	stroke-linejoin:bevel;
	stroke-width:4px;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/ellip-arc-cercle.svg">Un cercle grâce à la commande d’arc elliptique</object>
</div>

<p>Pour comprendre :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/paths/ellip-arc-cercle-schema.svg">Un cercle grâce à la commande d’arc elliptique :
schéma</object>
</div>

<p>Rien de bien compliqué en fait <object type="image/gif" data="images/smileys/sweatdrop.gif">^^'</object> si ? Le problème de
ces courbes est qu’elles ne permettent pas encore de faire tout ce que l’on voudrais. Passons aux choses sérieuses avec les courbes
de Bézier…</p>

<h3 id="quadra">Les courbes de Bézier quadratiques</h3>

<h4>La commande Q</h4>

<p>Les courbes de Bézier (du nom d’un ingénieur de Renault) quadratiques n’ont besoin que de trois paramêtres : le point de départ,
le point d’arrivée et un point de contrôle. En SVG, le point de départ est donné par la commande précédente. Si vous avez déjà fait
du dessin vectoriel avec un logiciel de graphisme (Paint par exemple), vous avez sans doute déjà tracé une courbe de Bézier. On
commence d’abord par tracer un segment puis on place ce fameux point de contrôle, aussi appelé point d’inflexion. Pour
comprendre le fonctionnement d’une telle courbe, il faut imaginer que notre segment est un fil de métal qui est attiré par l’aimant
qu’est le point de contrôle. Plus une partie du fil se trouve près de l’aimant, plus elle est attirée et se déforme.</p>

<p>Prenons un premier exemple. La lettre qui désigne cette commande est Q. Elle peut évidemment être écrite en minuscule, ce qui
signifiera que les coordonnées indiquées sont relatives. Cette commande requiert deux paramêtres et au final qutre nombres :
les coordonnées du point d’inflexion et les coordonnées du point d’arrivée.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="quadratique-curve-1.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La commande de courbe de Bézier quadratique</title>

<path d="M 50,100 Q 100,10 350,100"/>
<!-- point d’inflexion -->
<circle cx="100" cy="10" r="2"/>


<path d="M 50,200 q 340,40 300,0"/>
<!-- point d’inflexion -->
<circle cx="390" cy="240" r="2"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:indianred;
	stroke-width:5px;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/quadratique-curve-1.svg">La commande de courbe de Bézier quadratique</object>
</div>

<p>Dans le second <span class="balise">path</span>, on a mis la lettre q en minuscule. Cette fois ci, ce sont les deux
paires de coordonnées qui sont relatives !<br/>
<span class="attribute">d="M 50,200 q 340,40 300,0"</span> est équivalent à<br/>
<span class="attribute">d="M 50,200 Q 390,240 350,200"</span>.<br/>
Ultra-simple, non ? Et bien si ce n’est pas clair, voici un schéma qui devrait aider à comprendre le mécanisme des courbes de Bézier :
on a connecté les points de départ et d’arrivée au point de contrôle. Puis, on a relié les milieux des deux segments obtenus :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/paths/quadratiques-curves-schema.svg"></object>
</div>

<p class="rappel">N’hésitez pas à regarder la source de ce schéma : c’est en lisant du code que l’on apprend. Normalement, vous ne
devriez butter que sur deux attributs <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object>. Vous pouvez
accéder à tous les exemples et schémas du cours <a href="images/cours/">à cette adresse</a>.</p>

<p>Vous l’avez remarqué : le milieu du segment (en jaune sur le schéma) qui relie les milieux des deux segments reliants les
points de départ et d’arrivée au point d’inflexion « touche » la courbe quadratique
(<object type="image/gif" data="images/smileys/blink.gif">8o</object> c’est plus clair sur le dessin, non ?). Une fois que c’est
compris, vous ne devriez plus avoir de problème avec ces courbes.</p>

<h4>La commande T</h4>

<p>On pourrait définir la commande T comme complémentaire à la commande Q. En clair, elle ne permet pas de tracer une nouvelle
courbe, elle se contente de finir une courbe de Bézier quadratique (Q) de la manière la plus naturelle possible. Elle doit donc
toujours venir après une commande Q (ou q minuscule) ou une commande T. Elle peut, comme d’habitude, être relative (dans ce cas
on écrit la lettre en minuscule). Exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="t-command.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La commande T</title>

<path d="M 10,150 Q 100,20 180,180 T 390,100"/>

<!-- point de départ -->
<circle cx="10" cy="150" r="1"/>

<!-- point d’inflexion -->
<circle cx="100" cy="20" r="2"/>

<!-- point intermédiaire -->
<circle cx="180" cy="180" r="1"/>

<!-- dernier point -->
<circle cx="390" cy="100" r="1"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:limegreen;
	stroke-width:1.4em;
	stroke-linecap:round;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/t-command.svg">La commande T</object>
</div>

<p>On devine facilement que le point d’inflexion de la seconde partie de la courbe est en fait le symétrique du premier point
d’inflexion par rapport au point d’arrivé de la première partie de la courbe, qui est aussi le point de départ de la seconde.</p>

<h3 id="cubi">Les courbes de Bézier cubiques</h3>

<p>Les courbes de Bézier cubiques sont semblables aux courbe de Bézier quadratiques à la différence qu’il n’y a plus un seul point
de contrôle, mais deux. Les possibilitées en sont d’autant plus élevées !</p>

<h4>La commande C</h4>

<p>La commande C prend trois paramêtres : les coordonnées du premier point d’inflexion, les coordonnées du second et les coordonnées
du point d’arrivée. J’espère qu’il n’est plus la peine de préciser qu’elle peut être écrite en minuscule pour des coordonnées
relatives <object type="image/gif" data="images/smileys/whistling.gif">:°</object>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="cubic-curve.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La commande C</title>

<path d="M 10,10 C 50,250 50,5 390,290"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:sandybrown;
	stroke-width:3px;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/cubic-curve.svg">La commande de courbe de Bézier cubique</object>
</div>

<p>En fait, il se passe la même chose que tout à l’heure. Relions d’abord le point de départ au point d’inflexion №1, puis le point
d’inflexion №1 au point d’inflexion №2, etc. Puis, relions les milieux de ces 3 segments pour en obtenir deux, puis les milieux
de ces deux-ci pour en obtenir 1 :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/paths/cubic-curve-schema.svg"></object>
</div>

<p>Ce point touche le <span class="balise">path</span> ! Dans ce cas, ce n’est pas très facile à visualiser, mais dans
certains autres, si ! Je vous le jure <object type="image/gif" data="images/smileys/biggrin.gif">:D</object> !</p>

<h4>La commande S</h4>

<p>Vous vous en doutiez surement : il existe une commande pour terminer de façon naturelle une courbe de Bézier cubique. C’est la
commande S, qui prend non pas une mais deux paires de coordonnées : la première paire est les coordonnées du second point de
contrôle et la seconde les coordonnées du point d’arrivé. Le premier point d’inflexion est calculé à partir de la commande
précédente, qui est obligatoirement une commande de courbe de Bézier cubique, donc une commande C ou une commande S.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="s-command.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La commande S</title>

<path d="M 10,100 C 50,50 150,200 200,120 S 380,20 370,260"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:paleturquoise;
	stroke-width:1em;
	stroke-linecap:square;
	fill:none;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/s-command.svg">La commande S</object>
</div>

<p>Voilà, on a fait le tour des courbes dessinables avec SVG. Vous pouvez bien sur juxtaposer plusieurs courbes de Bézier : on peut
avoir des résultats étonnants. À vous de tester ces différentes commandes. Ça viendra d’autant plus facilement que vous écrirez du
code. C’est comme tous les autres langages, informatiques ou pas.</p>

<h3 id="simplif">Simplification de la notation des <span class="balise">path</span></h3>

<p>La longueur des données contenus dans l’attribut <span class="attribute">d</span> des <span class="balise">path</span>
peut être très importante, d’où le besoin de simplification.</p>

<p>Vous n’êtes pas obligés de simplifier la notation de vos <span class="balise">path</span>, cela peut vite devenir
illisible !</p>

<h4>Notation générale</h4>

<p>Il n’est pas nécessaire d’inclure une espace entre un nombre et une lettre. De même, il n’est pas nécessaire d’inclure une espace
entre un nombre positif et un nombre négatif, le signe moins (-) permettant de faire la différence.</p>

<p>Ceci :<br/>
<span class="attribute">d="M 40,40 L 25,90 L 97,-85 H 20"</span><br/>
peut donc être écrit :<br/>
<span class="attribute">d="M40,40L25,90L97-85H20"</span><br/>
(qui est nettement moins lisible).</p>

<p class="rappel">Deux nombres peuvent être séparés par une virgule ou une espace. Dans ces cours, seuls les coordonnées sont
séparées par des virgules, mais rien ne vous empêche de faire autrement !</p>

<h4>Commandes Lineto raccourcies</h4>

<p>Il faut <strong>toujours</strong> préférer les commandes H et V pour tracer des lignes horizontales ou verticales. Elles sont
plus rapides et plus lisibles.</p>

<h4>Suites de commandes identiques</h4>

<p>Lorsque plusieurs commandes identiques se suivent, il est possible de ne spécifier qu’une seule fois (la première fois) la lettre
indiquant la commande. Par exemple, dans l’exemple précédent :<br/>
<span class="attribute">d="M 40,40 L 25,90 L 97,-85 H 20"</span><br/>
peut être noté<br/>
<span class="attribute">d="M 40,40 L 25,90 97,-85 H 20"</span>.<br/>
Ceci est valables pour les commandes L (Lineto), H (Lineto horizontal), V (Lineto vertical), C (courbe de Bézier Cubique),
S, Q (courbe de Bézier quadratique), T et A (arc elliptique).</p>

<h4>Commande Moveto avec plusieurs paires de coordonnées</h4>

<p>Si une commande Moveto a plusieurs paires de coordonnées, les paires suivant la première sont considérées comme des commandes
Lineto. Par exemple :<br/>
<span class="attribute">d="M 100,100 L 300,500 L 20,10"</span><br/>
équivaut à :<br/>
<span class="attribute">d="M 100,100 300,500 20,10"</span>.<br/>
Si m est écrit en minuscule, les Lineto suivants ne seront pas absolus, mais relatifs :<br/>
<span class="attribute">d="M 100,100 l -50,10 l 20,20"</span><br/>
s’écrira :<br/>
<span class="attribute">d="m 100,100 -50,10 20,20"</span>.</p>

<h3 id="marqueurs">Les marqueurs</h3>

<p>Comme vous le savez maintenant, les <span class="balise">path</span> ont de multiples sommets, qui correspondent aux
points de départ et d’arrivé des différentes commandes disponibles. SVG permet d’assigner à ces sommets des objets graphiques de
toutes sortes : les marqueurs. Les marqueurs sont très utiles pour créer des flèches.</p>

<p>On utilise pour cela la balise <span class="balise">marker</span> qui n’est jamais dessinée directement, mais qu’on
place tout de même dans l’élément <span class="balise">defs</span>, comme tous les objets graphiques réutilisables. Pour
assigner un marker à un <span class="balise">path</span>, on utilise la propriété CSS
<span class="csspropertie">marker</span> qui prend comme valeur l’URI du marqueur (ou « none » qui est la valeur par défaut). C’est
pourquoi nos marqueurs auront toujours un attribut <span class="attribute">id</span> qui permettra des les identifier.</p>

<p>Par exemple, pour attacher un marker dont l’<span class="attribute">id</span> est <span class="attribute">fleche</span>, on fera
: <span class="csspropertie">marker:url(#fleche);</span>.</p>

<p>Il existe trois autre propriétés CSS qui permettent d’affiner le placement des marqueurs. Il s’agit des propriétés
<span class="csspropertie">marker-start</span> qui permet de spécifier le marqueur pour le point de départ du tracé,
<span class="csspropertie">marker-end</span> qui permet de spécifier le marqueur pour le dernier point du tracé, et
<span class="csspropertie">marker-mid</span> pour tous les autres points.</p>

<p>Enfin, sachez qu’on peut aussi utiliser les marqueurs avec les <span class="balise">line</span>,
<span class="balise">polyline</span> et <span class="balise">polygon</span>.</p>

<h4>Les attributs <span class="attribute">markerWidth</span>, <span class="attribute">markerHeight</span> et
<span class="attribute">markerUnits</span>.</h4>

<p>Pour commencer, il faut préciser que le système d’unités dans les marqueurs est différents des autres éléments graphiques. En
effet, ce ne sont pas les unités utilisateur qui sont utilisées, mais l’unité de base est la largeur de la bordure du chemin. Cette
possibilité est très intéressantes : vous pouvez avoir des chemins de différentes largeurs, les dimensions des marqueurs resteront
proportionnels à la largeur du chemin. Il est néanmoins possible de dire au processeur SVG qu’on ne veut pas utiliser comme unité
la largeur du chemin, mais nos propres unités grâce à l’attribut <span class="attribute">markerUnits</span> qu’on positionnera à
<span class="attribute">userSpaceOnUse</span> (la valeur par défaut est <span class="attribute">strokeWidth</span>).<br/>
Les attributs <span class="attribute">markerWidth</span> et <span class="attribute">markerHeight</span> permettent respectivement
de préciser la largeur et la hauteur du marqueur, selon l’unité de <span class="attribute">markerUnits</span>. Si un de ces
deux attributs n’est pas reneigné, il prendra 3 pour valeur. Exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="markers.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des marqueurs sur un chemin</title>

<defs>

<marker id="endmarker" markerWidth="6" markerHeight="4">
	<!-- fleche -->
	<polyline points="0,0 6,2 0,4"/>
</marker>

</defs>

<path id="path1" d="M 50,50 h 100 v 150 h -100"/>

<path id="path2" d="M 250,50 h 100 v 150 h -100"/>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	stroke:greenyellow;
	fill:none;
	marker-end:url(markers.svg#endmarker);
}

#endmarker{
	fill:greenyellow;
}

#path1{
	stroke-width:2px;
}

#path2{
	stroke-width:7px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/markers.svg">Des marqueurs sur un chemin</object>
</div>

<p>À première vu, ça n’est pas ce qu’on pourrait espérer <object type="image/gif" data="images/smileys/huh.gif">:S</object>.</p>

<h4>Les attributs <span class="attribute">refX</span>, <span class="attribute">refY</span> et
<span class="attribute">orient</span>.</h4>

<p>La première chose à faire pour que nos flèches soient bien orientées serait de redéfinir le centre du dessin du marqueur. C’est
à ça que servent les attributs <span class="attribute">refX</span> et <span class="attribute">refY</span>. Dans notre cas, il
faudrait que le centre soit au point 0,2 :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="markers.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des marqueurs sur un chemin : redéfinition du centre</title>

<defs>

<marker id="endmarker" markerWidth="6" markerHeight="4" refX="0" refY="2">
	<polyline points="0,0 6,2 0,4"/>
</marker>

</defs>

<path id="path1" d="M 50,50 h 100 v 150 h -100"/>

<path id="path2" d="M 250,50 h 100 v 150 h -100"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/markers-ref.svg">Des marqueurs sur un chemin : redéfinition du centre</object>
</div>

<p class="rappel">Rappellez vous qu’un des avantages des feuilles de style CSS externes est qu’on peut styler plusieurs document
avec une seule feuille de style. C’est ce que nous venons de faire ici.</p>

<p>C’est déjà beaucoup mieux. Il ne reste plus qu’à orienter notre marqueur pour qu’il aille dans le sens du chemin grâce à
l’attribut <span class="attribute">orient</span> qui prend comme valeur un nombre représentant un angle en degrés, ou le mot-clé
<span class="attribute">orient</span>. C’est ce mot-clé qui nous intéresse :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="markers.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des marqueurs sur un chemin : orientation automatique</title>

<defs>

<marker id="endmarker" markerWidth="6" markerHeight="4" refX="0" refY="2" orient="auto">
	<polyline points="0,0 6,2 0,4"/>
</marker>

</defs>

<path id="path1" d="M 50,50 h 100 v 150 h -100"/>

<path id="path2" d="M 250,50 h 100 v 150 h -100"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/paths/markers-orient.svg"></object>
</div>

<p>Perfect <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object>. Les valeurs numériques peuvent être
intéressantes le marqueur représente quelquechose de concret, un arbre par exemple, qui doit toujours être du même sens.</p>

<p>Le chapitre sur les chemins est maintenant terminé, mais vous allez vous rendre compte qu’on l’utilise beaucoup, notamment
dans les animations (ce chapitre va réllement vous plaire, mais un peu de patience <object type="image/gif"
data="images/smileys/001_cool.gif">B)</object>…) ou pour y mettre du texte. Tiens, j’ai dit texte ?</p>

<div class="previouspage"><a href="structure.php" title="cours précédent">Comment bien structurer un document SVG</a></div>
<div class="nextpage"><a href="le-texte-en-svg.php" title="cours suivant">Le texte</a></div>

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
