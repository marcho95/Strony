<!DOCTYPE html>
<html lang="pl">
<head>

  <meta charset="utf-8">
  <title>Crawler</title>
  <link rel="Shortcut icon" href="http://www.supercoloring.com/sites/default/files/styles/coloring_medium/public/coloring-image-files/letter-c.gif" />
  <link rel="stylesheet" type="text/css" href="css.css">
  <link rel="stylesheet" type="text/css" href="clawler.css">
</head>

<body>
  <main>
    <div id="calosc">
     <div>
        <br/>
        <h1> Crawler </h1>
      </div>
      <form action="" method="GET"> 
        <div>
          <input class="Search" autofocus="" type="text" name="search"><br/><br/>
          <input class="Crawl" type="submit" valuea="Crawl!"></input>
          <br/>
          <br/>
          <br/>
        </div>
      </form>
    </div>


<div id="results">

  <?php
//Stworzenie pustej tablicy do której będą wpisywane wartości
 $tablicaPoczatkowa = []; 
//usunięcie wyświetlania się błędu
  error_reporting(E_ERROR | E_PARSE);

  $url=$_GET["search"];
  //echo $url;

  
  $new_document=new DOMDocument; //Wczytywanie dokumentu, 
  $new_document->loadHTMLFile($url); //pobieranie pliku z adresu
  $new_links=$new_document->getElementsByTagName('a');
  foreach ($new_links as $link )
{

$linkattribute=$link->getAttribute('href');// pobranie atrybutu href jako string
 echo '<span class="final-link">',$linkattribute, '</span>';

   // $linkattribute=$link->getAttribute('href');// pobranie atrybutu href jako string
   // $zmienna=explode('#', $linkattribute);//zmienić "zmienna" # dzieli string
   // $link=$zmienna[0];
   // echo '<span class="final-link">',$link, '</span>';
}
  
  ?>

</div>
</main>
</body>
</html>