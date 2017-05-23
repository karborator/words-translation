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
            $meaning[$word] = TransltrClient::transalte($word, $from, $to)['translationText'];
        }

        return view('welcome', ['translated' => $meaning]);
    }
}
