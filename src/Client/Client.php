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
        //list($this->pseudo, $this->token) = ClientHelper::getRouteParams($connection);

    }

    /**
     * Retourne l'objet ConnectionInterface
     * @return Ratchet\ConnectionInterface
     */
    public function getConnection() {

        return $this->object;

    }

    /**
     * Retourne le pseudo du client
     * @return String
     */
    public function getPseudo() {

        return $this->pseudo;

    }

    /**
     * Retourne le token du client
     * @return String
     */
    public function getToken() {

        return $this->token;

    }

    /**
     * Envoi d'un message
     * @todo
     */
    public function send($message) {

        $this->object->send($message);

    }

}
