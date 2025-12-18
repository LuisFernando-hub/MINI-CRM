<?php

namespace App\Repositories;

use App\DTOs\CustomerDTO;
use App\Models\Customer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CustomerRepositoryInterface
{
    public function list($filter): LengthAwarePaginator;

    public function find($id): ?Customer;
    public function findByEmail($email): ?Customer;

    public function create(CustomerDTO $data): ?Customer;

    public function update($id, CustomerDTO $data): Customer;

    public function delete($id): void;

}