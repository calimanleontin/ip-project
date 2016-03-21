<?php

use Illuminate\Database\Seeder;
use App\Tags;

class TagsTableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();
        Tags::create(array(
            'name' =>'frizerie',
            'slug' => 'frizerie'
        ));

        Tags::create(array(
            'name' =>'spalatorie',
            'slug' => 'spalatorie'
        ));

        Tags::create(array(
            'name' =>'service masini',
            'slug' => 'service-masini'
        ));

        Tags::create(array(
            'name' =>'cofetarie',
            'slug' => 'cofetarie'
        ));

        Tags::create(array(
            'name' =>'cantina',
            'slug' => 'cantina'
        ));

        Tags::create(array(
            'name' =>'barbier',
            'slug' => 'barbier'
        ));
    }
}
