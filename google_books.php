<?php 
/*
 * Proxy: Loading cover thumbnails from Google books
 * Lars Heuer, BIS Oldenburg - 10.2018
 * 
 * Default link template for google_thumb:
 * {{proxy_server}}books.google.com/books?bibkeys=ISBN:{{addata/isbn}},OCLC:{{addata/oclcid}},LCCN:{{addata/lccn}}&jscmd=viewapi&callback=updateGBSCover
 * 
 * Custom proxy link template for google_thumb:
 * https://orbis-oldenburg.de/cover/google_books.php?isbn={{addata/isbn}}&oclc={{addata/oclcid}}&lccn={{addata/lccn}}&callback=updateGBSCover
 * 
 * Example (old UI):
 * https://orbis-oldenburg.de/cover/google_books.php?isbn=0669889717&oclc=163364975&lccn=&callback=updateGBSCover0
 * 
 * Example (new UI):
 * https://orbis-oldenburg.de/cover/google_books.php?isbn=9781119952268&oclc=825040573&lccn=2012029604&callback=updateGBSCover
 */

const IMG_CONTENT_TYPE = "content-type:image/png";
const TEXT_CONTENT_TYPE = "content-type:text/plain";
$one_pixel_image = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');

$isbn = isset($_GET["isbn"]) ? $_GET["isbn"] : "";
$oclc = isset($_GET["oclc"]) ? $_GET["oclc"] : "";
$lccn = isset($_GET["lccn"]) ? $_GET["lccn"] : "";
$callback = isset($_GET["callback"]) ? $_GET["callback"] : "";

// From new UI?
if($callback == "updateGBSCover") 
{
    $show_image = 1;
}
else 
{
    $show_image = isset($_GET["show_image"]) ? $_GET["show_image"] : 0;
}

$googlebooks_url = "https://books.google.com/books?bibkeys=%isbn%,OCLC:%oclc%,LCCN:%lccn%&jscmd=viewapi&callback=%callback%";
$script_url = str_replace(array("%isbn%", "%oclc%", "%lccn%", "%callback%"), array($isbn, $oclc, $lccn, $callback), $googlebooks_url);

$regex = "!(\"thumbnail_url\"\:\")([^\"]+)(\")!"; 

try 
{
    $script = file_get_contents($script_url);
    
    if($show_image)
    {
        header(IMG_CONTENT_TYPE);
        
        if(preg_match($regex, $script, $match))
        {
            $img_url = str_replace("\u0026", "&", $match[2]);
            echo file_get_contents($img_url);
        }
        else 
        {
            echo $one_pixel_image;
        }
    }
    else 
    {
        $new_img_url = "//" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"] . "&show_image=1";
        $script = preg_replace($regex, "$1" . $new_img_url . "$3", $script);
        
        header(TEXT_CONTENT_TYPE);
        echo $script;
    }
} 
catch (Exception $e) 
{
    if($show_image)
    {
        header(IMG_CONTENT_TYPE);
        echo $one_pixel_image;
    }
}
?>
