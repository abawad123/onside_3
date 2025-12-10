<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = Meal::with('Category')->latest()->get();
        return view('meals.index' , compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('meals.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        $image = $request->file('image')?->store('meals', 'public');
        Meal::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $image,
        ]);
        session()->flash('success', 'Meal created successfully.');
        return redirect()->route('meals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        $categories = Category::all();
        return view('meals.edit', compact('meal', 'categories'));
    }
    /**
     * Update the specified resource in storage
     */
    public function update(Request $request, Meal $meal)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($meal->image);
            $image = $request->file('image')->store('meals', 'public');
            $meal->image = $image;
        }
        $meal->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        session()->flash('success', 'Meal created successfully.');
        return redirect()->route('meals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        Storage::disk('public')->delete($meal->image);
        $meal->delete();
        session()->flash('success', 'Meal deleted successfully.');
        return redirect()->route('meals.index');
    }
}
