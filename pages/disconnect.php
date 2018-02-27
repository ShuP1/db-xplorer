<?php
foreach ($_loginFields as $key)
    unset($_SESSION[$key]);
?>
<h2>Disconnected</h2>