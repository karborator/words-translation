<?php

namespace App\Http\Controllers;

use App\Events\ControllerConstructor;
use App\Model\ViewModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * DashboardController constructor.
     */
    public function isAuthenticated()
    {
        return event(new ControllerConstructor())[0] ?? false;
    }

    /**
     * @param null $paginatorOrEntity
     *
     * @return ViewModel
     */
    protected function getViewModel($paginatorOrEntity = null, $template = null)
    {
        if (is_object($paginatorOrEntity)
            && method_exists(
                $paginatorOrEntity, 'toArray'
            )
        ) {
            $toArray = $paginatorOrEntity->toArray();
        } else {
            $toArray = $paginatorOrEntity;
        }

        if (!$toArray) {
            throw new \RuntimeException(
                'Invalid argument , expected array or object with method toArray!'
            );
        }


        if (!isset($toArray['current_page']) || !$toArray['per_page']) {
            $data = $toArray;
        } else {
            $paginator       = $paginatorOrEntity;
            $page            = $toArray['current_page'];
            $perPage         = $toArray['per_page'];
            $data            = $toArray['data'];
            $array           = $paginator->getUrlRange(
                1, ceil($paginator->total() / $perPage)
            );
            $lastpage        = end($array);
            $total           = $paginator->total();
            $nextPageUrl     = $paginator->nextPageUrl();
            $previousPageUrl = $paginator->previousPageUrl();
        }

        return new ViewModel(
            [
                'template' => $template,
                'params'   => $data ?? [],
                'page'     => $page ?? null,
                'perPage'  => $perPage ?? null,
                'total'    => $total ?? null,
                'lastPage' => $lastpage ?? null,
                'nextPage' => $nextPageUrl ?? null,
                'prevPage' => $previousPageUrl ?? null,
            ]
        );
    }
}
