<?php

namespace App\Services;

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
    public function updateCard(array $payload): bool
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
}
