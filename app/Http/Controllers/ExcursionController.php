<?php

namespace App\Http\Controllers;

use App\Models\Excursion;
use App\Models\ExcursionCategory;
use Illuminate\Http\Request;

class ExcursionController extends Controller
{
    public function index(Request $request)
    {
        $query = Excursion::query()
            ->where('isActive', true)
            ->where('published_at', '<=', now())
            ->with('category');

        // фильтрация по категории
        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        // фильтрация по ключевым словам
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }

        $excursions = $query->orderByDesc('published_at')->paginate(9);
        $categories = ExcursionCategory::where('isActive', true)->get();

        return view('excursions.index', compact('excursions', 'categories'));
    }

    public function show(Excursion $excursion)
    {
        return view('excursions.show', compact('excursion'));
    }
}
