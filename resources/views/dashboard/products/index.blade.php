@extends('dashboard.layouts.master')

@section('title', 'Dashboard')

@section('style')
    <!-- يمكنك إضافة CSS إضافي هنا -->
@stop

@section('content')
    <div class="page-content">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4 card-title">
                        <i data-feather="monitor"></i> عرض المنتجات
                    </h4>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="ordersTable" class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>اسم القسم</th>
                                                    <th>اسم المنتج</th>
                                                    <th> وصف المنتج</th>
                                                    <th> الكمية المتوفرة</th>
                                                    <th> السعر</th>

                                                    <th>الحالة</th>
                                                    <th>الصورة</th>
                                                    <th>الإجراءات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($data->count() > 0)
                                                    @foreach ($data as $i)
                                                        <tr>
                                                            <td>{{ $i->category->name }}</td>
                                                            <td>{{ $i->name }}</td>
                                                            <td>{{ $i->description }}</td>
                                                            <td>{{ $i->quantity }}</td>
                                                            <td>{{ $i->price }}ج.م</td>

                                                            <td>
                                                                @if ($i->is_active)
                                                                    <span class="badge bg-success">متاح</span>
                                                                @else
                                                                    <span class="badge bg-danger">غير متاح</span>
                                                                @endif
                                                            </td>
                                                            <td>

                                                                @if ($i->image)
                                                                
                                                                    <img src="{{ asset( $i->image) }}"
                                                                        width="50" height="50" alt="صورة المنتج">
                                                                @else
                                                                    <span>لا توجد صورة</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('admin.products.edit', $i->id) }}"
                                                                    class="btn btn-sm btn-primary">تعديل</a>
                                                                <form
                                                                    action="{{ route('admin.products.destroy', $i->id) }}"
                                                                    method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="5">لا توجد بيانات لعرضها.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $data->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- row -->
                </div>
            </div>
        </div>
        {{-- {{ $data->links('vendor.pagination.bootstrap-5') }} --}}
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@stop
