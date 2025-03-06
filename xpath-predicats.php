<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<title>SVGround : prédicats avec XPath</title>
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
<h2>XPath : prédicats</h2>

<p></p>

<ul class="sommaire">
<li><a href="#input">Entrée simple</a></li>
</ul>

<h3 id="input"></h3>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e '//*[position() mod 2 = 1]' test.xml 
Found 4 nodes in test.xml:
-- NODE --
<root>
  <item id="1" a="b">abcd</item>
  <item id="2">cdef</item>
  <item id="3" />
  <item id="4">ghij</item>
  <item id="5">klmn</item>
</root>
-- NODE --
<item id="1" a="b">abcd</item>
-- NODE --
<item id="3" />
-- NODE --
<item id="5">klmn</item>
tangui@deus:~$
]]></div>

<div class="previouspage"><a href="xpath-fonctions.php" title="cours précédent">XPath : fonctions</a></div>

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
