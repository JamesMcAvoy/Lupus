<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lycanthrope\Config;

final class ConfigTest extends TestCase {

    public function testConfig(): void {

        try {

            $this->assertNull(Config::boot());

        } catch(\Exception $e) {

            $this->fail('Failed asserting that Config::boot() does not throw an Exception.');

        }

    }

}
