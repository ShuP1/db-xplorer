<h2>Table Insert</h2>
<?php if(printCheck(checkTable($_schema, $_table))):
    $columns = getTableColumnsNames($_schema, $_table); ?> 
    <p><?= $_schema ?> : <?= $_table ?></p>
    <?php if(!empty($_POST)):
        try{
            $data = array();
            foreach ($_POST as $key => $value) {
                if(!endsWith($key, "-null")){
                    if(!in_array($key, $columns))
                        throw new Exception("Wrong column name : ".htmlspecialchars($key));

                    if(!isset($_POST[$key.'-null']))
                        $data[$key] = $value;
                }
            }
            insertTableLine($_schema, $_table, $data);
            echo "<p>Insertion complete</p>";
        }catch(Exception $e){
            echo "<p class=\"error\">".$e->getMessage()."</p>";
        } ?>
    <?php else: ?>
    <form action="?page=table_insert&schema=<?= $_schema ?>&table=<?= $_table ?>" method="post">
        <?php foreach ($columns as $column): ?>
            <p>
                <label for="<?= $column ?>"><?= $column ?></label>
                <input type="text" name="<?= $column ?>" id="<?= $column ?>">
                <br><input type="checkbox" name="<?= $column ?>-null"> NULL
            </p>
        <?php endforeach ?>
        <input type="submit" value="Save">
    </form>
    <?php endif ?>
    <ul class="nav">
        <li><a href="?page=table&schema=<?= $_schema ?>&table=<?= $_table ?>">Back</a></li>
        <li><a href="?page=table_display&schema=<?= $_schema ?>&table=<?= $_table ?>">Display</a></li>
    </ul>
<?php endif ?>