@extends("app")

@section('head_title', trans('words.landlord').' | '.getcong('site_name') )
@section('head_url', Request::url())

@section("content")
<!--Breadcrumb Section-->
  <section class="breadcrumb-box" data-parallax="scroll" data-image-src="@if(getcong('title_bg')) {{ URL::asset('upload/'.getcong('title_bg')) }} @else {{ URL::asset('site_assets/img/breadcrumb-bg.jpg') }} @endif">
    <div class="inner-container container">
      <h1>{{trans('words.landlord')}}</h1>
      <div class="breadcrumb">
        <ul class="list-inline">
          <li class="home"><a href="{{ URL::to('/') }}">{{trans('words.home')}}</a></li>
          <li><a href="#">{{trans('words.landlord')}}</a></li>
        </ul>
      </div>
    </div>
  </section>
  <!--Breadcrumb Section-->

  <section class="main-container container agent-box-container">
    <div class="title-box clearfix">
      <h2 class="hsq-heading type-1">{{trans('words.landlord')}}</h2>
      <div class="subtitle">&nbsp;</div>
    </div>
    @foreach($landlord as $i => $landlords) 
    <div class="agent-box col-xs-6 col-sm-4">
      <div class="inner-container">
        <a href="{{URL::to('user/details/'.$landlords->id)}}" class="img-container">           
          @if($landlord->image_icon)
                          
            <img src="{{ URL::asset('upload/members/'.$landlords->image_icon.'-b.jpg') }}" alt="{{ $landlords->name }}">
          
          @else
          
          <img src="{{ URL::asset('site_assets/img/agent_default.jpg') }}" alt="{{ $landlords->name }}">
          
          @endif
        </a>
        <div class="bott-sec">
          <div class="name"><a href="{{URL::to('user/details/'.$landlords->id)}}">{{$landlords->name}}</a></div>
          <div class="desc">
            {{$landlord->about}}
          </div>
          <a href="{{URL::to('user/details/'.$landlord->id)}}" class="view-listing">{{trans('words.view_listing')}}</a>
          <div class="social-icons">
            <a href="{{$landlords->facebook}}" class="fa fa-facebook" target="_blank"></a>
            <a href="{{$landlords->twitter}}" class="fa fa-twitter" target="_blank"></a>
            <a href="{{$landlords->gplus}}" class="fa fa-google-plus" target="_blank"></a>
            <a href="{{$landlords->linkedin}}" class="fa fa-linkedin" target="_blank"></a>

          </div>
        </div>
      </div>
    </div>
    @endforeach 
    

  </section>
  <!-- Pagination -->
  @include('_particles.pagination', ['paginator' => $landlords]) 
  <!-- End of Pagination -->

  @endsection