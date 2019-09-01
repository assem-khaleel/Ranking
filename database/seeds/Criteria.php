<?php

use Illuminate\Database\Seeder;

class Criteria extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criterias = [
            ['system_id'=>'1', 'name_en'=>'Academic reputation', 'name_ar'=>'السمعة الأكاديمية', 'percentage'=>'40', 'description_en'=>'Academic reputation is measured using a global survey, in which academics are asked to identify the institutions where they believe the best work is currently taking place within their own field of expertise. The aim is to give prospective students a sense of the consensus of opinion within the international academic community.', 'description_ar'=>'تقاس السمعة الأكاديمية من خلال استبيان عالمي، حيث يطلب من الأكاديميين تحديد المؤسسات التي يعتقدون أنها تقدم أفضل عمل ضمن مجال خبراتهم، والهدف منها هو إعطاء الطلاب المحتملين شعورا بتوافق الآراء  داخل المجتمع الأكاديمي الدولي. 
فيما يتعلق بإصدار 2016 / 2017،وصل عدد المساهمات الأكاديمية إلى 74651. ويتم تطبيق الأوزان الإقليمية لمواجهة أي اختلافات في معدلات الاستجابة'],

            ['system_id'=>'1', 'name_en'=>'Employer reputation', 'name_ar'=>'سمعة أصحاب العمل ', 'percentage'=>'10', 'description_en'=>'The employer reputation indicator is also based on a global survey, The survey asks employers to identify the universities they perceive to be producing the best graduates. This indicator is unique among international university rankings', 'description_ar'=>'يستند مؤشر سمعة أصحاب العمل على استبيان عالمي، هذه المرة يتم سؤال أصحاب العمل عن الجامعات التي ينصحون الالتحاق بها ويرون خريجيها من أفضل الخريجين. 
هذا المؤشر يعد من المؤشرات الفريدة في تصنيف الجامعات إذ يهدف إلى إعطاء الطلاب فكرة أفضل  عن سوق العمل وفرصة الالتحاق بالاعتماد على الجامعات، ويتم إعطاء الأوزان للجامعات من أصحاب العمل وفي حال كان أصحاب العمل من دول أخرى يتم إعطاء أوزان أعلى، لذا يعتبر هذا المؤشر مهم جداً ومفيد للطلاب لتحديد سمعة الجامعة داخل الدولة وخارج حدودها الوطنية.'],

            ['system_id'=>'1', 'name_en'=>'Student-to-faculty ratio', 'name_ar'=>'نسبة الطلاب لأعضاء الهيئة التدريسية', 'percentage'=>'20', 'description_en'=>'This is a simple measure of the number of academic staff employed relative to the number of students enrolled. this indicator aims to identify the universities that are best equipped to provide small class sizes and a good level of individual supervision, to be collected from different all the colleges within the university.', 'description_ar'=>'هذا المقياس من المقاييس البسيطة التي تعتمد على عدد أعضاء الهيئة التدريسية في الجامعة مقارنة مع عدد الطلاب المسجلين، يهدف هذا المؤشر إلى تحديد الجامعات التي تعد الأفضل تجهيزاً وتوفر فصول دراسية بحجم صغير ومستوى جيد من الإشراف وذلك في غياب معيار دولي يتم من خلاله قياس جودة التعليم.'],

            ['system_id'=>'1', 'name_en'=>'Citations per faculty', 'name_ar'=>'الاستشهاد لكل عضو هيئة تدريسية', 'percentage'=>'20', 'description_en'=>'This indicator aims to assess universities’ research impact. A ‘citation’ means a piece of research being cited (referred to) within another piece of research. Generally, the more often a piece of research is cited, the more influential it is. So the more highly cited research papers a university publishes, the stronger its research output is considered, Vice rectorate for scientific research will be responsible of collecting this data', 'description_ar'=>'يهدف هذا المؤشر إلى تقييم البحث العلمي في الجامعة. يقصد ب " الاستشهاد" هو تضمين جزء من بحث في بحث آخر و استخدامه كدليل أو استشهاد , بشكل عام كلما تم الاستشهاد ببحث ما كان تأثيره أكبر، وكلما كان عدد الابحاث المنشورة على مستوى الجامعة أكثر كان تأثيرها أكثر قوة.
تقوم QS بجمع المعلومات باستخدام Scopus والذي يعد أكبر قاعدة بيانات متخصصة في الأبحاث والاستشهادات عالمياً، يتم استخدام بيانات آخر خمس سنوات كاملة ومن خلالها يتم تقييم إجمالي عدد الاقتباسات أو الاستشهادات فيما يتعلق بعدد أعضاء الهيئة التدريسية " الأكاديميين" في الجامعة وفي هذه الحالة لا تتمتع المؤسسات أو الجامعات الكبيرة بميزة عادلة. فيما يتعلق بالترتيبات لعامي 2016/2017 فقد تم تحليل ما يقارب 10.3 مليون ورقة بحثية و 66.3 مليون استشهاد'],


        ['system_id'=>'1', 'name_en'=>'International faculty ratio', 'name_ar'=>'نسبة أعضاء الهيئة التدريسية الدوليين', 'percentage'=>'5', 'description_en'=>'The aim of this study is to assess the extent to which the university succeeds in attracting academies from other countries. This depends on the proportion of university faculty members.', 'description_ar'=>'يهدف مؤشر إلى تقييم مدى نجاح الجامعة في جذب الأكاديميات من دول أخرى. يعتمد هذا على نسبة أعضاء هيئة التدريس في الجامعة.'],
        ['system_id'=>'1', 'name_en'=>'international student ratio', 'name_ar'=>'نسبة الطلاب الدوليين', 'percentage'=>'5', 'description_en'=>'The aim is to assess how successful the university is in attracting students from other countries. This depends on the proportion of international students.', 'description_ar'=>'يهدف مؤشر إلى تقييم مدى نجاح الجامعة في جذب الطلاب  من دول أخرى. يعتمد هذا على نسبة الطلاب الدوليين . '],

        ['system_id'=>'2', 'name_en'=>'Teaching', 'name_ar'=>'التعليم', 'percentage'=>'30', 'description_en'=>' 1. Reputation survey: This survey will be conducted by the ranking agency<br>
        2. Staff-to-student ratio: to be collected from university departments<br>
        3. Doctorate-to-bachelor’s ratio: to be collected from university departments<br>
        4. Doctorates awarded-to-academic staff ratio: Vice rectorate for scientific research<br>
        5. Institutional income: Financial department '
            , 'description_ar'=>'1.استبيان لقياس سمعة الجامعة: وتقوم بهذا الاستبيان هيئة خاصة بالتصنيف<br>
           2.نسبة الطلاب إلى الموظفين: حيث يتم تحصيلها من أقسام الجامعة<br>
           3.نسبة الدكتوراة إلى البكالوريوس: يتم تحصيلها من أقسام الجامعة<br>
            4.نسبة شهادة الدكتوراه الممنوحة للأكاديميين: يتم أخذها من وكيل الجامعة للبحث العلمي<br>
            5.المردود المادي للجامعة والدخل: يتم تحصيلها من الإدارة المالية'],

        ['system_id'=>'2', 'name_en'=>'Research (volume, income and reputation)', 'name_ar'=>'الأبحاث ( العدد، المردود المالي والسمعة)', 'percentage'=>'30', 'description_en'=>'6. Reputation survey: This survey will be conducted by the ranking agency<br>
        7. Research income: Vice rectorate for scientific research<br>
        8. Research productivity: Vice rectorate for scientific research', 'description_ar'=>'6.استبيان لقياس سمعة الجامعة: وتقوم بهذا الاستبيان هيئة خاصة بالتصنيف<br>
        7.المردود المالي للأبحاث: يتم أخذها من وكيل الجامعة للبحث العلمي<br>
        8.إنتاجية البحث: ويتم أخذها من وكيل الجامعة للبحث العلمي'],

        ['system_id'=>'2', 'name_en'=>'Citations (research influence)', 'name_ar'=>'الاستشهادات ( تأثير الأبحاث)', 'percentage'=>'30', 'description_en'=>'9. research influence: Vice rectorate for scientific research
        ', 'description_ar'=>'9.تأثر الأبحاث: ويتم أخذها من وكيل الجامعة للبحث العلمي'],


        ['system_id'=>'2', 'name_en'=>'International outlook (staff, students, research)', 'name_ar'=>'النظرة الدولية ( الموظفين، الطلاب، الأبحاث)', 'percentage'=>'7.5', 'description_en'=>'10. International-to-domestic-student ratio: Deanship of admission and registration<br>
       11. International-to-domestic-staff ratio: University departments<br> 
       12. International collaboration: University departments', 'description_ar'=>'10.نسبة الطلاب الدوليين للطلبة المحليين: يتم تحصيلها من عمادة القبول والتسجيل<br>
       11.نسبة الموظفين الدوليين للموظفين المحليين: يتم تحصيلها من الجامعة<br>
       12.التعاون الدولي: يتم تحصيلها من أقسام الجامعة'],

        ['system_id'=>'2', 'name_en'=>'Industry income', 'name_ar'=>'المردود المالي الصناعي', 'percentage'=>'2.5', 'description_en'=>'13. knowledge transfer: Vice rectorate for scientific research and other departments', 'description_ar'=>'13.التبادل المعرفي: يتم تحصيلها من وكيل الجامعة للبحث العلمي والأقسام الأخرى'],



            ['system_id'=>'3', 'name_en'=>'Global research reputation', 'name_ar'=>'سمعة البحوث العالمية', 'percentage'=>'12.5', 'description_en'=>'This indicator reflects the aggregation of the most recent five years of results of the Academic Reputation Survey for the best universities globally for research. ', 'description_ar'=>'يعكس هذا المؤشر تجميع آخر خمس سنوات من نتائج استبيان السمعة الأكاديمية لأفضل الجامعات على مستوى العالم للبحث.'],

            ['system_id'=>'3', 'name_en'=>'Regional research reputation', 'name_ar'=>'سمعه البحوث الاقليميه', 'percentage'=>'12.5', 'description_en'=>'This indicator reflects the aggregation of the most recent five years of results of the Academic Reputation Survey for the best universities for research in the region; regions were determined based on the United Nations definition. 

This regional indicator had the effect of significantly increasing the international diversity of the rankings, since it focused on measuring academics\' opinions of other universities within their region. The U.S. News rankings are the only global rankings to use this indicator, and the 2019 edition marks the fifth year of its inclusion.', 'description_ar'=>'يعكس هذا المؤشر تجميع آخر خمس سنوات من نتائج استبيان السمعة الأكاديمية لأفضل الجامعات للبحث في المنطقة ؛ تم تحديد المناطق بناءً على تعريف الأمم المتحدة.

كان لهذا المؤشر الإقليمي تأثير زيادة كبيرة في التنوع الدولي للتصنيفات ، لأنه ركز على قياس آراء الأكاديميين في الجامعات الأخرى في منطقتهم. تصنيفات الأخبار في الولايات المتحدة هي التصنيفات العالمية الوحيدة التي تستخدم هذا المؤشر ، وتصادف نسخة 2019 السنة الخامسة لإدراجها.'],



            ['system_id'=>'3', 'name_en'=>'Publications', 'name_ar'=>'المنشورات', 'percentage'=>'10', 'description_en'=>'This is a measure of the overall research productivity of a university, based on the total number of scholarly papers – reviews, articles and notes – that contain affiliations to a university and are published in high-quality, impactful journals. This indicator is closely linked to the university\'s size. It is also influenced by the university\'s discipline focus, since some disciplines, particularly medicine, publish more than others.', 'description_ar'=>'هذا مقياس للإنتاجية البحثية الإجمالية للجامعة ، استنادًا إلى العدد الإجمالي للأوراق العلمية - المراجعات والمقالات والملاحظات - التي تحتوي على ارتباطات بجامعة ويتم نشرها في مجلات عالية الجودة ومؤثرة. يرتبط هذا المؤشر ارتباطًا وثيقًا بحجم الجامعة. يتأثر أيضًا بتركيز الانضباط في الجامعة ، نظرًا لأن بعض التخصصات ، وخاصة الطب ، تنشر أكثر من غيرها.'],

            ['system_id'=>'3', 'name_en'=>'Books', 'name_ar'=>'الكتب', 'percentage'=>'2.5', 'description_en'=>'Books are an important medium of publication for scholarly research, particularly in the social sciences, arts and humanities. The use of this ranking indicator provides a useful supplement to the data on articles and better represents universities that have a focus on social sciences and arts and humanities.', 'description_ar'=>'الكتب هي وسيلة هامة للنشر للبحث العلمي ، وخاصة في العلوم الاجتماعية والفنون والعلوم الإنسانية. يوفر استخدام مؤشر الترتيب هذا ملحقًا مفيدًا للبيانات حول المقالات ويمثل بشكل أفضل الجامعات التي تركز على العلوم الاجتماعية والفنون والعلوم الإنسانية.'],

            ['system_id'=>'3', 'name_en'=>'Conferences', 'name_ar'=>'المؤتمرات', 'percentage'=>'2.5', 'description_en'=>'Academic conferences are an important venue for scholarly communication, particularly in disciplines tied to engineering and computer science. The formal publication of conference proceedings can represent genuine research breakthroughs in certain fields that may not have been documented or published elsewhere.', 'description_ar'=>'تعد المؤتمرات الأكاديمية مكانًا مهمًا للتواصل العلمي ، لا سيما في التخصصات المرتبطة بالهندسة وعلوم الكمبيوتر. يمكن للنشر الرسمي لوقائع المؤتمر أن يمثل اختراقات بحثية حقيقية في مجالات معينة قد لا تكون موثقة أو منشورة في مكان آخر.'],

            ['system_id'=>'3', 'name_en'=>'Normalized citation impact	', 'name_ar'=>'تأثير الإقتباس الطبيعي', 'percentage'=>'10', 'description_en'=>'The total number of citations per paper represents the overall impact of the research of the university and is independent of the university\'s size or age; the value is normalized to overcome differences in research area, the paper\'s publication year and publication type.', 'description_ar'=>'يمثل العدد الإجمالي للاقتباسات لكل ورقة التأثير الكلي لبحوث الجامعة ومستقلاً عن حجم الجامعة أو عمرها ؛ يتم تطبيع القيمة للتغلب على الاختلافات في مجال البحث وسنة نشر الورقة ونوع المنشور.'],

            ['system_id'=>'3', 'name_en'=>'Total citations', 'name_ar'=>'مجموع الإقتباسات', 'percentage'=>'7.5', 'description_en'=>'This indicator measures how influential the university has been on the global research community. It is determined by multiplying the publications ranking factor by the normalized citation impact factor. Total citations have been normalized to overcome differences in research area, publication year of the paper and publication type.', 'description_ar'=>'يقيس هذا المؤشر مدى تأثير الجامعة على مجتمع البحث العالمي. يتم تحديد ذلك عن طريق ضرب عامل تصنيف المنشورات بعامل تأثير الاقتباس الطبيعي. تم تطبيع إجمالي الاستشهادات للتغلب على الاختلافات في مجال البحث وسنة النشر للورقة ونوع المنشور.'],

            ['system_id'=>'3', 'name_en'=>'Number of publications that are among the 10 percent most cited', 'name_ar'=>'عدد المنشورات التي تعد من بين أكثر 10 في المائة اقتبس بها', 'percentage'=>'12.5', 'description_en'=>'This indicator reflects the number of papers that have been assigned as being in the top 10 percent of the most highly cited papers in the world for their respective fields. Each paper is given a percentile score that represents where it falls, in terms of citation rank, compared with similar papers – those with the same publication year, subject and document type. 

Since the number of highly cited papers is dependent on the university\'s size, the indicator can be considered a robust indication of how much excellent research the university produces.', 'description_ar'=>'يعكس هذا المؤشر عدد الأوراق التي تم تعيينها على أنها ضمن أفضل 10 بالمائة من أكثر الأوراق التي تم الاستشهاد بها في العالم لكل مجال منها. يتم منح كل ورقة درجة مئوية تمثل المكان الذي يقع فيه ، من حيث ترتيب الاقتباس ، مقارنةً بالأوراق المماثلة - تلك التي لها نفس سنة النشر والموضوع ونوع المستند.

نظرًا لأن عدد الأوراق التي تم الاستشهاد بها اعتمادًا على حجم الجامعة ، يمكن اعتبار المؤشر مؤشرا قويا على حجم الأبحاث الممتازة التي تنتجها الجامعة.'],

            ['system_id'=>'3', 'name_en'=>'Percentage of total publications that are among the 10 percent most cited', 'name_ar'=>'النسبة المئوية لمجموع المنشورات التي تعد من بين أكثر 10 في المائة اقتبس بها', 'percentage'=>'10', 'description_en'=>'This indicator is the percentage of a university\'s total papers that are in the top 10 percent of the most highly cited papers in the world – per field and publication year. It is a measure of the amount of excellent research the university produces and is independent of the university\'s size.', 'description_ar'=>'هذا المؤشر هو النسبة المئوية لإجمالي أوراق الجامعة التي تحتل أعلى 10 في المائة من أكثر الأوراق التي تم الاستشهاد بها في العالم - لكل مجال وسنة النشر. وهو مقياس لكمية البحوث الممتازة التي تنتجها الجامعة ومستقلة عن حجم الجامعة.'],

            ['system_id'=>'3', 'name_en'=>'International collaboration', 'name_ar'=>'التعاون الدولي', 'percentage'=>'5', 'description_en'=>'This indicator is the proportion of the institution\'s total papers that contain international co-authors divided by the proportion of internationally co-authored papers for the country that the university is in. It shows how international the research papers are compared with the country in which the institution is based. International collaborative papers are considered an indicator of quality, since only the best research will be able to attract international collaborators.', 'description_ar'=>'يمثل هذا المؤشر نسبة إجمالي أوراق المؤسسة التي تحتوي على مؤلفين دوليين مقسومًا على نسبة الأوراق المؤلفة دوليًا للبلد الذي توجد فيه الجامعة. إنه يوضح كيف تتم مقارنة أوراق البحث الدولية بالدولة التي توجد بها ويستند المؤسسة. تعتبر الأوراق التعاونية الدولية مؤشرا للجودة ، حيث أن أفضل الأبحاث فقط هي التي ستتمكن من جذب المتعاونين الدوليين.'],

            ['system_id'=>'3', 'name_en'=>'Percentage of total publications with international collaboration', 'name_ar'=>'النسبة المؤية لمدموع المنشورات بالتعاون الدولي', 'percentage'=>'5', 'description_en'=>'This indicator is the proportion of the institution\'s total papers that contain international co-authors and is another measure of quality. ', 'description_ar'=>'هذا المؤشر هو نسبة الأوراق الكلية للمؤسسة التي تحتوي على مؤلفين دوليين مشاركين وهي مقياس آخر للجودة.'],

            ['system_id'=>'3', 'name_en'=>'Number of highly cited papers that are among the top 1 percent most cited in their respective field', 'name_ar'=>'عدد الأوراق التي تم الإقتباس بها بشكل كبير والتي تعد واحدة من أعلى 1 في المائة التي تم الإقتباس بها في مجالها', 'percentage'=>'5', 'description_en'=>'This highly cited papers indicator shows the volume of papers that are classified as highly cited in the Clarivate Analytics\' service known as Essential Science Indicators. Highly cited papers in ESI are the top 1 percent in each of the 22 subject areas represented in the Web of Science, per year. They are based on the most recent 10 years of publications.

Highly cited papers are considered indicators of scientific excellence and top performance and can be used to benchmark research performance against subject field baselines worldwide. This is a size-dependent measure.', 'description_ar'=>'يُظهر مؤشر الأوراق المذكور بشكل كبير حجم الأوراق المصنفة على أنها مستشهد بها بشدة في خدمة Clarivate Analytics المعروفة باسم مؤشرات العلوم الأساسية. تعد الأوراق التي يتم الاستشهاد بها بشدة في ESI أعلى نسبة 1 في المائة في كل مجال من مجالات الموضوعات الـ 22 الممثلة في شبكة العلوم ، كل عام. وهي تستند إلى أحدث 10 سنوات من المنشورات.

تعتبر الأوراق التي يتم الاستشهاد بها بشدة من مؤشرات التفوق العلمي والأداء الأفضل ويمكن استخدامها لقياس أداء البحوث مقارنةً بخطوط أساس المجال في جميع أنحاء العالم. هذا مقياس يعتمد على الحجم.
'],

            ['system_id'=>'3', 'name_en'=>'Percentage of total publications that are among the top 1 percent most highly cited papers', 'name_ar'=>'النسبة المئوية لمجموع الإقتباسات التي تعد من بين أعلى 1 في المائة من الأوراق المقتبس بها بشدة', 'percentage'=>'5', 'description_en'=>'This percent of highly cited papers shows the number of highly cited papers for a university divided by the total number of documents it produces, represented as a percentage. It is a measure of excellence and can show what percentage of an institution\'s output is among the most impactful papers in the world. This is a size-independent measure.', 'description_ar'=>'توضح هذه النسبة المئوية من الأوراق التي تم الاستشهاد بها بشدة عدد الأوراق التي تم الاستشهاد بها بشدة للجامعة مقسومًا على إجمالي عدد المستندات التي تنتجها ، والتي تمثل كنسبة مئوية. إنه مقياس للتميز ويمكنه إظهار النسبة المئوية من مخرجات المؤسسة من بين أكثر الأوراق تأثيرًا في العالم. هذا مقياس مستقل عن الحجم.'],


            ['system_id'=>'4', 'name_en'=>'Quality of Education', 'name_ar'=>'جودة التعليم', 'percentage'=>'10', 'description_en'=>' Alumni of an institution winning Nobel Prizes and Fields Medals', 'description_ar'=>'خريجو مؤسسة حائزة على جوائز نوبل والميداليات'],

            ['system_id'=>'4', 'name_en'=>'Quality of Faculty A', 'name_ar'=>'جودة الكلية أ', 'percentage'=>'20', 'description_en'=>'A. Staff of an institution winning Nobel Prizes and Fields Medals.', 'description_ar'=>'أ. موظفو مؤسسة حائزة على جوائز نوبل والميداليات.'],

            ['system_id'=>'4', 'name_en'=>'Quality of Faculty B', 'name_ar'=>'جودة الكلية ب', 'percentage'=>'20', 'description_en'=>'B. Highly cited researchers in 21 broad subject categories.', 'description_ar'=>'ب. استشهد بشدة الباحثين في 21 فئة واسعة المواضيع.'],

            ['system_id'=>'4', 'name_en'=>'Research Output A', 'name_ar'=>'مخرجات البحث أ', 'percentage'=>'20', 'description_en'=>'A. Papers published in Nature and Science.', 'description_ar'=>'الأوراق المنشورة في الطبيعة والعلوم'],

            ['system_id'=>'4', 'name_en'=>'Research Output B', 'name_ar'=>'مخرجات البحث ب', 'percentage'=>'20', 'description_en'=>'B. Papers indexed in Science Citation Index-expanded and Social Science Citation Index.', 'description_ar'=>'فهرسة الأوراق في مؤشر الاستشهاد العلمي ومؤشر الاستشهاد للعلوم الاجتماعية.'],

            ['system_id'=>'4', 'name_en'=>'Per Capita Performance', 'name_ar'=>'أداء الفرد', 'percentage'=>'10', 'description_en'=>'Per capita academic performance of an institution', 'description_ar'=>'نصيب الفرد من الأداء الأكاديمي للمؤسسة'],


            ['system_id'=>'5', 'name_en'=>'Quality of Education', 'name_ar'=>'جودة التعليم', 'percentage'=>'15', 'description_en'=>'measured by the number of a university\'s alumni who have won major international awards, prizes, and medals relative to the university\'s size .', 'description_ar'=>'تقاس بعدد خريجي الجامعة الذين فازوا بجوائز دولية كبرى وجوائز وميداليات نسبة إلى حجم الجامعة.'],

            ['system_id'=>'5', 'name_en'=>'Alumni Employment', 'name_ar'=>'توظيف الخريجين', 'percentage'=>'15', 'description_en'=>'measured by the number of a university\'s alumni who have held CEO positions at the world\'s top companies relative to the university\'s size.', 'description_ar'=>'تقاس بعدد خريجي الجامعة الذين شغلوا مناصب الرئيس التنفيذي في أفضل الشركات في العالم بالنسبة لحجم الجامعة.'],

            ['system_id'=>'5', 'name_en'=>'Quality of Faculty', 'name_ar'=>'جودة الكلية', 'percentage'=>'15', 'description_en'=>'measured by the number of academics who have won major international awards, prizes, and medals.', 'description_ar'=>'تقاس بعدد الأكاديميين الذين فازوا بجوائز دولية كبرى وجوائز وميداليات.'],

            ['system_id'=>'5', 'name_en'=>'Research Output', 'name_ar'=>'مخرجات البحث', 'percentage'=>'15', 'description_en'=>' measured by the the total number of research papers.', 'description_ar'=>'تقاس بالعدد الكلي للأوراق البحثية.'],

            ['system_id'=>'5', 'name_en'=>'Quality Publications', 'name_ar'=>'منشورات الجودة', 'percentage'=>'15', 'description_en'=>'measured by the number of research papers appearing in top-tier journals.', 'description_ar'=>'تقاس بعدد الأوراق البحثية التي تظهر في المجلات العليا.'],

            ['system_id'=>'5', 'name_en'=>'Influence', 'name_ar'=>'تأثير', 'percentage'=>'15', 'description_en'=>'measured by the number of research papers appearing in highly-influential journals', 'description_ar'=>'تقاس بعدد الأوراق البحثية التي تظهر في المجلات ذات التأثير الكبير'],

            ['system_id'=>'5', 'name_en'=>'Citations', 'name_ar'=>'اقتباسات', 'percentage'=>'10', 'description_en'=>' measured by the number of highly-cited research papers', 'description_ar'=>'تقاس بعدد الأوراق البحثية ذات الاستشهادات العالية'],


            ['system_id'=>'6', 'name_en'=>'القدرة الاستيعابية الكلية لبرامج التخصصات العلمية', 'name_ar'=>'القدرة الاستيعابية الكلية لبرامج التخصصات العلمية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'القدرة الاستيعابية لبرامج التخصصات النظرية', 'name_ar'=>'القدرة الاستيعابية لبرامج التخصصات النظرية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة القدرة الاستيعابية لبرامج التخصصات العلمية', 'name_ar'=>'نسبة القدرة الاستيعابية لبرامج التخصصات العلمية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المؤسسات المعتمدة من إجمالي المؤسسات', 'name_ar'=>'نسب المؤسسات المعتمدة من إجمالي المؤسسات', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المؤسسات الحاصلة على اعتماد كامل', 'name_ar'=>'نسب المؤسسات الحاصلة على اعتماد كامل', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المؤسسات الحاصلة على اعتماد مشروط', 'name_ar'=>'نسب المؤسسات الحاصلة على اعتماد مشروط', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة المؤسسات التي تقدمت للاعتماد من إجمالي المؤسسات', 'name_ar'=>'نسبة المؤسسات التي تقدمت للاعتماد من إجمالي المؤسسات', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب البرامج الحاصلة على اعتماد ( وطني او دولي) من إجمالي أعداد البرامج', 'name_ar'=>'نسب البرامج الحاصلة على اعتماد ( وطني او دولي) من إجمالي أعداد البرامج', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب البرامج الحاصلة على اعتماد وطني (كامل او مشروط) من إجمالي البرامج', 'name_ar'=>'نسب البرامج الحاصلة على اعتماد وطني (كامل او مشروط) من إجمالي البرامج', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب البرامج الحاصلة على اعتماد وطني كامل', 'name_ar'=>'نسب البرامج الحاصلة على اعتماد وطني كامل', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة البرامج الحاصلة على اعتماد وطني مشروط', 'name_ar'=>'نسبة البرامج الحاصلة على اعتماد وطني مشروط', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب البرامج التي تقدمت للحصول على الاعتماد', 'name_ar'=>'نسب البرامج التي تقدمت للحصول على الاعتماد', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'الترتيب الجامعات وفق ترتيب QS ( الترتيب الدولي / العربي / الوطني )', 'name_ar'=>'الترتيب الجامعات وفق ترتيب QS ( الترتيب الدولي / العربي / الوطني )', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'النسبة الإجمالي للمقبولين بالتعليم العالي من خريجي المرحلة الثانوية لعام التقرير', 'name_ar'=>'النسبة الإجمالي للمقبولين بالتعليم العالي من خريجي المرحلة الثانوية لعام التقرير', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة الطلاب المستمرين بالدراسة: إجمالي أعداد الطلاب المقبولين بالتخصصات المختلفة بالجامعات الحكومية', 'name_ar'=>'نسبة الطلاب المستمرين بالدراسة: إجمالي أعداد الطلاب المقبولين بالتخصصات المختلفة بالجامعات الحكومية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة الطلاب المستمرين بالدراسة: إجمالي أعداد الطلاب المقبولين بالتخصصات المختلفة بالجامعات الأهلية', 'name_ar'=>'نسبة الطلاب المستمرين بالدراسة: إجمالي أعداد الطلاب المقبولين بالتخصصات المختلفة بالجامعات الأهلية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة الاستبقاء بالجامعات الحكومية : الجامعات الأهلية', 'name_ar'=>'نسبة الاستبقاء بالجامعات الحكومية : الجامعات الأهلية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة أعضاء هيئة التدريس إلى الطلاب من الجنسين', 'name_ar'=>'نسبة أعضاء هيئة التدريس إلى الطلاب من الجنسين', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة أعداد أعضاء هيئة التدريس إلى الطلاب الذكور', 'name_ar'=>'نسبة أعداد أعضاء هيئة التدريس إلى الطلاب الذكور', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة أعداد أعضاء هيئة التدريس إلى الطالبات ', 'name_ar'=>'نسبة أعداد أعضاء هيئة التدريس إلى الطالبات ', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة أعضاء هيئة التدريس إلى الطلاب في برامج التخصصات النظرية ', 'name_ar'=>'نسبة أعضاء هيئة التدريس إلى الطلاب في برامج التخصصات النظرية ', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'التدريس لمرحلة الدراسات العليا', 'name_ar'=>'التدريس لمرحلة الدراسات العليا', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة أعضاء هيئة التدريس المشاركين في برامج الدراسات العليا إلى إجمالي أعضاء هيئة التدريس', 'name_ar'=>'نسبة أعضاء هيئة التدريس المشاركين في برامج الدراسات العليا إلى إجمالي أعضاء هيئة التدريس', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة ميزانية البحث العلمي من إجمالي ميزانية الجامعة', 'name_ar'=>'نسبة ميزانية البحث العلمي من إجمالي ميزانية الجامعة', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة التمويل من خارج الجامعة من جهات داخلية : تمويل داخلي', 'name_ar'=>'نسبة التمويل من خارج الجامعة من جهات داخلية : تمويل داخلي', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة الإنفاق على تقنية المعلومات من إجمالي الميزانية', 'name_ar'=>'نسبة الإنفاق على تقنية المعلومات من إجمالي الميزانية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة الإنفاق على تقنية المعلومات من إجمالي الميزانية', 'name_ar'=>'نسبة الإنفاق على تقنية المعلومات من إجمالي الميزانية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من برامج الرعاية والدعم والخدمات المتنوعة', 'name_ar'=>'نسب المستفيدين من برامج الرعاية والدعم والخدمات المتنوعة', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من برامج رعاية الموهوبين', 'name_ar'=>'نسب المستفيدين من برامج رعاية الموهوبين', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من خدمات الدعم المالي', 'name_ar'=>'نسب المستفيدين من خدمات الدعم المالي', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من خدمات الرعاية الصحية', 'name_ar'=>'نسب المستفيدين من خدمات الرعاية الصحية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من خدمات التغذية المدعمة', 'name_ar'=>'نسب المستفيدين من خدمات التغذية المدعمة', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من خدمات السكن', 'name_ar'=>'نسب المستفيدين من خدمات السكن', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من خدمات النقل', 'name_ar'=>'نسب المستفيدين من خدمات النقل', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من برامج رعاية المتفوقين', 'name_ar'=>'نسب المستفيدين من برامج رعاية المتفوقين', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من برامج رعاية المتعثرين و المعرّضون  للرسوب', 'name_ar'=>'نسب المستفيدين من برامج رعاية المتعثرين و المعرّضون  للرسوب', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من برامج الإرشاد النفسي', 'name_ar'=>'نسب المستفيدين من برامج الإرشاد النفسي', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من فرص التدريب الميداني الإضافية التي توفرها الجامعة خارجها', 'name_ar'=>'نسب المستفيدين من فرص التدريب الميداني الإضافية التي توفرها الجامعة خارجها', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسب المستفيدين من فرص التدريب الميداني التي توفرها الجامعة داخلها', 'name_ar'=>'نسب المستفيدين من فرص التدريب الميداني التي توفرها الجامعة داخلها', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'معدل النشر لأعضاء هيئة التدريس', 'name_ar'=>'معدل النشر لأعضاء هيئة التدريس', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'معدل النسر لأعضاء هيئة التدريس حسب التخصصات', 'name_ar'=>'معدل النسر لأعضاء هيئة التدريس حسب التخصصات', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'النسبة الإجمالية للأبحاث المنشورة بدوريات مصنفة ISI', 'name_ar'=>'النسبة الإجمالية للأبحاث المنشورة بدوريات مصنفة ISI', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'معدل براءات الاختراع المسجلة لأعضاء هيئة التدريس في مجال التخصصات العلمية', 'name_ar'=>'معدل براءات الاختراع المسجلة لأعضاء هيئة التدريس في مجال التخصصات العلمية', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'معدلات التخرج العامة (أول مرة)', 'name_ar'=>'معدلات التخرج العامة (أول مرة)', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'معدل خريجي البرامج العلمية: خريجي البرامج النظرية ', 'name_ar'=>'معدل خريجي البرامج العلمية: خريجي البرامج النظرية ', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة من التحقوا بوظائف من الخريجين المسجلين خلال عام من تخرجهم', 'name_ar'=>'نسبة من التحقوا بوظائف من الخريجين المسجلين خلال عام من تخرجهم', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],

            ['system_id'=>'6', 'name_en'=>'نسبة من التحقوا بوظائف من الخريجين المسجلين خلال عام من تخرجهم إلى إجمالي أعداد الخريجين', 'name_ar'=>'نسبة من التحقوا بوظائف من الخريجين المسجلين خلال عام من تخرجهم إلى إجمالي أعداد الخريجين', 'percentage'=>'0', 'description_en'=>'', 'description_ar'=>''],


            ['system_id'=>'7', 'name_en'=>'Setting and Infrastructure (SI)', 'name_ar'=>'الإعداد والبنية التحتية', 'percentage'=>'15', 'description_en'=>'The campus setting and infrastructure information will give the basic information of the university policy towards green environment. This indicator also shows whether the campus deserves to be called Green Campus. The aim is to trigger the participating university to provide more space for greenery and in safeguarding environment, as well as developing sustainable energy.', 'description_ar'=>'سيوفر محيط الحرم الجامعي و البنية الأساسية المعلومات الأساسية لسياسة الجامعة تجاه البيئة الخضراء.  يوضح هذا المؤشر أيضًا ما إذا كان الحرم الجامعي يستحق أن يطلق عليه اسم Green Campus. والهدف من ذلك هو تحفيز الجامعة المشاركة لتوفير مساحة أكبر للخضرة وحماية البيئة ، وكذلك تطوير الطاقة المستدامة.'],

            ['system_id'=>'7', 'name_en'=>'Energy and Climate Change (EC)', 'name_ar'=>'الطاقة وتغير المناخ', 'percentage'=>'21', 'description_en'=>'The university’s attention to the use of energy and climate change issues takes the highest weighting in this ranking. In our questionnaire we define several indicators for this particular area of concern, i.e. energy efficient appliances usage, renewable energy usage policy, total electricity use, energy conservation program, green building, climate change adaptation and mitigation program, greenhouse gas emission reductions policy. With this indicator, universities are expected to increase the effort in energy efficiency on their buildings and to take more about nature and energy resources.', 'description_ar'=>'يحظى اهتمام الجامعة بقضايا استخدام الطاقة وتغير المناخ بأعلى درجات الأهمية في هذا التصنيف. في استبياننا نحدد العديد من المؤشرات لهذا المجال بالتحديد، مثل استخدام الأجهزة الموفرة للطاقة ، وسياسة استخدام الطاقة المتجددة ، والاستخدام الإجمالي للكهرباء ، وبرنامج الحفاظ على الطاقة ، والبناء الأخضر ، برامج تخفيف تغير المناخ ، وسياسة تخفيض انبعاثات الغازات الدفيئة. من خلال هذا المؤشر ، من المتوقع أن تزيد الجامعات من الجهود المبذولة في مجال كفاءة استخدام الطاقة في مبانيها وأن تأخذ المزيد من الموارد الطبيعية للطاقة.'],

            ['system_id'=>'7', 'name_en'=>'Waste (WS)', 'name_ar'=>'النفايات', 'percentage'=>'18', 'description_en'=>'Waste treatment and recycling activities are major factors in creating a sustainable environment.The activities of university staff and students in campus will produce a lot of waste, therefore some programs and waste treatments should be among the concern of the university, i.e. recycling program, toxic waste recycling, organic waste treatment, inorganic waste treatment, sewerage disposal, policy to reduce the use of paper and plastic in campus.', 'description_ar'=>'تعد أنشطة معالجة النفايات وإعادة تدويرها أحد العوامل الرئيسية في تهيئة البيئة المستدامة. أنشطة موظفي الجامعة والطلاب في الحرم الجامعي تؤدي إلى إهدار الكثير من النفايات، لذلك ينبغي أن تكون بعض برامج معالجة النفايات من اهتمامات الجامعة، مثل برنامج إعادة التدوير، معالجة النفايات العضوية، معالجة النفايات غير العضوية، التخلص من مياه الصرف الصحي، إعادة تدوير النفايات السامة، وأخيراً الحد من الاستخدام الورقي والبلاستيكي في الحرم الجامعي.'],

            ['system_id'=>'7', 'name_en'=>'Water (WR)', 'name_ar'=>'الماء', 'percentage'=>'10', 'description_en'=>'Water use in campus is another important indicator in Greenmetric. The aim is that universities can decrease water usage, increase conservation program, and protect the habitat. Water conservation program, piped water use are among the criteria.', 'description_ar'=>'استخدام المياه في الحرم الجامعي هو مؤشر آخر مهم  من مؤشرات GreenMetric، ويهدف إلى تقليل استخدام المياه في الحرم الجامعي، زيادة برامج الحفاظ على المياه، وحماية المواطن, برامج الحفاظ على المياه، ويعتبر استخدام المياه في الأنابيب إحدى هذه المعايير.'],

            ['system_id'=>'7', 'name_en'=>'Transportation (TR)', 'name_ar'=>'النقل', 'percentage'=>'18', 'description_en'=>'Transportation system plays an important role on the carbon emission and pollutant level in university. Transportation policy to limit the number of motor vehicles in campus, the use of campus bus and bicycle will encourage a healthier environment. The pedestrian policy will encourage students and staff to walk around campus, and avoid using private vehicle. The use of environmentally friendly public transportation will decrease carbon footprint around campus.', 'description_ar'=>'يلعب نظام النقل في الجامعة دوراً مهماً من حيث نسبة الانبعاثات الكربونية والملوثات داخل الحرم الجامعي، سياسة النقل بالجامعة تعطي حد معين لعدد السيارات في نطاقها، ويفضل استخدام حافلة الجامعة الداخلية والدراجة وذلك تشجيعاً لبيئة صحية، كما أن سياسة المشي للطلاب والموظفين المستخدمة للتجول في الحرم الجامعة, وتجنب استخدام المركبات الخاصة و استخدام وسائل النقل الصديقة للبيئة سوف تسهم في التقليل من هذه الانبعاثات الكربونية حول الحرم الجامعي.'],

            ['system_id'=>'7', 'name_en'=>'Education and Research (ED)', 'name_ar'=>'التعليم والبحث العلمي', 'percentage'=>'18', 'description_en'=>'In 2012 questionnaire, one new criterion added to the questionnaire: education. This criterion has 18% of the total score. This criteria is based on the thought that university has an important role in creating the new generation concern with sustainability issues.', 'description_ar'=>'في استطلاع عام 2012، تم إضافة معيار واحد وهو التعليم هذا المعيار له نسبة تقارب 18%، وتعتمد هذه المعايير على فكرة دور الجامعة المهم في خلق اهتمام لمشكلات الاستدامة'],




        ];
        foreach ($criterias as $criteria)
        {
            \App\Models\Settings\RankingCriteria::create($criteria);
        }
    }
}
