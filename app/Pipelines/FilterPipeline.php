<?php

namespace App\Pipelines;

use Illuminate\Pipeline\Pipeline;

class FilterPipeline extends Pipeline
{
    private $filterData;

    public function setFilterData($filter): static
    {
        $this->filterData = $filter;

        return $this;
    }

    protected function parsePipeString($pipe): array
    {
        [$name, $parameters] = parent::parsePipeString($pipe);

        array_unshift($parameters, $this->filterData);

        return [$name, $parameters];
    }
}
