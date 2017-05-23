<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/22/17
 * Time: 5:11 PM
 */

namespace App\Http\Controllers;

use App\Events\ImportCsvWords;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function import(Request $request)
    {
        if (!$this->isAuthenticated()) {
            return back();
        }

        if (!$request->hasFile('csv-words')) {
            return view('import-csv');
        }

        event(new ImportCsvWords($request));

        return redirect('import-csv')->with('msg','Job inserted for processing into a queue!');
    }
}
