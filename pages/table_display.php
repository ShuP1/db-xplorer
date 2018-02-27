<h2>Table Display</h2>
<?php if(printCheck(checkTable($_schema, $_table))):
    $pageCount = ceil(getTableCount($_schema, $_table) / $config['limit_size']);
    if($_offset < 0 || $_offset > $pageCount): ?>
    <p class="error">Offset out of range</p>
<?php else: ?>
    <p><?= $_schema ?> : <?= $_table ?></p>
    <div>
        <p><?php if($_offset > 0): ?>
            <a href="?page=table_display&schema=<?= $_schema ?>&table=<?= $_table ?>&offset=<?= $_offset-1 ?>">&lt;</a>
        <?php endif;
        echo ($_offset+1)." / ".($pageCount);
        if($_offset < $pageCount-1): ?>
            <a href="?page=table_display&schema=<?= $_schema ?>&table=<?= $_table ?>&offset=<?= $_offset+1 ?>">&gt;</a>
        <?php endif ?>
        </p>
    </div>
    <table>
        <?php $content = getTableContentList($_schema, $_table, $_offset*$config["limit_size"]); ?>
        <tr><th><?= implode('</th><th>', array_keys($content[0])) ?></th></tr>
        <?php foreach($content as $row): ?>
            <tr>
            <?php foreach ($row as $value): ?>
                <td><?= is_null($value) ? "<span class=\"null-val\">NULL</span>" : substr($value, 0, $config["display_length"]).(strlen($value) > $config["display_length"] ? '...' : '') ?></td>
            <?php endforeach
            /*<td><a href="?page=table_edit&schema=<?= $_schema ?>&table=<?= $_table ?>">&#9998;</a></td>
                <td><a href="?page=table_remove&schema=<?= $_schema ?>&table=<?= $_table ?>">&#10060;</a></td> */ ?>
            </tr>
        <?php endforeach ?>
    </table>
    <ul class="nav">
        <li><a href="?page=table&schema=<?= $_schema ?>&table=<?= $_table ?>">Back</a></li>
        <li><a href="?page=table_insert&schema=<?= $_schema ?>&table=<?= $_table ?>">Insert</a></li>
    </ul>
<?php endif; endif ?>