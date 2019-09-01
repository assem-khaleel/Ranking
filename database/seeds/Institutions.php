<?php

use Illuminate\Database\Seeder;

class Institutions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institutions = [
            ['name_en'=>'Umm Al-Qura University', 'name_ar'=>'جامعة أم القرى'],
            ['name_en'=>'Imam Mohammad Bin Saud Islamic University', 'name_ar'=>'جامعة الإمام محمد بن سعود الإسلامية'],
            ['name_en'=>'Islamic University', 'name_ar'=>'الجامعة الإسلامية'],
            ['name_en'=>'King Saud University', 'name_ar'=>'جامعة الملك سعود'],
            ['name_en'=>'King Abdulaziz University', 'name_ar'=>'جامعة الملك عبد العزيز'],
            ['name_en'=>'King Faisal University', 'name_ar'=>'جامعة الملك فيصل'],
            ['name_en'=>'King Fahd University of Petroleum & Minerals', 'name_ar'=>'جامعة الملك فهد للبترول والمعادن'],
            ['name_en'=>'King Khalid University', 'name_ar'=>'جامعة الملك خالد'],
            ['name_en'=>'Princess Nora bint AbdulRahman University', 'name_ar'=>'جامعة الأميرة نورة بنت عبد الرحمن'],
            ['name_en'=>'Taibah University', 'name_ar'=>'جامعة طيبة'],
            ['name_en'=>'Al-Qussaim university', 'name_ar'=>'جامعة القصيم'],
            ['name_en'=>'Taif University', 'name_ar'=>'جامعة الطائف'],
            ['name_en'=>'Jazan University', 'name_ar'=>'جامعة جازان'],
            ['name_en'=>'Hail University', 'name_ar'=>'جامعة حائل'],
            ['name_en'=>'Al-Jouf University', 'name_ar'=>'جامعة الجوف'],
            ['name_en'=>'Tabouk university', 'name_ar'=>'جامعة تبوك'],
            ['name_en'=>'Al-Baha university', 'name_ar'=>'جامعة الباحة'],
            ['name_en'=>'Najran university', 'name_ar'=>'جامعة نجران'],
            ['name_en'=>'Northern Border University', 'name_ar'=>'جامعة الحدود الشمالية'],
            ['name_en'=>'Imam Abdulrahman Bin Faisal University', 'name_ar'=>'جامعة الإمام عبد الرحمن بن فيصل'],
            ['name_en'=>'King Saud bin Abdulaziz University for Health Sciences', 'name_ar'=>'جامعة الملك سعود بن عبد العزيز للعلوم الصحية'],
            ['name_en'=>'King Abdullah University of Science and Technology', 'name_ar'=>'جامعة الملك عبدالله للعلوم والتقنية'],
            ['name_en'=>'Prince Sattam Bin Abdulaziz University', 'name_ar'=>'حامعة الأمير سطام بن عبد العزيز'],
            ['name_en'=>'Shaqra University', 'name_ar'=>'جامعة شقراء'],
            ['name_en'=>'Majmaah University', 'name_ar'=>'جامعة المجمعة'],
            ['name_en'=>'Saudi Electronic University', 'name_ar'=>'جامعة السعودية الإلكترونية'],
            ['name_en'=>'Jeddah University', 'name_ar'=>'جامعة جدة'],
            ['name_en'=>'Bisha University', 'name_ar'=>'جامعة بيشة'],
            ['name_en'=>'Hafr Al-Batin University', 'name_ar'=>'جامعة حفر الباطن'],
            ['name_en'=>'Arab Open University', 'name_ar'=>'جامعة العربية المفتوحة'],
            ['name_en'=>'Business and Technology University', 'name_ar'=>'جامعة الأعمال والتكنولوجيا'],
            ['name_en'=>'Prince Sultan University', 'name_ar'=>'جامعة الأمير سلطان الأهلية'],
            ['name_en'=>'Fahad Bin Sultan University', 'name_ar'=>'جامعة فهد بن سلطان'],
            ['name_en'=>'Prince Mohammad Bin Fahad University', 'name_ar'=>'جامعة الأمير محمد بن فهد'],
            ['name_en'=>'Prince Mugrin University', 'name_ar'=>'جامعة الأمير مقرن بن عبد العزيز الأهلية'],
            ['name_en'=>'Alfaisal University', 'name_ar'=>'جامعة الفيصل الأهلية'],
            ['name_en'=>'Al-Yamamah University', 'name_ar'=>'جامعة اليمامة'],
            ['name_en'=>'Dar AL-Uloom University', 'name_ar'=>'جامعة دار العلوم'],
            ['name_en'=>'Effat University', 'name_ar'=>'جامعة عفت الأهلية'],
            ['name_en'=>'Dar Al-Hekma University', 'name_ar'=>'جامعة دار الحكمة'],
            ['name_en'=>'Riyadh Elm University', 'name_ar'=>'جامعة رياض العلم'],
            ['name_en'=>'Almaarefa University', 'name_ar'=>'جامعة المعرفة '],
            ['name_en'=>'Alasala Colleges', 'name_ar'=>'كليات الأصالة الأهلية'],
            ['name_en'=>'Gulf Colleges', 'name_ar'=>'كليات الخليج الأهلية'],
            ['name_en'=>'Sulaiman AL-Rajhi Colleges', 'name_ar'=>'كليات سليمان الراجحي '],
            ['name_en'=>'Onaizah Colleges', 'name_ar'=>'كليات عنيزة الأهلية'],
            ['name_en'=>'Ibn Rushd College For Management Sciences', 'name_ar'=>'كلية ابن رشد للعلوم الإدارية'],
            ['name_en'=>'Ibn Sina National College For Medical Studies', 'name_ar'=>'كلية ابن سينا الاهلية'],
            ['name_en'=>'AL-Baha Private College Science', 'name_ar'=>'كلية الباحة الاهلية للعلوم'],
            ['name_en'=>'Batterjee Medical College', 'name_ar'=>'كلية البترجي'],
            ['name_en'=>'Al-Riyada College For Health Sciences', 'name_ar'=>'كلية الريادة للعلوم الصحية'],
            ['name_en'=>'Alrayan Colleges', 'name_ar'=>'كليات الريان الأهلية بالمدينة المنورة'],
            ['name_en'=>'Arab East College', 'name_ar'=>'كليات الشرق العربي للدراسات العليا'],
            ['name_en'=>'Inaya Medical College', 'name_ar'=>'كلية العناية الطبية'],
            ['name_en'=>'Alghad International Colleges', 'name_ar'=>'كلية الغد الدولية'],
            ['name_en'=>'Alfarabi Colleges ', 'name_ar'=>'كلية الفارابي الأهلية'],
            ['name_en'=>'Qassim Private Colleges', 'name_ar'=>'كليات القصيم الأهلية'],
            ['name_en'=>'Buraydah Colleges', 'name_ar'=>'كليات بريدة الأهلية'],
            ['name_en'=>'Jeddah International College', 'name_ar'=>'كلية جدة العالمية الأهلية'],
            ['name_en'=>'Saad College of Nursing and Health Sciences', 'name_ar'=>'كلية سعد للتمريض والعلوم الصحية الأهلية'],
            ['name_en'=>'Fakeeh College For Medical Sciences', 'name_ar'=>'كلية فقيه للعلوم الطبية'],
            ['name_en'=>'Mohammed Al Mana College For Medical Sciences', 'name_ar'=>'كلية محمد المانع للعلوم الطبية'],
            ['name_en'=>'Prince Sultan College Of Business', 'name_ar'=>'كلية الامير سلطان للإدارة '],

        ];

        foreach ($institutions as $institution)
        {
                \App\Models\Setting\Institution::create($institution);
        }
    }
}
