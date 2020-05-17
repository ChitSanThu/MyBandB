<div id="accordion">


  @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('developer'))
  <div class="card">
    <div class="card-header bg-secondary" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-sm btn-link text-white" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fa fa-fw fa-wrench mr-1"></i>Rome Operation
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <a href="{{url('/user/create/rooms')}}" class="list-group-item-action">
          <p class="text ml-1 ">အခန်းထည့်ရန်</p>
        </a>
        <hr>
        <a href="{{url('/user/create/roomtype')}}" class="list-group-item-action">
          <p class="text ml-1 ">အခန်းအမျိုးအစား</p>
        </a>
        <hr>
        <a href="{{url('/user/delete/rooms')}}" class="list-group-item-action">
          <p class="text ml-1 ">အခန်းများဖျက်ရန်</p>
        </a>
        <hr>
        <a href="{{url('/user/invoice/1/edit')}}" class="list-group-item-action">
          <p class="text ml-1 ">ဘောင်ချာ</p>
        </a>
        <hr><a href="{{url('/admin/users/show')}}" class="list-group-item-action">
          <p class="text ml-1 ">အသုံးပြုသူများ</p>
        </a>
        <hr><a href="{{url('/admin/create/categories')}}" class="list-group-item-action">
          <p class="text ml-1 ">Create Cat</p>
        </a>
        <hr><a href="{{url('/admin/create/order')}}" class="list-group-item-action">
          <p class="text ml-1 ">Create Order</p>
        </a>
      </div>
    </div>

  </div>
  @endif
</div>