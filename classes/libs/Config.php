<?php

namespace Elmage\libs;

class Config {

    /**
     * @var string
     */
    private $_dbname;

    /**
     * @var string
     */
    private $_host;

    /**
     * @var int
     */
    private $_port;

    /**
     * @var string
     */
    private $_username;

    /**
     * @var string
     */
    private $_password;

    public function __construct() {
        $this->_dbname = \get('mysql/db');
        $this->_host = \get('mysql/host');
        $this->_port = \get('mysql/port');
        $this->_username = \get('mysql/username');
        $this->_password = \get('mysql/password');
    }

    public function getDbName(): string
    {
        return $this->_dbname;
    }

    public function getHost(): string
    {
        return $this->_host;
    }

    public function getPort(): int
    {
        return $this->_port;
    }

    public function getUsername(): string
    {
        return $this->_username;
    }

    public function getPassword(): string
    {
        return $this->_password;
    }

}
