<?php

namespace App\Domain\VO;

use Immutable\ValueObject\ValueObject;

final class OperationTime extends ValueObject
{
    /**
     * Variable
     *
     * @var float |
     */
    protected $start;
    /**
     * Variable
     *
     * @var float |
     */
    protected $finish;

    /**
     * OperationTime constructor.
     *
     * @param float $start
     * @param float $finish
     */
    public function __construct(float $start, float $finish)
    {
        $this->withChanged($start, $finish);
        parent::__construct();
    }

    /**
     * @param float $start
     * @param float $finish
     *
     * @return ValueObject
     * @throws \Immutable\Exception\ImmutableObjectException
     */
    public function withChanged(float $start, float $finish): ValueObject
    {
        return $this->with([
            'start' => $start,
            'finish' => $finish,
        ]);
    }

    /**
     * @return string
     */
    public function getExecutionTime(): string
    {
        return round($this->finish - $this->start, 5);
    }
}
