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

                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Date</label>
                                    <input class="form-control example-date-input" type="date" name="date" id="date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Purchase No</label>
                                    <input class="form-control example-date-input" type="text" name="purchase_no" id="purchase_no">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Supplier Name</label>
                                    <select id="supplier_id" name="supplier_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Select supplier name</option>
                                        @foreach($supplier as $supp)
                                            <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                        @endforeach
                                            </select>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Category Name</label>
                                    <select id="category_id" name="category_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Select category name</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Product Name</label>
                                    <select id="product_id" name="product_id" class="form-select" aria-label="Default select example">
                                        <option selected="">Select product name</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label" style="margin-top:44px;"> </label>
                                    <input type="submit" class="btn btn-info btn-rounded waves-effect waves-light" value="Add More">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(document).on('change','#supplier_id',function(){
            var supplier_id = $(this).val();
            $.ajax({
                url:"{{ route('get-category') }}",
                type: "GET",
                data:{supplier_id:supplier_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.category_id+' "> '+v.category.name+'</option>';
                    });
                    $('#category_id').html(html);
                }
            })
        });
    });
</script>

<script type="text/javascript">
    $(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{ route('get-product') }}",
                type: "GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '<option value="">Select product</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    });
</script>

@endsection 
