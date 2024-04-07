<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanCreateRequest;
use App\Repositories\LoanRepository;
use App\Services\LogicServices\LoanLogicService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LoanController extends Controller
{
    public function __construct(public LoanRepository $repository)
    {
    }

    /**
     * @return LoanLogicService
     */
    private function getLogicService(): LoanLogicService
    {
        return new LoanLogicService();
    }


    /**
     * @return string
     */
    protected function getViewBasPath():string
    {
        return 'loan';
    }

    /**
     * @return View
     */
    public function index():View
    {
        return view($this->getViewBasPath().'.index');

    }

    /**
     * @return View
     */
    public function create():View
    {
        return view($this->getViewBasPath().'.create');

    }

    /**
     * @param LoanCreateRequest $request
     * @return RedirectResponse
     */
    public function store(LoanCreateRequest $request): RedirectResponse
    {
        $logicService = $this->getLogicService();
        $logicService->setRepository($this->repository);

        if ($logicService->store($request->validated())){
            return  redirect()->route('loan.show', ['id' => $this->repository->getPrimaryKey()]);
        }
        return  redirect()->back()->withErrors(['error in create']);
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $repository = $this->repository->getDetailsById($id);
        return view($this->getViewBasPath().'.show',compact('repository'));
    }



}
