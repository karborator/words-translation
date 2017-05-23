<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class ImportCsvWords
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var array
     */
    private $files = [];

    /**
     * @var string
     */
    private $path = '';

    /**
     * ImportCsvWords constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if(!$request->hasFile('csv-words')){
            return;
        }

        $files = $request->allFiles();
        /** @var File $file */
        foreach ($files  as $file) {
            $file->storeAs('words', 'words.csv');
        }

        $this->files = scandir($this->getStoragedDir());
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
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    private function getStoragedDir(): string
    {
        if ($this->path) {
            return $this->path;
        }

        $dirPath = app_path() .
            DIRECTORY_SEPARATOR.
            '..'.
            DIRECTORY_SEPARATOR .
            'storage' .
            DIRECTORY_SEPARATOR
            . 'app' .
            DIRECTORY_SEPARATOR .
            'words';

        if(!is_dir($dirPath)){
            throw new \RuntimeException('Bad storage dir path!');
        }

        if (!is_readable($dirPath)) {
            chmod($dirPath, '0775');
        }

        $this->path = $dirPath;
        return $dirPath;
    }
}
