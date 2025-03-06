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
<h2>Animations (partie 2)</h2>

<p style="font-style:italic;font-size:104%"><img src="images/dialog-warning.png" alt="Attention" /> À l’heure actuelle, le seul navigateur qui vous permettra de visualiser au mieux les exemples de ce site est <a href="http://www.opera.com/download/">Opera</a>. Par exemple, les animations ne fonctionnent correctement <strong>que</strong> sous Opera. Sous Firefox 3.5 et inférieur, un script (FakeSmile) simule les fonctions d’animations mais beaucoup d’exemples sont buggés.</p>

<p>Il est grand temps de passer aux choses sérieuses. Les animations sont beaucoup plus puissantes que ce que vous avez pu voir jusque là. Il est possible de contrôler encore plus finement les animations, à tel point que la seule limite que vous aurez après avoir lu cette page sera votre imagination.</p>


<ul class="sommaire">
<li><a href="#salade">Salade de <span class="attribute">from</span>, <span class="attribute">by</span> et <span class="attribute">to</span></a></li>
<li><a href="#valeurs">Liste de valeurs, repères de temps</a></li>
<li><a href="#paced-discrete">Les modes d’animation <span class="attribute">paced</span> et <span class="attribute">discrete</span></a></li>
<li><a href="#spline">Le mode d’animation <span class="attribute">spline</span></a></li>
<li><a href="#add">Animations additives</a></li>
<li><a href="#sync">Synchronisation en pagaille</a></li>
<li><a href="#vrac">En vrac</a></li>
</ul>


<h3 id="salade">Salade de <span class="attribute">from</span>, <span class="attribute">by</span> et <span class="attribute">to</span></h3>

<h4><span class="attribute">from to</span></h4>

<p>Vous connaissez déjà l’animation <span class="attribute">from to</span> : elle permet de faire varier un attribut d’une valeur d’origine à une valeur finale. C’est la plus simple mais aussi la moins flexible, puisque vous devez connaître ces deux valeurs.</p>

<h4><span class="attribute">from by</span></h4>

<p>C’est un variante du <span class="attribute">from to</span> mais à la différence que dans ce cas, on ne précise pas la valeur finale. Au lieu de cela, on indique de combien sera incrémentée (ou décrémentée) la valeur initiale. L’attribut <span class="attribute">by</span> pourrait être traduit en français par « de combien » et peut prendre une valeur positive ou négative.</p>

<h4><span class="attribute">to</span></h4>

<p>Si on indique seulement l’attribut <span class="attribute">to</span>, on indique seulement la valeur finale. Il s’agit donc d’une animation <span class="attribute">from to</span> sauf qu’il n’est pas nécessaire de connaître la valeur de départ. C’est très utile lorsque la valeur de <span class="attribute">from</span> est générée dynamiquement (grâce à php par exemple) ou lorsqu’elle est modifié avant le lancement de l’animation (avec javascript par exemple).</p>

<h4><span class="attribute">by</span></h4>

<p>Pour finir, voici l’animation la plus flexible, j’ai nommé <span class="attribute">by</span> ! Flexible, puisqu’on indique la valeur à ajouter (ou enlever). Pas besoin, comme précédemment, de renseigner l’attribut <span class="attribute">from</span>.</p>

<h4>Récapitulatif</h4>

<p>Rien ne vaut un petit exemple avec toutes ces animations. Comme d’habitude, rafraîchissez la page pour voir l’animation.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="salade.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Différentes animations avec SVG</title>

<rect id="rect1" x="40" y="50" width="100" height="20">
	<!-- from … to -->
	<animate attributeName="width" attributeType="XML" from="10" to="300"
	begin="3s" dur="10s" fill="freeze"/>
</rect>

<rect id="rect2" x="40" y="110" width="100" height="20">
	<!-- from …  by -->
	<animate attributeName="width" attributeType="XML" from="200" by="-150"
	begin="3s" dur="10s" fill="freeze"/>
</rect>

<rect id="rect3" x="40" y="170" width="100" height="20">
	<!-- to -->
	<animate attributeName="width" attributeType="XML" to="300"
	begin="3s" dur="10s" fill="freeze"/>
</rect>

<rect id="rect4" x="40" y="230" width="350" height="20">
	<!-- by -->
	<animate attributeName="width" attributeType="XML" by="-300"
	begin="3s" dur="10s" fill="freeze"/>
</rect>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	stroke:black;
	stroke-width:3;
	stroke-dasharray:4 6;
	stroke-linecap:round;
	}

#rect1{
	fill:lightblue;
	}

#rect2{
	fill:lawngreen;
	}

#rect3{
	fill:mistyrose;
	}

#rect4{
	fill:#ffffa0 ;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/salade.svg">Différentes animations avec SVG</object>
</div>

<h3 id="valeurs">Liste de valeurs, repères de temps</h3>

<p>Néanmoins ces modes d’animations sont plutôt simple. SVG permet de définir une liste de valeurs qu’un attribut devra prendre, ainsi qu’une liste de repères temporels synchronisée avec une liste de valeurs.</p>

<h4>Liste de valeurs</h4>

<p>On peut remplacer les attributs <span class="attribute">from</span>, <span class="attribute">to</span> et <span class="attribute">by</span> par l’attribut <span class="attribute">values</span> qui doit contenir une liste des différentes valeurs prises par l’attribut animé. Les valeurs sont séparés par des points-virgules. Rien de bien compliqué en somme.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="values-attribut.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’attribut d’animation values</title>

<!-- les différents repères -->

<line x1="50" x2="50" y1="120" y2="180"/>
<text x="50" y="120">50</text>

<line x1="110" x2="110" y1="100" y2="180"/>
<text x="110" y="100">110</text>

<line x1="130" x2="130" y1="120" y2="180"/>
<text x="130" y="120">130</text>

<line x1="230" x2="230" y1="120" y2="180"/>
<text x="230" y="120">230</text>

<line x1="250" x2="250" y1="100" y2="180"/>
<text x="250" y="100">250</text>

<line x1="370" x2="370" y1="120" y2="180"/>
<text x="370" y="120">250</text>

<!-- fin des repères -->

<rect x="30" y="130" width="20" height="40">
	<animate attributeName="width" attributeType="XML"
	begin="3.5s" dur="15s" fill="freeze"
	values="20; 100; 80; 200; 220; 340"/>
</rect>


</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:lightcoral;
	}

line{
	fill:none;
	stroke:black;
	}

text{
	text-anchor:middle;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/values-attribut.svg">L’attribut d’animation values</object>
</div>

<p>Un détaille vous a peut être attiré l’œil. En effet, la vitesse de l’animation n’est pas constante : elle va beaucoup plus vite entre <span class="attribute">50</span> et <span class="attribute">130</span> qu’entre <span class="attribute">130</span> et <span class="attribute">110</span>. Plus la distance a parcourir est grande, plus c’est rapide !</p>

<p>Les rares personnes qui ont implenté une horloge dans leur cerveau ont sans doute déjà compris pourquoi. Pour les autres, voici les explications <object type="image/gif" data="images/smileys/whistling.gif">:-°</object>.</p>

<p>Si vous prenez un chronomètre, vous remarquerez que chaque animation d’un repère à l’autre (donc entre deux valeurs de l’attribut <span class="attribute">values</span>) dure exactement 3 secondes. Pourquoi 3 secondes ? C’est simplement la durée totale de l’animation (<span class="attribute">dur="15s"</span>) divisée par le nombre de phases. 15 secondes divisées par 5 phases font bien 3 secondes pour chaque phase.</p>

<p>Ce mode est appelé mode linéaire et est la valeur par défaut pour l’attribut <span class="attribute">calcMode</span> que nous verrons plus tard.</p>

<h4>Les repères temporels</h4>

<p>Dans l’exemple précédent, la durée de chaque phase était fixée par la durée et le nombre de phases. Il est cependant possible de fixer soi-même le temps de chaque phase grâce à l’attribut <span class="attribute">keyTimes</span>. Cet attribut contient une liste de pourcentage (séparés par des points-virgules) de temps, le temps de référence étant celui donné par l’attribut <span class="attribute">dur</span>.  Il doit y avoir le même nombre d’éléments dans les deux listes si bien que chaque valeur donnée dans <span class="attribute">values</span> corresponde au pourcentage de temps correspondant dans <span class="attribute">keyTimes</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="keyTimes-attribut.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les repères temporels</title>

<!-- les différents repères -->

<line x1="50" x2="50" y1="120" y2="180"/>
<text x="50" y="120">0</text>

<line x1="100" x2="100" y1="120" y2="180"/>
<text x="100" y="120">50</text>

<line x1="150" x2="150" y1="120" y2="180"/>
<text x="150" y="120">100</text>

<line x1="200" x2="200" y1="120" y2="180"/>
<text x="200" y="120">150</text>

<line x1="250" x2="250" y1="120" y2="180"/>
<text x="250" y="120">200</text>

<line x1="300" x2="300" y1="120" y2="180"/>
<text x="300" y="120">250</text>

<line x1="350" x2="350" y1="120" y2="180"/>
<text x="350" y="120">300</text>

<!-- fin des repères -->

<rect x="50" y="130" width="50" height="40">
	<animate attributeName="width" attributeType="XML"
	begin="4s" dur="20s" fill="freeze"
	values="50; 100; 150; 200; 250; 300"
	keyTimes="0; 0.05; 0.3; 0.4; 0.9; 1"/>
</rect>


</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:aquamarine;
	}

line{
	fill:none;
	stroke:black;
	}

text{
	text-anchor:middle;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/keyTimes-attribut.svg">Les repères temporels</object>
</div>

<p>Désormais, c’est <strong>vous</strong> qui décidez du chronométrage de vos animations !</p>

<p>Travailler avec des pourcentages de temps n’est pas forcément très pratique, je l’admet. Vous pouvez vérifier que tout se passe bien avec un chronomètre. La première phase dure 0,05 × 20s, soit une seconde.</p>

<p>La seconde phase dure 0,3 - 0,05 soit 0,25 ou encore un quart de l’animation : 5 secondes.</p>

<p>La troisième 0,4 - 0,3 soit 0,1 = 10% de la durée totale : 2 secondes. Et ainsi de suite.</p>

<p class="rappel">Ne vous ai-je pas dit que SVG, c’est beaucoup de calcul mental ?</p>


<h3 id="paced-discrete">Les modes d’animation <span class="attribute">paced</span> et <span class="attribute">discrete</span></h3>

<p>Il existe plusieurs modes d’animation. Jusqu’à maintenant, on a utilisé le mode par défaut qui est <span class="attribute">linear</span> (sauf pour <span class="balise">animateMotion</span>). Le mode d’animation se définit avec l’attribut <span class="attribute">calcMode</span>.</p>

<h4>Le mode d’animation <span class="attribute">paced</span></h4>

<p>Le mode d’animation <span class="attribute">paced</span> permet une animation régulière (sans accélération ou ralentir) sur <strong>toute</strong> l’animation, et pas seulement entre les phases comme pour le mode <span class="attribute">linear</span>.</p>

<p>Par conséquent, un éventuel attribut <span class="attribute">keyTimes</span> est inutile et ne sera pas traité dans ce mode. Reprenons l’exemple de l’animation <span class="attribute">linear</span> en mode <span class="attribute">paced</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="paced.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Le mode d’animation paced</title>

<!-- les différents repères -->

<line x1="50" x2="50" y1="120" y2="180"/>
<text x="50" y="120">50</text>

<line x1="110" x2="110" y1="100" y2="180"/>
<text x="110" y="100">110</text>

<line x1="130" x2="130" y1="120" y2="180"/>
<text x="130" y="120">130</text>

<line x1="230" x2="230" y1="120" y2="180"/>
<text x="230" y="120">230</text>

<line x1="250" x2="250" y1="100" y2="180"/>
<text x="250" y="100">250</text>

<line x1="370" x2="370" y1="120" y2="180"/>
<text x="370" y="120">370</text>

<!-- fin des repères -->

<rect x="30" y="130" width="20" height="40">
	<animate attributeName="width" attributeType="XML"
	begin="3.5s" dur="15s" fill="freeze"
	calcMode="paced"
	values="20; 100; 80; 200; 220; 340"/>
</rect>


</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:lightcoral;
	}

line{
	fill:none;
	stroke:black;
	}

text{
	text-anchor:middle;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/paced.svg">Le mode d’animation paced</object>
</div>

<p>Comme vous le voyez, la vitesse reste constante.</p>

<h4>Le mode d’animation <span class="attribute">discrete</span></h4>

<p>Ce mode est un peu particulier puisqu’il n’y a pas d’interpolation entre les différentes phases. Je vous vois tiquer. Si, si <object type="image/gif" data="images/smileys/shifty.gif">:|</object>.</p>

<p class="rappel">Pour faire simple, l’interpolation est l’opération permettant de savoir la valeur de l’attribut animé entre deux valeurs données. Par exemple, dans le cas d’une interpolation linéaire, si on fait varier un attribut de 0 à 100 pendant huit secondes, on a qu’à quatre secondes (la moitié de l’animation), l’attribut vaut la moitié soit 50. Mais ceci n’est que l’interpolation linéaire. La prochaine partie traite d’interpolation non linéaire mais non moins sympathique.</p>

<p>Mais en attendant la prochaine partie, revenons à nos moutons : le mode <span class="attribute">discrete</span>. On l’utilise avec les attributs <span class="attribute">values</span> et <span class="attribute">keyTimes</span>. Chaque valeur de <span class="attribute">values</span> est liée (dans l’ordre) à une valeur de <span class="attribute">keyTimes</span> (ce dernier attribut devant obligatoirement commencer par zéro dans ce cas). Lorsqu’on arrive au temps spécifié dans l’attribut <span class="attribute">keyTimes</span>, la valeur de l’attribut est changé avec la valeur correspondante de l’attribut <span class="attribute">values</span>, et ainsi de suite pour les différentes valeurs de temps.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="discrete.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Le mode d’animation discrete</title>


<g>

<!-- les différents cercles -->
<!-- pour la position des points, c’est de la simple trigo -->

<!-- par exemple pour le point c2, cx=centre x + rayon * cos(pi/4)
     soit cx = 200 + 100 * √2/2 -->

<circle id="c1" cx="200" cy="50" r="8"/>
<circle id="c2" cx="270.71" cy="79.29" r="8"/>
<circle id="c3" cx="300" cy="150" r="8"/>
<circle id="c4" cx="270.71" cy="220.71" r="8"/>
<circle id="c5" cx="200" cy="250" r="8"/>
<circle id="c6" cx="129.29" cy="220.71" r="8"/>
<circle id="c7" cx="100" cy="150" r="8"/>
<circle id="c8" cx="129.29" cy="79.29" r="8"/>

<!-- fin des cercles -->


<!-- on effectue l’animation-transformation sur le <g/> tout entier -->
<animateTransform attributeName="transform" attributeType="XML"
	type="rotate" begin="0s" dur="1s" repeatCount="indefinite"
	calcMode="discrete"
	values="0, 200, 150;
	 	45, 200, 150;
	 	90, 200, 150;
	 	135, 200, 150;
	 	180, 200, 150;
	 	225, 200, 150;
	 	270, 200, 150;
	 	315, 200, 150"
	keyTimes="0; 0.125; 0.25; 0.375; 0.5; 0.625; 0.75; 0.875"/>
	<!-- note : 200, 150 sont le centre de rotation -->
	<!-- le nombre avant est l’angle de rotation -->

</g>


</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:deepskyblue;
	}

#c1{
	fill-opacity:0.1;
	}

#c2{
	fill-opacity:0.2;
	}

#c3{
	fill-opacity:0.3;
	}

#c4{
	fill-opacity:0.4;
	}

#c5{
	fill-opacity:0.55;
	}

#c6{
	fill-opacity:0.7;
	}

#c7{
	fill-opacity:0.85;
	}

#c8{
	fill-opacity:1;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/discrete.svg">Le mode d’animation discrete</object>
</div>

<p>Aller, un autre petit exemple marrant : mettez cette image en plein écran et fixez la croix au milieu !</p>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/discrete-illusion.svg">Le mode d’animation discrete peut servir à créer des illusions d’optique</object>
</div>

<p>Passons maintenant aux choses sérieuses.</p>

<h3 id="spline">Le mode d’animation <span class="attribute">spline</span></h3>

<p>Le mode d’animation <span class="attribute">spline</span> permet de faire de l’animation à interpolation non linéaire. Qu’est ce que cela veut-il dire ? Avec l’interpolation linéaire, à la moitié de l’animation, la valeur animée avait fait la moitié du chemin à parcourir (grosso modo). Avec ce nouveau mode d’animation, il est possible de faire varier l’attribut en accélérant au début, pui en ralentissant brusquement vers le milieu, pour finir par réaccélérer vers la fin.</p>

<p>Comment cela fonctionne-t-il ? Il s’agit en fait… de courbes de Bézier quadratiques. Vous vous souvenez ?</p>

<p>Trois attributs sont importants dans ce mode d’animation. D’abord, on fixe <span class="attribute">calcMode</span> à la valeur <span class="attribute">spline</span>. Ensuite, on définit une ou plusieurs liste de points de contrôle dans l’attribut <span class="attribute">keySplines</span> qui seront utilisés entre les périodes de temps définies, elles, dans <span class="attribute">keyTimes</span>.</p>

<p>Si on a <span class="attribute">keySplines="liste1 ; liste2 ; liste3"</span> et <span class="attribute">keyTimes="t0 ; t1 ; t2 ; t3</span> alors les valeurs de <span class="attribute">liste1</span> seront utilisées entre <span class="attribute">t0</span> et <span class="attribute">t1</span>, les valeurs de liste2 entre <span class="attribute">t1</span> et <span class="attribute">t2</span> et les valeurs de liste3 entre <span class="attribute">t2</span> et <span class="attribute">t3</span>.</p>

<p>Reste la question principale : quelles sont les données des listes ? Chaque liste est en fait constituée de deux points de contrôle d’une courbe de Bézier quadratique, et donc de quatre valeurs : <span class="attribute">x1</span> et <span class="attribute">y1</span> pour le premier point de contrôle, <span class="attribute">x2</span> et <span class="attribute">y2</span> pour le second. Maintenant, je peux enfin vous dire où commence et où finit la courbe : respectivement en (0,0) et (1, 1). Ainsi les valeurs des listes doivent être comprises entre 0 et 1.</p>

<p>Nous touchons enfin au but : comment est définie l’interpolation de notre animation ! C’est simple. Imaginez une ligne tracée entre le point (0, 0) et (1, 1) : c’est l’animation correspondant à l’interpolation linéaire. Si notre courbe de Bézier s’en éloigne au dessus, on accélère. Si elle s’en rapproche en étant au dessus, on ralentit. Au contraire en dessous, si on s’en éloigne alors on ralentit et si on s’en rapproche, on accélère.</p>

<p>Exemple avec comme points 0.27,0.8 et 0.76,0.15 :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/spline-schema.svg">Schéma pour spline</object>
</div>

<p>La ligne grise est la ligne de référence, celle de l’interpolation linéaire. Entre p0 et p1, la courbe s’éloigne au dessus de la courbe. L’animation accélère donc. Entre p1 et p2, c’est le contraire : d’une part la courbe se rapproche au dessus de la ligne puis s’en éloigne en dessous, donc le mouvement ralentit. Et pour finir, la courbe se rapproche de la ligne droite en étant en dessous : le mouvement réaccélère. Testons pour de vrai ce type d’animation :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="UTF-8" standalone="no"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="spline.css" charset="utf-8"?>

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Une animation avec interpolation non linéaire</title>

<rect x="30" y="130" width="40" height="40" id="rect">
	<animate attributeName="x" attributeType="XML"
	to="370"
	begin="5s" repeatCount="indefinite"
	dur="7s"
	calcMode="spline" keySplines="0.27 0.8 0.76 0.15"/>
</rect>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:khaki;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/spline.svg">Une animation avec interpolation non linéaire</object>
</div>

<p>Vous vous dites peut être que c’est cool mais pas très pratique. Ça serait vrai si un magnifique et très pratique outil n’existait pas : <a href="http://www.carto.net/papers/svg/samples/keysplines.svg">l’éditeur de keySpline de carto.net</a>. Placez vos points, visualisez la vitesse (à droite) et tester votre animation ! Amusez vous bien <object type="image/gif" data="images/smileys/rolleyes.gif">:)</object>.</p>

<h3 id="add">Animations additives</h3>

<h4>L’attribut <span class="attribute">additive</span></h4>

<p>Que se passe-t-il lorsque plusieurs animations agissent sur le même attribut et en même temps ? Par défaut, c’est la dernière animation dans l’ordre du document qui priment sur les précédentes, qui elles sont annulées.</p>

<p>L’attribut <span class="attribute">additive</span> lorsqu’il est fixé à <span class="attribute">sum</span> permet de changer ce comportement. Dans ce cas, les valeurs des différentes animations <strong>ainsi</strong> que la valeur d’origine de l’attribut sont additionnés.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="additive.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’attribut d’animation additive</title>

<!-- en haut sans additive="sum" -->

<rect x="20" y="60" width="200" height="30">
	<animate attributeName="width" attributeType="XML"
	begin="2s" dur="3s"
	from="0" to="-60"/>

	<animate attributeName="width" attributeType="XML"
	begin="3s" dur="3s" fill="freeze"
	from="0" to="150"/>
</rect>


<!-- barre délimitatrice -->
<line x1="10" x2="390" y1="150" y2="150"/>


<!-- en bas, avec additive="sum" -->

<rect x="20" y="210" width="200" height="30">
	<animate attributeName="width" attributeType="XML"
	begin="2s" dur="3s" fill="freeze"
	from="0" to="-60" additive="sum"/>

	<animate attributeName="width" attributeType="XML"
	begin="3s" dur="3s" fill="freeze"
	from="0" to="150" additive="sum"/>
</rect>

</svg>]]></div>

<div class="csscode"><![CDATA[line{
	fill:none;
	stroke:black;
	stroke-width:3;
	stroke-linecap:round;
	}

rect{
	fill:none;
	stroke:lime;
	stroke-width:10;
	stroke-linejoin:round;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/additive.svg">L’attribut d’animation additive</object>
</div>

<p>Sur le rectangle du haut, point d’additivité. Du coup, lorsque la première animation se déclenche, l’attribut <span class="attribute">width</span> passe à 0 puis prend de valeurs de plus en plus négatives. C’est pour ça qu’il ne s’affiche pas. Une seconde plus tard la seconde animation concernant <em>le même attribut</em> commence, annulant ainsi la première.</p>

<p>Pour le rectangle du bas, les animations sont additives. Du coup, lorsque commence la première animation, la valeur original de l’attribut <span class="attribute">width</span> est additionnée à la valeur prise par l’animation. La taille diminue jusqu’à ce que la seconde animation débute. Les deux animations s’additionnent (en plus de la valeur de départ de l’attribut <span class="attribute">width</span>) et donc la taille diminue et croît en même temps (mais elle croît plus vite qu’elle ne se réduit, donc ce qu’on voit, nous, c’est la taille qui grandit). À la fin, la première animation s’arrête et laisse pendant une seconde la seconde animation agir toute seule, sans lui mettre de bâtons dans les roues en faisait décroitre la taille ! C’est pour cela qu’elle va plus vite la dernière seconde.</p>

<h4>L’attribut <span class="attribute">accumulate</span></h4>

<p>L’attribut <span class="attribute">accumulate</span> a un usage très restreint. Il ne sert que dans le cas d’une animation qui se répète (via les attributs <span class="attribute">repeatCount</span> et <span class="attribute">repeatDur</span>). S’il est fixé à la valeur <span class="attribute">sum</span>, la valeur de départ de l’attribut lors de la répétition sera la valeur finale atteinte lors de la répétition précédente.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="additive.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’attribut d’animation accumulate</title>

<!-- pas d’accumulation -->
<rect x="30" y="100" width="40" height="40">
	<animate attributeName="x" attributeType="XML"
	calcMode="spline" repeatCount="4"
	keyTimes="0; 1"
	keySplines="0.68 0.235 0.325 0.765"
	values="0; 50"
	additive="sum"
	begin="1s" dur="4s" fill="freeze"/>
</rect>

<!-- avec accumulation -->
<rect x="30" y="170" width="40" height="40">
	<animate attributeName="x" attributeType="XML"
	calcMode="spline" repeatCount="4"
	keyTimes="0; 1"
	keySplines="0.68 0.235 0.325 0.765"
	values="0; 50"
	additive="sum" accumulate="sum"
	begin="1s" dur="4s" fill="freeze"/>
</rect>


</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:none;
	stroke:orchid ;
	stroke-width:10;
	stroke-linejoin:round;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/accumulate.svg">L’attribut d’animation accumulate</object>
</div>

<p>Bien sûr si votre animation est linéaire, la répétition ne sera pas vraiment visible !</p>

<h3 id="sync">Synchronisation en pagaille</h3>

<p>Dans le premier chapitre sur les animations, je vous avait montré comment synchroniser le départ d’une animation avec le départ ou la fin d’une autre animation. Seulement, il y a d’autre moyens de synchronisation.</p>

<h4>Synchronisation sur répétition</h4>

<p>Il est possible de synchroniser une animation sur la répétition d’une autre animation, à condition bien sûr qu’elle se répète (ok vous vous en doutiez <object type="image/gif" data="images/smileys/whistling.gif">:-°</object>). Et ce sur la première, la seconde ou la nième répétition. Ça fonctionne comme avec les mots-clefs <span class="attribute">begin</span> et <span class="attribute">end</span> mais cette fois-ci le mot-clé est <span class="attribute">repeat</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="repeat.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Répétition d’animation</title>

<g>
<!-- boulet -->
<line x1="50" x2="50" y1="200" y2="240"/>
<circle cx="50" cy="240" r="10"/>

	<animateTransform id="rotation" attributeName="transform" attributeType="XML"
	type="rotate" from="0, 50, 200" to="-360, 50, 200"
	begin="2s" dur="2s" repeatCount="4"/>
</g>

<!-- pavé qui part -->
<rect x="60" y="230" width="30" height="18">
	<animate attributeName="x" attributeType="XML"
	begin="rotation.end" dur="5s" fill="freeze"
	from="60" to="600"/>
</rect>

<!-- affichage du décompte avec le mot-clé repeat -->

<g transform="translate(100, 120)">
<text>3
	<set attributeName="visibility" attributeType="CSS"
	begin="rotation.repeat(1)" end="rotation.repeat(2)"
	to="visible"/>
</text>
<text>2
	<set attributeName="visibility" attributeType="CSS"
	begin="rotation.repeat(2)" end="rotation.repeat(3)"
	to="visible"/>
</text>
<text>1
	<set attributeName="visibility" attributeType="CSS"
	begin="rotation.repeat(3)" end="rotation.end"
	to="visible"/>
</text>
<text>Pan
	<set attributeName="visibility" attributeType="CSS"
	to="visible"/>
</text>
</g>


</svg>]]></div>

<div class="csscode"><![CDATA[line{
	fill:none;
	stroke:black;
	stroke-width:3;
	}

text{
	font-size:100px;
	visibility:hidden;
	}

rect{
	fill:firebrick;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/repeat.svg">Répétition d’animation</object>
</div>

<p>Notez qu’on peut faire <span class="attribute">truc.repeat(7) + 10s</span> comme on peut faire <span class="attribute">machin.begin + 3s</span>.</p>

<h4>Synchronisation sur évènement</h4>

<p>La seconde manière de synchroniser le départ ou la fin d’une animation est d’utiliser des évènements fournis par l’interface utilisateur comme le clic, le survol de la souris, etc. Il en existe plusieurs dont :</p>

<ul class="list-attributes">
<li><span class="attribute">click</span> : se déclenche lors du clic sur un élément ;</li>
<li><span class="attribute">mousedown</span> : on appuie, sans relâcher, sur le curseur de la souris ;</li>
<li><span class="attribute">mouseup</span> : on relâche le curseur de la souris ;</li>
<li><span class="attribute">mousemove</span> : le curseur bouge au dessus d’un élément ;</li>
<li><span class="attribute">mouseover</span> : le curseur vient d’arriver sur l’élément ;</li>
<li><span class="attribute">mouseout</span> : le curseur vient juste de sortir de l’élément.</li>
</ul>

<p>La différence entre un <span class="attribute">click</span>, un <span class="attribute">mousedown</span> et un <span class="attribute">mouseup</span>, c’est que le <span class="attribute">click</span> est constitué des deux évènements <span class="attribute">mousedown</span> et  <span class="attribute">mouseup</span>. D’ailleurs ils se déclenchent dans cet ordre : <span class="attribute">mousedown</span>, <span class="attribute">mouseup</span> puis enfin <span class="attribute">click</span> !</p>

<p>Testons toutes ces propriétés en même temps (cliquez sur le dessin) :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="events.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les différents évènements</title>

<!-- à gauche : les clics -->

<g id="bouton1">
	<rect x="60" y="30" width="80" height="30" rx="4" ry="4"/>
	<text class="button" x="100" y="45"><tspan>Cliquez</tspan></text>
</g>


<text class="anim" x="100" y="100">Clic
	<set attributeName="visibility" attributeType="CSS"
	to="visible" begin="bouton1.click"/>
</text>

<text class="anim" x="100" y="160">Restez appuyé !
	<set attributeName="visibility" attributeType="CSS"
	to="visible" begin="bouton1.mousedown" end="bouton1.mouseup"/>
</text>


<!-- ligne séparatrice -->

<line x1="200" x2="200" y1="10" y2="290"/>

<!-- à droite : survol de la souris -->

<g id="bouton2">
	<rect x="260" y="30" width="80" height="30" rx="4" ry="4"/>
	<text class="button" x="300" y="45"><tspan>Survolez</tspan></text>
</g>


<text class="anim" x="300" y="100">Souris dessus
	<set attributeName="visibility" attributeType="CSS"
	to="visible" begin="bouton2.mouseover" end="bouton2.mouseout"/>
</text>

<text class="anim" x="300" y="160">Souris bouge
	<set attributeName="visibility" attributeType="CSS"
	to="visible" begin="bouton2.mousemove" dur="0.08s"/>
</text>

</svg>]]></div>

<div class="csscode"><![CDATA[line{
	fill:none;
	stroke:black;
	stroke-width:2;
	}

rect{
	fill:lightcyan;
	stroke:lightblue;
	stroke-width:3;
	}

text.button{
	text-anchor:middle;
	}

text.button > tspan{
	baseline-shift:-0.5ex;
	}

text.anim{
	text-anchor:middle;
	visibility:hidden;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/events.svg">Les différents évènements</object>
</div>

<p>Bien sûr on peut réaliser ces animations avec les autres balises d’animation, mais <span class="balise">set</span> est intéressant. Par exemple, pour le premier d’entre eux, il n’y a ni valeur de durée ni fin précisé. Le changement est donc définitif.</p>

<p>Pour les deux du milieu, on utilise les évènements antagonistes.</p>

<p>Enfin dans le dernier cas, c’est un peu un hack. En effet il n’existe pas d’évènement <span class="attribute">mousedontmoveanymorestopmayhavepassedawaystop</span> (traduction : le curseur s’est arrêté après avoir bougé). Il faut donc ruser en recommençant l’animation à chaque fois que la souris bouge. La durée est nécessaire. Essayez sans, le texte scintillera puisqu’à certains moments, le lecteur SVG considerera que la souris ne bouge pas, même si elle bouge. Le tout est de mettre une durée assez courte pour qu’elle est l’air de disparaître lorsqu’on arrête de bouger la souris, mais pas trop pour ne pas faire scintiller le texte. À vrai dire, cela dépend de beaucoup de choses, et notamment du matériel qui peut être différent lors de la diffusion d’un document.</p>

<h4>Synchronisation par <span class="attribute">accessKey</span></h4>

<p>La dernière manière de synchroniser les animations est l’appuie d’une touche. Mais attention, n’allez pas croire que c’est simple ! En fait, il s’agit du système d’<span class="attribute">accesskey</span> qui était à l’origine un moyen d’améliorer l’accessibilité. Malheureusement, <a href="http://openweb.eu.org/articles/accesskey_essai_non_transforme">ça n’a pas fonctionné</a>. Mais nous pouvons tout de même nous en servir : il suffit d’utiliser le mot-clé <span class="attribute">accessKey(caractère)</span>.</p>

<p>Mais comment activer une telle <span class="attribute">accesskey</span>, pensez-vous aussitôt ? En fait tout dépend du navigateur. Vous avez la liste des raccourcis clavier dans <a href="http://openweb.eu.org/articles/accesskey_essai_non_transforme#xpointer(//ul[0])">l’article précédent</a>.</p>

<h3 id="vrac">En vrac</h3>

<h4>Des liens dans tous les sens</h4>

<p>Jusqu’à maintenant, les éléments d’animation étaient inclus dans l’élément que nous voulions animer. Sachez qu’on peut aussi écrire les éléments d’animation à part (c’est à dire plus loin dans le document) et donner l’élément à animer grâce à l’attribut XLink <span class="attribute">href</span>. L’élément à animer aura comme valeur de l’attribut <span class="attribute">dur</span> <span class="attribute">indefinite</span>. De même, un lien classique peut de la même manière pointer vers une animation. Dans les deux cas, on indique l’identifiant de l’élément à activer (sans oublier le #).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="link.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les liens pour l’animation</title>


<a xlink:href="#animerCercle">
<rect x="100" y="30" rx="5" ry="5" width="200" height="70"/>
<text x="200" y="80">Animer</text>
</a>


<animate id="animerCercle" xlink:href="#cercle"
	attributeName="r" attributeType="XML"
	begin="indefinite" dur="4s"
	by="-50"/>


<circle id="cercle" cx="200" cy="200" r="80"/>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:none;
	stroke:thistle;
	stroke-width:4;
	}

text{
	text-anchor:middle;
	font-size:50px;
	}

circle{
	fill:none;
	stroke:springgreen;
	stroke-width:7;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/link.svg">Les liens pour l’animation</object>
</div>

<h4>Redémarrage d’animation</h4>

<p>Si vous cliquez sur le bouton alors que l’animation n’est pas terminée, elle reprend à zéro. Vous pourriez vouloir que l’animation ne recommence que si elle est finie, ou quelle ne recommence jamais. C’est possible grâce à l’attribut <span class="attribute">restart</span> qui peut prendre trois valeurs :</p>

<ul class="list-attribute">
<li><span class="attribute">always</span> : c’est le comportement par défaut. L’animation peut être redémarrée à volonté, même si elle n’est pas terminée ;</li>
<li><span class="attribute">whenNotActive</span> : l’animation ne peut être redémarrée qu’une fois celle-ci finie ;</li>
<li><span class="attribute">never</span> : l’animation n’a lieu qu’une seule fois.</li>
</ul>

<p>Reprenons l’exemple précédent avec le mot-clé <span class="attribute">whenNotActive</span>. Cliquez plusieurs fois de suite sur le bouton.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="link.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Attribut de redémarrage</title>


<g id="bouton">
<rect x="100" y="30" rx="5" ry="5" width="200" height="70"/>
<text x="200" y="80">Animer</text>
</g>


<animate id="animerCercle" xlink:href="#cercle"
	attributeName="r" attributeType="XML"
	begin="bouton.click" dur="4s"
	by="-50"
	restart="whenNotActive"/>


<circle id="cercle" cx="200" cy="200" r="80"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/restart.svg">Attribut de redémarrage</object>
</div>

<h4>Propriété d’interactivité</h4>

<p>Dernier détail en ce qui concerne les animations, avec une propriété CSS. Oui ! Elle a la doux petit nom de <span class="csspropertie">pointer-events</span> et sert à déterminer quelle partie d’une forme SVG sera sensible aux évènements de la souris. Les différentes valeurs que cette propriété peut prendre sont :</p>

<ul class="list-css-values">
<li><span class="csspropertie">visiblePainted</span> (valeur par défaut) : l’évènement est déclenché que le curseur soit sur la bordure ou sur le remplissage et <strong>à condition</strong> que l’élément soit visible et que <span class="attribute">fill</span> et <span class="attribute">stroke</span> ne soient pas à <span class="attribute">none</span> ;</li>
<li><span class="csspropertie">visibleFill</span> : lorsque le curseur est au dessus du remplissage, même si celui-ci à pour valeur <span class="csspropertie">none</span>. La bordure ne compte pas, ne déclenche pas d’évènement ;</li>
<li><span class="csspropertie">visibleStroke</span> : pareil mais que pour la bordure. Le remplissage ne déclenche pas d’évènement ;</li>
<li><span class="csspropertie">visible</span> : tout ce qui est visible (<span class="csspropertie">visibility:visible</span>). <span class="attribute">fill</span> et <span class="attribute">stroke</span> peuvent être à <span class="attribute">none</span>.</li>
</ul>

<p>Il en existe quatre autre pour lesquelles la valeur de la propriété CSS <span class="csspropertie">visibility:visible</span> n’a aucune influence. Un évènement peut se déclencher sur un élément invisible !</p>

<ul class="list-css-values">
<li><span class="csspropertie">painted</span> : remplissage et bordure non fixés à la valeur <span class="csspropertie">none</span> ;</li>
<li><span class="csspropertie">fill</span> : l’intérieur de la forme. La valeur de lapropriété <span class="csspropertie">fill</span> n’a aucune influence ;</li>
<li><span class="csspropertie">stroke</span> : la bordure de la forme. La valeur de la propriété <span class="csspropertie">stroke</span> n’a aucune influence ;</li>
<li><span class="csspropertie">all</span> : la forme en entier, quelles que soient les valeurs de <span class="csspropertie">fill</span>, <span class="csspropertie">stroke</span> et <span class="csspropertie">visibility</span> ;</li>
<li><span class="csspropertie">none</span> : pas d’évènement déclenché.</li>
</ul>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="pointer-events.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La propriété pointer-events</title>

<circle id="c1" cx="100" cy="60" r="40"/>
<circle id="c2" cx="200" cy="60" r="40"/>
<circle id="c3" cx="300" cy="60" r="40"/>

<text x="100" y="180">Survol
	<set attributeName="fill-opacity" attributeType="CSS"
	to="1"
	begin="c1.mouseover;c2.mouseover;c3.mouseover;c4.mouseover;c5.mouseover;c6.mouseover"
	end="c1.mouseout;c2.mouseout;c3.mouseout;c4.mouseout;c5.mouseout;c6.mouseout"/>
</text>
<text x="300" y="180">Rien
	<set attributeName="fill-opacity" attributeType="CSS"
	to="0.1"
	begin="c1.mouseover;c2.mouseover;c3.mouseover;c4.mouseover;c5.mouseover;c6.mouseover"
	end="c1.mouseout;c2.mouseout;c3.mouseout;c4.mouseout;c5.mouseout;c6.mouseout"/>
</text>

<circle id="c4" cx="100" cy="240" r="40"/>
<circle id="c5" cx="200" cy="240" r="40"/>
<circle id="c6" cx="300" cy="240" r="40"/>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:paleturquoise;
	stroke:palegreen;
	stroke-width:18;
	}

text{
	fill-opacity:0.1;
	text-anchor:middle;
	font-size:60px;
	}

text + text{
	fill-opacity:1;
	}

#c1{
	pointer-events:visiblePainted;
	}
#c2{
	pointer-events:visibleFill;
	}
#c3{
	pointer-events:visibleStroke;
	}
#c4{
	pointer-events:fill;
	fill:none;
	}
#c5{
	pointer-events:all;
	fill:none
	}
#c6{
	pointer-events:none;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-2/pointer-events.svg">La propriété pointer-events</object>
</div>

<p>Ce chapitre touche à sa fin et à vrai dire, je n’ai plus beaucoup de choses à vous apprendre. Retenez juste à propos de l’animation déclarative qu’elle permet de faire des choses compliquées à première vue très simplement. Il suffit d’un peu d’ingéniosité !</p>

<div class="previouspage"><a href="viewbox-et-ratio.php" title="cours précédent">Ratio, symboles</a></div>
<div class="nextpage"><a href="creer-sa-police.php" title="cours suivant">Créer sa police de caractère</a></div>

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
