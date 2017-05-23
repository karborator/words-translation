<?php

namespace App\Model;

use Illuminate\Pagination\Paginator;

/**
 * Class ViewModel
 */
class ViewModel extends \ArrayObject
{
    private $template;
    private $params;
    private $page;
    private $perPage;
    private $total;
    private $lastPage;
    private $nextPage;
    private $prevPage;

    public function __construct($params)
    {
        parent::__construct($params);
    }

    public function getTemplate()
    {
        if (!$this->template) {
            $this->template = parent::offsetGet('template');
            $this->offsetUnset('template');
        }

        return $this->template;
    }

    public function getParams()
    {
        if (!$this->params) {
            $this->params =  parent::offsetGet('params');
            $this->offsetUnset('params');
        }

        return $this->params;
    }

    public function getPage()
    {
        if (!$this->page) {
            $this->page = parent::offsetGet('page');
            $this->offsetUnset('page');
        }

        return $this->page;
    }

    public function getCurrentPage()
    {
        return $this->getPage();
    }

    public function getPerPage()
    {
        if (!$this->perPage) {
            $this->perPage = parent::offsetGet('perPage');
            $this->offsetUnset('perPage');
        }

        return $this->perPage;
    }

    public function getTotalItems()
    {
        if (!$this->total) {
            $this->total = parent::offsetGet('total');
            $this->offsetUnset('total');
        }

        return $this->total;
    }

    public function getLastPage()
    {
        if (!$this->lastPage) {
            $this->lastPage = parent::offsetGet('lastPage');
            $this->offsetUnset('lastPage');
        }

        return $this->lastPage;
    }

    public function getNextPage()
    {
        if (!$this->nextPage) {
            $this->nextPage = parent::offsetGet('nextPage');
            $this->offsetUnset('nextPage');
        }

        return $this->nextPage;
    }

    public function getPrevPage()
    {
        if (!$this->prevPage) {
            $this->prevPage = parent::offsetGet('prevPage');
            parent::offsetUnset('prevPage');
        }

        return $this->prevPage;
    }

    public function geTotalPages()
    {
        return ceil($this->getTotalItems()
            / $this->getPerPage());
    }
}
