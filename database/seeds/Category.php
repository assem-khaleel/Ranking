<?php

use Illuminate\Database\Seeder;

class Category extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            ['system_id'=>'1','name_en'=>'Arts & Humanities', 'name_ar'=>'العلوم الإنسانية والآداب'],
            ['system_id'=>'1','name_en'=>'Engineering & Technology', 'name_ar'=>'الهندسة والتكنولوجيا'],
            ['system_id'=>'1','name_en'=>'Life Sciences & Medicine', 'name_ar'=>'العلوم الحياتية والطب'],
            ['system_id'=>'1','name_en'=>'Natural Sciences', 'name_ar'=>'العلوم الطبيعية'],
            ['system_id'=>'1','name_en'=>'Social Sciences & Management', 'name_ar'=>'العلوم الاجتماعية والإدارة'],
            ['system_id'=>'2','name_en'=>'Computer science', 'name_ar'=>'علم الحاسوب'],
            ['system_id'=>'2','name_en'=>'Engineering & technology', 'name_ar'=>'الهندسة والتكنولوجيا'],
            ['system_id'=>'2','name_en'=>'Clinical, pre-clinical & health', 'name_ar'=>'الصحة والإكلينيكي'],
            ['system_id'=>'2','name_en'=>'Life sciences', 'name_ar'=>'علوم حياتية'],
            ['system_id'=>'2','name_en'=>'Physical sciences', 'name_ar'=>'علوم فيزيائة'],
            ['system_id'=>'2','name_en'=>'Psychology', 'name_ar'=>'علم نفس'],
            ['system_id'=>'2','name_en'=>'Arts & humanities', 'name_ar'=>'الآداب والعلوم الإنسانية'],
            ['system_id'=>'2','name_en'=>'Education', 'name_ar'=>'التعليم'],
            ['system_id'=>'2','name_en'=>'Law', 'name_ar'=>'الحقوق'],
            ['system_id'=>'2','name_en'=>'Social sciences', 'name_ar'=>'العلوم الاجتماعية'],
            ['system_id'=>'2','name_en'=>'Business & economics', 'name_ar'=>'إدارة واقتصاد'],
            ['system_id'=>'3','name_en'=>'Agricultural Sciences ', 'name_ar'=>'العلوم الزراعية'],
            ['system_id'=>'3','name_en'=>'Arts and Humanities', 'name_ar'=>'الآداب والعلوم الإنسانية'],
            ['system_id'=>'3','name_en'=>'Biology and Biochemistry', 'name_ar'=>'علم الأحياء والكيمياء الحيوية'],
            ['system_id'=>'3','name_en'=>'Chemistry', 'name_ar'=>'كيمياء'],
            ['system_id'=>'3','name_en'=>'Clinical Medicine', 'name_ar'=>'الطب الإكلينيكي'],
            ['system_id'=>'3','name_en'=>'Computer Science', 'name_ar'=>'علم الحاسوب'],
            ['system_id'=>'3','name_en'=>'Economics and Business', 'name_ar'=>'الاقتصاد والإدارة'],
            ['system_id'=>'3','name_en'=>'Engineering', 'name_ar'=>'الهندسة'],
            ['system_id'=>'3','name_en'=>'Environment/Ecology', 'name_ar'=>'البيئة'],
            ['system_id'=>'3','name_en'=>'Geosciences', 'name_ar'=>'علوم الأرض'],
            ['system_id'=>'3','name_en'=>'Immunology', 'name_ar'=>'علم المناعة'],
            ['system_id'=>'3','name_en'=>'Materials Science', 'name_ar'=>'علم المواد'],
            ['system_id'=>'3','name_en'=>'Mathematics', 'name_ar'=>'الرياضيات'],
            ['system_id'=>'3','name_en'=>'Microbiology', 'name_ar'=>'علم الأحياء المجهري'],
            ['system_id'=>'3','name_en'=>'Molecular Biology and Genetics', 'name_ar'=>'علم الوراثة والبيولوجيا الجزيئية'],
            ['system_id'=>'3','name_en'=>'Neuroscience and Behavior', 'name_ar'=>'غلم الأعصاب والسلوك'],
            ['system_id'=>'3','name_en'=>'Pharmacology and Toxicology', 'name_ar'=>'علم الصيدلة والسموم'],
            ['system_id'=>'3','name_en'=>'Physics', 'name_ar'=>'علم الفيزياء'],
            ['system_id'=>'3','name_en'=>'Plant and Animal Science', 'name_ar'=>'علم النبات والحيوان'],
            ['system_id'=>'3','name_en'=>'Psychiatry/Psychology', 'name_ar'=>'الطب النفسي / علم النفس'],
            ['system_id'=>'3','name_en'=>'Social Sciences, general', 'name_ar'=>'العلوم العامة وعلم الاجتماع'],
            ['system_id'=>'3','name_en'=>'Space Science', 'name_ar'=>'علم الفضاء'],
            ['system_id'=>'4','name_en'=>'NATURAL SCIENCES', 'name_ar'=>'علم الطبيعة'],
            ['system_id'=>'4','name_en'=>'ENGINEERING', 'name_ar'=>'الهندسة'],
            ['system_id'=>'4','name_en'=>'LIFE SCIENCES', 'name_ar'=>'العلوم الحياتية'],
            ['system_id'=>'4','name_en'=>'MEDICAL SCIENCES', 'name_ar'=>'العلوم الطبية'],
            ['system_id'=>'4','name_en'=>'SOCIAL SCIENCES', 'name_ar'=>'العلوم الاجتماعية'],
        );

        foreach ($categories as $category)
        {
            \App\Models\Settings\SystemCategory::create($category);
        }
    }
}
