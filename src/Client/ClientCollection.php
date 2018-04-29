<?php
namespace Lycanthrope\Client;

use Ratchet\ConnectionInterface;

class ClientCollection implements \Countable, \Iterator, \ArrayAccess {

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

        $this->pos = 0;
        $this->clients = array();

        if(!empty($connections)) {
            foreach($connections as $connection) {
                $this->attach($connection);
            }
        }

    }

    /**
     * Retourne si une connexion en tant que client est contenue dans la collection
     * @param Ratchet\ConnectionInterface
     * @return bool
     */
    public function contains(ConnectionInterface $connection): bool {

        foreach($this->clients as $client) {
            if($this->make($connection) == $client) {
                return true;
            }
        }
        return false;

    }

    /**
     * Attache une connexion en tant que client
     * @param Ratchet\ConnectionInterface
     * @return void
     */
    public function attach(ConnectionInterface $connection) {

        if(!$this->contains($connection)) {
            $this->clients[] = $this->make($connection);
        }

    }

    /**
     * Détache une connexion en tant que client
     * @param Ratchet\ConnectionInterface
     * @return void
     */
    public function detach(ConnectionInterface $connection) {

        foreach($this->clients as $offset => $client) {
            if($client == $this->make($connection)) {
                unset($this->clients[$offset]);
                $this->rewind();
                return;
            }
        }

    }

    /**
     * Convertit un objet ConnectionInterface en un objet Client
     * @param Ratchet\ConnectionInterface
     * @return Lycanthrope\Client\Client
     */
    protected function make(ConnectionInterface $client) {

        return new Client($client);

    }

    /**
     * @see \Countable
     */
    public function count() {
        return count($this->clients);
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
