<?php

require_once __DIR__ . '/dompdf2/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/*
|--------------------------------------------------------------------------
| OLD STYLE CONFIG
|--------------------------------------------------------------------------
*/

$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

/*
|--------------------------------------------------------------------------
| LOAD HTML FILE (your longterm.php)
|--------------------------------------------------------------------------
*/

ob_start();
include __DIR__ . '/longterm.php';
$html = ob_get_clean();

/*
|--------------------------------------------------------------------------
| LOAD + RENDER
|--------------------------------------------------------------------------
*/

$dompdf->loadHtml($html);
$dompdf->setPaper('Folio', 'portrait');
$dompdf->render();

/*
|--------------------------------------------------------------------------
| PAGE NUMBER (old style supported)
|--------------------------------------------------------------------------
*/

$canvas = $dompdf->getCanvas();
$font = $dompdf->getFontMetrics()->get_font("Helvetica", "normal");

$canvas->page_text(500, 880, "Page {PAGE_NUM} of {PAGE_COUNT}", $font, 10, [0,0,0]);

/*
|--------------------------------------------------------------------------
| OUTPUT
|--------------------------------------------------------------------------
*/

$dompdf->stream("document.pdf", ["Attachment" => false]);

exit;