<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class InstallmentCommandException extends \Exception
{

}

class InstallmentStrategyException extends \Exception
{

}

class CommandContext
{
    protected array $params = [];

    protected array $errors = [];

    public function setParam(string $key, $value): void
    {
        $this->params[$key] = $value;
    }

    public function getParam(string $key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        }

        return null;
    }

    public function setError(string $key, $value): void
    {
        $this->errors[$key] = $value;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

}

abstract class BaseCommand
{
    protected $context;
    
    protected $success = [];

    protected $errors = [];

    abstract public function execute(CommandContext $context): void;

    public function setContext(CommandContext $context): void
    {
        $this->context = $context;
    }
    
    public function setSuccess(string $key, $value): void
    {
        $this->success[$key] = $value;
    }

    public function setError($value): void
    {
        $this->errors[] = $value;
    }

    public function getSuccessData(): array
    {
        return $this->success;
    }

    public function getErorrData(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return (bool) count($this->errors);
    }

}

abstract class BaseInstallmentStrategy
{
    protected $perMonth = 0;

    protected $monthsPayments = [];
    
    abstract public function calculate(CommandContext $context): void;

    public function getPaymentPerMonth(): int
    {
        return $this->perMonth;
    }

    public function getPaymentsByMonths(): array
    {
        return $this->monthsPayments; 
    }

    public function getPaymentOnMonth(int $monthIndex): int
    {
        if (isset($this->monthsPayments[$monthIndex])) {
            return $this->monthsPayments[$monthIndex];
        }

        throw new InstallmentStrategyException('Ошбика при выполнении расчета - месяц указан некорректно');
    }
}

class PostBankInstallmentStrategy extends BaseInstallmentStrategy
{
    public function calculate($context): void
    {
        // завалидировать контекст, что все ключи для расчета есть.
        // Валидация бросает InstallmentStrategyException
        
        $this->perMonth = 337;

        $this->monthsPayments = [
            1 => 11378,
            2 => 11657,
            3 => 12000,
        ];
    }
}

class InstallmentCalcCommand extends BaseCommand
{
    const POST_BANK_STRATEGY = 'POST_BANK';
    
    protected $strategy;

    protected function setStrategy(BaseInstallmentStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    protected function defineStrategy(): void
    {
        $type = $this->context->getParam('type');
        
        switch ($type) {
            case static::POST_BANK_STRATEGY:
                $this->setStrategy(new PostBankInstallmentStrategy);
                return;
        }

        throw new InstallmentCommandException('Стратегия не определена');
    }
    
    public function execute(CommandContext $context): void
    {
        $this->setContext($context);
        
        $this->defineStrategy();

        try {
            $this->strategy->calculate($context);
        } catch (InstallmentStrategyException $error) {
            $this->setError($error->getMessage());
            return;
        }

        $this->setSuccess('per_month', $this->strategy->getPaymentPerMonth());
        $this->setSuccess('on_month', $this->strategy->getPaymentOnMonth(1));
    }
}

class Controller
{
    protected $context;

    protected $cmd;

    protected function setContext(CommandContext $context): void
    {
        $this->context = $context;
    }

    protected function setCmd(BaseCommand $cmd): void
    {
        $this->cmd = $cmd;
    }

    protected function setErrorResponse(array $messages): array
    {
        return [
            'success' => false,
            'error' => $messages,
        ];
    }
    
    public function actionCalcInstallments(object $request)
    {
        $this->setContext(new CommandContext);
        $this->setCmd(new InstallmentCalcCommand);

        $this->context->setParam('type', $request->type);
        $this->context->setParam('options', $request->options);

        try {

            $this->cmd->execute($this->context);

        } catch (InstallmentStrategyException $error) {

            // записать в лог сообщение об ошибке

            return $this->setErrorResponse([$error->getMessage()]);

        } catch (InstallmentCommandException $error) {
            
            // записать в лог сообщение об ошибке

            return $this->setErrorResponse([$error->getMessage()]);
        }

        if ($this->cmd->hasErrors()) {
            return $this->setErrorResponse([$error->getErorrData()]);
        }

        return [
            'success' => true,
            'data' => $this->cmd->getSuccessData(),
        ];
    }

}

$incomingData = (object) [
    'type' => 'POST_BANK',
    'options' => [
        'total'         => 12000,
        'period'        => 3,
        'inititalFee'   => 0,
    ]
];

// имитация работы контроллера
$controller = new Controller();

$result = $controller->actionCalcInstallments($incomingData);

echo '<pre>';
print_r($result);
echo '</pre>';