<?php

namespace App\Contracts\Repositories;

use App\Contracts\Models\MainModelInterface;

interface MainRepositoryInterface
{
    /**
     * @return int
     */
    public function getPrimaryKey():int;
    /**
     * @return MainModelInterface
     */
    public function getModel(): MainModelInterface;

    /**
     * @param MainModelInterface|null $model
     * @return void
     */
    public function setModel(MainModelInterface $model = null): void;

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data):mixed;

    /**
     * @return mixed
     */
    public function getList(): mixed;

    /**
     * @param $id
     * @return mixed
     */
    public function getDetailsById($id):mixed;

}
