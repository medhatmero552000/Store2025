<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Dashboard\Category;
use App\Models\Dashboard\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::paginate(PAGINATION_COUNT);
        return view('dashboard.products.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('dashboard.products.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $timestamp = Carbon::now()->format('Ymd_His');
                $originalName = $image->getClientOriginalName();
                $newImageName = $timestamp . '_' . $originalName;

                $path = $image->storeAs('uploads/products', $newImageName, 'public');
                $validated['image'] = 'storage/' . $path;
            }

            Product::create($validated);
            DB::commit();
            Alert::toast('تم إضافة القسم بنجاح', 'success');
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::toast(' خطأ لم يتم حفظ القسم  ', 'error');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Product::findOrFail($id);
        $categories = Category::get();
        return view('dashboard.products.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $data = Product::findOrFail($id);
            $validated = $request->validated();
            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إن وُجدت
                if ($data->image && file_exists(public_path($data->image))) {
                    unlink(public_path($data->image));
                }

                // رفع الصورة الجديدة
                $image = $request->file('image');
                $timestamp = Carbon::now()->format('Ymd_His');
                $originalName = $image->getClientOriginalName();
                $newImageName = $timestamp . '_' . $originalName;

                // حفظ الصورة في مجلد محدد داخل storage
                $path = $image->storeAs('uploads/products', $newImageName, 'public');

                // تخزين المسار الجديد داخل قاعدة البيانات
                $validated['image'] = 'storage/' . $path;
            }

            $data->update($validated);
            DB::commit();
            Alert::toast('تم تحديث البيانات بنجاح', 'success');
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::toast('لم يتم التحديث  ', 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $data = Product::findOrFail($id);
            $data->delete();
            DB::commit();
            Alert::toast('تم الحذف  بنجاح', 'success');
            return redirect()->route('admin.products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::toast('لم يتم الحذف  ', 'error');
            return redirect()->back();
        }
    }
}
