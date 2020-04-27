<div id="accordion">

  <div class="card">
    <div class="card-header " id="headingTwo" style="background-color: rgba(0,0,0,0.5)">
      <h5 class="mb-0">
        <button class="btn btn-sm btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          အခန်းအခြေအနေ
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse show">
      <div class="card-body">
        <!-- <div class="list-group" > -->

        <a href="" class="list-group-item-action">
          <span class="checkmark room-checkin ml-1 mb-0"></span>
          <p class="text ml-5 mb-0">Check In</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action">
          <span class="checkmark room-checkout ml-1"></span>
          <p class="text ml-5 mb-0">Check Out</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action">
          <span class="checkmark room-reserv ml-1"></span>
          <p class="text ml-5 mb-0">Reservation</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action ">
          <span class="checkmark housekeeping ml-1"></span>
          <p class="text ml-5 mb-0">Housekeeping</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action ">
          <span class="checkmark idel ml-1"></span>
          <p class="text ml-5 mb-0">Idel</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action ">
          <span class="checkmark out-of-service ml-1"></span>
          <p class="text ml-5 mb-0">Out of services</p>
        </a>
        <!-- </div> -->
      </div>
    </div>
  </div>
  @if(Auth::user()->hasRole('admin'))
  <div class="card">
    <div class="card-header bg-info" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-sm btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fa fa-fw fa-wrench mr-1"></i>Rome Operation
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <a href="{{url('/user/create/rooms')}}">Add Room</a><br>
        <a href="{{url('/user/create/roomtype')}}">Add Room Type</a><br>
        <a href="{{url('/user/invoice/1/edit')}}">invoice</a><br>
        <a href="{{url('/admin/user')}}">User</a><br>
        <a href="{{url('/admin/roles')}}">Role</a><br>
        <!-- <a href="{{url('/admin/users/{id}/edit')}}">Edit User</a><br> -->
        <!-- <a href="{{url('/admin/{id}/edit')}}">invoice</a><br> -->
      </div>
    </div>

  </div>
  @endif
  <div class="card">
    <div class="card-header bg-warning" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-sm btn-link collapsed text-white" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Guest State Color
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
      <a href="" class="list-group-item-action">
          <span class="checkmark room-checkin ml-1 mb-0"></span>
          <p class="text ml-5 mb-0">Check In</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action">
          <span class="checkmark room-checkout ml-1"></span>
          <p class="text ml-5 mb-0">Check Out</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action">
          <span class="checkmark room-reserv ml-1"></span>
          <p class="text ml-5 mb-0">Reservation</p>
        </a>
        <!-- <hr>
        <a href="" class="list-group-item-action ">
          <span class="checkmark housekeeping ml-1"></span>
          <p class="text ml-5 mb-0">Housekeeping</p>
        </a> -->
        <hr>
        <a href="" class="list-group-item-action ">
          <span class="checkmark payment_stay_guest ml-1"></span>
          <p class="text ml-5 mb-0">Payment and Check In</p>
        </a>
        <hr>
        <a href="" class="list-group-item-action ">
          <span class="checkmark out-of-service ml-1"></span>
          <p class="text ml-5 mb-0">Dept Guest</p>
        </a>
      </div>
    </div>
  </div>
</div>