<?php

namespace Lycanthrope\Roles;

use Lycanthrope\Roles\RoleInterface;
use Lycanthrope\Roles\RoleTrait;

abstract class AbstractVillager implements RoleInterface {

    use RoleTrait;

    protected $name = 'Villageois';

    protected $description = "Il n'a aucune compétence particulière.\nSes seules armes sont la capacité d'analyse des comportements pour identifier les Loups Garous et la force de conviction pour empêcher l'exécution de l'innocent qu'il est.";

}
