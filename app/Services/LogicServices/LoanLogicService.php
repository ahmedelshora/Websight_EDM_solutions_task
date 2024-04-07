<?php

namespace App\Services\LogicServices;

use App\Repositories\LoanRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoanLogicService
{

    protected LoanRepository $repository;

    /**
     * @param LoanRepository $repository
     * @return void
     */
    public function setRepository(LoanRepository $repository):void
    {
        $this->repository = $repository;
    }

    /**
     * @return LoanRepository
     */
    public function getRepository(): LoanRepository
    {
        return $this->repository;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function store(array $data):bool
    {
        try {
            DB::beginTransaction();
            $this->getRepository()->create($data);
            $this->getRepository()->generateAmortizationSchedule();
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            Log::error('Error in store function in LoanLogicService ',[
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine()
            ]);
            return false;
        }
        return  true;
    }
}
