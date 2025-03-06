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
<h2>Les nouveautés de SVG 1.2</h2>

<p>Dans ce chapitre je vais vous présenter au fur et à mesure de leur implémentation les nouveatés de SVG 1.2. Principales innovations de cette version de SVG : meilleur gestion du texte et multimédia.</p>

<ul class="sommaire">
<li><a href="#texte">Gestion du texte</a></li>
<li><a href="#multimedia">Multimédia</a></li>
</ul>


<h3 id="texte">Gestion du texte</h3>

<p>Avec SVG 1.1, la gestion du texte est assez basique, le plus gros problème étant que les retours à la ligne ne sont pas gérés et il faut le faire « à la main » avec des <span class="balise">tspan</span>. SVG 1.2 introduit un nouvel élément, <span class="balise">textArea</span> qui fait ça pour nous, un peu comme le <span class="balise">p</span> de XHTML mais en plus puissant.</p>

<p>Avec SVG 1.2 Tiny, la zone du <span class="balise">textArea</span> est restreinte à un rectangle (ce qui est déjà une amélioration honorable par rapport à SVG1.1). Néanmoins il est probable que dans les profils de SVG 1.2 à venir, on puisse mettre du texte dans n’importe quelle forme et que ce texte s’adapte à cette forme.</p>

<h4>L’élément <span class="balise">textArea</span></h4>

<p><span class="balise">textArea</span> s’utilise très facilement : on renseigne les attributs <span class="attribute">x</span>, <span class="attribute">y</span>, <span class="attribute">width</span> et <span class="attribute">height</span> puis on insère le texte entre les deux balises.</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textArea.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de zones de texte textArea</title>

<rect x="50" y="50" width="300" height="200"/>

<textArea x="50" y="50" width="300" height="200">
Je suis le propriétaire de ma puissance, et je le suis quand je me sais « Unique ». Dans l’« Unique », le possesseur retourne au Rien créateur dont il est sorti. Tout Etre supérieur à moi, que ce soit Dieu, l’Homme ou l’Histoire, affaiblit le sentiment de mon unicité et ne commence à pâlir devant le soleil de cette conscience. Si je fonde ma cause sur Moi, l’Unique, elle repose alors sur son créateur éphémère et périssable qui se consomme lui-même et je puis dire : Je n’ai fondé ma cause sur rien.
</textArea>

</svg>]]></div>

<div class="csscode"><![CDATA[textArea{
	font-size:12px;
	}

rect{
	fill:none;
	stroke:black;
	stroke-width:1px;
	stroke-dasharray:2 5;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/svg1.2/textArea.svg">Utilisation de zones de texte textArea</object>
</div>

<h4>La propriété CSS <span class="csspropertie">line-increment</span></h4>

<p>Comme l’indique son nom, la propriété CSS <span class="csspropertie">line-increment</span> permet de contrôler l’espacement entre deux lignes. On peut le réduire ou l’augmenter. La valeur 0 par exemple, signifie que toutes les lignes sont collées sur la première ligne.</p>

<h4>La propriété CSS <span class="csspropertie">text-align</span></h4>

<p>La propriété CSS <span class="csspropertie">text-align</span> spécifie l’alignement par défaut du texte. Par défaut, le texte est aligné à gauche mais on peut le centrer ou l’aligner à droite. Néanmoins, on ne peut pas le justifier. Les valeurs correspondantes sont <span class="csspropertie">start</span>, <span class="csspropertie">center</span> et <span class="csspropertie">end</span>.</p>

<h4>La propriété CSS <span class="csspropertie">display-align</span></h4>

<p>Enfin, la propriété CSS <span class="csspropertie">display-align</span> permet aussi d’aligner le texte mais verticalement. Si sa valeur est <span class="csspropertie">before</span> (valeur par défaut) alors le texte est collé au bord haut du rectangle conteneur. Si sa valeur est <span class="csspropertie">after</span> alors le texte est collé au bas du conteneur. On peut enfin centrer le texte verticalement avec le mot-clé  <span class="csspropertie">center</span>. Reprenons l’exemple précédent en utilisant ces propriétés.</p>



<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="textArea2.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Utilisation de zones de texte textArea et de différentes propriétés CSS s’y appliquant</title>

<rect x="50" y="50" width="300" height="200"/>

<textArea x="50" y="50" width="300" height="200">
Je suis le propriétaire de ma puissance, et je le suis quand je me sais « Unique ».  Dans l’« Unique », le possesseur retourne au Rien créateur dont il est sorti. Tout Etre supérieur à moi, que ce soit Dieu, l’Homme ou l’Histoire, affaiblit le sentiment de mon unicité et ne commence à pâlir devant le soleil de cette conscience. Si je fonde ma cause sur Moi, l’Unique, elle repose alors sur son créateur éphémère et périssable qui se consomme lui-même et je puis dire : Je n’ai fondé ma cause sur rien.
</textArea>

</svg>
]]></div>

<div class="csscode"><![CDATA[textArea{
	font-size:12px;
	line-increment:11px;
	text-align:center;
	display-align:after;
	}

rect{
	fill:none;
	stroke:black;
	stroke-width:1px;
	stroke-dasharray:2 5;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/svg1.2/textArea2.svg">Utilisation de zones de texte textArea et de différentes propriétés CSS s’y appliquant</object>
</div>

<p>L’espace entre deux lignes est de 11 pixels, ce qui est un peu plus petit que la taille de la fonte. C’est pourquoi le texte est serré. En général, la taille par défaut entre deux ligne est 1,1 × taille de la fonte.</p>




<h3 id="multimedia">Multimédia</h3>

<p>Une des nouveautés les plus attendues de SVG 1.2 est la gestion de la vidéo et du son. Il existe bien d’autre manière d’inclure de la vidéo et du son dans vos pages. Il y a bien sûr la solution la plus horrible, Flash, la solution qui ne fonctionne jamais (<span class="balise">object</span> ou <span class="balise">embed</span>) et la nouvelle manière de faire : l’élément HTML5 <span class="balise">video</span>.</p>

<p>Néanmoins, la vidéo avec SVG permet de faire bien plus de choses. En fait, tout ce que nous avons fait précédemment s’applique au multimedia avec SVG. Dans la suite de cette partie, nous étudierons principalement l’élément <span class="balise">video</span> (de SVG, pas de cette soupe de tag qu’on nomme HTML5) mais il existe aussi un autre élément, <span class="balise">audio</span> qui sert comme son nom l’indique à incorporer du son à SVG. Seulement, on ne peut pas appliquer des filtres, des transformation, des chemins de découpe à du son… et c’est beaucoup moins fun !</p>

<p>À l’heure actuelle (Mars 2009, ou an I de la crise), seul un build d’un navigateur permet de visionner les exemples ci-dessous. Il s’agit d’un build d’Opera qui se trouve <a href="http://dev.opera.com/articles/view/a-call-for-video-on-the-web-opera-vid/#element(main/4/5)">sur cette page (section Good News)</a>. Vous devez l’installer pour pouvoir continuer sinon vous ne verez rien. Il y a trois exemples intéressants en bas de page.</p>

<h4>Les attributs de base</h4>

<p>On va donc utiliser l’élément <span class="balise">video</span> dont les attributs de base sont :</p>

<ul class="list-attributes">
<li><span class="attribute">xlink:href</span> qui fournit l’adresse de la vidéo ;</li>
<li><span class="attribute">x</span> et <span class="attribute">y</span> qui donennt l’emplacement du point haut gauche de la vidéo (comme pour les images) ;</li>
<li><span class="attribute">width</span> et <span class="attribute">height</span> qui donnent la hauteur et la largeur, la vidéo étant étirée pour tenir dans la zone que vous avez spécifiée ;</li>
<li><span class="attribute">type</span> : le type MIME de la vidéo.</li>
</ul>

<p>Quel type MIME devez-vous spécifier ? Celui de votre video. Cela dépend de son format et ici arrive une très bonne question : quel format choisir ? Ma réponse est sans hésiter : <strong>un format libre</strong> !</p>

<p>Il faut différencier trois choses lorsqu’on parle de format vidéo. Il y a bien sûr le codec vidéo qui va fournir l’image de chaque frame. Il y a aussi dans la plupart des cas un codec audio, sinon, il n’y a pas de son. Enfin, il y a ce qu’on appelle le conteneur qui va contenir les différents codecs, et il va faire ça de manière optimisé. On pourrait zipper la vidéo et l’audio de telle sorte qu’on aurait des fichiers film.zip. Seulement, il faudrait pour lire la vidéo décompresser entièrement le film (et donc le télécharger entièrement) avant de pouvoir lancer la lecture, ce qui serait une énorme perte de temps, de puissance processeur, de mémoire vive et de place sur le disque dur. C’est pourquoi on utiliser des conteneurs qui mixent les différents codecs de manière à ce la lecture puisse commencer rapidement alors même que la vidéo est en train d’être téléchargée. Et avec les conteneurs modernes, on peut avoir une piste vidéo, plusieurs pistes audios et des sous-titres en pagailles.</p>

<p>Fin de la disgression, revenons à nos moutons : quels formats choisir ? Le problème avec les codecs et les conteneurs est que la plupart ne sont pas libres, c’est à dire qu’on n’a le droit de les utiliser qu’à certaines conditions (posséder un système, paiement de royalties, etc.), ce qui n’est pas bon pour le Web. Le Web, c’est un succès car c’est ouvert. Minitel est mort car c’était fermé. C’est pourquoi je vous conseille d’utiliser les technologies de chez Xiph. Xiph est une fondation qui a produit plusieurs codecs dont : FLAC (compression audio sans perte), Vorbis (compression audio avec perte, meilleur que MP3), Speex (codec audio pour la voix) et Theora (codec vidéo). De plus ils ont aussi un conteneur qui s’appelle Ogg. Ogg peut contenir les codecs de Xiph et bien d’autres. Le meilleur compromis est selon moi l’utilisation des codecs Vorbis et Theora dans le conteneur Ogg. Il existe un tas d’outils pour produire de tels fichiers mais je n’en citerais que deux : ffmpeg2theora sous Unix en ligne de commande et VLC.</p>

<p>Ces codecs sont-ils bons, me demanderez-vous ? La réponse n’est pas simple. Vorbis est un des meilleurs codecs audio avec perte du moment. Il surpasse le MP3. Ce n’est pas la même chose pour Theora. Le H.264 est meilleur mais c’est un format fermé et breveté. Et Theora n’est pas mauvais non plus et il a un avantage sur le H.264 : il demande beaucoup moins de puissance pour être décodé, ce qui signifie, grossièrement, que le ventilateur de votre ordinateur ne tournera pas à fond quand vous lancerez une vidéo en Theora. Enfin, ces deux codecs sont reconnus nativement par plusieurs navigateurs, dont Firefox, ce qui vous assure une grande compatibilité de même qu’une bonne portabilité de vos SVG.</p>

<p>De plus, un nouveau codec libre et au sommet de l’art arrive : Dirac. Développé par la BBC, il est vraiment très prometeur.</p>

<p>Pour résumer, si je vous ai convaincu, il faut utiliser le type-mime <span class="mimeType">video/ogg</span> pour la vidéo et <span class="mimeType">audio/ogg</span> pour l’audio. Vous trouverez des informations complémentaires sur le <a href="http://wiki.xiph.org/index.php/MIME_Types_and_File_Extensions">wiki de Xiph.org</a>.</p>

<p>Après tant de parlotte, voici l’exemple tant attendu (rafraichissez la page) :</p>


<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Vidéo et SVG</title>

<video xlink:href="JasperNationalPark-AthabascaFalls.ogv"
	x="100" y="50"
	width="200" height="200"
	type="video/ogg"
	repeatDur="13s"/>

</svg>
]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/svg1.2/video.svg">Vidéo et SVG</object>
</div>

<h4>La vidéo est un élément d’animation</h4>

<p>Vous l’avez sans doute remarqué, j’ai utilisé l’attribut <span class="attribute">repeatDur</span> dans la vidéo précédente. En fait, en SVG, <span class="balise">video</span> est une balise d’animation comme les autres. Génial, non ? Du coup, vous pouvez utiliser tous les attributs d’animation : <span class="attribute">begin</span>, <span class="attribute">end</span>, <span class="attribute">dur</span>, <span class="attribute">repeatCount</span>, <span class="attribute">repeatDur</span> et d’autres que je dois oublier. De même, vous pouvez synchroniser cette vidéo avec d’autres éléments, ou d’autres éléments avec la vidéo.</p>

<p>Je vais maintenant vous parler de l’attribut <span class="attribute">transformBehavior</span>. Lorsque vous affichez une vidéo, elle est redimensionnée par rapport aux attributs <span class="attribute">width</span> et <span class="attribute">height</span>. Seulement, ce redimensionnement est coûteux en terme de puissance du processeur et on peut souhaiter interdire le redimensionnement. Dans ce cas, on utilise l’attribut <span class="attribute">transformBehavior</span> qui peut prendre quatre valeurs différentes : <span class="attribute">pinned</span>, <span class="attribute">pinned90</span>, <span class="attribute">pinned180</span> et <span class="attribute">pinned270</span>. Dans ce cas, les attributs <span class="attribute">width</span> et <span class="attribute">height</span> sont ignorés. et les attributs <span class="attribute">x</span> et <span class="attribute">y</span> détermine le centre de la vidéo. De plus, selon la valeur de l’attribut, on peut effectuer une rotation de 90, 180 ou 270 degrés. On peut se demander l’utilité d’une telle possibilité. En fait, ça peut être très utile quand la vidéo est prise par un portable ou un appareil photo qui a été tourné d’un quart de tour.</p>

<p>Dans cet exemple, avec <span class="attribute">x</span> et <span class="attribute">y</span> à la valeur <span class="attribute">50%</span>, on est sûr que la vidéo est centrée.</p>



<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet'?> type="text/css" href="video-transformBehavior.css" charset="utf-8"?>

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Vidéo et SVG</title>

<video xlink:href="JasperNationalPark-AthabascaFalls.ogv"
	id="video"
	x="50%" y="50%"
	transformBehavior="pinned90"
	type="video/ogg"
	begin="startButton.click"
	end="stopButton.click"/>

<g id="startButton">
	<text x="200" y="274">Démarrer la vidéo</text>
	<set attributeName="visibility" attributeType="CSS"
		to="hidden"
		begin="video.begin"
		end="stopButton.click"/>
</g>

<g id="stopButton" visibility="hidden">
	<text x="200" y="294">Arrêter la vidéo</text>
	<set attributeName="visibility" attributeType="CSS"
		to="visible"
		begin="video.begin"
		end="stopButton.click"/>
</g>


</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:middle;
	font-size:small;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/svg1.2/video-transformBehavior.svg">Vidéo et SVG - Attribut transformBehavior et synchronisation</object>
</div>

<h4>La vidéo avec SVG, c’est <strong>vraiment</strong> cool</h4>

<p>Comme je vous l’ai dit au début de ce chapitre, on peut appliquer tout ce qu’on a vu jusqu’à présent sur une vidéo.</p>

<p>Cela signifie que vous pouvez appliquer à une vidéo des chemins de découpe, des masques, des filtres et des transformations. Vous pouvez vous servir de vidéos pour faire des motifs. Vous pouvez réutiliser une vidéo avec <span class="balise">use</span>. Et bien sûr, vous pouvez animer tout cela. Vous voulez une vidéo qui se balade à l’écran ou qui tourne sur elle même (voire les deux en même temps) ? Pas de problème avec SVG.</p>

<p>Je sens que vous brûler d’envie d’avoir un exemple, alors le voici !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>]]>
&lt;<![CDATA[?xml-stylesheet type="text/css" href="video-effets.css" charset="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title>Vidéo et SVG</title>

<defs>
	<!-- rectangle de découpe -->
	<clipPath id="clipRect">
		<rect id="clip" x="10" y="5"
		width="208" height="192"
		rx="15" ry="15"/>
	</clipPath>

	<linearGradient id="gradient" y2="1" x2="0.5">
		<stop offset="0.5" stop-color="white" stop-opacity="0"/>
		<stop offset="1" stop-color="white" stop-opacity="0.8"/>
	</linearGradient>

	<mask id="gradMask" maskContentUnits="objectBoundingBox">
		<rect width="1" height="1" fill="url(#gradient)"/>
	</mask>

	<filter id="niveauxGris">
		<feColorMatrix in="SourceImage" type="matrix"
			values="0.3333 0.3333 0.3333 0 0
			0.3333 0.3333 0.3333 0 0
			0.3333 0.3333 0.3333 0 0
			0      0      0      1 0"/>

	</filter>

	<filter id="contour">
		<feConvolveMatrix order="3"
		kernelMatrix="1 1 1 1 -8 1 1 1 1"
		preserveAlpha="true"/>
	</filter>

	<filter id="rotation">
		<feColorMatrix id=’color’ type="hueRotate" values="100"/>
	</filter>

	<filter id="transfert" filterUnits="objectBoundingBox"
		x="0%" y="0%" width="100%" height="100%">
		<feComponentTransfer>
			<feFuncR type="table" tableValues="0 1 1 0"/>
			<feFuncG type="table" tableValues="1 1 0 0"/>
			<feFuncB type="table" tableValues="0 0 1 1"/>
		</feComponentTransfer>
	</filter>

	<circle r="4" id="circleButton"/>
</defs>

<g id="videoG">
	<use xlink:href="#clip"/>
	<video xlink:href="JasperNationalPark-AthabascaFalls.ogv"
		id="video"
		x="10" y="5"
		width="208" height="192"
		type="video/ogg"
		begin="startButton.click"
		end="stopButton.click"
		initialVisibility="always"
		filter="none"/>

	<!-- activation des différents filtres -->
	<set attributeName="filter" attributeType="XML"
		to="url(#niveauxGris)"
		begin="niveauxGrisBouton.click"
		end="contourBouton.click;rotationBouton.click;
			transfertBouton.click;aucunBouton.click"/>

	<set attributeName="filter" attributeType="XML"
		to="url(#contour)"
		begin="contourBouton.click"
		end="niveauxGrisBouton.click;rotationBouton.click;
			transfertBouton.click;aucunBouton.click"/>

	<set attributeName="filter" attributeType="XML"
		to="url(#rotation)"
		begin="rotationBouton.click"
		end="niveauxGrisBouton.click;contourBouton.click;
			transfertBouton.click;aucunBouton.click"/>

	<set attributeName="filter" attributeType="XML"
		to="url(#transfert)"
		begin="transfertBouton.click"
		end="niveauxGrisBouton.click;contourBouton.click;
			rotationBouton.click;aucunBouton.click"/>

	<set attributeName="filter" attributeType="XML"
		to="none"
		begin="aucunBouton.click"
		end="niveauxGrisBouton.click;contourBouton.click;
			rotationBouton.click;transfertBouton.click"/>
</g>

<!-- reflet -->
<use xlink:href="#videoG" transform="scale(1 -1) skewX(-40) translate(-160, -398)"
	mask="url(#gradMask)"/>


<g id="startButton">
	<text x="398" y="274">Démarrer la vidéo</text>
	<set attributeName="visibility" attributeType="CSS"
		to="hidden"
		begin="video.begin"
		end="stopButton.click"/>
</g>

<g id="stopButton" visibility="hidden">
	<text x="398" y="294">Arrêter la vidéo</text>
	<set attributeName="visibility" attributeType="CSS"
		to="visible"
		begin="video.begin"
		end="stopButton.click"/>
</g>


<!-- liste des filtres -->
<text class="title" x="300" y="40">Filtres</text>

<g id="niveauxGrisBouton" class="filtre">
	<text x="390" y="70">Niveaux de gris</text>
	<use xlink:href="#circleButton" transform="translate(293, 66)" visibility="hidden">
		<set attributeName="visibility" attributeType="XML"
			to="visible"
			begin="niveauxGrisBouton.click"
			end="transfertBouton.click;contourBouton.click;
				rotationBouton.click;aucunBouton.click"/>
	</use>
</g>

<g id="contourBouton" class="filtre">
	<text x="390" y="90">Contour</text>
	<use xlink:href="#circleButton" transform="translate(335, 86)" visibility="hidden">
		<set attributeName="visibility" attributeType="XML"
			to="visible"
			begin="contourBouton.click"
			end="niveauxGrisBouton.click;transfertBouton.click;
				rotationBouton.click;aucunBouton.click"/>
	</use>
</g>

<g id="rotationBouton" class="filtre">
	<text x="390" y="110">Rotation</text>
	<use xlink:href="#circleButton" transform="translate(334, 106)" visibility="hidden">
		<set attributeName="visibility" attributeType="XML"
			to="visible"
			begin="rotationBouton.click"
			end="niveauxGrisBouton.click;contourBouton.click;
				transfertBouton.click;aucunBouton.click"/>
	</use>
</g>

<g id="transfertBouton" class="filtre">
	<text x="390" y="130">Transfert de composante</text>
	<use xlink:href="#circleButton" transform="translate(250, 126)" visibility="hidden">
		<set attributeName="visibility" attributeType="XML"
			to="visible"
			begin="transfertBouton.click"
			end="niveauxGrisBouton.click;contourBouton.click;
				rotationBouton.click;aucunBouton.click"/>
	</use>
</g>

<g id="aucunBouton" class="filtre">
	<text x="390" y="150">Aucun</text>
	<use xlink:href="#circleButton" transform="translate(345, 146)">
		<set attributeName="visibility" attributeType="XML"
			to="hidden"
			begin="niveauxGrisBouton.click;contourBouton.click;
				rotationBouton.click;transfertBouton.click"
			end="aucunBouton.click"/>
	</use>
</g>

</svg>
]]></div>

<div class="csscode"><![CDATA[text{
	text-anchor:end;
	font-size:small;
	}

rect#clip{
	fill:none;
	stroke:black;
	stroke-width:4px;
	}

#video{
	clip-path:url(video-effets.svg#clipRect);
	}

text.title{
	text-anchor:start;
	font-size:x-large;
	}

.filtre > text{
	fill:gray;
	}

circle{
	fill:chartreuse;
	}]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/svg1.2/video-effets.svg">Vidéo et SVG avec divers effets (cliPath, transformation, filtres)</object>
</div>


<p>La vidéo est clippée dans le cadre noir. Le reflet est obtenu avec un <span class="balise">use</span>. Les filtres sont des filtres classiques.</p>

<p>Maintenant, quand on vous dira que SVG n’est pas aussi bon que Flash, montrez cet exemple !</p>


<div class="previouspage"><a href="svgdom.php" title="cours précédent">Le DOM SVG</a></div>

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
