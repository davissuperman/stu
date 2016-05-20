<?php
use Symfony\Component\DomCrawler\Crawler;
require 'Bootstrap.php';

//$url = "http://www.unite-students.com/liverpool";
//$html =  file_get_contents($url);
$html =  file_get_contents('livepool.html');
$crawler = new Crawler($html);

$res = $crawler->filter('ul.nav');

foreach($res as $each){
    $text = $each->textContent;
    $crawlerTmp = new Crawler($text);

    echo "----------------------------<br/>";
    echo $text;
    echo "+++++++++++++++++<br/>";
    $resTmp = $crawler->filter('text-highlight__inner');
   // var_dump($resTmp);
}