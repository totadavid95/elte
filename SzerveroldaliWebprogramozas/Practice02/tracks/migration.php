<?php
    // Ez a fájl a tracks.array.json fájlban tárolt adatokat migrálja át a SleekDB-s adatbázisunkba
    
    require 'vendor/autoload.php';

    $data = './sleekdb_data';
    $store = \SleekDB\SleekDB::store('tracks', $data);

    // Store törlése, majd új store létrehozása
    $store->deleteStore();
    $store = \SleekDB\SleekDB::store('tracks', $data);

    // JSON fájl tartalmának beolvasása
    $tracks = json_decode(file_get_contents('tracks.array.json'), true);

    // ID-k eltávolítása (nincs rájuk szükség, mivel a SleekDB kezeli ezt)
    $tracks = array_map(
        function ($track) {
            echo 'Processing track: ' . $track['name'] . '<br>';
            unset($track['id']);
            return $track;
        }, $tracks
    );

    // Szemléltetés
    var_dump($tracks);

    // A módosított $tracks eltárolása az adatbázisban
    $store->insertMany($tracks);

    echo 'Migration successful';
?>