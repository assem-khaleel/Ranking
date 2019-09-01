<?php

use Illuminate\Database\Seeder;

class Department extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = array(
            ['name_ar'=>'قسم العلوم الجراحية والتشخيصية','name_en'=>'Surgical and Diagnostic Sciences','college_id'=>'1'],//1
            ['name_ar'=>'قسم إصلاح وتعويض الأسنان','name_en'=>'Restorative and Prosthetic Dental Sciences','college_id'=>'1'],//2
            ['name_ar'=>'قسم علوم وقاية الأسنان','name_en'=>'Preventive Dental Sciences','college_id'=>'1'],//3
            ['name_ar'=>'قسم العلوم الطبية الأساسية','name_en'=>'Basic Medical Science Department','college_id'=>'2'],//4
            ['name_ar'=>'قسم العلوم الإكلينيكية','name_en'=>'Clinical Department','college_id'=>'2'],//5
            ['name_ar'=>'قسم العلوم الإدارية','name_en'=>'Management Sciences Department','college_id'=>'3'],//6
            ['name_ar'=>'قسم الإنتاج النباتي','name_en'=>'Department of Plant Production','college_id'=>'4'],//7
            ['name_ar'=>'قسم الإنتاج الحيواني','name_en'=>'Department of Animal Production','college_id'=>'4'],//8
            ['name_ar'=>'قسم الهندسة الزراعية','name_en'=>'Department of Agricultural Engineering','college_id'=>'4'],//9
            ['name_ar'=>'قسم الإحصاء وبحوث العمليات','name_en'=>'Statistics & Operations Research Department','college_id'=>'5'],//10
            ['name_ar'=>'قسم الجيولوجيا و الجيوفيزياء','name_en'=>'Geology & Geophysics Department','college_id'=>'5'],//11
            ['name_ar'=>'قسم الرياضيات','name_en'=>'Mathematics Department','college_id'=>'5'],//12
            ['name_ar'=>'قسم الهندسة المدنية','name_en'=>'civil engineering Department','college_id'=>'6'],//13
            ['name_ar'=>'قسم الهندسة الكيميائية','name_en'=>'Chemical Engineering Department','college_id'=>'6'],//14
            ['name_ar'=>'قسم الهندسة الكهربائية','name_en'=>'Electrical Engineering Department','college_id'=>'6'],//15
        );

        foreach ($departments as $department)
        {
            \App\Models\Settings\Department::create($department);
        }
    }
}
