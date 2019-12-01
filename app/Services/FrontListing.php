<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class FrontListing
{
    /**
     * @var Builder
     */
    protected $query;

    protected $page;

    protected $perPage;

    public function attachQuery(Builder $query){
        $this->query = $query;

        return $this;
    }

    public function attachPagination($page, $perPage = 3) {

        $this->perPage = $perPage;
        $this->page = $page;

        return $this;
    }

    public function attachOrdering($orderBy, $orderDirection = 'asc') {
        $this->query->orderBy($orderBy, $orderDirection);

        return $this;
    }

    public function modifyQuery(callable $modifyQuery) {
        $modifyQuery($this->query);

        return $this;
    }

    public function getResults()
    {
        return $this->query->paginate($this->perPage, ['*'], 'page', $this->page);
    }

}