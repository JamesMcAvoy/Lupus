<?php
namespace Lycanthrope;

use Lycanthrope\Exception\ConfigurationException as ConfigException;
use Illuminate\Database\Capsule\Manager as Capsule;

final class Config {

    /**
     * @var String
     */
    private static $file = __DIR__ . '/../app/configuration.ini';

    /**
     * Initialise les principaux composants de l'application
     * @param void
     * @return void
     */
    public static function boot() {

        global $argv;

        self::confInit();
        self::dbInit();

        if(isset($argv['1']) && $argv['1'] == 'schema') {
            self::schema(__DIR__ . '/../app/' . LYC_SCHEMA);
        }

    }

    /**
     * Initialise les contantes de configuration
     * @param void
     * @return void
     * @throws Lycanthrope\Exception\ConfigurationException
     */
    private static function confInit() {

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
                define(strtoupper('lyc_'.$key), $value);
            }
        );

    }

    /**
     * Initialise la connexion à la BDD
     * @param void
     * @return void
     * @throws Lycanthrope\Exception\ConfigurationException
     */
    private static function dbInit() {

        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                'driver'    => LYC_DB_DRIVER,
                'host'      => LYC_DB_HOST,
                'port'      => LYC_DB_PORT,
                'database'  => LYC_DB_NAME,
                'username'  => LYC_DB_USER,
                'password'  => LYC_DB_PASS,
                'charset'   => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix'    => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
        } catch(\Exception $e) {
            throw new ConfigException($e->getMessage());
        }

    }

    /**
     * Exécute le schéma SQL en remettant à zéro la BDD
     * @param void
     * @return void
     * @throws Lycanthrope\Exception\ConfigurationException
     */
    private static function schema($schemaPath) {

        if(!file_exists($schemaPath)) {
            throw new ConfigException('Le fichier de schéma n\'existe pas.');
        }

        try {
            foreach(Capsule::select('SHOW TABLES') as $table) {
                $table_array = get_object_vars($table);
                Capsule::schema()->drop($table_array[key($table_array)]);
            }

            require_once $schemaPath;
        } catch(\Exception $e) {
            throw new ConfigException($e->getMessage());
        } finally {
            echo 'La base de données a été remise à zéro.' . PHP_EOL;
        }

        echo 'Le schéma a bien été exécuté.' . PHP_EOL;

    }

}
