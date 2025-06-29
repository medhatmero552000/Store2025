@extends('dashboard.layouts.master')

@section('title', 'تعديل المنتج')

@section('content')

    <div class="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4 card-title">تعديل المنتج</h4>

                        <form action="{{ route('admin.products.update', $data->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- الاسم والوصف --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="name" class="form-label">اسم المنتج</label>
                                    <input type="hidden" name="id" value="{{ $data->id }}">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $data->name) }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <div class="col-md-6">
                                    <label for="description" class="form-label">وصف المنتج</label>
                                    <textarea name="description" class="form-control" rows="3">{{ old('description', $data->description) }}</textarea>
                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label d-block">الصورة الحالية</label>
                                    <img src="{{ asset($data->image) }}" alt="صورة المنتج"
                                        class="rounded-3 shadow img-fluid"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                            </div>

                            {{-- القسم - السعر - الكمية - الصورة --}}
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label for="category_id" class="form-label">القسم التابع له</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">-- اختر قسماً --</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $data->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->translateOrDefault()?->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                <div class="col-md-3">
                                    <label for="price" class="form-label">السعر</label>
                                    <input type="number" name="price" step="0.01" class="form-control"
                                        value="{{ old('price', $data->price) }}">
                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                </div>

                                <div class="col-md-3">
                                    <label for="quantity" class="form-label">الكمية</label>
                                    <input type="number" name="quantity" class="form-control"
                                        value="{{ old('quantity', $data->quantity) }}">
                                    <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                </div>

                                <div class="col-md-3">
                                    <label for="image" class="form-label">صورة جديدة (اختياري)</label>
                                    <input type="file" name="image" class="form-control">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>
                            </div>

                            {{-- حالة التفعيل --}}
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="is_active" class="form-label">حالة التفعيل</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                            {{ old('is_active', $data->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">مفعل</label>
                                    </div>
                                </div>
                            </div>

                            {{-- زر الحفظ --}}
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">تحديث المنتج</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
