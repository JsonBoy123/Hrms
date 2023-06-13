@extends('layouts.master')
@section('content')

  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/css/evo-calendar.min.css"/>

  <link href="{{ asset('themes/vali/css/evo-calendar/css/evo-calendar.midnight-blue.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/vali/css/evo-calendar/css/evo-calendar.orange-coral.css') }}" rel="stylesheet">
  <link href="{{ asset('themes/vali/css/evo-calendar/css/evo-calendar.royal-navy.css') }}" rel="stylesheet">
  <script src="{{ asset('themes/vali/css/evo-calendar/js/jquery.min.js') }}"></script>
  <script src="{{ asset('themes/vali/css/evo-calendar/js/evo-calendar.js') }}"></script>
  <script src="{{asset('themes/vali/js/jquery.min.js')}}"></script>


    <main class="app-content" >
      {{-- <div class="app-title" style="padding-top: inherit;">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div> --}}
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb" style="background-color: #ffffff">
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>
      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-address-book-o fa-3x " style="background-image: linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%);"></i>
            <div class="info">
              <a href="{{route('information.index')}}" style="color: #535565;"><h4>personal information</h4> </a>
              <!-- <p><b>{{$emp_count}}</b></p> -->
            </div>
          </div>
        </div>
        @if($user != null)
          @if($user->leave_allotted == 1)
  	        <div class="col-md-6 col-lg-4">
  	          <div class="widget-small warning coloured-icon"><i class="icon fa fa-files-o fa-3x" style=" background-color: #8EC5FC; background-image: linear-gradient(62deg, #8EC5FC 0%, #E0C3FC 100%);"></i>
  	            <div class="info">
  	              <a href="{{url('employee/leaves')}}" style="color: #535565;"><h4>write leave application</h4></a>
  	            </div>
  	          </div>
  	        </div>
  	     @endif
        @endif
        <div class="col-md-6 col-lg-4">
           <div class="widget-small info coloured-icon"><i class="icon fa fa-university fa-3x" style="background-image: linear-gradient(to top, #5ee7df 0%, #b490ca 100%);"></i>
            <div class="info">
              <a href="{{route('loan-request.index')}}" style="color: #535565;"><h4>apply for loan</h4></a>
              <!-- <p><b>25</b></p> -->
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-list-ol fa-3x" style="background-image: linear-gradient(to right, #b8cbb8 0%, #b8cbb8 0%, #b465da 0%, #cf6cc9 33%, #ee609c 66%, #ee609c 100%);"></i>
            <div class="info">
              <a href="{{route('my-indent.index')}}" style="color: #535565;"><h4>indent & <br>no dues</h4></a>
              <!-- <p><b>500</b></p> -->
            </div>

          </div>
        </div>
      </div>
      {{-- <div class="col-md-8" style="float: right;">
          <div class="tile">
            <h3 class="tile-title">Pie Chart</h3>
            <div id="evoCalendar"></div>

          </div>
        </div> --}}
     
   
    </main>
    
<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>

<!-- Add the evo-calendar.js for.. obviously, functionality! -->
<script src="https://cdn.jsdelivr.net/npm/evo-calendar@1.1.2/evo-calendar/js/evo-calendar.min.js"></script>
<script type="text/javascript">
  $('#evoCalendar').evoCalendar({
      format: 'mm/dd/yyyy',
      titleFormat: 'MM yyyy',
      eventHeaderFormat: 'MM d, yyyy',
      language:'en',
      todayHighlight:true,
      sidebarToggler: true,
      sidebarDisplayDefault: true,
      eventListToggler: true,
      eventDisplayDefault: true,
      firstDayOfWeek: 0// Sunday
      theme:'Orange Coral',

  });
    </script>
@endsection