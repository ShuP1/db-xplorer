<?php 
if(!empty($_POST)){
    foreach ($_loginFields as $key) {
        if(isset($_POST[$key]))
            $_SESSION[$key] = $_POST[$key];
    }
    header("Location: .");
}
?>
<h2>Connect</h2>
<form action="." method="post">
    <p>
        <label for="string">String</label>
        <input type="text" name="db_string" id="string" placeholder="pgsql:host=localhost">
    </p>
    <p>
        <label for="name">Database</label>
        <input type="text" name="db_name" id="name">
    </p>
    <p>
        <label for="user">User</label>
        <input type="text" name="db_user" id="user">
    </p>
    <p>
        <label for="password">Password</label>
        <input type="password" name="db_password" id="password">
    </p>
    <p>
        <input type="submit" value="Go">
    </p>
</form>