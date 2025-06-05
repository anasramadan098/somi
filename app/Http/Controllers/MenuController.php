<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Meal;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{

    /**
     * Helper function لتحسين البيانات المرجعة
     */
    private function formatMealData($meal, $locale = 'ar')
    {
        return [
            'id' => $meal->id,
            'name' => $locale === 'ar' ? ($meal->name_ar ?? $meal->name) : ($meal->name_en ?? $meal->name),
            'description' => $locale === 'ar' ? ($meal->description_ar ?? $meal->description) : ($meal->description_en ?? $meal->description),
            'price' => (float) $meal->price,
            'image' => $meal->image
        ];
    }

    /**
     * Helper function لتحسين بيانات الفئات
     */
    private function formatCategoryData($category, $locale = 'ar')
    {
        return [
            'id' => $category->id,
            'name' => $locale === 'ar' ? ($category->name_ar ?? $category->name ?? 'غير محدد') : ($category->name_en ?? $category->name ?? 'Unnamed'),
            'description' => $locale === 'ar' ? ($category->description_ar ?? $category->description ?? '') : ($category->description_en ?? $category->description ?? ''),
            'image' => $category->image,
            'type' => $category->type ?? 'food'
        ];
    }
    /**
     * Display the restaurant menu
     */
    public function index()
    {
        return view('menu.index');
    }

    /**
     * Get all categories for menu
     */
    public function getCategories()
    {
        try {
            // الحصول على اللغة من الطلب
            $locale = request()->get('locale', 'ar');

            // استخدام Cache لتسريع الاستجابة (5 دقائق)
            $cacheKey = "categories_active_{$locale}";
            $categoriesData = Cache::remember($cacheKey, 300, function () use ($locale) {
                $categories = Category::where('is_active', true)
                    ->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'image', 'type')
                    ->get();

                return $categories->map(function ($category) use ($locale) {
                    return $this->formatCategoryData($category, $locale);
                });
            });

            \Log::info('Active categories count: ' . $categoriesData->count());

            return response()->json($categoriesData);
        } catch (\Exception $e) {
            \Log::error('Error in getCategories: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load categories',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get meals by category for menu
     */
    public function getMealsByCategory($categoryId)
    {
        try {
            \Log::info('Getting meals for category: ' . $categoryId);

            // الحصول على اللغة من الطلب
            $locale = request()->get('locale', 'ar');

            // استخدام Cache لتسريع الاستجابة (3 دقائق)
            $cacheKey = "meals_category_{$categoryId}_{$locale}";
            $mealsData = Cache::remember($cacheKey, 180, function () use ($categoryId, $locale) {
                // التحقق من وجود الفئة
                $category = Category::find($categoryId);
                if (!$category) {
                    return null;
                }

                $meals = Meal::where('category_id', $categoryId)
                    ->where('is_active', true)
                    ->where('is_available', true)
                    ->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'price', 'image')
                    ->get();

                return $meals->map(function ($meal) use ($locale) {
                    return $this->formatMealData($meal, $locale);
                });
            });

            // إذا لم توجد الفئة
            if ($mealsData === null) {
                \Log::warning('Category not found: ' . $categoryId);
                return response()->json([
                    'error' => 'Category not found',
                    'message' => 'The requested category does not exist'
                ], 404);
            }

            \Log::info('Active and available meals for category ' . $categoryId . ': ' . $mealsData->count());

            return response()->json($mealsData);
        } catch (\Exception $e) {
            \Log::error('Error in getMealsByCategory: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load meals',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get categories for cashier (Arabic names only)
     */
    public function getCategoriesForCashier()
    {
        try {
            // استخدام Cache للكاشير (10 دقائق - أطول لأن البيانات لا تتغير كثيراً)
            $cacheKey = "categories_cashier_ar";
            $categoriesData = Cache::remember($cacheKey, 600, function () {
                $categories = Category::where('is_active', true)
                    ->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'image', 'type')
                    ->get();

                return $categories->map(function ($category) {
                    return $this->formatCategoryData($category, 'ar');
                });
            });

            return response()->json($categoriesData);
        } catch (\Exception $e) {
            \Log::error('Error in getCategoriesForCashier: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load categories',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get meals by category for cashier (Arabic names only)
     */
    public function getMealsByCategoryForCashier($categoryId)
    {
        try {
            \Log::info('Getting meals for category (cashier): ' . $categoryId);

            // استخدام Cache للكاشير (5 دقائق)
            $cacheKey = "meals_cashier_category_{$categoryId}";
            $mealsData = Cache::remember($cacheKey, 300, function () use ($categoryId) {
                // التحقق من وجود الفئة
                $category = Category::find($categoryId);
                if (!$category) {
                    return null;
                }

                $meals = Meal::where('category_id', $categoryId)
                    ->where('is_active', true)
                    ->where('is_available', true)
                    ->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'price', 'image')
                    ->get();

                return $meals->map(function ($meal) {
                    return $this->formatMealData($meal, 'ar');
                });
            });

            // إذا لم توجد الفئة
            if ($mealsData === null) {
                \Log::warning('Category not found: ' . $categoryId);
                return response()->json([
                    'error' => 'Category not found',
                    'message' => 'The requested category does not exist'
                ], 404);
            }

            \Log::info('Active and available meals for category ' . $categoryId . ': ' . $mealsData->count());

            return response()->json($mealsData);
        } catch (\Exception $e) {
            \Log::error('Error in getMealsByCategoryForCashier: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load meals',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * مسح الـ Cache لتحديث البيانات
     */
    public function clearCache()
    {
        try {
            // مسح cache الفئات
            Cache::forget('categories_active_ar');
            Cache::forget('categories_active_en');
            Cache::forget('categories_cashier_ar');

            // مسح cache الوجبات (جميع الفئات)
            $categories = Category::pluck('id');
            foreach ($categories as $categoryId) {
                Cache::forget("meals_category_{$categoryId}_ar");
                Cache::forget("meals_category_{$categoryId}_en");
                Cache::forget("meals_cashier_category_{$categoryId}");
            }

            return response()->json([
                'success' => true,
                'message' => 'تم مسح الـ Cache بنجاح'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error clearing cache: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to clear cache',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
