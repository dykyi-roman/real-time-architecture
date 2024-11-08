<?php

declare(strict_types=1);

namespace App\Domain\VO;

final class OperationTime
{
    private $function;

    public function __construct(
        callable $function,
        private readonly int $count
    ) {
        $this->function = $function;
    }

    /**
     * @return float
     */
    public function getExecutionTime(): array
    {
        $loadBefore = sys_getloadavg()[0];
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

           if (!is_callable($this->function)) {
            throw new \InvalidArgumentException("The provided function is not callable.");
        }

        call_user_func($this->function, $this->count);

        $executionTime = microtime(true) - $startTime;
        $cpuUsage = round(sys_getloadavg()[0] - $loadBefore, 2);
        if ($cpuUsage < 0) {
            $cpuUsage = 0;
        }
        $memoryUsed = memory_get_usage() - $startMemory;

        return [
            'time' => round($executionTime, 2) . ' sec',
            'cpu' => $cpuUsage . ' %',
            'memory_used' => $memoryUsed . ' byte',
        ];
    }
}
