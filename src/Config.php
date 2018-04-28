<?php
namespace Lycanthrope;

use Lycanthrope\Exception\ConfigurationException as ConfigException;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Config {

    private static $file = __DIR__ . '/../app/configuration.ini';

    /**
     * Initialise les principaux composants et les constantes de configuration
     * @param void
     * @return void
     * @throws Lycanthrope\Exception\ConfigurationException
     */
    public static function boot() {
        if(!file_exists(self::$file)) {
            throw new ConfigException('Le fichier de configuration n\'existe pas.');
        }

        $config = parse_ini_file(self::$file);

        if(empty($config)) {
            throw new ConfigException('Le fichier de configuration est vide.');
        }

        array_walk(
            $config,
            function($value, $key) {
                define(strtoupper($key), $value);
            }
        );

        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'    => DB_DRIVER,
            'host'      => DB_HOST,
            'port'      => DB_PORT,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASS,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

}
