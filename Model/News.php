<?php
class News{
    public function __construct()
    {
        
    } 
    public static function addNews($date,$links)
    {
        $pdo=connection::getConnection();
        foreach($links as $link)
        {
            $stmt = $pdo->prepare('INSERT INTO parseUkrnet(id,date,link,description) VALUES(NULL,:date,:link,:description)');
            $stmt->execute(array('date' => $date,'link'=>$link['link'],'description'=>$link['description']));
        }
        $stmtl = $pdo->prepare('SELECT * FROM parseUkrnet ORDER BY id DESC');
        $stmtl->execute();
        $links=array();
        while ($link = $stmtl->fetch())
        {
            $links[]=$link;
        }
        return $links;
    }
    
    public static function allNews()
    {
        $pdo=connection::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM parseUkrnet');
        $stmt->execute();
        $links=array();
        while ($link = $stmt->fetch())
        {
            $links[]=$link;
        }
        return $links;
    }
}
?>