<?php

namespace App\Http\Controllers;

use App\Repository\CardRepository;
use App\Repository\ColumnRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CardController extends Controller
{
    public function __construct(private ColumnRepository $columnRepository, private CardRepository $cardRepository) {}

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'description' => 'string|nullable',
            'column_id' => 'required|numeric'
        ]);

        $column = $this->columnRepository->findById($request->input('column_id'));

        return $this->sendSuccess($this->cardRepository->create(title: $request->input('title'), description: $request->input('description'), column: $column));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
