<?php
declare(strict_types=1);

require_once 'ConnectionFactory.php';

use PHPUnit\Framework\TestCase;
use Illuminate\Database\Capsule\Manager as Capsule;
use Ratchet\ConnectionInterface;
use Lycanthrope\Config;
use Lycanthrope\Client\Client;

final class ClientTest extends TestCase {

    public function __construct() {
        parent::__construct();
        Config::boot();
    }

    protected function factory($data = null) {
        return new ConnectionFactory($data);
    }

    public function setUp() {
        Capsule::connection()->getPdo()->beginTransaction();
    }

    public function tearDown() {
        Capsule::connection()->getPdo()->rollBack();
    }

    public function testGetConnection(): void {

        $client = new Client($this->factory('client'));
        $this->assertInstanceOf(ConnectionInterface::class, $client->getConnection());

    }

}
