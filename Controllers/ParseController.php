 <?php
class ParseController{
     public function __construct()
    {
                
    }
        
    public function actionUkrNet()
    { 
        date_default_timezone_set('UTC');
        $date=time();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.ukr.net/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_REFERER,"https://www.google.com/");
        curl_setopt($ch, CURLOPT_COOKIEFILE,'');
        curl_setopt($ch, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4");
        $result = curl_exec($ch); 
        curl_close($ch);
        $header= substr($result,0,strpos($result,'<!DOCTYPE html>'));
        file_put_contents("log.txt",$header.PHP_EOL,FILE_APPEND);
        $string = substr($result,strpos($result,'<ul class="top-news-list">')); 
        $result= substr($string,0,strpos($string,'<div class="more_news">'));
        $doc = new DOMDocument();
        $doc->loadHTML("<!DOCTYPE html><html><meta charset='utf-8'>".$result."</html>");
        $links = $doc->getElementsByTagName('a');
        $i=0;
        foreach($links as $link)
        {
            $arr[$i]["link"]=$link->getAttribute("href");
            $arr[$i]["description"]=$link->nodeValue;
            $i++;
        }
        $arrlinks=News::addNews($date,$arr);
        echo json_encode($arrlinks);
        return true;
    }
    
}
?>