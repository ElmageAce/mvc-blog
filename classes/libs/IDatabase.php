<?php
namespace Elmage\libs;

interface IDatabase {

	public function connect();

	public function query($sql, $params = array());

	public function action($action, $table, $where = array(), $orderby);

	public function get($table, $where, $orderby = null);

	public function getJoin($table, $where, $join);

	public function delete($table, $where);

	public function insert($table, $fields = array());

	public function update($table, $field, $data, $fields);

	public function results();

	public function error();
}


?>