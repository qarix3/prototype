<?php


use Phinx\Seed\AbstractSeed;

class ProductSeeder extends AbstractSeed
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
        $faker->addProvider(new Faker\Provider\da_DK\Person($faker));

        $data = [];
        for ($i = 0; $i < 200; $i++) {
            $data[] = [
                'brand'      => $faker->randomElement($array = array ('MSI','Dell','Apple','Toshiba','Acer','ASUS','Lenovo','Samsung','HP','Sony')),
                'model'      => $faker->cpr,
                'created_at' => $faker->time('2008-04-25 08:37:17'),
                'updated_at' => $faker->time('2018-04-25 08:37:47'),
                'part_id'    => $faker->numberBetween($min = 1, $max = 49),
                'user_id'    => $faker->numberBetween($min = 1, $max = 100),
            ];
        }
        $this->insert('product', $data);

    }
}
