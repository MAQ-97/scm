@extends('layouts.admin')
@section('content')
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12">
                <!-- ============================================================== -->
                <!-- pageheader  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header" id="top">
                            <h2 class="pageheader-title">Edit Product</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{ route('products.list') }}" class="breadcrumb-link">Products</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">Edit Product</h3>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul style="margin: 0">
                                            @foreach($errors->all() as $err)
                                                <li>{{ $err }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('product.update', ['id' => $product->id]) }}" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Name</label>
                                                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Category</label>
                                                <select class="form-control" id="category" multiple="multiple" name="category_id[]" >
                                                    
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" <?php if (in_array($category->id, $product->categories)) { echo "selected"; } ?>>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Item Type/Subcategory</label>
                                                <select class="form-control" name="type_id[]" multiple="multiple" id="sub_category">
                                                    @foreach($sub_categories as $sub_category)
                                                        <option value="{{ $sub_category->id }}" <?php if (in_array($category->id, $product->types)){ echo 'selected'; } ?>>{{ $sub_category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

{{--                                        <div class="col-md-6">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="col-form-label">Initial quantity in hand</label>--}}
{{--                                                <input type="number" class="form-control" name="qty" value="{{ $product->qty }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Unit of Measurement</label>
                                                <input type="text" class="form-control" name="unit" value="{{ $product->unit }}">
                                            </div>
                                        </div>
{{--                                        <div class="col-md-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="col-form-label">Item Image</label>--}}
{{--                                                <input type="file" name="image" class="form-control" value="{{ $product->image }}">--}}
{{--                                                <br/>--}}
{{--                                                <label>Image: {{ $product->image }}</label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-form-label">Description</label>
                                                <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                                            </div>
                                        </div>


                                    </div>
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Edit Product">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>



    </script>
@endsection
