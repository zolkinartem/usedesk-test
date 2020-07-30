<?php

use App\Models\Client\Client;
use App\Models\Client\Email;
use App\Models\Client\PhoneNumber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientsTableSeeder
 */
class ClientsTableSeeder extends Seeder
{
    /**
     * @var int
     */
    protected int $entityCount = 100;

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run(): void
    {
        DB::table('clients')->truncate();
        DB::table('emails')->truncate();
        DB::table('phone_numbers')->truncate();

        for ($i = 0; $i < $this->entityCount; $i++) {
            $client = factory(Client::class)->create();

            $emailIds = factory(Email::class, random_int(1, 5))->create()
                ->pluck('id')
                ->toArray();

            $phoneNumberIds = factory(PhoneNumber::class, random_int(1, 5))->create()
                ->pluck('id')
                ->toArray();

            $client->emails()->sync($emailIds);
            $client->phoneNumbers()->sync($phoneNumberIds);
        }
    }
}
