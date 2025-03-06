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
<h2>XForms : introduction</h2>


<ul class="sommaire">
<li><a href="#oldforms">Les formulaires HTML</a></li>
<li><a href="#xforms">XForms : la nouvelle génération de formulaires Web</a></li>
<li><a href="#implémentation">Les implémentations</a></li>
<li><a href="#xrx">XForms et l’architecture XRX</a></li>
</ul>

<h3 id="oldforms">Les formulaires HTML</h3>

<p>L’arrivé du langage HTML au début des années 90 à avant tout permis au commun des mortels de réaliser des requêtes http de type GET grâce à l’élément fondamental du langage : le lien hypertexte <span class="balise">a</span>. C’est ainsi que le Web devint hypertexte et qu’on put naviguer entre les documents en écrivant juste : <span class="balise sanslt">&lt;a href="http://monsite.org"&gt;Mon site&lt;/a&gt;</span>.</p>

<p>Les formulaires HTML furent une autre évolution qui permettaient aux sites de devenir dynamiques. Vous les utilisez tous les jours, ils sont omniprésent sur internet et sont adaptés aux cas simples. Le principe de fonctionnement est le suivant : un ensemble d’élément sont disponibles qui vont afficher un contrôle (entrée de texte, bouton, case à cocher, etc) et qui portera en même temps la valeur entrée par l’utilisateur (par exemple l’attribut <span class="attribute">value</span> d’un élément <span class="balise">input</span>). Lorsqu’on clique sur l’élément de soumission, les données sont envoyées (le plus souvent par un requête HTTP POST) et une nouvelle page (celle renvoyée) apparaît. C’est le fonctionnement basique des formulaires HTML. Et vous le verrez, c’est très limité comparé à XForms.</p>

<p>Puis vint ce qu’on appelle le « Web 2.0 ». Derrière cet argument marketing complètement bidon se cache l’utilisation devenue intensive d’un objet javascript, <span class="js">XMLHttpRequest</span>, qui permet de réaliser des requêtes HTTP en javascript, le but étant d’envoyer et de recevoir ses données pour mettre à jour un morceau seulement de la page, donc sans la recharger et aussi sans bloquer la page. Et depuis que certaines personnes ont découvert cet antique objet javascript, le Web est devenu 2.0, social, user-centric et mieux encore. Bien que fondamentalement il n’a en rien changé.</p>

<p>Ce qui est important, c’est que cette technique de programmation est devenue massivement utilisée et a changé la vie des programmeurs… en moins bien ! En effet, toutes ces requêtes Ajax conduisent à un code sale et difficilement maintenable, sans parler des incompatibilités entre navigateurs. Et puis en fin de compte, faire de l’Ajax c’est faire le travail du navigateur à la main. Songez à la simplicité du lien <span class="balise">a</span> et de son attribut <span class="attribute">href</span> comparée aux dizaines de lignes javascript nécessaires pour faire une requête HTTP : il s’agit d’une véritable régression !</p>


<h3 id="xforms">XForms : la nouvelle génération de formulaires Web</h3>

<p>XForms a été conçus pour pallier à tous ces défauts. Il rend l’utilisation de Javascript et d’Ajax <strong>obsolètes</strong>. Oui, vous avez bien lu : plus besoin ni de Javascript ni d’Ajax avec XForms. XForms sait faire tout ça et bien plus.</p>

<p>Plus précisément, XForms est un langage de balisage XML, comme XHTML et SVG. C’est un langage déclaratif, exactement comme SMIL que nous avons vu dans les animations déclaratives SVG. XForms permet de décrire des relations entre les données. Le formulaire réagit selon ces diverses relations et les actions de l’utilisateur. Il n’y a quasiment jamais besoin de recourir à Javascript (qui est un langage impératif).</p>

<p>De plus, XForms a une architecture <a href="http://fr.wikipedia.org/wiki/Modèle-Vue-Contrôleur">MVC</a> pour Modèle-Vue-Contrôleur. Dans cette architecture, les données (modèle) sont séparés de l’interface utilisateur (vue). Les interactions entre les deux se font par les contrôleurs qui mettent à jour le modèle ou l’interface utilisateur selon les différents évènements. Par exemple, imaginons un formulaire qui demande des informations personnelles. Lorsqu’on sélectionne "sexe masculin" (vue) les données sont modifiées (modèle) et les différentes contraintes (controlleur) vont faire que l’interface utilisateur (vue) ne demande plus le nom de jeune fille.</p>

<p>Il y a un tas de fonctionnalités très utiles dans XForms :</p>

<ul class="list-attributes">
<li>style déclaratif plus propre ;</li>
<li>évite 99% des scripts là où il y en avait besoin ;</li>
<li>données au format XML, possibilité de l’envoyer au serveur dans ce format ;</li>
<li>validation côté client. Il devient possible d’utiliser le même schéma XML pour valider les données côté client et côté serveur ;</li>
<li>typage des données évolué (restrictions sur les dates, les nombres, les caractères via des expressions régulières) ;</li>
<li>utilisation de CSS pour styler les formulaires ;</li>
<li>s’appuie sur XPath, langage d’adressage simple, standard et déjà largement utilisé (XPointer, XSLT, XQuery) ;</li>
<li>nouveaux éléments de contrôle (date, commande d’étendue, sortie) ;</li>
<li>possibilités de ne pas recharger la page après validation. Cela permet par exemple de mettre à jour une partie du formulaire par rapport à des données entrée par l’utilisateur. De l’Ajax en beaucoup plus simple ;</li>
<li>possibilité de définir un élément comme requis, non pertinent ou en lecture seule, selon les données du modèle ;</li>
<li>structures de répétition, d’insertion, de supression dans un ensemble de nœuds ;</li>
<li>contrôle fin des évènements ;</li>
<li>permet de faire des calculs via des expressions XPath ;</li>
<li>et plus encore.</li>
</ul>

<p>XForms est donc une solution aux difficultés du développement Web tel qu’il est réalisé actuellement, et qui conduit parfois aux absurdités que sont l’utilisation de Flex ou de Silverlight qui ne simplifient les choses qu’à première vue !</p>

<p>Il existe néanmoins des critiques à propos de XForms. C’est quasiment toujours la même chose qui revient : XForms est trop compliqué. La première remarque est que c’est la norme XForms qui est complexe, mais le développeur Web ne devrait pas avoir à lire entièrement la norme. C’est le but de ce site.</p>

<p>En réalité, faire la même chose en XForms qu’en Ajax est beaucoup plus simple avec XForms. Dans la plupart des cas, vous serez surpris de l’élégance de vos programmes XForms par rapport aux affreuses lignes de codes que vous pondiez (ou pas) en faisant de l’Ajax.</p>

<p>La principale réticence vient à mon avis du paradygme de programmation. Beaucoup de programmeurs ont toujours préféré la programmation impérative (comme C, C++, Python, Java, Javascript) à la programmation déclarative (comme XSLT, Ocaml) parceque cette dernière est moins naturelle. XForms n’est donc pas si compliqué, c’est juste que la manière de programmer avec ce langage ne nous est pas forcément familière. Mais rassurez vous, l’élégance de la programation déclarative avec XForms vous ferons oublier les difficultés des premiers essais.</p>

<h3 id="implémentation">Les implémentations</h3>

<p>Comme d’habitude, c’est là que le bât blesse. XForms n’est implémenté nativement dans aucun navigateur. Heureusement des grands noms de l’informatique (dont IBM et Novell) ont poussé le développement de XForms et il est possible de les utiliser pour une utilisation en intranet/extranet ou sur internet. Faisons le tour des implémentations disponibles actuellement (été 2009).</p>

<p>L’implémentation que j’utilise et que je vous conseille, même si elle n’est pas parfaite, est l’<a href="https://addons.mozilla.org/fr/firefox/addon/824">extension XForms</a> pour Firefox. Elle implémente une bonne partie de la spécification et est facile à installer. Par contre, elle n’est compatible qu’avec Firefox. Pour la suite de ce cours, je considèrerais que les exemples sont vus avec cette extension (je ne vérifierais pas la compatibilité).</p>

<p>Pour Internet Explorer, le plugin <a href="http://www.formsplayer.com/">formsplayer</a> implémente la totalité de la norme. Là encore, ça n’est compatible qu’avec Internet Explorer.</p>

<p>Il existe des solutions multiplateformes, comme <a href="http://code.google.com/p/ubiquity-xforms/">Ubiquity XForms</a> qui est entièrement écrit en Javascript et fonctionne dans la plupart des navigateurs. C’est un bon compromis dans la mesure où le projet avance rapidement et que de toute façon, il n’y a pas tellement d’autres solutions.</p>

<p>Citons quand même <a href="http://www.agencexml.com/xsltforms">XSLTforms</a> qui transforme à la volée votre balisage XForms grâce a une feuille de style XSLT. Ce programme est utilisable dans les principaux navigateurs, mais l’implémentation n’est pas complète.</p>

<p>Ce n’est pas la panacée. Gardons quand même espoir : SVG paraissait mort il y a encore 5 ans et aujourd’hui, son avenir ne fait plus aucun doute. Espérons qu’il en soit de même pour XForms.</p>

<h3 id="xrx">XForms et l’architecture XRX</h3>

<p>XForms peut être la base d’une architecture de développement Web totalement nouvelle et révolutionnaire : XRX.</p>

<p>Le développement Web traditionnel s’appuie sur des traductions permanentes entre l’interface Web et la base de données. Basiquement, on récupère les données d’une url ou d’un formulaire, on inclut ces données dans une requête SQL avec un langage côté serveur (comme PHP), on lance la requête et on récupère le résultat, que l’on traduit en HTML côté serveur (PHP). J’ai oublié de préciser que les requêtes sont souvent complexes : les tables sont liées entre elles par des clefs étrangères et ils font donc faire des jointures dans tous les sens <em>à chaque requête</em> pour obtenir son résultat. Le concept de bases de données épaisses ne permet que d’améliorer un peu la situation, mais ne règle pas le fond du problème : les modèles relationnels sont limités et ne sont pas adaptés au Web.</p>

<p>Car le Web est en XML. L’architecture XRX permet de s’affranchir de Javascript, PHP et SQL en conservant tout au long du processus les données dans le format XML qui est de nature arborescente et permet donc de mieux représenter les données du monde réel.</p>

<p>XRX est l’acronyme de XForms, Rest, XQuery. Voici comment se décompose cette architecture :</p>

<ul class="list-attributes">
<li>XForms agit côté client et permet de soumettre ses données dans une forme précise en XML ;</li>
<li>une interface Rest est en fait une manière de s’adresser à un service Web par HTTP avec les requêtes GET, POST, PUT et DELETE… ce que XForms sait faire ;</li>
<li>côté serveur, on utilise une base de données XML native qui permet de stocker ses données XML directement et des les interroger ou de les modifier ensuite, grâce au langage XQuery qui est un peu le SQL des bases de données XML. XQuery permet de renvoyer du XML, donc du XHTML ou encore des pages Web. XQuery est fait pour interroger la structure arborescente de XML.</li>
</ul>

<p>Nous tenons là une architecture <strong>sans aucune traduction</strong> entre ses différentes parties ce qui enlève du même coup énormément de compelxité.</p>

<p>Vous trouverez de la documentation sur le Web. Il est possible que vienne un tutorial XRX une fois le tutoriel XForms terminé, mais ce n’est pas sûr.</p>

<!--<div class="previouspage"><a href="creer-sa-police.php" title="cours précédent">Créer sa police de caractère</a></div>-->
<div class="nextpage"><a href="xf-model.php" title="cours suivant">Modèle</a></div>

</div>

<!--
<span class="attribute"></span>
<span class="balise"></span>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textArea.css" charset="utf-8"?>

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
