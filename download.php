<?


function safeName($filename) {
    $filename = strtolower($filename);
    $filename = str_replace("#","_",$filename);
    $filename = str_replace(" ","_",$filename);
    $filename = str_replace("'","",$filename);
    $filename = str_replace('"',"",$filename);
    $filename = str_replace("__","_",$filename);
    $filename = str_replace("&","and",$filename);
    $filename = str_replace("/","_",$filename);
    $filename = str_replace("\\","_",$filename);
    $filename = str_replace("?","",$filename);
    return $filename;
}


$row = vae($_REQUEST['id']);
$ext = end(explode(".", vae_file($row->file)));
$filename = vae_file($row->file);
$title = safeName((string)$row->title).".".$ext;

vae_disable_verbml();

header('Content-Type: application/download');
header('Content-disposition: attachment; filename="' . $title. '"');
readfile(vae_data_path().$filename);


?>