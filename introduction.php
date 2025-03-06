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
</object>
</h1>

<div id="contenu">
<h2>Introduction</h2>

<ul class="sommaire">
<li><a href="#software">Logiciels requis</a></li>
<li><a href="#svgdef">Qu’est ce que SVG ?</a></li>
<li><a href="#flashsaymalsaylemal">Le cas Flash</a></li>
</ul>

<h3 id="software">Logiciels requis</h3>
<p>Ce site est codé en <acronym title="eXtensible HyperText Markup Language">XHTML</acronym> et envoyé en tant que tel ce qui
signifie que seuls les navigateurs récents peuvent l’afficher. À vrai dire, tous sauf <acronym title="Internet Explorer">IE</acronym>
<object type="image/gif" data="images/smileys/whistling.gif">:-°</object>.<br/>
La situation du spport de SVG dans les navigateurs (fin 2008) s’améliore enfin. Firefox 3 gère presque tout (sauf les animations), les navigateurs basés sur WebKit (Konqueror, Chrome, Safari) ne s’en sortent pas trop mal et Opera a enfin un très bon support (à partir de la version 9.5). Seule ombre au tableau, et elle est de taille : Internet Explorer ne supporte pas du tout SVG (car cela rentre en concurrence avec Silverlight). De plus, il existait un plugin d’Adobe pour Internet Explorer mais celui-ci n’est plus maintenu. Il existe un autre plugin, Renesis, mais de toute façon l’avenir est le support du SVG <em>dans</em> le navigateur, comme vous le comprendrez dans le chapitre sur l’extensibilité.</p>

<p>En résumé, je vous conseille viement d’utiliser <strong>Opera 9.5</strong> (disponible sur toutes les plateformes) pour suivre ce cours. Avec les autres navigateurs, certains exemples ne fonctionneront tout simplement pas. Par exemple, Firefox ne gère pas, pour l’instant, l’animation déclarative. Si tous se passe bien, vous devriez voir ci-dessous les mots « Hello world » changeant en permanence de couleur.</p>


<div class="object-example">
<object type="image/svg+xml" data="images/cours/introduction/ca-marche.svg">
<p>Votre navigateur doit supporter SVG pour pouvoir afficher cet exemple. Si ce n’est pas le cas, demandez de l’aide sur le forum.</p>
</object>
</div>

<p>Si vous voyez bien le texte changeant de couleur, vous êtes prêts à commencer. Sinon, le <a href="forum.php">forum</a> est là
pour ça !</p>

<h3 xml:lang="en" id="svgdef">Scalable Vector Graphics</h3>
<p>Mais au fait, ça veut dire quoi SVG ?</p>
<h4>Scalable</h4>
<p>« Scalable » signifie « adaptable ». Pour SVG, il a deux sens.</p>
<p>Le premier, c’est qu’un document SVG peut être agrandi ou réduit uniformément sans perte de qualité. Pour comprendre en quoi c’est
un avantage, penchons nous sur le cas des graphiques bitmap (formats : bitmap, tiff, jpeg, gif, png, etc.).
Un graphique bitmap est un graphique ou la couleur de <em>chaque</em> pixel est connue et stockée. Diverses méthodes de
compressions existent mais elles sont souvent synonymes de perte de qualité (jpeg) ou de limitations au niveau des couleurs (gif).
Regardez ce qui se passe lorsqu’on essaye d’agrandir une image de type bitmap :</p>
<p class="image">Image d’origine :<br/>
<object type="image/jpeg" data="images/cours/introduction/monkey.jpg">
Votre navigateur ne supporte pas les images jpg
</object>
</p>

<p class="image">Image grossie 4 fois :<br/>
<object type="image/jpeg" data="images/cours/introduction/monkey-resized.jpg">
Votre navigateur ne supporte pas les images jpg
</object>
</p>

<p>Le programme de grossissement ne pouvant pas deviner quels seraient les pixels manquant, il duplique le pixel de départ 4 fois pour
un grossissement de 2, 9 fois pour un grossissement de 3, 64 fois pour un grossissement de 8, etc. Et même s’il existe des technologies
pour atténuer ses effets (anti-aliasing, etc.), la perte de qualité est inévitable.<br/>
Avec les graphiques vectoriels, tel que SVG, ce problème ne se pose pas. Ce qui est décrit n’est pas des points mais des formes. Ainsi,
on peut facilement agrandir ou reduire un graphique : c’est l’ordinateur qui va se charger de recalculer tous les points. Ce format
est particulièrement intéressant lorsqu’on désire imprimer des affiches de très grand format (des affiches publicitaires par exemple).
</p>

<p>Le second sens, c’est que SVG est adaptable sur le Web. En fait, il a été pensé pour pouvoir s’intégrer dans une multitude de
langages et affichable dans une multitude de média. Ainsi, il peut être adapté pour permettre un meilleur accès à des personnes
handicapés, à des téléphones mobiles, à des sorties imprimante haute résolution. Il peut très facilement être réutilisé, que ce soit
un graphique tout entier ou seulement une partie. Grâce à sa syntaxe XML, il peut aisément être traité grâce à
<acronym title="eXtensible Stylesheet Language Transformation">XSLT</acronym> ou d’autres langages de programmation via
<acronym title="Document Object Model">DOM</acronym> ou <acronym title="Simple Api for Xml">SAX</acronym> et inclu dans d’autres
document XML, <acronym title="eXtensible HyperText Markup Language">XHTML</acronym> ou <acronym title="Xml User interface Language">
XUL</acronym>. SVG peut lui même inclure en son sein différents langages XML.</p>

<h4>Vector</h4>
<p>« Vector » signifie bien sur « vectoriel ». SVG, plutôt que de prendre tous les points d’une image comme le ferait une image bitmap
utilisent les différents éléments géométriques, tels que les lignes, les cercles, les rectangles, les polygones, etc. En clair, il
enregistre un cercle en tant que tel et non pas comme un ensemble de points. Heureusement pour nous, SVG connait autre chose qui nous
sera bien utile : les <a href="transformations.php">transformations</a>. On peut aussi appliquer des filtres comme on le fait dans
Photoshop ou The Gimp. Bref, tout un tas d’opérations est réalisable sur un objet SVG.
</p>

<h4>Graphics</h4>
<p>On est là pour faire du dessin, non ?</p>

<h3 id="flashsaymalsaylemal">Le cas Flash</h3>

<p>Apprendre un nouveau langage est un investissement qui demande du temps, et même si SVG est plutôt facile, une question se pose : pourquoi utiliser un standard peu supporté alors que Flash peut faire tout ce que SVG peut faire et qu’il est déployé chez 99% des internautes ?</p>

<p>Pour faire taire une bonne fois pour toute ceux qui, au troisième millénaire, pensent encore ça, je vous propose deux réponses : une courte et une longue.</p>

<h4>La réponse courte</h4>

<p>Regardons ce qui a fait le succès d’Internet. Deux protocoles sont à la base du Web : HTTP et HTML. Ils sont tous les deux ouverts, textes et simples. L’ouverture implique la liberté d’utilisation et la gratuité. Le fait que ces protocoles soient textes (en opposition aux formats binaires) les rendent faciles à débugger, à analyser et à étudier. Enfin, leur simplicité donne l’opportunité à un large public de les utiliser.</p>

<p>SVG est de la même trempe. Il est promu par le W3C et le créateur du HTML, Tim Berners-Lee, en est le promotteur. SVG est un format pensé dans la continuité de ce qui a fait le succès du Web.</p>

<p>Regardons maintenant ce qui a conduit à l’<a href="http://fr.wikipedia.org/wiki/Minitel#Passage_.C3.A0_Internet_des_utilisateurs">échec du Minitel</a> : ce système était fermé, coûteux et complexe. En effet, entrer en tant qu’opérateur dans le réseau Minitel n’était pas à la porté de chacun. C’était un espace réservé à ceux qui pouvaient payer et un opérateur unique avait le monopole.</p>

<p>Je sens que vous devinez le fil de ma pensée : oui, Flash c’est exactement comme le minitel ! C’est fermé : 	Adobe a tous les droits et dirige les développements de Flash comme il le souhaite. Adobe décide qui peut utiliser Flash et qui n’y a pas le droit. C’est coûteux : la suite Adobe Flash CS4 est coûteuse et certainement pas à la portée de tout le monde. Enfin, Flash est binaire et une animation Flash est donc un exécutable binaire envoyé sur HTTP.</p>

<p>Flash est donc à l’opposé de ce qui a fait le succès du Web. C’est une technologie qui ne devrait même pas exister.</p>

<h4>La réponse longue</h4>

<p>Si l’explication précédente ne vous a pas convaincu, sachez qu’il y a des tonnes de raisons de ne pas utiliser Flash. En voici une liste en vrac et non exhaustive.</p>

<ul class="list-attributes">
<li>Flash est binaire, et va donc dans le sens opposé du Web qui est entièrement texte ;</li>
<li>Flash est lent et les terminaux se font de plus en plus multiples (téléphones, Netbooks, etc) : on ne peut donc pas miser sur le dernier processeur surpuissant chez Monsieur-tout-le-monde ;</li>
<li>la lecture de vidéo en Flash demande énormément de puissance processeur, surtout si ces vidéos sont protégés (ce qui ne signifie rien puisque toute protection finit par être cassée) ;</li>
<li>Flash est propriétaire : Adobe décide seul de l’orientation de Flash ;</li>
<li>Le seul plugin fonctionnant bien est fait par Adobe, qui décide donc qui peut utiliser Flash. Les Linuxiens de la première heure ont <strong>tous</strong> une rancœur contre Flash. Flash fonctionne mal ou pas du tout sur certains systèmes fonctionnant sur des processeurs 64 bits. De même, les futurs possesseurs de netbooks basés sur des processeurs ARM feront la même expérience. L’iPhone ne supporte pas Flash, etc., etc. ;</li>
<li>développer en Flash est coûteux. Et à ceux qui disent qu’on peut toujours avoir Flash gratuitement par des moyens illégaux, je réponds qu’il est impensable qu’on doive pirater un logiciel pour pouvoir éditer du contenu sur le Web. Encore heureux ! ;</li>
<li>Flash pose des problèmes de sécurité : seul Adobe est en mesure de décider de corriger ou non une faille de son plugin. C’est de plus incompatible avec les politiques de sécurité du logiciel libre ;</li>
<li>Flash est obscur aux outils de recherche. Le référencement n’est plus automatique et devient difficile ;</li>
<li>on ne peut pas utiliser les boutons de contrôle du navigateur (Précédent, Suivant, etc.) ;</li>
<li>l’url désigne l’animation Flash toute entière, on ne peut pas pointer sur un élément particulier ou une page particulière d’un site Flash. Il devient donc impossible de mettre en favoris une partie précise d’un site Flash ;</li>
<li>pas de copier/coller ;</li>
<li>impossible d’enregistrer une image (ce qui ne sert en rien pour protéger l’image puisqu’il suffit de faire une vulgaire capture d’écran) ;</li>
<li>pas de recherche de texte possible grâce à la recherche du navigateur ;</li>
<li>pas de traduction en ligne possible ;</li>
<li>le menu du clic droit est différent ou inopérant ;</li>
<li>l’impression est catastrophique ;</li>
<li>Flash est incompatible avec les feuilles de style CSS ;</li>
<li>Flash n’utilise pas le cache, l’animation est rechargée à chaque fois dans son intégralité. C’est donc plus lent et plus coûteux en bande passante ;</li>
<li>les liens ne suivent pas les conventions de couleur pour les sites visités ;</li>
<li>les barres de navigation (scroll) ne sont pas celles du navigateur et déstabilisent le visiteur ;</li>
<li>il est impossible de redimensionner le texte via les mécanismes habituels du navigateurs ;</li>
<li>les outils d’accessibilité sont inopérants (contraste, taille du texte, lecture du texte, zoom) ;</li>
<li>il n’y a pas de présentation progressive pendant le chargement comme avec XHTML/CSS ;</li>
<li>pas de statistiques fiables puisque l’animation Flash est vue comme un seul objet et non comme un ensemble de pages.</li>
</ul>

<p>En résumé, Flash casse complètement l’interface utilisateur par défaut du système d’exploitation et du navigateur. Du coup, il faut s’adapter à chaque site Flash et c’est frustrant. Je suis sûr que vous avez déjà pesté contre un site Flash mal conçu. En réalité, faire un site bien conçu avec Flash est un exploit. D’ailleurs, je n’ai rien vu de tel.</p>

<p>Le dernier problème est toute cette génération de graphistes auto-proclamés qui n’ont pas compris qu’on ne peut pas faire du Web au pixel près et qui aiment à exposer leurs talents artistiques au <strong>mmmmooooooonnnnndddddddeeeeeee</strong> entier . Sans se rendre compte, qu’en fait, ils nous ennuient puisque c’est le contenu d’un site et non sa forme qui fait sa richesse.</p>

<div class="previouspage"><a href="main.php" title="cours précédent">Accueil</a></div>
<div class="nextpage"><a href="un-premier-document-svg.php" title="cours suivant">Un premier document SVG</a></div>


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
