<h2>Schemas</h2>
<table>
    <tr><th>Schema</th></tr>
    <?php foreach(getSchemasList() as $schema):?>
    <tr><td><a href="?page=schema&schema=<?= $schema ?>"><?= $schema ?></a></td></tr>
    <?php endforeach ?>
</table>