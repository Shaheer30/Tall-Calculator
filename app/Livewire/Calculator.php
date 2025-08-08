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
            // basic sanitize & normalize input
            $expression = trim((string) $expression);

            // normalize common UI symbols (in case they come from buttons using × ÷ etc)
            $expression = str_replace(['×', '÷', '−', '–'], ['*', '/', '-', '-'], $expression);

            // convert unicode pi or word pi (word-boundary) into php pi() call
            $expression = preg_replace('/\bπ\b/u', 'pi()', $expression);
            $expression = preg_replace('/\bpi\b/i', 'pi()', $expression);

            // convert log( -> log10( (most calculators expect base-10 log)
            // safe as it keeps parentheses balanced
            $expression = preg_replace('/\blog\s*\(/i', 'log10(', $expression);

            // Helper: recursively wrap trig functions' arguments with deg2rad(...)
            // so sin(X) -> sin(deg2rad(X)) while preserving balanced parentheses.
            $wrapTrig = function ($expr) use (&$wrapTrig) {
                // pattern matches sin(...) or cos(...) or tan(...), capturing the inner balanced parentheses
                $pattern = '/\b(sin|cos|tan)\s*\(((?:[^()]|(?R))*)\)/iu';

                if (!preg_match($pattern, $expr)) {
                    return $expr;
                }

                return preg_replace_callback($pattern, function ($m) use (&$wrapTrig) {
                    $fn = strtolower($m[1]);
                    $inner = $m[2];

                    // recursively process inner expression in case it contains nested trig calls
                    $innerProcessed = $wrapTrig($inner);

                    // return balanced function call: e.g. sin(deg2rad(<inner>))
                    return $fn . '(deg2rad(' . $innerProcessed . '))';
                }, $expr);
            };

            // apply trig wrapping until no trig patterns remain
            $expression = $wrapTrig($expression);

            // At this point other functions like sqrt(), pow(), abs(), log10(), pi() are left intact.
            // SECURITY CHECKS:
            // Only allow digits, operators, parentheses, dots, commas, whitespace and allowed function names.
            // We'll remove allowed function names and ensure no unknown alphabetic characters remain.
            $allowedFunctions = [
                'sin', 'cos', 'tan', 'sqrt', 'log10', 'pow', 'abs', 'deg2rad', 'pi'
            ];

            $checkExpression = mb_strtolower($expression, 'UTF-8');

            // remove allowed function names from the string before checking for rogue letters
            foreach ($allowedFunctions as $fn) {
                // remove both fn( and fn ) occurrences to avoid leaving parentheses behind
                $checkExpression = str_ireplace($fn, '', $checkExpression);
            }

            // after removing allowed names, if any alphabetic letters remain, reject
            if (preg_match('/[a-zA-Z]/', $checkExpression)) {
                throw new \Exception('Invalid expression (unknown tokens)');
            }

            // final allowed character whitelist (numbers, basic operators, parentheses, dot, comma, spaces)
            if (!preg_match('/^[0-9+\-*\/%^().,\s]+$/', $checkExpression)) {
                throw new \Exception('Invalid characters in expression');
            }

            // Evaluate safely — wrap with parentheses to ensure full expression returned
            // Note: eval is still used, but input has been sanitized above.
            $result = eval("return ({$expression});");

            // convert result to scalar string (avoid storing arrays/objects)
            if (is_array($result) || is_object($result)) {
                throw new \Exception('Invalid result');
            }

            // Save to database (keeps your history behavior intact)
            Calculation::create([
                'expression' => $expression,
                'result'     => $result,
            ]);

            $this->previousCalculation = "{$expression} = {$result}";
            $this->display = (string) $result;
            $this->loadHistory();

        } catch (\Throwable $e) {
            // You can log $e->getMessage() during debugging:
            // \Log::error('Calc error: ' . $e->getMessage());
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
