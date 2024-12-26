<?php

namespace App\Application\Services;

use App\Application\Interfaces\ICompanyService;
use App\Application\Models\Company;
use App\Domain\Enums\UserType;
use App\Infrastructure\Interfaces\ICompanyRepository;
use Illuminate\Support\Facades\Session;

class CompanyService implements ICompanyService
{
    protected ICompanyRepository $repository;

    public function __construct(ICompanyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all companies with conditions.
     *
     * @param array $conditions
     * @param array $columns
     * @param array $relations
     * @return array
     */

    public function getAllWoP(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $companies = $this->repository->allWoP($conditions, $columns, $relations);
        return $companies;
    }
    public function getAll(array $conditions = [], array $columns = ['*'], array $relations = [])
    {
        $companies = $this->repository->all($conditions, $columns, $relations);
        return $companies;
    }

    /**
     * Get a company by ID with optional relations.
     *
     * @param int $id
     * @param array $relations
     * @return Company
     */
    public function getById(int $id, array $relations = []): Company
    {
        $company = $this->repository->find($id, ['*'], $relations);

        return $this->mapToApplicationModel($company);
    }

    /**
     * Create a new company.
     *
     * @param array $data
     * @return Company
     */
    public function create(array $data): Company
    {
        // Only admin users are allowed to create new companies
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $company = $this->repository->create($data);
        return $this->mapToApplicationModel($company);
    }

    /**
     * Update an existing companies.
     *
     * @param int $id
     * @param array $data
     * @return Company
     */
    public function update(int $id, array $data): Company
    {
        $company = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        $updatedCompany = $this->repository->update($id, $data);
        return $this->mapToApplicationModel($updatedCompany);
    }

    /**
     * Delete a Company.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $warehouse = $this->repository->find($id);

        // Restrict access for non-admin users
        if (Session::get('role') !== UserType::Admin->value) {
            abort(403, 'Unauthorized action.');
        }

        return $this->repository->delete($id);
    }

    /**
     * Search for companies based on criteria.
     *
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return array
     */
    public function search(array $criteria, array $columns = ['*'], array $relations = []): array
    {
        $results = $this->repository->customQuery(function ($query) use ($criteria, $columns, $relations) {
            $query->with($relations);

            foreach ($criteria as $condition) {
                if (is_array($condition) && count($condition) === 3) {
                    [$column, $operator, $value] = $condition;
                    $query->where($column, $operator, $value);
                } elseif (is_array($condition) && count($condition) === 2) {
                    [$column, $value] = $condition;
                    $query->where($column, '=', $value);
                }
            }

            return $query->get($columns);
        });

        return array_map(fn($warehouse) => $this->mapToApplicationModel($warehouse)->toArray(), $results->toArray());
    }

    /**
     * Map a repository model to the application model.
     *
     * @param object $model
     * @return Company
     */
    private function mapToApplicationModel($model): Company
    {
        return new Company(
            id: $model->id,
            name: $model->name,
            email: $model->email,
            phone: $model->phone,
            address: $model->address,
            website: $model->website,
            isActive: $model->is_active,
        );
    }
}
