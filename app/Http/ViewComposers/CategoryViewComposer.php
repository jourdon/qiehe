<?php

namespace App\Http\ViewComposers;
use App\Models\Category;
use Illuminate\View\View;

class CategoryViewComposer
{
    protected  $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function compose(View $view)
    {
        $categories = $this->category->getAllCached();
        $view->with('categories',$categories);
    }
}