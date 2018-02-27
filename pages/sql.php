<h2>SQL</h2>
<?php if(isset($_POST['sql'])):
    try{
        echo printAssocTable(getQuery($_POST['sql']), null);
    }catch(Exception $e){
        echo "<p class=\"error\">".$e->getMessage()."</p>";
    } ?>
<?php else: ?>
    <form action="?page=sql" method="post">
        <p><textarea name="sql" id="sql" cols="30" rows="10" placeholder="SELECT * FROM ..."></textarea></p>
        <p><input type="submit" value="Run"></p>
    </form>
<?php endif ?>