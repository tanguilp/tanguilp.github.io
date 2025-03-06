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
<h2>Participer</h2>

<p>L'écriture de ce site a commencé en 2005. À cette époque, SVG n'était
quasiment pas supporté. La situation a évolué favorablement à ce standard
mais ce site, SVGround, n'est parfois plus à jour.</p>

<p>De plus, le cours SVG n'est pas complet : il manque quelques fonctionnalités
du langage qui ne sont pas couvertes, par manque de temps ou par défaut de support.
Plus d'infos <a href="http://svground.fr/blog/cours-svg-presque-termine/">sur le blog</a>.
</p>

<p>
L'auteur de ce site n'ayant plus le temps de continuer, voire de maintenir, ce site, toute aide
est la bienvenue. Pour commencer, venez discuter avec nous sur jabber :
<a href="xmpp:svgfr@chat.jabberfr.org?join">xmpp:svgfr@chat.jabberfr.org?join</a>. Vous trouverez
aussi les sources du site sur le <a href="https://github.com/tanguilp/svground/">dépot git
sur github</a>. Ce site est sous licence libre. N'hésitez pas à envoyer vos patchs !
</p>

<p>Tout investissement plus conséquent est également bienvenue. Les tutoriels XPath, Xslt et XForms
attendent leur rédacteur !</p>

<p>Enfin, si vous avez apprécié l'aide que vous a apporté SVGround, parlez-en
autour de vous et surtout postez des liens sur le net afin de le faire grimper
dans les résultats des moteurs de recherche !</p>

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
