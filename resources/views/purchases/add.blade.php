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
                            <h2 class="pageheader-title">Add Purcahses</h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="{{ route('products.list') }}"
                                                                       class="breadcrumb-link">ManuToSupp</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add Purchases</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="section-block" id="basicform">
                            <h3 class="section-title">Supplies</h3>
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
                                <form action="{{ route('supplies.create') }}" method="post"
                                      enctype="multipart/form-data">
                                    <div class="row" id="main_row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="col-form-label">Select Supplier</label>
                                                    <br/>
                                                    <select class="form-control" name="supplier_id" required>
                                                        @foreach($suppliers as $supplier)
                                                            <option
                                                                value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Product</label>
                                                <br/>
                                                <select class="form-control" name="product_id[]" required>
                                                    @foreach($products as $product_color)
                                                        <option
                                                            value="{{ $product_color->id }}">{{ $product_color->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Quantity</label>
                                                <input type="text" class="form-control" name="quantity[]" value="{{old('quantity')}}" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-md-offset-6">
                                        <div class="form-group">
                                            <button class="btn btn-success" id="add_row" style="font-size: 14px;font-weight: bold">+</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Add Purchases">
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
    <script type="text/javascript">
        $(document).ready(function () {
           $('#add_row').click(function (e) {
               e.preventDefault();
               var row = '<div class="col-md-12 extra_row" style="width:100%"><div class="row"> <div class="col-md-5">\
                                            <div class="form-group" id="">\
                                                <label class="col-form-label">Select Product</label>\
                                                <br/>\
                                                <select class="form-control" id="category" name="product_id[]">\
                                                    @foreach($products as $product_color)\
                                                        <option\
                                                            value="{{ $product_color->id }}">{{ $product_color->name }}</option>\
                                                    @endforeach\
                                                </select>\
                                            </div>\
                                        </div>\
\
                                        <div class="col-md-6" id="quantity_row">\
                                            <div class="form-group">\
                                                <label class="col-form-label">Quantity</label>\
                                                <input type="text" class="form-control" name="quantity[]">\
                                            </div>\
                                        </div>\
                                        <div class="col-md-1">\
                                            <div class="form-group" style="height:100%">\
                                                <button class="btn btn-danger delete_row" style="font-size: 14px;font-weight: bold;margin-top:54%">-</button>\
                                            </div>\
                                        </div></div></div>';
               $('#main_row').append(row);
               $(".delete_row").click(function(e){
                   e.preventDefault();
                  $(this).parents('.extra_row').remove();
               });
           });
        });

    </script>
@endsection
