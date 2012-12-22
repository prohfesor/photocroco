<?php include('_header.php'); ?>

<div class="hero-unit">
    <h1>After While Crocodile</h1>
</div>

<div class="btn-toolbar">
    <div class="btn-group">
        <a class="btn btn-large pull-right" href="#create"><span class="btn-label">Create Room</span></a>
    </div>
</div>

<form class="form-vertical" id="form-newgame" style="display: none">
    <div class="control-group">
        <div class="controls">
            <input type="text" name="login" placeholder="username" class="input-large">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Enter a word for machine to show:</label>

        <div class="controls">
            <input type="text" name="question" placeholder="question" class="input-large">
        </div>
    </div>
    <a class="btn btn-large btn-primary" href="#start"><span class="btn-label">Start!</span></a>
</form>

<h1>Active Games</h1>

<?php foreach($games as $game): ?>
    <div class="well clearfix">
        <img src="http://nophoto.info/colors/48x48.jpg?nc1" class="img-rounded pull-right" width="48" height="48">

        <p>Now playing: <?php echo $game['users'] ?></p>
        <p>By <?php echo $game['admin'] ?></p>
        <p>
            <a href="#joinform" role="button" class="btn" onclick="joinshow('#form-game-<?php echo $game['id'] ?>')">Join</a>
            <form class="form-inline form-join" id="form-game-<?php echo $game['id'] ?>" style="display: none">
                <div class="control-group">
                    <input type="hidden" name="id" value="<?php echo $game['id'] ?>">
                    <input type="text" name="login" placeholder="login" class="input-large">
                    <input type="submit" class="btn btn-primary" href="#join" value="Play">
                </div>
            </form>
        </p>
    </div>
<?php endforeach ?>


<?php include('_footer.php'); ?>