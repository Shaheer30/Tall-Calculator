<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Calculation;

class Calculator extends Component
{
    public $display = '0';
    public $previousCalculation = '';
    public $history = [];

    public function mount()
    {
        $this->loadHistory();
    }

    public function loadHistory()
    {
        $this->history = Calculation::latest()->take(10)->get()->toArray();
    }

    public function calculate($expression)
    {
        try {
            // Basic security check - only allow safe characters
            if (!preg_match('/^[0-9+\-*\/().\s]+$/', $expression)) {
                throw new \Exception('Invalid expression');
            }

            $result = eval("return $expression;");
            
            // Save to database
            Calculation::create([
                'expression' => $expression,
                'result' => $result,
            ]);

            $this->previousCalculation = "$expression = $result";
            $this->display = (string) $result;
            $this->loadHistory();
            
        } catch (\Exception $e) {
            $this->display = 'Error';
        }
    }

    public function clear()
    {
        $this->display = '0';
        $this->previousCalculation = '';
    }

    public function render()
    {
        return view('livewire.calculator')->layout('app');
    }
}