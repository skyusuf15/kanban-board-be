<?php

namespace App\Http\Controllers;

use App\Models\Column;
use App\Repository\ColumnRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ColumnController extends Controller
{
    /**
     * ColumnController constructor.
     * @param ColumnRepository $repository
     */
    public function __construct(private ColumnRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->sendSuccess($this->repository->getColumnWithCards());
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'title' => 'required|string',
            'slug' => 'required|string',
        ]);
        return $this->sendSuccess($this->repository->create(slug: $request->input('slug'), title: $request->input('title')));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        return $this->sendSuccess($this->repository->drop(column: $this->repository->findById($id)));
    }
}
