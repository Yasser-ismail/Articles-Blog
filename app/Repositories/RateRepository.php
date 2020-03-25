<?php


namespace App\Repositories;


use App\BaseRepository;
use App\Models\Rate;

class RateRepository extends BaseRepository
{
    public function __construct(Rate $rate)
    {
        $this->model = $rate;
    }
}
