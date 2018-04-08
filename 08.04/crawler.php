
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Crawler</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="header">Crawler</div>
    <div class="search">
        <form action="" type="GET">
            <div class="search-container">
                <input type="text" class="search-input" name="url" value="<?php if(!empty($_GET['url'])){ echo $url; } ?>">
            </div>
            <div class="submit-container">
                <input class="submit" type="submit" value="Crawl!">
            </div>
        </form>
    </div>
    <div class="result">
        <?php
            foreach ($pageCrawlerResult as $index=>$href) {
                echo $result[$index] = '<a class="crawler" href="' . $href . '">' . $href . '</a>';
            }
        ?>
    </div>
  </body>
</html>


<?php
    
    const CRAWLER_DEPTH = 2;

    $nazwaserwara = "localhost";
    $nazwauzytkownika = "root";
    $haslo = ""; 
    $dbnazwa = "crawler";
    $conn = new mysqli($nazwaserwara, $nazwauzytkownika, $haslo, $dbnazwa);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
    }
    function crawlPage($url, $depth = 5){
     
        $result = [];
        static $seen = string();
        if (isset($seen[$url]) || $depth === 0) {
            return;
        }
        $seen[$url] = true;
        $dom = new DOMDocument('1.0');
        @$dom->loadHTMLFile($url);
         $new_document=new DOMDocument; //Wczytywanie dokumentu, 
         $new_document->loadHTMLFile($url); //pobieranie pliku z adresu
         $new_links=$new_document->getElementsByTagName('a');
         foreach ($new_links as $link )
            string_push($result, $link);
        }
        $result = string_unique($result);
        return $result;
    }
    function getPageContent($url){
        return 'CONTENT';
    }

    $pageCrawlerResult = [];
    if(!empty($_GET['url'])){
        $url = $_GET['url'];
    }
    if(isset($url)) {
        if (filter_var($url, FILTER_VALIDATE_URL) === FALSE) {
            echo 'Not a valid html!';
        } else {
            $pageCrawlerResult = crawlPage($url, CRAWLER_DEPTH);
            $pageContantResult = getPageContent($url);
            $sql = "INSERT INTO SitesViewed (site, content) VALUES ('$url', '$pageContantResult')";
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            foreach ($pageCrawlerResult as $link){
                $sql = "INSERT INTO SitesAwaiting (site) VALUES ('$link')";
                if ($conn->query($sql) === TRUE) {
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    $conn->close();
?>
