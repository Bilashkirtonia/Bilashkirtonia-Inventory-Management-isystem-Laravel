@extends('backend.admin.master')
@section('content')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0"> {{ (@$editCustomer)?"Edit Customer":"Add Customer " }}</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"> {{ (@$editCustomer)?"Edit Customer":"Add Customer " }}</li>
      </ol>
    </div>
  </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4>
                  
                  {{ (@$editCustomer)?"Edit Customer":"Edit Customer " }}
                  
                  <a href="{{ route('credit_customer') }}" style="float: right;"  class="btn btn-primary">
                    <i class="fas fa-list"></i> View credit customer
                  </a>
                  
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                   
                  <div class="col-md-12 m-auto">
                    <table class="table">
                        <tr>
                            <td> Customer name : <strong>{{ $payment->customer->name }}</strong></td>
                            <td> Customer address : <strong>{{ $payment->customer->address }}</strong></td>
                            <td> Customer mobile : <strong>{{ $payment->customer->mobile }}</strong></td>
                        </tr>
                    </table>
                    <div class="card p-4">
                        <table class="table" border="1">
                            <thead>
                                <tr>
                                  <th>Sl</th>
                                  <th>Category </th>
                                  <th>Product name</th>
                                  <th>Current stock</th>
                                  <th>Quanty</th>
                                  <th>Unit price</th>
                                  <th width="20%">Total price</th>
                                  
                                </tr>
                               </thead>
                               <tbody>
                                @php
                                  $totall_price = 0;
                                @endphp
                                @foreach ($invoice_details as $key => $details)
                                  <tr>
                                    
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $details->category->name }}</td>
                                    <td>{{ $details->product->name }}</td>
                                    <td>{{ $details->product->quantity }}</td>
                                    <td>{{ $details->selling_qty }}</td>
                                    <td>{{ $details->unit_price }} Tk</td>
                                    <td>{{ $details->selling_price }} Tk</td>
                                  </tr>
                                  @php
                                  $totall_price += $details->selling_price;
                                @endphp
                                @endforeach
                                <form action="{{ route('update_credit_customer',$payment->invoice_id) }}" method="post">
                                    @csrf
                                <tr>
                                  <td style="text-align: left" colspan="6">Sub total</td>
                                  <td style="text-align: left">{{ $totall_price }} Tk</td>
                                </tr>
                                <tr>
                                  <td style="text-align: left" colspan="6">Discount</td>
                                  <td style="text-align: left" >{{ $payment->discount_amount }}%</td>
                                </tr>
                                <tr>
                                  <td style="text-align: left" colspan="6">Paid amount</td>
                                  <td style="text-align: left">{{ $payment->paid_amount }} Tk</td>
                                  
                                </tr>
                                <tr>
                                  <td style="text-align: left" colspan="6">Due amount</td>
                                  <input type="hidden" name="new_paid_amount" value="{{ $payment->due_amount }}">
                                  <td style="text-align: left">{{ $payment->due_amount }} Tk</td>
                                 
                                </tr>
                                <tr>
                                  <td style="text-align: left" colspan="6">Grand total</td>
                                  <td style="text-align: left">{{ $payment->total_amount }} Tk</td>
                                </tr>
                                
                               </tbody>
                        </table>
                    </div>
                    <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                          <label for="paid_status" class="form-label">Paid system</label>
                          <select name="paid_status" id="paid_status" class="form-control form-control-sm paid_status select2 ">
                            <option value="">Select paid system</option>
                            <option value="full_paid">Full paid</option>
                            
                            <option value="partial_paid">partial paid</option>
                          </select>
                          <input type="text" name="paid_amount" id="paid_amount" class="paid_amount form-control form-control-sm mt-2" placeholder="Enter your paid blance" style="display: none">
                          <font style="color: red">{{ ($errors->has('category_id'))?($errors->first('category_id')):" " }}</font>
                       </div>
                      </div>
                      <div class="col-5">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Date</label>
                           <input type="date"  name="date" id="date" class="form-control form-control-sm">
                            <font style="color: red">{{ ($errors->has('date'))?($errors->first('date')):" " }}</font>
                         </div>
                    </div>
                   </div>
                  </div>
                  <div class="col-5">
                    <div class="mb-3">
                        <input class="btn btn-success btn-sm" type="submit" value="Update" name="submit">
                    </div>
                  </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
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

@endsection