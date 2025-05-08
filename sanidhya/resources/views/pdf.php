<?php

// Parse PDF file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf = $parser->parseFile('documents/g2.pdf');

$text = $pdf->getText();
echo $text;