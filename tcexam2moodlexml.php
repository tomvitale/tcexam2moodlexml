<?php
// version 0.1
// . migrate only single answer questions

if (isset($_FILES['file'])) {

////////////////////////////////
///       INIT VARS          ///
////////////////////////////////
  $DatiXml = simplexml_load_file($_FILES['file']['tmp_name']) or die("Error: Cannot create object");
  $ExportXml = '<?xml version="1.0" encoding="UTF-8"?>
<quiz>';

////////////////////////////////
///   CREATE MOODLE XML      ///
////////////////////////////////
  $i=1;
  /* For each <question> node, we create Moodle xml leaf. */
  foreach ($DatiXml->body->module->subject->question as $domanda) {

    $ExportXml .= '
  <question type="multichoice">
    <name>
      <text>q'.str_pad($i, 4, '0', STR_PAD_LEFT).'</text>
    </name>
    <single>true</single>
    <shuffleanswers>true</shuffleanswers>
    <questiontext format="html">
      <text><![CDATA[<p>'.$domanda->description.'<br></p>]]></text>
    </questiontext>';

    foreach ($domanda->answer as $risposta) {

      if($risposta->isright == "true") $punteggio = "100";
        else $punteggio = "0";

      $ExportXml .= '
    <answer fraction="'.$punteggio.'" format="html">
      <text><![CDATA[<p>'.$risposta->description.'<br></p>]]></text>
      <feedback format="html">
        <text></text>
      </feedback>
    </answer>';
    } //end foreach answers

    $ExportXml .= '
  </question>';

    $i++;
  } //end foreach questions

  $ExportXml .= '
</quiz>';

  // DISPLAY or SAVE XML: Check if display or save XML
  if ($_POST["eseguire"] == "visualizza") {

    // Display Xml
    header('Content-Type: application/xml; charset=utf-8');
    echo $ExportXml;

  } else if ($_POST["eseguire"] == "save-xml-f") {

    // Save Xml file
    $domtree = new DOMDocument('1.0', 'UTF-8');
    $domtree->formatOutput = true;
    $xmlRoot = $domtree->createElement("xml");
    //$xmlRoot = $domtree->appendChild($DatiXml);
    $domtree->loadXML($ExportXml);

    //save it to a file using a dialog box
    $file_name = "MoodleXmlexport.xml";
    header('Content-Disposition: attachment;filename=' . $file_name);
    header('Content-Type: text/xml');
    ob_clean();
    flush();
    echo $domtree->saveXML();
    exit;
  } // end if check Display or Save Xml


} else {

echo '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="expires" content="01 Jan 1970">
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <title>TCExam 2 MoodleXml</title>
</head>
<body style="font-family:verdana;">
';

echo '<form method="post" enctype="multipart/form-data" style="font-family:verdana;">
<h2>TCExam 2 MoodleXml</h2>
<table>
  <tr>
    <td>1.
      <select name="eseguire">
        <option value="save-xml-f" selected>Salva sul PC in XML</option>
        <option value="visualizza">Visualizza XML</option>
      </select>
    </td>
  </tr>
  <tr>
    <td> </td>
  </tr>
  <tr>
    <td>2.
      <input type="file" name="file" style="color:#025D00;"/>
    </td>
  </tr>
  <tr>
    <td> </td>
  </tr>
  <tr>
    <td>3.
      <input type="submit" value="Converti XML" />
    </td>
  </tr>
</table>
</form>
</body>
</html>
';

}

?>
