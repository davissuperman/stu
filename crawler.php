<?php
use Symfony\Component\DomCrawler\Crawler;
require 'Bootstrap.php';
require 'abstract.php';

class Stu extends Mage_Shell_Abstract{
    public function run(){
        $format = $this->getArg('format');
        if(!$format){
            $format = 'csv';
        }
        $name = $this->getArg('name');
        if(!$name){
            $name = 'out';
        }
        //$url = "http://www.unite-students.com/liverpool";
//$html =  file_get_contents($url);
        $html =  file_get_contents('livepool.html');
        $crawler = new Crawler($html);

        $res = $crawler->filter('li.expand-parent-mob');

        $domain = "http://www.unite-students.com/";
        $file = $name.".".$format;
        foreach($res as $key => $each){
            if($key >= 1){
                //   break;
            }
            $str = '';
            $name = $each->getElementsByTagName('a')->item(0)->textContent;
            $name = trim($name);

            $price = $each->getElementsByTagName('h3')->item(1)->textContent;
            $price =  $this->removeBr(trim($price));
            $price = str_replace(" ",'',$price);
            $price = str_replace("perweek",'',$price);

            $href = $each->getElementsByTagName('h3')->item(0)->getElementsByTagName('a')->item(0)->getAttribute('href');
            $subUrl = $domain.$href;
            $typeArray = $this->getRoomType($subUrl);
            $typeStr  = implode(",",$typeArray);
            $typeStr = $this->removeBr(trim($typeStr)) ;

            $str = '"'.$name.'","'.$price.'","'.$typeStr.'"';
            file_put_contents($file, $str.PHP_EOL, FILE_APPEND);

        }


    }

    function removeBr($str){
        return str_replace("\n",' ',$str);
    }

    function getRoomType($url){
        $arr = array();
        $content = file_get_contents($url);
        $crawler = new Crawler($content);
        $res = $crawler->filter('a.rooms__list__menu__link');
        foreach($res as $each){
            $arr[] = $each->textContent;
        }
        return $arr;
    }
    public function usageHelp()
    {
        return <<<USAGE
Usage:  php -f crawler.php -- [options]

  --format csv/txt       Format
  --name                      The name of output file
  help                          This help


USAGE;
    }

}

$shell = new Stu();
$shell->run();
