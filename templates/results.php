<?php include('_header.php'); ?>

<h2>Yes!!! The answer is <?php echo $game['question'] ?></h2>

<h3>The winner is: <?php echo $game['winner'] ?></h3>

<?php foreach ($game['answers'] as $answer) : ?>
<p class="text-info"><?php echo key($answer) ?>: <b><?php echo reset($answer) ?></b></p>
<?php endforeach; ?>

<?php include('_footer.php'); ?>