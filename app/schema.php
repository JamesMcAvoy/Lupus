<?php

use Illuminate\Database\Capsule\Manager as Capsule;

// Exemple
Capsule::schema()->create('users', function($table) {
    $table->increments('id');
    $table->string('pseudo');
    $table->string('token');
});
