<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Meal;
use App\Models\Category;
use App\Models\Ingredient;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meals = Meal::with(['category', 'ingredients'])
                    ->withCount('orderItems')
                    ->paginate(10); 


        return view('products.index' , compact('meals'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $ingredients = Ingredient::active()->get();

        return view('products.create', compact('categories' , 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'preparation_time' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'nullable|array|min:1',
            'ingredients.*.id' => 'nullable|exists:ingredients,id',
            'ingredients.*.quantity' => 'nullable|numeric|min:0.01',
            'ingredients.*.notes' => 'nullable|string|max:255',
        ]);

        // معالجة رفع الصورة
        $data = $request->except('ingredients');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('productImages'), $filename);
            $data['image'] = asset('productImages/' . $filename);
        }

        // تعيين القيم الافتراضية للحقول المنطقية
        $data['is_available'] = $request->has('is_available') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $meal = Meal::create($data);

        // ربط المكونات بالوجبة
        if ($request->has('ingredients')) {
            foreach ($request->ingredients as $ingredient) {
                $meal->ingredients()->attach($ingredient['id'], [
                    'quantity' => $ingredient['quantity'],
                    'notes' => $ingredient['notes'] ?? null,
                ]);
            }
        }

        $meal->load(['category', 'ingredients']);
        return redirect()->route('meals.index')->with('msg', __('meals.meal_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Meal $meal)
    {
        $meal->load(['category', 'ingredients', 'orderItems']);

        return view('products.show', compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meal $meal)
    {
        $categories = Category::active()->get();
        $ingredients = Ingredient::active()->get();
        $meal->load(['category', 'ingredients']);

        return view('products.edit', compact('meal', 'categories', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meal $meal)
    {
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'preparation_time' => 'nullable|integer|min:1',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'ingredients' => 'nullable|array|min:1',
            'ingredients.*.id' => 'nullable|exists:ingredients,id',
            'ingredients.*.quantity' => 'nullable|numeric|min:0.01',
            'ingredients.*.notes' => 'nullable|string|max:255',
        ]);

        // معالجة رفع الصورة
        $data = $request->except('ingredients');
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا وجدت
            if ($meal->image && file_exists(public_path($meal->image))) {
                unlink(public_path($meal->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('productImages'), $filename);
            $data['image'] = asset('productImages/' . $filename);
        }

        // تعيين القيم الافتراضية للحقول المنطقية
        $data['is_available'] = $request->has('is_available') ? 1 : 0;
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $meal->update($data);

        // إعادة ربط المكونات
        $meal->ingredients()->detach();
        if ($request->has('ingredients')) {
            foreach ($request->ingredients as $ingredient) {
                $meal->ingredients()->attach($ingredient['id'], [
                    'quantity' => $ingredient['quantity'],
                    'notes' => $ingredient['notes'] ?? null,
                ]);
            }
        }

        $meal->load(['category', 'ingredients']);

        return redirect()->route('meals.index')->with('msg', __('meals.meal_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meal $meal)
    {
        $meal->delete();
        return redirect()->route('meals.index')->with('msg', __('meals.meal_deleted'));
    }

    /**
     * Get meals by category.
     */
    public function byCategory(Category $category)
    {
        $meals = $category->meals()->with('ingredients')->get();
        return response()->json($meals);
    }

    /**
     * Get available meals.
     */
    public function available()
    {
        $meals = Meal::available()->active()->with(['category', 'ingredients'])->get();
        return response()->json($meals);
    }

    /**
     * Get all meals.
     */
    public function apiIndex()
    {
        $locale = request()->get('locale', app()->getLocale());
        $meals = Meal::with(['category', 'ingredients'])->get();
        $meals = $meals->map(function ($meal) use ($locale) {
            return [
                'id' => $meal->id,
                'name' => $meal->getLocalizedName($locale),
                'description' => $meal->getLocalizedDescription($locale),
                'price' => $meal->price,
                'image' => asset($meal->image),
                'category' => $meal->category->name
            ];
        });
        return response()->json($meals, 200);
    }
    public function meals_get($category)
    {
        $meals = Meal::where('category_id', $category)->get();
        return response()->json($meals, 200);
    }
}
