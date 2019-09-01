<?php

use Illuminate\Database\Seeder;
use App\Models\Settings\RankingIndicator;
class Indicators extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $indicators = [
            ['criterion_id'=>'7', 'name_en'=>'Reputation survey: This survey will be conducted by the ranking agency', 'name_ar'=>' استبيان لقياس سمعة الجامعة: وتقوم بهذا الاستبيان هيئة خاصة بالتصنيف', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'7', 'name_en'=>'Staff-to-student ratio: to be collected from university departments', 'name_ar'=>' نسبة الطلاب إلى الموظفين: حيث يتم تحصيلها من أقسام الجامعة', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'7', 'name_en'=>'Doctorate-to-bachelor’s ratio: to be collected from university departments', 'name_ar'=>'. نسبة الدكتوراة إلى البكالوريوس: يتم تحصيلها من أقسام الجامعة', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'7', 'name_en'=>'Doctorates awarded-to-academic staff ratio: Vice rectorate for scientific research', 'name_ar'=>'نسبة شهادة الدكتوراه الممنوحة للأكاديميين: يتم أخذها من وكيل الجامعة للبحث العلمي', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'7', 'name_en'=>'Institutional income: Financial department', 'name_ar'=>' المردود المادي للجامعة والدخل: يتم تحصيلها من الإدارة المالية', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'8', 'name_en'=>'Reputation survey: This survey will be conducted by the ranking agency', 'name_ar'=>' استبيان لقياس سمعة الجامعة: وتقوم بهذا الاستبيان هيئة خاصة بالتصنيف', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'8', 'name_en'=>'Research income: Vice rectorate for scientific research', 'name_ar'=>'المردود المالي للأبحاث: يتم أخذها من وكيل الجامعة للبحث العلمي', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'8', 'name_en'=>'Research productivity: Vice rectorate for scientific research', 'name_ar'=>' إنتاجية البحث: ويتم أخذها من وكيل الجامعة للبحث العلمي', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'9', 'name_en'=>'research influence: Vice rectorate for scientific research', 'name_ar'=>'تأثر الأبحاث: ويتم أخذها من وكيل الجامعة للبحث العلمي', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'10', 'name_en'=>'International-to-domestic-student ratio: Deanship of admission and registration', 'name_ar'=>' نسبة الطلاب الدوليين للطلبة المحليين: يتم تحصيلها من عمادة القبول والتسجيل', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'10', 'name_en'=>'International-to-domestic-staff ratio: University departments', 'name_ar'=>'نسبة الموظفين الدوليين للموظفين المحليين: يتم تحصيلها من الجامعة', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'10', 'name_en'=>'International collaboration: University departments', 'name_ar'=>'التعاون الدولي: يتم تحصيلها من أقسام الجامعة', 'description_en'=>'', 'description_ar'=>''],

            ['criterion_id'=>'11', 'name_en'=>'knowledge transfer: Vice rectorate for scientific research and other departments', 'name_ar'=>'التبادل المعرفي: يتم تحصيلها من وكيل الجامعة للبحث العلمي والأقسام الأخرى', 'description_en'=>'', 'description_ar'=>''],


        ];

        foreach ($indicators as $indicator)
        {
            RankingIndicator::create($indicator);
        }
    }
}
