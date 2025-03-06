<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<title>SVGround : fonctions XPath</title>
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
<h2>XPath : fonctions</h2>

<p></p>

<ul class="sommaire">
<li><a href="#types">Les quatres types de base</a></li>
<li><a href="#strings">Les fonctions sur les chaînes de caractères</a></li>
<li><a href="#numbers">Les fonctions sur les nombres</a></li>
<li><a href="#bool">Les fonctions sur les booléens</a></li>
<li><a href="#nodeset">Les fonctions sur les ensembles de nœuds</a></li>
</ul>

<h3 id="types">Les quatres types de base</h3>

<p>Il existe quatre types de donnée dans le modèle XPath.</p>

<h4>Les chaînes de caractères</h4>

<p>Les chaînes, d'abord qui sont représentées en Unicode. Vous n'aurez donc pas de problème
pour traiter des chaînes comportant des caractères en dehors de l'US-ASCII.</p>

<h4>Les nombres</h4>

<p></p>

<h4>Les booléens</h4>
<h4>Les ensembles de nœud</h4>

<h3 id="strings">Les fonctions sur les chaînes de caractères</h3>
<h4><span class="xpath">concat</span></h4>
<h4><span class="xpath">starts-with</span></h4>
<h4><span class="xpath">contains</span></h4>
<h4><span class="xpath">substring-before</span></h4>
<h4><span class="xpath">substring-after</span></h4>
<h4><span class="xpath">substring</span></h4>
<h4><span class="xpath">string-length</span></h4>
<h4><span class="xpath">normalize-space</span></h4>
<h4><span class="xpath">translate</span></h4>
<h4><span class="xpath">string</span></h4>
<h3 id="numbers">Les fonctions sur les nombres</h3>
<h4>Opérateurs</h4>
<h4><span class="xpath">number</span></h4>
<h4><span class="xpath">sum</span></h4>
<h4><span class="xpath">floor</span></h4>
<h4><span class="xpath">ceiling</span></h4>
<h4><span class="xpath">round</span></h4>
<h3 id="bool">Les fonctions sur les booléens</h3>
<h4>Opérateurs</h4>
<h4><span class="xpath">boolean</span></h4>
<h4><span class="xpath">not</span></h4>
<h4><span class="xpath">true</span></h4>
<h4><span class="xpath">false</span></h4>
<h4><span class="xpath">lang</span></h4>
<h3 id="nodeset">Les fonctions sur les ensembles de nœuds</h3>
<h4><span class="xpath">position</span></h4>
<h4><span class="xpath">last</span></h4>
<h4><span class="xpath">count</span></h4>
<h4><span class="xpath">id</span></h4>
<h4><span class="xpath">local-name</span></h4>
<h4><span class="xpath">namespace-uri</span></h4>
<h4><span class="xpath">name</span></h4>

<div class="previouspage"><a href="xpath-axes.php" title="cours précédent">XPath : axes</a></div>
<div class="nextpage"><a href="xpath-predicats.php" title="cours suivant">XPath : predicats</a></div>

</div>
<!--
<span class="attribute"></span>
<span class="balise"></span>
<span class="xpath"></span>

<div class="xmlcode"><![CDATA[]]></div>

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
