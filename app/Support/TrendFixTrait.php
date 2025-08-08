<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait TrendFixTrait
{
    public function aggregate(string $column, string $aggregate): Collection
    {
        $sqlDate = $this->getSqlDate();

        $values = $this->builder
            ->toBase()
            ->selectRaw("
                {$sqlDate} as {$this->dateAlias},
                {$aggregate}({$column}) as aggregate
            ")
            ->whereBetween($this->dateColumn, [$this->start, $this->end])
            ->groupBy(DB::raw($sqlDate)) // Обход ONLY_FULL_GROUP_BY
            ->orderBy($this->dateAlias)
            ->get();

        return $this->mapValuesToDates($values);
    }
}
