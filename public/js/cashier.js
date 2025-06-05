const categoryBtns = document.querySelectorAll('.categoryBtn');
const tableBtns = document.querySelectorAll('.tableBtn');
const closePopUpBtn = document.querySelector('.closePopUp');
const closeTableOptionsBtn = document.querySelector('.closeTableOptions');
const tableOptionCards = document.querySelectorAll('.table-option-card');

// متغيرات لتخزين البيانات محلياً
let allMealsData = {}; // سيحتوي على الوجبات مجمعة حسب الفئة
let isDataLoaded = false; // للتأكد من تحميل البيانات

// دالة جلب جميع البيانات مرة واحدة عند تحميل الصفحة
async function loadAllMealsData() {
    if (isDataLoaded) {
        console.log('البيانات محملة مسبقاً');
        return;
    }

    // إظهار مؤشر التحميل
    const loadingIndicator = document.getElementById('loading-indicator');
    if (loadingIndicator) {
        loadingIndicator.style.display = 'block';
    }

    try {
        console.log('جاري تحميل جميع بيانات الوجبات...');

        // جلب جميع الفئات أولاً
        const categoriesResponse = await fetch('/api/cashier/categories');
        if (!categoriesResponse.ok) {
            throw new Error(`خطأ في جلب الفئات: ${categoriesResponse.status}`);
        }
        const categories = await categoriesResponse.json();

        console.log('تم جلب الفئات:', categories.length);

        // جلب الوجبات لكل فئة
        const mealsPromises = categories.map(async (category) => {
            try {
                const mealsResponse = await fetch(`/api/cashier/meals/${category.id}`);
                if (!mealsResponse.ok) {
                    console.warn(`فشل في جلب وجبات الفئة ${category.id}`);
                    return { categoryId: category.id, meals: [] };
                }
                const meals = await mealsResponse.json();
                return { categoryId: category.id, meals: meals };
            } catch (error) {
                console.error(`خطأ في جلب وجبات الفئة ${category.id}:`, error);
                return { categoryId: category.id, meals: [] };
            }
        });

        // انتظار جلب جميع الوجبات
        const allMealsResults = await Promise.all(mealsPromises);

        // تنظيم البيانات في الكائن
        allMealsData = {};
        let totalMeals = 0;
        allMealsResults.forEach(result => {
            allMealsData[result.categoryId] = result.meals;
            totalMeals += result.meals.length;
        });

        isDataLoaded = true;
        console.log('تم تحميل جميع البيانات بنجاح:', allMealsData);

        // إظهار رسالة نجاح مع الإحصائيات
        myAlert(`تم تحميل ${totalMeals} وجبة من ${categories.length} فئة بنجاح! 🚀`, 'alert-success');

    } catch (error) {
        console.error('خطأ في تحميل البيانات:', error);
        myAlert('خطأ في تحميل بيانات الوجبات. سيتم المحاولة مرة أخرى.', 'alert-warning');
        isDataLoaded = false;
    } finally {
        // إخفاء مؤشر التحميل
        if (loadingIndicator) {
            loadingIndicator.style.display = 'none';
        }
    }
}

const clientInput = document.getElementById('client_id');
const mainClientInput =  document.querySelector('input[name="client"]');
const mealPopUpElementsMealsHolder = document.querySelector('.pop-up.meals .card-body.meals .row');
const mealPopUpElementsSizesHolder = document.querySelector('.pop-up.meals .card-body.sizes .row');
const  mealsPopUp = document.querySelector('.pop-up.meals');

// متغيرات عامة
let orders = {};
let selectedMeal = null;
let currentCategoryType = null;


// Left Side
document.addEventListener('keyup' , (e) => {
    if (e.key == 'Enter') {
        if (clientInput == document.activeElement) {
            fetch(`/clients-get/${clientInput.value}`)
            .then(response => response.json())
            .then(data => {
                if (data.id == undefined) {
                    alert('Client Not Found Create A New One');
                    document.getElementById('add-client-btn').click();
                    return;
                }
                mainClientInput.value = data.id;
                clientInput.value = data.name;
            })
        }
    }
})


// إغلاق النوافذ المنبثقة
document.querySelectorAll('.closePopUp').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.pop-up').forEach(popup => {
            popup.classList.remove('show');
        });

        // إعادة تعيين اختيار الوجبة عند إغلاق نافذة الوجبات
        if (this.closest('.pop-up.meals')) {
            resetMealSelection();
        }
    });
});







// Right Side - تحسين منطق اختيار الفئات
categoryBtns.forEach(btn => {
    btn.addEventListener('click', () => {

        const type = btn.dataset.type;
        const categoryId = btn.dataset.id;
        let tableId;

        // البحث عن الطاولة المحددة
        tableBtns.forEach(button => {
            if (button.classList.contains('wantMeal')) {
                button.classList.remove('wantMeal');
                activeButtons()
                tableId = button.textContent.trim();
            }
        })

        // التحقق من اختيار الطاولة
        if (tableId === undefined) {
            myAlert("يرجى اختيار طاولة أولاً", 'alert-danger')
            return;
        }

        // حفظ البيانات الحالية
        currentTableId = tableId;
        currentCategoryType = type;

        // تنظيف النوافذ المنبثقة
        mealPopUpElementsMealsHolder.innerHTML = '';
        mealPopUpElementsSizesHolder.innerHTML = '';

        // جلب الوجبات من البيانات المحلية (أسرع بكثير!)
        getMealsFromLocalData(categoryId, type, tableId);
    });
});

// دالة للحصول على الوجبات من البيانات المحلية
function getMealsFromLocalData(categoryId, type, tableId) {
    // التحقق من تحميل البيانات
    if (!isDataLoaded) {
        myAlert('جاري تحميل البيانات، يرجى المحاولة مرة أخرى...', 'alert-warning');
        // محاولة تحميل البيانات إذا لم تكن محملة
        loadAllMealsData().then(() => {
            if (isDataLoaded) {
                getMealsFromLocalData(categoryId, type, tableId);
            }
        });
        return;
    }

    // الحصول على الوجبات للفئة المحددة
    const meals = allMealsData[categoryId] || [];

    console.log(`تم جلب ${meals.length} وجبة للفئة ${categoryId} من البيانات المحلية`);

    // إنشاء واجهة اختيار الوجبات
    createMealSelectionInterface(meals, type, tableId);
    mealsPopUp.classList.add('show');
}

// دالة إعادة تحميل البيانات (للاستخدام عند الحاجة)
function reloadMealsData() {
    isDataLoaded = false;
    allMealsData = {};

    // مسح الـ Cache من السيرفر أولاً
    fetch('/api/clear-cache', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            myAlert('تم مسح الـ Cache، جاري إعادة تحميل البيانات...', 'alert-info');
        } else {
            myAlert('تحذير: لم يتم مسح الـ Cache، جاري إعادة تحميل البيانات...', 'alert-warning');
        }
        loadAllMealsData();
    })
    .catch(error => {
        console.error('Error clearing cache:', error);
        myAlert('جاري إعادة تحميل البيانات...', 'alert-info');
        loadAllMealsData();
    });
}

// دالة للحصول على إحصائيات البيانات المحملة
function getDataStats() {
    if (!isDataLoaded) {
        return 'البيانات غير محملة';
    }

    let totalMeals = 0;
    let categoriesCount = Object.keys(allMealsData).length;

    Object.values(allMealsData).forEach(meals => {
        totalMeals += meals.length;
    });

    return `محملة: ${totalMeals} وجبة من ${categoriesCount} فئة`;
}

// دالة إنشاء واجهة اختيار الوجبات
function createMealSelectionInterface(meals, type, tableId) {

    // إنشاء عمود الكمية
    const quantityCol = document.createElement('div');
    quantityCol.className = 'col-md-4';

    const quantityLabel = document.createElement('label');
    quantityLabel.setAttribute('for', 'quantity');
    quantityLabel.textContent = 'الكمية';

    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.name = 'quantity';
    quantityInput.id = 'quantity';
    quantityInput.className = 'form-control';
    quantityInput.value = '1';
    quantityInput.min = '1';

    quantityCol.appendChild(quantityLabel);
    quantityCol.appendChild(quantityInput);

    // إنشاء عمود الحجم
    const sizeCol = document.createElement('div');
    sizeCol.className = 'col-md-4';

    const sizeLabel = document.createElement('label');
    sizeLabel.textContent = 'الحجم';

    const sizeContainer = document.createElement('div');
    sizeContainer.className = 'd-flex gap-2';

    const sizes = [
        { size: 'sm', text: 'صغير' },
        { size: 'md', text: 'متوسط' },
        { size: 'lg', text: 'كبير' },
        { size: 'single', text: 'فردي' },
        { size: 'double', text: 'مزدوج' }
    ];

    sizes.forEach((size, index) => {
        const sizeBox = document.createElement('div');
        sizeBox.className = 'size-box';
        sizeBox.dataset.size = size.size;

        const sizeBtn = document.createElement('button');
        sizeBtn.type = 'button';
        sizeBtn.className = index === 0 ? 'btn btn-primary size-btn selected' : 'btn btn-outline-primary size-btn';
        sizeBtn.textContent = size.text;
        sizeBtn.dataset.size = size.size;

        // إضافة event listener لاختيار الحجم
        sizeBtn.addEventListener('click', () => {
            // إزالة التحديد من جميع الأزرار
            sizeContainer.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('btn-primary', 'selected');
                btn.classList.add('btn-outline-primary');
            });

            // إضافة التحديد للزر المختار
            sizeBtn.classList.remove('btn-outline-primary');
            sizeBtn.classList.add('btn-primary', 'selected');

            // تحديث القيمة المخفية
            sizeInput.value = size.size;
        });

        sizeBox.appendChild(sizeBtn);
        sizeContainer.appendChild(sizeBox);
    });

    const sizeInput = document.createElement('input');
    sizeInput.type = 'hidden';
    sizeInput.name = 'size';
    sizeInput.id = 'size';
    sizeInput.value = 'sm'; // القيمة الافتراضية

    sizeCol.appendChild(sizeLabel);
    sizeCol.appendChild(sizeContainer);
    sizeCol.appendChild(sizeInput);



    const rowButton = document.createElement('div');
    rowButton.className = 'row mt-3';

    // إنشاء عمود زر الإضافة
    const buttonCol = document.createElement('div');
    buttonCol.className = 'col-md-4 d-flex align-items-end';

    const addButton = document.createElement('button');
    addButton.type = 'button';
    addButton.className = 'btn btn-success addMealBtn w-100';
    addButton.textContent = 'إضافة للطلب';

    buttonCol.appendChild(addButton);
    rowButton.appendChild(buttonCol);

    // إضافة الأعمدة إلى حامل الأحجام
    mealPopUpElementsSizesHolder.appendChild(quantityCol);
    mealPopUpElementsSizesHolder.appendChild(sizeCol);
    mealPopUpElementsSizesHolder.appendChild(rowButton);


    // إنشاء قائمة الوجبات
    meals.forEach(meal => {
        // إنشاء بطاقة الوجبة
        const colMd2 = document.createElement('div');
        colMd2.className = 'col-md-2 myHolder';

        const card = document.createElement('div');
        card.className = 'card meal-card';
        card.dataset.mealId = meal.id;
        card.style.cursor = 'pointer';

        const cardBody = document.createElement('div');
        cardBody.className = 'card-body text-center';

        const h5 = document.createElement('h5');
        h5.className = 'card-title';
        h5.textContent = meal.name;


        cardBody.appendChild(h5);
        card.appendChild(cardBody);
        colMd2.appendChild(card);
        mealPopUpElementsMealsHolder.appendChild(colMd2);

        // إضافة event listener لاختيار الوجبة
        card.addEventListener('click', () => {
            // إزالة التحديد من جميع الوجبات
            document.querySelectorAll('.meal-card').forEach(c => {
                c.classList.remove('selected', 'border-primary');
            });

            // إضافة التحديد للوجبة المختارة
            card.classList.add('selected', 'border-primary');
            selectedMeal = meal;

            console.log('Selected meal:', selectedMeal);
        });
    });

    // إضافة event listener لزر الإضافة
    addButton.addEventListener('click', () => {
        if (!selectedMeal) {
            myAlert('يرجى اختيار وجبة أولاً', 'alert-warning');
            return;
        }

        const quantity = parseInt(quantityInput.value) || 1;
        const size = sizeInput.value;


        // إضافة الوجبة إلى الطلب
        addMealToOrder(selectedMeal, quantity, size, tableId, type);

        // إغلاق النافذة المنبثقة
        mealsPopUp.classList.remove('show');

        // إعادة تعيين النموذج
        resetMealSelection();
    });
}

// دالة إضافة الوجبة إلى الطلب
function addMealToOrder(meal, quantity, size, tableId, type) {
    console.log('Adding meal to order:', { meal, quantity, size, tableId, type });

    // التحقق من إمكانية إضافة طلب جديد للطاولة
    if (!addNewOrderToTable(tableId)) {
        return; // المستخدم ألغى إضافة الطلب
    }

    // التحقق من وجود طلب للطاولة أو إنشاء جديد
    if (!orders[tableId]) {
        orders[tableId] = {
            client_id: mainClientInput.value ? mainClientInput.value : null,
            table_id: tableId,
            items: []
        };
    }

    // البحث عن الوجبة الموجودة بنفس المعرف والحجم
    const existingItemIndex = orders[tableId].items.findIndex(item =>
        item.meal_id === meal.id && item.size === size
    );

    if (existingItemIndex !== -1) {
        // إذا كانت الوجبة موجودة، زيادة الكمية
        orders[tableId].items[existingItemIndex].quantity += quantity;
        myAlert(`تم زيادة كمية ${meal.name} (${getSizeText(size)}) إلى ${orders[tableId].items[existingItemIndex].quantity}`, 'alert-success');
    } else {
        // إضافة وجبة جديدة
        orders[tableId].items.push({
            meal_id: meal.id,
            meal_name: meal.name,
            meal_price: meal.price || 0,
            quantity: quantity,
            size: size,
            type: type
        });
        myAlert(`تم إضافة ${meal.name} (${getSizeText(size)}) × ${quantity} للطلب`, 'alert-success');
    }

    console.log('Updated orders:', orders);

    // تحديث المؤشر البصري للطاولة
    updateTableVisualIndicator(tableId);

    // لا نرسل للسيرفر فوراً، بل ننتظر حتى يضغط المستخدم على الدفع
    // sendOrderToServer(tableId);

    // طباعة في المطبعة المناسبة
    if (type === 'food') {
        console.log('Printing in food printer');
        myAlert('تم الطباعة في مطبعة المطبخ', 'alert-info');
    } else if (type === 'drink') {
        console.log('Printing in drink printer');
        myAlert('تم الطباعة في مطبعة البار', 'alert-info');
    }
}

// دالة إرسال الطلب للسيرفر
async function sendOrderToServer(tableId) {
    if (!orders[tableId] || orders[tableId].items.length === 0) {
        console.log('No order to send for table:', tableId);
        return;
    }

    const orderData = {
        client_id: orders[tableId].client_id,
        order_type: 'dine_in',
        table_number: tableId.toString(),
        notes: `طلب من الطاولة ${tableId}`,
        items: orders[tableId].items.map(item => ({
            meal_id: item.meal_id,
            quantity: item.quantity,
            special_instructions: item.size ? `الحجم: ${getSizeText(item.size)}` : null
        })),
        fromJs: true
    };

    try {
        console.log('Sending order to server:', orderData);

        const response = await fetch('/orders', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify(orderData)
        });

        const result = await response.json();

        if (response.ok && result.success !== false) {
            console.log('Order sent successfully:', result);
            myAlert(`تم إرسال طلب الطاولة ${tableId} بنجاح`, 'alert-success');

            // مسح الطلب من الذاكرة المحلية بعد الإرسال الناجح
            delete orders[tableId];

            return result;
        } else {
            throw new Error(result.message || 'فشل في إرسال الطلب');
        }
    } catch (error) {
        console.error('Error sending order:', error);
        myAlert(`خطأ في إرسال طلب الطاولة ${tableId}: ${error.message}`, 'alert-danger');
        throw error;
    }
}

// دالة الحصول على نص الحجم
function getSizeText(size) {
    const sizeMap = {
        'sm': 'صغير',
        'md': 'متوسط',
        'lg': 'كبير',
        'single': 'فردي',
        'double': 'مزدوج'
    };
    return sizeMap[size] || size;
}

// دالة عرض الطلبات الحالية للطاولة
function showCurrentOrder(tableId) {
    if (!orders[tableId] || orders[tableId].items.length === 0) {
        myAlert(`لا يوجد طلب حالي للطاولة ${tableId}`, 'alert-info');
        return;
    }

    let orderSummary = `طلب الطاولة ${tableId}:\n\n`;
    let total = 0;

    orders[tableId].items.forEach((item, index) => {
        const itemTotal = item.meal_price * item.quantity;
        total += itemTotal;
        orderSummary += `${index + 1}. ${item.meal_name}`;
        if (item.size) {
            orderSummary += ` (${getSizeText(item.size)})`;
        }
        orderSummary += ` × ${item.quantity} = ${itemTotal.toFixed(2)} ريال\n`;
    });

    orderSummary += `\nالإجمالي: ${total.toFixed(2)} ريال`;
    orderSummary += `\n\nهل تريد حذف أي عنصر؟ (أدخل رقم العنصر أو اضغط إلغاء)`;

    const choice = prompt(orderSummary);

    if (choice && !isNaN(choice)) {
        const itemIndex = parseInt(choice) - 1;
        if (itemIndex >= 0 && itemIndex < orders[tableId].items.length) {
            removeItemFromOrder(tableId, itemIndex);
        } else {
            myAlert('رقم العنصر غير صحيح', 'alert-warning');
        }
    }
}

// دالة حذف عنصر من الطلب
function removeItemFromOrder(tableId, itemIndex) {
    if (!orders[tableId] || !orders[tableId].items[itemIndex]) {
        return;
    }

    const removedItem = orders[tableId].items[itemIndex];
    orders[tableId].items.splice(itemIndex, 1);

    myAlert(`تم حذف ${removedItem.meal_name} من طلب الطاولة ${tableId}`, 'alert-warning');

    // إذا لم تعد هناك عناصر، احذف الطلب كاملاً
    if (orders[tableId].items.length === 0) {
        delete orders[tableId];
    }

    // تحديث المؤشر البصري
    updateTableVisualIndicator(tableId);
}

// دالة تحديث المؤشر البصري للطاولة
function updateTableVisualIndicator(tableId) {
    const tableBtn = Array.from(tableBtns).find(btn => btn.textContent.trim() === tableId.toString());

    if (tableBtn) {
        // إزالة جميع الكلاسات السابقة
        tableBtn.classList.remove('has-order', 'no-order', 'payment-success', 'default-state');

        // إضافة الكلاس المناسب حسب وجود طلب
        if (orders[tableId] && orders[tableId].items.length > 0) {
            tableBtn.classList.add('has-order'); // أحمر للطاولات التي عليها أشخاص
        } else {
            tableBtn.classList.add('default-state'); // أصفر للحالة الافتراضية
        }
    }
}

// دالة إظهار نجاح الدفع
function showPaymentSuccess(tableId) {
    const tableBtn = Array.from(tableBtns).find(btn => btn.textContent.trim() === tableId.toString());

    if (tableBtn) {
        // إزالة جميع الكلاسات
        tableBtn.classList.remove('has-order', 'no-order', 'default-state');

        // إضافة كلاس نجاح الدفع (أخضر لبضع ثوان ثم أصفر)
        tableBtn.classList.add('payment-success');

        // بعد 3 ثوان، تحويل إلى اللون الأصفر
        setTimeout(() => {
            tableBtn.classList.remove('payment-success');
            tableBtn.classList.add('default-state');
        }, 3000);
    }
}

// دالة إضافة طلب جديد لنفس الطاولة
function addNewOrderToTable(tableId) {
    // التحقق من وجود طلب سابق للطاولة
    if (orders[tableId] && orders[tableId].items.length > 0) {
        const confirmAdd = confirm(`الطاولة ${tableId} لديها طلب موجود. هل تريد إضافة طلب جديد؟`);
        if (!confirmAdd) {
            return false;
        }
    }

    // إذا لم يكن هناك طلب، إنشاء طلب جديد
    if (!orders[tableId]) {
        orders[tableId] = {
            client_id: null,
            table_id: tableId,
            items: []
        };
    }

    return true;
}

// دالة إعادة تعيين اختيار الوجبة
function resetMealSelection() {
    selectedMeal = null;

    // إزالة التحديد من جميع الوجبات
    document.querySelectorAll('.meal-card').forEach(card => {
        card.classList.remove('selected', 'border-primary');
    });

    // إعادة تعيين الكمية والحجم
    const quantityInput = document.getElementById('quantity');
    const sizeInput = document.getElementById('size');

    if (quantityInput) quantityInput.value = '1';
    if (sizeInput) sizeInput.value = 'sm';

    // إعادة تعيين أزرار الحجم
    document.querySelectorAll('.size-btn').forEach((btn, index) => {
        btn.classList.remove('btn-primary', 'selected');
        btn.classList.add('btn-outline-primary');

        if (index === 0) {
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-primary', 'selected');
        }
    });
}



tableBtns.forEach(btn => {
    btn.addEventListener('click', (e) => {
        const tableId = btn.textContent.trim();

        if (btn.classList.contains('clicked')) {
            if (btn.classList.contains('wantMeal')) {
                activeButtons();
                btn.classList.remove('wantMeal');
            } else {
                btn.classList.add('lets-pay')
                completeOrder(tableId);
            }
            btn.classList.remove('clicked');
            btn.classList.add('success');
            btn.click();
        } else if (btn.classList.contains('success')) {
            setTimeout(() => {
                btn.classList.remove('success');
            }, 2000);
        } else {
            // التحقق من وجود طلب موجود للطاولة
            if (orders[tableId] && orders[tableId].items.length > 0) {
                // إظهار خيارات للمستخدم
                showTableOptions(tableId, btn);
            } else {
                // طاولة فارغة - إضافة طلب جديد
                selectTableForNewOrder(tableId, btn, e);
            }
        }
    });
});


function disableButtons(e) {
    tableBtns.forEach(btn => {
        if (btn != e.target) {
            btn.disabled = true;
        }
    });
}

function activeButtons() {
    tableBtns.forEach(btn => {
        btn.disabled = false;
    });
}

// دالة إظهار خيارات الطاولة التي لديها طلب موجود
function showTableOptions(tableId, btn) {
    // حفظ معرف الطاولة والزر للاستخدام لاحقاً
    window.currentSelectedTable = { id: tableId, btn: btn };

    // إظهار نافذة الخيارات
    document.querySelector('.pop-up.table-options').classList.add('show');
}

// دالة اختيار طاولة لطلب جديد
function selectTableForNewOrder(tableId, btn, e) {
    btn.classList.add('clicked');
    btn.classList.add('wantMeal');
    btn.classList.add('lastClicked');
    document.querySelector('input[name="table_id"]').value = tableId;

    if (e) {
        disableButtons(e);
    } else {
        // إذا لم يكن هناك event، نحتاج لتعطيل الأزرار الأخرى يدوياً
        tableBtns.forEach(otherBtn => {
            if (otherBtn !== btn) {
                otherBtn.disabled = true;
            }
        });
    }

    myAlert(`تم اختيار الطاولة ${tableId}. اختر الفئة لإضافة الوجبات.`, 'alert-info');
}


function myAlert(msg, type = 'alert-success') {
    // التأكد من وجود حاوي التنبيهات
    let alertsContainer = document.querySelector('.alerts');
    if (!alertsContainer) {
        alertsContainer = document.createElement('div');
        alertsContainer.className = 'alerts';
        document.body.appendChild(alertsContainer);
    }

    const alert = document.createElement('div');
    alert.classList.add('alert', type, 'alert-home', 'alert-dismissible');
    alert.innerHTML = `
        ${msg}
        <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
    `;

    alertsContainer.appendChild(alert);

    // إزالة التنبيه تلقائياً بعد 5 ثوان
    setTimeout(() => {
        if (alert.parentElement) {
            alert.remove();
        }
    }, 5000);
}

// Event listeners لنافذة خيارات الطاولة
if (closeTableOptionsBtn) {
    closeTableOptionsBtn.addEventListener('click', () => {
        document.querySelector('.pop-up.table-options').classList.remove('show');
    });
}

// Event listeners لبطاقات الخيارات
tableOptionCards.forEach(card => {
    card.addEventListener('click', () => {
        const action = card.dataset.action;
        const tableData = window.currentSelectedTable;

        if (!tableData) {
            myAlert('خطأ: لم يتم تحديد طاولة', 'alert-danger');
            return;
        }

        // إخفاء نافذة الخيارات
        document.querySelector('.pop-up.table-options').classList.remove('show');

        // تنفيذ الإجراء المطلوب
        switch(action) {
            case 'add-order':
                selectTableForNewOrder(tableData.id, tableData.btn, null);
                break;
            case 'view-order':
                showCurrentOrder(tableData.id);
                break;
            case 'complete-payment':
                completeOrder(tableData.id);
                break;
            case 'cancel':
                // لا نفعل شيء
                break;
            default:
                myAlert('إجراء غير معروف', 'alert-warning');
                break;
        }

        // مسح البيانات المؤقتة
        window.currentSelectedTable = null;
    });
});



