<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class RoleTest extends TestCase {

    public function testName(): void {

        $this->assertEquals(
            'Villageois',
            (new class extends Lycanthrope\Roles\AbstractVillager {

            })->getName()
        );

    }

}
