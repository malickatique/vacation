<?php

use Illuminate\Database\Seeder;

class Configuration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            [
                'name' => "name",
                'value' => "OVR",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "description",
                'value' => "Propert Rental",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "logo",
                'value' => "",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "favicon",
                'value' => "",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "contact_us_email",
                'value' => "info@ovr.com",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "phone",
                'value' => "111128128",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => "currency",
                'value' => "Dollar",
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
