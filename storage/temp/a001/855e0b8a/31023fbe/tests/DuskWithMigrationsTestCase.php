<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;

abstract class DuskWithMigrationsTestCase extends DuskTestCase
{
    use DatabaseMigrations {
        runDatabaseMigrations as baseRunDatabaseMigrations;
    }


    public function runDatabaseMigrations()
    {
        $this->artisan('migrate:reset');
        $this->baseRunDatabaseMigrations();
        $this->artisan('db:seed');
    }
}
