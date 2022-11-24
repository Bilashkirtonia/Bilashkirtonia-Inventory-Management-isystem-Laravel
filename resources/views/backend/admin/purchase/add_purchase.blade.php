@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editProduct)?"Edit Product":"Add Product " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editProduct)?"Edit Product":"Add Product " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editProduct)?"Edit Product":"Add Product " }}
                  
                  <a href="{{ route('view_purchase') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-10 m-auto">
                    <div class="card p-4">
                        
                            <div class="row">

                              <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                   <input type="date" name="date" id="date" class="form-control">
                                    <font style="color: red">{{ ($errors->has('date'))?($errors->first('date')):" " }}</font>
                                 </div>
                              </div>
  
                              <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Purchase No</label>
                                   <input type="text" name="purchase_no" id="purchase_no" class="form-control">
                                    <font style="color: red">{{ ($errors->has('purchase_no'))?($errors->first('purchase_no')):" " }}</font>
                                 </div>
                              </div>
                              

                              <div class="col-4">
                                  <div class="mb-3">
                                      <label for="exampleFormControlInput1" class="form-label">Supplier Name</label>
                                      <select name="supplier_id" id="supplier_id" class="form-control select2 ">
                                        <option value="">Select supplier</option>
                                      @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id  }}" {{ (@$editProduct->supplier_id == $supplier->id)?'selected':'' }}>{{ $supplier->name }}</option>
                                      @endforeach
                                    </select>
                                      <font style="color: red">{{ ($errors->has('supplier_id'))?($errors->first('supplier_id')):" " }}</font>
                                   </div>
                              </div>

                              <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                    <select name="category_id" id="category_id" class="form-control select2">
                                     
                                    </select>
                                    <font style="color: red">{{ ($errors->has('category_id'))?($errors->first('category_id')):" " }}</font>
                                 </div>
                              </div>
                              

                              <div class="col-6">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                    <select name="product_id" id="product_id" class="form-control select2">
                                     
                                    </select>
                                    <font style="color: red">{{ ($errors->has('product_id'))?($errors->first('product_id')):" " }}</font>
                                 </div>
                              </div>
                              <div class="col-2">
                                <div class="mb-3">
                                    <a style="margin-top: 30px;" class="btn btn-info" id="addEventMore"><i class="fas fa-plus"></i> More</a>
                                </div>
                              </div>
                            
                              </div>
                                
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <form action="{{ route('store_purchase') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-10 m-auto">
                      <div class="card p-4 pt-0">
                        <table class="table-sm table-bordered" >
                          <thead>
                            <tr>
                              <th>Category</th>
                              <th>Product name</th>
                              <th width=9%>PSC/KG</th>
                              <th width=15%>Unit price</th>
                              <th>Description</th>
                              <th width=10%>Totall price </th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="addRow" id="addRow">

                          </tbody>
                          <tbody>
                            <tr>
                              <td colspan="5"><strong>Total amount</strong></td>
                              <td><input type="text" name="eastmate_amount" class="eastmate_amount form-control" id="eastmate_amount" readonly ></td>
                              <td>
                               
                              </td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                    <div class="col-2">
                      <div class="mb-3">
                        <input type="submit" class="btn btn-success" value="{{ (@$editProduct)?'Update':'Purchase' }}" >
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>

<script>
  $(function(){
    $(document).on('change','#supplier_id',function(){
      var supplier_id = $(this).val();
      $.ajax({
        url:"{{ route('get_category') }}",
        type:'GET',
        data:{supplier_id:supplier_id},
        success:function(data){
          var html = '<option value="">Select category</option>';
          $.each(data,function(key,v){
            html += '<option value="'+v.category_id+'">'+v.category.name+'</option>';
          });
          $('#category_id').html(html);

        }
      });
    });
  });
</script>

<script>
  $(function(){
    $(document).on('change','#category_id',function(){
      var category_id = $(this).val();
      $.ajax({
        url:"{{ route('get_product') }}",
        type:'GET',
        data:{category_id:category_id},
        success:function(data){
          var html = '<option value="">Select product</option>';
          $.each(data,function(key,v){
            html += '<option value="'+v.id+'">'+v.name+'</option>';
          });
          $('#product_id').html(html);

        }
      });
    });
  });
</script>

<script id="document_template" type="text/x-handlebars-template">
<tr class="delete_add_more_item" id="delete_add_more_item">
<input type="hidden" name="date[]" value="@{{ date }}">
<input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
<input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
<td>
  <input type="hidden" name="category_id[]" value="@{{ category_id }}">
  @{{ category_name }}
</td>
<td>
  <input type="hidden" name="product_id[]" value="@{{ product_id }}">
  @{{ product_name }}
</td>
<td>
  <input type="number" name="buying_qty[]" min="1" class="form-control form-control-sm text-left buying_qty" value="1">
  
</td>
<td>
  <input type="number" name="unit_price[]" min="1" class="form-control form-control-sm text-left unit_price" value="">
  
</td>
<td>
  <input type="text" name="descript[]"  class="form-control form-control-sm">
  
</td>
<td>
  <input type="text" name="buying_price[]" class="form-control form-control-sm text-right buying_price" value="0" readonly >
  
</td>
<td>
<i class="btn btn-danger btn-sm fa fa-window-close removeEventMore"></i>  
</td>
</tr>
</script>

<script>
  $(document).ready(function(){
    $(document).on('click','#addEventMore',function(){
      var date = $('#date').val();
      var purchase_no = $('#purchase_no').val();   
      var supplier_id = $('#supplier_id').val();
      var category_id = $('#category_id').val();
      var category_name =$('#category_id').find('option:selected').text();
      var product_id = $('#product_id').val();
      var product_name =$('#product_id').find('option:selected').text();

      var source = $('#document_template').html();
      var template = Handlebars.compile(source);
      var data = {
        date:date,
        purchase_no:purchase_no,
        supplier_id:supplier_id,
        category_id:category_id,
        category_name:category_name,
        product_id:product_id,
        product_name:product_name
      };
      var html = template(data);
      $('#addRow').append(html);
    });
    $(document).on('click','.removeEventMore',function(event){
      $(this).closest('.delete_add_more_item').remove();
      totalAmount();

    });
    $(document).on("click keyup",'.buying_qty ,.unit_price',function(){
      var unit_price = $(this).closest('tr').find('input.unit_price').val();
      var buying_qty = $(this).closest('tr').find('input.buying_qty').val();
      var total = buying_qty * unit_price;
      $(this).closest('tr').find('input.buying_price').val(total);
      totalAmount();
    });
  });

  function totalAmount(){
    var sum = 0;
    $('.buying_price').each(function(){
      var value = $(this).val();
      if(!isNaN(value) && length.value != 0){
        sum += parseFloat(value);
      }
    });
    $('#eastmate_amount').val(sum);
  }

</script>
<script>
    $(function () {
      $.validator.setDefaults({
        submitHandler: function () {
          alert( "Form successful submitted!" );
        }
      });
      $('#FormData').validate({
        rules: {
            name: {
            required: true,
            name: true,
          },
          email: {
            required: true,
            email: true,
          },
          mobile: {
            required: true,
            mobile: true
          },
          address: {
            required: true,
            address: true
          },
          
        },
        messages: {
            name: {
            required: "Please enter a name",
            name: "Please enter a name"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          mobile: {
            required: "Please provide a password",
            mobile: "Please enter a valid email address"
          },
          address: {
            required: "Please provide a address",
            address: "Please enter a valid address"
          },
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>
<script>
  $(function(){
    $('.select2').select2();
  })
</script>
@endsection