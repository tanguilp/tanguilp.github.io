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
<h2>Du SVG dans du XHTML, extensibilité</h2>


<p>Dans ce chapitre un peu différent des autres, nous allons parler d’extensibilité. Qu’est-ce donc ? Il s’agit de l’art d’inclure du SVG dans un autre langage, et inversement d’inclure des langages dans SVG.</p>

<ul class="sommaire">
<li><a href="#inxhtml">Inclure du SVG directement dans du XHTML</a></li>
<li><a href="#object">Afficher du SVG dans du XHTML</a></li>
<li><a href="#insvg">Inclure des langages XML dans du SVG</a></li>
</ul>

<h3 id="inxhtml">Inclure du SVG dans du XHTML</h3>

<h4>Les bases</h4>

<p>Inclure du SVG dans du XHTML… est d’une simplicité étonnante ! Pour cela on doit utiliser les namespaces, ou espaces de nom. Si vous ne savez pas de quoi je parle, vous devrirez lire ce <a href="http://www.siteduzero.com/tutoriel-3-33440-le-point-sur-xml.html">ce cours sur XML</a> et plus particulièrement la partie <a href="http://www.siteduzero.com/tutoriel-3-33440-le-point-sur-xml.html#ss_part_5">traitant des namespaces</a>. Vous y êtes ?</p>

<p>Mais avant de continuer, il est important de comprendre que le SVG ne peut être inclut que dans du XHTML, pas dans du HTML. En effet, les namespaces sont propres à XML (il n’existe pas de tel mécanisme pour HTML). XHTML, tout comme SVG, est un langage construit à partir de XML et s’il impose une certaine rigueur, c’est pour le bien de tous. Ainsi, vous devriez envoyer vos pages XHTML avec le type-mime adéquat (application/xml+xhtml) au moins au navigateur le supportant. Mais ceci est un autre débat. En tout cas, si vous travaillez avec du SVG, utilisez exclusivement XHTML et veillez à avoir des documents bien formés. Ainsi, vous n’aurez pas de problèmne de traitement avec les différents parseurs, le Web sera content et <a href="http://fr.wikipedia.org/wiki/Tim_Berners-Lee">Tim Berners-Lee</a> vous en sera reconnaissant. Si on pouvait éviter que SVG devienne un bordel ingérable comme le HTML, ça serait cool <object type="image/gif" data="images/smileys/yes.gif">:)</object></p>

<p>Assez de blabla, voici comment on fait :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Inclusion de SVG dans du XHTML</title>
</head>
<body>

<h1>Du SVG dans du XHTML</h1>


<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	version="1.1" width="400px" height="300px">

<defs>

<linearGradient id="deg" x1="0" y1="0" x2="1" y2="1">
	<stop offset="0%" style="stop-color:skyblue;stop-opacity:0"/>
	<stop offset="100%" style="stop-color:skyblue;stop-opacity:0.8"/>
</linearGradient>

</defs>

<rect x="10" width="380" y="10" height="280" style="fill:url(#deg)"/>

<text x="30" y="30"
	style="font-weight:bold;font-size:30px"
	dy="0 8 16 24 32 25 25 0 80">
Texte en
<tspan style="font-size:100px" rotate="-10 -2 15">SVG</tspan>
</text>

</svg>

</body>
</html>]]></div>


<p>Et voici le résultat : <a href="exemples/cours/extensibilite/svg-in-xhtml.xhtml">du SVG dans du XHTML</a>.</p>

<p>Notez qu’on a déclaré le namaspace de SVG sur l’élément SVG lui même, ce qui évite de s’embêter avec des préfixes. On déclare aussi le namespace de XLink, au cas où on voudrait s’en servir pour faire des liens. Enfin, on oublie pas d’indiquer la version de SVG qu’on utilise.</p>

<p>Je sais pas pour vous mais moi, j’adore <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object>.</p>




<h4>Une feuille de style pour tous les dialectes XML</h4>

<p>Depuis quasiment le début, j’utilise des feuilles de style CSS pour styler les dessins SVG de ce cours et comme vous pouvez le voir, je ne l’ai pas fait pour l’exemple précédent. En effet, on ne peux pas placer une instruction appelant une feuille de style au beau milieu de la page, et de toute façon il y a ici ambiguité sur le langage auquel doit être appliquée la feuille de style, puisqu’il y en a deux.</p>

<p>Heureusement, il est tout à fait possible d’utiliser les namespaces dans les feuilles de style. Ainsi, on peut faire une feuille de contenant les styles pour le XHTML <strong>et</strong> pour SVG, et c’est ce que nous allons faire.</p>

<p>Dans la feuille de style CSS, on va commencer par déclarer chaque langage par :<br/>
<span class="csspropertie">@namespace préfixe url(chaîne du namespace);</span></p>

<p>Ensuite, il suffit de précéder chaque nom d’élément de <span class="csspropertie">préfixe|</span>.</p>

<div class="csscode"><![CDATA[/* importation des namespaces */

@namespace svg url(http://www.w3.org/2000/svg);
@namespace xhtml url(http://www.w3.org/1999/xhtml);

/* ~~~~~~~~~~~~~~~~~~~~ xhtml ~~~~~~~~~~~~~~~~~~~~ */

xhtml|*{
	margin:0;
	padding:3%;
}

xhtml|h1{
	border-bottom:double medium lawngreen;
	}

/* ~~~~~~~~~~~~~~~~~~~~  svg  ~~~~~~~~~~~~~~~~~~~~ */

svg|stop#stop1{
	stop-color:skyblue;
	stop-opacity:0;
	}

svg|stop#stop2{
	stop-color:skyblue;
	stop-opacity:0.8;
	}

svg|text{
	font-weight:bold;
	font-size:30px;
	}



svg|tspan{
	font-size:100px;
	}]]></div>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="svg-in-xhtml-with-css.css" title="Feuille de style par défaut" alternate="no"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="svg-in-xhtml-with-css2.css" title="Feuille de style alternative" alternate="yes"?>

<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Inclusion de SVG dans du XHTML</title>
</head>
<body>

<h1>Du SVG dans du XHTML</h1>


<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	version="1.1" width="400px" height="300px">

<defs>

<linearGradient id="deg" x1="0" y1="0" x2="1" y2="1">
	<stop id="stop1" offset="0%"/>
	<stop id="stop2" offset="100%"/>
</linearGradient>

</defs>

<rect x="10" width="380" y="10" height="280" style="fill:url(#deg)"/>

<text x="30" y="30"
	dy="0 8 16 24 32 25 25 0 80">
Texte en
<tspan rotate="-10 -2 15">SVG</tspan>
</text>

</svg>

</body>
</html>]]></div>

<p>Évidemment, ça fonctionne pour d’autre langage XML comme MathML, XForms, XUL, etc.</p>

<p>Et voici <a href="exemples/cours/extensibilite/svg-in-xhtml-with-css.xhtml">le résultat</a> avec en prime une petite surprise. Il y a deux styles disponibles (regardez en tout début de fichier XHTML). (pour le changer sous Firefox, Affichage -> Style de la page -> Feuille de style alternative ; sous Opera : View -> Style -> Feuille de style alternative).</p>

<p>Si vous ne connaissez pas bien le mécanisme des feuilles de style, consultez <a href="http://www.blog-and-blues.org/weblog/2005/08/04/437-feuilles-de-styles-permanentes-alternatives-et-preferees-en-xhtml">cet arcticle</a>.</p>

<h3 id="object">Afficher du SVG dans du XHTML</h3>

<p>Parfois, on n’a pas envie de se compliquer la vie avec une inclusion directe du SVG dans le code XHTML. On peut alors utiliser la méthode classique, celle utilisée sur ce site. Le principe est le même que l’inclusion d’images dans XHTML, à ceci près qu’on utilise pas le même élément.</p>

<p>Pour faire cela proprement, on utilise l’élément <span class="balise">object</span> de XHTML. Je vous <strong>interdit formellement</strong> d’utiliser <span class="balise">img</span> ou <span class="balise">embed</span> : <span class="balise">img</span> c’est pour les images « raster » (comme JPEG, PNG, Bitmap, bref non vectorielles) et <span class="balise">embed</span> n’a jamais été normalisé. Je n’ose même pas imaginer que vous voudriez utiliser une de ces affreuse <span class="balise">iframe</span>, n’est ce pas ? <object type="image/gif" data="images/smileys/whistling.gif">:-°</object></p>

<p>On doit renseigner deux attributs de <span class="balise">object</span> : <span class="attribute">data</span> qui donne le chemin vers le fichier SVG, et <span class="attribute">type</span> qui vaudra toujours dans notre cas <span class="attribute">image/svg+xml</span>. Entre les deux balises, vous pouvez indiquer un contenu alternatif qui sera affiché si le navigateur qui télécharge la page ne supporte pas SVG, ce qui joue un peu le même rôle que l’attribut <span class="attribute">alt</span> de l’élément <span class="balise">img</span> de XHTML</p>

<p>Si vous utilisez intelligemment les attributs permettant de contrôler le ratio, vous pouvez avoir un dessin SVG qui va s’adapter automatiquement à la taille de votre <span class="balise">object</span>.</p>

<div class="xmlcode"><![CDATA[<object type="image/svg+xml" data="image.svg">Mon bô dessin</object>]]></div>

<h3 id="insvg">Inclure des langages XML dans du SVG</h3>

<p>Inversement, on peut souhaiter inclure différents langages XML dans du SVG : XHTML, MathML, XForms, XUL, etc. Encore une fois, ce n’est pas compliqué.</p>

<p>On utilise l’élément <span class="balise">foreignObject</span> qui décrit un rectangle dans lequel sera dessiné ce qui est inclus. Ce rectangle est déterminé par les quatre attributs <span class="attribute">x</span>, <span class="attribute">y</span>, <span class="attribute">width</span> et <span class="attribute">height</span>.</p>

<p>Dans ce <span class="balise">foreignObject</span> on écrit le langage XML de son choix avec le bon namespace.</p>

<p>Mais il faut aussi penser au cas où le navigateur ne connaît pas le langage cible. C’est pourquoi on utilisera toujours un <span class="balise">switch</span> qui aura comme premier enfant le <span class="balise">foreignObject</span> et ensuite une solution de rechange (un message d’erreur par exemple).</p>

<p>Notez enfin que <span class="balise">foreignObject</span> peut être stylisé et transformé comme les autres éléments de dessin SVG.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="foreignObject.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>L’élément foreignObject</title>

<defs>

<linearGradient id="deg" x1="0" y1="0" x2="1" y2="1">
	<stop id="stop1" offset="20%"/>
	<stop id="stop2" offset="100%"/>
</linearGradient>

</defs>

<rect x="10" y="10" width="380" height="280"/>

<switch>
	<foreignObject x="20" y="90" width="150" height="200" transform="rotate(-5)">
	<body xmlns="http://www.w3.org/1999/xhtml">
	<p>Pour faire des crêpes il faut :</p>
	<ul>
	        <li>de la farine</li>
	        <li>du sucre</li>
	        <li>des œufs</li>
	        <li>du lait</li>
	        <li>et du beurre, <strong>beaucoup</strong> de beurre !</li>
	</ul>
	</body>
	</foreignObject>

	<text x="20" y="20">Votre viewer SVG ne supporte pas XHTML.</text>
</switch>

<switch>
	<foreignObject x="190" y="50" width="190" height="60">
	<body xmlns="http://www.w3.org/1999/xhtml">
	<p>Voici la formule mathématique des crêpes :</p>
	</body>
	</foreignObject>

	<text x="20" y="20">Votre viewer SVG ne supporte pas XHTML.</text>
</switch>

<switch>
	<foreignObject x="190" y="100" width="190" height="150">
	<math:math xmlns:math="http://www.w3.org/1998/Math/MathML">
	<math:mstyle displaystyle="true">
	<math:mrow>
	<math:msubsup>
		<math:mo>∫</math:mo>
		<math:mi>a</math:mi>
		<math:mi>b</math:mi>
		</math:msubsup>
		</math:mrow>
		<math:mrow>
		<math:mi>f</math:mi>
		<math:mrow>
		<math:mo>(</math:mo>
		<math:mi>x</math:mi>
		<math:mo>)</math:mo>
		</math:mrow>
		</math:mrow>
		<math:mrow>
		<math:mi>d</math:mi>
		<math:mi>x</math:mi>
		</math:mrow>
		<math:mo>=</math:mo>
		<math:munder>
		<math:mi>lim</math:mi>
		<math:mrow>
		<math:mi>n</math:mi>
		<math:mo>→</math:mo>
		<math:mo>∞</math:mo>
		</math:mrow>
		</math:munder>
		<math:mrow>
		<math:munderover>
		<math:mo>∑</math:mo>
		<math:mrow>
		<math:mi>i</math:mi>
		<math:mo>=</math:mo>
		<math:mn>1</math:mn>
		</math:mrow>
		<math:mi>n</math:mi>
		</math:munderover>
		</math:mrow>
		<math:mrow>
		<math:mi>f</math:mi>
		<math:mrow>
		<math:mo>(</math:mo>
		<math:mrow>
		<math:msubsup>
		<math:mi>x</math:mi>
		<math:mi>i</math:mi>
		<math:mrow>
		<math:mo>⋆</math:mo>
		</math:mrow>
		</math:msubsup>
		</math:mrow>
		<math:mo>)</math:mo>
		</math:mrow>
		</math:mrow>
		<math:mo>Δ</math:mo>
		<math:mi>x</math:mi>
		</math:mstyle>
		</math:math>
	</foreignObject>

	<text x="20" y="20">Votre viewer SVG ne supporte pas MathML.</text>
</switch>

<switch>
	<foreignObject x="50" y="220" width="250" height="50">
	<vbox xmlns="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
		<progressmeter mode="undetermined"/>

		<label value="Crêpe en cours de cuisson…"/>
	</vbox>
	</foreignObject>

	<text x="20" y="20">Votre viewer SVG ne supporte pas XUL.</text>
</switch>

<ellipse cx="285" cy="120" rx="110" ry="30"/>


</svg>]]></div>

<div class="csscode"><![CDATA[/* css file generated by Tangui’s brain >> Skedar.Dark@laposte.net */

/* importation des namespaces */

@namespace svg url(http://www.w3.org/2000/svg);
@namespace xhtml url(http://www.w3.org/1999/xhtml);
@namespace mathml url(http://www.w3.org/1998/Math/MathML);
@namespace xul url(http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul);

/* ~~~~~~~~~~~~~~~~~~~~ xhtml ~~~~~~~~~~~~~~~~~~~~ */

xhtml|*{
	font-size:x-small;
	}

xhtml|ul{
	padding-left:10px;
	}


/* ~~~~~~~~~~~~~~~~~~~~  svg  ~~~~~~~~~~~~~~~~~~~~ */

svg|stop#stop1{
	stop-color:skyblue;
	stop-opacity:0;
	}

svg|stop#stop2{
	stop-color:skyblue;
	stop-opacity:0.8;
	}

svg|rect{
	fill:url(foreignObject.svg#deg);
	}

svg|ellipse{
	fill:none;
	stroke:yellowgreen;
	stroke-width:2px;
	stroke-dasharray:10,10;
	}

/* ~~~~~~~~~~~~~~~~~~~  mathml  ~~~~~~~~~~~~~~~~~~ */

mathml|*{
	font-size:x-small;
	}

/* ~~~~~~~~~~~~~~~~~~~  xul  ~~~~~~~~~~~~~~~~~~ */

xul|*{
	font-size:x-small;
	}]]></div>

<p>Voici le résultat : <a href="images/cours/extensibilite/foreignObject.svg">un document SVG incorporant du XHTML, du MathML et du XUL</a>.</p>

<p>Notons que cela ne fonctionne pas sous Opera. Cela est dû au fait que la spécification est floue quant à l’incorporation de dialectes étrangers et du coup, c’est implémenté un peu différemment selon le moteur de rendu. Ça devrait être réglé avec SVG1.2. Vous devrez chercher un peu si vous voulez faire fonctionner cet exemple sous Opera. La partie en XUL, quant à elle, ne fonctionnera que dans Firefox et les navigateurs basés sur Gecko.</p>

<p>Remarquez la rotation effectuée sur les ingrédients. On peux aussi appliquer des filtres, des masques, etc.</p>

<p class="rappel">MathML <strong>n’est pas fait</strong> pour être écrit à la main, il est fait pour être généré. Donc le prochain qui vient me dire que MathML c’est trop compliqué et qu’il faut faire quelque chose de plus simple, je l’étripe !</p>

<p>Si quelqu’un parvient à inclure XForms, qu’il n’hésite pas à me contacter. Je n’y arrive pas.</p>

<p>Pour finir parlons un peu de sémantique. Dans l’idéal, chaque langage devrait être utilisé pour ce qu’il sait faire. Ainsi, SVG est génial pour le dessin. Pour les mathématiques, c’est MathML. Pour du texte sur le Web : XHTML. Pour les formulaires nouvelle génération : XForms. Et ainsi de suite. Or, on a tendance à utiliser certains langages (ou formats) dans des contextes qui ne sont pas adaptés pour des raisons stupides : c’est beau, c’est plus simple, etc. Et on finit par être piégé par des formats pourris. Ainsi, aucun PDF n’aurait dû se retrouver sur le Web : c’est un format d’impression ! Idem pour Flash qui est une abomination. Cela contribue à dénaturer le Web, à en réduire son accessibilité (daltoniens, personne ayant du faible débit, des petits écrans, …) et son potentiel. Un travail de standardisation est toujours lent mais si vous avez suivit ce cours jusque là, cela signifie que vous croyez en SVG comme standard permettant au Web de grandes possibilités.</p>

<p>Néanmoins, n’oubliez pas que SVG est un format de dessin vectoriel. En conséquence, il <strong>n’est pas</strong> au texte. C’est pourquoi on ne devrait inclure du texte dans du SVG que lorsqu’il fait partie du dessin. Lorsqu’il s’agit du contenu, il est impératif de repasser par le langage fait pour du contenu textuel pour le Web : XHTML. Si vous ne savez pas trop ou se situe la limite, faites ce test : le contenu de votre site Web devrait être totalement accessible même si SVG est désactivé. Encore une fois, le Web vous dira merci !</p>

<p>Ce chapitre est terminé. J’espère que les possibilités de mélange de dialectes XML vous a donné envie d’en savoir plus sur ceux-ci. Les prochains chapitres sont des chapitres bonus. Mais vous en savez déjà beaucoup sur SVG. <object type="image/gif" data="images/smileys/yes.gif">:)</object></p>


<div class="previouspage"><a href="creer-sa-police.php" title="cours précédent">Créer sa police de caractère</a></div>
<div class="nextpage"><a href="xslt-pour-svg.php" title="cours suivant">XSLT pour SVG</a></div>

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
