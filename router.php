<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>DB Xplorer - <?= $_page ?></title>
</head>
<body><div id="content">
    <header>
        <?php if(!empty($_SESSION)): ?><p class="logout"><a href="?page=disconnect">&#128682;</a></p><?php endif ?>
        <h1><a href="./">DB Xplorer</a></h1>
    </header>
    <nav>
        <p><ul>
            <li><a href="?page=schemas">Schemas</a></li>
            <li><a href="?page=tables">Tables</a></li>
            <li><a href="?page=sql">SQL</a></li>
        </ul></p>
    </nav>
    <section>
        <?php
        
        if(in_array($_page, array('sql', 'connect', 'disconnect', 'fail', 'schemas', 'schema', 'tables', 'table', 'table_display', 'table_insert')))
            include("pages/$_page.php");
        else
            echo "<p>A minimal, unsafe and maybe usefull sql database explorer</p>";
        ?>
    </section>
    <footer>
        <p>2018 &copy; Bois Clément</p>
    </footer>
</div></body>
</html>