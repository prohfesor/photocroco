<?php include('_header.php'); ?>

<h3>The winner is: <?= $game['winner'] ?></h3>

<?php foreach ($game['answers'] as $answer) : ?>
<p class="text-info"><?= key($answer) ?>: <b><?= reset($answer) ?></b></p>
<?php endforeach; ?>

<?php include('_footer.php'); ?>