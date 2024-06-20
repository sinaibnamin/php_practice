<?php
define('INCOME_FILE', 'incomes.json');
define('EXPENSE_FILE', 'expenses.json');

function readData($file) {
    if (!file_exists($file)) {
        return [];
    }
    $jsonData = file_get_contents($file);
    return json_decode($jsonData, true) ?? [];
}

function writeData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

function addIncome() {
    echo "Enter income amount: ";
    $amount = (float)trim(fgets(STDIN));
    echo "Enter income category: ";
    $category = trim(fgets(STDIN));
    
    $incomes = readData(INCOME_FILE);
    $incomes[] = ['amount' => $amount, 'category' => $category, 'type' => 'income'];
    writeData(INCOME_FILE, $incomes);
    
    echo "Income added successfully.\n";
}

function addExpense() {
    echo "Enter expense amount: ";
    $amount = (float)trim(fgets(STDIN));
    echo "Enter expense category: ";
    $category = trim(fgets(STDIN));
    
    $expenses = readData(EXPENSE_FILE);
    $expenses[] = ['amount' => $amount, 'category' => $category, 'type' => 'expense'];
    writeData(EXPENSE_FILE, $expenses);
    
    echo "Expense added successfully.\n";
}

function viewIncomes() {
    $incomes = readData(INCOME_FILE);
    if (empty($incomes)) {
        echo "No incomes recorded.\n";
    } else {
        echo "Incomes:\n";
        foreach ($incomes as $income) {
            echo "- Amount: {$income['amount']}, Category: {$income['category']}\n";
        }
    }
}

function viewExpenses() {
    $expenses = readData(EXPENSE_FILE);
    if (empty($expenses)) {
        echo "No expenses recorded.\n";
    } else {
        echo "Expenses:\n";
        foreach ($expenses as $expense) {
            echo "- Amount: {$expense['amount']}, Category: {$expense['category']}\n";
        }
    }
}

function viewSavings() {
    $incomes = readData(INCOME_FILE);
    $expenses = readData(EXPENSE_FILE);
    
    $totalIncome = array_sum(array_map('floatval', array_column($incomes, 'amount')));
    $totalExpense = array_sum(array_map('floatval', array_column($expenses, 'amount')));
    $savings = $totalIncome - $totalExpense;
    
    echo "Total Savings: $savings\n";
}

function viewCategories() {
    $incomes = readData(INCOME_FILE);
    $expenses = readData(EXPENSE_FILE);
    
    $incomeCategories = array_unique(array_column($incomes, 'category'));
    $expenseCategories = array_unique(array_column($expenses, 'category'));
    
    echo "Income Categories:\n";
    foreach ($incomeCategories as $category) {
        echo "- $category\n";
    }
    
    echo "Expense Categories:\n";
    foreach ($expenseCategories as $category) {
        echo "- $category\n";
    }
}

function showMenu() {
    echo "\nChoose an option:\n";
    echo "1. Add income\n";
    echo "2. Add expense\n";
    echo "3. View incomes\n";
    echo "4. View expenses\n";
    echo "5. View savings\n";
    echo "6. View categories\n";
    echo "7. Exit\n";
    echo "Enter your option: ";
    
    $option = trim(fgets(STDIN));
    
    switch ($option) {
        case '1':
            addIncome();
            break;
        case '2':
            addExpense();
            break;
        case '3':
            viewIncomes();
            break;
        case '4':
            viewExpenses();
            break;
        case '5':
            viewSavings();
            break;
        case '6':
            viewCategories();
            break;
        case '7':
            echo "app closed\n";
            exit; 
        default:
            echo "Invalid option. Please try again.\n";
            break;
    }
}

while (true) {
    showMenu();
    echo "\n";
}