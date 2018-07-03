<?php


use Phinx\Seed\AbstractSeed;

class RepairStatus extends AbstractSeed
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
        $faker = Faker\Factory::create();

        $data = [];
        for ($i = 0; $i < 200; $i++) {
            $data[] = [
                'status'       => $faker->boolean,
                'finished_date'=> $faker->time('2008-04-25 08:37:17'),
                'staff_id'     => $faker->randomElement($array = array ('a','b','c')), // Only technician or trainee can repair
                'product_id'=>    $i+1,
            ];
        }
        $this->insert('repairStatus', $data);
    }
}
