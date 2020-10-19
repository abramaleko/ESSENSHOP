<link rel="stylesheet" href=" {{asset('css/confirm.css')}}">
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>Before you proceed please confirm</p>
                 <form method="POST" autocomplete="off">
                 <input type="hidden" value="{{$subtotal}}" id="total"/>
                     <div class="form-group">
                         <label for="email">Email</label>
                     <input type="text" value="{{$userDetail->email}}" class="form-control" id="email">
                     </div>
                     <div class="form-group">
                         <label for="phone number">Phone number</label>
                     <div class="input-group">
                        <input type="text" class="form-control" id="phone number" value="{{$userDetail->phone_number}}" maxlength="9">
                      </div>
                     </div>
                         <div class="form-group mb-4">
                            <label for="location">Where the order will be shipped</label>
                            <select class="form-control" id="location">
                              <option value="" disabled selected hidden>Choose Location</option>
                              <option>Dar es Salaam</option>
                              <option>Other Regions</option>
                            </select>
                          </div>
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-secondary" type="button" id="tokenbutton">GENERATE TOKEN:</button>
                            </div>
                            <input type="text" class="form-control col-md-6" disabled id="token">
                        </div>
                        <small id="" class="form-text text-muted my-4" style=" font-size: 14px;">
                            This token will be used to refer to you're products in this order request
                          </small> 
                         <button type="button" class="btn btn-primary" id="confirm" onclick="completeOrder(this)">CONFIRM ORDER</button>
                        </form>
                     </div>
                     <div class="col-md-6 image">
                        <img src="{{asset('images/confirm.png')}}"/>
                    </div>
            </div>
            <div class="alert alert-primary w-50 my-3" role="alert" id="message">
                <!-- The payment token has been sent to your email.-->
                You're order have been successfully received,we will contact you shortly..
                </div>
                <div class="alert alert-danger w-75 my-3 " role="alert" id="messageAlert">
                  Dear,{{auth()->user()->name}} you can not complete order without generating token first
                </div>
        </div>
        <script src="{{asset('js/confirmDetail.js')}}"></script>

