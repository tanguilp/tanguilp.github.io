<?php

/* functions */
function dataUriScheme($mediaType, $data, $base64Encoded = true)
	{
	$result = 'data:';
	$result .= $mediaType;

	if($base64Encoded == true)
		{
		$result .= ';base64';
		$result .= ',';
		$result .= base64_encode($data);
		}
	else
		{
		$result .= ',';
		$result .= rawurlencode($data);
		}

	return $result;
	}

/* namespace */
define('XHTML_NS', 'http://www.w3.org/1999/xhtml');
define('XML_NS', 'http://www.w3.org/XML/1998/namespace');

/* doctype */
$imp = new DOMImplementation;
$dtd = $imp->createDocumentType('html', '-//W3C//DTD XHTML 1.0 Strict//EN', 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd');
$xhtml = $imp->createDocument('','', $dtd);
$xhtml->encoding = 'utf-8';

/* inserting root element */
$rootElement = $xhtml->createElementNS(XHTML_NS, 'html');
$rootElement->setAttributeNS(XML_NS, 'lang', 'fr');
$rootElement->setAttributeNS(XML_NS, 'id', 'rootElement');
$xhtml->appendChild($rootElement);

unset($rootElement);

/* creating and inserting head element */
$headElement = $xhtml->createElementNS(XHTML_NS, 'head');
$headElement->setAttributeNS(XML_NS, 'id', 'headElement');

$titleElement = $xhtml->createElementNS(XHTML_NS, 'title');
$titleElementContent = $xhtml->createTextNode('Convertisseur vers la plan d’URI data:');
$titleElement->appendChild($titleElementContent);

$headElement->appendChild($titleElement);

$xhtml->getElementById('rootElement')->appendChild($headElement);

unset($headElement, $titleElement, $titleElementContent);

/* creating body element */
$bodyElement = $xhtml->createElementNS(XHTML_NS, 'body');
$bodyElement->setAttributeNS(XML_NS, 'id', 'bodyElement');

$h1Element = $xhtml->createElementNS(XHTML_NS, 'h1');
$h1Element->setAttributeNS(XML_NS, 'id', 'h1Element');
$h1ElementContent= $xhtml->createTextNode('Convertisseur vers la plan d’URI data:');
$h1Element->appendChild($h1ElementContent);

$bodyElement->appendChild($h1Element);

$explanations = new DOMDocument('1.0', 'utf-8');
$explanations->loadXML('<p>Pour plus d’informations concernant le plan d’URI <code>data:</code>, consultez <a href="http://blog.tangui.net/index.php/2006/08/07/4-les-uri-data-">cette page</a>.</p>');


$importedExplanations = $xhtml->importNode($explanations->documentElement, true);

$bodyElement->appendChild($importedExplanations);

unset($h1Element, $h1ElementContent, $explanations, $importedExplanations);
// $bodyElement isn’t inserted yet, therefore I don’t unset it

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				Step 1
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

if(!isset($_GET['step']) || $_GET['step'] == '1')
{
	$startText = new DOMDocument('1.0', 'utf-8');
	$startText->loadXML('<div><p>Vous avez le choix entre convertir :</p><ul><li><a href="data_uri_scheme.php?step=2&amp;type=text">du texte</a>,</li><li><a href="data_uri_scheme.php?step=2&amp;type=distant">une ressource distante</a>,</li><li><a href="data_uri_scheme.php?step=2&amp;type=local">un fichier local</a>.</li></ul></div>');

	$importedStartText = $xhtml->importNode($startText->documentElement, true);


	$xhtml->getElementById('bodyElement')->appendChild($importedStartText);

	$xhtml->getElementById('h1Element')->firstChild->appendData(' -- étape 1 sur 3');

	unset($startText, $importedStartText);
}


/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				Step 2
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

elseif($_GET['step'] == '2')
{

	$fieldset = new DOMDocument('1.0', 'utf-8');
	$fieldset->loadXML('<form method="post" action="data_uri_scheme.php?step=3&amp;type='.$_GET['type'].'" xml:id="formElement"><fieldset xml:id="formFieldset"><legend>Données requises</legend><p xml:id="base64EncodedP"><label>Encodé en base64 : <select name="base64Encoded"><option value="true" selected="selected">Oui</option><option value="false">Non</option></select></label></p><p><input type="submit"/></p></fieldset></form>');

	$importedForm = $xhtml->importNode($fieldset->documentElement, true);


	$xhtml->getElementById('bodyElement')->appendChild($importedForm);

	$xhtml->getElementById('h1Element')->firstChild->appendData(' -- étape 2 sur 3');

	unset($fieldset, $importedForm);

	if($_GET['type'] == 'text')
	{
		$textarea = new DOMDocument('1.0', 'utf-8');
		$textarea->loadXML('<p xml:id="textarea"><label>Texte :<br/><textarea name="text" style="width:80%;height:20em;"/></label></p>');

		$importedTextarea = $xhtml->importNode($textarea->documentElement, true);

		$xhtml->getElementById('formFieldset')->insertBefore($importedTextarea, $xhtml->getElementById('base64EncodedP'));

		unset($textarea, $importedTextarea);
	}
	elseif($_GET['type'] == 'distant')
	{
		$distantInput = new DOMDocument('1.0', 'utf-8');
		$distantInput->loadXML('<p xml:id="distantInput"><label>Ressource distante :<br/><input type="text" name="distant"/></label></p>');

		$importedInput = $xhtml->importNode($distantInput->documentElement, true);

		$xhtml->getElementById('formFieldset')->insertBefore($importedInput, $xhtml->getElementById('base64EncodedP'));

		unset($distantInput, $importedInput);
	}
	elseif($_GET['type'] == 'local')
	{
		$fileForm = new DOMDocument('1.0', 'utf-8');
		$fileForm->loadXML('<p xml:id="file"><label>Fichier :<br/><input type="file" name="local"/></label></p>');

		$importedFileForm = $xhtml->importNode($fileForm->documentElement, true);

		$xhtml->getElementById('formFieldset')->insertBefore($importedFileForm, $xhtml->getElementById('base64EncodedP'));

		// adding attribute enctype="multipart/form-data" to <form/>

		$xhtml->getElementById('formElement')->setAttributeNS(null, 'enctype', 'multipart/form-data');

		unset($fileForm, $importedFileForm);
	}

	if($_GET['type'] == 'text' || $_GET['type'] == 'distant')
	{
		$mimeType = new DOMDocument('1.0', 'utf-8');
		$mimeType->loadXML('<p xml:id="mimeType">Il faut, pour les ressources distantes ou pour du texte, indiquer le type MIME. Par exemple : "text/html", "image/png", "application/xhtml+xml;charset=iso-8859-1", etc.<br/>Par défaut, le type MIME est "text/plain;charset=US-ASCII", donc si vous travaillez en utf-8, il vous faudra l’indiquer.<br/><label>Type MIME :<br/><input type="text" name="mimeType"/></label></p>');

		$importedMimeTypeForm = $xhtml->importNode($mimeType->documentElement, true);

		$xhtml->getElementById('formFieldset')->insertBefore($importedMimeTypeForm, $xhtml->getElementById('base64EncodedP'));

		unset($mimeType, $importedMimeTypeForm);
	}
}

/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				Step 3
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

elseif($_GET['step'] == '3')
{
	/* datas */

	if($_GET['type'] == 'text')
	{
		$data = $_POST['text'];
	}
	elseif($_GET['type'] == 'distant')
	{
		$data = file_get_contents($_POST['distant']);
	}
	elseif($_GET['type'] == 'local')
	{
		$filename = $_FILES['local']['tmp_name'];
		$handle = fopen($filename, 'r');
		$data = fread($handle, filesize($filename));
		fclose($handle);
	}



	/* mime type */

	if($_GET['type'] == 'text' || $_GET['type'] == 'distant')
	{
		$mediaType = $_POST['mimeType'];
	}
	elseif($_GET['type'] == 'local')
	{
		$mediaType = $_FILES['local']['type'];
	}

	/* base 64 encoding */

	if($_POST['base64Encoded'] == 'true')
	{
		$base64Encoded = true;
	}
	elseif($_POST['base64Encoded'] == 'false')
	{
		$base64Encoded = false;
	}


	/* inserting result in document */
	$finalUri = dataUriScheme($mediaType, $data, $base64Encoded);

	$p1Element = $xhtml->createElementNS(XHTML_NS, 'p');
	$p1ElementContent = $xhtml->createTextNode('L’URI est :');
	$p1Element->appendChild($p1ElementContent);

	$p3Element = $xhtml->createElementNS(XHTML_NS, 'p');
	$p3ElementContent = $xhtml->createTextNode($finalUri);
	$p3Element->setAttributeNS(null, 'style', 'font-weight:bold');
	$p3Element->appendChild($p3ElementContent);

	$p2Element = $xhtml->createElementNS(XHTML_NS, 'p');

	$aElement = $xhtml->createElementNS(XHTML_NS, 'a');
	$aElementContent = $xhtml->createTextNode('Lien de l\'URI data:');
	$aElement->appendChild($aElementContent);
	$aElement->setAttributeNS(null, 'href', dataUriScheme($mediaType, $data, $base64Encoded));

	$p2Element->appendChild($aElement);

	$xhtml->getElementById('bodyElement')->appendChild($p1Element);
	$xhtml->getElementById('bodyElement')->appendChild($p3Element);
	$xhtml->getElementById('bodyElement')->appendChild($p2Element);
	$xhtml->getElementById('h1Element')->firstChild->appendData(' -- étape 3 sur 3');

	unset($uri, $p1Element, $p1ElementContent, $p2Element, $aElement, $aElementContent, $mediaType, $data, $base64Encoded);
}



/* ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
				End of the 3 steps
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

/* link to go back to step 1 */

if(isset($_GET['step']) && ($_GET['step'] == '2' || $_GET['step'] == '3'))
{
	$toStep1 = new DOMDocument('1.0', 'utf-8');
	$toStep1->loadXML('<p><a href="data_uri_scheme.php">Retour à l’étape 1</a></p>');

	$importedToStep1 = $xhtml->importNode($toStep1->documentElement, true);

	$bodyElement->appendChild($importedToStep1);

	unset($toStep1, $importedToStep1);
}


/* inserting body */

$xhtml->getElementById('rootElement')->appendChild($bodyElement);

unset($bodyElement);



/* http headers */
header('Content-type:application/xhtml+xml');

/* sending content */
echo $xhtml->saveXML();

?>
