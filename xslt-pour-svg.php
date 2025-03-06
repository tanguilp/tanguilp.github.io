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
<h2>XSLT pour SVG</h2>

<p>XSLT n’étant pas l’objet de ce site, cette partie du cours sera assez succinte. En fait, on transforme du SVG avec XSLT de la même façon qu’on transforme n’importe quel contenu XML.</p>

<p>Il y a deux manière d’agir pour servir du contenu transformé : soit on laisse la transformation se faire côté client, soit on la fait côté serveur et on sert le SVG comme d’habitude.</p>

<ul class="sommaire">
<li><a href="#client">Transformation côté client</a></li>
<li><a href="#serveur">Transformation côté serveur</a></li>
</ul>

<h3 id="client">Transformation côté client</h3>

<p>Pour eﬀectuer la transformation côté client, on doit utiliser la processing-instruction <span class="pi">xml-stylesheet</span>, dont je décris les "attributs" <a href="structure.php#externStylesheets">ici</a>, à la diﬀérence que notre type mime sera ici <span class="mimeType">application/xml</span>.</p>

<p>Une petite mise au point s’impose pour Internet Explorer et XSLT en général. Ce navigateur ne reconnait que le type mime <span class="mimeType">text/xsl</span> qui est incorrect. Même s’il est reconnu par les autres navigateurs, utiliser ce type mime est un danger pour la pérennité de votre application. C’est pourquoi je conseille de ne pas faire de XSLT avec Internet Explorer, et que je dis qu’il ne connaît pas XSLT (ce qui est vrai dans l’absolu et de toute façon le support de ce langage est buggé et incomplet puisque fait à partir d’un working draft).</p>

<p>Prenons pour exemple ce ﬁchier XHTML que nous voulons transformer en barres :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Transformation XHTML vers SVG avec XSLT</title>
		<style type="text/css">]]>&lt;<![CDATA[![CDATA[
			@font-face {
			  font-family:Jacoba;
			  src: url(../../../inc/Jacoba/Jacoba_Bold.ttf);
			}


			h1{
				text-align:center;
				font-family:Jacoba;
				font-size:3em;
				}
		]]]]>&gt;<![CDATA[</style>
	</head>
	<body>
		<h1>Tableau récapitulatif des scores</h1>
		<table>
			<thead>
				<tr><th>Nom</th><th>Score</th></tr>
			</thead>
			<tbody>
				<tr><td>Paul</td><td>45</td></tr>
				<tr><td>Marc</td><td>123</td></tr>
				<tr><td>Luc</td><td>89</td></tr>
				<tr><td>Eugène</td><td>98</td></tr>
				<tr><td>Léopold</td><td>87</td></tr>
				<tr><td>Bernard Henri</td><td>3</td></tr>
				<tr><td>Sylvestre</td><td>141</td></tr>
			</tbody>
		</table>
	</body>
</html>]]></div>

<p>Il faut commencer par attacher la feuille de style XSLT à ce document, avec la processing-instruction <span class="pi">xml-stylesheet</span> comme ceci (seconde ligne) :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet href="graphique.xsl" type="application/xml"?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Transformation XHTML vers SVG avec XSLT</title>
		<style type="text/css">]]>&lt;<![CDATA[![CDATA[
			@namespace svg url(http://www.w3.org/2000/svg);

			@font-face {
			  font-family:Jacoba;
			  src: url(../../../inc/Jacoba/Jacoba_Bold.ttf);
			}


			h1{
				text-align:center;
				font-family:Jacoba;
				font-size:3em;
				}

			svg|svg{
				width:50%;
				margin-left:25%;
				margin-right:25%;
				}
		]]]]>&gt;<![CDATA[</style>
	</head>
	<body>
		<h1>Tableau récapitulatif des scores</h1>
		<table>
			<thead>
				<tr><th>Nom</th><th>Score</th></tr>
			</thead>
			<tbody>
				<tr><td>Paul</td><td>45</td></tr>
				<tr><td>Marc</td><td>123</td></tr>
				<tr><td>Luc</td><td>89</td></tr>
				<tr><td>Eugène</td><td>98</td></tr>
				<tr><td>Léopold</td><td>87</td></tr>
				<tr><td>Bernard Henri</td><td>3</td></tr>
				<tr><td>Sylvestre</td><td>141</td></tr>
			</tbody>
		</table>
	</body>
</html>]]></div>

<p>La seule difficulté résulte dans le fait qu’il faut bien renseigner les attributs de l’élément <span class="balise">output</span> du langage XSLT :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output indent="yes" encoding="utf-8" media-type="image/svg+xml"/>

<!-- programme XSLT -->

</xsl:stylesheet>]]></div>

<p>Il ne reste plus qu’à écrire le programme XSLT, en choisissant bien sûr l’encodage qui vous convient. XSLT n’est pas le sujet de ce cours, mais voici un exemple de transformation d’un tableau XHTML en graphique SVG.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:svg="http://www.w3.org/2000/svg"
	xmlns:xhtml="http://www.w3.org/1999/xhtml">
    <xsl:output method="xml" indent="yes"
		media-type="image/xhtml+xml"
        encoding="UTF-8"/>

	<!-- on arrondit la valeur maximum du score
		à la dizaine supérieure -->
    <xsl:variable name="max">
		<xsl:for-each select="//xhtml:tbody/xhtml:tr/xhtml:td[2]">
			<xsl:sort data-type="number" order="descending"/>
			<xsl:if test="position()=1">
				<xsl:value-of select="ceiling(. div 10) * 10"/>
			</xsl:if>
		</xsl:for-each>
	</xsl:variable>

	<!-- nombre de barres -->
	<!-- notez qu’on utilise les espaces de noms dans l’expression XPath -->
	<!-- il ne s’agit pas d’une option, c’est obligatoire et c’est une source d’erreur courrante -->
	<xsl:variable name="nbItems" select="count(//xhtml:tbody/xhtml:tr)"/>

	<!-- taille d’une barre : 30px -->
	<!-- espace entre les barres : 20 px -->
	<xsl:variable name="chartWidth" select="$nbItems * (30 + 20) - 20"/>

	<!-- hauteur du graphique -->
	<xsl:variable name="chartHeight" select="200"/>

	<!-- point en abscisse ou le graphique -->
	<xsl:variable name="chartX" select="20"/>

	<!-- idem pour les ordonnées -->
	<xsl:variable name="chartY" select="50"/>

	<!-- copie de tous les nœuds -->
	<!-- brièvement voici le fonctionnement de XSLT :
		XSLT parcourt tous les nœuds et recopie par défaut le texte.
		On peut changer ce comportement par défaut grâce à des templates.
		Pour chaque nœud, XSLT va choisir le template le plus spéciﬁque à ce nœud
		c’est à dire celui dont l’expression XPath lui correspond le mieux. Il existe des
		règles qui déterminent quel template il faut choisir mais c’est plutôt intuitif.
		Par exemple,
			//tr[position() mod 2 = 0]
		sera choisi contre
			//tr
		pour les <tr/> correspondant (ceux dont la position est paire).
		De même,
			table[@class = 'abc']/tr
		sera choisi contre
			tr
		pour les <tr/> concernés. -->
	<!-- la règle suivante est un règle de copie très générique -->
	<!-- utilisée seule, elle recopie tout le document -->
	<xsl:template match="node() | @*">
		<xsl:copy>
			<xsl:apply-templates select="@* | node()"/>
		</xsl:copy>
	</xsl:template>

	<!-- template plus spéciﬁque qui sera choisi pour <table/> -->
	<!-- cette expression sélectionne tous les <tables/>, c’est un peu
		bourrin mais on peut l’affiner -->
    <xsl:template match="//xhtml:table">
		<!-- le contenu de {} est une expression XPath évaluée -->
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
			width="50%" height="50%" viewBox="0 0 {$chartWidth + 40} 300">
            <defs>
				<filter id="ombre">
					<feGaussianBlur in="SourceAlpha" stdDeviation="2"/>
					<feOffset dx="2" dy="1"/>
					<feMerge result="image">
						<feMergeNode/>
						<feMergeNode in="SourceGraphic"/>
					</feMerge>
				</filter>

				<linearGradient gradientUnits="userSpaceOnUse" id="deg"
					x1="200" x2="200" y1="{$chartY}" y2="{$chartY + $chartHeight}">
					<stop offset="0%" stop-color="yellowgreen"/>
					<stop offset="100%" stop-color="rgb(220,250,50)"/>
				</linearGradient>
            </defs>

			<style type="text/css">]]>&lt;<![CDATA[![CDATA[
				.bar:hover rect{
					stroke:black;
					stroke-width:1px;
				}

				text{
					text-anchor:middle;
					}

				text.score{
					font-size:10px;
					font-weight:bold;
					visibility:hidden;
					}

				.bar:hover text.score{
					visibility:visible;
					}
			]]]]>&gt;<![CDATA[</style>

            <g>
				<!-- sélectionne tous les <tr/> ﬁls de <tbody> ﬁls
					du nœud courant -->
					<!-- le nœud courant est celui sélectionné dans
						xsl:template match="//xhtml:table"> -->
				<xsl:apply-templates select="xhtml:tbody/xhtml:tr"/>
            </g>
        </svg>
    </xsl:template>

	<xsl:template match="xhtml:tbody/xhtml:tr">
		<!-- hauteur de la barre -->
		<xsl:variable name="height" select="xhtml:td[2] div $max * $chartHeight"/>
		<!-- position en abscisse -->
		<xsl:variable name="xPos" select="$chartX + (position() - 1) * (30 + 20)"/>

		<svg:g class="bar">
			<!-- pour plus de facilité, on dessine d’abord les barres vers le bas
				puis on les retourne grâce à l’attribut transform -->
			<svg:rect x="{$xPos}" y="{$chartY}" width="30" height="{$height}" fill="url(#deg)"
				transform="scale(1, -1) translate(0, -300)" filter="url(#ombre)">
				<!-- barre qui montent -->
				<svg:animate attributeName="height" attributeType="XML"
					from="0" to="{$height}"
					begin="0s" dur="{xhtml:td[2] div $max * 1}s"/>
			</svg:rect>

			<svg:text class="score" x="{$xPos + 15}" y="{$chartY + $chartHeight - $height - 6}">
				<xsl:value-of select="xhtml:td[2]"/>
			</svg:text>

			<!-- on utilise ici le modulo pour décaler le texte une fois sur
				deux vers le bas pour éviter le chevauchement -->
			<svg:text x="{$xPos + 15}" y="{$chartY + $chartHeight + 15 + (position() + 1) mod 2 * 18}">
				<xsl:value-of select="xhtml:td[1]"/>
			</svg:text>
		</svg:g>
	</xsl:template>
</xsl:stylesheet>]]></div>

<p>Et voici le résultat (<a href="images/cours/xslt-pour-svg/graphique.xhtml">en pleine page</a>) :</p>

<div class="object-example">
<object type="application/xhtml+xml" data="images/cours/xslt-pour-svg/graphique.xhtml">Transformation XHTML vers SVG avec XSLT</object>
</div>

<p>Notez les eﬀets d’animation utilisés ici et surtout le fait que la page XHTML d’origine a été conservés. Seul l’élément <span class="balise">table</span> et ses ﬁls ont été transformés.</p>

<p>Ce type de transformation est assez mal supporté sur le client (mais ça s’améliore), et c’est pourquoi il est parfois nécessaire d’utiliser les transformations côtés serveur, là où on a (en principe) le contrôle de la conﬁguration.</p>

<h3 id="serveur">Transformation côté serveur</h3>

<p>Il existe une multitude de solutions pour réaliser une transformations XSLT côté serveur, mais nous n’en étudierons qu’une : celle réalisée avec PHP5 et l’extension XSL.</p>

<p>Pourquoi PHP5 et pas PHP4 ? Simplement parceque PHP5 est fait pour XML : les fonctions DOM y sont incluses dans son cœur, alors qu’avec PHP4, il y avait DOMXML pas performant et buggé et pour XSLT, Sablotron qui était lent et buggé aussi. Il vous faudra avec PHP5 que l’extension XSL soit activée, mais c’est le cas chez la majorité des hébergeurs. En résumé, travaillez avec PHP5, PHP4 est trop brouillon.</p>

<p>Voici un exemple commenté avec PHP5 :</p>

<div class="phpcode">&lt;<![CDATA[?php

// on charge le ﬁchier à transformer après avoir créé l’objet DOMDocument
$datas = new DOMDocument();
$datas->load('datas.xhtml');

// on charge la feuille de style XSLT, document XML, de la même manière
$xstlStylesheet = new DOMDocument();
$xsltStylesheet->load('stylesheet.xsl');



// ensuite on doit créer le processeur XSLT
// c’est cet objet qui va eﬀectuer la transformation
$xsltProc = new XSLTProcessor();

// puis on rattache notre feuille de style à ce processeur XSLT, si bien que toute les transformations faites par ce processeur seront faites avec cette feuille de style
$xsltProc->importStylesheet($xsltStylesheet);

// on peut ensuite faire passer des paramêtres à notre feuille de style
$xsltProc->setParameter('', 'param', 'valeur');


// on doit ensuite envoyer, avant toute chose, le type mime pour que les navigateurs comprennent bien qu’il s’agit de SVG
header('Content-type:image/svg+xml');


// on peut enﬁn envoyer le tout : la méthode transformToXml prend en paramêtre le ﬁchier à transformer et eﬀectuer la transformation selon les règles de la feuille de style qui lui est rattaché
// le résultat est une chaîne de caractère qu’on envoie au navigateur tout de suite grâce à echo
echo $xsltProc->transformToXML($datas);

?>]]></div>

<p>Vous trouverez ici <a href="http://fr3.php.net/manual/fr/ref.xsl.php">la documentation sur l’extension XSL</a>.</p>

<div class="previouspage"><a href="extensibilite.php" title="cours précédent">L’extensibilité</a></div>
<div class="nextpage"><a href="dom.php" title="cours suivant">Le DOM avec Javascript</a></div>


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
