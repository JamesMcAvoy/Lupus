<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Lycanthrope\Role\AbstractVillager;
use Lycanthrope\Role\AbstractWerewolf;

final class RoleTest extends TestCase {

    public function testName(): void {

        $this->assertEquals(
            'Villageois',
            (new class extends AbstractVillager {

            })->getName()
        );

        $this->assertEquals(
            'Loup-Garou',
            (new class extends AbstractWerewolf {

            })->getName()
        );

    }

}
