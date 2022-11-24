@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editProduct)?"Edit Invoice":"Add Invoice " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editProduct)?"Edit Invoice":"Add Invoice " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editProduct)?"Edit Invoice":"Add Invoice " }}
                  
                  <a href="{{ route('view_invoice') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12 m-auto">
                    <div class="card p-4">
                      <div class="row">
                        <div class="col-2">
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Invoice no</label>
                             <input type="text" value="{{ $invoice_no }}" name="invoice_no" id="invoice_no" class="form-control form-control-sm" readonly>
                              <font style="color: red">{{ ($errors->has('invoice_no'))?($errors->first('invoice_no')):" " }}</font>
                           </div>
                        </div>

                        <div class="col-2">
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Date</label>
                             <input type="date" value="{{$date}}" name="date" id="date" class="form-control form-control-sm">
                              <font style="color: red">{{ ($errors->has('date'))?($errors->first('date')):" " }}</font>
                           </div>
                        </div>

                                                   

                        <div class="col-3">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Supplier Name</label>
                                <select name="category_id" id="category_id" class="form-control form-control-sm select2 ">
                                  <option value="">Select category</option>
                                @foreach ($categories as $category)
                                  <option value="{{ $category->id  }}" {{ (@$editProduct->category_id == $category->id)?'selected':'' }}>{{ $category->name }}</option>
                                @endforeach
                              </select>
                                <font style="color: red">{{ ($errors->has('category_id'))?($errors->first('category_id')):" " }}</font>
                             </div>
                        </div>                              

                        <div class="col-3">
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                              <select name="product_id" id="product_id" class="form-control form-control-sm select2">
                               
                              </select>
                              <font style="color: red">{{ ($errors->has('product_id'))?($errors->first('product_id')):" " }}</font>
                           </div>
                        </div>
                        <div class="col-1">
                          <div class="mb-3">
                              <label for="exampleFormControlInput1" class="form-label">Stock</label>
                             <input type="text" name="current_stock" id="current_stock" class="form-control form-control-sm current_stock" readonly>
                              <font style="color: red">{{ ($errors->has('current_stock'))?($errors->first('current_stock')):" " }}</font>
                           </div>
                        </div>
                        <div class="col-1">
                          <div class="mb-3">
                              <a style="margin-top: 30px;" class="btn btn-sm btn-info" id="addEventMore"><i class="fas fa-plus"></i> add</a>
                          </div>
                        </div>
                      
                        </div>
                        
              
                      </div>   
                            
                  </div>
                  
                </div>
              </div>

              <div class="card-body">
                <form action="{{ route('store_invoice') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-md-12 m-auto">
                      <div class="card p-4 pt-0">
                        <table class="table-sm table-bordered" >
                          <thead>
                            <tr>
                              <th>Category</th>
                              <th>Product name</th>
                              <th width=9%>PSC/KG</th>
                              <th width=15%>Unit price</th>
                              
                              <th width=10%>Totall price </th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody class="addRow" id="addRow">

                          </tbody>
                          
                          <tbody>
                            <tr>
                              <td colspan="4">Discount</td>
                              <td><input type="text" name="discount_amount" class="form-control form-control-sm discount_amount text-right" id="discount_amount" placeholder="Discount"></td>
                            </tr>
                            <tr>
                              <td colspan="4"><strong>Total amount</strong></td>
                              <td><input type="text" name="eastmate_amount" class="eastmate_amount form-control text-right" id="eastmate_amount" readonly ></td>
                              <td>
                               
                              </td>
                            </tr>
                          </tbody>
                          <br>
                          
                        </table>
                        <div class="col-md-12">
                          <label for="descript" class="form-label">Description</label>
                          <textarea type="text" name="descript" id="descript" class="form-control" placeholder="Enter text ..."></textarea>
                        </div> 
                        <div class="row">
                          <div class="col-md-3">
                            <div class="mb-3">
                              <label for="paid_status" class="form-label">Paid system</label>
                              <select name="paid_status" id="paid_status" class="form-control form-control-sm paid_status select2 ">
                                <option value="">Select paid system</option>
                                <option value="full_paid">Full paid</option>
                                <option value="full_due">Full due</option>
                                <option value="partial_paid">partial paid</option>
                              </select>
                              <input type="text" name="paid_amount" id="paid_amount" class="paid_amount form-control form-control-sm mt-2" placeholder="Enter your paid blance" style="display: none">
                              <font style="color: red">{{ ($errors->has('category_id'))?($errors->first('category_id')):" " }}</font>
                           </div>
                          </div>
                          <div class="col-9">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Supplier Name</label>
                                <select name="customer" id="customer" class="form-control form-control-sm select2 ">
                                  <option value="">Select category</option>
                                @foreach ($customers as $customer)
                                  <option value="{{ $customer->id  }}" {{ (@$editProduct->customer_id == $customer->id)?'selected':'' }}>{{ $customer->name }} <strong class="text-success">({{ $customer->mobile }},{{ $customer->address }})</strong></option>

                                @endforeach
                                <option value="0">New customer</option>
                              </select>
                              <div class="row newCustomer" id="newCustomer" style="display: none">
                                <div class="col-md-4">
                                  <input type="text" name="name" id="name" class=" form-control form-control-sm mt-2" placeholder="Enter new customer name">                              
                                </div>
                                <div class="col-md-4">
                                  <input type="text" name="mobile" id="mobile" class="mobile form-control form-control-sm mt-2" placeholder="Enter new customer mobile">                              
                                </div>
                                <div class="col-md-4">
                                  <input type="text" name="address" id="address" class="address form-control form-control-sm mt-2" placeholder="Enter new customer address">                              
                                </div>
                              </div>
                              <font style="color: red">{{ ($errors->has('customer_id'))?($errors->first('customer_id')):" " }}</font>
                             </div>
                          </div> 
                        </div>

                    </div>

                    
                    <div class="col-2">
                      <div class="mb-3">
                        <input type="submit" class="btn btn-success" value="{{ (@$editProduct)?'Update':'Invoice' }}" >
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
    $(document).on('change','#product_id',function(){
      var product_id= $(this).val();
      $.ajax({
        url:'{{ route("current_stock_now") }}',
        type:'GET',
        data:{product_id:product_id},
        success:function(data){
          $('#current_stock').val(data);
        }

      });
    });
  });
</script>

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
    <input type="hidden" name="date" value="@{{ date }}">
    <input type="hidden" name="invoice_no" value="@{{ invoice_no }}">

    <td>
      <input type="hidden" name="category_id[]" value="@{{ category_id }}">
      @{{ category_name }}
    </td>
    <td>
      <input type="hidden" name="product_id[]" value="@{{ product_id }}">
      @{{ product_name }}
    </td>
    <td>
      <input type="number" name="selling_qty[]" min="1" class="form-control form-control-sm text-left selling_qty" value="1">
      
    </td>
    <td>
      <input type="number" name="unit_price[]" min="1" class="form-control form-control-sm text-left unit_price" value="">
      
    </td>
    <td>
      <input type="text" name="selling_price[]" class="form-control form-control-sm text-right selling_price" value="0" readonly >
      
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
      var invoice_no = $('#invoice_no').val();   
      var category_id = $('#category_id').val();
      var category_name =$('#category_id').find('option:selected').text();
      var product_id = $('#product_id').val();
      var product_name =$('#product_id').find('option:selected').text();

      var source = $('#document_template').html();
      var template = Handlebars.compile(source);
      var data = {
        date:date,
        invoice_no:invoice_no,
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
    $(document).on("click keyup",'.selling_qty ,.unit_price',function(){
      var unit_price = $(this).closest('tr').find('input.unit_price').val();
      var selling_qty = $(this).closest('tr').find('input.selling_qty').val();
      var total = selling_qty * unit_price;
      $(this).closest('tr').find('input.selling_price').val(total);
      $('#discount_amount').trigger('keyup');
      
    });
    $(document).on('keyup','#discount_amount',function(){
      totalAmount();
    })
  });

  function totalAmount(){
    var sum = 0;
    $('.selling_price').each(function(){
      var value = $(this).val();
      if(!isNaN(value) && value.length != 0){
        sum += parseFloat(value);
      }
    });
    var discount_amount = parseFloat($('#discount_amount').val());
    if(!isNaN(discount_amount) && discount_amount.length != 0){
      var dis =(sum*discount_amount)/100;
        sum -= parseFloat(dis);
      }
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
  $(document).on('change','#paid_status',function(){
    var paid_status = $(this).val();
    if(paid_status == 'partial_paid'){
      $('#paid_amount').show();
    }else{
      $('#paid_amount').hide();
    }
  });
</script>

<script>
  $(document).on('change','#customer',function(){
    var customer = $(this).val();
    if(customer == '0'){
      $('#newCustomer').show();
    }else{
      $('#newCustomer').hide();
    }
  });
</script>


<script>
  $(function(){
    $('.select2').select2();
  })
</script>
@endsection