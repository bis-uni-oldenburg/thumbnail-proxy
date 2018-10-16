<?php 
/*
 * Proxy: Loading cover thumbnails from syndetics.com
 * Lars Heuer, BIS Oldenburg - 10.2018
 *
 * Default link template:
 * {{proxy_server}}syndetics.com/index.aspx?isbn={{addata/isbn}}/SC.JPG&client=primo
 *
 * Custom proxy link template:
 * https://orbis-oldenburg.de/cover/syndetics.php?isbn={{addata/isbn}}
 */

header("content-type:image/png");

$one_pixel_image = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');

if(!isset($_GET["isbn"]))
{
    echo $one_pixel_image;
    exit;
}

$isbn = $_GET["isbn"];

$syndetics_url = "https://syndetics.com/index.aspx?isbn=%isbn%;/SC.JPG&client=primo";
$image_url = str_replace("%isbn%", $isbn, $syndetics_url);

try 
{
    $image = file_get_contents($image_url);
    
    echo $image;
} 
catch (Exception $e) 
{
    echo $one_pixel_image;
}
?>