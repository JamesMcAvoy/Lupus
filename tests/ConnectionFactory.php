<?php
use Ratchet\ConnectionInterface;

class ConnectionFactory implements ConnectionInterface {

    public $data;

    public function __construct($data = null) {
        $this->data = $data;
    }

    public function send($data) {}

    public function close() {}

}
