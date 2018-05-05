<?php
namespace Lycanthrope\Client;

use Ratchet\ConnectionInterface;

abstract class ClientHelper {

    /**
     * Vérifie qu'un utilisateur n'existe pas déjà et que les paramètres de route sont OK
     * @param Ratchet\ConnectionInterface
     * @return bool
     * @todo
     */
    public static function isValid(ConnectionInterface $connection): bool {

        return false;

    }

    /**
     * Retourne la liste des paramètres de la route
     * @param Ratchet\ConnectionInterface;
     * @return Array
     */
    public static function getRouteParams(ConnectionInterface $connection): Array {

        parse_str($connection->httpRequest->getUri()->getQuery(), $routeParams);
        return $routeParams;

    }

}
