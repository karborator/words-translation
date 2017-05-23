<?php

namespace App\Listeners;

use App\Events\ImportCsvWords;
use App\Http\Client\TransltrClient;
use App\Word;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CsvWordTranslate implements ShouldQueue
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
     * @param  ImportCsvWords $event
     *
     * @return void
     */
    public function handle(ImportCsvWords $event)
    {
        $this->processFiles(
            $event, function ($file) {
            while (($line = fgetcsv($file)) !== false) {
                foreach ($line as $word) {
                    $translation = $this->translateWord($word, 'en', 'bg');
                    if (isset($translation['translationText'])) {
                        $this->store($word, $translation['translationText']);
                    }
                }
            }
        }
        );
    }

    /**
     * @param string $word
     * @param string $from
     * @param string $to
     *
     * @return array
     */
    public function translateWord(string $word, string $from, string $to): array
    {
        return TransltrClient::transalte($word, $from, $to);
    }

    /**
     * @param $word
     * @param $translation
     */
    private function store($word, $translation)
    {
        Word::create(
            [
                'word'    => $word,
                'meaning' => $translation,
            ]
        );
    }

    /**
     * @param ImportCsvWords $event
     * @param                $callback
     */
    private function processFiles(ImportCsvWords $event, $callback)
    {
        $files = $event->getFiles();

        foreach ($files as $file) {
            $file = fopen($event->getPath() . DIRECTORY_SEPARATOR . $file, 'r');
            is_callable($callback) ? call_user_func($callback, $file) : null;
            fclose($file);
        }
    }
}
