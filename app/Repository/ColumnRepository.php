<?php

namespace App\Repository;

use App\Models\Column;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ColumnRepository
{
    /**
     * @param int $id
     * @return Column
     */
    public function findById(int $id): Column
    {
        return Column::findOrFail($id);
    }

    /**
     * @return Builder[]|Collection
     */
    public function getColumnWithCards(): Collection|array
    {
        return Column::with('cards')->get();
    }

    /**
     * @param string $slug
     * @param string $title
     * @return Column
     */
    public function create(string $slug, string $title): Column
    {
        return Column::create(["title" => $title, "slug" => $slug]);
    }

    /**
     * @param Column $column
     * @return bool
     */
    public function drop(Column $column): bool|null
    {
        return $column->delete();
    }
}
