<h2>Tables</h2>
<table border="1">
    <tr><th>Schema</th><th>Table</th></tr>
    <?php foreach (getTablesList() as $table): ?>
    <tr>
        <td><a href="?page=schema&schema=<?= $table['table_schema'] ?>"><?= $table['table_schema'] ?></a></td>
        <td><a href="?page=table&schema=<?= $table['table_schema'] ?>&table=<?= $table['table_name'] ?>"><?= $table['table_name'] ?></a></td>
    </tr>
    <?php endforeach ?>
</table>