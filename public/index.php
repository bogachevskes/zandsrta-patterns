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

use App\Strategy\Seminar;
use App\Strategy\Lecture;
use App\Strategy\TimedCostStrategy;
use App\Strategy\FixedCostStrategy;

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

use App\DependencyInjection\PreferencesRepository;
use App\DependencyInjection\Models\Preferences as PreferencesInjection;

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

use App\Composite\Chair;
use App\Composite\ChairBox;

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

use App\Decorator\Helpers\RequestHelper;
use App\Decorator\Middleware\LogRequest;
use App\Decorator\Middleware\AuthenticateRequest;
use App\Decorator\Middleware\StructureRequest;
use App\Decorator\MainProcess;

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

