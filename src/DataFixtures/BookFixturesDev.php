<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Publisher;
use App\Entity\Tag;
use App\Utils\FileUtils;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BookFixturesDev extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    final public const DATA = [
        [
            'name' => 'Грокаем алгоритмы. Иллюстрированное пособие для программистов и любопытствующих',
            'datePublished' => '2016-05-01',
            'pageCount' => 288,
            'publisher' => 'piter',
            'description' => <<<EOF
                Принято считать, что программирование – это очень сложно. Особенно если раз за разом наступать на одни и те же грабли, пытаться сделать по-своему то, что уже и так было придумано до нас. Ведь практически для любой задачи есть готовый алгоритм решения, осталось только найти его и правильно использовать.

                В книге «Грокаем алгоритмы» Адитья Бхаргава не просто показывает примеры таких решений с детальными иллюстрациями, но и учит читателя самостоятельно находить их в дальнейшем. Читатель знакомится с понятиями бинарного поиска, массивами, связанными списками, структурами данных, рекурсией.

                Книга рассчитана на тех, кто уже знаком с основными азами программирования и интересуется алгоритмическими решениями. Автор старается доносить информацию понятным даже новичку языком, иллюстрирует все основные моменты.
                EOF,
            'image' => 'grokking-algorithms.jpg',
            'tags' => ['science', 'programming'],
            'authors' => ['aditya-bhargava'],
        ],
        [
            'name' => 'Глубокое обучение',
            'datePublished' => '2015-11-03',
            'pageCount' => 652,
            'publisher' => 'dmk',
            'description' => <<<EOF
                Глубокое обучение – это вид машинного обучения, наделяющий компьютеры способностью учиться на опыте и понимать мир в терминах иерархии концепций. Поскольку компьютер приобретает знания из опыта, отпадает нужда в человеке-операторе, который формально описывает необходимые компьютеру знания. Иерархическая организация позволяет компьютеру обучаться сложным концепциям, конструируя их из более простых; граф такой иерархии может содержать много уровней. В этой книге читатель найдет широкий обзор тем, изучаемых в глубоком обучении.

                Книга содержит математические и концептуальные основы линейной алгебры, теории вероятностей и теории информации, численных расчетов и машинного обучения в том объеме, который необходим для понимания материала. Описываются приемы глубокого обучения, применяемые на практике, в том числе глубокие сети прямого распространения, регуляризация, алгоритмы оптимизации, сверточные сети, моделирование последовательностей, и др. Рассматриваются такие приложения, как обработка естественных языков, распознавание речи, компьютерное зрение, онлайновые рекомендательные системы, биоинформатика и видеоигры. Наконец, описываются перспективные направления исследований: линейные факторные модели, автокодировщики, обучение представлений, структурные вероятностные модели, методы Монте-Карло, статистическая сумма, приближенный вывод и глубокие порождающие модели.

                Издание будет полезно студентами и аспирантам, а также опытным программистам, которые хотели бы применить глубокое обучение в составе своих продуктов или платформ.
                EOF,
            'image' => 'deep-learning.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['yoshua-bengio', 'ian-goodfellow'],
        ],
        [
            'name' => 'Silent Hill. Навстречу ужасу. Игры и теория страха',
            'datePublished' => '2020-10-17',
            'pageCount' => 288,
            'publisher' => 'bombora',
            'description' => <<<EOF
                Silent Hill – горячо любимая многими серия игр в жанре сурвайвал-хоррор, плотно закрепившаяся в массовой культуре. О ней наслышаны даже далекие от мира видеоигр люди. Но в чем причина этой популярности? Бернар Перрон слой за слоем деконструирует техники и приемы знаменитой серии, которая околдовывает игроков, заставляя их сердца биться чаще. Вы узнаете, как визуальная составляющая, звуки, музыка, игровые механики, построение игрового повествования и многие другие компоненты создают незабываемый игровой опыт, а также почему, несмотря на испытываемые ужас и страх, игроки получают огромное удовольствие от прохождения Silent Hill. Ужас притягателен. Страх захватывает, опутывает, околдовывает. Для наиболее полного погружения в мир ужаса видеоигры подходят лучше всего. Игрок не только пассивно переживает пугающие события, но и активно взаимодействуют с ними, уклоняясь, противостоя или просто направляясь навстречу неизбежному.
                EOF,
            'image' => 'silent-hill-the-terror-engine.webp',
            'tags' => ['horror', 'video-games', 'textbook'],
            'authors' => ['bernard-perron'],
        ],
        [
            'name' => 'Цифровое моделирование',
            'datePublished' => '2022-01-01',
            'pageCount' => 430,
            'publisher' => 'dmk',
            'description' => <<<EOF
                Профессиональное моделирование имеет важнейшее значение для успеха любого проекта, где используется компьютерная 3D-графика. Из этой книги вы узнаете, что нужно для создания эффективных, готовых к производству моделей, и подготовитесь к созданию впечатляющей реалистичной графики. Используя программно-независимый подход, автор описывает основные приемы, которые можно применять для построения моделей в любом 3D-редакторе.

                Издание предназначено для разработчиков моделей, аниматоров, художников по текстурам, а также маркетологов, менеджеров и других специалистов, занятых в проектах, связанных с компьютерной графикой.
                EOF,
            'image' => 'digital-modeling.jpg',
            'tags' => ['science', 'programming', 'video-games', 'textbook'],
            'authors' => ['william-vaughan'],
        ],
        [
            'name' => 'HTML и CSS. Разработка и дизайн веб-сайтов',
            'datePublished' => '2011-09-27',
            'pageCount' => 478,
            'publisher' => 'dmk',
            'description' => <<<EOF
                Эта книга самый простой и интересный способ изучить HTML и CSS. Независимо от стоящей перед вами задачи: спроектировать и разработать веб-сайт с нуля или получить больше контроля над уже существующим сайтом, эта книга поможет вам создать привлекательный, дружелюбный к пользователю веб-контент. Простой визуальный способ подачи информации с понятными примерами и небольшим фрагментом кода знакомит с новой темой на каждой странице. Вы найдете практические советы о том, как организовать и спроектировать страницы вашего сайта и после прочтения книги сможете разработать свой веб-сайт профессионального вида и удобный в использовании.
                EOF,
            'image' => 'html-and-css.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['jon-duckett'],
        ],
        [
            'name' => 'Javascript и jQuery. Интерактивная веб-разработка',
            'datePublished' => '2016-08-27',
            'pageCount' => 643,
            'publisher' => 'bombora',
            'description' => <<<EOF
                Эта книга – самый простой и интересный способ изучить JavaScript и jQuery. Независимо от стоящей перед вами задачи: спроектировать и разработать веб-сайт с нуля или получить больше контроля над уже существующим сайтом, эта книга поможет вам создать привлекательный, дружелюбный к пользователю веб-контент.

                Простой визуальный способ подачи информации с понятными примерами и небольшим фрагментом кода знакомит с новой темой на каждой странице.

                Вы найдете практические советы о том, как организовать и спроектировать страницы вашего сайта и после прочтения книги сможете разработать свой веб-сайт профессионального вида и удобный в использовании.
                EOF,
            'image' => 'javascript-and-jquery.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['jon-duckett'],
        ],
        [
            'name' => 'Теория и практика программирования на языке Pascal',
            'datePublished' => '2022-05-16',
            'pageCount' => 533,
            'publisher' => 'visheishaya-shkola',
            'description' => <<<EOF
                Представлено последовательное изложение основ программирования на примере языка Pascal. Рассматриваются структурная, модульная и объектно-ориентированная технологии программирования, методы проектирования и отладки программ, управляющие операторы, основные структуры данных и методы их обработки. Полностью соответствует типовой программе "Методы программирования и информатики" для научно-педагогического направления.

                Для студентов, изучающих алгоритмический язык Pascal.
                EOF,
            'image' => 'theory-and-practice-Pascal.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['yurii-kremen-alexeevich', 'galina-rasolko-alekseevna'],
        ],
        [
            'name' => 'Объектно-ориентированное программирование в С++',
            'datePublished' => '2019-01-01',
            'pageCount' => 928,
            'publisher' => 'piter',
            'description' => <<<EOF
                Благодаря этой книге тысячи пользователей овладели технологией объектно-ориентированного программирования в С++. В ней есть все: основные принципы языка, готовые полномасштабные приложения, небольшие примеры, поясняющие теорию, и множество полезных иллюстраций.

                Книга пользуется стабильным успехом в учебных заведениях благодаря тому, что содержит более 100 упражнений, позволяющих проверить знания по всем темам.

                Читатель может вообще не иметь подготовки в области языка С++. Необходимо лишь знание начальных основ программирования.
                EOF,
            'image' => 'oop-in-c++.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['robert-lafore'],
        ],
        [
            'name' => 'Совершенный код. Мастер-класс',
            'datePublished' => '2019-06-05',
            'pageCount' => 868,
            'publisher' => 'russian-editorial-board',
            'description' => <<<EOF
                Более 10 лет первое издание этой книги считалось одним из лучших практических руководств по программированию. Сейчас эта книга полностью обновлена с учетом современных тенденций и технологий и дополнена сотнями новых примеров, иллюстрирующих искусство и науку программирования. Опираясь на академические исследования, с одной стороны, и практический опыт коммерческих разработок ПО – с другой, автор синтезировал из самых эффективных методик и наиболее эффективных принципов ясное прагматичное руководство. Каков бы ни был ваш профессиональный уровень, с какими бы средствами разработками вы ни работали, какова бы ни была сложность вашего проекта, в этой книге вы найдете нужную информацию, она заставит вас размышлять и поможет создать совершенный код.

                Книга состоит из 35 глав, предметного указателя и библиографии.
                EOF,
            'image' => 'code-complete.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['steve-mcconnell'],
        ],
        [
            'name' => 'Чистый код. Создание, анализ и рефакторинг',
            'datePublished' => '2021-11-24',
            'pageCount' => 464,
            'publisher' => 'piter',
            'description' => <<<EOF
                Плохой код может работать, но он будет мешать развитию проекта и компании-разработчика, требуя дополнительные ресурсы на поддержку и "укрощение".

                Каким же должен быть код? Эта книга полна реальных примеров, позволяющих взглянуть на код с различных направлений: сверху вниз, снизу вверх и даже изнутри. Вы узнаете много нового о коде. Более того, научитесь отличать хороший код от плохого, узнаете, как писать хороший код и как преобразовать плохой код в хороший.

                Книга состоит из трёх частей. Сначала вы познакомитесь с принципами, паттернами и приёмами написания чистого кода. Затем приступите к практическим сценариям с нарастающей сложностью – упражнениям по чистке кода или преобразованию проблемного кода в менее проблемный. И только после этого перейдёте к самому важному – концентрированному выражению сути этой книги – набору эвристических правил и "запахов кода". Именно эта база знаний описывает путь мышления в процессе чтения, написания и чистки кода.
                EOF,
            'image' => 'clean-code.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['robert-martin-cecil'],
        ],
        [
            'name' => 'Git для профессионального программиста',
            'datePublished' => '2019-03-12',
            'pageCount' => 496,
            'publisher' => 'piter',
            'description' => <<<EOF
                Эта книга представляет собой обновленное руководство по использованию Git в современных условиях. С тех пор как проект Git – распределенная система управления версиями – был создан Линусом Торвальдсом, прошло много лет, и система Git превратилась в доминирующую систему контроля версий, как для коммерческих целей, так и для проектов с открытым исходным кодом. Эффективный и хорошо реализованный контроль версий необходим для любого успешного веб-проекта. Постепенно эту систему приняли на вооружение практически все сообщества разработчиков ПО с открытым исходным кодом. Появление огромного числа графических интерфейсов для всех платформ и поддержка IDE позволили внедрить Git в операционные системы семейства Windows. Второе издание книги было обновлено для Git-версии 2.0 и уделяет большое внимание GitHub.
                EOF,
            'image' => 'pro-git.jpg',
            'tags' => ['science', 'programming', 'textbook'],
            'authors' => ['scott-chacon'],
        ],
        [
            'name' => 'Геймдизайн. Как создать игру, в которую будут играть все',
            'datePublished' => '2022-07-05',
            'pageCount' => 640,
            'publisher' => 'alpina',
            'description' => <<<EOF
                Самое полное руководство по геймдизайну – теперь в официальной версии на русском языке! Видеоигры повсюду. На планшетах, приставках, компьютерах. На любой вкус, пол и возраст. Игровая индустрия по доходам уже опережает киноиндустрию. Но как выделиться из общей массы и создать игру, которая завоюет сердца миллионов? Хорошая игра, как хорошее кино, построена по определенным законам. Геймдизайнеру необходимо продумать все с точки зрения психологии, дизайна, архитектуры, музыки, логики и математики. И учесть миллионы тонкостей: баланс наград и уровня сложности, тактических и стратегических решений, эстетические предпочтения целевой аудитории, соответствие визуального ряда и звукового сопровождения.
                EOF,
            'image' => 'the-art-of-game-design.jpg',
            'tags' => ['video-games', 'programming', 'textbook'],
            'authors' => ['jesse-shell'],
        ],
        [
            'name' => 'World of Warcraft. Иллидан',
            'datePublished' => '2020-02-17',
            'pageCount' => 352,
            'publisher' => 'ast',
            'description' => <<<EOF
                Вы не готовы!

                Иллидан Ярость Бури. Великий чародей. Великий воин. Великий предатель.

                Десять тысяч лет, проведенных в тюрьме, когда лишь ненависть и жажда мести позволяют сохранить рассудок... И позволяют ли?

                Долгожданная свобода. Новый мир, новая армия, новые планы. Еще более амбициозные и непонятные для всех прочих. Что это - жажда реванша или стремление к безграничной власти? И какова будет цена победы? Ведь все больше врагов Запределья, а от союзников в любой момент можно ждать удара в спину. Слишком многие хотят видеть Иллидана в цепях... Или в могиле!
                EOF,
            'image' => 'world-of-warcraft-illidan.jpg',
            'tags' => ['video-games', 'fantasy', 'action', 'adventure'],
            'authors' => ['william-king'],
        ],
        [
            'name' => 'Ярость Кхарна',
            'datePublished' => '2001-11-27',
            'pageCount' => 238,
            'publisher' => 'black-library',
            'description' => <<<EOF
                «Лишь глупцы считают Кхарна безмозглым громилой или бешеным псом. Под окровавленным забралом прячутся разум и коварство, делающие Кхарна превосходным убийцей. Поверьте, у его безумия есть мрачная цель»
                – Абаддон Разоритель

                Кхарн Предатель – величайший чемпион Кхорна, яростью и жаждой крови уступающий лишь своему демоническому примарху Ангрону, а жизнь его наполнена убийствами, предательствами, пролитой кровью и бесчисленными черепами, собранными для его покровителя. Кхарн Предатель всегда сражается в гуще битвы, его тяжёлый цепной топор Дитя Крови вздымается и опадает, отсекая головы, срубая черепа. Кхарн живёт лишь ради битвы и возможности убить всех, до кого дотянется топором, будь то враги или друзья. Лишь сам чемпион знает, сражается ли он во славу Кровавого Бога или же чтобы заглушить бесконечными убийствами измученные голоса в голове, ведь немногие когда-либо увидевшие Предателя могут о нём рассказать.
                EOF,
            'image' => 'the-wrath-of-kharn.jpg',
            'tags' => ['video-games', 'action', 'adventure', 'science-fiction', 'dystopian'],
            'authors' => ['william-king'],
        ],
        [
            'name' => 'Зов Ктулху',
            'datePublished' => '2019-01-04',
            'pageCount' => 480,
            'publisher' => 'ast',
            'description' => <<<EOF
                "При жизни этот писатель не опубликовал ни одной книги, после смерти став кумиром как массового читателя, так и искушенного эстета, и неиссякаемым источником вдохновения для кино- и игровой индустрии; его называли "Эдгаром По ХХ века", гениальным безумцем и адептом тайных знаний; его творчество уникально настолько, что потребовало выделения в отдельный поджанр; им восхищались Роберт Говард и Клайв Баркер, Хорхе Луис Борхес и Айрис Мёрдок.

                Один из самых влиятельных мифотворцев современности, человек, оказавший влияние не только на литературу, но и на массовую культуру в целом, создатель "Некрономикона" и "Мифов Ктулху" – Говард Филлипс Лавкрафт."
                EOF,
            'image' => 'call-of-cthulhu.jpg',
            'tags' => ['dystopian', 'mystery', 'adventure', 'thriller', 'horror'],
            'authors' => ['howard-phillips-lovecraft'],
        ],
        [
            'name' => 'Ромео и Джульетта',
            'datePublished' => '2023-08-12',
            'pageCount' => 192,
            'publisher' => 'azbooka',
            'description' => <<<EOF
                Вниманию читателей предлагается первая значительная трагедия Уильяма Шекспира – "печальнейшая на свете повесть" о двух юных влюбленных, ценой своей смерти примиряющих издавна враждовавшие веронские семейства Монтекки и Капулетти. Остродраматические коллизии пьесы, возвышенная свобода и глубина чувств главных героев во многом определили эмоциональный мир и ценности новоевропейской любовной культуры и открыли перед современным искусством возможность виртуозной игры на тему "влюбленного Шекспира".
                EOF,
            'image' => 'romeo-and-juliet.jpg',
            'tags' => ['romance'],
            'authors' => ['william-shakespeare'],
        ],
        [
            'name' => 'Физика. 10 класс',
            'datePublished' => '2018-02-16',
            'pageCount' => 205,
            'publisher' => 'aiv',
            'description' => <<<EOF
                Учебное пособие для 10 класса учреждений общего среднего образования с русским языком обучения (с электронным приложением для повышенного уровня). Пособие выпущено издательством «Адукацыя і выхаванне».

                Допущено Министерством образования Республики Беларусь.
                EOF,
            'image' => 'physics-10th-grade.jpg',
            'tags' => ['textbook', 'science', 'physics'],
            'authors' => ['lucewitch-alexander'],
        ],
        [
            'name' => 'Алгебра. 11 класс',
            'datePublished' => '2020-03-11',
            'pageCount' => 220,
            'publisher' => 'narodnaya-asveta',
            'description' => <<<EOF
                Учебное пособие для 11 класса учреждений общего среднего образования с русским языком обучения.

                Рeцeнзенты:

                - кафедра высшей алгебры и защиты информации механико-математического факультета Белорусского государственного университета (доктор физико-математических наук, профессор, заведующий кафедрой В. В. Беняш-Кривец);
                - учитель математики квалификационной категории «учитель-методист» лицея Белорусского национального технического университета О. Е. Цыбулько
                EOF,
            'image' => 'algebra-11th-grade.jpg',
            'tags' => ['textbook', 'science', 'math'],
            'authors' => ['pirutko-olga-nikolaevna'],
        ],
        [
            'name' => 'PHP 7',
            'datePublished' => '2016-11-24',
            'pageCount' => 1071,
            'publisher' => 'bhv-peterburg',
            'description' => <<<EOF
                Рассмотрены основы языка PHP и его рабочего окружения в Windows, Mac OS X и Linux.

                Отражены радикальные изменения в языке PHP, произошедшие с момента выхода предыдущего издания: трейты, пространство имен, анонимные функции, замыкания, элементы строгой типизации, генераторы, встроенный Web-сервер и многие другие возможности. Приведено описание синтаксиса PHP 7, а также функций для работы с массивами, файлами, СУБД MySQL, memcached, регулярными выражениями, графическими примитивами, почтой, сессиями и т. д. Особое внимание уделено рабочему окружению: сборке PHP-FPM и Web-сервера nginx, СУБД MySQL, протоколу SSH, виртуальным машинам VirtualBox и менеджеру виртуальных машин Vagrant. Рассмотрены современные подходы к Web-разработке, система контроля версий Git, GitHub и другие бесплатные Git-хостинги, новая система распространения программных библиотек и их разработки, сборка Web-приложений менеджером Composer, стандарты PSR и другие инструменты и приемы работы современного PHP-сообщества.

                В третьем издании добавлены 24 новые главы, остальные главы обновлены или переработаны.

                Для Web-программистов.
                EOF,
            'image' => 'php-7.jpg',
            'tags' => ['textbook', 'science', 'programming'],
            'authors' => ['igor-simdyanov'],
        ],
    ];

    public function __construct(
        private readonly string $dirPublic,
        private readonly string $dirBookCoverUploads,
        private readonly string $dirFixtures,
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        if (!file_exists(sprintf('%s%s', $this->dirPublic, $this->dirBookCoverUploads))) {
            mkdir(sprintf('%s%s', $this->dirPublic, $this->dirBookCoverUploads), 0777, true);
        }

        foreach (self::DATA as $book) {
            try {
                $entity = new Book();

                $entity->setName($book['name']);

                $entity->setDatePublished(\DateTime::createFromFormat('Y-m-d', $book['datePublished']));
                $entity->setPageCount($book['pageCount']);

                $entity->setPublisher(
                    $this->getReference(sprintf('publisher: %s', $book['publisher']), Publisher::class)
                );

                if (array_key_exists('description', $book)) {
                    $entity->setDescription($book['description']);
                }

                $entity->setIsDeleted(false);

                foreach ($book['tags'] as $tag) {
                    $entity->addTag($this->getReference(sprintf('tag: %s', $tag), Tag::class));
                }

                foreach ($book['authors'] as $author) {
                    $entity->addAuthor($this->getReference(sprintf('author: %s', $author), Author::class));
                }

                if (array_key_exists('image', $book)) {
                    $filename = FileUtils::joinPaths(
                        [
                            $this->dirBookCoverUploads,
                            FileUtils::generateFilename('book', pathinfo($book['image'], \PATHINFO_EXTENSION)),
                        ]
                    );

                    copy(
                        FileUtils::joinPaths([$this->dirFixtures, $this->dirBookCoverUploads, $book['image']]),
                        FileUtils::joinPaths([$this->dirPublic, $filename])
                    );

                    $entity->setImagePath($filename);
                }

                $manager->persist($entity);

                if (array_key_exists('key', $book)) {
                    $this->setReference(sprintf('book: %s', $book['key']), $entity);
                }
            } catch (\Throwable $throwable) {
                throw new \Exception(sprintf('Failed for the book %s', $book['name'] ?? 'EMPTY'), $throwable->getCode(), previous: $throwable);
            }
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['dev'];
    }

    public function getDependencies()
    {
        return [
            AuthorFixturesDev::class,
            PublisherFixturesDev::class,
            TagFixturesDev::class,
        ];
    }
}
