<div>
    @role('Admin')
  @include('layouts.sidebar.admin')
@elserole('Employee')
  @include('layouts.sidebar.employee')
@endrole

</div>
