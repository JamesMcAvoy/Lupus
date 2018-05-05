<?php
declare(strict_types=1);

require_once 'ConnectionFactory.php';

use PHPUnit\Framework\TestCase;
use Lycanthrope\Client\ClientCollection;

final class ClientCollectionTest extends TestCase {

    protected $clients;

    public function __construct() {
        parent::__construct();
        $this->clients = new ClientCollection;
    }

    protected function factory($data = null) {
        return new ConnectionFactory($data);
    }

    public function testCount(): void {

        $object = $this->factory();

        $this->assertCount(0, $this->clients);
        $this->clients->attach($object);
        $this->assertCount(1, $this->clients);
        $this->clients->detach($object);
        $this->assertCount(0, $this->clients);

        $this->clients->attach($this->factory('1'));
        $this->clients->attach($this->factory('2'));
        $this->clients->attach($this->factory('3'));
        $this->assertCount(3, $this->clients);

    }

    public function testContains(): void {

        $object1 = $this->factory('1');
        $object2 = $this->factory('2');
        $object3 = $this->factory();

        $this->clients->attach($object1);

        $this->assertTrue($this->clients->contains($object1));
        $this->assertFalse($this->clients->contains($object2));

        $this->clients->detach($object1);

        $this->assertFalse($this->clients->contains($object1));

        $this->clients->attach($object2);
        $this->clients->attach($object3);

        $this->assertFalse($this->clients->contains($object1));
        $this->assertTrue($this->clients->contains($object2));
        $this->assertTrue($this->clients->contains($object3));

    }

    public function testAttach(): void {

        $object1 = $this->factory('object1');

        $this->clients->attach($object1);

        $this->assertTrue($this->clients->contains($object1));

    }

    public function testDetach(): void {

        $object1 = $this->factory('object1');

        $this->clients->attach($object1);
        $this->clients->detach($object1);

        $this->assertFalse($this->clients->contains($object1));

    }

}
