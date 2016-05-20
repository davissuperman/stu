<?php
use Symfony\Component\DomCrawler\Crawler;
require 'Bootstrap.php';

$url = "http://www.unite-students.com/liverpool";
$html =  file_get_contents($url);

$crawler = new Crawler($html);

$res = $crawler->filter('a.text-highlight__inner');

foreach($res as $each){
    $propertyName = $each->textContent;
    var_dump($each);
}