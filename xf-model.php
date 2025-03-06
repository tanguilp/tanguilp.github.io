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
<h2>XForms : modèle</h2>


<ul class="sommaire">
<li><a href="#mvc">Le modèle de MVC</a></li>
<li><a href="#model">L’élément <span class="balise">model</span></a></li>
<li><a href="#instance">L’élément <span class="balise">instance</span></a></li>
<li><a href="#remotefile">Préchargement de document</a></li>
</ul>

<h3 id="mvc">Le modèle de MVC</h3>

<p>Dans l’architecture MVC, le M signifie modèle, et ce modèle correspond en fait aux données de l’application. Dans le cadre de XForms, et donc des formulaires Web, ces données sont les valeurs récupérées suite au remplissage du formulaire.</p>

<p>Contrairement aux formulaires HTML, ce modèle n’est lié en aucune manière à l’interface utilisateur. Même sans interface utilisateur, on pourrait manipuler le modèle et savoir quelles sont les données demandées. C’est faisable à la main ou, plus interessant, par des programmes informatiques. En effet, les formulaires XForms sont censés pouvoir fonctionner dans toutes les situations et dans le cas où il n’y a pas d’écran disponible par exemple (si le formulaire est lu à haute voix), le modèle permet quand même de déterminer quelles sont les données demandées.</p>

<p>Le modèle comporte plusieurs parties : les données demandés, le type de ces données et les relations entre elles. Nous verrons ces deux dernières caractéristiques dans d’autres chapitres. Intéressons nous pour le moment à la base de formulaires XForms : la manière dont les données sont structurées.</p>

<h3 id="model">L’élément <span class="balise">model</span></h3>

<p>XForms dépend d’un langage hôte, c’est à dire qu’il ne fonctionne pas tout seul, on doit l’inclure dans un autre langage. Les deux langages de prédilections pour XForms sont XHTML et SVG.</p>

<p>Comme un modèle n’est pas destiné à être affiché (seule la vue de MVC l’est), on l’inclut en générale dans la partie destinée aux définitions du langage hôte. Avec XHTML, il s’agit de l’élément <span class="balise">head</span> et avec SVG, l’élément <span class="balise">defs</span>. Bien sûr il ne s’agit pas d’une obligation puisque de toute façon le modèle ne sera jamais affiché, mais le mieux est de respecter cette logique.</p>

<p>XForms étant un langage différent de XHTML ou de SVG, il n’a pas le même <a href="tutorial-xml.php#namespace">espace de nom</a>. L’espace de nom de XForms est : <code>http://www.w3.org/2002/xforms</code> (vous trouverez sur ce site <a href="namespaces">une liste des espaces de nom</a>).</p>

<p>Voici comment on déclare un modèle dans du XHTML :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<xf:model id="monModèle">

		</xf:model>
	</head>
	<body>
		<!-- reste du document -->
	</body>
</html>]]></div>

<p>On déclare l’espace de nom de XForms à la deuxième ligne, associé au préfixe <span class="balise attribute">xf</span>. On peut bien sûr choisir un autre préfixe, celui-ci est seulement le plus utilisé.</p>

<p>Vous voyez qu’on donne aussi un identifiant à notre modèle. La raison est simple : on peut avoir plusieurs modèles correspondant à plusieurs formulaires et cet identifiant est très utile pour sélectionner le bon modèle. Voici un exemple où on utilise plusieurs modèles dans un document SVG :</p>

<div class="xmlcode"><![CDATA[<svg width="400px" height="300px" xml:lang="fr"
	xmlns="http://www.w3.org/2000/svg"
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:xf="http://www.w3.org/2002/xforms">

	<defs>
		<xf:model id="login">
			<!-- modèle servant pour un système de login -->
		</xf:model>

		<xf:model id="recherche">
			<!-- modèle servant pour un module de recherche par exemple -->
		</xf:model>
	</defs>

	<rect x="12" y="123" width="100" height="100"/>
</svg>]]></div>

<p>Ainsi on peut séparer la page en plusieurs formulaires, chaque modèle ayant son propre modèle de données et ses propres relations entre elles.</p>

<p>Nous verrons plus tard comment on indique quel modèle utilisé. Sachez juste que par défaut, quand rien n’est indiqué, c’est le premier déclaré.</p>

<p>Dans le cas où on n’a qu’un modèle, on peut oublier l’identifiant puisqu’il n’y a pas d’ambiguité possible.</p>

<h3 id="instance">L’élément <span class="balise">instance</span></h3>

<p>Rentrons dans le vif du sujet. Les données de notre modèle sont contenus dans l’élément <span class="balise">instance</span> d’un modèle. Que contient l’élément <span class="balise">instance</span> ? Il contient un document XML qui est notre modèle : chaque élément et chaque attribut peut contenir des données.</p>

<p>La plupart du temps ce modèle est du XML sans espace de nom. Par exemple quelque chose du genre :</p>

<div class="xmlcode"><![CDATA[<inscription>
	<nom/>
	<prenom/>
	<sexe/>
	<adresse>
		<voie/>
		<ville codepostal=""/>
		<pays/>
	</adresse>
	<datenaissance/>
</inscription>]]></div>

<p>Le document peu avoir une complexité aussi grande que vous voulez. Il n’y a pas de limite de niveau d’imbrication, de nombre d’attribut, etc. Vous êtes totalement libre de choisir la manière dont vos données sont organisés.</p>

<p>Dans un document XHTML, cela donne :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<xf:model>
			<xf:instance>
				<inscription xmlns="">
					<nom/>
					<prenom/>
					<sexe/>
					<adresse>
						<voie/>
						<ville codepostal=""/>
						<pays/>
					</adresse>
					<datenaissance/>
				</inscription>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<!-- reste du document -->
	</body>
</html>]]></div>

<p>Et voilà, votre modèle est (presque) prêt ! Basiquement, tous vos modèles auront cette forme.</p>

<p>Par contre, je vois que quelquechose vous tracasse. Qu’est ce que <span class="attribute">xmlns=""</span> vient faire ici ? Cet attribut sert, comme vous le savez, à indiquer l’espace de nom d’éléments XML. Or, la plupart du temps, on désire des documents XML "bruts", sans espace de nom. C’est à cela que sert cet attribut.</p>

<p>D’ailleurs, si vous avez bien suivi le tutoriel XML, sans <span class="attribute">xmlns=""</span>, l’espace de nom du XML de l’instance est dans l’espace de nom de XHTML. Or il n’existe pas de tels éléments en XHTML… Sans être un bug, cela n’est pas logique, et les données soumises auraient alors le même espace de nom, avec la déclaration qui va avec.</p>

<p>On peut bien sûr utiliser des espaces de nom non nuls. Voici un exemple :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<xf:model>
			<xf:instance>
				<svg width="400px" height="300px" xml:lang="fr"
					xmlns="http://www.w3.org/2000/svg">

					<rect x="12" y="123" width="100" height="100"/>
				</svg>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<!-- reste du document -->
	</body>
</html>]]></div>

<p>Dans ce cas, l’instance est au format SVG, et l’espace de est celui de ce langage. Aucun dessin ne sera affiché (le modèle ne s’affiche jamais) mais on manipulera bien un document SVG et on pourra par exemple, grâce à un contrôle, modifier la valeur de l’attribut <span class="attribute">width</span>, avant d’envoyer le dessin au serveur.</p>

<p>Un dernier petit détail : comme pour les modèles, il peut y avoir plusieurs instances qui correspondent à différentes sources de données. De la même manière que pour l’élément <span class="balise">model</span>, on identifie ces différentes instances avec un identifiant (attribut <span class="attribute">id</span>). Nous verrons plus tard comment sélectionner la bonne instance.</p>

<h3 id="remotefile">Préchargement de document</h3>

<p>La première fonctionnalité sympa de XForms est la possibilité d’indiquer une source pour l’instance, plutôt que de l’écrire directement dans le document. Ainsi, si on appelle ce document <code>inscription.xml</code> :</p>

<div class="xmlcode"><![CDATA[<inscription>
	<nom/>
	<prenom/>
	<sexe/>
	<adresse>
		<voie/>
		<ville codepostal=""/>
		<pays/>
	</adresse>
	<datenaissance/>
</inscription>]]></div>

<p>On peut indiquer au processeur XForms d’aller chercher les données de telle instance dans ce fichier grâce à l’attribut <span class="attribute">src</span> sur un élément <span class="balise">instance</span> :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<xf:model>
			<xf:instance src="inscription.xml"/>
		</xf:model>
	</head>
	<body>
		<!-- reste du document -->
	</body>
</html>]]></div>

<p>Le résultat est le même que si on avait copié le contenu du fichier entre les deux balises de l’élément <span class="balise">instance</span>.</p>

<p>C’est très utile quand on doit charger la même instance dans plusieurs formlaires, par exemple la liste de <a href="http://svground.free.fr/xforms/iso_3166-1_list_fr.xml">pays ISO</a> (qu’on peut trouver sur leur <a href="http://www.iso.org/iso/country_codes/iso_3166_code_lists.htm">site</a>). Un autre cas peut être de préremplir un formulaire lorsqu’un utilisateur est en cours de session un langage dynamique côté serveur comme PHP. Exemples :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<xf:model>
			<xf:instance id="listePays"
				src="http://svground.free.fr/xforms/iso_3166-1_list_fr.xml"/>
			<!-- très utile par la suite pour faire une liste
				de sélection de pays -->

			<xf:instance id="formulairePrérempli"
				src="formPrérempli.php"/>
			<!-- on peut utiliser les valeurs de la variable
				globale $_SESSION pour préremplir un
				formulaire avec PHP, dans le cas
				ou l’utilisateur est loggé -->
		</xf:model>
	</head>
	<body>
		<!-- reste du document -->
	</body>
</html>]]></div>

<p>Ainsi on a plusieurs instance prêtes à être affichées et modifiées par des éléments de contrôle… dont le prochain chapitre fait le tour !</p>

<div class="previouspage"><a href="xf-intro.php" title="cours précédent">XForms : introduction</a></div>
<div class="nextpage"><a href="xf-controles.php" title="cours suivant">Contrôles</a></div>

</div>

<!--
<span class="attribute"></span>
<span class="balise"></span>


<div class="xmlcode"><![CDATA[
]]></div>

<div class="csscode"><![CDATA[]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="images/cours/filtres/"></object>
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
