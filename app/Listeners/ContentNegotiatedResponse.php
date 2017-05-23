<?php

namespace App\Listeners;

use App\Events\ReturnResponse;
use Illuminate\Pagination\Paginator;
use Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContentNegotiatedResponse
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReturnResponse $event
     *
     * @return mixed
     */
    public function handle(ReturnResponse $event)
    {
        $viewModel    = $event->getViewModel();

        switch (true) {
            case true === request()->wantsJson() & count(request()->segments()) === 1:
                return $this->buildJsonCollectionResponseStruct($viewModel);
                break;
            case true === request()->wantsJson() & count(request()->segments()) > 1:
                return $this->buildJsonEntityResponseStruct($viewModel);
                break;
            //todo include cases for xml based etc.
            default:
                return $this->buildHtmlResponseStruct($viewModel);
                break;
        }
    }

    /**
     * @param $viewModel
     *
     * @return array
     */
    private function buildJsonCollectionResponseStruct($viewModel): array
    {
        return [
            '_links'     => [
                'prevPage' => $viewModel->getPrevPage(),
                'nextPage' => $viewModel->getNextPage(),
                'lastPage' => $viewModel->getLastPage(),
            ],
            '_embedded'  => $viewModel->getParams(),
            'perPage'    => $viewModel->getPerPage(),
            'page'       => $viewModel->getPage(),
            'totalItem'  => $viewModel->getTotalItems(),
            'totalPages' => $viewModel->geTotalPages(),
        ];
    }

    /**
     * @param $viewModel
     *
     * @return array
     */
    private function buildHtmlResponseStruct($viewModel): array
    {
        return view(
            $viewModel->getTemplate(),
            [
                'prevPage'   => $viewModel->getPrevPage(),
                'nextPage'   => $viewModel->getNextPage(),
                'lastPage'   => $viewModel->getLastPage(),
                'list'       => $viewModel->getParams(),
                'entity'     => $viewModel->getParams(),
                'perPage'    => $viewModel->getPerPage(),
                'page'       => $viewModel->getPage(),
                'totalItem'  => $viewModel->getTotalItems(),
                'totalPages' => $viewModel->geTotalPages(),
            ]
        );
    }

    /**
     * @param $viewModel
     *
     * @return mixed
     */
    private function buildJsonEntityResponseStruct($viewModel)
    {
        return $viewModel->getParams();
    }
}
