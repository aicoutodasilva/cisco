<?php
inc([
    'db',
    'model'
]);


function getHttpCode($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("User-Agent:  Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:65.0) Gecko/20100101 Firefox/65.0"));
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3000);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY  , true);  // we don't need body
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch); // Don't forget to close the connection
    return $response;
}

function httpOk($url){
    $url='http://'.$url;
    $code=getHttpCode($url);
    if($code=="200"){
        return true;
    }else{
        return false;
    }
}

function httpsOk($url){
    $url='https://'.$url;
    $code=getHttpCode($url);
    if($code=="200"){
        return true;
    }else{
        return $code;
    }
}

// if($single==5){

// }else{
//     print $single;
// }
// sleep(2);

//pega o single
//busca pelo single
//verifica o status
//se o status for igual a 200 salva
//curl "http://public.local/teste?single=[1-1000000]&name=x" -s -m 1
set_time_limit(0);
model("sites");
$single=$_GET['single'];
$url=readSingle($single)['site'];
$url=trim($url);
if(httpOk($url) || httpsOk($url)){
    $filename=ROOT.$_GET['name'].'.txt';
    $data=$single.PHP_EOL;
    file_put_contents($filename,$data,FILE_APPEND);
    print $single.chr(9).$url;
}else{
    header('HTTP/1.0 404 Not Found');
    echo $single.chr(9).'*******************************************';
}
?>
