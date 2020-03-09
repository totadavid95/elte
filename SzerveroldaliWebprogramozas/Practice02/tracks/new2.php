<?php
  require 'vendor/autoload.php';
  use Rakit\Validation\Validator;

  $data = './databases';
  $store = \SleekDB\SleekDB::store('tracks', $data);

  function add_track($store, $data) {
    $data["notes"] = [];
    $store->insert($data);
  }

  $data = [];
  $errors = [];
  if ($_POST) {
    $validator = new Validator();
    $validation = $validator->validate($_POST, [
      // Itt adjuk meg, hogy milyen szabályok szerint szeretnénk validálni az adatokat
      // További példák: https://github.com/rakit/validation
      'name' => 'required',
      'color' => 'required|regex:/^#[0-9a-f]{6}$/',
      'category' => 'required',
      'instrument' => 'required|integer',
    ]);

    // Ha a validáció nem sikerül, lekérjük a hibákat
    if ($validation->fails()) {
      $errors = $validation->errors();
      echo '<pre>';
      print_r($errors->firstOfAll());
      echo '</pre>';
    } else {
      // Ha a validáció sikeres volt, le kell kérnünk az adatokat, majd eltárolni őket
      $data = $validation->getValidData();
      add_track($store, $data);
      header('Location: index2.php');
      exit();
    }
  }

  // A new nevű sablont töltjük be
  $templates = new League\Plates\Engine('./templates');
  echo $templates->render('new', ['errors' => $errors]);
?>