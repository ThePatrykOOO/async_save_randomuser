<?php

namespace Tests\Unit\Console\Commands;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class RandomUserGeneratorCommandTest extends TestCase
{
    use RefreshDatabase;

    public function testSaveGeneratedRandomUserSuccess()
    {
        $data = [
            'results' =>
                [
                    0 =>
                        [
                            'gender' => 'male',
                            'name' =>
                                [
                                    'title' => 'Mr',
                                    'first' => 'Valtteri',
                                    'last' => 'Honkala',
                                ],
                            'location' =>
                                [
                                    'street' =>
                                        [
                                            'number' => 8824,
                                            'name' => 'Pirkankatu',
                                        ],
                                    'city' => 'Marttila',
                                    'state' => 'Northern Savonia',
                                    'country' => 'Finland',
                                    'postcode' => 50375,
                                    'coordinates' =>
                                        [
                                            'latitude' => '-8.4911',
                                            'longitude' => '-162.8978',
                                        ],
                                    'timezone' =>
                                        [
                                            'offset' => '+4:30',
                                            'description' => 'Kabul',
                                        ],
                                ],
                            'email' => 'valtteri.honkala@example.com',
                            'login' =>
                                [
                                    'uuid' => 'e2ae8877-8d7c-49c4-9aab-265440a324c7',
                                    'username' => 'purplepanda230',
                                    'password' => 'odessa',
                                    'salt' => 'GYDXLWre',
                                    'md5' => '5d48b253746732a1debdee5ebad197d8',
                                    'sha1' => '50cdd9410e6b1a3bb4eab9a18c02ffeeec359a40',
                                    'sha256' => '5912637318c5d184e6232f23f7e2f4c7c7b69a2467b30121dca60181bdab52c0',
                                ],
                            'dob' =>
                                [
                                    'date' => '1967-07-12T15:15:08.771Z',
                                    'age' => 54,
                                ],
                            'registered' =>
                                [
                                    'date' => '2007-10-17T16:12:14.062Z',
                                    'age' => 14,
                                ],
                            'phone' => '04-062-128',
                            'cell' => '044-516-11-49',
                            'id' =>
                                [
                                    'name' => 'HETU',
                                    'value' => 'NaNNA961undefined',
                                ],
                            'picture' =>
                                [
                                    'large' => 'https://randomuser.me/api/portraits/men/30.jpg',
                                    'medium' => 'https://randomuser.me/api/portraits/med/men/30.jpg',
                                    'thumbnail' => 'https://randomuser.me/api/portraits/thumb/men/30.jpg',
                                ],
                            'nat' => 'FI',
                        ],
                ],
            'info' =>
                [
                    'seed' => '467ad783440731e9',
                    'results' => 1,
                    'page' => 1,
                    'version' => '1.3',
                ],
        ];
        Http::fake([
            'randomuser.me/*' => Http::response($data),
        ]);

        $this->artisan('user:random-generator');

        $this->assertEquals(1, User::query()->count());

        $user = User::query()->first();
        $this->assertEquals('Valtteri', $user->name);
        $this->assertEquals('valtteri.honkala@example.com', $user->email);
    }
}
