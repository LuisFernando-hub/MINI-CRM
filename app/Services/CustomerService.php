<?php

namespace App\Services;

use App\DTOs\CustomerDTO;
use App\Models\Customer;
use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;


class CustomerService
{
    public function __construct(
        private readonly CustomerRepositoryInterface $repository
    ) {}

    public function list($filter): LengthAwarePaginator
    {
        return $this->repository->list($filter);
    }

    public function create(CustomerDTO $data, ?UploadedFile $file = null): Customer
    {
        $findCustomer = $this->repository->findByEmail($data->email);

        if (!$findCustomer) {
            $dto = new CustomerDTO(
                name: $data->name,
                email: $data->email,
                phone_number: $data->phone_number,
            );
            $customer = $this->repository->create($dto);
        } else {
            $customer = $findCustomer;
        }

        if ($file) {
            $customer->addMedia($file)->toMediaCollection('documents', 'public');
        }

        return $customer;
    }

    public function find($id): Customer
    {
        return $this->repository->find($id);
    }

    public function update($id, CustomerDTO $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $this->repository->delete($id);
    }

}