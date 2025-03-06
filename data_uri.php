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
<h2>Les URI data:</h2>

<p>Les URI sont à la base d’internet. Pourtant, force est de constater qu’on ne sait en général pas ce que c’est. On sait juste, en gros, que ça commence par <code>http://…</code>. Ce qui est faux ! Il existe en fait plein de types d’URI, ou plutôt de plans d’URI. Mais qu’est ce qu’une URI au juste ?</p>

<p>URI signifie <span xml:lang="en" style="font-style:italic">Uniform Resource Identifier</span>, ce qui donne en français : <span style="font-style:italic">identifiant uniforme de ressource</span>. Ce qui ne nous dit toujours pas ce que c’est. En simplifiant, on peut dire qu’une URI est une chaîne de caractère qui permet de localiser quelquechose.</p>

<p>L’<acronym title="Uniform Ressource Locator">URL</acronym> est sans doute la plus connue des URI. Mais il en existe d’autres, dont voici des exemples :</p>

<ul class="list-attributes">
<li><code>http://svground.free.fr</code> est une URL classique, localisant un site Web ;</li>
<li><code>ftp://u402639-favoris:motdepasse@tangui.net/favoris.xml</code> pointe vers mes anciens favoris, mais avec le protocole FTP ;</li>
<li><code>mailto:tangui.lepense@free.fr</code> pour m’écrire un mail ;</li>
<li><code>xmpp:Tangui@im.apinc.org</code> pour me joindre sur messagerie instantanée (forcément Jabber ;)) ;</li>

<li><code>file:///home/multimedia/musique/Daft%20Punk/Discovery/Voyager.mp3</code> histoire de décompresser avec de la bonne musique stockée localement sur le disque dur ;
</li>
<li><code>urn:isbn:2290332518</code> est la référence d’un (très bon) livre.</li>
</ul>

<p>Parfois, même, on ne connaît pas si bien les URI qu’on croit connaître. <code>http://wam:zyg@site.tv:342/?a=%20a&amp;join#42</code> est une URI http valide… Vraiment !</p>

<p>On l’a vu, une URI sert à localiser, ou tout du moins à décrire de manière unique une ressource. C’est en quelque sorte une adresse.</p>

<p>Sauf qu’avec une URI data:, c’est un peu spécial. En fait, ce plan ne sert pas à localiser une ressource, mais <em>est</em> cette ressource. Pas moins que ça !</p>

<p>Toutes les données de la ressource que l’URI data: décrit se trouve dans celle-ci. Ainsi, plus besoin d’aller chercher cette ressource, en se connectant et en récupérant un fichier par exemple, la ressource est déjà là ! Et ça fonctionne quel que soit le type de ressource : images, textes, fichiers audios, etc. Pas de différences entre fichiers binaires et fichiers textes : tous deux sont acceptés dans les URI data:.</p>

<p>Les URI data: ont cette forme : <code>data:[&lt;type-mime&gt;[;base64],]&lt;données></code> où :</p>

<ul class="list-attributes">
<li><code>type-mime</code> est le type mime de la ressource. C’est un argument optionnel, et la valeur par défaut est <code>plain/text;charset=US-ASCII</code>. Une valeur pas très intéressante donc, à l’heure d’Unicode ;</li>
<li>la chaîne <code>;base64</code>, est elle aussi optionnelle, nous y reviendrons ;</li>
<li>enfin, après la virgule, les données de notre ressource, au format texte bien sûr.</li>
</ul>

<p>Mais avant tout, il faut savoir que les URI respectent des règles de syntaxe. Ainsi, <code>http://truc.com/dossier 1/</code> n’est pas correcte car elle contient une espace. Alors comment faire pour introduire dans notre plan d’URI data: des données susceptibles de contenir des espaces blanc ? C’est simple, il suffit de les remplacer ces caractères dits illégaux par des caractères autorisés, en précisant bien sur qu’on a fait ces substitutions.</p>

<p>La première solution consiste à appliquer l’algorithme <a href="http://fr.wikipedia.org/wiki/Base64">base64</a> à notre document. C’est ce qu’indique la présence du <code>;base64</code>. Lisez l’article de wikipédia pour en savoir plus. Il existe une fonction PHP, <a href="http://fr3.php.net/manual/fr/function.base64-encode.php">base64_encode</a> qui sait faire le boulot.</p>

<p>Mais que se passe-t-il, me direz vous, si on ne met pas ce paramêtre ? Et bien c’est l’algorithme habituel de remplacement des caractères illégaux dans les URI qui doit être appliqué. C’est par exemple cet algorithme qui tranforme l’espace en la chaîne <code>%20</code>. En PHP, on utilisera la fonction <a href="http://fr3.php.net/manual/fr/function.rawurlencode.php">rawurlencode</a>. Cela induit que les URL doivent aussi respecter ces règles d’échappement. Donc, quand on injecte une variable dans une URL côté serveur, on devrait toujours passer un coup de <a href="http://fr3.php.net/manual/fr/function.rawurlencode.php">rawurlencode</a> dessus, sinon on se retrouve avec une URL mal formée, avec des réactions différentes selon le navigateur.</p>

<p>Quant au type mime, rien de plus habituel. On peut en plus rajouter l’encodage, pusique celui par défaut est l’US-ASCII, qui ne permet pas beaucoup de caractères par rapport au robuste utf-8 qui lui les connait tous ! Les types mimes suivants sont corrects :</p>

<ul class="list-attributes">
<li>text/html</li>
<li>plain/text</li>
<li>image/png</li>
<li>image/svg+xml;charset=utf-8</li>
<li>application/xhtml+xml</li>
<li>application/xhtml+xml;charset=iso-8859-7</li>

</ul>

<p style="word-wrap:break-word">Maintenant, voici un exemple avec un fichier XHTML : <a href="data:application/xhtml+xml;charset=utf-8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFN0cmljdC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS1zdHJpY3QuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIiB4bWw6bGFuZz0iZnIiPg0KPGhlYWQ+DQo8dGl0bGU+VW4gdGVzdDwvdGl0bGU+DQo8L2hlYWQ+DQo8Ym9keT4NCjxwPkV0IMOnYSBmb25jdGlvbm5lIHZyYWltZW50ICE8L3A+DQo8L2JvZHk+DQo8L2h0bWw+">data:application/xhtml+xml;charset=utf-8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFN0cmljdC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS1zdHJpY3QuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIiB4bWw6bGFuZz0iZnIiPg0KPGhlYWQ+DQo8dGl0bGU+VW4gdGVzdDwvdGl0bGU+DQo8L2hlYWQ+DQo8Ym9keT4NCjxwPkV0IMOnYSBmb25jdGlvbm5lIHZyYWltZW50ICE8L3A+DQo8L2JvZHk+DQo8L2h0bWw+</a></p>
<p style="word-wrap:break-word">Et avec un fichier image : <a href="data:image/gif;base64,R0lGODlhMAAQANQGAP/M///Mmf9mAP+ZZmYzAP/MZv/////MzMzMmcxmZswzAMyZmZkzAMyZZsxmAJlmADMzAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwAAAAAMAAQAAAFryAQjGRpnmiqBsIgvHAsz3RtC4R77zyf98Bg7GcrGAyvgYEVOOqaSCWrR7Q1EQKAIaGAYgVHg0KqoOpux2ajDDU42uNl2Xe2KeUOwdWAWB7jAXM7VXZHAHl6fFAOf2RmPGl8L1cJfAqNco83apUGDYkIeQqXYkoACCN1M4QzRoFvBgCgiGClYWk3rDMOoy+8Zby0Ar3Do6PCMrpCyzTKzM8vBAwQ1NXW19jZ2tsQBCEAIf4fT3B0aW1pemVkIGJ5IFVsZWFkIFNtYXJ0U2F2ZXIhAAA7">Image gif</a></p>

<p style="word-wrap:break-word">Sympa non ? Et bien en fait, si. Et vraiment sympa, puisque dans les navigateurs supportant ce plan (tous sauf Internet Explorer en fait, même si Opéra limite la taille d’une telle URI à 4Ko) l’acceptent partout : attribut href, javascript, et CSS ! On peut donc écrire sans problème : <code>list-style-image:url(data:image/gif;base64,R0lGODlhMAAQANQGAP/M///Mmf9mAP+ZZmYzAP/MZv/////MzMzMmcxmZswzAMyZmZkzAMyZZsxmAJlmADMzAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACwAAAAAMAAQAAAFryAQjGRpnmiqBsIgvHAsz3RtC4R77zyf98Bg7GcrGAyvgYEVOOqaSCWrR7Q1EQKAIaGAYgVHg0KqoOpux2ajDDU42uNl2Xe2KeUOwdWAWB7jAXM7VXZHAHl6fFAOf2RmPGl8L1cJfAqNco83apUGDYkIeQqXYkoACCN1M4QzRoFvBgCgiGClYWk3rDMOoy+8Zby0Ar3Do6PCMrpCyzTKzM8vBAwQ1NXW19jZ2tsQBCEAIf4fT3B0aW1pemVkIGJ5IFVsZWFkIFNtYXJ0U2F2ZXIhAAA7);</code>. Ainsi, plus de problème de ressource distante indisponible, et vu qu’une feuille de style n’est (en principe) chargée qu’une fois par le navigateur, il n’y a pas de problème de bande passante.</p>

<p>On peut à partir de là imaginer une extension Firefox qui enregistre les pages en local en remplaçant les références à des fichiers externes par ces URI. On obtient ainsi un document tout en un, comme le pdf, disponible hors-ligne, avec les atouts indéniables de XHTML en terme de légèreté. Et on peut aussi intégrer les pages Web pointées, et même les pages Web pointées par ces pages Web, avec la profondeur qu’on veut. Dans l’absolu, on pourrait contenir l’ensemble du Web de cette façon mais voilà la taille du fichier. :/</p>

<p>Ce plan n’a néanmoins pas que des avantages. D’abord le codage en base64 prend 33% de place en plus, et ça doit être à peu près la même chose pour le codage URI. Ensuite, son décodage est difficile et plutôt lent pour les navigateurs. Ainsi, Firefox crash systématiquement pour les fichiers images trop gros sur mon pc. Bref, cette technique est plutôt conseillée pour les documents courts : petites images, petits fichiers son, et documents XML pas trop longs. C’est dans l’esprit de ce plan d’URI et c’est pourquoi Opéra impose une telle limitation.</p>


<p>Comme je trouve ces URI très pratiques, j’ai écrit un petit script qui permet de faire les conversions facilement. Essayez mon <a href="data_uri/data_uri_scheme.php">convertisseur de document en URI data:</a>. Et pour ceux qui veulent découvrir une autre manière de coder un site Web, <a href="data_uri/data_uri_scheme.phps">lisez la source</a>.</p>

<p>Ces URI sont bien sûr utilisables avec SVG et partout ou il est possible de mettre une URI !</p>

<div class="xmlcode">&lt;<![CDATA[?xml version="1.0" encoding="utf-8"?>

<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">

<svg width="100%" height="100%" xml:lang="fr" viewBox="0 0 400 300" preserveAspectRatio="xMidYMid meet"
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink">

<title id="test">Utilisation d’URI data:</title>


<image x="175" y="150" width="50" height="50" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABGdBTUEAANbY1E9YMgAAAAZiS0dEAP8A/wD
/oL2nkwAAAAlwSFlzAAAASAAAAEgARslrPgAAAAl2cEFnAAAAMgAAADIAsRBP3gAAD/hJREFUaN7FWml0VFW2/s6tW0OqkqqkkpBUhSQMGUhAosSEsRUejUCwER/YoAwuFUirER+9nEhLtzwFlUZ82I00IgryeK2tNDSQoGmhSccFaYYYIoFAKMxclZBUqlJz3eG8H3UrVCYSXGifte6q4U77O
/vb39773EtwB8fmzTsxa9aMmH379mujoyPGRkVpE5xOBwUAjSaC2Gz25ra2ruoVK5Z2lZT8o33duqfv2L3JDz2RUoq3396F6dNnqIqLv0jt6Gj+D6+3PUcQ7KkxMXIDy3KRen14uErFUADw+URitbqcPM/a2tv9ZkBbq1Tqz4aH60/MnTu/9ujRk96tW18GIeSnAdLSQjFxohEvv7wp+tq17x622+v+U6/3ZaelaWLHjIkiyclaREaqoNEoIJMxCNglglJAFClcLj9sNi8aGrpQU2OjFy
/abrS2ys7r9aP+mpCQfnDnzrc7Pv/8NCZOTPpxgFBKMXXqbLzwwtrooqIvFgiCedW4cWHZ06YlsJmZ8YiIUAOQS5ekoDQAABBCNg6EUOmYwHFOpw+XL99AWZmFr6x0nue46F15eQsPvfbaGx0mU+WQPTSkoyyWDsTF6eVbt743t6bm1LqUFP7e+fNT2bQ0IxgmApSqACilywkAKAAfAL/02yd9igC80vcQIwiBKIq4dq0DR47U8dXVOJeYOOHNDRvWH6upMXEZGSmD2igbzAsRETHQ66OjNm9+42WX68LbixcbRy9alM3ExY0EkADAACAaQIQEhpUMlgHgJXBMyHdZCNieYGJiNMjNjWdiY/nhFRXV87744rjSaBxRGRMT7y0v/wYbNmy4fY9QSrFly/9g2LD4pDNnjm9PSuqc8
/jjWWxcXBIoDQJQ95p9BwC3NOscAKe0n5f+D47g/gGMIgwsFhv27Knma2o0X06ZMu/Z1taWhvXrXxmQamQgEIWFv4XRmJR45kzxzunTw+Y+9lgOVKpEUDoSQLw0+0EDXdLmBOCRjHRJ+6n0Hx9yh96
/+wND4Hb7sH//RZw44TuWkXF/vtnc2Lhjx3v9giH9y+oWGI1Jw0tKPt05e3ZE3pIlk8CyyaA0BYBRooo7xHhXyMZJhvolEL1nPwhMGDyACeD3+
/HnP19CcbG7eNq0BfktLQ1Nb775eh8wfYCcOnUaWm2M/v33N32cne2dv2LFVLDsKFCaJtFJJlHI2WsLGu8OiYH+QHASFYesl/D5fNi7txr
/+pfi8PLlzz3hdtutDz44b2AgdrsdWq1Wvnr1qnWpqZ3rn3tuKqtSJYPSTABxkry6+4AgxAtKvRIYKgHprU6h6nW7yVeE0+nBH/94gb98OfL1ffv2v9na2srFx8f3VS1KKcaMSYfb7Z
/r91dvefbZCerIyCSJTjES5iCVHN2bIHhgt1uhUPBSjvBLIMR+vCD2oo0AUaRgWdmgYFiWIDk5nKmoqJtQWlpz4bHHltQ6nU688cYbgER2AMDRo0exY8cn+u+/P
/vKwoXJuvj4eFAaC0AnGeCWjO8CYAfQBZ53Yfv2vyEvbxN27z4OUfRIBgelNZg3fD3klhCC+nob8vMPIT//EOrrO2+Z+AL7CIzGCDz0kEFnsVx89fDhrxKOHTvW0yNFRUX49a+fg9V645fjxvmeXrQoS0bIMCkmFCHqFPSEC4T4cfbsRRQUfIwrVyy4cKEBM2emwGCIlADwA1KJUopNm0qxY8cZVFZaIJMx+PnPRw+axSkVERengclkGX7pUqdzzZo1J+12O956662ARxobG7F8+doojmt8Ki9vhJxlNVKCYyWqOLu9cDOwXThx4gJaWx1gGAZNTXaUll6VQPh60avn7FosTnz5ZW13qVJSUguLxTmIVwLnKpUsZs0yor398tIjR0pSv
/nmmwD1eF5AZGQ4li9/8he5ufpJ6ekGUBomBbZXAuIJoUiAPoLA4+pVi0QZAkoprl5tBaWufgGE6ovF4oDZ7EDQbrPZCbPZAaNR1yfj9zdSU6MxcmTT6AMHPn2guPhwbVNTI5impkaYzW6ly9W4cNo0g5xhlBKIIL+7pCD3hmRtAYLggcfTU0Y9Hh8oHVyV3G4OPH+zePT7BXi9/NCKQ0KgUMgwaVIsOO7GI+fPX9VRCrC7du2C0ymO1ut9OZmZsVLYEGn2uRC+e0J+e8CyAqKiVD1uoterwTBEqnwHzgsREQooFLLu2VepWKjV8tuS5LQ0PaKiWu/59NP/HQ/4ypht296F291+X2amzhAergalwQJPCMnSrh4gAAEMI0NWlhEMw0jyKMP48fGhQjjgMBi0SErSgVIKSikSE7VISNAOiVZBOmq1SowYIdeePVuW9dJLL4JxOFwMIe6fjRkTKRkRLMWD+SJYTvC9SgsRDzwwCmPHDoMoirjnnnjMmDFqUGMopRg2TIOHH84AwxAwDMGCBZmIjdWA3sKVobsIARiGQUqKFpQ6J4siZdhLlxoNMpk3KykpPiQr016y6e+VCygo9WL0aC3+8Id5OHr0Kh5+OBOJibpbGhMa8KtX58LnC9zjV7/KBSFkECBiD0CUAkajBmp1Z1ZZ2bcGUlj41miOO/2PV1+9K1GrDTZJ8pC+QujVPwTlle8OPkoDszQ0EKHNVOD4QFzd+lxB4EAphShSCIIIv19AW5sLW7ZcbHK7U2eyPO8eJZP5ItRqhYQ6WFL01y/07fCCBtwGhu7zgnwfDEQwloL3CR4eFsZCrWZiUlMzJzDJycNH6
/XhWpmMSIYOlAO4IZffd3oEaXWzdguAYRgCnS5MAYiRjNvthFIpk7IqDekjcMui798BJOCZnp9yOWCzdYLt69WgOgUVTOy3x/4pQfSmb+hnEBCrVmvgdgvSwSSkdxDw7xqhCiaKQg8JDsZLMPB9PhGRkZFg6uubTFars0sQhpaMPB4ODofvRwIA2GxeVFe3gRBAFMVeQU67vSCKFDwvwm73+gHGxlCquM7zCofb7cfga2EEBw5U45//
/P4HL20Odn2Xy4+PPjorFZViP+p40xtuNw+Hg28vL6+oYB5/fJnX5WK7bDbvLdfrCGHw3XcWVFaakZub+CPFA8Xw4Trk5CRi166zsNu93bWbKAYBQNooOjvd4Dil
/dlnC1zMuHEjzF4ve6Guzt4vEEIICGFQXW3Bb37zd0yZkoRhwyJuK/nd7pg9OwVlZfXYtKkMnZ0eMAyR4gUSmADlWlpc8PvZSzNnTjQzOp1WlMm0p2tqbP0qU12dFbt2ncHu3ecgkxGUlFyDxzMUGv5gv+DECRPcbg7h4Qps3FiGzz67CJfLH5LZKThOgMnkQHz8qEuEEFG2bdt7iI8fobx+vXrhpEnRSqWS7aESpaV1oBR44olsTJ8+Ch98cBaEANnZw38Utbp40YzCwq/x5JP3YM2aSUhO1sFsdsJojIBKJQfPC+B5EVarB19/3daVkHDvxunTf9Yg++STT3D33bn2I0cOT09MFEckJET2UJH09FhkZRmgVisQFRWGmBg1Nm8uQ2KiDmlpsXcURH29Fc8
/X4yMjBisXTsFhAB6fRjGjo2FQiGDIIgQBBEcJ6KqqhUVFXx5QUHhtvHjM3yMSqVCZCRr5zjNR6WlLZwg8H0kMVS7581Lx/Lld2Pdur
/jq69q74h6EQLU1XVgzZoiyOUyFBbeB6VS1qNAFITAd54X4fFwOHeuA3J59OdTp4638zwHRq1W4+DBg5g5M+/4lSu4XlPTdkv+y2QEBQWTsWjRWKxdW4y//KUKPC
/+IECBBQXgwoUW5OcfBscJePfd2YiP14Dnxe6YCGwiBCGQO65ds6KxUWZasGBxyZ/+tAsZGZmBdm7GjJlYtmxRM8MYPjx0yMT7fP5bNjhKJYuXXroPTz45Aa++ehyFhSVoaLBJCkeGRCNCCLq6vNiz5zyWLTsArVaJ7dvnITlZB44TJZW6Gdw8Hwhwl8uPkyfNiIpK2f/II/Nr77///p5Lpu+8sxVyuU5fXn7gb089NWzajBkjQ+qt
/meT5ymOHbuCTZtKIYrAihVZyMtLR2KiDizLDlg7dXS4cOpUPfburcR337Vi6dLxeOaZHERGqiRPBLJ6EESQXj4fj1OnmnDwoL188eLnFnV13WheuXJlTyCCICAqKgoFBf81r6urfP+LL47VJSToQIhs0FXAhgYb9uypwKFDlyCKFBMmJCA3NwEjR0YhMjIMDEPgdnNobrajstKM06cb0dbmwsSJw7Fq1QTk5iaAEEAQaA86BUFwnAi
/n0dDgx0fflhrDwsbv3TnzveLzGYzDAZD30Xs9vYOREfr5StWLFuXlmZdX1CQxWo0SjAM050Yb9Xt1dVZUVJiwsmT12EyWWGzeaHRKCQgfshkDBITtcjJScCcOSm4++54KJUseF7orqX6ByHAZvNg374atLYa39m3b/8rly/X8JmZGQM/VigqOgalMkK/d++2jydP9s9fujQTKhXbzetQQKGeCnR8gf0ejx
/t7S60tTlhs3khihQajQKxsWrExqoREaEApaQbQGg83AQSAOHz8XA6/Th0qBZVVaqi/PwX8m/cMDc/+uiSwR/0FBauR0JC8vDS0r/unDVLlffII+lQqeRgmJ7G9wYSOhiGSOp385hQBbrZU1CpjkK3MgUzN8eJcDh8OHrUhNJSd3Fu7uz85ub6pg8//GDwBz3Bi69a9QwMhsTEmpqynffdJ5+7eHE61GpF9xJOcC12KIVgqNH9AaA0YHywNOd5ERwnwG734vBhE06f9h4zGu/KN5sbG4uKDg/t0VuoARs2bERsrCGpvPzY9lGjHHOWLEllExK0IIR0e2cgQP0tSvTXqgYB3Ex4Avx+Ec3NXThypB7Nzbovx46dsrqjo7Vx69bf397D0NAbP/PMWsyZMzfqwIF9a8PCLM8/+GCcNifH2CtuAIYZeFGtryfQowAMlh48L8Ll8qOiwoKvv27rYtmU3StWrHynpaW5+dFHf3lr9RxKBq6quoz09DHy11777dzr18+sS0nh750zJ5lNSdFDoWB7eCWYrXsv3YR6obcyCUKg7DCZrDh50oK6OvacwZD537/73etfXr9+jZs4ccKdfYWDEIKNG3+vb2q6
/rTDcf2JESOEpEmT4uSpqXpotQGZZpi+dAqCutkcBTaOE2CzeXHtWifOn+9Ac7O8PjZ2zP9Nnnz/DpOptrGw8KU7+wpH6LBaHYiKCmd27PjIWF5eOocQ51NqtfOupCSZZvRoLYxGDXQ6FVQqmZR
/evbYHg8Hq9WDlhYXTKYuNDXxLpdLU6VWx32Wl/fQVwsX/uKK1eqg0dHan+41J0IIqqquRh0/XpJ1/vzpe/x+22S1mo4nxBkeHi6PjYhQdlcqHEfR1eXnu7p8NygNdzocQpVcrj2dnT3l2wcemH0hO3tcZ/CaP+n7Wn1fvLFBq9XKKioqDR9/vDsiK2tsjsvlUlut7RQg0Ov1RK3WuM+d+
/bsypWrHTk5E8w2m10wGqPvyP3/Hy21yoHv9etaAAAAAElFTkSuQmCC"/>

</svg>]]></div>

<div class="object-example">
<object type="image/svg+xml" data="images/cours/data_uri/data.svg">Utilisation d’URI data:</object>
</div>



<p>Voilà pour ce petit bonus, j’espère que ça vous servira. Pensez à rabattre le caquet de ceux qui disent que le PDF est le seul format à pouvoir incorporer tous les documents en un seul fichier : XHTML peut aussi le faire !</p>






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
