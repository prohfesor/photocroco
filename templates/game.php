<?php include('_header.php'); ?>

<h1>What is it?</h1>

<div id="img-question" class="well centered">
    <img src="http://nophoto.info/nature/400x300.jpeg" align="center">
</div>

<form class="form-inline" id="form-newgame">
    <div class="control-group centered">
        <input type="text" name="login" placeholder="Answer" class="input-xlarge">
        <a class="btn btn-large btn-primary" href="#start"><span class="btn-label">Send</span></a>
    </div>
</form>

    <script>
        var id = '<?php echo $id; ?>';

        jQuery(document).ready(function(){
            listen_status(id);
        });
    </script>

<?php include('_footer.php'); ?>