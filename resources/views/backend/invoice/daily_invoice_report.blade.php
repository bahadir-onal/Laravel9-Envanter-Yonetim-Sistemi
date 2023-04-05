@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Daily Invoice Report </h4><br><br>
                    <form method="" action="" target="_blank" id="myForm">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">Start Date</label>
                                    <input class="form-control example-date-input" type="date" name="start_date" id="start_date">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label">End Date</label>
                                    <input class="form-control example-date-input" type="date" name="end_date" id="end_date">
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="md-3">
                                    <label for="example-text-input" class="form-label" style="margin-top: 27%;"> </label>
                                    <button class="btn btn-info" type="submit"> Search </button>
                                </div>
                            </div>

                        </div>
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
                start_date: {
                    required : true,
                }, 
                end_date: {
                    required : true,
                },
            },
            messages :{
                start_date: {
                    required : 'Please enter your start date',
                },
                end_date: {
                    required : 'Please enter your end date',
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
