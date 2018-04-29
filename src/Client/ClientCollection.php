<?php
namespace Lycanthrope\Client;

use Ratchet\ConnectionInterface;

class ClientCollection implements \Countable, \Iterator, \ArrayAccess {

    /**
     * @var int
     */
    protected $count;

    /**
     * @var int
     */
    protected $pos;

    /**
     * @var Lycanthope\Client\Client[]
     */
    protected $clients;

    /**
     * Constructeur : attache une liste de connexions passées en paramètre
     * @param Ratchet\ConnectionInterface[]
     */
    public function __construct($connections = array()) {

        $this->count = 0;
        $this->pos = 0;
        $this->clients = array();

        if(!empty($connections)) {
            foreach($connections as $connection) {
                $this->attach($connection);
            }
        }

    }

    /**
     * Retourne si un client est contenu dans la collection
     * @param Ratchet\ConnectionInterface
     * @return bool
     */
    public function contains(ConnectionInterface $connection): bool {

        foreach($this->clients as $client) {
            if($connection === $client) {
                return true;
            }
        }
        return false;

    }

    /**
     * Attache un client
     * @param Ratchet\ConnectionInterface
     * @return void
     */
    public function attach(ConnectionInterface $connection) {

        if(!$this->contains($connection)) {
            ++$this->count;
            $this->clients[] = $connection;
        }

    }

    /**
     * Détache un client
     * @param Ratchet\ConnectionInterface
     * @return void
     */
    public function detach(ConnectionInterface $connection) {

        foreach($this->clients as $offset => $client) {
            if($client === $connection) {
                --$this->count;
                unset($this->clients[$offset]);
                $this->rewind();
                return;
            }
        }

    }

    /**
     * @param Ratchet\ConnectionInterface
     * @todo
     */
    private function interfaceToClient(ConnectionInterface $client) {

    }

    /**
     * @see \Countable
     */
    public function count() {
        return $this->count;
    }

    /**
     * @see \Iterator
     */
    public function rewind() {
        $this->pos = 0;
    }

    public function current() {
        return $this->clients[$this->pos];
    }

    public function key() {
        return $this->pos;
    }

    public function next() {
        ++$this->pos;
    }

    public function valid() {
        return isset($this->clients[$this->pos]);
    }

    /**
     * @see \ArrayAccess
     */
    public function offsetSet($offset, $value = null) {
        if(is_null($offset)) {
            $this->clients[] = $value;
        } else {
            $this->clients[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->clients[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->clients[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->clients[$offset]) ? $this->clients[$offset] : null;
    }

}
