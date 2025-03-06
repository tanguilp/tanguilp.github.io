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
<h2>Liens utiles</h2>

<h3>Sur le langage SVG</h3>

<h4>Sites francophones</h4>
<ul class="sommaire">
<li><a href="http://www.svgfr.org/">svgfr.org</a> : communauté francophone des codeurs SVG</li>
<li><a href="http://wiki.svgfr.org/doku.php">Wiki sur SVG</a></li>
<li><a href="http://www.orvinfait.fr/svg/index.html">Orvinfait</a></li>
<li><a href="http://developpez-en-svg.homelinux.org/">SVG Devzone</a></li>
</ul>

<h4>Exemples</h4>
<ul class="sommaire">
<li><a href="http://www.treebuilder.de/default.asp?file=279567.xml">treebuilder</a> : des exemples</li>
<li><a href="http://brian.sol1.net/svg/tests/">Exemples d’animation</a></li>
<li><a href="http://www.kevlindev.com/tutorials/basics/index.htm">kevlindev</a> : encore des exemples</li>
<li><a href="http://srufaculty.sru.edu/david.dailey/svg/newstuff/Newlist.htm">Une foule d’exemples</a> parfois impressionants</li>
<li><a href="http://www.msieurhappy.net/svg.xhtml">XSLT pour la génération de graphiques SVG</a></li>
</ul>

<h4>Spécifications</h4>
<ul class="sommaire">
<li><a href="http://www.w3.org/TR/SVG11/">Spécification de SVG1.1</a> (en anglais)</li>
<li><a href="http://www.yoyodesign.org/doc/w3c/svg1/index.html">Traduction française de SVG1.0</a></li>
<li><a href="http://jwatt.org/svg/authoring/">Bonnes pratiques</a> (en anglais)</li>
</ul>

<h4>Support</h4>
<ul class="sommaire">
<li><a href="http://www.codedread.com/svg-support.php">Récapitulatif</a></li>
<li><a href="http://www.mozilla.org/projects/svg/status.html">Support dans Gecko (Firefox)</a></li>
<li><a href="http://www.opera.com/docs/specs/opera95/svg/">Support dans Opera</a></li>
<li><a href="http://webkit.org/projects/svg/status.xml">Support dans Webkit (Konqueror, Safari, Chrome)</a></li>
</ul>

<h4 id="svgdom">Le DOM SVG</h4>
<ul class="sommaire">
<li><a href="http://www.w3.org/TR/SVG11/types.html#BasicDOMInterfaces">Les types de base</a></li>
<li><a href="http://www.w3.org/TR/SVG11/struct.html#DOMInterfaces">Structure d’un document</a></li>
<li><a href="http://www.w3.org/TR/SVG11/styling.html#DOMInterfaces">Élément de style</a></li>
<li><a href="http://www.w3.org/TR/SVG11/coords.html#DOMInterfaces">Système de coordonnées</a></li>
<li><a href="http://www.w3.org/TR/SVG11/paths.html#DOMInterfaces">Tracés</a></li>
<li><a href="http://www.w3.org/TR/SVG11/shapes.html#DOMInterfaces">Formes de base</a></li>
<li><a href="http://www.w3.org/TR/SVG11/text.html#DOMInterfaces">Le texte</a></li>
<li><a href="http://www.w3.org/TR/SVG11/painting.html#DOMInterfaces">Marqueurs, remplissage et bordure</a></li>
<li><a href="http://www.w3.org/TR/SVG11/color.html#DOMInterfaces">Profil de couleur</a></li>
<li><a href="http://www.w3.org/TR/SVG11/pservers.html#DOMInterfaces">Dégradés et motifs</a></li>
<li><a href="http://www.w3.org/TR/SVG11/masking.html#DOMInterfaces">Masques et découpes</a></li>
<li><a href="http://www.w3.org/TR/SVG11/filters.html#DOMInterfaces">Filtres</a></li>
<li><a href="http://www.w3.org/TR/SVG11/interact.html#DOMInterfaces">Interactivité</a></li>
<li><a href="http://www.w3.org/TR/SVG11/script.html#DOMInterfaces">Scripting</a></li>
<li><a href="http://www.w3.org/TR/SVG11/animate.html#DOMInterfaces">Animations</a></li>
<li><a href="http://www.w3.org/TR/SVG11/fonts.html#DOMInterfaces">Polices</a></li>
<li><a href="http://www.w3.org/TR/SVG11/extend.html#DOMInterfaces">Extensibilité</a></li>
<li><a href="http://www.w3.org/TR/SVG11/svgdom.html">Appendice B : le DOM SVG</a></li>
</ul>


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
