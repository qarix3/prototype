<?php


use Phinx\Seed\AbstractSeed;

class AStaffSeeder extends AbstractSeed
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
        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'name'       => $faker->name,
                'address'    => $faker->address,
                'phoneNo'    => $faker->mobileNumber,
                'created_at' => $faker->time('2008-04-25 08:37:17'),
                'updated_at' => $faker->time('2018-04-25 08:37:47'),
                'job_id'     => $faker->numberBetween($min = 1, $max = 5),
            ];
        }
        $this->insert('staff', $data);

    }
}
