<?php
inc([
    'db',
    'model'
]);
if(isset($_GET['sitea'],$_GET['siteb'])){
    $db=db();
    $data=[
        'site'=>@$_GET['sitea'],
        'db'=>$db
    ];
    $sitea=model('um',$data);
    $data=[
        'site'=>@$_GET['siteb'],
        'db'=>$db
    ];
    $siteb=model('um',$data);
    $data=[
        'title'=>'Cisco',
        'sitea'=>$sitea,
        'siteb'=>$siteb
    ];
}else{
    $data=[
        'title'=>'Cisco'
    ];
}
view('dois',$data);
