<?php

use Illuminate\Database\Seeder;

class Translator extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $translators = [
            ['locale'=>'en', 'name'=>'English'],
            ['locale'=>'ar', 'name'=>'العربية'],
        ];

        foreach ($translators as $translator)
        {
            Waavi\Translation\Models\Language::create($translator);
        }
    }
}
