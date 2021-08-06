<?php

namespace App\Repository;

use App\Models\Card;
use App\Models\Column;
use Illuminate\Database\Eloquent\Collection;

class CardRepository
{
    /**
     * @param string $title
     * @param string|null $description
     * @param Column $column
     * @return Card
     */
    public function create(string $title, ?string $description = '', Column $column): Card
    {
        return Card::create([
            'title' => $title,
            'description' => $description,
            'column_id' => $column->id,
        ]);
    }

    /**
     * @param int $id
     * @return Card
     */
    public function findById(int $id): Card
    {
        return Card::findOrFail($id);
    }

    /**
     * @return Card[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Card::all();
    }

    /**
     * @param Card $card
     * @return bool
     */
    public function update(Card $card): bool
    {
        return $card->save();
    }

    /**
     * @param Card $card
     * @return bool
     */
    public function delete(Card $card): bool
    {
        return $card->delete();
    }
}
