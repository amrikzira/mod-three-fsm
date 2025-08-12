<?php
namespace App\Services;

class Modulo3FsmService
{
    protected string $state = 'S0';

    protected array $delta = [
        'S0' => ['0' => 'S0', '1' => 'S1'],
        'S1' => ['0' => 'S2', '1' => 'S0'],
        'S2' => ['0' => 'S1', '1' => 'S2'],
    ];

    public function step(string $bit): string
    {
        if (!isset($this->delta[$this->state][$bit])) {
            throw new \InvalidArgumentException("Invalid bit: $bit");
        }
        $this->state = $this->delta[$this->state][$bit];
        return $this->state;
    }

    public function feed(iterable $bits): array
    {
        foreach ($bits as $b) {
            $this->step((string) $b);
        }
        return [
            'final_state' => $this->state,
            'remainder' => $this->stateToRemainder($this->state),
            'divisible' => $this->state === 'S0',
        ];
    }

    protected function stateToRemainder(string $state): int
    {
        switch ($state) {
            case 'S0':
                return 0;
            case 'S1':
                return 1;
            case 'S2':
                return 2;
            default:
                throw new \InvalidArgumentException("Invalid state: $state");
        }
    }
}
