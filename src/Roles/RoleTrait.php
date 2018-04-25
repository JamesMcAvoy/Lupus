<?php

namespace Lycanthrope\Roles;

trait RoleTrait {

    public function getName(): String {
        return $this->name;
    }

    public function getDescription(): String {
        return $this->description;
    }

}
