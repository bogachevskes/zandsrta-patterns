<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . '/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Strategy
|--------------------------------------------------------------------------
| Стратегия (англ. Strategy) — поведенческий шаблон проектирования,
| предназначенный для определения семейства алгоритмов,
| инкапсуляции каждого из них и обеспечения их взаимозаменяемости.
| Это позволяет выбирать алгоритм путём определения соответствующего класса.
| Шаблон Strategy позволяет менять выбранный алгоритм независимо от объектов-клиентов,
| которые его используют.
*/

use App\Strategy\{
    Seminar,
    Lecture,
    TimedCostStrategy,
    FixedCostStrategy
};

echo '<b>Strategy</b><br>';

$seminar = new Seminar(4, new TimedCostStrategy);
$lecture = new Lecture(5, new FixedCostStrategy);

echo $seminar->printCostInfo() . "<br>";
echo $seminar->printChargeType() . "<br>";

echo $lecture->printCostInfo() . "<br>";
echo $lecture->printChargeType() . "<br>";

/*
|--------------------------------------------------------------------------
| Singleton
|--------------------------------------------------------------------------
| Одиночка (англ. Singleton) — порождающий шаблон проектирования, гарантирующий,
| что в однопоточном приложении будет единственный экземпляр некоторого класса,
| и предоставляющий глобальную точку доступа к этому экземпляру.
*/

echo '<br><b>Singleton</b><br>';

use App\Singleton\Preferences;

$settings = Preferences::getInstance();

$settings->setProperty('max-connections', 7);

$params = Preferences::getInstance();

echo $params->printPropertyValue('max-connections') . "<br>";

/*
|--------------------------------------------------------------------------
| Service locator
|--------------------------------------------------------------------------
| Локатор служб (англ. service locator) — это шаблон проектирования,
| используемый в разработке программного обеспечения для инкапсуляции процессов,
| связанных с получением какого-либо сервиса с сильным уровнем абстракции.
| Этот шаблон использует центральный реестр, известный как «локатор сервисов»,
| который по запросу возвращает информацию (как правило это объекты),
| необходимую для выполнения определенной задачи.
*/

echo '<br><b>Service locator</b><br>';

use App\ServiceLocator\AppLocator;

$app = new AppLocator;

echo $app->preferences->printPropertyValue('max-connections') . "<br>";

/*
|--------------------------------------------------------------------------
| Dependency injection
|--------------------------------------------------------------------------
| Внедрение зависимости (англ. Dependency injection, DI) — процесс предоставления внешней зависимости программному компоненту.
| Является специфичной формой «инверсии управления» (англ. Inversion of control, IoC), когда она применяется к управлению зависимостями.
| В полном соответствии с принципом единственной обязанности объект отдаёт заботу о построении требуемых ему зависимостей внешнему,
| специально предназначенному для этого общему механизму.
*/

use App\DependencyInjection\{
    PreferencesRepository,
    Models\Preferences as PreferencesInjection,
};

echo '<br><b>Dependency injection</b><br>';

$repository = new PreferencesRepository(
        PreferencesInjection::getInstance()
    );

$preferencesRepository = $repository->getRepository();

$preferencesRepository->setProperty('max-connections', 9);

echo $preferencesRepository->printPropertyValue('max-connections') . "<br>";

/*
|--------------------------------------------------------------------------
| Composite
|--------------------------------------------------------------------------
| Компоновщик (англ. Composite pattern) — структурный шаблон проектирования,
| объединяющий объекты в древовидную структуру для представления иерархии от частного к целому.
| Компоновщик позволяет клиентам обращаться к отдельным объектам и к группам объектов одинаково.
*/

use App\Composite\{
    Chair,
    ChairBox,
};

echo '<br><b>Composite</b><br>';

$chairBox = new ChairBox();

echo $chairBox->printWeight() . "<br>";

$chairToRemove = new Chair(78);

$chairBox->addUnits([
        new Chair(15),
        $chairToRemove,
        new Chair(9),
        new Chair(15),
    ]);

echo $chairBox->printWeight() . "<br>";

$chairBox->removeUnit($chairToRemove);

echo $chairBox->printWeight() . "<br>";

/*
|--------------------------------------------------------------------------
| Decorator
|--------------------------------------------------------------------------
| Декоратор (англ. Decorator) — структурный шаблон проектирования,
| предназначенный для динамического подключения дополнительного поведения к объекту.
| Шаблон Декоратор предоставляет гибкую альтернативу практике создания подклассов с целью расширения функциональности.
*/

use App\Decorator\{
    Helpers\RequestHelper,
    Middleware\LogRequest,
    Middleware\AuthenticateRequest,
    Middleware\StructureRequest,
    MainProcess,
};

echo '<br><b>Decorator</b>';

$process = new LogRequest(
        new AuthenticateRequest(
                new StructureRequest(
                        new MainProcess()
                    )
            )
    );

$process->process(
        new RequestHelper()
    );

/*
|--------------------------------------------------------------------------
| Facade
|--------------------------------------------------------------------------
| Шаблон фасад (англ. Facade) — структурный шаблон проектирования,
| позволяющий скрыть сложность системы путём сведения всех возможных внешних вызовов к одному объекту,
| делегирующему их соответствующим объектам системы.
| 
*/

use App\Facade\{
    Car,
    Components\CarDriver,
};

echo '<br><b>Facade</b><br>';

$carDriver = new \App\Facade\Components\CarDriver;
$car = new \App\Facade\Car($carDriver, 70);

$car->checkEngine();

/*
|--------------------------------------------------------------------------
| Observer
|--------------------------------------------------------------------------
| Наблюдатель (англ. Observer) — поведенческий шаблон проектирования.
| Также известен как «подчинённые» (Dependents). Реализует у класса механизм,
| который позволяет объекту этого класса получать оповещения об изменении
| состояния других объектов и тем самым наблюдать за ними.
*/

use App\Observer\{
    Loggin,
    GeneralLogger,
};

echo '<br><b>Observer</b><br>';

$login = new Loggin('username', 'password');
new GeneralLogger($login);

$login->handle();
$login->handle();
$login->handle();

/*
|--------------------------------------------------------------------------
| Visitor
|--------------------------------------------------------------------------
| Посетитель (англ. visitor) — поведенческий шаблон проектирования,
| описывающий операцию, которая выполняется над объектами других классов.
| При изменении visitor нет необходимости изменять обслуживаемые классы.
*/

use App\Visitor\{
    Reports\ReportTypeA,
    Requests,
    Tenders,
};

echo '<br><b>Visitor</b><br>';

$requests = new Requests;
$tenders = new Tenders;

$reportTypeA = new ReportTypeA();

$requests->acceptReport($reportTypeA);
echo '<br>';
$tenders->acceptReport($reportTypeA);

/*
|--------------------------------------------------------------------------
| Command
|--------------------------------------------------------------------------
| Команда (англ. Command) — поведенческий шаблон проектирования,
| используемый при объектно-ориентированном программировании,
| представляющий действие. Объект команды заключает в себе само действие и его параметры.
*/

use App\Command\{
    Controller,
    Commands\AuthCommand,
};

echo '<br><b>Command</b><br>';

$controller = new Controller;

$context = $controller->getContext();

$context->set('action', 'auth');
$context->set('type', AuthCommand::TYPE_LOGIN);
$context->set('login', 'Billy');
$context->set('password', 'very_strong_password');

$controller->process();

echo '<br>';

$context->set('type', AuthCommand::TYPE_LOGOUT);
$context->set('login', 'Billy');

$controller->process();

/*
|--------------------------------------------------------------------------
| Null Object
|--------------------------------------------------------------------------
| В объектно-ориентированном программировании Null Object — это объект с определенным нейтральным («null») поведением.
| Шаблон проектирования Null Object описывает использование таких объектов и их поведение (или отсутствие такового).
*/

use App\NullObject\{
    Base\Entity,
    CombinedEntity
};

echo '<br><b>Null Object</b><br>';

$entity = new CombinedEntity(123789, 'Jordan', new Entity(123167, 'Nadine'));



$nullEntity = new CombinedEntity;

$entities = [
    $entity,
    $nullEntity,
];

foreach ($entities as $object) {
    echo 'Имя сущности: ' . $object->getName() .  '<br>';
    echo 'Имя вложенной сущности: ' . $object->getSubEntityName() . '<br>';
}