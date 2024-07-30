<?php

namespace App\Models;


class Currency implements \JsonSerializable
{


    private string $symbol;
    private float $value;

    public function __construct(string $symbol , float $value)
    {
        $this->symbol = $symbol;
        $this->value = $value;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'symbol' => $this->symbol,
            'value' => $this->value
        ];
    }
}
