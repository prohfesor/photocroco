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
    <img src="http://placehold.it/48x48" class="img-rounded pull-right" width="48"
         height="48">

    <p>By Mr. John</p>
</div>
<div class="well clearfix">
    <img src="http://placehold.it/48x48" class="img-rounded pull-right" width="48"
         height="48">

    <p>By Mr. John</p>
</div>
<div class="well clearfix">
    <img src="http://placehold.it/48x48" class="img-rounded pull-right" width="48"
         height="48">

    <p>By Mr. John</p>
</div>


<a href="#myModal" role="button" class="btn" data-toggle="modal">Join</a>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
        <h3 id="myModalLabel">Join game!</h3>
    </div>
    <div class="modal-body">
        <p>One fine body</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary">Play</button>
    </div>
</div>


<?php include('_footer.php'); ?>