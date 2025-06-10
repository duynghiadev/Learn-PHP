<?php
if (!defined('_CODE')) {
    die('Access denied...');
}

/**
 * Execute a SQL query with optional data binding
 * @param string $sql The SQL query
 * @param array $data Data to bind to the query
 * @param bool $check If true, return the PDOStatement object
 * @return bool|PDOStatement Query result or PDOStatement if $check is true
 */
function query($sql, $data = [], $check = false)
{
    global $conn;
    $result = false;

    // Ensure $conn is a PDO object
    if (!$conn instanceof PDO) {
        die('Database connection is not initialized.');
    }

    try {
        $statement = $conn->prepare($sql);

        if (!empty($data)) {
            $result = $statement->execute($data);
        } else {
            $result = $statement->execute();
        }
    } catch (Exception $exp) {
        echo $exp->getMessage() . '<br>';
        echo 'File: ' . $exp->getFile() . '<br>';
        echo 'Line: ' . $exp->getLine();
        die();
    }

    if ($check) {
        return $statement;
    }

    return $result;
}

/**
 * Insert data into a table
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @return bool True on success, false on failure
 */
function insert($table, $data)
{
    $key = array_keys($data);
    $truong = implode(',', $key);
    $valuetb = ':' . implode(',:', $key);

    $sql = 'INSERT INTO ' . $table . ' (' . $truong . ') VALUES(' . $valuetb . ')';

    $kq = query($sql, $data);
    return $kq;
}

/**
 * Update data in a table
 * @param string $table Table name
 * @param array $data Associative array of column => value pairs
 * @param string $condition Optional WHERE condition
 * @return bool True on success, false on failure
 */
function update($table, $data, $condition = '')
{
    $update = '';
    foreach ($data as $key => $value) {
        $update .= $key . '= :' . $key . ',';
    }
    $update = trim($update, ',');

    if (!empty($condition)) {
        $sql = 'UPDATE ' . $table . ' SET ' . $update . ' WHERE ' . $condition;
    } else {
        $sql = 'UPDATE ' . $table . ' SET ' . $update;
    }
    $kq = query($sql, $data);
    return $kq;
}

/**
 * Delete data from a table
 * @param string $table Table name
 * @param string $condition Optional WHERE condition
 * @return bool True on success, false on failure
 */
function delete($table, $condition = '')
{
    if (empty($condition)) {
        $sql = 'DELETE FROM ' . $table;
    } else {
        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $condition;
    }

    $kq = query($sql);
    return $kq;
}

/**
 * Fetch multiple rows from a query
 * @param string $sql SQL query
 * @return array Fetched data as associative array, or empty array on failure
 */
function getRaw($sql)
{
    $kq = query($sql, '', true);
    if (is_object($kq) && $kq instanceof PDOStatement) {
        $dataFetch = $kq->fetchAll(PDO::FETCH_ASSOC);
        return $dataFetch ?: [];
    }
    return [];
}

/**
 * Fetch one row from a query
 * @param string $sql SQL query
 * @return array|null Fetched row as associative array, or null on failure
 */
function oneRaw($sql)
{
    $kq = query($sql, '', true);
    if (is_object($kq) && $kq instanceof PDOStatement) {
        $dataFetch = $kq->fetch(PDO::FETCH_ASSOC);
        return $dataFetch ?: null;
    }
    return null;
}

/**
 * Count rows from a query
 * @param string $sql SQL query
 * @return int Number of rows, or 0 on failure
 */
function getRows($sql)
{
    $kq = query($sql, '', true);
    if (is_object($kq) && $kq instanceof PDOStatement) {
        return $kq->rowCount();
    }
    return 0;
}
