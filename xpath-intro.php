<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<title>SVGround : introduction sur XPath</title>
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
<h2>XPath : introduction</h2>

<p>XPath 1.0 est un langage d'adressage conçu pour XML et les dialectes qui en dérivent.
Il permet de désigner des "parties" d'un document XML.</p>

<p>Il ne s'utilise pas tout seul. En fait, ce sont différents langages qui s'en servent pour effectuer cette
tâche spécifique. Ce langage a d'abord été conçu pour Xslt puis a été utilisé par XForms, XQuery et par certains
langages de description de schéma (Schematron et dans une moindre mesure XML Schema). Vous l'avez sans doute
deviné, XPath a été conçu et normalisé par le W3C.</p>

<p>Il s'agit d'un langage simple qui adopte une syntaxe assez proche des systèmes de fichiers. Après tout, un
système de fichier a une structure d'arbre, tout comme XML ! Simple ne veut pas dire qu'il n'y a pas des subtilités
et ce cours sur XPath 1.0 vous les présentera.</p>

<p>Pour répondre aux faiblesses de cette norme, XPath2.0 a été créé. Plus complexe notamment parcequ'il apporte le typage,
il sera peut être l'objet d'un prochain cours.</p>

<div class="nextpage"><a href="xpath-axes.php" title="cours suivant">XPath : axes de sélection</a></div>

</div>
<!--
<span class="attribute"></span>
<span class="balise"></span>
<span class="xpath"></span>

<div class="xmlcode"><![CDATA[
]]></div>

<div class="csscode"><![CDATA[]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/"></object>
</div>
-->

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
