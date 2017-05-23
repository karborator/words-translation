<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/21/17
 * Time: 3:40 PM
 */

namespace App\Http\Controllers;

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

        $meaning = [];
        foreach ($words as $word) {
            /** @var \Illuminate\Database\Eloquent\Builder $wordCollection */
            if(!($entity = Word::where(['word' => $word])->get()->first())){
                $meaning[$word] = $word;
                continue;
            }

            $entity = $entity->toArray();

            $meaning[$word] = isset($entity['meaning'])
                ? $entity['meaning']
                : $word;
        }

        return view('welcome', ['translated' => $meaning]);
    }
}
