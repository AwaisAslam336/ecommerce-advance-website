<?php

namespace Tests;

use App\Models\Admin;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function createAdmin($args=[]){
        return Admin::factory()->create($args);
    }

    public function authAdmin(){
        $admin = $this->createAdmin();
        Sanctum::actingAs($admin);
        return $admin;
    }

}
