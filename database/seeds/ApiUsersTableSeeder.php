<?php

use App\Models\User\ApiUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ApiUsersTableSeeder
 */
class ApiUsersTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected array $resource = [
        [
            'name' => 'User 1',
            'api_token' => '736B7AA4CE6AE8E805590FE1A0E0FDA4',
        ],
        [
            'name' => 'User 2',
            'api_token' => 'AA10385241AF3EDBCBFCD33D4C5C0687',
        ],
        [
            'name' => 'User 3',
            'api_token' => '20625E55E07BAF8E7B9DE1242BD5A2E3',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('api_users')->truncate();

        foreach ($this->resource as $apiUser) {
            factory(ApiUser::class)->create($apiUser);
        }
    }
}
