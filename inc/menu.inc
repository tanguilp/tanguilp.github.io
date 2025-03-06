<?php
$menu = array(
	null => array(
		array('Accueil', 'main.php')),
	'XML' => array(
		array('Tutorial sur XML', 'tutorial-xml.php')),
	'Le langage <acronym title="Scalable Vector Graphics">SVG</acronym>' => array(
		array('Introduction', 'introduction.php'),
		array('Un premier document SVG', 'un-premier-document-svg.php'),
		array('Les formes de base', 'formes-de-base.php'),
		array('Les transformations', 'transformations.php'),
		array('Structure d’un document SVG', 'structure.php'),
		array('Les chemins (paths)', 'paths.php'),
		array('Le texte', 'le-texte-en-svg.php'),
		array('Introduction aux animations', 'animations-chapitre-1.php'),
		array('Motifs de remplissage', 'motifs.php'),
		array('Dégradés de couleur', 'degrades.php'),
		array('Clip/Mask', 'clip-et-mask.php'),
		array('Les filtres', 'filtres.php'),
		array('Ratio, symboles', 'viewbox-et-ratio.php'),
		array('Aller plus loin avec les animations', 'animations-chapitre-2.php'),
		array('Créer sa police de caractère', 'creer-sa-police.php'),
		array('Du SVG dans du XHTML, extensibilité', 'extensibilite.php'),
		array('XSLT pour SVG', 'xslt-pour-svg.php'),
		array('Le DOM avec Javascript', 'dom.php'),
		array('Le DOM SVG', 'svgdom.php'),
		array('SVG 1.2', 'svg1.2.php')),
	/*'XBL2' => array(
          array('XBL2', 'prochainement.php')),*/
	'XPath 1.0' => array(
		array('Introduction', 'xpath-intro.php'),
		array('Axes', 'xpath-axes.php'),
		array('Fonctions', 'xpath-fonctions.php'),
		array('Prédicats', 'xpath-predicats.php')),
	'XForms' => array(
		array('Introduction', 'xf-intro.php'),
		array('Modèle', 'xf-model.php'),
		array('Éléments de contrôle', 'xf-controles.php'),
		array('Soumettre ses donnée', 'prochainement.php'),
		array('Gestion des évènements', 'prochainement.php'),
		array('Validation et types de données', 'prochainement.php'),
		array('Les conteneurs', 'prochainement.php'),
		array('Le style', 'prochainement.php'),
		array('Élément de liaison', 'prochainement.php'),
		array('Fonctions XPath additionnelles', 'prochainement.php'),
		array('Répétition, insertion et supression', 'prochainement.php'),
		array('Actions', 'prochainement.php')),
	'Autre' => array(
		array('Les URI data:', 'data_uri.php'),
		array('Liens', 'liens.php'),
		array('Espaces de nom', 'namespaces.php')),
	'Le site' => array(
		array('Blog', 'blog/'),
		array('Forum', 'forum/'),
		array('Salle de discussion Jabber', 'xmpp:svgfr@chat.jabberfr.org?join'),
		array('Participer', 'participer.php')
		));

$href = @split('/', $_SERVER['PHP_SELF']);
$href = $href[count($href)-1];

foreach ($menu as $head => $items) {
	if ($head)
		echo '<li class="menuHead">', $head, '</li>', "\n";
	foreach ($items as $item)
		echo '<li><a href="', $item[1], '"', (($href == $item[1] && $href != 'prochainement.php')?' class="currentpage"':''), '>', $item[0], '</a></li>', "\n";
}
?>
