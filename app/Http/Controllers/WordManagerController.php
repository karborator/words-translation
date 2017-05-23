<?php
/**
 * Created by IntelliJ IDEA.
 * User: nikolayyotsov
 * Date: 5/20/17
 * Time: 11:08 AM
 */

namespace App\Http\Controllers;

use App\Events\ReturnResponse;
use App\Word;
use Illuminate\Http\Request;

class WordManagerController extends Controller
{
    const WORD_MANAGER = 'word-manager';
    const PAGE_NUMBER = 1;
    const PER_PAGE = 10;

    /**
     * Used by ViewModel
     *
     * @var string
     */
    protected static $TEMPLATE = self::WORD_MANAGER;

    /**
     * @var array
     */
    private $validationRules
        = [
            'word'    => 'required',
            'meaning' => 'required',
        ];

    /**
     * @return mixed
     */
    public function fetchALl(Request $request)
    {
        if (!$request->wantsJson() && !$this->isAuthenticated()) {
            return back();
        }

        if (!($perPage = $request->query()['limit']??null)) {
            $perPage = $request->query()['perPage'] ?? self::PER_PAGE;
        }

        $criteria = $request->only('order', 'orderType') ?? 'id';
        $order = $criteria['order'] ?? 'id';
        $orderType = $criteria['orderBy'] ?? 'asc';

        $collection = \App\Word::orderBy($order, $orderType)->paginate(
            $perPage
        );

        $viewModel = $this->getViewModel($collection, self::$TEMPLATE);

        return event(new ReturnResponse($viewModel))[0];
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function fetch(int $id)
    {
        if (!request()->wantsJson() && !$this->isAuthenticated()) {
            return back();
        }

        /** @var Word $entity */
        $entity = \App\Word::find($id) ?? [];

        $viewModel = $this->getViewModel($entity, self::$TEMPLATE);

        return event(new ReturnResponse($viewModel))[0];
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        if (!$this->isAuthenticated()) {
            return back();
        }

        $this->validate($request, $this->validationRules);

        $params = $request->only('word', 'meaning');

        Word::create($params);

        return redirect(self::WORD_MANAGER);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        if (!$this->isAuthenticated()) {
            return back();
        }

        if ($request->isMethod('GET')) {
            return view('edit-word', Word::find($id));
        }

        $this->validate($request, $this->validationRules);

        $data = $request->only('word', 'meaning');

        $entity = \App\Word::find($id) ?? [];

        $entity->update($data);

        return redirect('/word-manager');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        if (!$this->isAuthenticated()) {
            return back();
        }

        $entity = \App\Word::find($id) ?? [];

        $entity->delete();

        return redirect(self::WORD_MANAGER);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getWord(Request $request)
    {
        if (!($word = $request->query('word')?? null)) {
            return [];
        }

        $word = $request->only('word');

        $entity = Word::where(['word' => $word])->get()->first() ?? [];

        $viewModel = $this->getViewModel($entity);

        return event(new ReturnResponse($viewModel))[0];
    }

}
