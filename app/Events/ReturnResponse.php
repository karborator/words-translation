<?php

namespace App\Events;

use App\Model\ViewModel;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReturnResponse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ViewModel
     */
    private $viewModel;

    /**
     * Response constructor.
     *
     * @param ViewModel $viewModel
     */
    public function __construct(ViewModel $viewModel)
    {
        $this->viewModel = $viewModel;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @return ViewModel
     */
    public function getViewModel(): ViewModel
    {
        return $this->viewModel;
    }
}
