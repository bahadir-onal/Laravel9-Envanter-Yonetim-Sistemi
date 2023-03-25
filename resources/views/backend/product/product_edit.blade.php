@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Supplier Add </h4><br><br>
                        
                        <form method="post" action="{{ route('product.update') }}" id="myForm" >
                            @csrf

                            <input name="id" type="hidden" value="{{ $product->id }}">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                                <div class="form-group col-sm-10">
                                    <input name="name" class="form-control" type="text" value="{{ $product->name }}">
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name</label>
                                <div class="form-group col-sm-10">
                                    <select name="supplier_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Select supplier name</option>
                                        @foreach($supplier as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $product->supplier_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Unit Name</label>
                                <div class="form-group col-sm-10">
                                    <select name="unit_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Select unit name</option>
                                        @foreach($unit as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $product->unit_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="form-group col-sm-10">
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Select category name</option>
                                        @foreach($category as $item)
                                            <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- end row -->

                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                        </form>
                        
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>




<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },
                supplier_id: {
                    required : true,
                },
                unit_id: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
            },
            messages :{
                name: {
                    required : 'Please enter your name',
                },
                supplier_id: {
                    required : 'Please enter your supplier name',
                },
                unit_id: {
                    required : 'Please enter your unit name',
                },
                category_id: {
                    required : 'Please enter your category name',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

@endsection 
