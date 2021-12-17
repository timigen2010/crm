<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BaseTestCase extends TestCase
{
    use DatabaseTransactions;
}
