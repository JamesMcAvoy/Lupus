<?php
namespace Lycanthrope\Client;

use Ratchet\ConnectionInterface;

class Client {

    /**
     * ID client resource
     * @var int
     */
    private $id;

    /**
     * @var String
     */
    private $pseudo;

    /**
     * @var String
     */
    private $token;

    /**
     * Variable ConnectionInterface pour permettre l'envoi de messages au client
     * @var Ratchet\ConnectionInterface
     */
    private $object;

    /**
     * Constructeur
     * @param Ratchet\ConnectionInterface
     */
    public function __construct(ConnectionInterface $connection) {

        $this->object = $connection;

    }

}
