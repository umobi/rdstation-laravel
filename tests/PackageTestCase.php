<?php

namespace Umobi\RDStation\Tests;

use Umobi\RDStation\ServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }
}
