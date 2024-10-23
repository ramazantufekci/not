<?php
namespace App;
$link = "";
header('Content-Type: text/html; charset=utf-8');
header("X-Content-Type-Options: nosniff");
//header("cache-control: max-age=1");
//var_export($_SERVER);
//$_SERVER["PHP_AUTH_USER"]="";

if($_GET && isset($_GET["islem"]))
{
        if($_GET["islem"] == "cik")
        {
                $_SERVER["PHP_AUTH_USER"] = "";
                header("Location: /not.php");
                $LoginSuccessful = false;
        }
}

if(isset($_SERVER["HTTP_AUTHORIZATION"]))
{

        //var_export($_SERVER);
        $sifre = base64_decode(str_replace("Basic","",$_SERVER["HTTP_AUTHORIZATION"]));
        //var_export(explode(":",$sifre));
}
$LoginSuccessful = false;

// Check username and password:
if (isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])){

    $Username = $_SERVER['PHP_AUTH_USER'];
    $Password = $_SERVER['PHP_AUTH_PW'];

    if ($Username == 'kullanici' && $Password == 'sifre'){
        $LoginSuccessful = true;
    }
}

// Login passed successful?
if (!$LoginSuccessful){

    /*
    ** The user gets here if:
    **
    ** 1. The user entered incorrect login data (three times)
    **     --> User will see the error message from below
    **
    ** 2. Or the user requested the page for the first time
    **     --> Then the 401 headers apply and the "login box" will
    **         be shown
    */

    // The text inside the realm section will be visible for the
    // user in the login box
    header('WWW-Authenticate: Basic realm="Sifre Gir: "');
    header('HTTP/1.0 401 Unauthorized');

    print "Yasak Bölge!\n";

}
else {

    // The user entered the correct login data, put
    // your confidential data in here:
        $link .=  "<a href=\"/not.php?islem=cik\">{$Username} Çıkış Yap</a>";
        $link .= "<br /><a href=\"/not.php\">Not Yaz </a>";
}


if($_POST)
{
        
        $data = json_decode(file_get_contents("not.json"),true);
        if(!is_array($data)){$data = array();}
        array_push($data,$_POST["not"]);
        file_put_contents("not.json",json_encode($data));
    


}else{

if($LoginSuccessful){
$content = "";
if(!$_GET){
$data = json_decode(file_get_contents("not.json"),true);
krsort($data);
foreach($data as $key=>$dat)
{
        if(preg_match("%^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@|\d{1,3}(?:\.\d{1,3}){3}|(?:(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)(?:\.(?:[a-z\d\x{00a1}-\x{ffff}]+-?)*[a-z\d\x{00a1}-\x{ffff}]+)*(?:\.[a-z\x{00a1}-\x{ffff}]{2,6}))(?::\d+)?(?:[^\s]*)?$%iu",$dat,$match))
        {
                $content.= "<li class=\"list-group-item d-flex justify-content-between align-items-center\"><a href=\"{$dat}\" target=\"_blank\">".$dat."</a><a href=\"not.php?id={$key}\" class=\"btn btn-warning\">Düzenle</a></li>";
        }
        else{$content.= "<li class=\"list-group-item d-flex justify-content-between align-items-center\">".nl2br($dat)."<a href=\"not.php?id={$key}\" class=\"btn btn-warning\">Düzenle</a></li>";}
}
}else{
        $data = json_decode(file_get_contents("not.json"),true);
        krsort($data);
        $id = (int)$_GET["id"];
        $data = $data[$id];

}

?>
<!DOCTYPE html>
<html lang="tr">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#F7F8F9">
        <title>Not Yaz</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="manifest" href="/manifest.json">
<script>
if('serviceWorker' in navigator){
        navigator.serviceWorker.register('/sw.js').then((reg)=>console.log('service worker registered',reg)).catch((err)=>console.log('service worker not registered',err));
}
/*navigator.serviceWorker.getRegistrations().then(registrations => {
    for (const registration of registrations) {
        registration.unregister();
    }
});*/
</script>
        </head>
        <body>
                <div class="container">
                        <h1>Merhaba Sahip</h1>
                        <?php echo $link;?>
                        <div class="row"><i class="bi-alarm"></i>
                                <div class="form-group">
                                        <form action="not.php" method="POST">
                                                <textarea class="form-control" id="not" placeholder="not yaz" name="not" rows="5"><?php  if(is_string($data) && strlen($data)>0){echo $data;}?></textarea>
                                                <input type="submit" class="btn btn-success float-end mt-2" value="Gönder Baba">
                                        </form>
                                </div>
                        </div>
<?php

echo "<div class=\"row mt-1\">";
echo "<ul class=\"list-group\">";
echo $content;
echo "</div>";
echo "</div>";
$c = array();
$tmpS="";
foreach($a as $key=>$b){
        $d=new stdClass();

        if($key>=1 && $key<24){
                $tmpS .= $b->not;
                if($key==23){$d->not = $tmpS;array_push($c,$d);$tmps="";}
        }
        else{
                
}
}
?>

</body>
</html>
