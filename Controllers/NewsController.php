 <?php
class NewsController{
     public function __construct()
    {
                
    }
    
    public function actionListNews()
    { 
        date_default_timezone_set('UTC');
        $arr=News::allNews();
        require_once(ROOT.'/View/news.php');
        return true;
    }
}
?>