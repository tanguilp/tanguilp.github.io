<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
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
<h2>Les animations (partie 1)</h2>

<p style="font-style:italic;font-size:104%"><img src="images/dialog-warning.png" alt="Attention" /> À l’heure actuelle, le seul navigateur qui vous permettra de visualiser au mieux les exemples de ce site est <a href="http://www.opera.com/download/">Opera</a>. Par exemple, les animations ne fonctionnent correctement <strong>que</strong> sous Opera. Sous Firefox 3.5 et inférieur, un script (FakeSmile) simule les fonctions d’animations mais beaucoup d’exemples sont buggés.</p>

<p>SVG permet un contrôle très fin sur les animations. En gros, on va pouvoir tout faire bouger, clignoter, changer de couleur, etc.
sans avoir à écrire une seule ligne de JavaScript ! Et c’est super simple !</p>

<ul class="sommaire">
<li><a href="#animate">L’élément <span class="balise">animate</span></a></li>
<li><a href="#acolor">L’animation de couleur : <span class="balise">animateColor</span></a></li>
<li><a href="#répét">Répétition d’animation</a></li>
<li><a href="#set">L’élément <span class="balise">set</span></a></li>
<li><a href="#atransform">L’animation avec les transformation</a></li>
<li><a href="#amotion">L’animation sur un <span class="balise">path</span></a></li>
</ul>

<h3 id="animate">L’élément <span class="balise">animate</span></h3>

<p>L’élément <span class="balise">animate</span> sert à faire varier la valeur d’un attribut ou d’une propriété CSS au cours
du temps. Concrètement, on doit placer la balise <span class="balise">animate</span> comme enfant immédiat de l’élément dont
on veut faire varier un attribut ou une propriété. Dans l’exemple suivant, on pourra faire varier, au choix, l’attribut
<span class="attribute">x</span>, <span class="attribute">y</span>, <span class="attribute">width</span> ou
<span class="attribute">height</span> ainsi que toutes les propriétés CSS qui peuvent être appliquées à un rectangle, <em>même si
elles ne sont pas déclarés !</em> On pourra donc faire varier l’épaisseur d’une bordure (stroke-width) même si rien n’est indiqué
à ce sujet dans la feuille de style (il peut même ne pas y avoir de feuille de style). Il en va de même pour les attributs qui ont
des valeurs par défaut. Par exemple, <span class="attribute">x</span> qui vaut 0 par défaut peut être manipulé par une animation
même s’il n’apparaît pas dans la balise parente (<span class="balise">rect</span> dans notre cas).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Comment placer les éléments d’animation</title>

<rect x="20" y="40" width="200" height="80">
	<animate …/>
</rect>

</svg>]]></div>

<p class="rappel">La balise <span class="balise">rect</span> devient une balise double. Ce n’est absolument pas un
problème puisque <span class="balise">rect</span> est la même chose que
<span class="balise sanslt"><![CDATA[<rect></rect>]]></span> !</p>

<h4>Les attributs de base</h4>

<p>Les deux premières informations dont à besoin SVG pour animer quelque chose, ce sont le type d’objet à traiter (attribut XML ou
propriété CSS) et le nom de cet objet. C’est là qu’entrent en jeu les attributs <span class="attribute">attributeType</span> et
<span class="attribute">attributeName</span>.</p>

<p><span class="attribute">attributeType</span> accepte deux valeurs : « CSS » ou « XML » selon ce qu’on veut traiter : un attribut de
l’élément parent ou un style CSS.</p>

<p><span class="attribute">attributeName</span> prend en paramètre le nom de l’attribut ou de la propriété CSS. Par exemple :<br/>
<span class="balise">animate attributeName="stroke-opacity" attributeType="CSS"</span>.</p>

<p>Puis, on doit déterminer la valeur de départ de l’attribut ou la propriété sélectionné et la valeur finale. On utilise les
attributs <span class="attribute">from</span> et <span class="attribute">to</span> pour déterminer ces deux valeurs.</p>

<p>Ensuite, il faut faire démarrer l’animation, grâce à <span class="attribute">begin</span> qui peut prendre une valeur de
durée.</p>

<p>Enfin, on indique la durée de l’animation avec l’attribut <span class="attribute">dur</span>, qui prend aussi une durée en
paramètre.</p>

<p>Pour notre première animation, on commence à 2 secondes pour finir à 5 secondes. On fait varier l’attribut
<span class="attribute">width</span> d’un rectangle de 100 à 300 pixels (n’hésitez pas à recharger la page si rien ne se passe,
puisque <span class="attribute">begin="2s"</span> signifie « à +2 secondes de l’affichage du dessin »).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="premiere-animation.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Une première animation avec SVG ! Yahou !</title>

<rect x="40" y="100" width="100" height="80">

	<animate attributeName="width" attributeType="XML"
	from="100" to="300"
	begin="2s" dur="3s"/>

</rect>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:none;
	stroke:cornflowerblue;
	stroke-width:5px;
	stroke-linejoin:bevel;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/premiere-animation.svg">Une première animation avec SVG !
Yahou !</object>
</div>

<p>Et voilà le travail <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object> ! Bien sur, le rectangle revient à sa
position initiale mais c’est un détail que nous règlerons plus tard.</p>

<h4>Les attributs <span class="attribute">begin</span> et <span class="attribute">end</span> : précisions</h4>

<p>En plus de <span class="attribute">begin</span>, il existe une balise, <span class="attribute">end</span>, qui
permet de contraindre une animation à s’arrêter. Dans l’exemple suivant, l’animation ne dure pas 6 secondes mais s’arrête à 4
secondes comme indiqué dans l’attribut <span class="attribute">end</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="attribut-end.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de l’attribut end pour l’animation</title>

<line x1="20" y1="248" x2="240" y2="30">
	<animate attributeName="x2" attributeType="XML"
	from="240" to="380"
	begin="2s" dur="6s" end="4s"/>
</line>

</svg>]]></div>

<div class="csscode"><![CDATA[line{
	fill:none;
	stroke:coral;
	stroke-width:7px;
	stroke-linecap:round;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/attribut-end.svg">Utilisation de l’attribut end pour
l’animation</object>
</div>

<p>Attention toutefois : il faut obligatoirement un attribut <span class="attribute">dur</span>. Le viewer SVG ne calculera pas la
différence <span class="attribute">end</span>-<span class="attribute">begin</span> si vous omettez cet attribut !</p>

<p>À propos des valeurs de durée, il faut savoir que, en plus de la seconde (notée s), on peut utiliser les heures (h), les
minutes (min) et les millisecondes (ms).</p>

<p>Plus intéressant, on peut demander à SVG de commencer une animation (et de la finir) en fonction du début ou de la fin d’une
autre animation ! Si si, c’est vrai <object type="image/gif" data="images/smileys/biggrin.gif">:D</object> !<br/>
Il faut pour cela localiser l’animation avec laquelle on veut interagir avec un <span class="attribute">id</span>. Ensuite,
on écrit <span class="attribute">begin="id.begin"</span> pour faire commencer l’animation en même temps que l’animation
<span class="attribute">id</span> et <span class="attribute">begin="id.end"</span> pour faire commencer notre animation à la fin de
l’autre. Remarquez dans l’exemple suivant qu’il peut y avoir plusieurs animations sur le même objet en même temps :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="attribut-begin.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Synchronisation d’animations</title>

<circle cx="200" cy="150" r="10">
	<animate attributeName="r" attributeType="XML" id="grossissement"
	from="10" to="100"
	begin="5s" dur="7s"/>

	<animate attributeName="stroke-width" attributeType="CSS"
	from="1" to="20"
	begin="grossissement.begin" dur="7s"/>

	<animate attributeName="stroke-opacity" attributeType="CSS"
	from="1" to="0"
	begin="grossissement.end" dur="3s"/>
</circle>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:none;
	stroke:deeppink;
	stroke-width:1px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/attribut-begin.svg">Synchronisation d’animations</object>
</div>

<p>Et voilà : une synchronisation parfaite ! En fait, la seule chose gênante, c’est le retour à la valeur de départ à la fin de
l’animation. Si vous devez apprendre quelque chose ici, c’est que les concepteurs de SVG ont pensé à tout. Et c’est donc vrai dans
notre cas.</p>

<h4>Le gel d’animation avec l’attribut <span class="attribute">fill</span></h4>

<p>L’attribut <span class="attribute">fill</span>, dont la valeur par défaut est <span class="attribute">remove</span>, permet de
geler une animation à sa fin, grâce à la valeur <span class="attribute">freeze</span>. En reprenant notre exemple du dessus, ça
donne :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="attribut-begin.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Gel d’animation avec l’attribut fill</title>

<circle cx="200" cy="150" r="10">
	<animate attributeName="r" attributeType="XML" id="grossissement"
	from="10" to="100"
	begin="5s" dur="7s" fill="freeze"/>

	<animate attributeName="stroke-width" attributeType="CSS"
	from="1" to="20"
	begin="grossissement.begin" dur="7s" fill="freeze"/>

	<animate attributeName="stroke-opacity" attributeType="CSS"
	from="1" to="0"
	begin="grossissement.end" dur="3s" fill="freeze"/>
</circle>

</svg>]]></div>

<div class="csscode"><![CDATA[circle{
	fill:none;
	stroke:deeppink;
	stroke-width:1px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/attribut-fill.svg">Gel d’animation avec l’attribut
fill</object>
</div>

<p>Muhahaha <object type="image/gif" data="images/smileys/devil.gif">&gt;:)</object> !</p>

<p>Notez bien (surtout ceux qui vont programmer avec DOM après) que le gel d’animation ne revient pas à geler la valeur de l’attribut.
Donc, la valeur de <span class="csspropertie">stroke-opacity</span> est, à la fin, de 1 (et non pas de 0) !</p>

<h3 id="acolor">L’animation de couleur : <span class="balise">animateColor</span></h3>

<p>Il existe un élément dédié à l’animation de couleur : il s’agit de <span class="balise">animateColor</span>.</p>

<p><span class="balise">animateColor</span> fonctionne exactement de la même façon que
<span class="balise">animate</span>, à cela près que les valeurs de <span class="attribute">from</span> et de
<span class="attribute">to</span> doivent être des couleurs !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="animateColor.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Animation de couleur</title>

<ellipse cx="200" cy="150" rx="190" ry="100">
	<animateColor attributeName="fill" attributeType="CSS" id="engris"
	from="lightblue" to="#ffd700"
	begin="3s" dur="5s"/>

	<animateColor attributeName="fill" attributeType="CSS"
	from="#ffd700" to="lightblue"
	begin="engris.end" dur="5s"/>
</ellipse>

</svg>]]></div>

<div class="csscode"><![CDATA[ellipse{
	fill:lightblue;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/animateColor.svg">Animation de couleur</object>
</div>

<h3 id="répét">Répétition d’animation</h3>

<p>Jusqu’ici, nos animations ne se sont répétées qu’une fois. En réalité, il est possible de les faire se répéter
autant de fois ou de temps que l’on veut, et même indéfiniment !</p>

<p>L’attribut <span class="attribute">repeatCount</span> prend en paramètre soit un entier supérieur à 0, soit le mot-clé
<span class="attribute">indefinite</span>. Dans le premier cas, l’animation se répète le nombre de fois indiqué. Dans le second,
elle se répète indéfiniment.</p>

<p>L’attribut <span class="attribute">repeatDur</span> prend en paramètre soit une durée, soit le mot-clé
<span class="attribute">indefinite</span>. Dans le premier cas, l’animation se répète pendant la durée indiquée. Dans le second,
à vous de deviner <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object>.</p>

<p>La présence des deux attributs en même temps n’est absolument pas gênante.</p>

<p>Exemple avec un <span class="balise">path</span> (et oui, ça fonctionne même avec un chemin, à condition que seuls les
nombres varient (pas les lettres)).</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="repetition.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Répétition d’animation</title>

<path d="M 10,150 L 10,150 q 30,-40 60,0 L 390,150">

	<animate attributeName="d" attributeType="XML"
	from="M 10,150 L 10,150 q 30,-40 60,0 L 390,150"
	to="M 10,150 L 330,150 q 30,0 60,0 L 390,150"
	begin="1.3s" dur="2s"
	repeatCount="indefinite"/>

</path>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	fill:none;
	stroke:navajowhite;
	stroke-width:4px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/repetition.svg">Répétition d’animation</object>
</div>

<p>Remarquez l’utilisation judicieuse de coordonnées relatives.</p>

<p>Voici une dernière animation, pour le fun :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="SVGround-kewl.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Le SVG, c’est trop fun !</title>

<path id="chemin" d="M 10,180 C 100,0 200,300 300,150 Q 340,100 385,120"/>

<text>
	<textPath xlink:href="#chemin" start-offset="100%">Le SVG, c’est trop fun !
		<animate attributeName="startOffset" attributeType="XML"
		from="100%" to="-70%"
		begin="0s" dur="7s" repeatCount="indefinite"/>
	</textPath>
</text>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	fill:none;
	stroke:yellowgreen;
	stroke-linecap:round;
	stroke-width:1.1em; /* pour qu’il puisse contenir tout le texte */
}

text{
	letter-spacing:2px;
}
text > textPath{
	baseline-shift:-0.7ex;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/SVGround-kewl.svg">Le SVG, c’est trop fun !</object>
</div>

<h3 id="set">L’élément <span class="balise">set</span></h3>

<p>Lorsqu’on souhaite fixer un attribut à une valeur, sans transition, l’utilisation de <span class="balise">animate</span>
n’est pas cohérente. Dans ce cas, on utilise <span class="balise">set</span> qui permet, grâce à son attribut
<span class="attribute">to</span> de fixer cette valeur pendant la durée <span class="attribute">dur</span>. Par exemple,
si on veut rendre visible un triangle pendant quelques secondes seulement, on fait :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="set.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’élément set</title>

<g>
<path d="M 200,50 L 325,250 L 75,250 Z"/>
<text x="200" y="205">!</text>

<set attributeName="visibility" attributeType="CSS"
to="visible"
begin="2.5s" dur="3s"/>

</g>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	fill:none;
	stroke:black;
	stroke-width:10px;
	stroke-linejoin:round;
}

text{
	font-size:100px;
	fill:red;
	/* centrage */
	text-anchor:middle;
}

g{
	visibility:hidden;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/set.svg">L’élément set</object>
</div>

<p>Bien sur, si j’avais voulu que le panneau ne disparaisse pas, j’aurais écrit <span class="attribute">fill="freeze"</span> et
j’aurais enlevé le <span class="attribute">dur</span>.</p>

<h3 id="atransform">L’animation avec les transformation</h3>

<p>Vous vous souvenez des transformations ? Ces trucs un peu bizarre qui ne servait <span lang="lat">a priori</span> à rien ! Et bien il existe une balise
(<span class="balise">animateTransform</span> pour ne pas la citer) qui permet de faire des animations à partir des
transformations <object type="image/gif" data="images/smileys/huh.gif">:S</object> (quoi, personne ne vous avait prévenu que SVG,
c’était génial ?) !</p>

<p>En plus des attributs habituels, on doit spécifier dans <span class="attribute">type</span> le type de transformation qu’on
souhaite réaliser : <span class="attribute">translate</span>, <span class="attribute">rotate</span>,
<span class="attribute">scale</span>, <span class="attribute">skewX</span> ou <span class="attribute">skewY</span>. Après, il ne
reste plus qu’à remplir les attributs <span class="attribute">from</span> et <span class="attribute">to</span> avec les valeurs
voulues.</p>

<p>Maintenant, à vous de coder. Vous avez le niveau suffisant pour programmer une horloge !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="animateTransform.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’animation à base de transformation</title>

<line id="aiguille-heures" x1="200" y1="150" x2="200" y2="100">
	<animateTransform attributeName="transform" attributeType="XML" type="rotate"
	from="0, 200, 150" to="360, 200, 150"
	begin="0s" dur="24s"
	repeatCount="indefinite"/>
</line>

<line id="aiguilles-secondes" x1="200" y1="150" x2="200" y2="70">
	<animateTransform attributeName="transform" attributeType="XML" type="rotate"
	from="0, 200, 150" to="360, 200, 150"
	begin="0s" dur="2s"
	repeatCount="indefinite"/>
</line>

</svg>]]></div>

<div class="csscode"><![CDATA[#aiguille-heures{
	stroke:black;
	stroke-width:6px;
	stroke-linecap:round;
}

#aiguilles-secondes{
	stroke:black;
	stroke-width:2px;
	stroke-linecap:round;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/animateTransform.svg">L’animation à base de
transformation</object>
</div>

<h3 id="amotion">L’animation sur un <span class="balise">path</span></h3>

<p><span class="balise">animateMotion</span> est la dernière balise d’animation de SVG. Elle permet de faire défiler un
object le long d’un chemin.</p>

<p>Comme d’habitude, on la place comme enfant direct de l’objet qu’on veut déplacer. Ensuite, on utilise, en plus des attributs
habituels, soit l’attribut <span class="attribute">path</span> qui contient les coordonnées du chemin, soit la balise
<span class="balise">mpath</span>, enfant direct de <span class="balise">animateMotion</span>, dont l’attribut
<span class="attribute">xlink:href</span> appelle un <span class="balise">path</span> par son
<span class="attribute">id</span> (ouf <object type="image/gif" data="images/smileys/sweatdrop.gif">^^'</object>).</p>

<p>En gros, ça donne ça :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="animateMotion.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’animation le long d’un chemin</title>

<path id="chemin" d="M 10,150 q 50,-60 90,0 t 90,0 t 90,0 t 90,0"/>

<g>
<line x1="0" y1="0" x2="0" y2="12"/>
<circle cx="0" cy="18" r="6"/>

<animateMotion begin="10s" dur="10s" repeatDur="indefinite">
	<mpath xlink:href="#chemin"/>
</animateMotion>

</g>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	fill:none;
	stroke:black;
	stroke-width:1px;
	stroke-opacity:0.4;
}

line{
	stroke:gold;
	stroke-width:2px;
}

circle{
	fill:red;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/animateMotion.svg">L’animation le long d’un chemin</object>
</div>

<p>C’est parfait ! Mais imaginez que j’ai dessiné, au lieu de ma boule de sapin de noël (vous n’aviez pas deviné
<object type="image/gif" data="images/smileys/huh.gif">:/</object> ?) une voiture : elle n’aura pas vraiment suivi le chemin et serait
restée horizontale dans les descentes et les montées. On peut demander à SVG de calculer la valeur de rotation de l’objet qu’on
anime par rapport à la pente du chemin. Il s’agit de l’attribut <span class="attribute">rotate</span> qui a pour valeur par défaut
0, mais qui peut prendre une autre valeur d’angle, la valeur <span class="attribute">auto</span> et
<span class="attribute">auto-reverse</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="rotate.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>animateMotion et attribut rotate</title>

<path id="chemin" d="M 10,150 q 50,-60 90,0 t 90,0 t 90,0 t 90,0"/>

<g>
<!-- camion -->
<rect x="-10" y="-13" width="20" height="10"/>
<!-- fenêtre -->
<rect x="5" y="-11" width="3" height="2"/>

<!-- roues -->
<circle cx="-4" cy="-3" r="3"/>
<circle cx="6" cy="-3" r="3"/>

<!-- trainées -->
<line x1="-12" y1="-12" x2="-14" y2="-12">
	<!-- x2 -->
	<animate attributeName="x2" attributeType="XML"
	from="-14" to="-20"
	begin="0s" dur="0.5s" repeatDur="indefinite"/>

	<!-- opacité -->
	<animate attributeName="stroke-opacity" attributeType="CSS"
	from="0.5" to="0"
	begin="0s" dur="0.5s" repeatDur="indefinite"/>
</line>

<line x1="-12" y1="-8" x2="-14" y2="-8">
	<!-- x2 -->
	<animate attributeName="x2" attributeType="XML"
	from="-14" to="-18"
	begin="0.3s" dur="0.33s" repeatDur="indefinite"/>

	<!-- opacité -->
	<animate attributeName="stroke-opacity" attributeType="CSS"
	from="0.5" to="0"
	begin="0.6s" dur="0.33s" repeatDur="indefinite"/>
</line>

<line x1="-12" y1="-4" x2="-14" y2="-4">
	<!-- x2 -->
	<animate attributeName="x2" attributeType="XML"
	from="-14" to="-20"
	begin="0.3s" dur="0.5s" repeatDur="indefinite"/>

	<!-- opacité -->
	<animate attributeName="stroke-opacity" attributeType="CSS"
	from="0.5" to="0"
	begin="0.3s" dur="0.5s" repeatDur="indefinite"/>
</line>



<animateMotion rotate="auto" begin="0s" dur="10s" repeatDur="indefinite">
	<mpath xlink:href="#chemin"/>
</animateMotion>

</g>

</svg>]]></div>

<div class="csscode"><![CDATA[rect, path, circle, line{
	fill:none;
	stroke:black;
	stroke-width:1px;
}

circle{
	fill:white;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/animations-chapitre-1/rotate.svg">animateMotion et attribut rotate</object>
</div>

<p>C’est un peu long (au niveau du XML, par contre au niveau CSS c’est vraiment court) mais en fait, c’est beaucoup de
copier-coller, accompagné de modification d’un ou deux attributs à chaque fois… Voilà ce que vous pourrez faire en dix minutes
avec un peu d’entrainement !</p>

<p>Ce merveilleux chapitre touche à sa fin, mais nous reviendrons aux animations plus tard. Vous verrez qu’on peut contrôler
très finement la vitesse des animations et qu’il en existe (des animations) plein d’autres sortes avec les mêmes balises !</p>

<div class="previouspage"><a href="le-texte-en-svg.php" title="cours précédent">Le texte</a></div>
<div class="nextpage"><a href="motifs.php" title="cours suivant">Les motifs de remplissage</a></div>


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
