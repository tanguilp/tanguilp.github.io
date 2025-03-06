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
<h2>Un premier document SVG</h2>

<h3>Structure basique d’un document SVG</h3>
<p>Vos documents SVG devront toujours avoir cette structure :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

</svg>]]>
</div>

<p>Pour faciliter leur référencement, vous pouvez aussi ajouter un titre et un description :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Mon premier document SVG !</title>
<desc>Salut, ceci est mon premier document SVG. SVGround, c’est cool pour apprendre le SVG !</desc>

</svg>]]>
</div>

<h3>Explications</h3>

<p>Décomposons le document :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]></div>
<p>On commence d’abord par le prologue XML dans lequel on indique la version de XML utilisée et l’encodage.
Il y a beaucoup de chances que votre éditeur de texte enregistre les documents en iso-8859-1. Si ce n’est pas le cas, vous devriez
trouver une option vous permettant de choisir. Attention : rappelez vous que si rien n’est indiqué, l’encodage par défaut est
l’UTF-8 !</p>

<div class="xmlcode"><![CDATA[<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN"
"http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">]]>
</div>
<p>Ensuite, nous avons le DOCTYPE permettant au navigateur de avoir ce qu’il affiche. Ici, c’est bien évidemment du SVG !<br/>
&lt;!DOCTYPE indique au processeur XML qu’il s’agit d’un DOCTYPE ; ensuite viens  le type de document : SVG ; puis on a
l’identifiant public (-//W3C//DTD SVG 20010904//EN) ; enfin l’adresse de la DTD.</p>

<div class="xmlcode"><![CDATA[
<svg width="400px" height="300px" xml:lang="fr"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

</svg>]]>
</div>
<p>On arrive enfin à notre première balise SVG ! <object type="image/gif" data="images/smileys/rolleyes.gif">8/</object><br/>
Il s’agit bien sur de l’élément racine de notre document.</p>

<p class="rappel">Une des règles fondamentales de XML est qu’un élément (une balise) doit contenir toutes les autres. Par exemple,
la balise <span class="balise">html</span> contient toutes les autres balises HTML dans un document Web.</p>

<p>Les attributs <span class="attribute">width</span> et <span class="attribute">height</span> servent à spécifier respectivement
la longueur et la largeur du dessin. On peut spécificer ces longueurs en pixel, mais il n’y a pas moins de 9 unités possibles :</p>

<ul class="list-attributes">
	<li>px : le pixel</li>
	<li>mm : le millimètre</li>
	<li>cm : le centimètre</li>
	<li>in : le pouce</li>
	<li>pc : le pica (1/6 de pouce)</li>
	<li>pt : le point (1/72 de pouce)</li>
	<li>em : la taille du carré em, soit le plus souvent la taille d’une ligne</li>
	<li>ex : la taille de la lettre x</li>
	<li>% : le pourcentage de la zone de visualiation, c’est à dire de la fenêtre de votre navigateur si vous ouvrez un dessin SVG
	dedans.</li>
</ul>
<p>Si vous n’écrivez pas les attributs <span class="attribute">width</span> et <span class="attribute">height</span>, alors le
processeur SVG considérera que ces deux valeurs valent 100%.</p>

<p>On arrive ensuite au namespaces.</p>

<p class="rappel">Le mécanisme des namespaces sert, concrètement, à indiquer au parseur XML de quel langage il s’agit. Il évite donc
les conflits entre deux balises ayant le même nom mais appartenant à deux langages différents, par exemple les balises
<span class="balise">text</span> de SVG et de XSLT.<br/>
On utilise un préfixe pour indiquer à quel namespace appartient une balise ou un attribut. Par exemple « xlink:href » appartient au
namespace XLink, son nom qualifié (qname) est « xlink:href », son nom local (localname) est « href » et son préfixe est « xlink ».<br/>
On doit déclarer un espace de nommage avant de l’utiliser (grâce à l’attribut xmlns) de cette façon :<br/>
<span class="attribute">xmlns:prefix="URI de l’espace de nommage"</span>
</p>

<p>Pour SVG, il suffit juste d’indiquer le namespace de SVG, la <acronym title="Document Type Definition">DTD</acronym> se chargeant de
XLink. Cependant, dans un soucis d’interopérabilité et puisque ça nous ne coûte rien, on va quand même le mettre. En plus ça nous
évitera des problèmes lors d’un traitement avec XSLT. <object type="image/gif" data="images/smileys/whistling.gif">:°</object></p>

<p>On peut aussi spécifier deux balises enfants de <span class="balise">svg</span> :
<span class="balise">title</span> et <span class="balise">desc</span>.</p>

<p><span class="balise">title</span> sert à donner un titre à notre dessin. Son contenu ne sera donc pas affiché dans la
zone de dessin. Par contre, il est probable qu’il s’affiche dans la barre d’état de votre navigateur ou dans une infobulle lors du
survol du document SVG par la souris. Il n’est pas obligatoire mais pour des raisons d’accesibilité, on devrait toujours
mettre un titre évocateur, comme dans un document (X)HTML.</p>

<p><span class="balise">desc</span> donne la description de notre dessin. Renseigner cette balise peut s’avérer utile
lorsqu’on souhaite que le document soit référencé par un moteur de recherche.</p>

<p>Et bien je crois que nous sommes prêts à dessiner nos premières formes en SVG.
<object type="image/gif" data="images/smileys/innocent.gif">O:)</object>
</p>

<div class="previouspage"><a href="introduction.php" title="cours précédent">Introduction</a></div>
<div class="nextpage"><a href="formes-de-base.php" title="cours suivant">Les formes de base</a></div>

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
