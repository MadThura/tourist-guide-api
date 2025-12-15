<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Http\Resources\Api\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $categories = Category::all();

        return $this->successResponse('Categories fetched successfully', CategoryResource::collection($categories));
    }
}
