<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/21/17
 * Time: 3:40 PM
 */

namespace App\Http\Controllers;

use App\Http\Client\TransltrClient;
use App\Word;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    /**
     * @var array
     */
    private $validationRules
        = [
            'words' => 'required',
        ];

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function translate(Request $request)
    {
        $this->validate($request, $this->validationRules);

        $words  = explode(' ', $request->only('words')['words']);
        $query  = $request->query('from', 'to');

        $from   = $query['from'] ?? 'en';
        $to     = $query['to']  ?? 'bg';

        $meaning = [];
        foreach ($words as $word) {
            /** @var \Illuminate\Database\Eloquent\Builder $wordCollection */
            if(!($entity = Word::where(['word' => $word])->get()->first())){
                $meaning[$word] = TransltrClient::transalte($word, $from, $to)['translationText'];
                $this->sync($word, $meaning);
                continue;
            }

            $entity = $entity->toArray();

            $meaning[$word] = $entity['meaning'] ??
                TransltrClient::transalte($word, $from, $to)['translationText'];
            $this->sync($word, $meaning);
        }

        return view('welcome', ['translated' => $meaning]);
    }

    /**
     * @param $word
     * @param $meaning
     *
     * @return mixed
     */
    private function sync($word, $meaning)
    {
        return Word::create(
            [
                'word'    => $word,
                'meaning' => $meaning[$word]
            ]
        );
    }
}
