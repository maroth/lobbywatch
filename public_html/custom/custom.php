<?php

function setupRSS($page, $dataset) {
  $title = ucwords ( $page->GetCaption () );
  $table = str_replace ( '`', '', $dataset->GetName () );
  switch ($table) {
    case 'parlementarier' :
      $rss_title = '%vorname% %nachname% by %updated_visa%';
      $rss_body = 'Beruf: %beruf%<br>Kanton: %kanton%<br>Partei: %partei%';
      break;
    case 'interessenbindung' :
      $rss_title = '%beschreibung% by %updated_visa%';
      $rss_body = '';
      break;
    case 'zugangsberechtigung' :
      $rss_title = '%vorname% %nachname% by %updated_visa%';
      $rss_body = 'Funktion: %funktion%';
      break;
    case 'lobbyorganisation' :
      $rss_title = '%name% by %updated_visa%';
      $rss_body = '%beschreibung%<br>Typ: %typ%<br>Vernehmlassung: %vernehmlassung%';
      break;
    default :
      $rss_title = 'ID %id% by %updated_visa%';
      $rss_body = '';
  }

  $rss_body .= "<br>$title ID %id%<br>Updated by %updated_visa% at %updated_date%";

  $base_url = "http://$_SERVER[HTTP_HOST]";
  $generator = new DatasetRssGenerator ( $dataset, convert_utf8 ( $title . ' RSS' ), $base_url, convert_utf8 ( '�nderungen der Lobbycontrol-Datenbank als RSS Feed' ), $rss_title, $table . ' at %id%', $rss_body );
  $generator->SetItemPublicationDateFieldName ( 'updated_date' );
  $generator->SetOrderByFieldName ( 'updated_date' );
  $generator->SetOrderType ( otDescending );

  return $generator;
}
function convert_utf8($text) {
  return ConvertTextToEncoding ( $text, GetAnsiEncoding (), 'UTF-8' );
}
function dc($msg) {
  print ("<!-- $msg -->") ;
}
function dcXXX($msg) {
  // Disabled debug comment: do nothing
}

function before_render(Page $page) {
  $page->OnCustomHTMLHeader->AddListener('add_custom_header');
}

function add_custom_header(&$page, &$result) {
$result = <<<'EOD'
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-45624114-1', 'lobbycontrol.ch');
    ga('send', 'pageview');

  </script>
  <meta name="Generator" content="PHP Generator for MySQL (http://sqlmaestro.com)" />
  <link rel="shortcut icon" href="/favicon.png" type="image/png" />
EOD;
$result .= <<<EOD
  <link rel="alternate" type="application/rss+xml" title="{$page->GetCaption()} Update RSS" href="{$page->GetRssLink()}" />
EOD;

}