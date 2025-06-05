@extends('layouts.app')

@section('page_name', __('meals.create_meal'))

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">{{ __('meals.create_new_meal') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('meals.store') }}" method="POST" enctype="multipart/form-data" id="mealForm">
                        @csrf

                        <!-- معلومات الوجبة الأساسية -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_ar" class="form-label">{{ __('meals.meal_name_ar') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" class="form-control" id="name_ar" value="{{ old('name_ar') }}" required placeholder="أدخل اسم الوجبة بالعربية">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_en" class="form-label">{{ __('meals.meal_name_en') }} <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" class="form-control" id="name_en" value="{{ old('name_en') }}" required placeholder="Enter meal name in English">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="price" class="form-label">{{ __('meals.price') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="price" class="form-control" id="price" value="{{ old('price') }}" step="0.01" min="0" required placeholder="{{ __('meals.placeholders.enter_price') }}">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">{{ __('meals.category') }} <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select" id="category_id" required>
                                        <option value="">{{ __('meals.placeholders.select_category') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="preparation_time" class="form-label">{{ __('meals.preparation_time') }} ({{ __('meals.minutes') }})</label>
                                    <input type="number" name="preparation_time" class="form-control" id="preparation_time" value="{{ old('preparation_time') }}" min="1" placeholder="{{ __('meals.placeholders.enter_preparation_time') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Sizes --}}
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="size" class="form-label">{{ __('meals.size') }}</label>
                                    <select name="size" class="form-select" id="size">
                                        <option value="">{{ __('meals.placeholders.select_size') }}</option>
                                            <option value="sm" {{ old('size') == 'sm' ? 'selected' : '' }}>{{ __('meals.sizes.sm') }}</option>
                                            <option value="md" {{ old('size') == 'md' ? 'selected' : '' }}>{{ __('meals.sizes.md') }}</option>
                                            <option value="lg" {{ old('size') == 'lg' ? 'selected' : '' }}>{{ __('meals.sizes.lg') }}</option>
                                            <option value="single" {{ old('size') == 'single' ? 'selected' : '' }}>{{ __('meals.sizes.single') }}</option>
                                            <option value="double" {{ old('size') == 'double' ? 'selected' : '' }}>{{ __('meals.sizes.double') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}



                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description_ar" class="form-label">{{ __('meals.description_ar') }}</label>
                                    <textarea name="description_ar" class="form-control" id="description_ar" rows="3" placeholder="أدخل وصف الوجبة بالعربية">{{ old('description_ar') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description_en" class="form-label">{{ __('meals.description_en') }}</label>
                                    <textarea name="description_en" class="form-control" id="description_en" rows="3" placeholder="Enter meal description in English">{{ old('description_en') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('meals.meal_image') }}</label>
                                    <input type="file" name="image" class="form-control" id="image" accept="image/*">
                                    <small class="text-muted">{{ __('meals.image_help') }}</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('meals.availability') }}</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_available">{{ __('meals.available') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">{{ __('meals.status') }}</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">{{ __('meals.active') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- قسم المكونات -->
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-3">
                                    <i class="fas fa-list-ul me-2"></i>
                                    {{ __('meals.ingredients') }}
                                </h5>
                                <p class="text-muted mb-3">{{ __('meals.ingredients_help') }}</p>
                            </div>
                        </div>

                        <div id="ingredients-container">
                            <!-- سيتم إضافة المكونات هنا ديناميكياً -->
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <button type="button" class="btn btn-outline-primary" id="add-ingredient-btn" onclick="addIngredient()">
                                    <i class="fas fa-plus me-2"></i>
                                    {{ __('meals.add_ingredient') }}
                                </button>
                            </div>
                        </div>

                        <!-- أزرار الحفظ والإلغاء -->
                        <hr class="my-4">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success me-2">
                                    <i class="fas fa-save me-2"></i>
                                    {{ __('meals.create_meal') }}
                                </button>
                                <a href="{{ route('meals.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>
                                    {{ __('app.cancel') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template للمكون الواحد -->
<template id="ingredient-template">
    <div class="ingredient-row mb-3" data-index="0">
        <div class="row align-items-end">
            <div class="col-md-5">
                <label class="form-label">{{ __('meals.ingredient') }}</label>
                <select name="ingredients[0][id]" class="form-select ingredient-select">
                    <option value="">{{ __('meals.select_ingredient') }}</option>
                    @foreach($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}" data-unit="{{ $ingredient->unit }}" data-stock="{{ $ingredient->stock_quantity }}">
                            {{ $ingredient->name }} ({{ __('ingredients.stock') }}: {{ $ingredient->stock_quantity }} {{ $ingredient->unit }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">{{ __('meals.quantity') }}</label>
                <div class="input-group">
                    <input type="number" name="ingredients[0][quantity]" class="form-control ps-3 quantity-input" step="0.01" min="0.01" placeholder="0.00">
                    <span class="input-group-text unit-display" style="position: absolute;left: 0;width: fit-content;display: block;">{{ __('meals.unit') }}</span>
                </div>
            </div>
            <div class="col-md-3">
                <label class="form-label">{{ __('meals.notes') }}</label>
                <input type="text" name="ingredients[0][notes]" class="form-control" placeholder="{{ __('meals.optional_notes') }}">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-ingredient-btn" title="{{ __('meals.remove_ingredient') }}">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
</template>

@endsection

<style>
.ingredient-row {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    transition: all 0.3s ease;
}

.ingredient-row:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-color: #007bff;
}

.ingredient-row .form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
}

.ingredient-select:focus,
.quantity-input:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.remove-ingredient-btn {
    transition: all 0.3s ease;
}

.remove-ingredient-btn:hover {
    transform: scale(1.1);
}

#add-ingredient-btn {
    border: 2px dashed #007bff;
    background: transparent;
    transition: all 0.3s ease;
}

#add-ingredient-btn:hover {
    background: #007bff;
    color: white;
    border-style: solid;
}

.is-invalid {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

.unit-display {
    background: #e9ecef;
    border-color: #ced4da;
    font-weight: 600;
    min-width: 80px;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let ingredientIndex = 0;
        const container = document.getElementById('ingredients-container');
        const addBtn = document.getElementById('add-ingredient-btn');
        const template = document.getElementById('ingredient-template');
    
        // إضافة مكون جديد
        function addIngredient() {
            const clone = template.content.cloneNode(true);
            const row = clone.querySelector('.ingredient-row');
    
            // تحديث الفهارس
            row.setAttribute('data-index', ingredientIndex);
            row.querySelectorAll('select, input').forEach(element => {
                const name = element.getAttribute('name');
                if (name) {
                    element.setAttribute('name', name.replace('[0]', `[${ingredientIndex}]`));
                }
            });
    
            // إضافة تأثير الظهور
            row.style.opacity = '0';
            row.style.transform = 'translateY(-20px)';
            container.appendChild(clone);
    
            // تأثير الظهور التدريجي
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, 10);
    
            // إضافة event listeners للعناصر الجديدة
            setupIngredientRow(row);
    
            // تحديث عداد المكونات
            updateIngredientsCount();
    
            ingredientIndex++;
        }
    
        // إعداد صف المكون
        function setupIngredientRow(row) {
            const select = row.querySelector('.ingredient-select');
            const quantityInput = row.querySelector('.quantity-input');
            const unitDisplay = row.querySelector('.unit-display');
            const removeBtn = row.querySelector('.remove-ingredient-btn');
    
            // تحديث الوحدة عند تغيير المكون
            select.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const unit = selectedOption.getAttribute('data-unit') || '{{ __("meals.unit") }}';
                const stock = selectedOption.getAttribute('data-stock') || '0';
    
                unitDisplay.textContent = unit;
                quantityInput.setAttribute('max', stock);
                quantityInput.setAttribute('title', `{{ __('meals.max_available') }}: ${stock} ${unit}`);
            });
    
            // التحقق من الكمية المتاحة
            quantityInput.addEventListener('input', function() {
                const selectedOption = select.options[select.selectedIndex];
                const maxStock = parseFloat(selectedOption.getAttribute('data-stock')) || 0;
                const currentValue = parseFloat(this.value) || 0;
    
                if (currentValue > maxStock) {
                    this.setCustomValidity(`{{ __('meals.quantity_exceeds_stock') }} (${maxStock})`);
                    this.classList.add('is-invalid');
                } else {
                    this.setCustomValidity('');
                    this.classList.remove('is-invalid');
                }
            });
    
            // حذف المكون
            removeBtn.addEventListener('click', function() {
                // تأثير الاختفاء
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '0';
                row.style.transform = 'translateX(-100%)';
    
                setTimeout(() => {
                    row.remove();
                    updateIngredientIndexes();
                    updateIngredientsCount();
                }, 300);
            });
        }
    
        // تحديث فهارس المكونات بعد الحذف
        function updateIngredientIndexes() {
            const rows = container.querySelectorAll('.ingredient-row');
            rows.forEach((row, index) => {
                row.setAttribute('data-index', index);
                row.querySelectorAll('select, input').forEach(element => {
                    const name = element.getAttribute('name');
                    if (name) {
                        const newName = name.replace(/\[\d+\]/, `[${index}]`);
                        element.setAttribute('name', newName);
                    }
                });
            });
            ingredientIndex = rows.length;
        }
    
        // تحديث عداد المكونات
        function updateIngredientsCount() {
            const count = container.querySelectorAll('.ingredient-row').length;
            const countElement = document.querySelector('#ingredients-count');
            if (countElement) {
                countElement.textContent = count;
            }
    
            // تحديث نص الزر
            const addBtnText = addBtn.querySelector('.btn-text');
            if (addBtnText) {
                addBtnText.textContent = count === 0 ?
                    '{{ __("meals.add_first_ingredient") }}' :
                    '{{ __("meals.add_another_ingredient") }}';
            }
        }
    
        // حساب التكلفة التقديرية
        function calculateEstimatedCost() {
            let totalCost = 0;
            const rows = container.querySelectorAll('.ingredient-row');
    
            rows.forEach(row => {
                const select = row.querySelector('.ingredient-select');
                const quantityInput = row.querySelector('.quantity-input');
    
                if (select.value && quantityInput.value) {
                    const selectedOption = select.options[select.selectedIndex];
                    const pricePerUnit = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    const quantity = parseFloat(quantityInput.value) || 0;
                    totalCost += pricePerUnit * quantity;
                }
            });
    
            const costElement = document.querySelector('#estimated-cost');
            if (costElement) {
                costElement.textContent = totalCost.toFixed(2);
            }
        }
    
        // إضافة مكون عند الضغط على الزر
        addBtn.addEventListener('click', addIngredient);
    
        // التحقق من النموذج قبل الإرسال
        document.getElementById('mealForm').addEventListener('submit', function(e) {
            // لا نحتاج للتحقق من المكونات لأنها ليست إلزامية
            return true;
        });
    });
</script>