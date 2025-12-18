<?php

namespace App\Repositories\Eloquent;

use App\DTOs\CustomerDTO;
use App\Models\Customer;
use App\Repositories\CustomerRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function list($filter): LengthAwarePaginator
    {
        $query = Customer::query()->with('customer');

        if (!empty($filter['email'])) {
           $query->whereHas('customer', function ($q) use ($filter) {
                $q->where('email', $filter['email']);
            });
        }

        if (!empty($filter['status'])) {
            $query->where('status', $filter['status']);
        }

        if (!empty($filter['phone_number'])) {
            $query->whereHas('customer', function ($q) use ($filter) {
                $q->where('phone_number', $filter['phone_number']);
            });
        }

        if (!empty($filter['date'])) {
            $query->whereDate('created_at', $filter['date']);
        }

         return $query->paginate( 10);
    }

    public function find($id): Customer
    {
        return Customer::findOrFail($id);
    }

    public function findByEmail($email): Customer
    {
        return Customer::where('email', $email)->firstOrFail();
    }

    public function create(CustomerDTO $data): Customer
    {
        return Customer::create($data->toArray());
    }

    public function update($id, CustomerDTO $data): Customer
    {
        $customer = $this->find($id);
        $customer->update($data->toArray());
        return $customer;
    }

    public function delete($id): void
    {
        $customer = $this->find($id);
        $customer->delete();
    }
}