<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Http\Requests\categoryRequest;

use App\Http\Resources\CategoryResorce;

class CategoryController extends Controller
{
    use  ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }
  
    public function index()
    {
        $categories=Category::all();
        $categories=CategoryResorce::collection($categories);
        return $this->successResponse('this is all categories',$categories,200);
    
        
    }

   
    public function store(categoryRequest $request)
    {
      $category=new Category();
      $category->name=$request->name;
      $category->save();
      
      return $this->successResponse('successefuly add a new category',$category,201);
     
    }


    public function update(categoryRequest $request, Category $category)
    {
     $category->name=$request->name??$category->name;
     $category->save();
    //  $category=CategoryResorce::collection($category);
      return $this->successResponse('successefuly edit a category',$category,200);
    }

    
    public function destroy(Category $category)
    {
        $category->delete();
        
        return $this->successResponse('successefully deleted',200);
    }
}
