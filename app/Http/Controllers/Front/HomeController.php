<?php

namespace App\Http\Controllers\Front;

use App\Models\Setting;
use App\Shop\Categories\Category;
use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;

class HomeController
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * HomeController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepo = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
//        $cat1 = Category::first();
//        $cat2 = Category::first();

        $settings = Setting::with('media')->get()->mapWithKeys(function ($setting){
           return [$setting['option_slug'] => $setting];
        });

//        dd(Setting::with('media')->get());

//        dd($settings);

        return view('front.home.index')->with([
            'settings' => $settings
        ]);

//        return redirect('/HTML');
    }
}
