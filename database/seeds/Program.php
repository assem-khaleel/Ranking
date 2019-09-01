<?php

use Illuminate\Database\Seeder;

class Program extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programs = array(
            ['name_ar'=>'جراحة الفم والوجه والفكين','name_en'=>'Oral and Maxillofacial surgery','department_id'=>'1'],//1
            ['name_ar'=>'طب الفم','name_en'=>'Oral Medicine','department_id'=>'1'],//2
            ['name_ar'=>' إصلاح الأسنان','name_en'=>'Restorative dental sciences','department_id'=>'2'],//3
            ['name_ar'=>'علاج جذور الاسنان','name_en'=>' Prosthetic dental sciences','department_id'=>'2'],//4
            ['name_ar'=>'تقويم الأسنان','name_en'=>'Pedodontics','department_id'=>'3'],//5
            ['name_ar'=>'علاج وجراحة اللثة','name_en'=>'Orthodontics','department_id'=>'3'],//6
            ['name_ar'=>'علم التشريح','name_en'=>'anatomy','department_id'=>'4'],//7
            ['name_ar'=>'علم وظائف الأعضاء','name_en'=>'physiology','department_id'=>'4'],//8
            ['name_ar'=>'بكالريوس علوم المختبرات الإكلينيكية','name_en'=>'Bachelor of Clinical Laboratory Sciences','department_id'=>'5'],//9
            ['name_ar'=>'علم الأمراض التشريحي','name_en'=>'Anatomical Pathology','department_id'=>'5'],//10
            ['name_ar'=>'بكالوريوس إدارة الأعمال','name_en'=>'Bachelor of Business Administration','department_id'=>'6'],//11
            ['name_ar'=>'ماجستير إدارة أعمال','name_en'=>'Master of Business Administration (MBA)','department_id'=>'6'],//12
            ['name_ar'=>'بكالوريوس إدارة الضيافة','name_en'=>'Bachelor of Hospitality Management','department_id'=>'6'],//13
            ['name_ar'=>'بكالوريوس إدارة السياحة والسفر','name_en'=>'Bachelor of Tourism and Travel Management','department_id'=>'6'],//14
            ['name_ar'=>'بكالوريوس الانتاج النباتي','name_en'=>'Bachelor of Plant Production','department_id'=>'7'],//15
            ['name_ar'=>'ماجستير الانتاج النباتي','name_en'=>'Master of Plant Production','department_id'=>'7'],//16
            ['name_ar'=>'بكالوريوس الانتاج الحيواني','name_en'=>'Bachelor of Animal Production','department_id'=>'8'],//17
            ['name_ar'=>'ماجستير الانتاج الحيواني','name_en'=>'Master of of Animal Production','department_id'=>'8'],//18
            ['name_ar'=>'بكالوريوس الهندسة الزراعية','name_en'=>'Bachelor Agricultural Engineering','department_id'=>'9'],//19
            ['name_ar'=>'ماجستير الهندسة الزراعية','name_en'=>'Master Agricultural Engineering','department_id'=>'9'],//20
            ['name_ar'=>'الاحصاء','name_en'=>'Statistics Program','department_id'=>'10'],//21
            ['name_ar'=>'البحوث والعمليات','name_en'=>'Operations Research Program','department_id'=>'10'],//21
            ['name_ar'=>'برنامج الجيوفيزياء','name_en'=>'Geophysics Program','department_id'=>'11'],//22
            ['name_ar'=>'برنامج الجيولوجيا','name_en'=>'Geology Program','department_id'=>'11'],//22
            ['name_ar'=>'بكالوريوس  العلوم في الرياضيات','name_en'=>'Bachelor of Science in Mathematics','department_id'=>'12'],//23
            ['name_ar'=>'بكالوريوس العلوم في الرياضيات الاكتوارية والمالية','name_en'=>'Bachelor of Science in Actuarial and Financial Mathematics','department_id'=>'12'],//23
            ['name_ar'=>'بكالوريوس الهندسة المدنية','name_en'=>'Bechalor of Science in Civil Engineering','department_id'=>'13'],//24
            ['name_ar'=>'برنامج بكالوريوس الهندسة المساحية','name_en'=>'Bachelor of Science in Surveying Engineering','department_id'=>'13'],//24
            ['name_ar'=>'بكالوريوس العلوم في الهندسة الكيميائية','name_en'=>'Bachelor of Science in Chemical Engineering','department_id'=>'14'],//25
            ['name_ar'=>'ماجستير العلوم في الهندسة الكيميائية','name_en'=>'Master of Science in Chemical Engineering','department_id'=>'14'],//25
            ['name_ar'=>'بكالوريوس العلوم في الهندسة الكهربائية','name_en'=>'Bachelor of Science Program in Electrical Engineering','department_id'=>'15'],//26
            ['name_ar'=>'ماجستير العلوم في الهندسة الكهربائية','name_en'=>'Master of Science Program in Electrical Engineering','department_id'=>'15'],//26

        );

        foreach ($programs as $program)
        {
            \App\Models\Settings\Program::create($program);
        }
    }
}
