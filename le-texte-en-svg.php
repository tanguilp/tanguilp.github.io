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
<h2>Le texte</h2>

<ul class="sommaire">
<li><a href="#gen">Généralités</a></li>
<li><a href="#centrer">Centrer du texte</a></li>
<li><a href="#tspan">L’élément <span class="balise">tspan</span></a></li>
<li><a href="#déplacement">Glissement et rotation des glyphes</a></li>
<li><a href="#longueur">Longueur du texte</a></li>
<li><a href="#tref">L’élément <span class="balise">tref</span></a></li>
<li><a href="#surpath">Du texte sur un <span class="balise">path</span></a></li>
<li><a href="#xmlspace"><span class="attribute">xml:space</span>, traitement conditionnel</a></li>
</ul>

<h3 id="gen">Généralités</h3>

<p>Rassurez-vous tout de suite, la gestion du texte en SVG est ultra-simple. Pour la bonne raison qu’un glyphe (ou une lettre, mais
dans notre cas on ne parlera que de glyphe) est un objet graphique… comme un autre ! Concrètement, ça veut dire que vous pouvez
styler du texte comme vous l’avez déjà fait avec les rectangle, cercle, polygone et autres formes SVG. Voilà, ceci étant dit, le
chapitre est presque terminé !</p>

<p><object type="image/gif" data="images/smileys/blink.gif">Quoi ?</object></p>

<p>En fait, il y a encore quelques notions à voir. Par exemple, les propriétés CSS. De celles que l’on a déjà parlé, on peut appliquer
les suivantes :</p>

<ul class="list-css-values">
<li><span class="csspropertie">fill</span> ;</li>
<li><span class="csspropertie">fill-opacity</span> ;</li>
<li><span class="csspropertie">stroke</span> ;</li>
<li><span class="csspropertie">stroke-width</span> ;</li>
<li><span class="csspropertie">stroke-opacity</span> ;</li>
<li><span class="csspropertie">stroke-dasharray</span> ;</li>
<li><span class="csspropertie">stroke-dashoffset</span>.</li>
</ul>

<p>Sympa, non ? Et pour ceux qui connaissent déjà les propriétés de police CSS2.1, la suite va être encore plus facile. Pour les
autres, voici la liste des propriétés CSS qu’on peut appliquer au texte, avec leur description :</p>

<ul class="list-css-values">
<li><span class="csspropertie">font-size</span> : la taille du texte, avec les unités que vous voulez ;</li>
<li><span class="csspropertie">font-style</span> : peut prendre les valeurs <span class="csspropertie">normal</span>,
<span class="csspropertie">italic</span> pour que le texte soit en italique, et <span class="csspropertie">oblique</span>
pour que le texte soit oblique (plus penché qu’en italique) ;</li>
<li><span class="csspropertie">font-weight</span> qui peut la valeur <span class="csspropertie">bold</span> pour que le texte
voulu apparaîsse en gras ;</li>
<li><span class="csspropertie">font-variant</span> qui, lorsque qu’elle prend la valeur
<span class="csspropertie">small-caps</span>, transforme le texte en petite majuscule ;</li>
<li><span class="csspropertie">font-family</span> : la nom de la police (par exemple : Times New Roman, Bodoni, Garamond, Minion Web,
ITC Stone Serif, MS Georgia, Bitstream Cyberbit). On peut spécifier plusieurs polices : le programme va lire la lsite des polices
jusqu’à ce qu’il trouve une police qu’il peut afficher. Il faut par contre respecter une syntaxe stricte : les noms des familles
doivent être séparés par des virgules et elles doivent être entourées de guillemets si elles comportent des espaces blancs. Par
exemple :<br/>
<span class="csspropertie">font-family:"Times New Roman", Monospace, Verdana, Sans-Serif;</span> ;</li>
<li><span class="csspropertie">text-decoration</span> <span class="csspropertie">underline</span>,
<span class="csspropertie">overline</span>, <span class="csspropertie">line-through</span> et
<span class="csspropertie">blink</span> qui permettent respectivement de souligner, de surligner (une ligne au-dessus), de barrer et
de faire clignoter (mieux vaut ne plus utiliser cette valeur). Plusieurs valeurs peuvent être combinées, par exemple :<br/>
<span class="csspropertie">text-decoration:underline overline;</span><br/>
qui produira du texte encadré par deux lignes, une au-dessus et l’autre en bas ;</li>
<li><span class="csspropertie">letter-spacing</span> : c’est une propriété qui indique l’espacement entre deux lettres. Vous pouvez
mettre l’unité que vous voulez ;</li>
<li><span class="csspropertie">word-spacing</span> : c’est la même chose que précédemment, sauf qu’il s’agit de l’espace entre les
mots et non plus entre les lettres. Le principal problème de cette propriété est que les parseurs n’ont pas tous la même notion de ce
qu’est un mot. En effet, combien l’expresionn « l’oiseau » a-t-elle de mots ?</li>
</ul>

<p>Les connaisseurs me diront qu’il y en a surement d’autres, et ils auront raison. Nous les verrons en temps voulu.</p>

<p>Vous l’aviez sans doute deviné, la balise qui permet d’inclure du texte s’appelle <span class="balise">text</span>. Elle
accepte entre autres les attributs <span class="attribute">x</span> et <span class="attribute">y</span> qui définissent le point de
départ du texte.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="premier-exemple.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Styler du texte simplement</title>

<!-- cadre -->
<rect x="0" y="0" width="400" height="300"/>

<text id="ligne1" x="20" y="20">Première ligne de texte en SVG</text>

<text id="ligne2" x="2" y="100">Seconde ligne</text>

<text id="ligne3" x="150" y="280">3</text>

</svg>]]></div>

<div class="csscode"><![CDATA[rect{
	fill:none;
	stroke:black;
}

#ligne1{
	font-size:18px;
	text-decoration:underline;
}

#ligne2{
	font-size:70px;
	letter-spacing:-4px;
	fill:linen;
	fill-opacity:0.5;
	stroke:lightsteelblue;
	stroke-width:3px;
}

#ligne3{
	font-size:200px;
	font-weight:bold;
	fill:none;
	stroke:gold;
	stroke-opacity:0.5;
	stroke-width:6px;
	stroke-dasharray:10,5;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/premier-exemple.svg">Styler du texte simplement</object>
</div>

<p>Rien de bien compliqué, sauf lorsqu’il s’agit de centrer du texte ! Comme vous l’avez vu, les coordonnées de la ligne trois (le
grand 3) n’indique pas qu’il y a centrage. J’ai donc du tatonner avant de trouver les bonnes coordonnées. Heureusement, CSS permet
de centrer tout ça très facilement.</p>

<h3 id="centrer">Centrer du texte</h3>

<p>Pour centrer du texte, nous allons utiliser deux propriétés CSS : <span class="csspropertie">text-anchor</span> et
<span class="csspropertie">baseline-shift</span>.</p>

<p>La première permet de spécifier l’alignement (début, milieu ou fin) par rapport au coordonnées de la balise
<span class="balise">text</span>. Elle peut prendre trois valeur : <span class="csspropertie">start</span> (valeur par
défaut) qui permet d’aligner les coordonnées avec le début du texte, <span class="csspropertie">middle</span> qui permet
l’alignement avec le milieu du texte (le processeur SVG s’occupe des calculs) et la valeur <span class="csspropertie">end</span>
grâce à laquelle on pourra spécifier que c’est la fin du texte qui doit être aligné avec les coordonées anoncées.</p>

<p>Un exemple classique :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="text-anchor.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Centrage de texte avec la propriété text-anchor</title>

<!-- ligne verticale -->
<line x1="200" y1="20" x2="200" y2="280"/>

<!-- text-anchor:start -->
<text x="200" y="100">Aligné avec le début</text>
<circle cx="200" cy="100" r="2"/>

<!-- text-anchor:middle -->
<text id="middle" x="200" y="175">Aligné avec le milieu</text>
<circle cx="200" cy="175" r="2"/>

<!-- text-anchor:end -->
<text id="end" x="200" y="250">Aligné avec la fin</text>
<circle cx="200" cy="250" r="2"/>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:20px;
}

/* on ne met rien pour le premier car la valeur par défaut est start */

#middle{
	text-anchor:middle;
}

#end{
	text-anchor:end;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/text-anchor.svg">Centrage de texte avec la propriété
text-anchor</object>
</div>

<p>Vous verrez que cette propiété est très utile ! Maintenant, on peut se demander ce qu’il en est avec le centrage vertical. C’est
un peu plus compliqué. On doit utiliser la propriété <span class="csspropertie">baseline-shiht</span> qui prend comme paramètre soit
les mots-clefs <span class="csspropertie">baseline</span> (valeur par défaut), <span class="csspropertie">sub</span> (pour mettre le
texte en indice) et <span class="csspropertie">super</span> (pour le mettre en exposant), soit en pourcentage, soit dans une autre
unité. C’est la dernière possibilité qui va nous intéresser. En effet, vous savez que l’on peut utiliser les unités de polices
relatives : les <span class="csspropertie">em</span> et les <span class="csspropertie">ex</span>.</p>

<p>Cette propriété ne s’applique pas directement à l’élément <span class="balise">text</span>. En effet, <span class="csspropertie">baseline-shiht</span> permet de décaler la ligne de base du texte sur lequel il est appliqué <strong>par rapport</strong> au parent. Il faut donc envelopper le texte que l’on souhaite dans un <span class="balise">tspan</span> qui sera décalé par rapport au <span class="balise">text</span> parent.</p>

<p>Le principal problème que vous rencontrerez est que le centrage vertical du texte est plus compliqué que le centrage horizontal.
En effet, si vous mettez 0,5 em, le texte semblera beaucoup trop décalé vers le bas. En fait, il vaut mieux spécifier 0,5 ex, car la
plupart des glyphes ont la taille du x.</p>

<p class="rappel">Le ex est une unité relative au texte et 1 ex vaut la hauteur de la lettre « x ».</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="baseline-shift.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Centrage vertical de texte avec baseline-shift</title>

<!-- cadre entourant la zone de dessin -->
<rect x="0" y="0" width="400" height="300"/>

<text id="un-demi-em" x="200" y="100"><tspan>Moins un demi em</tspan></text>
<line x1="50" x2="350" y1="100" y2="100"/>

<text id="un-demi-ex" x="200" y="200"><tspan>Moins un demi ex</tspan></text>
<line x1="50" x2="350" y1="200" y2="200"/>

<!-- textes dans les coins -->

<text id="haut-gauche" x="0" y="0"><tspan>Haut gauche</tspan></text>

<text id="haut-droit" x="400" y="0"><tspan>Haut droit</tspan></text>

<text x="0" y="300">Bas gauche</text>

<text id="bas-droit" x="400" y="300">Bas droit</text>

</svg>]]></div>

<div class="csscode"><![CDATA[rect, line{
	fill:none;
	stroke:black;
}

text{
	font-size:16px;
}

#un-demi-em{
	font-size:26px;
	text-anchor:middle;
}

#un-demi-em > tspan{
	baseline-shift:-0.5em;
}

#un-demi-ex{
	font-size:26px;
	text-anchor:middle;
}

#un-demi-ex > tspan{
	baseline-shift:-0.5ex;
}

#haut-gauche > tspan{
	baseline-shift:-1em;
}

#haut-droit > tspan{
	text-anchor:end;
	baseline-shift:-1em;
}

/* pas besoin de changement pour le texte en bas à gauche */

#bas-droit{
	text-anchor:end;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/baseline-shift.svg">Centrage vertical de texte avec
baseline-shift</object>
</div>

<h3 id="tspan">L’élément <span class="balise">tspan</span></h3>

<p>À l’instar d’XHTML, il existe en SVG une balise <span class="balise">tspan</span> qui permet de désigner une portion de
texte. On peut y indiquer les attributs <span class="attribute">id</span> et <span class="attribute">class</span> afin de styler une
portion de texte en particulier. Par exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="tspan.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de l’élément tspan</title>

<text x="200" y="150">Fumar puede <tspan class="strong">matar</tspan> !</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:20px;
	/* centrage horizontal et vertical */
	text-anchor:middle;
}

.strong{
	font-weight:bold;
	text-decoration:underline;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/tspan.svg">Utilisation de l’élément tspan</object>
</div>

<p class="rappel">Le nom des classes devrait toujours être choisi en tenant compte de la fonction de cette classe et non pas en
fonction du rendu visuel. J’aurais pu appelé cette classe <span class="csspropertie">matar</span> ou
<span class="csspropertie">gras</span>, mais le rajout d’un autre texte avec cette même classe aurait pu devenir illogique (par
exemple, le texte « vivre » avec une classe <span class="csspropertie">matar</span>). Dans le cas ci-dessus, la classe
<span class="csspropertie">strong</span> a été choisi parcequ’elle indique du texte important, en référence à l’élément XHTML
<span class="balise">strong</span>.</p>

<p>Cet élément accepte aussi les attributs <span class="attribute">x</span> et <span class="attribute">y</span>, ce qui peut
s’avérer très utile pour écrire du texte multiligne. En effet, SVG 1.1 n’offre pas de mécanisme pour faire cela automatiquement
(c’est prévu dans <acronym title="Working Draft">WD</acronym> (Working Draft) SVG 1.2). Faisons un peu de poésie :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="tspan-multiline.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de l’élément tspan pour du texte multiligne</title>

<text id="titre" x="200" y="0"><tspan>L’Adieu</tspan></text>

<text x="10" y="100">J’ai cueilli ce brin de bruyère
<tspan x="10" y="116">L’automne est morte souviens-t’en</tspan>
<tspan x="10" y="132">Nous ne nous verrons plus sur terre</tspan>
<tspan x="10" y="148">Odeur du temps brin de bruyère</tspan>
<tspan x="10" y="164">Et souviens-toi que je t’attends</tspan>
</text>

<text id="auteur" x="400" y="290">Apollinaire</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:16px;
}

#titre{
	text-anchor:middle;
	font-size:20px;
	font-style:italic;
}

#titre > tspan{
	baseline-shift:-1em;
}

#auteur{
	text-anchor:end;
	/* on relève un peu le texte */
	baseline-shift:4px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/tspan-multiline.svg">Utilisation de l’élément tspan pour du
texte multiligne</object>
</div>

<p>On aurait bien sur pu écrire plusieurs balises <span class="balise">text</span>, une pour chaque ligne, mais ça
n’aurait pas été correct d’un point de vue sémantique (le poème fait parti d’un tout et à ce titre, le titre aussi aurait du être
inclu dans l’élément <span class="balise">text</span> principal) et la sélection du poème en entier aurait été
impossible. Essayez de sélectionner le titre, le poème et le nom de l’auteur : c’est impossible parcequ’ils ne sont pas dans la même
balise.</p>


<h3 id="déplacement">Glissement et rotation des glyphes</h3>

<p><span class="balise">text</span> et <span class="balise">tspan</span> accepte tous deux les attributs
<span class="attribute">dx</span> et <span class="attribute">dy</span>, qui permettent d’effectuer un glissement sur les axes x et
y, et <span class="attribute">rotate</span> qui permet de faire subir une rotation à un glyphe.</p>

<h4>Glissements</h4>

<p>Les attributs <span class="attribute">dx</span> et <span class="attribute">dy</span> prennent en paramêtre une ou plusieurs
longueurs séparées par des blancs ou des virgules.<br/>
<span class="attribute">dx</span> provoque, dans le cas ou une seule valeur est spécifié, un glissement de la valeur spécifié sur
l’axe des x.<br/>
<span class="attribute">dy</span> fait la même chose, mais sur l’axe des y.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="dx-dy-simple.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les attributs dx et dy</title>

<text x="10" y="75">W
<tspan dx="50">a</tspan>
<tspan dx="40">h</tspan>
<tspan dx="30">o</tspan>
<tspan dx="20">o</tspan>
<tspan dx="10">o</tspan>
uu</text>

<text x="250" y="150">Ceci est <tspan dy="-20">un</tspan> test</text>

<text id="vague" x="200" y="280">Ceci
<tspan dy="-2">e</tspan>
<tspan dy="-3">s</tspan>
<tspan dy="-4">t</tspan>
<tspan dy="-5"> </tspan>
<tspan dy="-6">u</tspan>
<tspan dy="-7">n</tspan>
<tspan dy="-8">e</tspan>
<tspan dy="-9"> </tspan>
<tspan dy="-8">t</tspan>
<tspan dy="-7">rè</tspan>
<!-- -59 -->
<tspan dy="9">s</tspan>
<tspan dy="10"> </tspan>
<tspan dy="9">g</tspan>
<tspan dy="8">r</tspan>
<tspan dy="7">o</tspan>
<tspan dy="6">s</tspan>
<tspan dy="5">s</tspan>
<tspan dy="3">e</tspan>
<tspan dy="2"> </tspan>
<!-- +59 -->
vague</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:16px;
}

#vague{
	text-anchor:middle;
	letter-spacing:2px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/dx-dy-simple.svg">Les attributs dx et dy</object>
</div>

<p>Vous pouvez bien sur combiner <span class="attribute">dx</span> et <span class="attribute">dy</span> à votre gré. Remarquez que
dans le texte « Ceci est un test », seul « un » subit un glissement, mais que la suite (« test ») reste sur la même ligne. En fait,
c’est la position du texte courante qui est modifiée, non seulement pour le texte de la balise
<span class="balise">tspan</span>, mais aussi pour le texte qui suit.</p>

<p>Quand on souhaite faire glisser une série de lettres, le code devient vite chargé. C’est pourquoi il est permis d’indiquer une
série de longueurs séparées par des blancs ou des virgules. Chaque valeur de position n désigne le n<sup>e</sup> glyphe.
Si il n’y a pas assez de longueurs spécifiées dans l’attribut, aucun glissement n’est réalisé sur les derniers glyphes. Si au
contraire il y a trop de valeurs, alors celles supplémentaires n’affecteront aucun glyphe.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="dx-dy-complex.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Plusieurs valeurs pour l’attributs dy</title>

<text x="200" y="200"
dy="0 -1 -2 -4 -8 -16 -32 -48 -60"
dx="1 2 4 8 16 32 48 60 60">Décollage</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:20px;
	text-anchor:middle;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/dx-dy-complex.svg"></object>
</div>

<h4>Rotation</h4>

<p>La rotation fonctionne exactement de la même manière que les deux attributs vu ci-dessus : on renseigne l’attribut
<span class="attribute">rotate</span> d’une ou plusieurs valeurs, les rotations des glyphes en degrés. Exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="rotate.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple d’utilisation de l’attribut rotate</title>

<text x="200" y="150" rotate="10 15 20 25 30 40">Domino</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:40px;
	text-anchor:middle;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/rotate.svg">Exemple d’utilisation de l’attribut rotate</object>
</div>

<p>La rotation se fait à partir du coin bas gauche du glyphe, ce qui rend le résultat assez moyen. Cet attribut permet néanmoins
d’écrire du texte vertical : il suffit de faire subir une rotation de -90 à chaque lettre et de faire subir une rotation au texte
entier comme ceci :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="texte-vertical.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple d’utilisation de l’attribut rotate</title>

<text x="200" y="150"
rotate="-90 -90 -90 -90 -90 -90 -90 -90"
transform="rotate(90 200 150)">Vertical</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:20px;
	/* centrage */
	text-anchor:middle;
	baseline-shift:-0.5ex;
	/* ajout d’une espace entre les lettres pour qu’elles ne soient pas écrasées */
	letter-spacing:10px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/texte-vertical.svg"></object>
</div>

<p>Pas très convaincant… Il existe heureusement une autre manière d’écrire du texte vertical, grâce aux propriétés CSS
<span class="csspropertie">writing-mode</span> et <span class="csspropertie">glyph-orientation-vertical</span>.</p>

<p>Il faut tout d’abord fixer la propriété <span class="csspropertie">writing-mode</span> à tb (pour top-bottom, de bas en haut) car
la propriété <span class="csspropertie">glyph-orientation-vertical</span> ne fonctionne que quand
<span class="csspropertie">writing-mode</span> est sur tb. On doit ensuite déterminer un angle de 0 degré pour
<span class="csspropertie">glyph-orientation-vertical</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="texte-vertical-2.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple d’utilisation de l’attribut rotate</title>

<text x="200" y="150" >Vertical</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:20px;
	writing-mode:tb;
	glyph-orientation-vertical:0;
	/* centrage */
	text-anchor:middle;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/texte-vertical-2.svg">Exemple d’utilisation de l’attribut
rotate</object>
</div>

<p>C’est mieux (essayez de sélectionner chacun des deux textes, vous comprendrez pourquoi) ! On peut faire varier l’espacement entre
les glyphes avec la propriété <span class="attribute">letter-spacing</span> comme vu précédemment.</p>

<h3 id="longueur">Longueur du texte</h3>

<p>Jusqu’ici, nous n’avons spécifié la taille du texte (<span class="csspropertie">font-size</span>) qu’avec des pixels, cette unité
absolue nous garantissant un contrôle strict sur la longueur du texte. Imaginez maintenant que la longueur du texte ne soit pas
connue à l’avance, par exemple avec des données provenant d’un formulaire et traitées avec <acronym title="PHP : Hypertext
Preprocessor">PHP</acronym> : ça devient problématique ! SVG permet évidemment de remédier à cela grâce aux attributs
<span class="attribute">textLength</span> et <span class="attribute">lengthAdjust</span> (qui ne sont pas supportés par le viewer
d’Adobe).</p>

<p>Le premier attribut, <span class="attribute">textLength</span>, reçoit la longueur que doit faire le texte (la valeur doit
être positive). Le traitement de la longueur du texte se fait après les opérations effectuées par les propriétés
<span class="csspropertie">kerning</span>, <span class="csspropertie">letter-spacing</span> et
<span class="csspropertie">word-spacing</span> et les attributs <span class="attribute">dx</span> et
<span class="attribute">dy</span>.</p>

<p>Le second attribut, <span class="attribute">lengthAdjust</span>, permet quant à lui un contrôle plus fin sur le type
d’ajustement utilisé pour <span class="attribute">textLength</span>. La valeur par défaut est <span class="attribute">spacing</span>
qui demande que l’ajustement se fasse seulement sur les espacements. Les glyphes ne sont donc ni étirés, ni compressés.
Si on veut que l’ajustement se fasse aussi sur les glyphes, on doit utiliser la valeur
<span class="attribute">spacingAndGlyphs</span>.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textlength.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Contrôle de la longueur du texte</title>

<line x1="100" x2="100" y1="50" y2="250"/>
<line x1="300" x2="300" y1="50" y2="250"/>


<text x="200" y="75" textLength="200" lengthAdjust="spacing"><tspan>Étiré</tspan></text>
<text x="200" y="125" textLength="200" lengthAdjust="spacingAndGlyphs"><tspan>Étiré</tspan></text>

<text x="200" y="175" textLength="200" lengthAdjust="spacing"><tspan>Complètement compressé</tspan></text>
<text x="200" y="225" textLength="200" lengthAdjust="spacingAndGlyphs"><tspan>Complètement compressé</tspan></text>


</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:24px;
	/* centrage horizontal et vertical */
	text-anchor:middle;
}
text > tspan{
	baseline-shift:-0.5ex;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/textlength.svg">Contrôle de la longueur du texte</object>
</div>

<h3 id="tref">L’élément <span class="balise">tref</span></h3>

<p>L’élément <span class="balise">text</span> peut contenir soit du texte, soit un élément
<span class="balise">tref</span> qui peut appeler du texte grâce à l’attribut <span class="attribute">xlink:href</span>
qui prend en paramêtre l’adresse du texte à appeler. Il accepte, à l’instar de <span class="balise">text</span> et de
<span class="balise">tspan</span>, les attributs suivants : <span class="attribute">x</span>,
<span class="attribute">y</span>, <span class="attribute">dx</span>, <span class="attribute">dy</span>,
<span class="attribute">rotate</span>, <span class="attribute">textLength</span> et <span class="attribute">lengthAdjust</span>.</p>

<h3 id="surpath">Du texte sur un <span class="balise">path</span></h3>

<p>C’est maintenant que ça commence à devenir intéressant
<object type="image/gif" data="images/smileys/sleeping.gif">ZZZzzzZZZ</object>. Allo ? Vous rappelez vous avoir tracé des carrés au
chapitre précédent alors que <span class="balise">rect</span> est là pour ça ? C’est maintenant que nous servir car nous
allons apprendre à mettre du texte sur un chemin ! Génial, non ?</p>

<p>Pour mettre du texte sur un <span class="balise">path</span>, on utiliser l’élément
<span class="balise">textPath</span> dans un <span class="balise">text</span>. On écrit ensuite le texte qu’on
désire faire suivre le chemin entre les balises ouvrantes et fermantes de <span class="balise">textPath</span>. L’attribut
<span class="attribute">xlink:href</span> de <span class="balise">textPath</span> désigne le chemin à utiliser.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textPath.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Du texte sur un chemin</title>

<path id="chemin" d="M 50,150 Q 100,38 200,150 T 380,160"/>

<text>
	<textPath xlink:href="#chemin">
	Vrou vroum vrrroooooouuuuuuummmmmm hhhhhhhhhhhiiiiiiiiiiiiiiiikkkkkkkkkkkkkkkkkkkk
	</textPath>
</text>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	fill:none;
	stroke:black;
}

text{
	font-size:20px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/textPath.svg">Du texte sur un chemin</object>
</div>

<p>Le texte en trop n’est bien sur pas affiché.</p>

<p>On est bien sur pas obligé de faire figurer le chemin : il suffit de mettre le <span class="balise">path</span> en
définition. On peut aussi utiliser l’élément <span class="balise">tref</span> au lieu d’écrire le texte directement.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textPath-2.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Du texte sur un chemin invisible</title>

<defs>
	<text id="phrase">Le chemin utilisé n’est plus visible !</text>
</defs>

<text>
	<textPath xlink:href="textPath.svg#chemin">
		<tref xlink:href="#phrase"/>
	</textPath>
</text>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	font-size:20px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/textPath-2.svg">Du texte sur un chemin invisible</object>
</div>

<p>Remarquez que nous avons utilisé un <span class="balise">path</span> déjà tracé dans un autre fichier SVG
(<span class="attribute">textPath.svg#chemin</span>). Avec <span class="attribute">xlink:href</span>, on peut toujours faire
référence à des fragments de fichiers extérieurs (identifiés grâce aux <span class="attribute">id</span>).</p>

<p><span class="balise">textPath</span> peut porter plusieurs attributs, dont <span class="attribute">startOffset</span>
que vous allez bientôt adorer (je ne vous en dit pas plus <object type="image/gif" data="images/smileys/biggrin.gif">:D</object>).
Il prend en paramètre une longueur représentera le décalage du texte par rapport au point de départ du chemin. Si sa valeur est un
pourcentage, c’est en pourcentage du chemin. On peut donc facilement centrer du texte sur un
<span class="balise">path</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="startOffset.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’attribut startOffset</title>

<path id="courbe" d="M 50,200 A 300 400 0 0 1 350,200"/>

<text>
	<textPath xlink:href="#courbe" startOffset="50%">
		Wooooosh
	</textPath>
</text>

</svg>]]></div>

<div class="csscode"><![CDATA[path{
	fill:none;
	stroke:gainsboro;
	stroke-dasharray:5,8;
}

text{
	font-size:20px;
	text-anchor:middle;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/startOffset.svg">L’attribut startOffset</object>
</div>

<p>L’attribut <span class="attribute">method</span> permet d’indiquer la méthode de rendu du texte. Sa valeur par défaut est
<span class="attribute">align</span>. Dans ce cas, le côté de la boîte (rectangulaire) contenant le glyphe touchant le chemin fait
parti de la tangente :</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/method-schema.svg">Schéma illustrant le comportement d’un
glyphe d’un textPath lorsque l’attribut method est réglé à align</object>
</div>

<p>Cet attribut peut aussi prendre la valeur <span class="attribute">strectch</span>. Dans ce cas, les glyphes prendront la forme du
chemin et seront donc déformés. Néanmoins, dans le cas où on utilise des glyphes reliés (écritures cursives), ils restent reliés
après la transformation. Le viewer d’Adobe ne supporte pas cet attribut.</p>

<h3 id="xmlspace"><span class="attribute">xml:space</span>, traitement conditionnel</h3>

<h4>La gestion des espaces blancs</h4>

<p>La gestion des espaces blancs se fait grâce à l’attribut standard <acronym title="eXtensible Markup Language">XML</acronym>
<span class="attribute">xml:space</span> qui peut prendre deux valeurs :</p>

<ul class="list-attributes">
<li><span class="attribute">default</span></li>
<li><span class="attribute">preserve</span></li>
</ul>

<p>Pour la valeur <span class="attribute">default</span> (qui est la valeur par défaut), les retours à la lignes et les
tabulations sont convertis en espace blanc. Ensuite, les espaces de tête et de queue sont supprimés (ainsi,
« &nbsp;&nbsp;&nbsp;texte&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; » est converti en « texte »). Puis, les suites
d’espaces sont ramenées à un seul espace.</p>

<p>Quand <span class="attribute">xml:space</span> prend la valeur <span class="attribute">preserve</span>, seuls les retours à la
ligne et les tabulations sont convertis en espaces blancs. Ensuite, le texte est dessiné avec tous les espaces blancs.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="space-schema.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’attribut xml:space</title>

<line x1="0" x2="400" y1="150" y2="150"/>

<!-- default -->
<text class="legende" x="2" y="0"><tspan>xml:space="default"</tspan></text>
<text x="40" y="75" xml:space="default">   Ceci

est

    du

   texte.</text>

<!-- preserve -->
<text class="legende" x="2" y="150"><tspan>xml:space="preserve"</tspan></text>
<text x="40" y="225" xml:space="preserve">   Ceci

est

    du

   texte.</text>

</svg>]]></div>

<div class="csscode"><![CDATA[line{
	stroke:black;
	stroke-width:2px;
}

.legende{
	font-size:14px;
	font-weight:bold;
}
.legende > tspan{
	baseline-shift:-1em;
}]]></div>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/space-schema.svg"></object>
</div>

<h4>Traitement conditionnel</h4>

<p>SVG met à disposition un élément, <span class="balise">switch</span>, qui permet le traitement conditionnel à partir de
trois critères : les capacités du <acronym title="Document Object Model">DOM</acronym> SVG, les extensions supportées et la
langue indiqué par l’utilisateur. Nous ne verrons que cette dernière possibilité.</p>

<p>Le processeur va parcourir les enfants directs de <span class="balise">switch</span> et évaluer l’attribut
<span class="attribute">systemLanguage</span> jusqu’à ce qu’il trouve la valeur qui lui convient. Il arrête alors son traitement et
les enfants suivants ne sont donc pas affichés. Si un des éléments évalués n’a pas d’attributs
<span class="attribute">systemLanguage</span>, alors il est évalué comme convenable et est traité en tant que tel.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="systemLanguage.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Le traitement conditionnel en fonction de la langue</title>

<switch>
	<text x="200" y="150" systemLanguage="en">Hello !</text>
	<text x="200" y="150" systemLanguage="es">Hola !</text>
	<text x="200" y="150" systemLanguage="fr">Bonjour !</text>
	<text x="200" y="150">Texte affiché si l’anglais, l’espagnol et le français ne sont pas reconnus.</text>
	<text x="200" y="150" systemLanguage="EO">Bonan tagon (bonjour en esperanto jamais affiché puisque le frère précédent n’a pas d’attribut systemLanguage)</text>
</switch>

</svg>]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	baseline-shift:-0.5ex;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/le-texte-en-svg/systemLanguage.svg">Le traitement conditionnel en fonction de la
langue</object>
</div>

<p class="rappel">Vous pouvez spécifier plusieurs langues, les valeurs devant être séparées par des virgules.<br/>
Vous pouvez aussi donnez des codes de pays arpès un code de langue, par exemple, vous pouvez écrire fr-fr et fr-be pour différencier
les français et les belges.<br/>
Les codes de langues sont disponibles <a href="http://www.w3.org/WAI/ER/IG/ert/iso639.htm">à cette adresse là</a> et les codes de
pays <a href="http://www.iana.org/cctld/cctld-whois.htm">à celle-ci</a>.</p>

<p>Ce chapitre assez barbant touche ici à sa fin, et nous allons maintenant passer à quelquechose d’autrement plus passionant :
les animations <object type="image/gif" data="images/smileys/eek.gif">8|</object>.</p>

<div class="previouspage"><a href="paths.php" title="cours précédent">Les chemins</a></div>
<div class="nextpage"><a href="animations-chapitre-1.php" title="cours suivant">Les animations (partie 1)</a></div>

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
