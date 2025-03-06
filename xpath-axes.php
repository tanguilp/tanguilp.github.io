<?php
require('inc/header.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
<title>SVGround : axes de sélection avec XPath</title>
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
<h2>XPath : axes de sélection</h2>

<p></p>

<ul class="sommaire">
<li><a href="#child">Axe <span class="xpath">child</span></a></li>
<li><a href="#parent">Axe <span class="xpath">parent</span></a></li>
<li><a href="#self">Axe <span class="xpath">self</span></a></li>
<li><a href="#attribute">Axe <span class="xpath">attribute</span></a></li>
<li><a href="#descendant">Axe <span class="xpath">descendant</span></a></li>
<li><a href="#descendant-or-self">Axe <span class="xpath">descendant-or-self</span></a></li>
<li><a href="#ancestor">Axe <span class="xpath">ancestor</span></a></li>
<li><a href="#ancestor-or-self">Axe <span class="xpath">ancestor-or-self</span></a></li>
<li><a href="#following-sibling">Axe <span class="xpath">following-sibling</span></a></li>
<li><a href="#preceding-sibling">Axe <span class="xpath">preceding-sibling</span></a></li>
<li><a href="#following">Axe <span class="xpath">following</span></a></li>
<li><a href="#preceding">Axe <span class="xpath">preceding</span></a></li>
<li><a href="#namespace">Axe <span class="xpath">namespace</span></a></li>
<li><a href="#nodetype">Types de nœud</a></li>
</ul>

<p>Une expression XPath retourne quelque chose. Ce quelque chose peut être un ensemble de nœuds,
une valeur ou rien du tout. Dans ce chapitre, les expressions XPath retourneront principalement
des ensembles de nœuds. Pour visualiser le retour de ces expressions, j'utilise le programme
<span class="xpath">xpath</span> que vous trouverez dans les outils Perl de votre distribution
Linux favorite (tapez la commande dans un terminal pour savoir quel paquet installer sous Ubuntu).</p>

<h3 id="child">Axe <span class="xpath">child</span></h3>

<p>La première difficulté avec les expressions XPath est de savoir quel est le nœud contextuel. Ce nœud,
c'est l'endroit dans le document XML qui est considéré comme nœud courant pour appliquer l'expression XPath. Pour
faire l'analogie avec un système de fichier, c'est le répertoire dans lequel on se trouve. Alors, quel est le nœud contextuel
par défaut ? La réponse est : ça dépend !</p>

<p>Vous le verrez plus tard, le nœud contextuel dépend du langage qui utilise XPath et de l'endroit où on utilise l'expression.
Dans nos exemples, c'est plus simple : le nœud contextuel est la racine du document XML.</p>

<p>Il y a là une petite subtilité qui m'oblige à vous parler un peu du modèle de donnée XPath, mais rassurez vous XPath est
assez naturel pour qu'on puisse l'oublier lorsqu'on écrit ses expressions. Naïvement, on peut penser que la racine est l'élément
racine du document XML. Il n'en est rien : la racine et l'élément sont deux types de nœud différents pour XPath, un peu comme dans le DOM
ou on doit écrire <span class="js">document.rootElement</span> pour accéder à l'<em>élément</em> racine.</p>

<p>La raison est qu'il peut y avoir des commentaires et des processing-instructions en dehors de l'arbre XML.</p>

<p>Mais ce n'est pas si compliqué : il faut juste savoir que racine et élément racine sont différents et que l'élément racine
est le fils de la racine.</p>

<p>Le premier des axes de localisation est l'axe <span class="xpath">child</span>. Elle permet de sélectionner les fils du nœud
courant (ou contextuel). Pour l'instant, considérons que ces fils sont forcément des éléments (et donc pas du texte, pas de commentaire,
etc). Nous verrons plus tard comment sélectionner d'autres types de nœud.</p>

<p>Les expressions XPath sont consituées de plusieurs étapes de une ou plusieurs étapes de localisation, séparées par des
<span class="xpath">/</span>. Une étape de localisation est de la forme : <span class="xpath">axe::test</span>. Une expression
XPath est donc de la forme :</p>

<p><span class="xpath">axe1::test1/axe2::test2/axe3::test3/...</span></p>

<p>Les généralités ayant été traitées, il est temps d'écrire notre première expression XPath. Prenons le fichier XML
suivant :</p>

<div class="xmlcode"><![CDATA[<root>
  <item>abcd</item>
  <item>cdef</item>
  <item/>
  <item>ghij</item>
  <item>klmn</item>
  <item>
    <a/>
    <b/>
    <c/>
    <d/>
  </item>
</root>]]></div>

<p>Le nœud courant est la racine (nous "sommes" sur la racine). Pour récupérer l'élément
<span class="balise">root</span>, il suffit d'écrire :</p>

<p><span class="xpath">child::root</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "child::root" test.xml 
Found 1 nodes in test.xml:
-- NODE --
<root>
  <item>abcd</item>
  <item>cdef</item>
  <item />
  <item>ghij</item>
  <item>klmn</item>
  <item>
    <a />
    <b />
    <c />
    <d />
  </item>
</root>]]></div>

<p>Le nœud retourné est bien l'élément racine. La racine n'ayant qu'un fils (l'élément racine), il est
normal qu'un seul nœud soit retourné. Maintenant, pour sélectionner tous les éléments
<span class="balise">item</span>, il suffit d'écrire :</p>

<p><span class="xpath">child::root/child::item</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "child::root/child::item" test.xml 
Found 6 nodes in test.xml:
-- NODE --
<item>abcd</item>
-- NODE --
<item>cdef</item>
-- NODE --
<item />
-- NODE --
<item>ghij</item>
-- NODE --
<item>klmn</item>
-- NODE --
<item>
    <a />
    <b />
    <c />
    <d />
  </item>
]]></div>

<p>L'écriture d'une telle expression XPath est lourde et pas assez intuitive. C'est pourquoi la norme XPath prévoit
plusieurs raccourcis. L'axe <span class="xpath">child</span> est l'axe par défaut. Si on ne l'écrit pas, il est sous entendu.
Ainsi l'expression précédente peut être réécrite comme ceci :</p>

<p><span class="xpath">root/child</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item" axes.xml 
Found 6 nodes in axes.xml:
-- NODE --
<item>abcd</item>
-- NODE --
<item>cdef</item>
-- NODE --
<item />
-- NODE --
<item>ghij</item>
-- NODE --
<item>klmn</item>
-- NODE --
<item>
    <a />
    <b />
    <c />
    <d />
</item>]]></div>

<p>Idem, pour sélectionner l'élément <span class="balise">d</span>, on écrira :</p>

<p><span class="xpath">root/item/d</span></p>

<p>qui est strictement la même chose que :</p>

<p><span class="xpath">child::root/child::item/child::d</span></p>


<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/d" axes.xml 
Found 1 nodes in axes.xml:
-- NODE --
<d />]]></div>

<p>Maintenant, comment faire pour sélectionner tous les fils du dernier <span class="balise">item</span> ?</p>


<div class="xmlcode"><![CDATA[<root>
  <item>abcd</item>
  <item>cdef</item>
  <item/>
  <item>ghij</item>
  <item>klmn</item>
  <item>
    <a/>
    <b/>
    <c/>
    <d/>
  </item>
</root>]]></div>

<p>Il existe un joker avec XPath, qui comme souvent est l'étoile <span class="xpath">*</span>. Il signifie « tous ».</p>

<p>Utiliser cette étoile sélectionnera donc tous les éléments fils du nœud courant.</p>

<p><span class="xpath">root/item/*</span></p>

<p>Cette expression sélectionne tous les éléments fils d'un élément <span class="balise">item</span> lui même
fils d'un élément <span class="xpath">root</span>.</p>

<p>N'oubliez pas qu'en l'absence d'axe de localisation, l'axe par défaut est <span class="xpath">child::</span> et
c'est aussi valable pour le joker. Ainsi cette expression peut aussi s'écrire :</p>

<p><span class="xpath">child::root/child::item/child::*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/*" axes.xml 
Found 4 nodes in axes.xml:
-- NODE --
<a />
-- NODE --
<b />
-- NODE --
<c />
-- NODE --
<d />]]></div>

<h3 id="parent">Axe <span class="xpath">parent</span></h3>

<p>L'axe de localisation <span class="xpath">parent</span> est l'opposé de l'axe <span class="xpath">child</span>. Il
désigne l'élément parent du nœud sur lequel on est. Il s'agit forcément d'un élément et pas d'un attribut, d'un nœud texte, etc.</p>

<p>Ainsi, à partir du l'élément <span class="xpath">a</span>, on peut remonter vers son père comme ceci :</p>

<p><span class="xpath">root/item/a/parent::item</span></p>

<div class="xmlcode"><![CDATA[<root>
  <item>abcd</item>
  <item>cdef</item>
  <item/>
  <item>ghij</item>
  <item>klmn</item>
  <item>
    <a/>
    <b/>
    <c/>
    <d/>
  </item>
</root>]]></div>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/d/parent::item" axes.xml
Found 1 nodes in axes.xml:
-- NODE --
<item>
    <a />
    <b />
    <c />
    <d />
</item>]]></div>

<p>Évidemment, puisqu'il n'y a qu'un parent, on peut utiliser le joker <span class="xpath">*</span> ce qui revient
strictement au même :</p>

<p><span class="xpath">root/item/a/parent::*</span></p>

<div class="xmlcode"><![CDATA[<root>
  <item>abcd</item>
  <item>cdef</item>
  <item/>
  <item>ghij</item>
  <item>klmn</item>
  <item>
    <a/>
    <b/>
    <c/>
    <d/>
  </item>
</root>]]></div>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/a/parent::*" parent.xml 
Found 1 nodes in parent.xml:
-- NODE --
<item>
    <a />
    <b />
    <c />
    <d />
</item>]]></div>

<p>Enfin, il existe un raccourci pour désigner l'élément parent : <span class="xpath">..</span> L'expression
précédent peut donc se réécrire de cette manière :</p>

<p><span class="xpath">root/item/a/..</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/a/.." parent.xml 
Found 1 nodes in parent.xml:
-- NODE --
<item>
    <a />
    <b />
    <c />
    <d />
</item>
]]></div>



<h3 id="self">Axe <span class="xpath">self</span></h3>

<p>L'axe <span class="xpath">self</span> est l'axe égocentrique par excellence. Il permet de localiser... le nœud courant !
Il ne sélectionne donc qu'un élément (lui même) et on peut donc utiliser le joker. Exemple :</p>

<p><span class="xpath">root/item/b/self::b</span></p>

<p>ou ce qui est équivalent :</p>

<p><span class="xpath">root/item/b/self::*</span></p>

<div class="xmlcode"><![CDATA[<root>
  <item>abcd</item>
  <item>cdef</item>
  <item/>
  <item>ghij</item>
  <item>klmn</item>
  <item>
    <a/>
    <b/>
    <c/>
    <d/>
  </item>
</root>]]></div>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/b/self::*" axes.xml
Found 1 nodes in axes.xml:
-- NODE --
<b />]]></div>

<p>Il existe un raccourci pour cet axe. Il s'agit du point <span class="xpath">.</span>, la même chose que dans
les systèmes de fichier.</p>

<p><span class="xpath">root/item/b/.</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/item/b/self::." axes.xml
Found 1 nodes in axes.xml:
-- NODE --
<b />]]></div>

<p>Si vous doutez de son utilité, vous avez raison !</p>

<h3 id="attribute">Axe <span class="xpath">attribute</span></h3>

<p>Les éléments peuvent porter des attributs. Dans le modèle de donnée XPath, c'est un peu particulier : le père
(axe <span class="xpath">parent</span>) d'un attribut est l'élément qui le porte <strong>mais</strong> un attribut
<strong>n'est pas</strong> le fils de l'élément qui le porte. Ça ne fonctionne que dans un sens.</p>

<p>Ici, j'ai du mal à trouver une analogie avec le monde réel...</p>

<p>Soit le document XML suivant :</p>

<div class="xmlcode"><![CDATA[<racine>
  <item attr1="foo" attr2="bar"/>
  <item>
    <a class="baz"/>
    <b class="abcd"/>
  </item>
</racine>]]></div>

<p>Pour récupérer l'attribut <span class="attribute">attr1</span> des éléments <span class="balise">item</span>,
on écrira :</p>

<p><span class="xpath">child::racine/child::item/attribute::attr1</span></p>

<p>Soit en écriture abrégée :</p>

<p><span class="xpath">racine/item/attribute::attr1</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/attribute::attr1" attributes.xml 
Found 1 nodes in attributes.xml:
-- NODE --
 attr1="foo"]]></div>

<p>Cet axe étant, avec l'axe <span class="xpath">child</span> un des plus utilisé, il existe un raccourci : il s'agit de
<span class="xpath">@</span> qui veut dire la même chose que <span class="xpath">attribute::</span>. L'expression
précédente devient alors :</p>

<p><span class="xpath">racine/item/@attr1</span></p>


<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/@attr1" attributes.xml 
Found 1 nodes in attributes.xml:
-- NODE --
attr1="foo"]]></div>

<p>Il est également possible d'utiliser le joker <span class="xpath">*</span> pour sélectionner tous les attributs. On écrit alors
<span class="xpath">attribute::*</span> ou sous forme raccourcie <span class="xpath">@*</span>.</p>

<p>Dans le document suivant, on cherche à désigner tous les attributs des éléments contenus dans un <span class="balise">item</span> :</p>

<div class="xmlcode"><![CDATA[tangui@deus:~$ cat attributes.xml 
<racine>
  <item attr1="foo" attr2="bar"/>
  <item>
    <a id="aelt" class="baz"/>
    <b id="belt" class="abcd"/>
  </item>
</racine>]]></div>

<p>Il faut donc utiliser deux fois le joker :</p>

<p><span class="xpath">racine/item/*/@*</span></p>

<p>Soit en français, et en lisant en sens inverse : tous les attributs de tous les éléments fils d'un élément
<span class="balise">item</span> lui-même fils d'un élément <span class="balise">racine</span>. Lire les expressions
XPath en partant de la fin les rendent souvent plus simples à comprendre !</p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/*/@*" attributes.xml 
Found 4 nodes in attributes.xml:
-- NODE --
 id="aelt"
-- NODE --
 class="baz"
-- NODE --
 id="belt"
-- NODE --
 class="abcd"]]></div>

<h3 id="descendant">Axe <span class="xpath">descendant</span></h3>

<p>L'axe <span class="xpath">descendant</span> désigne tous les éléments qui sont les enfants, les petits enfants, etc
de l'élément courant.</p>

<p>Ainsi, dans le document XML suivant :</p>


<div class="xmlcode"><![CDATA[<racine>
  <item/>
  <item>
    <a/>
    <b/>
  </item>
  <item>
    <list>
      <item id="id1"/>
      <item id="id2"/>
      <item id="id3"/>
      <item id="id4"/>
    </list>
  </item>
</racine>]]></div>

<p>pour sélectionner tous les éléments <span class="balise">item</span> à partir de l'élément racine, on écrira :</p>

<p><span class="xpath">racine/descendant::item</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/descendant::item" descendant.xml 
Found 7 nodes in descendant.xml:
-- NODE --
<item />
-- NODE --
<item>
    <a />
    <b />
  </item>
-- NODE --
<item>
    <list>
      <item id="id1" />
      <item id="id2" />
      <item id="id3" />
      <item id="id4" />
    </list>
  </item>
-- NODE --
<item id="id1" />
-- NODE --
<item id="id2" />
-- NODE --
<item id="id3" />
-- NODE --
<item id="id4" />]]></div>

<p>Il y avait bien 7 éléments <span class="balise">item</span> sous l'élément racine dans notre fichier de départ
et il y a bien 7 nœuds dans le résultat.</p>

<p>On peut également utiliser le joker. Pour sélectionner tous les éléments sous l'élément racine, on écrira :</p>

<p><span class="xpath">racine/descendant::*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/descendant::*" descendant.xml 
Found 10 nodes in descendant.xml:
-- NODE --
<item />
-- NODE --
<item>
    <a />
    <b />
  </item>
-- NODE --
<a />
-- NODE --
<b />
-- NODE --
<item>
    <list>
      <item id="id1" />
      <item id="id2" />
      <item id="id3" />
      <item id="id4" />
    </list>
  </item>
-- NODE --
<list>
      <item id="id1" />
      <item id="id2" />
      <item id="id3" />
      <item id="id4" />
    </list>
-- NODE --
<item id="id1" />
-- NODE --
<item id="id2" />
-- NODE --
<item id="id3" />
-- NODE --
<item id="id4" />]]></div>

<p>Tous les éléments sous l'élément <span class="balise">racine</span> apparaissent.</p>

<h3 id="descendant-or-self">Axe <span class="xpath">descendant-or-self</span></h3>

<p>L'axe <span class="xpath">descendant-or-self</span> est quasiment identique à l'axe
<span class="xpath">descendant</span>, sauf qu'il peut aussi sélectionner le nœud courant.</p>

<p>Exemple sans et avec le joker avec ce document :</p>

<div class="xmlcode"><![CDATA[<racine>
  <item/>
  <item>
    <a/>
    <b/>
  </item>
  <item>
    <list>
      <item id="id1"/>
      <item id="id2"/>
      <item id="id3"/>
      <item id="id4"/>
    </list>
  </item>
</racine>]]></div>

<p><span class="xpath">racine/item/list/descendant-or-self::item</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/list/descendant-or-self::item" descendant.xml 
Found 4 nodes in descendant.xml:
-- NODE --
<item id="id1" />
-- NODE --
<item id="id2" />
-- NODE --
<item id="id3" />
-- NODE --
<item id="id4" />
]]></div>

<p>Avec le joker, on attrape l'élément courant en plus :</p>

<p><span class="xpath">racine/item/list/descendant-or-self::*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/list/descendant-or-self::*" descendant.xml 
Found 5 nodes in descendant.xml:
-- NODE --
<list>
      <item id="id1" />
      <item id="id2" />
      <item id="id3" />
      <item id="id4" />
    </list>
-- NODE --
<item id="id1" />
-- NODE --
<item id="id2" />
-- NODE --
<item id="id3" />
-- NODE --
<item id="id4" />]]></div>


<h3 id="ancestor">Axe <span class="xpath">ancestor</span></h3>

<p>À l'opposé, l'axe <span class="xpath">ancestor</span> contient l'élément parent du nœud courant,
le parent de l'élément parent et ainsi de suite. Prenons le document XML suivant :</p>

<div class="xmlcode"><![CDATA[<racine>
  <item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
  </item>
</racine>]]></div>

<p>Pour sélectionner les ancêtres <span class="balise">item</span> de l'élément <span class="balise">a</span>,
on écrira :</p>

<p><span class="xpath">racine/item/list/a/ancestor::item</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/list/a/ancestor::item" ancestor.xml 
Found 1 nodes in ancestor.xml:
-- NODE --
<item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
</item>]]></div>

<p>Et pour sélectionner tous les ancêtres de ce même élément :</p>

<p><span class="xpath">racine/item/list/a/ancestor::*</span></p>


<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/list/a/ancestor::*" ancestor.xml 
Found 3 nodes in ancestor.xml:
-- NODE --
<racine>
  <item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
  </item>
</racine>
-- NODE --
<item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
</item>
-- NODE --
<list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
</list>]]></div>

<p>Ici les trois ancêtres de <span class="balise">a</span> sont bien présent, du père de l'élément jusqu'à
l'élément racine.</p>

<h3 id="ancestor-or-self">Axe <span class="xpath">ancestor-or-self</span></h3>

<p>L'axe <span class="xpath">ancestor-or-self</span> est quasiment identique, il inclut en plus le nœud courant
dans les nœuds résultat possibles. Ainsi, en reprenant l'exemple précédent cela donne :</p>

<div class="xmlcode"><![CDATA[<racine>
  <item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
  </item>
</racine>]]></div>

<p><span class="xpath">racine/item/list/a/ancestor-or-self::*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/list/a/ancestor-or-self::*" ancestor.xml 
Found 4 nodes in ancestor.xml:
-- NODE --
<racine>
  <item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
  </item>
</racine>
-- NODE --
<item>
    <list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
    </list>
</item>
-- NODE --
<list>
      <a>Blablabla</a>
      <b>Blablabla</b>
      <c>Blablabla</c>
      <d>Blablabla</d>
</list>
-- NODE --
<a>Blablabla</a>]]></div>

<p>On obtient bien les trois ancêtres, plus le nœud courant pour l'expression
<span class="xpath">ancestor-or-self::*</span></p>

<h3 id="following-sibling">Axe <span class="xpath">following-sibling</span></h3>

<p>En plus de pouvoir avoir un père et des fils, un élément XML peut aussi avoir des frères. Que sont les frères pour un
élément XML ? Ce sont les éléments qui sont au même niveau dans l'arbre XML, donc qui ont le même père. Ainsi dans
le document suivant :</p>

<div class="xmlcode"><![CDATA[<racine>
  <item>
    <a>Blablabla</a>
    <b>Blebleble</b>
    <c>Bliblibli</c>
    <d>Blobloblo</d>
  </item>
  <item>
    <e>Blublublu</e>
    <f>Blyblybly</f>
  </item>
</racine>]]></div>

<p>les deux <span class="balise">item</span> sont frères, les éléments <span class="balise">a</span>,
<span class="balise">b</span>, <span class="balise">c</span> et <span class="balise">d</span> sont frères et enfin
<span class="balise">e</span> et <span class="balise">f</span> le sont. L'élément racine n'a évidemment pas de frère
puisqu'il est unique !</p>

<p>Pour sélectionner les frères suivants, on utilisera l'axe <span class="xpath">following-sibling</span>. Ainsi,
pour désigner les nœuds suivant <span class="balise">b</span>, qui sont <span class="balise">c</span> et
<span class="balise">d</span>, on écrira :</p>

<p><span class="xpath">racine/item/b/following-sibling::*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/b/following-sibling::*" sibling.xml 
Found 2 nodes in sibling.xml:
-- NODE --
<c>Bliblibli</c>
-- NODE --
<d>Blobloblo</d>]]></div>

<p>Si on avait voulu sélectionner seulement les frères suivant <span class="balise">d</span>, on aurait écrit :</p>

<p><span class="xpath">racine/item/b/following-sibling::d</span></p>

<h3 id="preceding-sibling">Axe <span class="xpath">preceding-sibling</span></h3>

<p>L'axe <span class="xpath">preceding-sibling</span> sélectionne quand à lui les frères précédents. Exemple :</p>

<div class="xmlcode"><![CDATA[<racine>
  <item>
    <a>Blablabla</a>
    <b>Blebleble</b>
    <c>Bliblibli</c>
    <d>Blobloblo</d>
  </item>
  <item>
    <e>Blublublu</e>
    <f>Blyblybly</f>
  </item>
</racine>]]></div>

<p><span class="xpath">racine/item/d/preceding-sibling::*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/item/d/preceding-sibling::*" sibling.xml 
Found 3 nodes in sibling.xml:
-- NODE --
<a>Blablabla</a>
-- NODE --
<b>Blebleble</b>
-- NODE --
<c>Bliblibli</c>]]></div>

<h3 id="following">Axe <span class="xpath">following</span></h3>

<p>Dans la norme XPath, les nœuds d'un document XML sont parcourus dans un ordre bien précis. En ce qui concerne les
éléments, il s'agit d'un parcours profondeur de l'arbre XML. Plus précisément, il suffit pour avoir l'ordre de parcourir le
document XML du début en suivant les tags ouvrant.</p>

<p>Comme un petit document XML vaut mieux qu'un long discours, voici un exemple (suivez l'odre alphabétique !) :</p>

<div class="xmlcode"><![CDATA[<racine>
  <a>
    <b/>
    <c>
      <d/>
      <e/>
      <f/>
    </c>
    <g/>
    <h/>
  </a>
  <i>
    <j/>
    <k/>
    <l>
      <m/>
      <n/>
      <o>
        <p>
          <q/>
        </p>
        <r/>
      </o>
    </l>
  </i>
</racine>]]></div>

<p>L'axe <span class="xpath">following</span> désigne tous les nœuds qui suivent le nœud courant dans le document XML, sans
les éléments descendant. Exemple :</p>

<p><span class="xpath">racine/descendant::k/following::*</span></p>

<div class="shell"><![CDATA[Found 7 nodes in following.xml:
-- NODE --
<l>
      <m />
      <n />
      <o>
        <p>
          <q />
        </p>
        <r />
      </o>
    </l>
-- NODE --
<m />
-- NODE --
<n />
-- NODE --
<o>
        <p>
          <q />
        </p>
        <r />
      </o>
-- NODE --
<p>
          <q />
        </p>
-- NODE --
<q />
-- NODE --
<r />]]></div>

<p>Bien sûr le joker n'est pas obligatoire, on peut spécifier le nom d'un élément.</p>

<h3 id="preceding">Axe <span class="xpath">preceding</span></h3>

<p>Vous l'aurez deviné, l'axe <span class="xpath">preceding</span> fait l'inverse de l'axe <span class="xpath">following</span>.
Il sélectionne tous les nœuds qui sont avant le nœud courant dans l'ordre d'apparition des nœuds dans le document, mais cette fois
ci sans les ancêtres. Et, logiquement, sans les descendants puisqu'ils arrivent après dans l'ordre du document. Reprenons l'exemple
précédent :</p>

<p><span class="xpath">racine/descendant::l/preceding::*</span></p>


<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "racine/descendant::l/preceding::*" following.xml 
Found 10 nodes in following.xml:
-- NODE --
<a>
    <b />
    <c>
      <d />
      <e />
      <f />
    </c>
    <g />
    <h />
  </a>
-- NODE --
<b />
-- NODE --
<c>
      <d />
      <e />
      <f />
    </c>
-- NODE --
<d />
-- NODE --
<e />
-- NODE --
<f />
-- NODE --
<g />
-- NODE --
<h />
-- NODE --
<j />
-- NODE --
<k />]]></div>

<p>Vous remarquerez qu'il n'y a ni les ancêtres (<span class="balise">i</span> et <span class="balise">racine</span> manquent)
ni les enfants.</p>

<h3 id="namespace">Axe <span class="xpath">namespace</span></h3>

<p>TODO</p>

<h3 id="nodetype">Types de nœud</h3>

<p>Chaque axe a un type de nœud primaire. Pour quasiment tous les axes, le type de nœud
primaire est l'élément. Il y a deux exceptions : l'axe <span class="xpath">namespace</span> que
nous laisserons de côté et l'axe <span class="xpath">attribute</span> dont le type de nœud primaire
est l'attribut et non pas l'élément.</p>

<p>Qu'est ce que cela implique-t-il ? Souvenez vous, une étape de localisation est de la forme :
<span class="xpath">axe::test</span>. Nous avons vu les test nommés (on donne le nom du nœud à sélectionner,
<span class="xpath">child::para</span> par exemple ou <span class="xpath">attribute::href</span>) et le joker
<span class="xpath">*</span>.</p>

<p>Et bien le type de nœud primaire est impliqué dans le type des nœuds qui seront sélectionnés par ces tests :
les nœuds sélectionnés ne seront que du type primaire de l'axe.</p>

<p>Un petit exemple pour illustrer la chose. Lorsqu'on écrit <span class="xpath">child::*</span>, seuls les éléments
fils seront sélectionnés. Exit donc les commentaires, les nœuds textuels, etc. Dans l'exemple suivant, vous voyez bien
que seuls l'élément est sélectionné. Pas les nœuds textuels (au nombre de 3), ni le commentaire.</p>

<div class="xmlcode"><![CDATA[<root>
  <p>abc <b>def</b> efg <!-- commentaire --> hij</p>
</root>]]></div>

<p>L'élément <span class="balise">p</span> a bien trois nœuds textuels comme fils :</p>

<p>Utilisons le joker pour récupérer les fils de l'élément <span class="balise">p</span> :</p>

<ul class="list-attributes">
<li>"abc "</li>
<li>" efg "</li>
<li>" hij"</li>
</ul>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/p/*" nodetype.xml 
Found 1 nodes in nodetype.xml:
-- NODE --
<b>def</b>]]></div>

<p>Seul l'unique élément a été sélectionné.</p>

<p>Il existe évidemment des tests de nœud qui permettent de récupérer tous les types possibles. Le
premier d'entre permet de récupérer les nœuds textuels : c'est <span class="xpath">text()</span>.
Ainsi, pour récupérer les nœuds textuels de l'élément <span class="balise">p</span>, on remplace le
joker par <span class="xpath">text()</span>. Cela donne :</p>

<p><span class="xpath">root/p/text()</span></p>

<p>qui est équivalent à</p>

<p><span class="xpath">root/p/child::text()</span></p>

<p>puisqu'en l'absence d'axe explicite, l'axe par défaut est l'axe <span class="xpath">child</span>.</p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/p/text()" nodetype.xml | cat -e
Found 3 nodes in nodetype.xml:
-- NODE --
abc $
-- NODE --
 efg $
-- NODE --
 hij$
]]></div>

<p>Remarquez comme les espaces ont été conservés.</p>

<p>Pour les commentaires, c'est la même chose sauf que le test s'appelle <span class="xpath">comment()</span>.
Récupérons le commentaire de l'exemple précédent :</p>

<p><span class="xpath">root/p/comment()</span></p>

<div class="xmlcode"><![CDATA[<root>
  <p>abc <b>def</b> efg <!-- commentaire --> hij</p>
</root>]]></div>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/p/comment()" nodetype.xml
Found 1 nodes in nodetype.xml:
-- NODE --
<!-- commentaire -->]]></div>

<p>Mais bon, comme vous ne devriez jamais avoir de données utiles dans les commentaires (vraiment !),
ça ne vous servira pas souvent.</p>

<p>C'est encore pareil pour les instructions de traitement (PI) avec le test
<span class="xpath">processing-instruction()</span> ou
<span class="xpath">processing-instruction("cible")</span>. Exemple :</p>

<div class="xmlcode"><![CDATA[<root>
  <p>
    <?php echo "<?php"?> echo "Coucou"?>
    <?php echo "<?"?>autre code... ?>
  </p>
</root>]]></div>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e 'root/p/processing-instruction()' nodetype.xml
Found 2 nodes in nodetype.xml:
-- NODE --
<?php echo "<?"?>php echo "Coucou"?>
-- NODE --
<?php echo "<?"?>autre code... ?>]]></div>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e 'root/p/processing-instruction("php")' nodetype.xml
Found 1 nodes in nodetype.xml:
-- NODE --
<?php echo "<?"?>php echo "Coucou"?>]]></div>

<p>Enfin, le dernier test de nœud, le plus utile sans doute, permet de sélectionner tous les
nœuds d'un axe, quelquesoit le type. C'est le test <span class="xpath">node()</span>. Soit le document
suivant qui comporte a peu près tous les types de nœuds que l'on peut rencontrer dans un
document XML :</p>

<div class="xmlcode"><![CDATA[<root>
  <p attr="un attribut">
    Du texte !
    <elt>Un élément !</elt>
    <!-- commentaire -->
    <?php echo "<?"?>php echo "Coucou"?>
  </p>
</root>]]></div>

<p>L'utilisation du test <span class="xpath">node()</span> permet de récupérer tous les fils (les $
marquent les retours à la ligne) :</p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e 'root/p/node()' nodetype.xml | cat -e
Found 7 nodes in nodetype.xml:
-- NODE --
$
    Du texte !$
    $
-- NODE --
<elt>Un M-ilM-iment !</elt>$
-- NODE --
$
    $
-- NODE --
<!-- commentaire -->$
-- NODE --
$
    $
-- NODE --
<?php echo "<?"?>php echo "Coucou"?>$
-- NODE --
$
  $]]></div>

<p>Apprenez a bien compter les nœuds textuels. Ici, il y en a 4. Les espaces, tabulations et retour
à la ligne comptent aussi !</p>

<p>Tous les fils ont été sélectionnés. Contrairement à l'attribut, mais c'est normal puisque,rappel,
l'attribut n'est pas le fils de l'élément qui le porte !</p>

<p>Parfois, vous aurez besoin de récupérer des nœuds de type différent. Par exemple, tous les éléments
et tous les commentaires. Impossible de faire ça avec ce que nous avons vu jusqu'ici. Ou alors vous
aurez besoin de rassembler en un seul ensemble de nœuds des éléments que vous ne pouvez sélectionner
en une expression. Dans ce cas, on utilise l'opérateur d'union <span class="xpath">|</span> qui
rassemble deux ou plusieurs ensembles de nœuds en un seul.</p>

<p>Prenons un cas concret : en Xslt, pour faire une copie conforme d'un nœud, il faut copier
tous ses fils et tous ses attributs. On utilise l'opérateur d'union pour rassembler les deux
ensemble de nœud comme ceci :</p>

<p><span class="xpath">child::node()|attribute::*</span></p>

<p>qui peut se réécrire :</p>

<p><span class="xpath">node()|@*</span></p>

<p>Exemple avec le fichier XML suivant :</p>

<div class="xmlcode"><![CDATA[<root>
  <p attr1="un attribut" attr2="un autre">
    <a/>
    <b/>
    <c/>
  </p>
</root>]]></div>

<p>On utilise l'expression XPath suivante :</p>

<p><span class="xpath">root/p/node()|root/p/@*</span></p>

<div class="shell"><![CDATA[tangui@deus:~$ xpath -e "root/p/node()|root/p/@*" nodetype.xml | cat -e
Found 9 nodes in nodetype.xml:
-- NODE --
 attr1="un attribut"$
-- NODE --
 attr2="un autre"$
-- NODE --
$
    $
-- NODE --
<a />$
-- NODE --
$
    $
-- NODE --
<b />$
-- NODE --
$
    $
-- NODE --
<c />$
-- NODE --
$
  $]]></div>

<div class="previouspage"><a href="xpath-intro.php" title="cours précédent">XPath : introduction</a></div>
<div class="nextpage"><a href="xpath-fonctions.php" title="cours suivant">XPath : fonctions</a></div>

</div>
<!--
<span class="attribute"></span>
<span class="balise"></span>
<span class="xpath"></span>

<div class="xmlcode"><![CDATA[]]></div>

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
