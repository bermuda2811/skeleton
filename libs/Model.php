<?php
namespace libs;
class Model extends Object {
    private $dbh;

    private $sql;

    public function __construct() {
        $this->initDriver();
    }

    public function initDriver($key = null) {
        $this->setDbh(Connection::getInstance($key));
    }
    /**
     * @param mixed $dbh
     */
    public function setDbh($dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * @return mixed
     */
    public function getDbh()
    {
        return $this->dbh;
    }

    public function buildSelectSql($table, $condition = '', $order = 'id desc', $limit = null, $columns = '*'){

        $order_by = $limit_string = '';

        if($order !='') {
            $order_by = ' order by '.$order;
        }
        if($limit != null) {
            $limit_string.=' LIMIT '.$limit;
        }
        $sql = "select ".$columns." from `".$table."` where 1 $condition $order_by $limit_string";
        $this->setSql($sql);

        return $this;
    }

    /**
     * @todo set sql
     * @param $sql
     */
    public function setSql($sql)
    {
        $this->sql = $sql;
    }

    /**
     * @todo get sql
     * @return mixed
     */
    public function getSql()
    {
        return $this->sql;
    }


    public function findOne($fetchMode = \PDO::FETCH_ASSOC) {
        try {
            if($this->getSql() =='') {
                throw new \Exception(' Sql must be set first !');
            }
            if($this->dbh instanceof \PDO) {
                $sth = $this->dbh->prepare($this->getSql());
                $sth->execute();
                $data = $sth->fetch($fetchMode);
                return $data;
            }

        }catch (\Exception $e) {
            print_r($e->getMessage());
        }
        return false;
    }

    public function findAll($fetchMode = \PDO::FETCH_ASSOC) {
        try {
            if($this->getSql() == '') {
                throw new \Exception(' Sql must be set first !');
            }
            if($this->dbh instanceof \PDO) {
                $sth = $this->dbh->prepare($this->getSql());
                $sth->execute();
                $data = $sth->fetchAll($fetchMode);
                return $data;
            }
        }catch (\Exception $e) {
            print_r($e->getMessage());
        }
        return array();
    }

    public function select($table, $condition = '', $order = 'id desc', $limit = null, $columns = '*') {
        $data = $this
            ->buildSelectSql($table, $condition, $order, $limit, $columns)
            ->findAll();
        return $data;
    }

    public function insert($table, $data) {

        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':' . implode(', :', array_keys($data));
        if($this->dbh instanceof \PDO) {
            $sth = $this->dbh->prepare("INSERT INTO ".$table." (`$fieldNames`) VALUES ($fieldValues)");
            if($data && !empty($data)){
                foreach($data as $key => $value) {
                    $sth->bindValue(":$key", $value);
                }
            }
            $sth->execute();
            return $sth->rowCount();
        }
        return 0;
    }


    public function update($table, $data, $where) {

        ksort($data);

        $fieldDetails = NULL;
        foreach($data as $key => $value) {
            $fieldDetails .= "`$key` =:$key,";
        }

        $fieldDetails = rtrim($fieldDetails, ',');
        $sql = "UPDATE ".$table." SET $fieldDetails WHERE $where";
        if($this->dbh instanceof \PDO) {
            $sth = $this->dbh->prepare($sql);

            foreach($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            $sth->execute();

            return $sth->rowCount();
        }
        return 0;
    }


    public function delete($table, $where, $limit = 1) {
        if($this->dbh instanceof \PDO) {
            return $this->dbh->exec("DELETE FROM ".$table." WHERE $where LIMIT $limit");
        }
        return false;
    }



}