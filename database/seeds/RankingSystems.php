<?php

use Illuminate\Database\Seeder;

class RankingSystems extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $rankingSystems = [
                [
                    'name_en'=> 'Quacquarelli Symonds',
                    'name_ar'=> 'Quacquarelli Symonds',
                    'url'=> 'https://www.topuniversities.com',
                    'description_en'=>'QS World University Rankings is an annual publication of university rankings by Quacquarelli Symonds (QS), '
                        .'it was first found in 2004 in collaboration with Times Higher Education Ranking, in 2010 QS ranking became an individual ranking agency.',
                    'description_ar'=> 'تصنيف QS العالمي للجامعات هو تصنيف أعلى الجامعات عالمياً المقدم من Quacquarelli Symonds '
                        .' ويتم  نشره سنوياً منذ عام 2004، في عام 2011 تم تصنيف ما يقارب 712 جامعة، على رأس هذه الجامعات  جامعة كامبريدج في المملكة المتحدة،'
                        .' جامعة هارفرد في الولايات المتحدة الأمريكية، ومعهد ماساتشوستس للتكنولوجيا المعلومات. .'
                        .' تصنيف QS ينشر من قبل US News & World Report في الولايات المتحدة الأمريكية تحت مسمى  " أفضل الجامعات في العالم"،'
                        .' إلى أن قامت Us News & World Report  بإنشاء نظام التصنيف الخاص بها  " أفضل الجامعات في العالم" في شهر أكتوبر من عام 2014. '
                        .'تصنيف QS يتم تطويره بشكل دائم بحيث توسع التقييم الخاص ب QS إلى 900 جامعة في عامي 2016 / 2017  مع أكثر من 3800 تقييم.',
                    'abbreviation'=>'QS'
                ],

                [
                    'name_en'=> 'Times Higher Education',
                    'name_ar'=> 'Times Higher Education',
                    'url'=> 'https://www.thetimes.co.uk',
                    'description_en'=>'The Times Higher Education World University Rankings, founded in 2004, provide the definitive list of the world\'s best universities,'
                        .' evaluated across teaching, research, international outlook, reputation and more.',
                    'description_ar'=> '(THE) هي نشرة سنوية لتصنيف الجامعات تقوم مجلة Times Higher Education بنشرها.'
                        .' نشر هذه النشرة بالتعاون مع Quacquarelli Symonds  لنشر تصنيف الجامعات  THE-QS المشترك من الأعوام 2004 -2009 قبل أن يقوم طوماس رويترز  '
                        .'بإنشاء نظام جديد للتصنيف. هذه النشرة تحتوي على التصنيف العالمي للجامعات بالاعتماد على المواضيع، والسمعة،'
                        .' بالإضافة إلى  3 جداول إقليمية للجامعات : اسيا، امريكا اللاتينية، الاقتصاد الاشتراكي و الدول الأربعة العظمى والتي تم إنشاؤها بالاعتماد على الأوزان المختلفة .'
                        .'تصنيف THE يعد من أكثر التصنيفات الجامعية التي يتم ملاحظتها ومتابعتها على نطاق واسع مع التصنيف الأكاديمي العالمي للجامعات و تصنيف QS العالمي للجامعات.'
                        .' وتم الاشادة كثيراً بمنهجية التصنيف الجديدة والتي يتم تحسينها منذ عام 2010',
                    'abbreviation'=>'THE'
                ],

                [
                    'name_en'=> 'US NEWS Ranking & World Report',
                    'name_ar'=> 'US NEWS Ranking & World Report',
                    'url'=> 'https://www.usnews.com',
                    'description_en'=>'U.S. News & World Report is a multi-platform publisher of news and information, which includes www.usnews.com '.
                        'and annual print and e-book versions of its authoritative rankings of Best Colleges, Best Graduate Schools and Best Hospitals.',
                    'description_ar'=> 'شركة اعلامية تقوم بنشر الأخبار، الأراء، ونصائح المستهلكين، التصنيفات والتحليلات.'
                        .'تم إنشاؤها ك مجلة  اخبارية  اسبوعية في عام 1933 ومن ثم انتقلت إلى النشر الإلكتروني في عام 2010 ،'
                        .' وتعد الأخبار في الوقت الحاضر من الطرق المؤثرة في اختيار افضل الكليات، المستشفيات تصنيفاً،'
                        .' إلا أنها توسعت في المحتوى لتشمل عروض المنتجات في مجالات التعليم، الصحة، المال والوظائف، السفر والترحال والسيارات.'
                        .'وهذا التصنيف مشهور في امريكا الشمالية إذ أنها قدمت انتقاد واسع النطاق للكليات وإدارتها والطلاب وذلك لطبيعتهم المشكوك بها والمعسفة.'
                        .'ظهرت أهمية وشعبية تصنيف US NEWS Ranking & World Report في اصدار عام 2014، إذ استطاعت جذب 2.6 مليون زائر و 18.9 مليون عرض لصفحة usnews.com  في يوم واحد ،'
                        .' وتم تحديد الزيارات من أكثر  من 3000 موقع منها شبكة التواصل الاجتماعي facebook و جوجل.'
                        .' ولا زالت شركة US NEWS Ranking & World Report تقوم بنشر متواصل لأدلة الكليات ونشرها على شكل كتاب، '
                        .'وقام روبرت موريس بإنشاء تصنيف U.s News لأفضل الكليات والمنهجية المتبعة لهذا التصنيف ولا يزال إلى الآن يشرف على تطبيقه كرئيس البيانات الاستراتيجية في  U.s news ',
                    'abbreviation'=>'U.S. News'
                ],

                [
                    'name_en'=> 'Academic Ranking of World Universities "Shanghai"',
                    'name_ar'=> 'التصنيف الأكاديمي للجامعات العالمية ( تصنيف شانغهاي)',
                    'url'=> 'http://www.shanghairanking.com',
                    'description_en'=>'The Academic Ranking of World Universities (ARWU) was first published in June 2003 by the Center for World-Class Universities (CWCU),'
                        .' More than 1200 universities are actually ranked by ARWU every year and the best 500 are published.',
                    'description_ar'=> 'شركة Shanghai Ranking Consultancy شركة مستقلة بالكامل كرست نفسها للبحث في التعليم العالي والاستشارات.'.
                        ' وكان النشر الرسمي لهذا التصنيف الأكاديمي للجامعات العالمية في عام 2009.التصنيف الأكاديمي للجامعات العالمية (ARWU) نُشر لأول مرة في يونيو 2003 من قبل مركز الجامعات العالمية (CWCU) '
                        .'، كلية الدراسات العليا للتعليم من جامعة شنغهاي جياو تونغ - الصين ( معهد التعليم العالي سابقاً) ، ويتم تحديثها بشكل سنوي.'
                        .'منذ عام 2009 تم نشر التقييم الأكاديمي للجامعات العلمية وحفظ حقوق النشر ل Shanghai Ranking Consultancy، '
                        .'وتعد من الشركات المستقلة تماماً عن التعليم العالي وغير تابعة قانونياً لأي جامعة أو وكالة حكومية.',
                    'abbreviation'=>'U.S. ARWU'
                ],

                [
                    'name_en'=> 'Center for World University Rankings',
                    'name_ar'=> 'مركز التصنيف العالمي للجامعات  (CWUR)',
                    'url'=> 'http://www.http://cwur.org',
                    'description_en'=>'Since 2012, CWUR has been publishing the only academic ranking of global universities that assesses the quality of education, alumni employment,'
                        .' research output, and citations without relying on surveys and university data submissions. '
                        .'The ranking started out as a project in Jeddah, Saudi Arabia with the aim of rating the top 100 world universities. '
                        .'It was quickly reported worldwide by universities and the media and many requests were received to expand it. In 2014, '
                        .'the ranking expanded to list the top 1000 out of eighteen thousand universities worldwide, making it the largest academic ranking of global universities.',
                    'description_ar'=> 'منذ عام 2012 ينشر مركز التصنيف العالمي للجامعات  (CWUR)تصنيفات جامعية عالمية تقيس جودة تعليم وتدريب الطلاب '
                        .'بالإضافة إلى تاثير أعضاء هيئة التدريس وجودة أبحاثهم دون الاعتماد على الاستبيانات والبيانات الجامعية. '
                        .'بالإضافة إلى ذلك ، تصنف CWUR الجامعات الرائدة في العالم حسب الموضوعات في 227 فئة موضوعات،'
                        .' استنادا إلى عدد من المقالات البحثية في المجلات العلمية ذات الدرجة الأولى مع البيانات التي يتم الحصول عليها من Clarivate Analytics.',
                    'abbreviation'=>'CWUR'
                ],

                [
                    'name_en'=> 'National Commission for Academic Accreditation and Assessment',
                    'name_ar'=> 'الهيئة الوطنية للتقييم والاعتماد الأكاديمي',
                    'url'=> 'https://www.ncaaa.org.sa',
                    'description_en'=>'The National Commission for Academic Accreditation and Assessment Is a Saudi governmental institution that supervises academic '
                        .'evaluation and accreditation in the Kingdom of Saudi Arabia and supervises the accreditation of all higher education institutions.'
                        .' The Commission was established in 2004 and administratively administrated by the Supreme Education Council. '
                        .'The National Commission for Academic Accreditation and Accreditation in 1424H, and it enabled standards for academic performance '
                        .'under the supervision of the Council of Higher Education, then amended the supervision in 1424 AH.',
                    'description_ar'=> 'هيئة الوطنية للتقويم والاعتماد الأكاديمي هي مؤسسة حكومية سعودية تقوم بالإشراف على التقييم والاعتماد الأكاديمي في المملكة العربية السعودية،'
                        .'كما تشرف على اعتماد كل مؤسسات التعليم فوق المرحلة الثانوية. تأسست الهيئة عام  2004 وتتبع إداريًا المجلس الأعلى للتعليم.'
                        .'أُنشئت الهيئة الوطنية للتقويم والاعتماد الأكاديمي عام 1424 هـ، ومكنت في أن تتمتع بالشخصية المعنوية والاستقلال الإداري والمالي، '
                        .'وتكون السلطة المسؤولة عن شؤون ضمان الجودة والاعتماد الأكاديمي في مؤسسات التعليم فوق الثانوي عدا التعليم العسكري، بغرض الارتقاء بجودة التعليم فوق الثانوي الحكومي والأهلي،'
                        .' وضمان الوضوح والشفافية، وتوفير معايير مقننة للأداء الأكاديمي، وذلك تحت إشراف مجلس التعليم العالي، ثم عُدًلت جهة الإشراف عام 1424 هـ لتصبح الهيئة تحت إشراف المجلس الأعلى للتعليم.',
                    'abbreviation'=>'NCAAA'
                    ],

                [
                    'name_en'=> 'Green Metric',
                    'name_ar'=> 'Green Metric',
                    'url'=> 'https://greenmetric.ui.ac.id',
                    'description_en'=>'UI GreenMetric World University is an initiative of Universitas Indonesia, launched in 2010.'
                        .' As part of its strategy to elevate its international standing, the University hosted an international conference '
                        .'on the classification of world universities on April 16, 2009. A number of experts called for the classification of international universities '
                        .'such as Isometro Aguelo (Webometrics), Angela Young Chi-hee, and Educational Policy Canada.'
                        .'This classification is based on an appropriate unified system to attract the support of thousands of universities in the world.'
                        .' Results are based on a numerical score that allows for rapid comparisons between universities based on criteria including '
                        .'commitment to addressing sustainability and environmental impact issues.',
                    'description_ar'=>'ان تصنيف جامعة UI GreenMetric World University هو مبادرة من (Universitas Indonesia) والتي تم إطلاقها في عام 2010.'
                        .' كجزء من استراتيجيتها لرفع مكانتها الدولية ، استضافت الجامعة مؤتمراً دولياً حول تصنيف الجامعات العالمية في 16 أبريل 2009.'
                        .'ودعت عدد من الخبراء في تصنيف الجامعات العالمية مثل إيسيدرو أغيلو (Webometrics) ، وأنجيلا يونغ تشي هو (HEEACT) ، وأليكس أوشر (Educational Policy Canada).'
                        .'يعتمد هذا التصنيف على نظام موحد مناسب لجذب دعم الآلاف من جامعات العالم حيث تستند النتائج إلى درجة عددية تسمح بالتصنيف'
                        .'بحيث يمكن إجراء مقارنات سريعة بين الجامعات بناءً على معايير من ضمنها الالتزام بمعالجة مشاكل الاستدامة والأثر البيئي',
                    'abbreviation'=>'GreenMetric'
                    ]

            ];
            foreach ($rankingSystems as $rankingSystem)
            {
                \App\Models\Settings\RankingSystem::create($rankingSystem);

            }
    }
}
