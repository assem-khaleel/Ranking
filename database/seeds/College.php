<?php

use Illuminate\Database\Seeder;

class College extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colleges = array(
            ['name_ar'=>' كلية طب الأسنان','name_en'=>'College Of Dentistry','institution_id'=>'38'],//1
            ['name_ar'=>'كلية الطب البشري','name_en'=>'College of Medicine','institution_id'=>'38'],//2
            ['name_ar'=>'كلية ابن رشد للعلوم الإدارية','name_en'=>'Ibn Rushd College For Management Sciences','institution_id'=>'47'],//3
            ['name_ar'=>'كلية علوم الأغذية والزراعة','name_en'=>'College of Food and Agricultural Sciences','institution_id'=>'4'],//4
            ['name_ar'=>'كلية العلوم','name_en'=>'College of Science','institution_id'=>'4'],//5
            ['name_ar'=>'كلية الهندسة','name_en'=>'College of Engineering','institution_id'=>'4']//6
        );

        foreach ($colleges as $college)
        {
            \App\Models\Settings\College::create($college);
        }
    }
}
