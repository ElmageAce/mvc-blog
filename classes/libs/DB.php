<?php
namespace Elmage\libs;

use \PDO as PDO;

class DB extends PDO {

    /**
     * @var DatabaseConfiguration
     */
    private $_configuration;
    private $_error = false;//weather que00000000ry failed or not
    private $_query;
    private $_count;
    private $_results;

    /**
     * @param DatabaseConfiguration $config
     */
    public function __construct(\Elmage\libs\Config $config) {

        $this->_configuration = $config;

        parent::__construct('mysql:host=127.0.0.1;dbname=mvcblog', 'root', '');
        
        PDO::setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        PDO::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public function query($sql, $params = array()) {
        $this->_error = false;

        //check if query has been prepared properly
        if ($this->_query = $this->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }

            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(\PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    public function action($action, $table, $where = array(), $orderby = null, $join = null) {
        if (count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field    = $where[0];
            $operator = $where[1];
            $value    = $where[2];

            if (!empty($join)) {
                //"{$action} FROM {$table[0]} {$join} {$table[1]} ON {$field}={$value} ORDER BY {$orderby[0]} {$orderby[1]}"

                $field = $table[0] . '.' . $field;

                $value = $table[1] . '.' . $value;

                $sql = "{$action} FROM {$table[0]} {$join} {$table[1]} ON {$field}{$operator}{$value}";

                $this->_query = $this->prepare($sql);
                
                if (!$this->_query->execute()) {
                    
                    $this->_error = true;
                    
                } else {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

                    $this->_count = $this->_query->rowCount();

                }

                return $this;
            }

            if (!empty($orderby)) {
                
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} {$value} ORDER BY {$orderby[0]} {$orderby[1]}";

                $this->_query = $this->prepare($sql);
                
                if (!$this->_query->execute()) {
                    
                    $this->_error = true;
                    
                } else {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

                    $this->_count = $this->_query->rowCount();

                }

                return $this;
            }

            if (empty($orderby) && in_array($operator, $operators)) {

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";
                
                if (!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }

        }
        return false;

    }

    public function get($table, $where, $orderby = null) {

        if (!empty($orderby)) {
            return $this->action('SELECT *', $table, $where, $orderby);
        } else {
            return $this->action('SELECT *', $table, $where);
        }

    }

    public function getJoin($table, $where, $join) {
        return $this->action('SELECT *', $table, $where, null, $join);
    }

    public function delete($table, $where) {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array()) {
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = '';
            $x = 1;

            foreach ($fields as $field) {
                $values .= '?';
                if ($x < count($fields)) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

            if (!$this->query($sql, $fields)->error()) {
                return true;
            }
        }
        return false;
    }

    public function update($table, $field, $data, $fields) {

        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = ?";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }


        $sql ="UPDATE {$table} SET {$set} WHERE {$field} = {$data}";

        if (!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function lastId() {
        return $this->lastInsertId();
    }

    public function results() {
        return $this->_results;
    }

    public function first() {
        return $this->results()[0];
    }

 
    public function error() {
        return $this->_error;
    }

    public function count() {
        return $this->_count;
    }

    
}

?>
