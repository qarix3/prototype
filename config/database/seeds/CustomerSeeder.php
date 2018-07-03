<?php

use Phinx\Seed\AbstractSeed;

class CustomerSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $faker = Faker\Factory::create('ms_MY');

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'icNo'       => $faker->myKadNumber,
                'name'       => $faker->name,
                'address'    => $faker->address,
                'phoneNo'    => $faker->mobileNumber,
                'user_id'    => $i+1,
                'created_at' => $faker->time('2008-04-25 08:37:17'),
                'updated_at' => $faker->time('2008-04-25 08:37:17'),

            ];
        }
        $this->insert('customer', $data);

    }
}
