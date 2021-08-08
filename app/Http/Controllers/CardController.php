<?php

namespace App\Http\Controllers;

use App\Repository\CardRepository;
use App\Repository\ColumnRepository;
use App\Services\CardService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CardController extends Controller
{
    /**
     * CardController constructor.
     * @param ColumnRepository $columnRepository
     * @param CardRepository $cardRepository
     * @param CardService $cardService
     */
    public function __construct(private ColumnRepository $columnRepository, private CardRepository $cardRepository, private CardService $cardService)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string|nullable',
            'column_id' => 'required|numeric|exists:columns,id'
        ]);

        $column = $this->columnRepository->findById($request->input('column_id'));

        return $this->sendSuccess($this->cardRepository->create(title: $request->input('title'), description: $request->input('description'), column: $column));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->validate($request, [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        return $this->sendSuccess($this->cardService->updateCard(id: $id, title: $request->input('title'), description: $request->input('description')));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updateCardsColumn(Request $request): JsonResponse
    {
        $this->validate($request, [
            'columns' => 'required|array',
            'columns.*.title' => 'required|string',
            'columns.*.slug' => 'required|string',
            'columns.*.cards' => 'array',
        ]);

        return $this->sendSuccess($this->cardService->updateCardsColumn($request->input('columns')));
    }
}
