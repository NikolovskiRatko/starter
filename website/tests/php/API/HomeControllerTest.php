<?php

namespace Tests\API\Resources;

use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Util\Errors;
use App\Util\Utils;

class HomeControllerTest extends TestCase
{
    // use DatabaseTransactions;

    // protected $adminToken;

    // public function setUp()
    // {
    //     parent::setUp();

    //     $admin = factory(User::class)->create([
    //         'type_id' => 1
    //     ]);

    //     $this->adminToken = \JWTAuth::fromUser($admin);
    // }

    // public function testGETVue()
    // {
    //     $homeItems = [
    //         [
    //             'name' => 'strings.users',
    //             'link' => 'users',
    //             'icon' => 'fa-users',
    //         ],
    //         [
    //             'name' => 'strings.example',
    //             'icon' => 'fa-lightbulb-o',
    //             'link' => 'example',
    //         ],
    //     ];

    //     $settingsFile = Utils::getSettingsFile();

    //     if (file_exists($settingsFile)) {
    //         $settings = json_decode(file_get_contents($settingsFile), true);
    //     } else {
    //         $settings = [];
    //     }

    //     $response = $this->withHeaders([
    //             'Authorization' => 'Bearer '.$this->adminToken,
    //         ])
    //         ->json(
    //             'GET',
    //             '/api/vue'
    //         )
    //         ->assertStatus(200)
    //         ->assertHeader('Content-Type', 'application/json')
    //         ->assertJson([
    //             'homeItems' => $homeItems,
    //             'settings' => $settings,
    //         ]);
    // }
}
