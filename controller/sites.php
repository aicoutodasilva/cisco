<?php
inc([
    'db',
    'model'
]);

//data view
$data=[
    'title'=>'Cisco'
];

//busca multisiete
if(isset($_GET['sites'])){
    //vars
    $db=db();
    $sitesStr=$_GET['sites'];
    $sitesArr=explode(PHP_EOL,$sitesStr);
    $sitesArr=array_filter($sitesArr);
    $sitesArr=array_map('trim', $sitesArr);
    $sitesArr=array_map('strtolower', $sitesArr);
    $data['sitesValue']=implode(PHP_EOL,$sitesArr);
    $sites=array_values($sitesArr);

    //model
    model('sites');

    //data view
    foreach ($sites as $key => $site) {
        $data['sites']['site'.$key]=readSiteMonth($db,$site);
    }
}
//view
view('index',$data);
