<?php
  $this->layout('layouts/default');
?>

<div id="main">
  <div class="row tracks-container">

    <div class="tracks">
    <h3>MIDI editor</h3>
    <a href="new2.php">Add new track...</a>
    <ul>
      <?php foreach($tracks as $track) : ?>
      <li style="background-color: <?= $track['color'] ?>">
        <span>🎵 <?= $track['category'] ?></span>
        <?= $track['name'] ?> (<?= $track['instrument'] ?>)
      </li>
      <?php endforeach ?>
    </ul>
    </div>

  </div>
</div>
