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
<h2>Les formes de base</h2>

<p>Nous l’avons vu, SVG sert à dessiner des formes. Nous allons donc commencer par dessiner des formes de base : les rectangles, les
cercles et les ellipses, les lignes et les polygones.</p>

<ul class="sommaire">
<li><a href="#rectangles">Les rectangles</a></li>
<li><a href="#cercles">Les cercles et les ellipses</a></li>
<li><a href="#lignes">Les lignes</a></li>
<li><a href="#polygones">Les lignes polygonales et les polygones</a></li>
</ul>

<h3 id="rectangles">Les rectangles</h3>

<p>Pour dessiner un rectangle, on utilise la balise <span class="balise">rect</span> qui a quatre attributs :</p>
<ul class="list-attributes">
<li><span class="attribute">x</span> qui détermine l’abscisse de départ ;</li>
<li><span class="attribute">y</span> qui détermine l’ordonnée de départ ;</li>
<li><span class="attribute">width</span> qui nous donne la longueur ;</li>
<li>et <span class="attribute">height</span> qui est la hauteur.</li>
</ul>

<p>Dessinons un rectangle de 100 pixels de longueur et 40 de hauteur, décalé de 50 pixels vers le bas et vers la droite :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Mon premier dessin SVG</title>

<!-- on dessine ici le rectangle -->

<rect x="50" y="50" width="100" height="40"/>

</svg>]]></div>

<p class="rappel">En XML, on peut inclure des commentaires entre &lt;!-- et --&gt;, à condition qu’il n’y ai pas plus d’un tiret
consécutif à l’intérieur. Par exemple :<br/>
<span class="balise sanslt">&lt;!-- ceci-est-un-commentaire --&gt;</span><br/>
est valide mais pas<br/>
<span class="balise sanslt">&lt;!-- ---------- commentaire --------- --&gt;</span></p>

<p>Avec l’exemple précédent, on obtiens…</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/rectangle-noir.svg">Vous devriez voir un rectangle noir !</object>
</div>

<p>… un rectangle noir pas superbement beau <object type="image/gif" data="images/smileys/helpsmilie.gif">:O</object>. Mais
avant de lui mettre de la couleur, schématisons ce qui s’est passé :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/formes-de-base/rectangle-noir-schema.svg">Vous devirez voir un rectangle noir !</object>
</div>

<p>Notre rectangle de largeur 100 pixels et de hauteur 40 pixels a subi une translation qui l’a déplacé de 50 sur l’axe des abscisse et
celui des ordonnées. Vous avez sans doute remarqué que nous n’avons pas spécifié l’unité : dans ce cas on considère que ce sont des
pixels.<br/>
Pour l’habiller, il faut utiliser l’attribut style. On va voir trois propriétés CSS : <span class="csspropertie">fill</span>,
<span class="csspropertie">stroke</span> et <span class="csspropertie">stroke-width</span>.</p>

<ul class="list-css-values">
<li><span class="csspropertie">fill</span> donne la valeur de remplissage, c’est à dire la couleur dont sera peint notre rectangle ;</li>
<li><span class="csspropertie">stroke</span> est la couleur de la bordure de notre objet ;</li>
<li><span class="csspropertie">stroke-width</span> est la taille de cette bordure.</li>
</ul>

<p class="rappel">Pour écrire du style en ligne, on doit utiliser la syntaxe suivante :<br/>
<span class="balise">balise style="propriété<sub>1</sub>:valeur<sub>1</sub>;propriété<sub>2</sub>:valeur<sub>2</sub>;propriété<sub>n</sub>:valeur<sub>n</sub>"</span><br/>
Pour la couleur, on peut utiliser les mots-clefs, par exemple :<br/>
<span class="csspropertie">fill:red;</span><br/>
ou alors la notation rgb :<br/>
<span class="csspropertie">fill:rgb(125,125,125);</span><br/>
<span class="csspropertie">fill:rgb(10%,70%,27%);</span><br/>
ou encore la noatation hexadecimale :<br/>
<span class="csspropertie">fill:#ffa14e;</span><br/>
Visitez les <a href="http://www.siteduzero.com/xhtml-css/formatage_partie2.php#couleurs">cours du siteduzero</a> pour de plus amples
explications.</p>

<p>On peut donc décorer nos rectangles :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des rectangles de toutes les couleurs</title>

<!-- On dessine d’abord un premier rectangle qui « dessinera » les bords de notre dessin. On ne le rempli pas -->
<rect x="0" y="0" width="400" height="300" style="fill:none;stroke:slategray;stroke-width:2px;"/>

<!-- Puis on dessine divers rectangles. -->
<rect x="50" y="50" width="100" height="40" style="fill:cornsilk;stroke:cornflowerblue;stroke-width:1px;"/>

<rect x="300" y="10" width="60" height="280" style="fill:none;stroke:indigo;stroke-width:10px;"/>

<rect x="50" y="160" width="270" height="84" style="fill:lavender;stroke:none;"/>

<rect x="100" y="140" width="40" height="80" style="fill:none;stroke:yellowgreen;stroke-width:3px;"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/rectangles.svg">Vous devriez voir des rectangles de toutes les
couleurs !</object>
</div>

<p>Une petite remarque : je n’utilise quasiment que les mots clefs CSS dont voici
<a href="http://skedar.dark.free.fr/ultimategraph/main.php5?file=listcolor">la liste</a>.</p>
<p>Quand on ne veut pas que notre forme soit remplie, on met <span class="csspropertie">fill:none;</span>.
<span class="csspropertie">none</span> est un mot-clé CSS qui signifie « sans ». On n’a pas besoin de faire de même avec
<span class="csspropertie">stroke</span> puisqu’aucune bordure n’est dessinée si rien n’est indiqué. La taille d’une bordure
peut bien sur être précisée avec les différentes unités citées plus haut.</p>

<p>Vous avez sans doute remarqué que les rectangles se superposent selon l’ordre dans lequel ils sont placés dans le code XML.
En SVG, il <em>n’existe pas</em> de propriété CSS qui contrôle la superposition des éléments comme la propriété
<span class="csspropertie">z-index</span> qui permet de définir l’orde de superposition de blocs XHTML par exemple.</p>

<p>On aimerait avoir des coins arrondis. C’est possible grâce aux attributs <span class="attribute">rx</span> et
<span class="attribute">ry</span>. Les valeurs de ces attributs doivent être comprises entre 0 et la moitié de la taille
du côté. <span class="attribute">rx</span> agit bien évidemment sur les deux côtés <span class="attribute">width</span> et
<span class="attribute">ry</span> sur les deux côtés <span class="attribute">height</span>.</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/rectangles-arrondis.svg">Vous devriez voir des rectangles aux bords
arrondis et de toutes les couleurs !</object>
</div>

<p>Voici la source :</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des rectangles de toutes les couleurs et aux bords arrondis !</title>

<rect x="10" y="10" width="80" height="200" rx="20" ry="20"
style="stroke:blueviolet;stroke-width:10px;fill:none;"/>

<rect x="130" y="20" width="290" height="120" rx="100" ry="10"
style="fill:floralwhite;stroke:hotpink;stroke-width:7px;"/>

<rect x="160" y="180" width="200" height="110" rx="70" ry="55"
style="fill:lemonchiffon;stroke:yellowgreen;stroke-width:1px;"/>

<rect x="5" y="218" width="120" height="80" rx="60" ry="40"
style="fill:none;stroke:slategray;stroke-width:2px;"/>

</svg>]]></div>

<p>Vous avez remarqué que plus les attributs <span class="attribute">rx</span> et <span class="attribute">ry</span> sont grands,
plus la « courbure » du « coin » est grande. Au contraire, si on veut faire des coins armonieux, il vaut mieux mettre la même valeur
pour ces deux attributs (c’est le premier rectangle bleu-violet). D’ailleurs, si on ne spécifie que
<span class="attribute">rx</span>, <span class="attribute">ry</span> prend la même valeur et vice versa.
Vous avez sans doute vu que le dernier rectangle (en bas à gauche) ressemble plutôt à une ellipse ! La balise
<span class="balise">rect</span> peut être utilisée pour faire des ellipses, mais il y a plus simple :
c’est ce qu’on va voir maintenant ! <object type="image/gif" data="images/smileys/rolleyes.gif">
:)</object></p>


<h3 id="cercles">Les cercles et les ellipses</h3>

<p>Vous allez être surpris, mais pour peindre nos formes, on utilise les mêmes attributs. Ainsi, le cercle ne déroge pas à la règle
et on peut le remplir avec <span class="csspropertie">fill</span>, colorer sa bordure avec <span class="csspropertie">stroke</span>
et l’épaissir à souhait avec <span class="csspropertie">stroke-width</span>.<br/>
Pour dessiner un cercle, on utilise la balise <span class="balise">circle</span>. Elle doit avoir trois attributs :</p>

<ul class="list-attributes">
<li><span class="attribute">cx</span> donne à SVG l’abscisce du centre du cercle ;</li>
<li><span class="attribute">cy</span> l’ordonnée du centre ;</li>
<li><span class="attribute">r</span> est le rayon.</li>
</ul>

<p>Simplissime, n’est il pas ?</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des cercles, des cercles, encore des cercles…</title>

<!-- œil gauche -->
<circle cx="100" cy="100" r="50"
style="fill:none;stroke:black;stroke-width:3px;"/>

<circle cx="110" cy="110" r="23"
style="stroke:slategray;stroke-width:1px;fill:powderblue;"/>

<circle cx="120" cy="120" r="3"
style="fill:black;"/>

<!-- œil droit -->
<circle cx="300" cy="100" r="50"
style="fill:none;stroke:black;stroke-width:3px;"/>

<circle cx="310" cy="110" r="23"
style="stroke:slategray;stroke-width:1px;fill:powderblue;"/>

<circle cx="320" cy="120" r="3"
style="fill:black;"/>

<!-- bouche… ? -->
<circle cx="200" cy="240" r="30"
style="fill:thistle;"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/cercles.svg">Vous devriez voir des cercles !</object>
</div>

<p>N’oubliez pas de commenter votre code, sinon vous risquez de ne plus savoir où est la balise truc qui affiche le machin de…
Bref des commentaires bien placés vous éviterons de devoir replonger entièrement dans votre code quand vous voudrez le modifier
(cette remarque est d’ailleurs valable pour tous les langages de programmation).<br/>
Comme vous les voyez, tracer un cercle n’oppose pas vraiment de difficulté : on le rempli avec <span class="csspropertie">fill</span>
pour obtenir un disque, sinon, si on ne veut qu’un cercle, on met <span class="csspropertie">fill:none;</span> et on met des valeurs
à <span class="csspropertie">stroke</span> et à <span class="csspropertie">stroke-width</span>. Heureusement pour nous, il existe
d’autres propriétés CSS tout aussi intéressantes, dont <span class="csspropertie">fill-opacity</span>.<br/>
<span class="csspropertie">fill-opacity</span> sert à indiquer l’opacité de la couleur de remplissage d’une forme. On lui donne une
valeur comprises entre 0 et 1, 1 signifiant opaque et 0 transparent. Par défaut, cette valeur est fixée à 1.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des cercles d’opacités différentes</title>

<circle cx="200" cy="100" r="90"
style="stroke:black;stroke-width:1px;fill:magenta;fill-opacity:0.6;"/>

<circle cx="140" cy="200" r="90"
style="stroke:black;stroke-width:1px;fill:cyan;fill-opacity:0.6;"/>

<circle cx="260" cy="200" r="90"
style="stroke:black;stroke-width:1px;fill:yellow;fill-opacity:0.4;"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/cercles-synthese.svg">En SVG, on peut spécifier l’opacité
de la couleur peinte.</object>
</div>

<p>Notez que si j’ai mis une valeur plus basse pour le jaune, c’est parceque l’œil humain le « voit » beaucoup mieux.</p>
<p>Maintenant que nous savons tracer des cercles, intéressons nous aux ellipse. C’est sensiblement la même chose, sauf qu’on
utilise la balise <span class="balise">ellipse</span>. Elle requiert quatre attributs :</p>

<ul class="list-attributes">
<li><span class="attribute">cx</span> comme pour le cercle est l’abscisse du centre ;</li>
<li>idem pour <span class="attribute">cy</span> ;</li>
<li><span class="attribute">rx</span> est le rayon « horizontal » de l’ellipse ;</li>
<li><span class="attribute">ry</span> le rayon « vertical ».</li>
</ul>

<p>Notez que comme pour le cercle, si <span class="attribute">cx</span> et/ou <span class="attribute">cy</span> ne sont pas renseignés,
ils prennent zéro comme valeur. Voici le schéma d’une ellipse :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/formes-de-base/ellipse-schema.svg">Schéma d’une ellipse en SVG</object>
</div>

<p>Maintenant, un petit mot à propos de la bordure. Vous remarquez sans doute que les lignes <span class="attribute">rx</span> et <span class="attribute">ry</span> ne s’arrêtent pas au bord
intérieur de la bordure verte, mais au milieu. En fait, la longueur <span class="csspropertie">stroke-width</span> est dessinée
également de part et d’autre de la bordure. Par exemple, si on met <span class="csspropertie">stroke-width:10px;</span>, il y aura
5 pixels de chaque côté de la bordure.<br/>
De la même manière qu’on peut régler l’opacité de la couleur de remplissage grâce à
<span class="csspropertie">fill-opacity</span>, il existe une propriété pour faire de même avec les bordures : c’est
<span class="csspropertie">stroke-opacity</span>. Comme pour <span class="csspropertie">fill-opacity</span>, sa valeur doit être
comprise entre 0 et 1 et est, par défaut, réglée à 1. La propriété <span class="csspropertie">opacity</span> permet quant à elle
de définir d’un seul coup l’opacité de toute la forme, bordure comprise.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des ellipses de toutes les couleurs avec SVG</title>

<ellipse cx="200" cy="150" rx="180" ry="50"
style="fill:none;stroke:lightsteelblue;stroke-width:30px;stroke-opacity:0.5;"/>

<ellipse cx="200" cy="150" rx="50" ry="130"
style="fill:none;stroke:lightsteelblue;stroke-width:30px;stroke-opacity:0.5;"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/ellipses.svg">Schéma d’une ellipse en SVG</object>
</div>

<p>On peut facilement dessiner un point avec un élément <span class="balise">circle</span>, en lui mettant un petit rayon,
et c’est d’ailleurs la meilleur manière de le faire. Maintenant, passons aux lignes…</p>

<h3 id="lignes">Les lignes</h3>

<p>Pour dessiner un ligne, on utilise la balise <span class="balise">line</span> qui a besoin de quatre attributs :</p>

<ul class="list-attributes">
<li><span class="attribute">x1</span> renseigne l’abscisse du point de départ ;</li>
<li><span class="attribute">y1</span> l’ordonnée du point de départ ;</li>
<li><span class="attribute">x2</span> l’abscisse du point d’arrivé ;</li>
<li><span class="attribute">y2</span> l’ordonnée du point d’arrivé.</li>
</ul>

<p>Une ligne n’a pas de couleur de remplissage (<span class="csspropertie">fill</span>) et si le viewer d’Adobe en dessine, c’est
une erreur !</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des lignes de toutes les couleurs avec SVG</title>

<line x1="100" x2="20" y1="20" y2="200"
style="fill:none;stroke:springgreen;stroke-width:2px;"/>

<line x1="150" x2="70" y1="40" y2="220"
style="fill:none;stroke:palegreen;stroke-width:4px;"/>

<line x1="200" x2="120" y1="60" y2="240"
style="fill:none;stroke:lightgreen;stroke-width:8px;"/>

<line x1="250" x2="170" y1="80" y2="260"
style="fill:none;stroke:yellowgreen;stroke-width:16px;"/>

<line x1="300" x2="220" y1="100" y2="280"
style="fill:none;stroke:mediumseagreen;stroke-width:32px;"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/lines.svg">Des lignes avec SVG</object>
</div>

<p>Dans cet exemple, on a mis <span class="csspropertie">fill:none;</span> juste pour corriger le bug du viewer d’Adobe, mais
ce n’est normalement pas nécessaire.</p>
<p>Ici, on a tracé des lignes continues, mais SVG est aussi capable de tracer des lignes pointillées. Pour cela, on utilise la
propriété CSS <span class="csspropertie">stroke-dasharray</span>. Sa valeur doit être un liste d’entiers positifs supérieurs à 0
séparés par des espaces blancs ou des virgules.<br/>
Par exemple : <span class="csspropertie">stroke-dasharray:5px,10px,3px,10px;</span><br/>
Dans cet exemple, il y aura un trait de 5 pixels, un blanc de 10 pixels, un trait de 3 pixels puis un blanc de 10 pixels. Ce motif
sera répété jusqu’au bout de la ligne. On peut bien sur mettre d’autres unités ou ne pas en mettre du tout, ce qui revient à
mettre des pixels. Si la liste est impaire, elle est doublée pour qu’elle deviennent paire. Par exemple :<br/>
<span class="csspropertie">stroke-dasharray:3 2 7;</span><br/>
devient<br/>
<span class="csspropertie">stroke-dasharray:3 2 7 3 2 7;</span>.</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Des lignes de toutes les couleurs et en pointillés avec SVG</title>

<line x1="100" x2="20" y1="20" y2="200"
style="fill:none;stroke:springgreen;stroke-width:2px;stroke-dasharray:4,5,8,5;"/>

<line x1="150" x2="70" y1="40" y2="220"
style="fill:none;stroke:palegreen;stroke-width:4px;stroke-dasharray:10,2;"/>

<line x1="200" x2="120" y1="60" y2="240"
style="fill:none;stroke:lightgreen;stroke-width:8px;stroke-dasharray:3,10,3;"/>

<line x1="250" x2="170" y1="80" y2="260"
style="fill:none;stroke:yellowgreen;stroke-width:16px;stroke-dasharray:1,12;"/>

<line x1="300" x2="220" y1="100" y2="280"
style="fill:none;stroke:mediumseagreen;stroke-width:32px;stroke-dasharray:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20;"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/lines-dasharray.svg">Des lignes en pointillés avec SVG</object>
</div>

<p>On peut demander à SVG de « décaler » le début du motif grâce à la propriété <span class="csspropertie">stroke-dashoffset</span>.
Par défaut, sa valeur est 0.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Tests de différentes valeurs pour la propriété CSS stroke-dashoffset</title>

<line x1="50" x2="350" y1="50" y2="50"
style="fill:none;stroke:black;stroke-width:3px;stroke-dasharray:30,30;stroke-dashoffset:-30;"/>

<line x1="50" x2="350" y1="100" y2="100"
style="fill:none;stroke:black;stroke-width:3px;stroke-dasharray:30,30;stroke-dashoffset:-15;"/>

<line x1="50" x2="350" y1="150" y2="150"
style="fill:none;stroke:black;stroke-width:3px;stroke-dasharray:30,30;stroke-dashoffset:0;"/>

<line x1="50" x2="350" y1="200" y2="200"
style="fill:none;stroke:black;stroke-width:3px;stroke-dasharray:30,30;stroke-dashoffset:15;"/>

<line x1="50" x2="350" y1="250" y2="250"
style="fill:none;stroke:black;stroke-width:3px;stroke-dasharray:30,30;stroke-dashoffset:30;"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/lines-dashoffset.svg">Des lignes en pointillés avec SVG</object>
</div>


<p>Il existe aussi une propriété qui permet de spécifier l’apparence des extrémités d’une ligne. Il s’agit de la propriété
<span class="csspropertie">stroke-linecap</span>. Elle peut prendre trois valeurs :</p>

<ul class="list-css-values">
<li><span class="csspropertie">butt</span> : c’est la valeur par défaut. L’extrémité s’arrête nette;</li>
<li><span class="csspropertie">round</span> : l’extrémité est arrondie;</li>
<li><span class="csspropertie">butt</span> : l’extrémité est un carré.</li>
</ul>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/formes-de-base/stroke-linecap-schema.svg">Schéma des valeurs possibles de la
propriété CSS stroke-linecap</object>
</div>

<p>Les lignes noires représentent les lignes d’origine.</p>
<p>Ces propriétés sont bien sur utilisables avec les autres formes que nous avons déjà vu, sauf
<span class="csspropertie">stroke-linecap</span> qu ne s’applique que sur des formes qui ont des extrémités ouvertes.</p>

<h3 id="polygones">Les lignes polygonales et les polygones</h3>

<p>Derrière l’appelation « lignes polygonales » se cache en fait une suite de segments, tout simplement. C’est la balise
<span class="balise">polyline</span> qu’on utilise et elle n’a besoin que d’un attribut :
<span class="attribute">points</span> qui contient une liste de couples de points qui délimitent notre ligne polygonale. Ces couples
peuvent être séparés par des espaces blancs ou des virgules. Par exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple d’utilisation de la balise polyline</title>

<polyline points="20,10 40,30 60,10 80,30 100,10 120,30 140,10 160,30 180,10
200,30 220,10 240,30 260,10 280,30 300,10 320,30 340,10 360,30 380,10"/>

<polyline points="20,60 40,80 60,60 80,80 100,60 120,80 140,60 160,80 180,60
200,80 220,60 240,80 260,60 280,80 300,60 320,80 340,60 360,80 380,60"
style="fill:none;stroke:black;stroke-width:4px;"/>

<polyline points="50,150 250,150 300,200 250,250 50,250"
style="fill:none;stroke:cornflowerblue;stroke-width:10px;stroke-dasharray:3,4,10,4;stroke-dashoffset:-7;"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/polylines.svg">Exemple d’utilisation de la balise polyline</object>
</div>

<p>Pour le premier <span class="balise">polyline</span>, il n’y a pas de style. La forme est donc remplie automatiquement.
Comme ce n’est pas, en général, l’effet recherché, on supprime le remplissage en écrivant
<span class="csspropertie">fill:none;</span> (second <span class="balise">polyline</span>). Ensuite, les différents segments
se comportent comme des <span class="balise">line</span>, c’est à dire qu’on peut utiliser les différentes propriétés CSS
vues plus haut (troisième <span class="balise">polyline</span>).</p>

<p>Les « coins » entre deux segments ne sont pas très agréable à l’œil : ce sont des carrés. On aimerais les arrondir : c’est
possible avec la propriété CSS <span class="csspropertie">stroke-linejoin</span>. Elle peut prendre trois valeurs :</p>

<ul class="list-css-values">
<li><span class="csspropertie">miter</span> : c’est la valeur par défaut. Visuellement, on a un coin carré;</li>
<li><span class="csspropertie">round</span> : cette valeur permet d’arrondir le coin;</li>
<li><span class="csspropertie">bevel</span> : hmm … on obtient quelquechose de difficilement descriptible, c’est pourquoi je vous
offre ce schéma <object type="image/gif" data="images/smileys/innocent.gif">:)</object>.</li>
</ul>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/formes-de-base/stroke-linejoin.svg">
Illustration des différentes valeurs de la propriété CSS stroke-linejoin</object>
</div>

<p>Quand la rencontre de deux segments forme un angle aigu et que la valeur de <span class="csspropertie">stroke-linejoin</span> est
<span class="csspropertie">mitter</span> (qui est la valeur par défaut), il est possible d’étendre la jointure avec la propriété
<span class="csspropertie">stroke-miterlimit</span>. Par défaut, sa valeur est 4 mais elle peut varier de 1 inclu à l’infini.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Variations de la valeur de la propriété CSS stroke-miterlimit</title>

<polyline points="20,35 200,50 20,65"
style="fill:none;stroke:khaki;stroke-width:10px;stroke-miterlimit:1;"/>

<polyline points="20,85 200,100 20,115"
style="fill:none;stroke:khaki;stroke-width:10px;stroke-miterlimit:4;"/>

<polyline points="20,135 200,150 20,165"
style="fill:none;stroke:khaki;stroke-width:10px;stroke-miterlimit:10;"/>

<polyline points="20,185 200,200 20,215"
style="fill:none;stroke:khaki;stroke-width:10px;stroke-miterlimit:20;"/>

<polyline points="20,235 200,250 20,265"
style="fill:none;stroke:khaki;stroke-width:10px;stroke-miterlimit:40;"/>


</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/stroke-miterlimit.svg">
Variations de la valeur de la propriété CSS stroke-miterlimit</object>
</div>

<p>Le support de cette propriété est buggé avec le viewer d’Adobe.</p>

<p>Passons aux polygones. En fait c’est quasiment la même chose, à deux différences près : un segment est automatiquement tracé
entre le dernier point et le premier et on utilise l’élément <span class="balise">polygon</span> au lieu de
<span class="balise">polyline</span>. C’est tout !</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un test de l’élément SVG polygon</title>

<polygon points="20,20 70,60 120,30 150,80 200,20 250,80 280,30 330,60 380,20
320,150
380,280 330,240 280,270 250,220 200,280 150,220 120,270 70,240 20,280
80,150"
style="fill:cornsilk;fill-opacity:0.6;stroke:darkblue;stroke-width:7px;stroke-miterlimit:40;"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/formes-de-base/polygon.svg">
Utilisation de la balise polygon</object>
</div>

<p>Vous savez à peu près tout sur les formes de bases, mais sachez qu’il existe un élément générique qui permet de dessiner tout ce
qu’on a déjà dessiné, et bien plus encore… <object type="image/gif" data="images/smileys/sweatdrop.gif">^^'</object>… mais de
manière bien plus compliqué.<br/>
Jusqu’à maintenant, on ne peut pas vraiment dessiner nos formes dans tous les sens. C’est possible avec ce que nous allons étudier
maintenant : les transformations.</p>

<div class="previouspage"><a href="un-premier-document-svg.php" title="cours précédent">Un premier document SVG</a></div>
<div class="nextpage"><a href="transformations.php" title="cours suivant">Les transformations</a></div>

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
