<?php


use Phinx\Seed\AbstractSeed;

class BRepairPart extends AbstractSeed
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
        for ($i = 1; $i < 50; $i++) {
            $data[] = [
                'manufacturer' => $faker->company,
                'type'         => $faker->randomElement($array = array ('battery','lcd screen','speaker','keyboard','webcam','usb','cd reader','power cord','motherboard','RAM','CPU','graphic card')),
                'price'        => $faker->randomFloat($nbMaxDecimals = NULL , $min = 30.00, $max = 200.00),
            ];
        }
        $this->insert('repairPart', $data);
    }
}
