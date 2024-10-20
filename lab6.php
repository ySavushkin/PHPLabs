<?php

interface AccountInterface {
    public function deposit(float $amount): void;
    public function withdraw(float $amount): void;
    public function getBalance(): float;
}

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0; 

    protected $balance;
    protected $currency;

    public function __construct(float $balance = 0, string $currency = "UAH") {
        $this->balance = $balance;
        $this->currency = $currency;
    }

    public function deposit(float $amount): void {
        if ($amount <= 0) {
            throw new Exception("сума поповнення повинна бути більше нуля.");
        }
        $this->balance += $amount;
    }

    public function withdraw(float $amount): void {
        if ($amount <= 0) {
            throw new Exception("сума для зняття повинна бути більше нуля.");
        }
        if ($this->balance - $amount < self::MIN_BALANCE) {
            throw new Exception("недостатньо коштів для зняття.");
        }
        $this->balance -= $amount;
    }

    public function getBalance(): float {
        return $this->balance;
    }
}

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.05; 
    public function applyInterest(): void {
        $this->balance += $this->balance * self::$interestRate;
    }
}

try {
    $account = new BankAccount(100, "UAH");
    echo "баланс рахунку: " . $account->getBalance() . " UAH\n <br>";

    $account->deposit(50);
    echo "після поповнення: " . $account->getBalance() . " UAH\n <br>";

    $account->withdraw(30);
    echo "після зняття: " . $account->getBalance() . " UAH\n <br>";

    $account->withdraw(200); 
} catch (Exception $e) {
    echo "помилка: " . $e->getMessage() . "\n <br>";
}

echo "\n";

try {
    $savingsAccount = new SavingsAccount(200, "UAH");
    echo "баланс накопичувального рахунку: " . $savingsAccount->getBalance() . " UAH\n";
    echo "<br>";
    $savingsAccount->applyInterest();
    echo "після застосування відсоткової ставки: " . $savingsAccount->getBalance() . " UAH\n";
    echo "<br>";    
    $savingsAccount->withdraw(50);
    echo "аісля зняття з накопичувального рахунку: " . $savingsAccount->getBalance() . " UAH\n";
    echo "<br>";
} catch (Exception $e) {
    echo "помилка: " . $e->getMessage() . "\n";
}
