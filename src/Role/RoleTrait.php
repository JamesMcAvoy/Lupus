<?php

namespace Lycanthrope\Role;

trait RoleTrait {

    public function getName(): String {
        return $this->name;
    }

    public function getDescription(): String {
        return $this->description;
    }

}
