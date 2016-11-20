<?php

namespace Emall\Database;

use PDO;

class Database
{

  private $server     = 'localhost',
          $username   = 'root',
          $password   = 'root',
          $db_name    = 'e_mall';

  private $_conn;
  private static $_instance = null;

  // property varioable
  private $table, $columns = '*', $_query, $_statement, $_attr, $_join, $_lastid;

  // property array
  private $_params = [], $_prevData = [];

  function __construct()
  {
   try {
        $this->_conn = new PDO("mysql:host=$this->server;dbname=$this->db_name", $this->username, $this->password);
        $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   } catch (Exception $e) {
      die($e->getMessage());
   }
  }

  public static function getInstance()
  {
    if (!isset(self::$_instance)) {
        self::$_instance = new Database();
    }
    return self::$_instance;
  }

  public function __clone()
  {
    return false;
  }

  public function lastID()
  {
		return $this->_lastid;
	}

  public function setTable($table)
  {
    $this->table = $table;
    return $this;
  }

  public function select($columns = '*', $optional ='')
  {
    $this->_query = "SELECT $optional $columns FROM $this->table";
    $this->columns = $columns;
    return $this;
  }

  public function run()
  {
    // var_dump($this->_params);
    // die($this->_query . ' ' . $this->_join . ' ' . $this->_attr);
    try {
        $this->_statement = $this->_conn->prepare($this->_query . ' ' . $this->_join . ' ' . $this->_attr);
        $this->_statement->execute($this->_params);
        $this->_lastid = $this->_conn->lastInsertId();
        $this->flush();
    } catch (Exception $e) {
        die($e->getMessage());
    }
  }

  public function all()
  {
    $this->run();
    return $this->_statement->fetchAll(PDO::FETCH_OBJ);
  }

  public function first()
  {
    $this->run();
    return $this->_statement->fetch(PDO::FETCH_OBJ);
  }

  public function where($col, $sign, $value, $bridge = ' AND ') {
    if (count($this->_prevData) == 0) {
      $bridge = '';
    }

    $this->_query = "SELECT $this->columns FROM $this->table";
    $this->_prevData[] = array(
                              'col'     => $col,
                              'sign'    => $sign,
                              'value'   => $value,
                              'bridge'  => $bridge
                            );
    $this->getWhere($bridge);
    return $this;
  }

  public function getWhere($bridge)
  {
    if ($this->_prevData > 1) {
        $this->_attr = 'WHERE ';
        $this->_params = [];
    }

    $x = 1;
    foreach ($this->_prevData as $prev)
    {

      if ($x <= count($this->_prevData)) {
          $this->_attr .= $prev['bridge'];
      }

      $this->_attr .= $prev['col'] . ' ' . $prev['sign'] . ' ?';
      $this->_params[] = $prev['value'];

      $x++;
    }
    return $this;
  }

  public function orWhere($col, $sign, $value)
  {
    $this->where($col, $sign, $value, $bridge = ' OR ');
    return $this;
  }

  public function create(array $fields)
  {
    $cols   = implode(",", array_keys($fields));
    $values = '';
    $x      = 1;

    foreach ($fields as $field) {
      $this->_params[] = $field;
      $values .= '?';

      if ($x < count($fields)) {
         $values .= ',';
      }
      $x++;
    }
    $this->_query = "INSERT INTO $this->table($cols) VALUES ($values)";
    $this->run();
  }

  public function update(array $fields)
  {
    $cols = '';
    $x    = 1;
    $total_params = count($this->_params);

    foreach ($fields as $key => $value) {
      $this->_params[] = $value;
      $cols .= $key . '=?';

      if ($x < count($fields)) {
          $cols .= ",";
      }
      $x++;
    }

    for ($i=0;$i<$total_params;$i++) {
        $this->_params[] = array_shift($this->_params);
    }


    $this->_query = "UPDATE $this->table SET $cols";
    $this->run();
  }

  public function delete()
  {
    $this->_query = "DELETE FROM $this->table";
    $this->run();
  }

  public function orderBy($cols = 'id', $type)
  {
    $this->_attr .= " ORDER BY $cols $type";
    return $this;
  }

  public function limit($num)
  {
    $this->_attr .= " LIMIT $num";
    return $this;
  }

  public function flush()
  {
    $this->_query     = '';
    $this->_join      = '';
    $this->_attr      = '';
    $this->_params    = [];
    $this->_prevData  = [];
  }

  public function join($table, $first_col, $sign, $second_col)
  {
    $this->_join .= " INNER JOIN $table ON $first_col $sign $second_col ";
    return $this;
  }

  public function leftJoin($table, $first_col, $sign, $second_col)
  {
    $this->_join .= " LEFT JOIN $table ON $first_col $sign $second_col ";
    return $this;
  }

  public function rightJoin($table, $first_col, $sign, $second_col)
  {
    $this->_join .= " RIGHT JOIN $table ON $first_col $sign $second_col ";
    return $this;
  }

  public function fullJoin($table, $first_col, $sign, $second_col)
  {
    $this->_join .= " FULL OUTER JOIN $table ON $first_col $sign $second_col ";
    return $this;
  }

  public function union($columns, $table, $first_col, $sign, $second_col)
  {
    $this->_query .= "SELECT $columns FROM $this->table LEFT JOIN $table ON $first_col $sign $second_col UNION ALL SELECT $columns FROM $this->table RIGHT JOIN $table ON $first_col $sign $second_col";
    return $this;
  }

}
