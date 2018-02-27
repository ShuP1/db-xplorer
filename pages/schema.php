<h2>Schema</h2>
<?php if(printCheck(checkSchema($_schema))): ?>
    <p><?= $_schema ?></p>
    <table>
        <tr><th>Table</th></tr>
        <?php foreach(getTablesListBySchema($_schema) as $table):?>
        <tr><td><a href="?page=table&schema=<?= $_schema ?>&table=<?= $table ?>"><?= $table ?></a></td></tr>
        <?php endforeach ?>
    </table>
<?php endif ?>