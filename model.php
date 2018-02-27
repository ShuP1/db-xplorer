<?php

$_loginFields = array("db_string", "db_name", "db_user", "db_password");
$logable = true;
foreach ($_loginFields as $key) {
    if(!isset($_SESSION[$key]))
        $logable = false;
}
if($logable){
    try {
        $db = new PDO($_SESSION['db_string'].';dbname='.$_SESSION['db_name'],
        $_SESSION['db_user'], 
        $_SESSION['db_password'],
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ));
    } catch (PDOException $e) {
        $_error = $e->getMessage();
        $_page = 'fail';
    }
}else{
    if($_page != 'disconnect')
        $_page = 'connect';
}

function getQuery($query){
    global $db;
    return $db->query($query)->fetchall();
}

function getPrepareQuery($query, $args){
    global $db;
    $sth = $db->prepare($query);
    $sth->execute($args);
    return $sth->fetchAll();
}

function getSchemasList(){
    $schemas = array();
    foreach (getQuery('SELECT schema_name FROM information_schema.schemata') as $schema) {
        $schemas[] = $schema['schema_name'];
    }
    return $schemas;
}

function getTablesList(){
    global $db;
    return $db->query("SELECT table_schema, table_name FROM information_schema.tables WHERE table_type = 'BASE TABLE' AND table_schema NOT IN ('pg_catalog', 'information_schema')")->fetchall();
}

function getTablesListBySchema($schema){
    $tables = array();
    foreach (getPrepareQuery("SELECT table_name FROM information_schema.tables WHERE table_type = 'BASE TABLE' AND table_schema = ?", array($schema)) as $table) {
        $tables[] = $table['table_name'];
    }
    return $tables;
}

function getTableColumnsList($schema, $table){
    return getPrepareQuery("SELECT column_name, column_default, is_nullable, data_type, character_maximum_length, numeric_precision, numeric_scale, datetime_precision FROM information_schema.columns WHERE table_schema = ? AND table_name = ? ORDER BY ordinal_position", array($schema, $table));
}

function getTableColumnsNames($schema, $table){
    $columns = array();
    foreach (getPrepareQuery("SELECT column_name FROM information_schema.columns WHERE table_schema = ? AND table_name = ? ORDER BY ordinal_position", array($schema, $table)) as $column) {
        $columns[] = $column['column_name'];
    }
    return $columns;
}

function getTableContentList($schema, $table, $offset = 0){
    global $config;
    //Note: check schema and table before !!!
    return getPrepareQuery("SELECT * FROM \"$schema\".\"$table\" LIMIT ".$config["limit_size"]." OFFSET ?", array($offset));
}

function getTableCount($schema, $table){
    //Note: check schema and table before !!!
    return getQuery("SELECT COUNT(*) count FROM \"$schema\".\"$table\"")[0]["count"];
}

function insertTableLine($schema, $table, $data){
    //REALLY UNSAFE
    //Note: check schema and table before !!!
    global $db;
    $sql = "INSERT INTO \"$schema\".\"$table\"(";
    $first = key($data);
    foreach ($data as $key => $value) {
        if($key !== $first) $sql .= ", ";
        $sql .= "\"$key\"";
    }
    $sql .= ") VALUES (";
    foreach ($data as $key => $value) {
        if($key !== $first) $sql .= ", ";
        $sql .= $db->quote($value);
    }
    $sql .= ")";
    return getQuery($sql);
}

//render
function printAssocTable($data, $fn){
    $str = '<table>';
    $str .= '<tr><th>'.implode('</th><th>', array_keys($data[0])).'</th></tr>';
    foreach($data as $row){
        $str .= '<tr>'.($fn != null ? fn($row) : '<td>'.implode('</td><td>', $row).'</td>').'</tr>';
    }
    return $str.'</table>';
}

function checkSchema($schema){
    if($schema == null)
        return '<p class="error">Any schema selected</p>';
    
    if(!in_array($schema, getSchemasList()))
        return '<p class="error">Unknown schema</p>';

    return true;
}

function checkTable($schema, $table){
    $check_schema = checkSchema($schema);
    if($check_schema !== true)
        return $check_schema;

    if ($table == null)
        return '<p class="error">Any base selected</p>';
    
    if (!in_array($table, getTablesListBySchema($schema)))
        return '<p class="error">Unknown base</p>';

    return true;
}

function printCheck($check){
    if($check !== true)
        echo $check;
    
    return $check === true;
}


function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}