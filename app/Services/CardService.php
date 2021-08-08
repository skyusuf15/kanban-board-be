<?php

namespace App\Services;

use App\Models\Card;
use App\Repository\CardRepository;

class CardService
{
    /**
     * CardService constructor.
     * @param CardRepository $cardRepository
     */
    public function __construct(private CardRepository $cardRepository)
    {
    }

    /**
     * @param array $payload
     * @return bool
     */
    public function updateCardsColumn(array $payload): bool
    {
        foreach ($payload as $column) {
            if (count($column["cards"]) < 1) {
                continue;
            }
            foreach ($column['cards'] as $card) {
                if ($card['column_id'] === $column['id']) {
                    continue;
                }

                $cardRecord = $this->cardRepository->findById($card['id']);
                $cardRecord->column_id = $column['id'];

                return $this->cardRepository->update($cardRecord);
            }
        }
        return false;
    }

    /**
     * @param int $id
     * @param string|null $title
     * @param string|null $description
     * @return Card
     * @throws \Exception
     */
    public function updateCard(int $id, string $title = null, string $description = null): Card
    {
        $card = $this->cardRepository->findById($id);
        $title && $card->title = $title;
        $description && $card->description = $description;

        if ($this->cardRepository->update($card)) {
            return $card;
        }

        throw new \Exception('Failed to update Card!');
    }
}
