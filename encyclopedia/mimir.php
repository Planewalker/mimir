<?php

// scrape.
require_once "support/simple_html_dom.php";
echo "START\n";
$imp = './import/';
$files = scandir(__DIR__);
$rows = array();
foreach ($files as $file) {
  echo "Reading $file \n";
  if ($file != '.' && $file != '..' && (strpos($file, '.gz') === FALSE) && (strpos($file, '.html') !== FALSE)) {
    $html = file_get_html($file);
    $title = $html->find('h1', 0)->plaintext;
    $wiki = $html->find('div.node div.content', 0)->plaintext;
    file_put_contents($imp . trim($title), trim($wiki));
  }
}
echo "DONE\n";

