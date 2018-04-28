<?php

namespace Lycanthrope\Role;

use Lycanthrope\Role\RoleInterface;
use Lycanthrope\Role\RoleTrait;

abstract class AbstractWerewolf implements RoleInterface {

    use RoleTrait;

    protected $name = 'Loup-Garou';

    protected $description = "Chaque nuit, ils dévorent un Villageois.\nLe jour ils essaient de masquer leur identité nocturne pour échapper à la vindicte populaire.";

}
