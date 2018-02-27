<h2>Table</h2>
<?php if(printCheck(checkTable($_schema, $_table))): ?> 
    <p><?= $_schema ?> : <?= $_table ?></p>
    <table>
        <tr><th>Column</th><th>Type</th><th>Nullable</th><th>Default</th></tr>
        <?php foreach (getTableColumnsList($_schema, $_table) as $column): ?>
        <tr>
            <td><?= $column['column_name'] ?></td>
            <td><?= $column['data_type'] //character_maximum_length, numeric_precision, numeric_scale, datetime_precision ?></td>
            <td><?= $column['is_nullable'] ?></td>
            <td><?= $column['column_default'] ?></td>
        </tr>
        <?php endforeach ?>
    </table>
    <ul class="nav">
        <li><a href="?page=table_display&schema=<?= $_schema ?>&table=<?= $_table ?>">Display</a></li>
        <li><a href="?page=table_insert&schema=<?= $_schema ?>&table=<?= $_table ?>">Insert</a></li>
    </ul>
<?php endif ?>