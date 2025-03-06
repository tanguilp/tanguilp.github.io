<?php
header('Content-type:text/css');
?>

@namespace url(http://www.w3.org/1999/xhtml);

@font-face {
  font-family: Gentium;
  src: url(inc/Jacoba/Jacoba_Bold.ttf);
}


*{
	margin:0;
	padding:0;
	list-style-type:none;
	border:none;
	/* niarf >:p */
}

html, body{
	background:#f5f5f5;
}

/* ------------------ header style ------------------------ */

h1{
	width:86%;
	height:120px;
	margin-left:7%;
	margin-right:7%;
	text-align:center;
	margin-top:20px;
	border:#9acd32 solid medium;
}

h1>object{
	width:100%;
	height:100%;
        background:white;
}

/* ------------------ main div style ---------------------- */

div#contenu{
	width:63%;
	float:left;
	margin-left:8%;
	margin-bottom:1%;
	padding:1%;
	padding-bottom:3%;
	border:#b0e0e6 dashed thin;
	border-top:none;
	background:white;
}

/* ------------------ menu style ------------------------- */

ol#menu{
	border-left:thin solid #9acd32; border-right:thin solid #9acd32; border-bottom:thin solid #9acd32; width:19%;
	float:left;
	border-top:medium none;
	margin-bottom:1%;
	background-color:white;
	background-image:url('images/pinceau.png');
	background-position: 85% 102%;
	background-repeat:no-repeat;
	padding-bottom:4%
}

ol#menu>li{
	padding-left:2%;
	border-bottom:#b0c4de thin dotted;
}

ol#menu>li:hover{
	background:#ffffe0;
	border-bottom:solid thin;
}

ol#menu>li.menuHead:hover{
	background:#4169e1;
}

ol#menu>li>a{
	display:block;
}

ol#menu>li>a:first-letter{
	font-family:Jacoba;
}

ol#menu>li>a:hover{
	color:#ff1493;
}

#menu li.menuHead{
	font-weight:bold;
	background:#4169e1;
	color:white;
	text-indent:5%;
}

/* ------------------ footer style ----------------------- */

div#footer p#firstfooter{
	clear:both;
	width:86%;
	margin-left:7%;
	margin-right:7%;
	margin-bottom:1%;
	padding:0.2%;
	text-align:center;
	border:thin solid #9acd32;
	font-size:1em;
	line-height:1.2em;
	word-spacing:1em;
	background-color:white;
	background-image:url('images/tube.png');
	background-position: 98% 50%;
	background-repeat:no-repeat
}

div#footer p#firstfooter img{
	position:relative;
	top:3px;
}

div#footer p#secondfooter{
	clear:both;
	width:86%;
	margin-left:7%;
	margin-right:7%;
	margin-bottom:1%;
	padding:0.2%;
	text-align:center;
	border:thin solid #9acd32;
	font-size:1em;
	line-height:1.2em;
	background-color:white;
}

div#footer p#firstfooter img{
	position:relative;
	top:3px;
}

div#footer p#secondfooter{
}

/* ------------------ general style ----------------------- */

a{
	font-weight:bold;
	text-decoration:none;
	color:#4169e1;
}

a:visited:first-letter{
	background:transparent;
}

a:hover{
	color:#ff1493;
}

acronym{
	border-bottom:thin dotted #cd5c5c;
	cursor:help;
}

p{
	text-indent:1em;
	padding-left:3%;
	width:90%;
	margin-bottom:0.8em;
	text-align:justify;
}

cite>strong{
	font-weight:bold;
	text-decoration:underline;
}

*:not(:lang(fr)) {
	font-style:italic;
}

/* ------------------ h* style --------------------------- */

h2{
	font-size:1.9em;
	text-align:center;
	margin:0;
	margin-bottom:1.5em;
	margin-top:2em;
	background-image:url(images/bulles.png);
	background-repeat:no-repeat;
	background-position:50% 60%;
	border-bottom:thin dotted #f5f5f5;
}

h3{
	width:80%;
	font-size:1.3em;
	padding-left:1%;
	margin-top:1em;
	margin-bottom:0.3em;
	border-bottom:#32cd32 dotted thin;
}

h4{
	margin-top:1em;
	margin-bottom:1em;
	border-bottom:#fafad2 thick solid;
	width:auto;
	display:inline;
}

h4 + *{
	margin-top:1em;
}

h4:before{
	content:url(images/list-minus.png);
	padding-right:1%;
	}

/* ------------------ objects style ----------------------- */

div.object-schema, div.object-example{
}

/* ------------------ general style ----------------------- */

a{
	font-weight:bold;
	text-decoration:none;
	color:#4169e1;
}

a:visited:first-letter{
	background:transparent;
}

a:hover{
	color:#ff1493;
}

acronym{
	border-bottom:thin dotted #cd5c5c;
	cursor:help;
}

p{
	text-indent:1em;
	padding-left:3%;
	width:90%;
	margin-bottom:0.8em;
	text-align:justify;
}

cite>strong{
	font-weight:bold;
	text-decoration:underline;
}

*:not(:lang(fr)) {
	font-style:italic;
}

/* ------------------ h* style --------------------------- */

h2{
	font-size:1.9em;
	text-align:center;
	margin:0;
	margin-bottom:1.5em;
	margin-top:2em;
	background-image:url(images/bulles.png);
	background-repeat:no-repeat;
	background-position:50% 60%;
	border-bottom:thin dotted #f5f5f5;
}

h3{
	width:80%;
	font-size:1.3em;
	padding-left:1%;
	margin-top:1em;
	margin-bottom:0.3em;
	border-bottom:#32cd32 dotted thin;
}

h4{
	margin-top:1em;
	margin-bottom:1em;
	border-bottom:#fafad2 thick solid;
	width:auto;
	display:inline;
}

h4 + *{
	margin-top:1em;
}

h4:before{
	content:url(images/list-minus.png);
	padding-right:1%;
	}

/* ------------------ objects style ----------------------- */

div.object-schema, div.object-example{
	width:80%;
	height:20em;
	margin:auto;
	margin-top:2em;
	margin-bottom:2em;
	border:thin dotted #add8e6;
	padding-bottom:1.5em;
}

div.object-schema:before{
	display:block;
	content:"Schéma";
	text-align:center;
	color:#f0fff0;
	font-weight:bold;
	border-bottom:1px grey dashed;
	background:#b0c4de;
	margin-bottom:2px;
}

div.object-example:before{
	display:block;
	content:"Exemple";
	text-align:center;
	color:#fffff0;
	font-weight:bold;
	border-bottom:1px grey dashed;
	background:#b0c4de;
	margin-bottom:2px;
}

div.object-schema>object, div.object-example>object{
	width:100%;
	height:100%;
}

/* ------------------ code style ----------------------- */

div.csscode{
	overflow:auto;
	white-space:pre;
	width:75%;
	margin:auto;
	margin-top:1em;
	margin-bottom:1em;
	padding:2%;
	padding-bottom:0;
	padding-top:0;
	border:#4682b4 solid thin;
	border-left-width:thick;
	background:url(images/csscode.png) no-repeat top right #f0f8ff;
}

div.xmlcode{
	overflow:auto;
	white-space:pre;
	width:75%;
	margin:auto;
	margin-top:1em;
	margin-bottom:1em;
	padding:2%;
	padding-bottom:0;
	padding-top:0;
	border:#9acd32 solid thin;
	border-left-width:thick;
	background:url(images/xmlcode.png) no-repeat top right #f0f8ff;
	/*font-family:Monospace;*/
}

div.phpcode{
	overflow:auto;
	white-space:pre;
	width:75%;
	margin:auto;
	margin-top:1em;
	margin-bottom:1em;
	padding:2%;
	padding-bottom:0;
	padding-top:0;
	border:#ffb6c1 solid thin;
	border-left-width:thick;
	background:url(images/phpcode.png) no-repeat top right #f0f8ff;
}

div.jscode{
	overflow:auto;
	white-space:pre;
	width:75%;
	margin:auto;
	margin-top:1em;
	margin-bottom:1em;
	padding:2%;
	padding-bottom:0;
	padding-top:0;
	border:#ffb6c1 solid thin;
	border-left-width:thick;
	background:url(images/jscode.png) no-repeat top right #f0f8ff;
}

div.shell{
	overflow:auto;
	white-space:pre;
	width:75%;
	margin:auto;
	margin-top:1em;
	margin-bottom:1em;
	padding:2%;
	padding-bottom:0;
	padding-top:0;
	border:#e0e0e0 solid thin;
	border-left-width:thick;
	background:url(images/shell.png) no-repeat top right #f0f8ff;
}
/* ------------------ specific classes ------------------- */

.image{
	text-align:center;
}

.nextchapter{
	text-align:center;
	text-decoration:underline;
}

.previouspage{
	height:1em;
	width:50%;
	margin-top:1em;
}

.previouspage:before{
	content:"<< ";
	font-weight:bold;
}

.nextpage{
	height:1em;
	text-align:right;
	width:50%;
	margin-left:50%;
	margin-top:1em;
}

.nextpage:after{
	content:" >>";
	font-weight:bold;
}

.previouspage + .nextpage{
	position:relative;
	margin-top:-1em;
}

p.rappel{
	width:80%;
	min-height:56px;
	margin-left:10%;
	margin-top:0.5em;
	margin-bottom:0.5em;
	padding-left:22px;
	background:#ffffe0 url(images/rappel.png) left center no-repeat;
	text-indent:0;
	border:#b0c4de inset thin;
	overflow:auto;
}

.attribute{
	font-family:Monospace;
	font-size:0.9em;
	font-weight:bold;
}

.balise{
	font-family:"Courier New", serif;
	font-size:0.95em;
	font-weight:bold;
}

.balise:before{
	content:"<";
}

.balise:after{
	content:"/>";
}

.sanslt:before, .sanslt:after{
	content:"";
}

.js{
	font-family:Monospace;
	font-size:0.9em;
	font-weight:bold;
}

.csspropertie{
	font-style:italic;
	font-family:Monospace;
}

.xpath{
	font-weight:bold;
	font-family:Monospace;
	letter-spacing:-1px;
}

.pi{
	font-weight:bold;
	font-family:Monospace;
	letter-spacing:-1px;
}

.pi:before{
	<?php echo 'content:"<?";';?>

}

.pi:after{
	<?php echo 'content:"?>";';?>

}

.mimeType{
	font-family:Monospace;
	font-size:0.9em;
}

.centered-text{
	text-align:center;
}

a[href="prochainement.php"]{
	opacity:0.5;
}

.currentpage{
	background:url(./images/currentpage.gif) right center no-repeat;
	padding-right:11px;
}

/* ---------------------- lists --------------------- */

ul.list-attributes, ul.list-css-values{
	padding-left:13%;
	width:75%;
	margin-bottom:1em;
}

ul.list-attributes>li, ul.list-css-values>li{
	list-style-image:url(./images/list_bullet.png);
}
ul.sommaire{
	margin-left:20%;
	list-style-image:url(images/list-plus.png);
	}
