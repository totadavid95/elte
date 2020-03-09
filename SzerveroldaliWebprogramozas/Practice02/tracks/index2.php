<?php
    require './vendor/autoload.php';

    $data = './databases';
    $store = \SleekDB\SleekDB::store('tracks', $data);
    $tracks = $store->fetch();

    // A list nevű sablont töltjük be
    $templates = new League\Plates\Engine('./templates');
    echo $templates->render('list', ['tracks' => $tracks]);
?>
