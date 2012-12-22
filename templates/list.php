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
        <label class="control-label">Username</label>

        <div class="controls">
            <input type="text" name="login" class="input-large">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Your question</label>

        <div class="controls">
            <input type="text" name="question" class="input-large">
        </div>
    </div>
    <a class="btn btn-large btn-primary" href="#start"><span class="btn-label">Start!</span></a>
</form>

<h1>Active Games</h1>
<div class="well clearfix">
    <img src="http://nophoto.info/colors/48x48.jpg?nc1" class="img-rounded pull-right" width="48" height="48">

    <p>By Mr. John</p>

    <p>
        <a href="#joinform" role="button" class="btn" data-toggle="modal">Join</a>

    <form class="form-inline" id="form-newgame" style="display: none">
        <div class="control-group">
            <input type="text" name="login" placeholder="login" class="input-large">
            <a class="btn btn-primary" href="#join">Play</a>
        </div>
    </form>
    </p>
</div>
<div class="well clearfix">
    <img src="http://nophoto.info/colors/48x48.jpg?nc2" class="img-rounded pull-right" width="48" height="48">

    <p>By Mr. John</p>

    <p>
        <a href="#joinform" role="button" class="btn" data-toggle="modal">Join</a>

    <form class="form-inline" id="form-newgame" style="display: none">
        <div class="control-group">
            <input type="text" name="login" placeholder="login" class="input-large">
            <a class="btn btn-primary" href="#join">Play</a>
        </div>
    </form>
    </p>
</div>
<div class="well clearfix">
    <img src="http://nophoto.info/colors/48x48.jpg?nc3" class="img-rounded pull-right" width="48" height="48">

    <p>By Mr. John</p>

    <p>
        <a href="#joinform" role="button" class="btn" data-toggle="modal">Join</a>

    <form class="form-inline" id="form-newgame" style="">
        <div class="control-group">
            <input type="text" name="login" placeholder="login" class="input-large">
            <a class="btn btn-primary" href="#join">Play</a>
        </div>
    </form>
    </p>
</div>


<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel">Join game!</h3>
    </div>
    <div class="modal-body">
        <form class="form-inline" id="form-newgame">
            <div class="control-group centered">
                <input type="text" name="login" placeholder="login" class="input-xlarge">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <a class="btn btn-primary" href="#join">Play</a>
    </div>
</div>


<?php include('_footer.php'); ?>