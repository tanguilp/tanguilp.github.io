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
<h2>Les espaces de noms</h2>

<h3>Liste des espaces de nom utiles</h3>

<p>Voici une liste des espaces de nom dont vous pourriez avoir besoin pour le développement Web :</p>

<ul class="list-attributes">
<li><strong>XHTML</strong> : http://www.w3.org/1999/xhtml</li>
<li><strong>SVG</strong> : http://www.w3.org/2000/svg</li>
<li><strong>XLink</strong> : http://www.w3.org/1999/xlink</li>
<li><strong>MathML</strong> : http://www.w3.org/1998/Math/MathML</li>
<li><strong>XForms</strong> : http://www.w3.org/2002/xforms</li>
<li><strong>XML Events</strong> : http://www.w3.org/2001/xml-events</li>
<li><strong>XUL</strong> : http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul</li>
<li><strong>XML Schema</strong> : http://www.w3.org/2001/XMLSchema</li>
<li><strong>XSLT</strong> : http://www.w3.org/1999/XSL/Transform</li>
</ul>

<h3>Espaces de nom et CSS</h3>

<p>Exemple d’utilisation avec CSS :</p>

<div class="csscode"><![CDATA[/* espace de nom par défaut */
@namespace url(http://www.w3.org/1999/xhtml);

/* autres espaces de nom */
@namespace svg url(http://www.w3.org/2000/svg);
@namespace mathml url(http://www.w3.org/1998/Math/MathML);
@namespace xslt url(http://www.w3.org/1999/XSL/Transform);

/* éléments p de XHTML */
p{
	/* propriétés */
}

/* éléments rect de SVG */
svg|rect{
	/* propriétés */
}

/* éléments text de tous les espaces de noms */
*|text{
	/* propriétés */
}

/* tous les éléments XForms */
xf|*{
	/* propriétés */
}

/* tous les éléments XHTML */
*{
	/* propriétés */
}

/* tous les éléments */
*|*{
	/* propriétés */
}

/* tous les mo de mathml contenus dans un g SVG */
svg|g mathml|mo{
	/* propriétés */
}

/* tous les éléments SVG fils d’un élément XHTML */
* > svg|svg{
	/* propriétés */
}
]]></div>

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
