<?php
  require 'vendor/autoload.php';
  use Rakit\Validation\Validator;

  $data = './sleekdb_data';
  $store = \SleekDB\SleekDB::store('tracks', $data);

  /*function validate($post, &$data, &$errors) {
    if (!(isset($post['name']) && trim($post['name'])!=='')) {
      $errors['name'] = "The track name is required";
    } else {
      $data['name'] = $post['name'];
    }

    if (!(isset($post['color']) && trim($post['color'])!=='')) {
      $errors['color'] = "The track color is required";
    } 
    else if (filter_var($post['color'], FILTER_VALIDATE_REGEXP, [
      "options"=>[
        "regexp"=>"/^#[0-9a-f]{6}$/",
      ],
    ]) === false) {
      $errors['color'] = "The track color has a wrong format";
    }
    else {
      $data['color'] = $post['color'];
    }

    if (!(isset($post['category']) && trim($post['category'])!=='')) {
      $errors['category'] = "The category is required";
    } else {
      $data['category'] = $post['category'];
    }

    if (!(isset($post['instrument']) && trim($post['instrument'])!=='')) {
      $errors['instrument'] = "The instrument is required";
    }
    else if (filter_var($post['instrument'], FILTER_VALIDATE_INT) === false) {
      $errors['instrument'] = "The instrument has to be an integer";
    } else {
      $data['instrument'] = $post['instrument'];
    }
    
    return count($errors) === 0;
  }*/

  function add_track($store, $data) {
    /*$data["id"] = uniqid();
    $data["notes"] = [];

    $tracks = json_decode(file_get_contents('tracks.array.json'), true);
    $tracks[] = $data;
    file_put_contents('tracks.array.json', json_encode($tracks), LOCK_EX);*/

    $data["notes"] = [];
    $store->insert($data);
  }

  $data = [];
  $errors = [];
  if ($_POST) {
    /*if (validate($_POST, $data, $errors)) {
      add_track($store, $data);
      header('Location: index.php');
      exit();
    }*/
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
      header('Location: index.php');
      exit();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MIDI editor - Add new track</title>
    <link rel="stylesheet" href="http://webprogramozas.inf.elte.hu/webprog/zh/midi/midi.css">
  </head>

  <body>
    <h2>Add new track</h2>
    <form action="" method="post">
      <?php if ($errors) : ?>
        <div class="errors">
          <?= var_dump($errors) ?>
        </div>
      <?php endif ?>
      <div>
        <label for="name">Track name</label>
        <input type="text" id="name" name="name">
        (required)
      </div>
      <div>
        <label for="color">Color</label>
        <input type="text" id="color" name="color" placeholder="#1234af">
        (required, format: hex color code, e.g. #12af4d)
      </div>
      <div>
        <label for="category">Category</label>
        <input type="text" id="category" name="category" list="category-list">
        (required)
        <datalist id="category-list">
          <option value="Piano">
          <option value="Organ">
          <option value="Accordion">
          <option value="Strings">
          <option value="Guitar">
          <option value="Bass">
          <option value="Choir">
          <option value="Trumpet">
          <option value="Brass">
          <option value="Saxophone">
          <option value="Flute">
          <option value="Synth Lead">
          <option value="Synth Pad">
          <option value="Percussion">
          <option value="World">
          <option value="Synth effects">
          <option value="Sound effects">
        </datalist>
      </div>
      <div>
        <label for="instrument">Instrument</label>
        <select id="instrument" name="instrument">
          <option value="100">Instrument 1</option>
          <option value="200">Instrument 2</option>
          <option value="300">Instrument 3</option>
          <option value="400">Instrument 4</option>
          <option value="500">Instrument 5</option>
        </select>
        (required, number)
      </div>
      <div>
        <button type="submit">Add new track</button>
      </div>
    </form>
    <a href="index.php">Return to editor</a>
  </body>

</html>