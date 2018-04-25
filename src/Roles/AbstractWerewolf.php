<?php

namespace Lycanthrope\Roles;

use Lycanthrope\Roles\RoleInterface;
use Lycanthrope\Roles\RoleTrait;

abstract class AbstractWerewolf implements RoleInterface {

    use RoleTrait;

    protected $name = 'Loup-Garou';

    protected $description = "Chaque nuit, ils dévorent un Villageois.\nLe jour ils essaient de masquer leur identité nocturne pour échapper à la vindicte populaire.";

}
