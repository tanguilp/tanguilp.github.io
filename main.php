<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<title>SVGround : cours SVG</title>
<?php
require('inc/xhtml_head.php');
?>
</head>
<body>

<h1>
<object type="image/svg+xml" data="images/svground.svg">
<p>SVGround : tout sur SVG</p>
</object></h1>

<div id="contenu">
<h2>Bienvenue sur SVGround</h2>

<p style="font-style:italic;font-size:104%"><img src="images/dialog-warning.png" alt="Attention" /> À l’heure actuelle, le seul navigateur qui vous permettra de visualiser au mieux les exemples de ce site est <a href="http://www.opera.com/download/">Opera</a>. Par exemple, les animations fonctionnent beaucoup mieux sous Opera.</p>

<h3>Qu’est ce que SVGround ?</h3>
<p>SVGround est un site mettant à votre disposition des cours sur <acronym title="Scalable Vector Graphics">SVG</acronym>
(version 1.1) les plus complets possibles. L’objectif initial est de mettre en ligne des cours exhaustifs sur cette spécification.
<a href="http://www.w3.org/TR/SVG11/" title="Lien vers la spécification">SVG</a> est le langage de dessin vectoriel crée et promu
par le <acronym title="World Wide Web Consortium">W3C</acronym>.</p>

<h3>Que dois-je connaître pour commencer les cours ?</h3>
<p>Il est recommandé d’avoir les bases concernant <acronym title="eXtensible Markup Language">XML</acronym> et plus particulièrement
de connaître le mécanisme des namespaces.<br/>
Il est aussi nécessaire de connaître les bases de la syntaxe <acronym title="Cascading StyleSheet">CSS</acronym> (propriétés,
sélecteurs, etc).<br/>
Cependant nous prendrons le temps d’y revenir.</p>

<h3>Qu’est ce que n’est pas SVGround ?</h3>
<p>À la fin de votre apprentissage, vous ne serez pas capable de créer un jeu en <acronym title="Scalable Vector Graphics">SVG</acronym>.
En effet, <acronym title="Scalable Vector Graphics">SVG</acronym> ne suffit pas pour ça :
il faut faire appel au langage Ecmascript (ou javascript) pour gérer les évènements utilisateurs. La page de
<a href="liens.php">liens</a> donne les adresses nécessaire à l’appronfondissement du langage Ecmascript pour
<acronym title="Scalable Vector Graphics">SVG</acronym>. Cependant, les bases apprises ici seront nécessaire à la réalisation
d’un jeu.</p>

<h3>De quels logiciels ai-je besoin pour accéder aux cours et pour créer mes dessins SVG ?</h3>
<p>Pour accéder aux cours, il est indispensable d’avoir un navigateur acceptant le langage
<acronym title="eXtensible HyperText Markup Language">XHTML</acronym> et <acronym title="Scalable Vector Graphics">SVG</acronym>.
Firefox et Opera permettent de visiter ce site en profitant des exemples SVG. Préférez Opera (9.5 ou supérieur) qui a un meilleur support. Plus d’infos dans l’introduction.<br/>
<acronym title="Scalable Vector Graphics">SVG</acronym> bénéficiant de la syntaxe
<acronym title="eXtensible Markup Language">XML</acronym>, un simple éditeur de texte suffit pour
créer ses propres dessin. Cependant, l’utilisation d’un éditeur <acronym title="eXtensible Markup Language">XML</acronym>
peut s’avérer plus confortable.</p>

<div class="nextpage"><a href="introduction.php" title="cours suivant">Introduction</a></div>

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
