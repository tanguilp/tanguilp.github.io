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
<p>Je mets ici en ligne un vieux tutoriel écrit à l’origine sur le <a href="http://www.siteduzero.com/tutoriel-3-33440-le-point-sur-xml.html">SiteDuZéro</a>. Toute remarque est la bienvenue pour corriger les erreurs potentielles et pour le faire évoluer.</p>
<h2>Tutorial sur XML</h2>

<p>Bonjour à tous,

aujourd’hui, XML est sur toutes les lèvres. Sur le net, c’est carrément devenu un argument de vente et ces trois lettres sont présentées comme la solution ultime à tous les problèmes, le langage du <span style="font-variant:small-caps;text-transform:lowercase">XXI</span><sup>e</sup> siècle…
Mais il faut bien se rendre à l’évidence : XML reste quelque chose de très abstrait, et on a parfois du mal à comprendre à quoi il sert !</p>

<ul class="sommaire">
<li><a href="#xml">Ce qu’est XML</a></li>
<li><a href="#notxml">Ce que n’est pas XML</a></li>
<li><a href="#syntaxe">Les règles de syntaxe</a></li>
<li><a href="#galaxie">La galaxie XML</a></li>
<li><a href="#namespace">Les espaces de nom (namespace)</a></li>
<li><a href="#style">Le style avec CSS et XSLT/XPath</a></li>
<li><a href="#xquery">XQuery : XML comme une base de données</a></li>
<li><a href="#validation">DTDs et schémas</a></li>
<li><a href="#dom">Le DOM</a></li>
<li><a href="#xmlweb">XML sur le Web</a></li>
<li><a href="#conclu">Conclusion</a></li>
</ul>

<h3 id="xml">Ce qu’est XML</h3>

<p>D’abord, ne soyez pas déçus mais c’est comme ça : sachez que XML ne peut pas faire grand chose tout seul. On peut même dire qu’il ne sert à rien <object type="image/gif" data="images/smileys/huh.gif">:O</object>.
En fait, XML est un langage de balisage, standardisé par le <a href="http://w3.org/">World Wide Web Consortium</a> (à l’origine du HTML), qui définit un ensemble de règles syntaxiques pour la présentation structurée de l’information.</p>

<p>Vous ne comprenez pas ? Normal, dit comme ça, vous ne risquez pas de comprendre <object type="image/gif" data="images/smileys/001_tongue.gif">smiley</object>.</p>

<p>En fait, c’est très simple. Un jour, des informaticiens se sont dit que ça serait cool de faire communiquer des programmes, de partager des informations, etc. Alors ils ont créé des fichiers avec toutes ces informations dedans, séparés par des blancs, ou des tirets, où les sauts de lignes signifiaient soit une nouvelle information, soit autre chose… et au final, ces fichiers étaient tous plus illisibles les uns que les autres, et à chaque fois il fallait réécrire plein de code pour lire les nouveaux fichiers.</p>
<p>
Et puis un jour, ces mêmes informaticiens se sont dit qu’ils pourraient essayer de faire parler les ordinateurs entre eux ! Brillante idée, Internet était né, avec http comme protocole pour la distribution des données.</p>
<p>
Mais avec la naissance d’Internet et des échanges de données à travers la planète, il a fallu inventer un langage qui serait compris de tous. On l’appela SGML, c’est lui qui donna naissance au HTML. Un vrai succès !</p>
<p>
Malheureusement, la norme SGML était trop compliquée pour beaucoup, et c’est alors que fut inventé par le <a href="http://w3.org">W3C</a> le XML.</p>
<p>
Ce fut un véritable succès. L’industrie s’en empara et inventa un tas de dialectes (ou langages) à partir de XML.</p>
<p>
Car c’est bien là l’essence de XML : tout le monde peut créer son langage à partir des règles de syntaxes dictées par cette norme. C’est pour ça qu’on dit que XML est un <strong>méta-langage</strong> : il permet d’en créer plein d’autres.</p>
<p>
Bien sûr, ces langages créés ont tous la même fonction : présenter de l’information structurée. Par exemple, les entreprises aéronautiques ont créé un langage basé sur XML pour l’échange d’informations relatives aux données techniques des avions. De même, il existe plusieurs langages utilisés dans les milieux financiers pour l’échange d’informations relatives aux transactions.</p>
<p>
Bref, ce qu’il faut retenir, c’est que XML n’est pas une fin mais un moyen.</p>

<blockquote cite="PHP5 Référence (Micro Application)"><p>Il y a quelques temps résonnait dans le monde informatique le mot « XML ». Tout le monde l’avait à la bouche, et apparemment une grande révolution s’annonçait. L’effet de mode s’étant à présent dissipé, XML est reconnu pour ce qu’il est : une norme de structuration de données.</p></blockquote>




<h3 id="notxml">Ce que n’est pas XML</h3>

<p>Maintenant, pour éviter toute confusion, voici ce que XML n’est pas :</p>

<ul class="list-attributes">
<li>XML n’est pas le remplaçant de HTML, tout simplement parce qu’ils n’ont pas le même but : XML sert à structurer l’information, tandis que HTML a pour but de la présenter et de lui donner du sens (par exemple, le texte dans un <span class="balise sanslt">&lt;blockquote&gt;</span> est une citation). XML n’est pas non plus le remplaçant du XHTML, qui a pour but de donner du sens à du texte (la présentation étant, en principe, confiée à CSS) ;</li>
<li>XML ne doit pas être utilisé pour faire du document Web. Ce n’est pas son rôle, même si on peut y appliquer du style avec CSS :
<div class="xmlcode"><![CDATA[<paragraphe>Ceci est <tres-important>urgent</tres-important></paragraphe>]]></div> n’a aucun sens. Il faudrait plutôt écrire cela en (X)HTML comme ceci :
<div class="xmlcode"><![CDATA[<p>Ceci est <strong>urgent</strong></p>]]></div> Mais ça je vous fais confiance, vous connaissez ; :D
</li>
<li>un autre point : XML n’est pas fait pour le stockage. Vous verrez plus bas que ça peut paraître très intéressant. Mais une fois de plus, il faut préciser que XML n’est pas fait pour ça : il est très verbeux (bavard) et les fichiers XML ont tendance à être assez volumineux. Pour garder les avantages des bases de données classiques avec XML, il faudra vous tourner vers les bases de données XML natives.
Une base de données XML native est une base de données qui stocke ses données de manière traditionnelle (en binaire : 010101010101001101010), ce qui a l’avantage de prendre peu de place, mais qu’on peut interroger avec des langages spécialisés, comme XPath et XQuery (j’en parlerai plus bas), et qui peut renvoyer des résultats en XML.</li>
</ul>

<h3 id="syntaxe">Les règles de syntaxe</h3>

<p>Si vous n’en avez rien à faire des règles de syntaxe de XML, passez à la <a href="#galaxie">section suivante</a>. Sinon, suivez le guide <object type="image/gif" data="images/smileys/001_cool.gif">B-)</object> : je vais vous « apprendre » XML !</p>

<h4>Les règles de base</h4>

<p>Tout d’abord, sachez que XML ressemble par certains points à XHTML. Normal, XHTML est du XML (mais nous y reviendrons plus tard).</p>

<p>En effet, XML est un langage de balisage : une balise commence par le signe &lt; et se termine par &gt;. Il doit toujours y avoir une balise ouvrante et une balise fermante. La balise fermante commence par &lt;/, comme ceci :</p>

<div class="xmlcode"><![CDATA[<balise></balise>
]]></div>

<p>Une balise peut contenir du texte, d’autres balises, les deux ou rien. Par exemple :</p>

<div class="xmlcode"><![CDATA[<balise><superbalise>Du texte</superbalise> et encore du texte</balise>]]></div>

<p>Les balises ne doivent pas se chevaucher. Ceci est interdit :</p>

<div class="xmlcode"><![CDATA[<balise1><balise2>Du texte</balise1></balise2>]]></div>

<p>Lorsqu’il n’y a pas de texte entre deux balises, on peut écrire une forme raccourcie :</p>

<div class="xmlcode"><![CDATA[<machin></machin>
]]></div>

<p>devient</p>

<div class="xmlcode"><![CDATA[<machin/>
]]></div>

<p>Les éléments peuvent porter des attributs (trop cool <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object>), délimités par des " ou des ' :</p>

<div class="xmlcode"><![CDATA[<mabalise attribut1="Salut" attribut2="tout" attribut3="le" attribut4="monde"/>]]></div>

<p>En général, on utilise les guillemets doubles ". On ne peut pas avoir plusieurs attributs portant le même nom.</p>

<p>C’est bien beau tout ça, mais si j’ai un attribut nom dont la valeur est « O'Neil », je fais comment ? L’apostrophe va tout faire bugger, non ?</p>

<p>En effet ! C’est pour ça qu’il existe avec XML cinq entités prédéfinies :</p>

<ul class="list-attributes">
<li>&amp;lt; remplace &lt; ;</li>
<li>&amp;gt; remplace &gt; ;</li>
<li>&amp;apos; remplace &apos; ;</li>
<li>&amp;quot; remplace &quot; ;</li>
<li>&amp;amp; remplace &amp; ;</li>
</ul>

<p>Pour information, lt signifie « lower than » (plus petit que, &lt;) et gt signifie « greater than » (plus grand que, &gt;).</p>

<p>Plus de problème avec O'Neill donc :</p>

<div class="xmlcode"><![CDATA[<personne nom='O&apos;Neill' métier="secret défense"/>
<personne nom="O&apos;Neill" métier="secret défense"/>
<personne nom="O'Neill" métier="secret défense"/>
]]></div>

<p>Les trois balises sont équivalentes. En fait, on est obligé d’utiliser les entités prédéfinies quand il y a ambiguïté. Mais ça ne pose pas de problème de les utiliser quand il n’y a pas d’ambiguïté, et c’est d’ailleurs souvent plus simple de procéder comme ça.</p>

<p>Les documents XML doivent respecter une autre règle : un élément (ou balise) doit contenir tous les autres. On appelle cet élément « élément racine ».</p>

<div class="xmlcode"><![CDATA[<racine>
   <balise1>
      <balise2>Du texte</balise2>
   </balise1>
   <balise1>Bla bla bla</balise1>
</racine>
]]></div>

<h4>Le prologue XML</h4>

<p>Un prologue peut être placé au tout début du fichier pour indiquer différentes informations (il est optionnel). Ça ressemble à ça :</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="iso-8859-1"?>]]></div>

<ul class="list-attribute">
<li>On indique d’abord la version de XML qu’on utilise. Vous n’utiliserez que la version 1.0 (sauf si vous avez l’envie subite d’écrire vos balises en chinois traditionnel) ;</li>
<li>la seconde information est l’encodage du document. L’encodage par défaut de XML est l’UTF-8, mais votre éditeur de texte enregistre peut être vos fichiers en iso-8859-1. Regardez dans ses options pour en être sûrs, mais préférez l’utf-8 ;</li>
</ul>

<h4>Les instructions de traitement</h4>

<p>Les instructions de traitement, ou processing-instruction en anglais (PI), s’adressent à un langage-cible qui se sert des informations fournies pour faire une action… quelconque !</p>

<p>La syntaxe est la suivante :</p>

<div class="xmlcode">&lt;<![CDATA[?langage-cible instructions?>]]></div>

<p>Attention : malgré les apparences, le prologue XML n’est pas une PI !</p>

<p>Prenons pour exemple la PI xml-stylesheet qui permet de lier une feuille de style à un document XML :</p>

<div class="xmlcode">&lt;<![CDATA[?xml-stylesheet type="text/css" href="print.css" title="Imprimer en couleur" media="print" charset="iso-8859-1" alternate="yes"]]></div>

<p>Ça vous rappelle quelque chose, non <object type="image/gif" data="images/smileys/001_tongue.gif">:p</object> ?</p>

<p>Attention, encore une fois malgré les apparences, type, href, title, etc ne sont pas des attributs ! Quand on vous dit qu’il ne faut pas se fier aux apparences <object type="image/gif" data="images/smileys/whistling.gif">:-°</object>.</p>

<p>Certains d’entre vous connaissent sans le savoir une autre PI : il s’ait de &lt;?php instructions?&gt;.
C’est pour cela qu’il faut écrire :</p>

<div class="phpcode">&lt;?php ?&gt;
// et pas
&lt;? ?&gt;</div>

<h4>Les sections CDATA</h4>

<p>Voici une facette un peu méconnue de XML : la section CDATA. Une section CDATA sert à s’affranchir de l’échappement des caractères spéciaux XML (cf les cinq entitées). Bref, plus besoin d’utiliser les entités. L’exemple suivant (en XHTML) n’est pas très lisible :</p>

<div class="xmlcode"><![CDATA[<p>Hier j’ai écrit un fichier XML de ouf !</p>
<p>&lt;monfichierXML&gt;
        &lt;balise1&gt;
                &lt;balise2&gt;Du texte&lt;/balise2&gt;
        &lt;/balise1&gt;
        &lt;balise1 truc=&quot;pouf&quot; paf=&quot;pif&quot;/&gt;
&lt;/monfichierXML&gt;</p>
]]></div>

<p>tandis qu’avec une section CDATA, plus aucun problème :</p>

<div class="xmlcode"><![CDATA[<p>Hier j’ai écrit un fichier XML de ouf !</p>
<p><]]>![CDATA[<![CDATA[<monfichierXML>
        <balise1>
                <balise2>Du texte</balise2>
        </balise1>
        <balise1 truc="pouf" paf="pif"/>
</monfichierXML>]]>]]&gt;&lt;/p&gt;
</div>

<p>Le code entre <span class="balise sanslt">&lt;![CDATA[</span> et <span class="balise sanslt">]]&gt;</span> n’est pas interprété, c’est-à-dire qu’il est considéré comme du texte, pas comme du XML. La chaîne de caractères « ]]&gt; » est interdite dans une section CDATA (logique, puisque cette séquence de caractères indique la fin d’une section CDATA). Une section CDATA ne peut donc pas contenir de section CDATA (mais qui aurait une idée aussi tordue <object type="image/gif" data="images/smileys/biggrin.gif">:D</object> ?).</p>

<h4>Les commentaires</h4>

<p>Comme dans tous les langages de programmation, il est possible d’inclure des commentaires dans le code source. C’est encore une fois très simple :</p>

<div class="xmlcode"><![CDATA[<!--le commentaire se place ici-->]]></div>

<p>La seule chose à retenir est que la séquence « -- » est interdite dans un commentaire. Mais croyez moi, il ne servent pas à grand chose !</p>

<p>Voilà, vous connaissez XML ! Ce n’est pas sorcier, n’est ce pas <object type="image/gif" data="images/smileys/shifty.gif">:/</object> ?
Si toutes ces règles sont respectées, on dit que le document XML est bien formé (well-formed, en anglais). S’il n’est pas bien formé, c’est une erreur et le document XML est inutilisable.</p>

<h3 id="galaxie">La galaxie XML</h3>

<p>Vous le voyez, XML ne sert à rien !</p>

<p>En fait, ce qui sert, ce sont tous les langages qui gravitent autour, et qui sont intéressants. Ils font partie de la galaxie XML.</p>

<p>Ceux dont l’orbite est très éloignée ne nous intéressent pas : il s’agit de langages dédiés à des domaines très précis, le CML par exemple qui est utilisé pour décrire des composés chimiques, ou SVG pour le dessin vectoriel en 2D.</p>

<p>Mais il y a certains langages qui ont une orbite basse (c’est une image, hein <object type="image/gif" data="images/smileys/whistling.gif">:-°</object> ). Ces langages, qui ne sont pas tous des dialectes XML, servent à manipuler des documents XML (DOM, SAX), à les transformer (XSLT), à décrire leur contenu (DTD, Schémas XML), à les mettre en forme (CSS), à établir des liens entre eux (XLink), etc.
Ce sont ces langages qui font l’intérêt et le succès de XML, et d’ailleurs, la plupart des langages de script modernes (PHP, ASP, JavaScript) les gèrent.</p>

<p>Les sections qui suivent donnent un aperçu des principales technologies XML.</p>


<h3 id="namespace">Les espaces de nom (namespace)</h3>

<p>Mais avant tout, il faut que vous sachiez une chose, c’est qu’on peut mélanger plusieurs langages XML. Et ça croyez moi, c’est vraiment cool <object type="image/gif" data="images/smileys/yes.gif">:)</object>.</p>

<h4>Le problème</h4>

<p>C’est là que survient le premier problème. Imaginons que nous voulons générer du SVG (graphisme vectoriel) avec XSLT. Les deux langages ont une balise <span class="balise">text</span>. Or, comment le programme qui traitera notre document pourra savoir que ce <span class="balise">text</span>-ci est un élément SVG et que celui-là appartient au langage XSLT ? C’est pour éviter ce genre de problème qu’on appelle collision de nom (c’est beau, on se croirait en physique nucléaire <object type="image/gif" data="images/smileys/biggrin.gif">:D</object>), que les namespaces ont été inventés.</p>

<h4>La notion de namespace</h4>

<p>Le mécanisme de namespace, qu’on peut traduire par « espace de nom », ou « domaine nominal », est une notion assez abstraite.
Un namespace lui-même est abstrait. C’est une chaîne de caractères (souvent une adresse internet, mais elle n’est pas lue) qui sert à identifier le langage auquel appartient la balise, ou l’attribut qui fait partie de ce namespace. Pour résumer, chaque élément et chaque attribut appartient à un espace de nom auquel correspond un langage.</p>

<p>Mais c’est tellement abstrait qu’il vaut mieux un exemple, sinon je vais pas m’en sortir <object type="image/gif" data="images/smileys/whistling.gif">:-°</object>.</p>

<h4>La technique</h4>

<p>Tout d’abord, il faut déclarer le namespace grâce à l’attribut réservé <span class="attribute">xmlns</span>. Par exemple, pour le XHTML, on fait :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml">]]></div>

<p>Il faut avouer que ça ne nous avance pas à grande chose… Comment faire pour inclure du MathML (langage XML pour décrire des équations mathématiques) ? Ajouter un second attribut <span class="attribute">xmlns</span> est interdit (il est interdit d’y avoir deux attributs ayant le même nom).</p>

<p>On va donc déclarer un préfixe pour un namespace, qui comme son nom l’indique se placera avant un nom de balise ou d’attribut, et dire que toutes les balises et tous les attributs portant ce préfixe appartiennent au namespace précisé, et donc à un langage spécifique.</p>

<p>Pour déclarer un namespace et un préfixe, on utilise la syntaxe suivante, toujours avec l’attribut <span class="attribute">xmlns</span> :</p>

<div class="xmlcode"><![CDATA[xmlns:prefixe="adresse-du-namespace"]]></div>

<p>On a une totale liberté sur le choix du préfixe.
Ensuite, on l’utilise comme ceci sur les balises et les attributs :</p>

<div class="xmlcode"><![CDATA[<prefixe:balise attribut="pif paf pouf"/>]]></div>

<p>Simplissime, n’est-ce pas ?</p>

<p>Sauf qu’il y a un "bug" : pourquoi l’attribut qui appartient (on le suppose) au même langage n’a pas de préfixe ? En gros, pourquoi n’a-t-on pas écrit :</p>

<div class="xmlcode"><![CDATA[<prefixe:balise prefixe:attribut="pif paf pouf"/>]]></div>

<p>La raison est un peu étrange. En fait, un attribut qui appartient au même langage que l’élément qui le porte a un espace de nom nul. C’est bizarre mais c’est comme ça.</p>

<p>Avec du XHTML, cela nous donnera donc :</p>

<div class="xmlcode"><![CDATA[<frites:html xmlns:frites="http://www.w3.org/1999/xhtml" lang="en">
<frites:head>
<!-- etc etc -->
</frites:head>
<frites:body>
<frites:p>
<frites:a href="http://www.siteduzero.com">Cours XHTML/css, php et C++</frites:a>
</frites:p>
</frites:body>
</frites:html>
]]></div>

<p>Maintenant, pour inclure un autre langage, du MathML par exemple, il suffit de déclarer son namespace avec un autre préfixe, comme ceci :</p>

<div class="xmlcode"><![CDATA[<xhtml:html xmlns:xhtml="http://www.w3.org/1999/xhtml"
	xmlns:mathml="http://www.w3.org/1998/Math/MathML" lang="en">
<xhtml:head>
<!-- etc etc -->
</xhtml:head>
<xhtml:body>
<xhtml:p>
<mathml:math>
  <mathml:msup>
    <mathml:msqrt>
      <mathml:mrow>
        <mathml:mi>a</mathml:mi>
        <mathml:mo>+</mathml:mo>
        <mathml:mi>b</mathml:mi>
      </mathml:mrow>
    </mathml:msqrt>
    <mathml:mn>27</mathml:mn>
  </mathml:msup>
</mathml:math>
</xhtml:p>
</xhtml:body>
</xhtml:html>
]]></div>

<p>En général, on met un préfixe évocateur, c’est-à-dire qu’on évite les frites et autres sandwicheries. C’est plus facile pour la relecture.
Cependant rappelez-vous que si vous cherchez à savoir à quel langage appartient un élément, il faut se référer au namespace, et non pas au préfixe !</p>

<p>Les informaticiens étant des fainéants, ils ont trouvé un moyen de simplifier ce mécanisme. Si on écrit :</p>

<div class="xmlcode"><![CDATA[xmlns="http://www.machin.org"]]></div>

<p>alors on considère que l’élément qui porte cette déclaration et ses descendants appartiennent à ce namespace ! En réécrivant le code ci-dessus, ça donne :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml" xmlns:mathml="http://www.w3.org/1998/Math/MathML" lang="en">
<head>
<!-- etc etc -->
<head>
<body>
<p>
<mathml:math>
  <mathml:msup>
    <mathml:msqrt>
      <mathml:mrow>
        <mathml:mi>a</mathml:mi>
        <mathml:mo>+</mathml:mo>
        <mathml:mi>b</mathml:mi>
      </mathml:mrow>
    </mathml:msqrt>
    <mathml:mn>27</mathml:mn>
  </mathml:msup>
</mathml:math>
</p>
</body>
</html>
]]></div>

<p>En suivant la même règle, on peut écrire :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<!-- etc etc -->
<head>
<body>
<p>
<math xmlns="http://www.w3.org/1998/Math/MathML">
  <msup>
    <msqrt>
      <mrow>
        <mi>a</mi>
        <mo>+</mo>
        <mi>b</mi>
      </mrow>
    </msqrt>
    <mn>27</mn>
  </msup>
</math>
</p>
</body>
</html>
]]></div>

<p>En fait, c’est assez intuitif.</p>

<p>Et c’est vraiment puissant. Grâce à cela on peut vraiment rassembler divers langages dans le même document et c’est un mécanisme aujourd’hui très utilisé.</p>

<h3 id="style">Le style avec CSS et XSLT/XPath</h3>

<h4>Le style CSS</h4>


<p>CSS (Cascading Style Sheets, Feuille de Style en Cascade en français) est un langage non XML (mais très simple), dédié à la présentation de documents XML. CSS couvre un large choix de propriétés, allant de la couleur du texte à la taille d’un bloc, en passant par la position d’une image d’arrière-plan ou des compteurs…</p>

<p>CSS reconnaît les namespace, est disponible pour plusieurs médias (affichage à l’écran, format pour l’impression, propriétés auditives, etc), et possède des sélecteurs puissants qui permettent d’effectuer des réglages fins sur les éléments sur lesquels appliquer du style.</p>

<p>Enfin, il existe des propriétés spécifiques à certains langages, pour les graphiques vectoriel 2D SVG par exemple.</p>

<p>Bref, le style en CSS c’est <strong>puissant</strong>.</p>

<p>La preuve, le design plutôt sympa de ce site est intégralement réalisé avec CSS.</p>

<h4>Le style avec XSLT</h4>


<p>La notion de style avec XSLT est très différente de celle avec CSS. Ici, pas question de colorer un bloc en rouge ou d’agrandir la taille du texte, même si on parle toujours de feuille de style.</p>

<p>XSLT est un dialecte XML servant à transformer un document XML source en un autre document XML ou en texte.</p>

<p>Concrètement, ça marche comme ceci : on a un premier fichier XML source sur lequel on applique une feuille de style XSLT (qui est le second fichier XML), et cela produit un troisième document XML ou texte.</p>

<p>L’intérêt ? Imaginons un document XML qui décrit des statistiques : on peut grâce à des feuilles de style XSLT le transformer très facilement en un beau graphique 2D SVG, en document XHTML pour la consultation sur le Web, ou en pdf en incluant le beau graphique 2D (grâce à FO).</p>

<p>Pour se situer dans un document XML, XSLT utilise XPath qui est un langage d’adressage non XML, lui aussi très simple et très intuitif. Il est indispensable à XSLT, c’est pourquoi on parle généralement du couple XSLT / XPath.</p>



<p>Ces deux langages font partie de la base de XML.</p>

<h3 id="xquery">XQuery : XML comme une base de données</h3>

<p>Il existe un autre langage pour extraire des informations d’un document XML : XQuery.
Il adopte une syntaxe assez proche de SQL, et utilise XPath pour retirer n’importe quelle donnée d’un fichier XML.</p>

<p>Ce langage permet en plus toutes les opérations que l’on peut vouloir faire avec SQL : insertion de données, mise à jour, suppression, etc.
D’ailleurs, les bases de données XML natives dont je parlais plus haut permettent leur interrogation en XQuery.</p>

<p>Couplé avec XForms et des interfaces Rest, on peut construire des applications Web sans aucune traduction des données. On stocke directement les données XML issues du formulaire XForms dans une base de donnée capable, grâce à XQuery, de les manipuler de manière efficace.</p>

<p>Cette manière de programmer a un petit nom : <acronym title="XForms Rest XQuery">XRX</acronym>.</p>


<h3 id="validation">DTDs et schémas</h3>

<p>Les DTD et les schémas ont les mêmes buts : donner des règles d’écriture d’un document XML spécifique (super important dans l’industrie par exemple). C’est-à-dire qu’en plus de règles de syntaxe de base de XML, les DTD et les schémas rajoutent des contraintes sur les éléments autorisés, les valeurs possibles d’un attribut, leur ordre d’apparition, etc.</p>

<p>Par exemple, il est écrit dans la DTD de XHTML qu’un élément <span class="balise">ul</span>
ne peut contenir que des <span class="balise">li</span>
, ou que l’élement <span class="balise">title</span>
ne peut se trouver qu’une fois dans <span class="balise">head</span>.</p>

<p>Un document qui est correct face à ces contraintes est dit valide, par rapport à une DTD ou à un schéma. Un document valide est forcément bien formé, mais un document bien formé n’est pas forcément valide par rapport à une DTD ou à un schéma.</p>

<h4>Les DTD</h4>


<p>Les DTD, nés avec le langage XML, présentent un syntaxe non XML pour décrire des règles d’écriture.
Il est vite apparu que les DTD étaient insuffisantes, et de toute façon pas assez puissantes. De plus, les DTD ne gèrent pas les namespace. C’est pourquoi on a inventé les schémas XML. Les DTD sont aujourd’hui pratiquement abandonnées.</p>

<h4>Les schémas XML</h4>


<p>Il existe différents langages de schémas, mais nous n’en retiendrons qu’un : XML Schéma, promu par le W3C.
Il permet enfin le typage des données (on peut dire : « le contenu de la balise <span class="balise">age</span> doit être compris entre 0 et 123 », « cet élément doit contenir tel autre élément et optionellement celui-là »), la gestion des namespace et une multitude d’autre possibilités sympathiques. Cette spécification du W3C est vouée à devenir une base de référence dans l’univers XML, et les nouveaux langages prennent d’ailleurs en compte XML Schéma (XForms et XPath2 par exemple).</p>

<h3 id="dom">Le DOM</h3>

<p>DOM (Document Object Model) est une API (comprenez : un ensemble d’interfaces standardisées) normalisée par le W3C qui construit en mémoire le document XML sous forme arborescente (sous forme d’arbre).</p>

<p>À partir du moment où cet arbre est construit en mémoire, on peut accéder à n’importe quel élément, attribut, et on peut aussi changer leurs valeurs, créer des éléments, des attributs, en cloner d’autres, en supprimer certains, etc. Bref avec DOM, on peut facilement manipuler un document XML, et ce avec différents langages, autant côté client que côté serveur.</p>

<p>Côté client, on a principalement ECMAScript (version normalisée par l’ECMA de JavaScript) qui permet l’interaction avec l’utilisateur (« quand tu cliques ici, ça devient rouge là ») ; mais il y a aussi possibilité dans certains cas d’utiliser d’autres langages, comme Python et Java. Avec Flash, qui utilise ActionScript (grosso modo, ECMAScript), il est courant de faire des échanges de données avec PHP, en utilisant DOM pour analyser les données reçues. Si vous voulez en apprendre davantage, consultez la partie du cours SVG traitant <a href="dom.php">du DOM avec JavaScript</a>.</p>

<p>Côté serveur, tous les langages un tant soit peu modernes connaissent XML : ASP, PHP, JSP… la liste est longue.</p>

<p>L’avantage est évident : plus besoin de connaître 56 000 langages ou librairies pour effectuer diverses tâches : on fait tout avec DOM. Par exemple, aujourd’hui pour créer un image avec PHP, on utilise la librairie GD pour générer du PNG. Pour faire du Flash, on doit apprendre l’extension Ming. Et pour faire du PDF, on doit passer par les fonctions de PDFLib. Dans un futur proche, on pourra faire tout ça avec DOM, puisque SVG permet de créer des images, SMIL gère l’animation et FO peut être converti en PDF !</p>

<p>De plus, il existe des DOM « spécialisés » à certains langages, des extensions. Par exemple, le DOM SVG permet de connaitre la longueur d’une ligne courbe.</p>

<p>DOM construisant le fichier en mémoire, il n’est pas intéressant pour le traitement de gros fichiers. D’autres API ont été développées pour pallier à ces insuffisances, dont SAX, qui est la plus connue. SAX se base sur des évènements. Chaque ouverture / fermeture de balise, chaque rencontre avec un attribut, etc. déclenche un évènement. On peut alors dire comment réagir à chaque évènement et effectuer une action particulière grâce à SAX.</p>

<h3 id="xmlweb">XML sur le Web</h3>

<p>De par sa nature, XML est adapté au Web, cet espace où les machines doivent communiquer en utilisant des langages compris de tous. Le W3C a développé une multitude de langages pour le Web, dont voici les principaux, accompagnés d’une présentation succincte :</p>

<h4>XHTML</h4>


<p>Remplaçant de HTML (qui n’est pas un dialecte XML), le rôle de XHTML est de présenter du document Web. Chaque balise a un sens, et la présentation est gérée par CSS.</p>

<h4>SVG (pour Scalable Vector Graphics)</h4>


<p>Il permet de faire du dessin vectoriel en 2D et de faire de l’animation ! Il n’a vraiment rien a envier à Flash, d’autant plus que son implémentation dans les navigateurs s’accélère, même s’il faudra encore un peu de temps avant d’avoir quelque chose de convenable. CSS s’occupe encore et toujours de la présentation. Et il se trouve qu’il y a un tutoriel sur ce langage dans le coin… <object type="image/gif" data="images/smileys/innocent.gif">0:)</object></p>

<h4>SMIL (pour Synchronized Multimedia Integration Language)</h4>


<p>SMIL permet de faire de l’animation déclarative, c’est à dire sans script. SVG utilise SMIL pour le faire. Consultez les deux parties traitant de l’animation dans le cours SVG pour en savoir plus.</p>



<h4>XForms</h4>


<p>XForms est la prochaine génération de formulaires Web. C’est un langage vraiment très puissant. Il permet entre autres la soumission des données en XML (on peut donc transformer les données reçues avec XSLT, ça vous dit quelque chose ?), la vérification des données en direct, grâce à CSS et XML Schéma, tout ce que permet XPath pour le calcul des données soumises, de s’affranchir de scripts pour la répétition d’éléments, etc. XForms permet de se passer de 99% des scripts qui étaient nécessaire sur les formulaires HTML traditionnels.
XForms est tributaire d’un langage hôte (XHTML, SVG, etc.), c’est là que la technologie des namespace prend tout son sens.</p>

<h4>XLink</h4>


<p>XLink met à disposition les six attributs qui permettent de décrire des liens entre divers documents, mais en allant beaucoup plus loin que les traditionnels liens HTML tel qu’on les connait. Les liens sont bidirectionnels, ils peuvent pointer vers plusieurs documents, etc.
SVG utilise XLink.</p>

<h4>XPointer</h4>

<p>XPointer est en quelque sorte le prolongement de XLink. Il s’appuie sur XPath pour pointer sur une partie précise d’un document XML, un peu comme lorsque l’on pointe vers un id avec le # (par exemple mondoc.html#section1), mais en beaucoup plus puissant.</p>

<h4>XMPP</h4>

<p>XMPP signifie eXtensible Messaging and Presence Protocol. C’est un protocole de messagerie instantanée, normalisé par l’IETF (Internet Enginering Task Force, un organisme de normalisation un peu comme le W3C), et son réseau est appelé Jabber.</p>
<p>Il adopte évidemment une syntaxe XML, ce qui rend le dévelopement d’applications très aisé. Par exemple, ceci m’envoie un message :</p>

<div class="xmlcode"><![CDATA[<message to="tangui@im.apinc.org" type="chat" id="42" from="vous@serveur.jabber.org">
<body>Salut, ton tuto sur XML est vraiment génial !</body>
</message>]]></div>


<p>Il est de plus en plus utilisé (même s’il est peu utilisé par rapport aux autres systèmes de messageries instantanées), notamment par les gens qui refusent de voir leurs conversations potentiellement écoutées par des firmes privées, ou par des applications tierces. On peut très bien imaginer mettre à jour un panneau d’affichage numérique en pleine ville via XMPP.</p>

<p>Il utilise à fond le mécanisme des namespace, notamment pour incorporer du XHTML à des messages.</p>

<h4>SOAP et WSDL</h4>


<p>SOAP (Simple Object Access Protocol) et WSDL (Web Service Description Language) sont utilisés en commun pour fournir un service Web.
Mais qu’est-ce qu’un service Web ?</p>
<p>C’est un serveur qui va répondre de manière automatisée à une application.
Par exemple, un service Web peut fournir la météo à votre de barre de tâche sous Ubuntu.</p>

<p>WSDL s’occupe de décrire les informations qu’on peut trouver, et comment on peut les obtenir (« tu peux obtenir l’auteur d’un roman dont tu me fourniras le titre ici en passant par là »), tandis que SOAP s’occupe des données transmises : on envoie une enveloppe avec un message décrivant les données que l’on veut, et le service Web nous en renvoie une avec les données !</p>

<p>Ce sont des normes assez complexes.</p>

<h3 id="conclu">Conclusion</h3>

<p>Finalement, XML n’est vraiment pas sorcier !</p>
<p>Pour ceux qui veulent aller plus loin, je vous conseille ce document du W3C qui présente <a href="http://www.w3.org/XML/1999/XML-in-10-points.fr.html">XML en 10 points</a>. Vous pouvez aussi faire un tour du côté des <a href="http://www.gchagnon.fr/cours/xml/">cours XML proposés par Gilles Chagnon</a>.</p>

<p>J’espère que ce tutoriel vous a mis l’eau à la bouche. Si c’est le cas, vous pouvez commencer votre formation sur SVG !</p>

<div class="nextpage"><a href="introduction.php" title="cours suivant">Introduction sur le langage SVG</a></div>

<!-- fin -->

<!--
<object type="image/gif" data="images/smileys/helpsmilie.gif">:O</object>
<span class="attribute"></span>
<span class="balise"></span>

<div class="xmlcode"><![CDATA[]]></div>

<div class="csscode"><![CDATA[]]></div>

<div class="jscode"><![CDATA[]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/dom/"></object>
</div>
-->
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
