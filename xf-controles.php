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
<h2>XForms : contrôles</h2>

<p>Ce chapitre traite des différents contrôles qu’on peut utiliser avec XForms. En plus de ceux qui existent avec les formulaires HTML, XForms en introduit de nouveaux. Ils ne sont pas tous traités ici puisque certains n’apparaissent que lorsqu’ils sont liés à un type spécifique, ce que nous verrons dans un autre chapitre.</p>

<ul class="sommaire">
<li><a href="#input">Entrée simple</a></li>
<li><a href="#secret">Champ de mot de passe</a></li>
<li><a href="#textarea">Zone de texte multiligne</a></li>
<li><a href="#output">Contrôle de sortie</a></li>
<li><a href="#select1">Sélection unique</a></li>
<li><a href="#select">Sélection multiple</a></li>
<li><a href="#selectdyn">Sélection dynamique</a></li>
<li><a href="#menudyn">Sélections dynamiques</a></li>
<li><a href="#range">Commande d’étendue</a></li>
<li><a href="#buttons">Les boutons</a></li>
</ul>

<h3 id="input">Entrée simple</h3>

<p>Le premier de ces éléments de contrôle permet d’entrer du texte dans une zone simple. On utilise l’élément <span class="balise">input</span>.</p>

<p>La valeur entrée dans ce champ de texte n’est pas contenue dans cet élément. Elle est enregistrée dans l’instance du modèle désigné. Rappelez vous que par défaut, le processeur XForms utilise le premier modèle et dans ce modèle la première instance. Pour indiquer dans quel élément on enregistre la valeur, on utilise l’attribut <span class="attribute">ref</span>. Cet attribut contient une expression XPath qui désigne le nœud dans lequel la valeur est enregistrée.</p>

<p>Il faut bien saisir que le contrôle est lié à l’élément auquel il est accroché, ce qui veut dire que l’élément de contrôle modifie le nœud en question, mais que si le nœud est modifié d’une autre manière, le contrôle réagira à ce changement et dans le cas d’une zone de texte, la valeur affichée dans le contrôle changera.</p>

<p>On inclut les différents éléments XForms dans les éléments du langage hôte, ici XHTML.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : input</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<nom/>
					<prenom/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : input</h1>
		<p><xf:input ref="nom"/></p>
		<p><xf:input ref="prenom"/></p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="application/xhtml+xml" data="xforms/contrôles/input.xhtml">Élément de contrôle XForms : input</object>
</div>

<p>Pour chaque contrôle il est possible d’y accoler un texte, un label, grâce à l’élément <span class="balise">label</span> :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : input avec label</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<nom/>
					<prenom/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : input avec label</h1>
		<p>
			<xf:input ref="nom">
				<xf:label>Nom : </xf:label>
			</xf:input>
		</p>
		<p>
			<xf:input ref="prenom">
				<xf:label>Prénom : </xf:label>
			</xf:input>
		</p>
	</body>
</html>
]]></div>

<div class="object-example xf-example">
<object type="application/xhtml+xml" data="xforms/contrôles/input-label.xhtml">Élément de contrôle XForms : input avec label</object>
</div>

<h3 id="secret">Champ de mot de passe</h3>

<p>Le contrôle de champ de mot de passe est similaire à la zone de texte, à la différence évidente que le texte entrée est cachée. Sinon, aucune différence.</p>

<p>L’élément <span class="balise">label</span> a des cousins. L’élément <span class="balise">hint</span> en est un. Il sert à donner une indication sur le contrôle dans lequel il est contenu. La plupart des processeurs XForms montrent une bulle au passage de la souris.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : secret</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<nom/>
					<prenom/>
					<motdepasse/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : secret</h1>
		<p>
			<xf:input ref="nom">
				<xf:label>Nom : </xf:label>
			</xf:input>
		</p>
		<p>
			<xf:input ref="prenom">
				<xf:label>Prénom : </xf:label>
			</xf:input>
		</p>
		<p>
			<xf:secret ref="motdepasse">
				<xf:label>Mot de passe : </xf:label>
				<xf:hint>Votre mot de passe sera caché</xf:hint>
			</xf:secret>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="application/xhtml+xml" data="xforms/contrôles/secret.xhtml">Élément de contrôle XForms : secret</object>
</div>

<p>Vous vous demandez peut être pourquoi on peut se contenter de mettre juste <span class="attribute">ref="nom"</span> et pas <span class="attribute">ref="/data/nom"</span> pour lier le contrôle à son élément d’instance (cet attribut est, je vous le rappelle, une expression XPath). En fait, le nœud contexte, le nœud sur lequel on se trouve par défaut, c’est la racine. Donc quand on écrit <span class="attribute">ref="nom"</span>, c’est le fils <span class="balise">nom</span> de la racine. Pas de problème, on désigne bien le nœud voulu.</p>


<h3 id="textarea">Zone de texte multiligne</h3>

<p>L’élément de contrôle <span class="balise">textarea</span> permet de rentrer du texte sur plusieurs lignes. Il n’existe pas, comme avec les formulaires HTML, d’attribut permettant de spécifier la taille et la largeur d’une telle zone de texte. Tout ce qui touche à la présentation est, selon la logique des langages XML modernes, relégué à CSS comme nous le verrons plus tard.</p>

<p>On utiliser ici un autre cousin de <span class="balise">label</span>, j’ai nommé <span class="balise">help</span> qui comme son nom l’indique fournit une aide sur le contrôle en cours. Reprenons notre formulaire :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : textarea</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<nom/>
					<prenom/>
					<motdepasse/>
					<dissertation>Dans l’œuvre de Nietzsche, la culture tient une place importante.	En effet,</dissertation>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : textarea</h1>
		<p>
			<xf:input ref="nom">
				<xf:label>Nom : </xf:label>
			</xf:input>
		</p>
		<p>
			<xf:input ref="prenom">
				<xf:label>Prénom : </xf:label>
			</xf:input>
		</p>
		<p>
			<xf:secret ref="motdepasse">
				<xf:label>Mot de passe : </xf:label>
				<xf:hint>Votre mot de passe sera caché</xf:hint>
			</xf:secret>
		</p>
		<p>
			<xf:textarea ref="dissertation">
				<xf:label>Veuillez entrer votre dissertation sur la culture
					chez Friedrich Nietzsche : </xf:label>
				<xf:help>Vous ne connaissez pas l’œuvre de Friedrich Nietzsche ?
					Appelez le 08 12 34 56 78 (3,5 €/min)</xf:help>
			</xf:textarea>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="application/xhtml+xml" data="xforms/contrôles/textarea">Élément de contrôle XForms : textarea</object>
</div>

<p>La zone de texte multiligne est déjà remplie, pour une raison simple : elle est liée à l’élément <span class="balise">dissertation</span> de l’instance. Or, cet élément contient déjà du texte. Comme cet élément et le contrôle sont liés, le contrôle prendra comme valeur initiale le texte contenu dans l’élément ciblé. C’est de cette manière qu’on peut préremplir un formulaire. Mieux, en chargeant une instance à partir d’un fichier, on peut préremplir un formulaire avec les informations d’un utilisateur loggé. Il suffit d’écrire quelquechose comme ceci sur l’élément <span class="balise">instance</span> adéquat : <span class="attribute">src="preremplir.php"</span> en s’assurant que le script envoie bien un document XML, qui servira d’instance.</p>

<h3 id="output">Contrôle de sortie</h3>

<p>Un des contrôle XForms qui n’existe pas avec les formulaires HTML, c’est le contrôle de sortie. Il permet d’afficher le texte (ou plus) contenu dans un nœud. On peut utiliser l’attribut <span class="attribute">ref</span>. <strong>Mais</strong>, on peut aussi utiliser l’attribut <span class="attribute">value</span> destinée à contenir une expression XPath qui sera calculée et dont le résultat sera affichée en sortie.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : output</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<nom/>
					<prenom/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : output</h1>
		<p>
			<xf:input ref="nom">
				<xf:label>Nom : </xf:label>
			</xf:input>
			<xf:input ref="prenom">
				<xf:label>Prénom : </xf:label>
			</xf:input>
		</p>
		<p>
			<xf:output value="concat(prenom, ' ', nom)">
				<xf:label>Vous vous appelez </xf:label>
			</xf:output>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="application/xhtml+xml" data="xforms/contrôles/output.xhtml">Élément de contrôle XForms : output</object>
</div>

<p>En testant cet exemple, vous avez du remarquer que la sortie ne se met à jour que lorsque les zones de texte perdent le focus. On peut remédier à ce problème avec l’attribut <span class="attribute">incremental="true"</span> (à placer sur le contrôle) qui va provoquer la mise à jour du modèle à chaque entrée de l’utilisateur. Il est utilisable sur tous la plupart des contrôles (ceux qui servent à chosir ou modifier une valeur).</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : output</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<nom/>
					<prenom/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : output</h1>
		<p>
			<xf:input ref="nom" incremental="true">
				<xf:label>Nom : </xf:label>
			</xf:input>
			<xf:input ref="prenom" incremental="true">
				<xf:label>Prénom : </xf:label>
			</xf:input>
		</p>
		<h2>Sortie</h2>
		<p>
			<xf:output value="concat(prenom, ' ', nom)">
				<xf:label>Vous vous appelez </xf:label>
			</xf:output>
		</p>
	</body>
</html>
]]></div>

<div class="object-example xf-example">
<object type="application/xhtml+xml" data="xforms/contrôles/output-incremental.xhtml">Élément de contrôle XForms : output</object>
</div>

<h3 id="select1">Sélection unique</h3>

<p>XForms met l’accent sur la sémantique comme nous allons le voir avec les contrôles de sélection.</p>

<p>Pour avoir un contrôle permettant la sélection unique, XForms met à notre disposition l’élément <span class="balise">select1</span>, qui accepte bien entendu un label avec l’élément <span class="balise">label</span>.</p>

<p>On place dans l’élément <span class="balise">select1</span> les différentes entrées avec l’élément <span class="balise">item</span>. Chaque <span class="balise">item</span> peut avoir deux enfants, un label (élément <span class="balise">label</span>) qui sera utilisé pour le texte de l’entrée et la valeur associée (élément <span class="balise">value</span>) qui elle sera associée à l’instance si l’entrée est sélectionnée. Le label est donc juste là pour la présentation.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : sélection unique</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<selection/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : sélection unique</h1>
		<p>
			<xf:select1 ref="selection">
				<xf:label>Mois</xf:label>
				<xf:item>
					<xf:label>Janvier</xf:label>
					<xf:value>jan</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Février</xf:label>
					<xf:value>fev</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mars</xf:label>
					<xf:value>mar</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Avril</xf:label>
					<xf:value>avr</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mai</xf:label>
					<xf:value>mai</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juin</xf:label>
					<xf:value>jui</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juillet</xf:label>
					<xf:value>jil</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Août</xf:label>
					<xf:value>aou</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Septembre</xf:label>
					<xf:value>sep</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Octobre</xf:label>
					<xf:value>oct</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Novembre</xf:label>
					<xf:value>nov</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Décembre</xf:label>
					<xf:value>dec</xf:value>
				</xf:item>
			</xf:select1>
		</p>
		<p>
			<xf:output ref="selection">
				<xf:label>Sélection : </xf:label>
			</xf:output>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/select1.xhtml">Élément de contrôle XForms : sélection unique</object>
</div>

<p>Avec les formulaires HTML classiques, on devaient utiliser différents éléments pour faire une sélection unique selon le rendu que l’on voulait avoir. Avec XForms, c’est l’attribut <span class="attribute">appearance</span> qui détermine l’apparence du contrôle. On peut ainsi avoir au choix une liste déroulante ou des boutons radio. Chaque implémentation peut afficher les contrôles d’une manière différente. Ce qui est important, c’est donc la sémantique : on utilise <span class="attribute">minimal</span> lorsqu’on veut que le contrôle prenne le moins de place et <span class="attribute">full</span> si on veut au contraire qu’il soit étendu. Entre les deux, on a la valeur <span class="attribute">compact</span>. Au final, les données récoltées sont de toute façon les mêmes. Il faut parfois savoir lâcher prise sur l’interface utilisateur…</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : sélection unique (différents affichages)</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<selection>aou</selection>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : sélection unique (différents affichages)</h1>
		<p>
			<xf:select1 ref="selection"
				appearance="minimal">
				<xf:label>Mois</xf:label>
				<xf:item>
					<xf:label>Janvier</xf:label>
					<xf:value>jan</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Février</xf:label>
					<xf:value>fev</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mars</xf:label>
					<xf:value>mar</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Avril</xf:label>
					<xf:value>avr</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mai</xf:label>
					<xf:value>mai</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juin</xf:label>
					<xf:value>jui</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juillet</xf:label>
					<xf:value>jil</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Août</xf:label>
					<xf:value>aou</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Septembre</xf:label>
					<xf:value>sep</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Octobre</xf:label>
					<xf:value>oct</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Novembre</xf:label>
					<xf:value>nov</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Décembre</xf:label>
					<xf:value>dec</xf:value>
				</xf:item>
			</xf:select1>
		</p>
		<p>
			<xf:select1 ref="selection"
				appearance="compact">
				<xf:label>Mois</xf:label>
				<xf:item>
					<xf:label>Janvier</xf:label>
					<xf:value>jan</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Février</xf:label>
					<xf:value>fev</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mars</xf:label>
					<xf:value>mar</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Avril</xf:label>
					<xf:value>avr</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mai</xf:label>
					<xf:value>mai</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juin</xf:label>
					<xf:value>jui</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juillet</xf:label>
					<xf:value>jil</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Août</xf:label>
					<xf:value>aou</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Septembre</xf:label>
					<xf:value>sep</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Octobre</xf:label>
					<xf:value>oct</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Novembre</xf:label>
					<xf:value>nov</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Décembre</xf:label>
					<xf:value>dec</xf:value>
				</xf:item>
			</xf:select1>
		</p>
		<p>
			<xf:select1 ref="selection"
				appearance="full">
				<xf:label>Mois</xf:label>
				<xf:item>
					<xf:label>Janvier</xf:label>
					<xf:value>jan</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Février</xf:label>
					<xf:value>fev</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mars</xf:label>
					<xf:value>mar</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Avril</xf:label>
					<xf:value>avr</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Mai</xf:label>
					<xf:value>mai</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juin</xf:label>
					<xf:value>jui</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Juillet</xf:label>
					<xf:value>jil</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Août</xf:label>
					<xf:value>aou</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Septembre</xf:label>
					<xf:value>sep</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Octobre</xf:label>
					<xf:value>oct</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Novembre</xf:label>
					<xf:value>nov</xf:value>
				</xf:item>
				<xf:item>
					<xf:label>Décembre</xf:label>
					<xf:value>dec</xf:value>
				</xf:item>
			</xf:select1>
		</p>
		<p>
			<xf:output ref="selection">
				<xf:label>Sélection : </xf:label>
			</xf:output>
		</p>
	</body>
</html>
]]></div>

<div class="object-example xf-example" style="height:40em">
<object type="image/svg+xml" data="xforms/contrôles/select1-appearance.xhtml">Élément de contrôle XForms : sélection unique (différents affichages)</object>
</div>

<p>Lorsqu’on sélectionne une entrée dans un des trois contrôles, les autres sont mis à jour automatiquement. Cela illustre bien comment le modèle met à jour les vues qui sont liées aux mêmes données.</p>

<h3 id="select">Sélection multiple</h3>

<p>Il est aussi possible de demander à l’utilisateur de sélectionner plusieurs entrées dans une liste. On utilise dans ce cas le contrôle <span class="balise">select</span>.</p>

<p>Mais dans ce cas, comment sont collectées les données ? Qu’obtient-on au final dans l’instance ? C’est simple : le nœud relié à un tel contrôle reçoit la liste des valeurs des entrées sélectionnées, les valeurs étant séparées par des espaces. C’est pourquoi les valeurs ne <strong>doivent</strong> pas contenir d’espaces.</p>

<p>Comme pour les formulaires HTML, il est possible de grouper les différentes entrées. XForms permet cela en entourant les groupes d’entrées (<span class="balise">item</span>) avec l’élément <span class="balise">choices</span>. Comme toujours, la valeur textuelle du groupe est donnée par l’élément <span class="balise">label</span>. (Cet élément est aussi utilisable pour une sélection simple avec l’élément <span class="balise">select1</span>.)</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : sélection multiple (différents affichages)</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<selection>jan fev mar</selection>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : sélection multiple (différents affichages)</h1>
		<p>
			<xf:select ref="selection"
				appearance="minimal">
				<xf:label>Mois</xf:label>
				<xf:choices>
					<xf:label>Premier trimestre</xf:label>
					<xf:item>
						<xf:label>Janvier</xf:label>
						<xf:value>jan</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Février</xf:label>
						<xf:value>fev</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Mars</xf:label>
						<xf:value>mar</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Second trimestre</xf:label>
					<xf:item>
						<xf:label>Avril</xf:label>
						<xf:value>avr</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Mai</xf:label>
						<xf:value>mai</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Juin</xf:label>
						<xf:value>jun</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Troisième trimestre</xf:label>
					<xf:item>
						<xf:label>Juillet</xf:label>
						<xf:value>jui</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Août</xf:label>
						<xf:value>aou</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Septembre</xf:label>
						<xf:value>sep</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Quatrième trimestre</xf:label>
					<xf:item>
						<xf:label>Octobre</xf:label>
						<xf:value>oct</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Novembre</xf:label>
						<xf:value>nov</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Décembre</xf:label>
						<xf:value>dec</xf:value>
					</xf:item>
				</xf:choices>
			</xf:select>
		</p>
		<p>
			<xf:select ref="selection"
				appearance="compact">
				<xf:label>Mois</xf:label>
				<xf:choices>
					<xf:label>Premier trimestre</xf:label>
					<xf:item>
						<xf:label>Janvier</xf:label>
						<xf:value>jan</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Février</xf:label>
						<xf:value>fev</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Mars</xf:label>
						<xf:value>mar</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Second trimestre</xf:label>
					<xf:item>
						<xf:label>Avril</xf:label>
						<xf:value>avr</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Mai</xf:label>
						<xf:value>mai</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Juin</xf:label>
						<xf:value>jun</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Troisième trimestre</xf:label>
					<xf:item>
						<xf:label>Juillet</xf:label>
						<xf:value>jui</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Août</xf:label>
						<xf:value>aou</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Septembre</xf:label>
						<xf:value>sep</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Quatrième trimestre</xf:label>
					<xf:item>
						<xf:label>Octobre</xf:label>
						<xf:value>oct</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Novembre</xf:label>
						<xf:value>nov</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Décembre</xf:label>
						<xf:value>dec</xf:value>
					</xf:item>
				</xf:choices>
			</xf:select>
		</p>
		<p>
			<xf:select ref="selection"
				appearance="full">
				<xf:label>Mois</xf:label>
				<xf:choices>
					<xf:label>Premier trimestre</xf:label>
					<xf:item>
						<xf:label>Janvier</xf:label>
						<xf:value>jan</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Février</xf:label>
						<xf:value>fev</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Mars</xf:label>
						<xf:value>mar</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Second trimestre</xf:label>
					<xf:item>
						<xf:label>Avril</xf:label>
						<xf:value>avr</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Mai</xf:label>
						<xf:value>mai</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Juin</xf:label>
						<xf:value>jun</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Troisième trimestre</xf:label>
					<xf:item>
						<xf:label>Juillet</xf:label>
						<xf:value>jui</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Août</xf:label>
						<xf:value>aou</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Septembre</xf:label>
						<xf:value>sep</xf:value>
					</xf:item>
				</xf:choices>
				<xf:choices>
					<xf:label>Quatrième trimestre</xf:label>
					<xf:item>
						<xf:label>Octobre</xf:label>
						<xf:value>oct</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Novembre</xf:label>
						<xf:value>nov</xf:value>
					</xf:item>
					<xf:item>
						<xf:label>Décembre</xf:label>
						<xf:value>dec</xf:value>
					</xf:item>
				</xf:choices>
			</xf:select>
		</p>
		<p>
			<xf:output ref="selection">
				<xf:label>Sélection : </xf:label>
			</xf:output>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example" style="height:50em">
<object type="image/svg+xml" data="xforms/contrôles/select.xhtml">Élément de contrôle XForms : sélection multiple (différents affichages)</object>
</div>

<p>Voyez ici les différentes apparences possibles, qui dépendent de votre processeur XForms.</p>

<p>On a préselectionné trois entrées en écrivant</p>

<div class="xmlcode"><![CDATA[<data xmlns="">
	<selection>jan fev mar</selection>
</data>]]></div>

<p>dans l’instance.</p>



<h3 id="selectdyn">Sélection dynamique</h3>

<p>Cette manière de faire a plusieurs défauts : elle retourne un résultat plus difficilement traitable (une liste de valeur séparée par des espaces, ce n’est pas très XML), les valeurs ne peuvent pas contenir d’espace et, surtout, elle est rigide dans le sens ou les valeurs possibles sont codés en dur dans le document.</p>

<p>Évidemment, il existe un moyen de créer des sélections dont les entrées sont dynamiques avec XForms. Au lieu d’indiquer en dur les différentes valeurs, on utilise l’élément <span class="balise">itemset</span> qui va jouer le rôle de générateur de valeurs à partir de données contenus dans un modèle et qui se place comme fils de <span class="balise">select</span> ou <span class="balise">select1</span>. Son attribut <span class="attribute">nodeset</span> désigne l’ensemble de nœud qui va servir de base pour la liste. C’est un comme si <span class="balise">itemset</span> générait une liste d’<span class="balise">item</span>.</p>

<p>Et comme pour les sélections précédentes, on utilise les éléments <span class="balise">label</span> (qui correspond au texte affiché dans la liste) et <span class="balise">value</span> (qui correspond à la valeur de l’entrée) avec l’attribut <span class="attribute">ref</span> pour référencer le nœud à lier. Mais attention, la valeur n’est plus condmanée à être une chaîne de caractère sans espaces. La valeur peut maintenant être un élément XML. Ainsi, avec <span class="balise">itemset</span>, une sélection de plusieurs élément ne donnera plus une liste de valeurs dans le modèle mais un ensemble d’éléments, ce qui est plus dans l’esprit de XML.</p>

<p>L’exemple suivant contient plusieurs instances. Pour préciser l’instance qu’on désire utiliser, on utilise la fonction XPath <span class="xpath">instance('id de l’instance')</span> qui renvoie la racine de l’instance désignée. Ici, on a une instance pour les données servant dans la liste de sélection et une instance pour stocker le résultat.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : sélection dynamique</title>
		<xf:model id="modele">
			<xf:instance id="jours">
				<jours xmlns="">
					<jour>Lendi</jour>
					<jour>Mordi</jour>
					<jour>Credi</jour>
					<jour>Joudi</jour>
					<jour>Dredi</jour>
					<jour>Sadi</jour>
					<jour>Gromanche</jour>
				</jours>
			</xf:instance>

			<xf:instance id="resultat">
				<data xmlns=""/>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : sélection dynamique</h1>
		<p>
			<xf:select ref="instance('resultat')" appearance="full">
				<xf:label>Jour d’arrivée au Groland : </xf:label>
				<xf:itemset nodeset="instance('jours')/jour">
					<xf:label ref="./text()"/>
					<xf:value ref="."/>
				</xf:itemset>
			</xf:select>
		</p>
		<p>
			<xf:output ref="instance('resultat')">
				<xf:label>Sélection : </xf:label>
			</xf:output>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/select-dynamique.xhtml">Élément de contrôle XForms : sélection dynamique</object>
</div>

<p>On sélectionne uniquement le texte pour le label, mais le nœud entier pour la valeur. Ne vous trompez pas : même si la valeur de sortie est une liste séparée par des espaces blancs, l’instance <span class="attribute">resultat</span> contient bien les éléments XML, par exemple comme ceci :</p>

<div class="xmlcode"><![CDATA[<data>
	<jour>Joudi</jour>
	<jour>Dredi</jour>
	<jour>Sadi</jour>
</data>]]></div>

<p>C’est une fonctionnalité très puissante quand on la couple à l’utilisation de l’attribut <span class="attribute">src</span> des instances. Voici comment on charge la liste des pays ISO avec XForms :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : sélection dynamique</title>
		<xf:model id="modele">
			<xf:instance id="pays" src="../iso_3166-1_list_fr.xml"/>

			<xf:instance id="resultat">
				<data xmlns=""/>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : sélection dynamique</h1>
		<p>
			<xf:select1 ref="instance('resultat')">
				<xf:label>Pays : </xf:label>
				<xf:itemset nodeset="instance('pays')/ISO_3166-1_Entry">
					<xf:label ref="ISO_3166-1_Country_name/text()"/>
					<xf:value ref="ISO_3166-1_Alpha-2_code"/>
				</xf:itemset>
			</xf:select1>
		</p>
		<p>
			<xf:output ref="instance('resultat')">
				<xf:label>Pays : </xf:label>
			</xf:output>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/select-pays.xhtml">Élément de contrôle XForms : sélection dynamique</object>
</div>

<h3 id="menudyn">Sélections dynamiques</h3>

<p>On peut se servir de l’élément <span class="balise">itemset</span> pour créer des sélections dynamiques, dont l’une est modifiée selon la valeur sélectionnée dans une autre. L’idée est de charger un structure sous forme arborescente :</p>

<div class="xmlcode"><![CDATA[<jours>
	<jour nom="Lendi">
		<moment>le matin</moment>
		<moment>après manger</moment>
		<moment>avant le dodo</moment>
	</jour>
	<jour nom="Mordi">
		<moment>avant midi</moment>
		<moment>après midi</moment>
		<moment>avant minuit</moment>
	</jour>
	<jour nom="Credi">
		<moment>le jour</moment>
		<moment>la nuit</moment>
	</jour>
	<jour nom="joudi">
		<moment>pendant les dessins animés</moment>
		<moment>pendant télé-matin</moment>
		<moment>pendant motus</moment>
		<moment>pendant le JT</moment>
		<moment>pendant la météo</moment>
	</jour>
	<jour nom="Dredi">
		<moment>jamais</moment>
	</jour>
	<jour nom="Sadi">
		<moment>au bon moment</moment>
		<moment>au mauvais moment</moment>
	</jour>
</jours>]]></div>

<p>(Il sagit évidemment des jours de la semaine grolandaise.) On va d’abord créer une première liste à partir des attributs <span class="attribute">nom</span>. La sélection sera stockée dans une instance séparée. Ensuite, une seconde liste prendra en compte le résultat de cet dernière instance pour créer une liste à partir des nœuds de l’élément <span class="balise">jour</span> sélectionné.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms">
	<head>
		<title>Élément de contrôle XForms : sélection dynamique</title>
		<xf:model id="modele">
			<xf:instance id="jours">
				<jours xmlns="">
					<jour nom="Lendi">
						<moment>le matin</moment>
						<moment>après manger</moment>
						<moment>avant le dodo</moment>
					</jour>
					<jour nom="Mordi">
						<moment>avant midi</moment>
						<moment>après midi</moment>
						<moment>avant minuit</moment>
					</jour>
					<jour nom="Credi">
						<moment>le jour</moment>
						<moment>la nuit</moment>
					</jour>
					<jour nom="joudi">
						<moment>pendant les dessins animés</moment>
						<moment>pendant télé-matin</moment>
						<moment>pendant motus</moment>
						<moment>pendant le JT</moment>
						<moment>pendant la météo</moment>
					</jour>
					<jour nom="Dredi">
						<moment>jamais</moment>
					</jour>
					<jour nom="Sadi">
						<moment>au bon moment</moment>
						<moment>au mauvais moment</moment>
					</jour>
				</jours>
			</xf:instance>

			<xf:instance id="resultat">
				<data xmlns="">
					<jour/>
					<moment/>
				</data>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : sélection dynamique</h1>
		<p>
			<xf:select1 ref="instance('resultat')/jour">
				<xf:label>Jour d’arrivée au Groland : </xf:label>
				<xf:itemset nodeset="instance('jours')/jour">
					<xf:label ref="@nom"/>
					<xf:value ref="@nom"/>
				</xf:itemset>
			</xf:select1>
		</p>		<p>
			<xf:select1 ref="instance('resultat')/moment">
				<xf:label>Vous arriverez : </xf:label>
				<xf:itemset nodeset="instance('jours')/jour[@nom = instance('resultat')/jour]/moment">
					<xf:label ref="./text()"/>
					<xf:value ref="."/>
				</xf:itemset>
			</xf:select1>
		</p>
		<p>
			<xf:output value="concat(instance('resultat')/jour, ' ', instance('resultat')/moment)">
				<xf:label>Arrivée le </xf:label>
			</xf:output>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/menu-sousmenu.xhtml">Élément de contrôle XForms : sélection dynamique</object>
</div>

<p>C’est le rôle de l’expression XPath <span class="xpath">instance('jours')/jour[@nom = instance('resultat')/jour]/moment</span> qui sélectionne les éléments <span class="balise">moment</span> de l’élément <span class="balise">jour</span> porte l’attribut <span class="attribute">nom</span> qui a la valeur de la liste de sélection précédente.</p>

<p>Ce formulaire a deux défauts : le résultat contenu dans l’élément <span class="xpath">instance('resultat')/moment</span> n’est pas remis à zéro lorsqu’on change de jour, et on voudrait que le premier élément soit automatiquement sélectionné. Nous verrons plus tard comment réaliser ceci.</p>

<p>Voici comment on peut en quelques balises et deux ou trois expressions XPath se passer de Javascript. La logique vous viendra progressivement, mais vous vous surprendrez à trouver des astuces qui vous éviteront d’avoir recours à des scripts.</p>

<h3 id="range">Commande d’étendue</h3>

<p>La commande d’étendue est une nouveauté de XForms. Elle permet de sélectionner une valeur entre deux bornes. Elle peut être utilisées pour des nombres et pour des dates, mais nous traiterons ici le cas de nombres (nous verrons la suite dans le chapitre sur le typage).</p>

<p>L’élément <span class="balise">range</span> a trois attributs qui permettent de contrôler l’étendue : <span class="attribute">start</span> et <span class="attribute">end</span> qui indiquent les valeurs de début et de fin de la commande d’étendue, et <span class="attribute">step</span> (optionel) qui donne le pas pour la sélection. Testons avec et sans ce dernier attribut :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms"
	xmlns:xs="http://www.w3.org/2001/XMLSchema">
	<head>
		<title>Élément de contrôle XForms : range</title>
		<xf:model>
			<xf:instance>
				<data xmlns="" largeur="60" hauteur="10"/>
			</xf:instance>
			<xf:bind nodeset="@largeur" type="xs:decimal"/>
			<xf:bind nodeset="@hauteur" type="xs:decimal"/>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : range</h1>
		<p>
			<xf:range ref="@largeur"
				start="0" end="200" step="20">
				<xf:label>Largeur : </xf:label>
			</xf:range>
		</p>
		<p>
			<xf:range ref="@hauteur" incremental="true"
				start="50" end="150">
				<xf:label>Hauteur : </xf:label>
			</xf:range>
		</p>
		<p>
			<xf:output ref="@largeur">
				<xf:label>Largeur : </xf:label>
			</xf:output>
			<xf:output ref="@hauteur">
				<xf:label>, hauteur : </xf:label>
			</xf:output>
		</p>
	</body>
</html>
]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/range.xhtml">Élément de contrôle XForms : range</object>
</div>

<p>Dans cet exemple encore on donne des valeurs par défaut aux données que l’on veut collecter.</p>

<p>Vous avez surement tiqué sur le</p>

<div class="xmlcode"><![CDATA[<xf:bind nodeset="@largeur" type="xs:decimal"/>
<xf:bind nodeset="@hauteur" type="xs:decimal"/>
]]></div>

<p>Ces éléments sont obligatoires mais je ne peux pas vous en dire plus pour le moment. Sachez seulement que deux sortes de type sont acceptés : des types numérique et des types de date. Plus de détails dans le chapitre sur le typage.</p>

<h3 id="buttons">Les boutons</h3>

<p>Voici un titre assez générique pour finir la présentation basique (car sans typage) des contrôles de XForms.</p>

<h4>Envoi de fichier</h4>

<p>Le contrôle d’envoi de fichier est obtenu grâce à l’élément <span class="balise">upload</span>. Le fichier sera stocké comme les données textuelles dans le balisage de l’instance.</p>

<p>Son attribut <span class="attribute">mediatype</span> permet de restreindre les types de fichier acceptés, en y indiquant la liste des types mimes séparés par des espaces. On peut donc n’accepter que les fichiers audio (<span class="attribute">audio/*</span>), que les vidéos (<span class="attribute">video/*</span>), que les images, etc. Dans l’exemple suivant, on n’accepte que les images PNG et SVG.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms"
	xmlns:xs="http://www.w3.org/2001/XMLSchema">
	<head>
		<title>Élément de contrôle XForms : upload</title>
		<xf:model>
			<xf:instance>
				<data xmlns="">
					<image/>
				</data>
			</xf:instance>
			<xf:bind nodeset="image" type="xs:base64Binary"/>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : upload</h1>
		<p>
			<xf:upload ref="image"
				mediatype="image/png image/svg+xml">
				<xf:label>Image à envoyer : </xf:label>
			</xf:upload>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/upload.xhtml">Élément de contrôle XForms : upload</object>
</div>

<p>Si votre processeur XForms est bon, vous devriez ne pouvoir sélectionner que des fichiers SVG et PNG. Pour la ligne <span class="balise"><![CDATA[<xf:bind nodeset="image" type="xs:base64Binary"/>]]></span>, une fois encore je vous en expliquerais le sens dans le chapitre taitant du typage.</p>

<h4>Déclencheur</h4>

<p>Vous pouvez afficher un bouton qui servira à déclencher une action (encore une fois, c’est traité dans une chapitre suivant) avec l’élément <span class="balise">trigger</span>. Il n’est pas lié à un élément d’une instance puisqu’il ne permet pas de modifier ou d’entrer une donnée. Son utilisation est simplissime :</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms"
	xmlns:xs="http://www.w3.org/2001/XMLSchema">
	<head>
		<title>Élément de contrôle XForms : trigger</title>
		<xf:model>
			<xf:instance>
				<data xmlns=""/>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : trigger</h1>
		<p>
			<xf:trigger ref="/" appearance="minimal">
				<xf:label>Cliquez moi !</xf:label>
			</xf:trigger>
		</p>
		<p>
			<xf:trigger ref="/" appearance="compact">
				<xf:label>Cliquez moi !</xf:label>
			</xf:trigger>
		</p>
		<p>
			<xf:trigger ref="/" appearance="full">
				<xf:label>Cliquez moi !</xf:label>
			</xf:trigger>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/trigger.xhtml">Élément de contrôle XForms : trigger</object>
</div>

<p>Même si l’apparence est variable d’une implémentation à l’autre, on a le plus souvent avec <span class="attribute">appareance="minimal"</span> un déclencheur qui ressemble à un lien.</p>

<h4>Contrôle de soumission</h4>

<p>Pour finir, voici le bouton qui sert à soumettre un formulaire : <span class="balise">submit</span>. Son apparence est la même que pour le déclencheur dans la plupart des cas.</p>

<div class="xmlcode"><![CDATA[<html xmlns="http://www.w3.org/1999/xhtml"
	xmlns:xf="http://www.w3.org/2002/xforms"
	xmlns:xs="http://www.w3.org/2001/XMLSchema">
	<head>
		<title>Élément de contrôle XForms : submit</title>
		<xf:model>
			<xf:instance>
				<data xmlns=""/>
			</xf:instance>
		</xf:model>
	</head>
	<body>
		<h1>Élément de contrôle XForms : submit</h1>
		<p>
			<xf:submit appearance="minimal">
				<xf:label>Cliquez moi !</xf:label>
			</xf:submit>
		</p>
		<p>
			<xf:submit appearance="compact">
				<xf:label>Cliquez moi !</xf:label>
			</xf:submit>
		</p>
		<p>
			<xf:submit appearance="full">
				<xf:label>Cliquez moi !</xf:label>
			</xf:submit>
		</p>
	</body>
</html>]]></div>

<div class="object-example xf-example">
<object type="image/svg+xml" data="xforms/contrôles/submit.xhtml">Élément de contrôle XForms : submit</object>
</div>

<p>Une chose manque : comment soumettre réellement ses données ? C’est l’objet du prochain chapitre et soyez sûr qu’il vous réserve quelques surprises…</p>

<div class="previouspage"><a href="xf-model.php" title="cours précédent">XForms : modèle</a></div>
<!--<div class="nextpage"><a href="xf-soumission.php" title="cours suivant">Soumettre ses données</a></div>-->

</div>
<!--
<span class="attribute"></span>
<span class="balise"></span>
<span class="xpath"></span>

<div class="xmlcode"><![CDATA[
]]></div>

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
