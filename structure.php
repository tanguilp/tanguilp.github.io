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
<h2>Structurer un document SVG</h2>

<p>Jusqu’ici, notre code était très verbeux. Par exemple, même si plusieurs objets avaient les mêmes propriétés CSS, il fallait les
écrire à chaque fois dans l’attribut <span class="attribute">style</span>. De même, on ne pouvais pas réutiliser un carré déjà
tracé pour le placer un peu plus loin et tourné. SVG bénéficiant des avantages de la syntaxe XML, il est facilement stylable avec
CSS et fortement réutilisable grâce aux <span class="attribute">id</span>. Au final, on peut très fortement optimiser un document SVG
et lui faire adopter une structure logique qui facilitera toute modification du code.</p>



<ul class="sommaire">
<li><a href="#css">De l’utilisation des <acronym title="Cascading StyleSheet">CSS</acronym></a></li>
<li><a href="#zonedessin">Précision sur la zone de dessin <span class="balise">svg</span></a></li>
<li><a href="#briques">Les briques graphiques</a></li>
<li><a href="#liens">Les liens menant hors du contenu SVG</a></li>
<li><a href="#images">Les images</a></li>
<li><a href="#attributs-communs">Les attributs communs</a></li>
</ul>



<h3 id="css">De l’utilisation des <acronym title="Cascading StyleSheet">CSS</acronym></h3>

<p>SVG étant un langage XML, il est très facile de le styler avec CSS. Il existe quatre manière de styler un élément SVG :</p>

<h4>Les attributs de présentation</h4>

<p>Il existe tout un tas d’attributs de présentation pour styler un élément. Par exemple, pour avoir un carré rouge, on peut écrire :
</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un carré rouge</title>

<rect x="100" y="100" width="100" height="100" fill="red"/>

</svg>]]></div>

<p>On peut aussi utiliser <span class="attribute">stroke</span>, <span class="attribute">stroke-width</span>,
<span class="attribute">fill-opacity</span>, etc. Cependant, on oubliera vite ce mode de styling parcequ’il ne respecte pas la règle
de séparation des données et de la présentation, allourdit le fichier, et tout simplement ne permet pas de profiter des avantages
des CSS.</p>

<h4>Le style en ligne</h4>

<p>C’est grâce au style en ligne que nous avons stylé nos dessin jusqu’à maintenant. En effet, les balises SVG acceptent toutes
l’attribut <span class="attribute">style</span> dans lequel on spécifie les couples propriété/valeur séparés par des point-virgules.
</p>

<h4>La feuille de style interne</h4>

<p>À l’instar d’XHTML, SVG permet d’inclure une feuille de style interne grâce à la balise
<span class="balise">style</span> placée comme premier enfant d’une balise SVG. On prendra le soin de placer tout cela
dans une section CDATA, pour ne pas s’embêter avec les ', ", &amp;, &lt; et &gt;. On devra aussi préciser que le style est du css,
grâce à l’attribut <span class="attribute">type</span> que nous fixerons à <span class="attribute">text/css</span> qui est
le type MIME de CSS.</p>

<p class="rappel">Les sections CDATA font parti de la syntaxe de base de XML (1.0). Elles permettent d’éviter à l’auteur de devoir
échapper les caractères spéciaux XML. Par exemple, ceci créera une erreur car <cite>10 <strong>&lt;</strong> 20</cite> est
considéré comme un début de balise :<br/>
<span class="balise sanslt">&lt;p&gt;Hey les gars, 10 est inférieur à 20 ! En langage mathématique, on note 10 &lt; 20 !&lt;/p&gt;</span>
<br/>On peut facilement échapper le texte en grâce à une section CDATA comme ceci :<br/>
<span class="balise sanslt">
&lt;p&gt;&lt;![CDATA[Hey les gars, 10 est inférieur à 20 ! En langage mathématique, on note 10 &lt; 20 !]]&gt;&lt;/p&gt;</span><br/>
Une section CDATA ne peut pas contenir la chaîne « ]]&gt; ».
</p>

<p>Par exemple, pour un même carré rouge :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Un carré rouge</title>

<style type="text/css">
<]]>![CDATA[
#carre{
	fill:red;
}
]]<![CDATA[>
</style>

<rect id="carre" x="100" y="100" width="100" height="100"/>

</svg>]]></div>

<p class="rappel">Toutes les balises XML peuvent avoir les attributs <span class="attribute">id</span> et
<span class="attribute">class</span>. En CSS, on désigne un <span class="attribute">id</span> par le croisillon (<span class="csspropertie">#</span>) et la classe par le
point (<span class="csspropertie">.</span>). Par exemple, <span class="csspropertie">circle#cadran</span> désigne le cercle dont l’<span class="attribute">id</span>
est <cite>cadran</cite> et <span class="csspropertie">.red_stroke</span> désigne tous les éléments qui ont un attribut <span class="attribute">class</span> qui vaut
<cite>red_stroke</cite>.
</p>

<p>Avoir une feuille de style interne est très pratique car elle permet de styler facilement toute sorte d’éléments. Vous souvenez
vous de <a href="formes-de-base.php#rectangles">notre première forme</a> ? C’était un rectangle noir. Noir parceque par défaut,
une forme est remplie en noir. CSS nous permet de fixer d’autres valeurs par défaut. Si, par exemple, on veut que toutes nos
formes soient par défaut non remplies et avec une bordure violette de 3 pixels, on fera :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Redéfinition des styles par défaut avec CSS</title>

<style type="text/css">
<]]>![CDATA[
*{
	fill:none;
	stroke:orchid;
	stroke-width:3px;
}
]]<![CDATA[>
</style>

<circle cx="100" cy="200" r="75"/>

<polyline points="50,50 100,90 90,100 400,300 200,20"/>

</svg>]]></div>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/internal-css.svg">Redéfinition des styles par défaut avec CSS</object>
</div>

<p class="rappel">Le signe étoile (<span class="csspropertie">*</span>) désigne, en CSS, tous les éléments présents.
<span class="csspropertie">*{display:none;}</span> n’affichera rien.</p>

<p>En général, on place <span class="balise">style</span> en début de page. On peut aussi préciser le média associé, grâce
à l’attribut <span class="attribute">media</span> qui peut prendre les valeurs suivantes :</p>

<ul class="list-attributes">
<li><span class="attribute">all</span> : c’est la valeur par défaut et ça veut dire « tous les médias » ;</li>
<li><span class="attribute">aural</span> pour les feuilles de style audios ;</li>
<li><span class="attribute">braille</span> : pour les sorties braille ;</li>
<li><span class="attribute">embossed</span> : pour les sorties braille papier ;</li>
<li><span class="attribute">handheld</span> qui sert aux périphériques protables à basses résolution et bande passante;</li>
<li><span class="attribute">print</span> pour l’impression ;</li>
<li><span class="attribute">projection</span> quand on voudra projeter nos SVG sur un mur ou l’imprimer sur papier transparent ;</li>
<li><span class="attribute">screen</span> : pour nos écrans ;</li>
<li><span class="attribute">tty</span> : c’est un peu la même chose que pour <span class="attribute">handheld</span> ;</li> <!-- FIXME: faux -->
<li><span class="attribute">tv</span> quand on voudra envoyer nos dessin sur un téléviseur.</li>
</ul>

<p>Les types qui nous intéresserons principalement seront <span class="attribute">screen</span> et
<span class="attribute">print</span>. Rien ne vous empêche d’avoir un élément <span class="balise">style</span> pour le
média screen, un autre pour le média print, un troisième pour screen, etc.</p>

<p>Le seul inconvénient avec les feuilles de style internes, c’est qu’on ne peut pas proposer de feuilles de styles alternatives. Ce
problème est résolu par l’utilisation de…</p>

<h4 id="externStylesheets">Feuilles de style externes</h4>

<p>Pour utiliser des feuilles de style externes, il n’y a pas, comme en (X)HTML, de balise <span class="balise">link</span>
: on doit donc utiliser la processing-instruction <span class="pi">xml-stylesheet …</span>.</p>

<p class="rappel">La <acronym title="processing-instruction">PI</acronym> xml-stylesheet accepte 6 « attributs » :</p>

<ul class="list-attributes">
<li><span class="attribute">href</span> (obligatoire) : cet « attribut » pointe vers le fichier CSS en question ;</li>
<li><span class="attribute">type</span> (obligatoire) : celui-ci nous renseigne sur le type de feuille de style. Dans notre cas, ça
sera une feuille de style CSS, et on écrira donc <span class="attribute">text/css</span> ;</li>
<li><span class="attribute">title</span> : il sert à donner un titre à la feuille de style pointée. C’est utile quand on en a
plusieurs ;</li>
<li><span class="attribute">media</span> : on spécifie ici le média pour lequel est destiné la feuille de style. Les différents
médias sont listés un peu plus haut ;</li>
<li><span class="attribute">charset</span> donne une information au programme qui va analyser notre feuille de style : son
encodage ;</li>
<li><span class="attribute">alternate</span> : peut prendre deux valeurs : « yes » et « no », « no » étant la valeur par défaut. On peut
avoir plusieurs feuilles de style alternatives et plusieurs feuilles de style non-alternative : ça ne pose pas de problème !</li>
</ul>

<p class="rappel">Ces <acronym title="processing-instruction">PI</acronym> doivent être placées dans le prologue du document, c’est
à dire juste après le prologue XML. On pourrait donc écrire :<br/>
<span class="pi">xml-stylesheet href="doc.css" type="text/css" title="Feuille de style principale, pour tous les medias"
charset="utf-8"</span><br/>
<span class="pi">xml-stylesheet href="screen.css" type="text/css" title="Design clair" media="screen" charset="utf-8"</span><br/>
<span class="pi">xml-stylesheet href="screen2.css" type="text/css" title="Design sombre" media="screen" charset="utf-8" alternate="yes"</span><br/>
<span class="pi">xml-stylesheet href="print.css" type="text/css" title="Imprimer en couleurs claires" media="print" charset="Big5"</span><br/>
<span class="pi">xml-stylesheet href="print2.css" type="text/css" title="Imprimer en couleurs sombres" media="print" charset="Big5"
alternate="yes"</span><br/>
Cette <acronym title="processing-instruction">PI</acronym> est malheureusement encore mal implémentée, notamment au niveau de
<span class="attribute">alternate</span>.<br/>
Pour plus d’informations, lisez <a href="http://www.w3.org/TR/xml-stylesheet/">la spécification</a>.
</p>

<p>Dorénavant, on n’utilisera plus que cette méthode pour styler du SVG, tout simplement car c’est la méthode la plus flexible. Elle
permet en outre de styler un nombre important de documents SVG grâce à un seul fichier.
Reprenons notre carré rouge. Maintenant, on fera :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="external-css.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation d’une feuille de style externe pour styler un carré</title>

<rect x="100" y="100" width="100" height="100"/>

</svg>]]></div>

<p>Et le CSS</p>

<div class="csscode"><![CDATA[rect{
	fill:red;
	stroke:black;
	stroke-width:3px;
	stroke-linejoin:bevel;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/external-css.svg">Utilisation d’une feuille de style externe pour
styler un carré</object>
</div>

<p>Dans cet exemple, les deux fichiers sont bien sur dans le même dossier. Lorsqu’on voudra changer la couleur de notre rectangle,
il suffira de modifier le fichier CSS : on n’aura pas besoin de toucher à la structure du fichier XML, comme on l’aurait fait avec
des attributs de présentation. Puissant, non ?</p>

<p>Une « astuce », que beaucoup ne connaissent pas, à propos de CSS : il est possible de spécifier plusieurs classes pour un même
élément. C’est très simple : on utilise toujours l’attribut <span class="attribute">class</span> mais on sépare les noms des
classes par une espace. Par exemple, on peut faire <span class="attribute">class="rempli-en-rouge bords-en-bleu"</span>.</p>


<h3 id="zonedessin">Précision sur la zone de dessin <span class="balise">svg</span></h3>

<p>Nous avons déjà vu que la racine d’un document SVG doit être l’élément <span class="balise">svg</span>. Il est néanmoins
possible d’intégrer d’autres balises <span class="balise">svg</span> à l’intérieur du dessin. On peut donc écrire :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="multiples-svg.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Plusieurs balise SVG dans un dessin</title>

<rect id="red-background" x="40" y="70" width="250" height="100"/>

<svg x="50" y="80" width="300" height="200">

	<rect id="light-background" x="0" y="0" width="100%" height="100%"/>

	<svg x="30" y="40" width="260" height="140">
		<circle cx="130" cy="70" r="60"/>
	</svg>

</svg>

</svg>]]></div>

<div class="csscode"><![CDATA[#red-background{
	fill:red;
	fill-opacity:0.5;
	stroke:black;
	stroke-width:2px;
}

#light-background{
	fill:cornsilk;
	fill-opacity:0.8;
}

circle{ /* il n’y a qu’un circle */
	fill:none;
	stroke:crimson;
	stroke-width:3px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/multiples-svg.svg">Utilisation d’une feuille de style externe pour
styler un carré</object>
</div>

<p class="rappel">Pour rappel, les commentaires en CSS sont délimités par <span class="csspropertie">/*</span> et
<span class="csspropertie">*/</span>. Ils peuvent être placés n’importe où.</p>

<p>Rien de bien compliqué : le troisième <span class="balise">svg</span> est situé par rapport aux second
<span class="balise">svg</span>. Ses coordonnées dans le premier <span class="balise">svg</span> sont donc
50+30,40+80 soit 80,120 (on ajoute les coordonnées des second et troisème <span class="balise">svg</span>).</p>

<p>Intéressons nous maintenant à la zone de dessin en elle même : si je vous demande comment on dessine le premier pixel (celui
tout en haut à gauche), vous me répondez ? Ceux qui sont habitués à travailler sur du bitmap pensent sans doute qu’il faut écrire
:</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Comment dessiner un pixel en SVG ?</title>

<circle cx="1" cy="1" r="0.5"/>

</svg>]]></div>

<p>Et bien non ! En fait, les points de coordonées 1,1, 10,20, 400,300, etc ne désignent pas des pixels mais les intersections
des lignes des abscisses et des ordonnées. Pour dessiner le pixel tout-en-haut-à-gauche, on devra faire :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Comment dessiner un pixel en SVG ? Avec un carré de côté 1 !</title>

<rect x="0" y="0" width="1" height="1"/>

</svg>]]></div>

<p>Voici un schéma pour bien visualiser la chose.</p>

<div class="object-schema">
<object type="image/svg+xml" data="images/cours/structure/first-pixel-schema.svg"></object>
</div>

<h3 id="briques">Les briques graphiques</h3>

<p>Dans un dessin vectoriel, on a souvent besoin de réutiliser des formes déjà créées. À notre niveau, si on souhaite dessiner trois
sapin, on devra à chaque fois redessiner toutes les formes en prenant soin de recalculer leurs coordonnées. SVG permet heureusement
de regrouper plusieurs formes dans une seule balise dans le but de pouvoir réutiliser cette « brique graphique ». On utilisera la
balise <span class="balise">g</span>.</p>

<p>Essayons d’abord de dessiner un sapin dans une balise <span class="balise">g</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="sapin.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple d’utilisation de la balise g</title>

<g id="monsapin">
	<rect x="45" y="70" width="10" height="20"/>
	<polygon points="20,70 80,70 60,55 70,55 55,40 65,40 50,20 35,40 45,40 30,55 40,55"/>
</g>

</svg>]]></div>

<div class="csscode"><![CDATA[#monsapin rect{
	fill:peru;
}

#monsapin polygon{
	fill:forestgreen;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/sapin.svg">Exemple d’utilisation de la balise g</object>
</div>

<p class="rappel">Je suis nul en dessin</p>

<p>Comme vous le voyez, la balise <span class="balise">g</span> ne change strictement rien : sans elle, il serait dessiné
exactement la même chose. C’est maintenant que ça va devenir intéressant : il est possible de réutiliser ce dessin grâce à l’
élément <span class="balise">use</span>. <span class="balise">use</span> doit avoir un attribut
<span class="attribute">xlink:href</span> (qui appartient à l’espace de nommage XLink) qui pointe vers une balise
<span class="balise">g</span>. On aura pris soin d’attribuer un <span class="attribute">id</span> à notre brique graphique.
L’élément <span class="balise">use</span> accepte aussi les attributs <span class="attribute">x</span> et
<span class="attribute">y</span> mais nous allons plutôt nous servir de quelquechose que nous avons vu pour replacer notre brique :
les transformations. Pour une meilleur lisibilité, on n’utlisera que l’attribut <span class="attribute">transform</span> (et non pas
<span class="attribute">x</span> et <span class="attribute">y</span>). Exemple avec des translations :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="sapins.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple de réutilisation d’une brique graphique</title>

<g id="monsapin">
	<rect x="45" y="70" width="10" height="20"/>
	<polygon points="20,70 80,70 60,55 70,55 55,40 65,40 50,20 35,40 45,40 30,55 40,55"/>
</g>

<use xlink:href="#monsapin" transform="translate(100,100)"/>
<use xlink:href="#monsapin" transform="translate(10,190)"/>
<use xlink:href="#monsapin" transform="translate(300,-20)"/>
<use xlink:href="#monsapin" transform="translate(320,200)"/>
<use xlink:href="#monsapin" transform="translate(200,160)"/>
<use xlink:href="#monsapin" transform="translate(170,30)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#monsapin rect{
	fill:peru;
}

#monsapin polygon{
	fill:forestgreen;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/sapins.svg">Exemple de réutilisation d’une brique graphique</object>
</div>

<p>Tout simplement <object type="image/gif" data="images/smileys/rolleyes.gif">:)</object>. Et ça marche aussi avec
<span class="attribute">scale</span> :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="sapins-scale.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple de réutilisation d’une brique graphique</title>

<g id="monsapin">
	<rect x="45" y="70" width="10" height="20"/>
	<polygon points="20,70 80,70 60,55 70,55 55,40 65,40 50,20 35,40 45,40 30,55 40,55"/>
</g>

<use xlink:href="#monsapin" transform="translate(100,100) scale(1.5)"/>
<use xlink:href="#monsapin" transform="translate(10,190) scale(1.2)"/>
<use xlink:href="#monsapin" transform="translate(300,-20) scale(2)"/>
<use xlink:href="#monsapin" transform="translate(320,200) scale(0.4)"/>
<use xlink:href="#monsapin" transform="translate(200,160) scale(0.2)"/>
<use xlink:href="#monsapin" transform="translate(170,30)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#monsapin rect{
	fill:peru;
}

#monsapin polygon{
	fill:forestgreen;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/sapins-scale.svg"></object>
</div>

<p>Le changement d’échelle a bien sur pour point d’origine le coin haut gauche de notre brique graphique. Essayons avec rotate,
skewX et skewY :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="sapins-transfos.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Exemple de réutilisation d’une brique graphique</title>

<g id="monsapin">
	<rect x="45" y="70" width="10" height="20"/>
	<polygon points="20,70 80,70 60,55 70,55 55,40 65,40 50,20 35,40 45,40 30,55 40,55"/>
</g>

<use xlink:href="#monsapin" transform="translate(100,100) rotate(90)"/>
<use xlink:href="#monsapin" transform="translate(10,190) skewX(-30)"/>
<use xlink:href="#monsapin" transform="translate(300,-20) rotate(88)"/>
<use xlink:href="#monsapin" transform="translate(320,200) rotate(76)"/>
<use xlink:href="#monsapin" transform="translate(200,160) skewY(10)"/>
<use xlink:href="#monsapin" transform="translate(170,30) rotate(10)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[#monsapin rect{
	fill:peru;
}

#monsapin polygon{
	fill:forestgreen;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/sapins-transfos.svg">Exemple de réutilisation d’une brique graphique
</object>
</div>

<p>Vous avez remarqué que la rotation ne s’est pas faite à partir du coin haut droit de la zone de dessin
<span class="balise">svg</span> mais du point de coordonnées 0,0 de notre brique graphique
<span class="balise">g</span>. C’est pourquoi il peut paraître utile de centrer notre dessin contenu dans notre
<span class="balise">g</span>. C’est en fait très facile : il suffit d’utiliser des coordonnées négatives. Exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="centered-g.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’art de centrer le contenu de ses briques graphiques g</title>

<g id="smiley">
	<circle id="tete" cx="0" cy="0" r="30"/>
	<ellipse cx="0" cy="14" rx="15" ry="8"/>
	<circle class="oeil" cx="-10" cy="-14" r="1"/>
	<circle class="oeil" cx="10" cy="-14" r="1"/>
	<circle id="nez" cx="0" cy="0" r="3"/>
</g>

<use xlink:href="#smiley" transform="translate(200,150) scale(3) rotate(17)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[/* redéfinition des styles par défaut */
*{
	fill:lavenderblush;
	stroke:black;
}

.oeil{
	fill:blue;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/centered-g.svg">L’art de centrer le contenu de ses briques graphiques g
</object>
</div>

<p>Maintenant, on aimerais éviter le dessin en haut à gauche. En fait, on souhaite déclarer notre dessin sans l’afficher puis
l’utiliser ensuite. SVG met a disposition la balise <span class="balise">defs</span> qui contient tout ce qu’on défini et
qu’on souhaite utiliser ensuite. Les balises contenus dans <span class="balise">defs</span> ne seront donc jamais
affichées directement. Dans notre cas, nous pouvons faire :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="defs.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La balise defs</title>

<defs>
	<g id="smiley">
		<circle id="tete" cx="0" cy="0" r="30"/>
		<ellipse cx="0" cy="14" rx="15" ry="8"/>
		<circle class="oeil" cx="-10" cy="-14" r="1"/>
		<circle class="oeil" cx="10" cy="-14" r="1"/>
		<circle id="nez" cx="0" cy="0" r="3"/>
	</g>
</defs>

<use xlink:href="#smiley" transform="translate(200,150) scale(3) rotate(17)"/>

</svg>]]></div>

<div class="csscode"><![CDATA[/* redéfinition des styles par défaut */
*{
	fill:lavenderblush;
	stroke:black;
}

.oeil{
	fill:blue;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/defs.svg">La balise defs</object>
</div>

<p>C’est aussi dans cette balise que nous stockerons les dégradés, les motifs, etc.</p>

<p><span class="balise">use</span> étant une balise XML, on peut la styler comme les autres. Mais que va-t-on styler au
juste puisque la balise <span class="balise">use</span> ne s’affiche pas à proprement parler ? Et bien c’est ce qui est
appelé qui sera stylé, ou restylé pusqu’il aura déjà les styles appliqués sur lui avant :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="use-css.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>La balise use et CSS</title>

<defs>
	<g id="smiley">
		<circle id="tete" cx="0" cy="0" r="30"/>
		<ellipse cx="0" cy="14" rx="15" ry="8"/>
		<circle class="oeil" cx="-10" cy="-14" r="1"/>
		<circle class="oeil" cx="10" cy="-14" r="1"/>
		<circle id="nez" cx="0" cy="0" r="3"/>
	</g>
</defs>

<use xlink:href="#smiley" transform="translate(100,150) scale(2)"/>
<use xlink:href="#smiley" transform="translate(120,150) scale(2)"/>
<use xlink:href="#smiley" transform="translate(140,150) scale(2)"/>
<use xlink:href="#smiley" transform="translate(160,150) scale(2)"/>
<use xlink:href="#smiley" transform="translate(180,150) scale(2)"/>
<use xlink:href="#smiley" transform="translate(200,150) scale(2)"/>


</svg>]]></div>

<div class="csscode"><![CDATA[/* redéfinition des styles par défaut */
*{
	fill:lavenderblush;
	stroke:black;
}

.oeil{
	fill:blue;
}

use{
	fill-opacity:0.1;
	stroke-opacity:0.1;
}

use+use{
	fill-opacity:0.2;
	stroke-opacity:0.2;
}

use+use+use{
	fill-opacity:0.4;
	stroke-opacity:0.4;
}

use+use+use+use{
	fill-opacity:0.6;
	stroke-opacity:0.6;
}

use+use+use+use+use{
	fill-opacity:0.8;
	stroke-opacity:0.8;
}

use+use+use+use+use+use{
	fill-opacity:1;
	stroke-opacity:1;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/use-css.svg">La balise use et CSS</object>
</div>

<p class="rappel">En CSS, le sélecteur « <span class="csspropertie">+</span> » est appelé « sélecteur d’enfants adjacent ».<br/>Dans l’expression
<span class="csspropertie">balise1 + balise2</span>, la balise concernée est <span class="csspropertie">balise2</span>. On pourrait
traduire par <span class="csspropertie">toutes les balise2 précédées par un balise1</span>.<br/>
<a href="http://www.yoyodesign.org/doc/w3c/css2/selector.html#adjacent-selectors">Spécification</a></p>

<p>Je crois que cet exemple montre bien la simplicité de la programmation en SVG et la puissance de ce langage. Et vous n’avez
encore rien vu <object type="image/gif" data="images/smileys/devil.gif">&gt;:)</object>.</p>

<p>Pour favoriser l’accessibilité, il peut être utile d’indiquer un titre et une description sur chaque élément de notre dessin.
L’élément <span class="balise">g</span> accepte justement les attributs <span class="attribute">title</span> et
<span class="attribute">desc</span>. Ne nous en privons pas : ça nous facilitera la relecture.</p>

<h3 id="liens">Les liens <quote cite="http://www.yoyodesign.org/doc/w3c/svg1/linking.html#Links">menant hors du contenu SVG</quote></h3>

<p>Il existe deux types de liens : les liens
<quote cite="http://www.yoyodesign.org/doc/w3c/svg1/linking.html#Links">menant hors du contenu SVG</quote> et les liens
<quote cite="http://www.yoyodesign.org/doc/w3c/svg1/linking.html#Links">menant dans un contenu SVG</quote>. À notre stade, nous ne
nous intéresserons pas au deuxième type de lien faisant appel à des connaissance que nous n’avons pas (encore).</p>

<p>SVG utilise XLink pour les liens. Comme en XHTML, l’élément qui permet de décrire un lien est
<span class="balise">a</span>. Deux attributs nous seront utiles : <span class="attribute">xlink:href</span> et
<span class="attribute">xlink:title</span>. Seuls les liens de type simple sont autorisés en SVG. On mettra les objets qu’on voudra
lier dans la balise <span class="balise">a</span>. Exemple :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="lien.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Les liens en SVG</title>

<a xlink:href="../../.." xlink:title="Accueil">
	<ellipse cx="200" cy="150" rx="180" ry="60"/>
</a>

</svg>]]></div>

<div class="csscode"><![CDATA[ellipse{
	fill:powderblue;
	stroke:plum;
	stroke-width:10px;
}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/lien.svg">Les liens en SVG</object>
</div>

<p>Il est impératif d’écrire l’attribut <span class="attribute">xlink:title</span> même si certaines implémentations ne le rendent
pas (notamment le viewer SVG d’Adobe, version 6 bêta). En effet, en XHTML, on a la plupart du temps du texte dans la balise
<span class="balise">a</span> ce qui n’est pas toujours le cas en SVG. Ici, sans
<span class="attribute">xlink:title</span>, on ne sait pas où on va.</p>

<!--<p>Comme le style, les liens sont conservés lors de la réutilisation d’un objet par la balise
<span class="balise">use</span>.</p>

<div class="xmlcode"><![CDATA[]]></div>

<div class="csscode"><![CDATA[]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/liens.svg">Les liens en SVG</object>
</div>-->

<h3 id="images">Les images</h3>

<p>Il est possible d’afficher des images <acronym title="Portable Network Graphics">PNG</acronym>,
<acronym title="Joint Photographic Experts Group">JPEG</acronym> et <acronym title="Scalable Vector Graphics">SVG</acronym> grâce à
la balise <span class="balise">image</span>. Cet affichage se fait très simplement grâce aux attributs
<span class="attribute">x</span> et <span class="attribute">y</span>, optionnels et par défaut à 0,
<span class="attribute">width</span> et <span class="attribute">height</span> qui eux sont requis. Par défaut, le ratio de
l’image est conservé, ce qui veut dire que si les attributs <span class="attribute">width</span> et
<span class="attribute">height</span> renseigné dans le document SVG ne sont pas les mêmes que les longueur et largeur de l’image,
elle ne sera pas étirée mais elle conservera son ratio et sera centrée à l’intérieur du rectangle de coordonnées
(<span class="attribute">x</span>,<span class="attribute">y</span>), de longueur <span class="attribute">width</span> et de hauteur
<span class="attribute">height</span>. Le lien vers l’image est réalisé via l’attribut
<span class="attribute">xlink:href</span>. Prenons par exemple cette image :</p>

<p class="centered-text"><object type="image/jpeg" data="images/cours/structure/palmier.jpg">Photo d’un palmier</object></p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="image.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Insérer une image bitmap en SVG</title>

<!-- la photo fait 180*271 -->
<image xlink:href="palmier.jpg" x="10" width="180" y="15" height="271"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/image.svg">Insérer une image bitmap en SVG</object>
</div>

<p>Ici, pas de problème : les longueurs sont respectées. Mais il peut en être autrement :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="image-ratio.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Insérer une image bitmap en SVG, avec des rapports longueur/largeur différents</title>

<!-- la photo fait 180*271 -->
<image xlink:href="palmier.jpg" x="110" width="120" y="15" height="280"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/structure/image-ratio.svg">Insérer une image bitmap en SVG, avec des rapports
longueur/largeur différents</object>
</div>

<p>Le viewer d’Adobe semble ne pas supporter cette partie de la spécification.</p>

<p>On peut contrôler la manière dont la ratio est conservé ou décider qu’il ne doit pas être conservé, mais cela fait appel à des
notions plutôt compliquées que nous verrons plus tard.</p>

<h3 id="attributs-communs">Les attributs communs</h3>

<p>En attendant que <a href="http://www.w3.org/TR/2005/PR-xml-id-20050712/" title="Lien vers la recommandation">xml:id</a> soit
reconnu par les parsers XML, il est possible d’attribuer à <em>tous</em> les éléments SVG l’attribut
<span class="attribute">id</span>. Il devient ainsi facile de manipuler un document XML via
l’<acronym title="Application Program Interface">API</acronym> <acronym title="Document Object Model">DOM</acronym>, avec le
langage de script ECMAScript par exemple.</p>

<p>De même, l’attribut <span class="attribute">xml:base</span> peut être appliqué à toutes les balises SVG. Cet attribut sert à
désigner un chemin de base du tous les chemins relatifs enfants. En gros, lorsque vous vous affichez <span class="attribute">xlink:href="image.jpg"</span>, le navigateur va chercher l’image dans le répertoire dans lequel se situe le dessin SVG. Avec l’attribute <span class="attribute">xml:base</span>, on ira chercher l’image spécifiée dans le répertoire indiqué par l’attribut.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="rapport-svg.css"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400" height="300"
xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de xml:base</title>

<g>
<image xlink:href="http://example.com/images/vacances/été2008/àlaplage/chateaudesable.jpg"/>
<image xlink:href="http://example.com/images/vacances/été2008/àlaplage/lamer.jpg"/>
<image xlink:href="http://example.com/images/vacances/été2008/àlaplage/lesoiseaux.jpg"/>
</g>

<!-- est équivalent à : -->

<g xml:base="http://example.com/images/vacances/été2008/àlaplage/">
<image xlink:href="chateaudesable.jpg"/>
<image xlink:href="lamer.jpg"/>
<image xlink:href="lesoiseaux.jpg"/>
</g>

</svg>]]></div>

<p>Il deux autres attributs de l’espace de nommage xml : <span class="attribute">xml:lang</span> et
<span class="attribute">xml:space</span>.</p>

<p>Pour le référencement, il est préférable d’indiquer la langue du document grâce à <span class="attribute">xml:lang</span>, même
si ce n’est pas obligatoire. Ensuite, on peut placer cet attribut sur les éléments susceptibles de contenir du texte.
<span class="balise">svg</span> est bien susceptible de contenir du texte tandis que des balises comme
<span class="balise">rect</span> ou <span class="balise">ellipse</span> n’en contiendrons jamais.</p>

<p><span class="attribute">xml:space</span>, tout comme <span class="attribute">xml:lang</span> ne s’applique qu’aux éléments pouvant
contenir du texte. Il accepte de valeurs : <span class="attribute">default</span> (valeur par défaut) et
<span class="attribute">preserve</span>.</p>

<p>Nous reviendront sur ces deux attributs lors du chapitre traitant du texte.</p>

<p>Maintenant que nous savons bien organiser un document SVG, nous allons voir quelquechose de beaucoup plus compliqué : les paths
<object type="image/gif" data="images/smileys/innocent.gif">O:)</object>.</p>

<div class="previouspage"><a href="transformations.php" title="cours précédent">Les transformations</a></div>
<div class="nextpage"><a href="paths.php" title="cours suivant">Les chemins</a></div>

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
