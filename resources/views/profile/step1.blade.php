@extends('profile.layouts.app')
@section('title', 'Profile')
@section('content')
  <!-- SECTION 1 -->
<h4></h4> 
 
<section> 

  <h3>User KYC:</h3> 
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="0"
  aria-valuemin="0" aria-valuemax="100" style="width:1%">
    <span class="sr-only">70% Complete</span>
  </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
<strong>Whoops!</strong> There were some problems with your input.<br><br>
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
 
 
  <div class="alert alert-danger" style="display:none" id="errors">  </div>
    {{ Form::open(array('url' => '#','method'=>'POST','id'=>'step1Frm')) }}
    @csrf
    <div class="form-row">
        <div class="form-holder">
             {{Form::label('name', 'Name')}} 
            <input type="text" name="name" id="name" class="form-control" value="{{ $profile->name }}"  placeholder="Enter your name" > 
             
        </div>
         <div class="form-holder">
        {{Form::label('father', 'Father Name')}}  
            <input type="text" name="father_name" value="father name" class="form-control" placeholder="Father Name"  value="{{ $profile->father_name }}" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter father name"> 
        </div> 
    </div>
   <div class="form-row">
       <div class="form-holder"> 
         {{Form::label('phone', 'Phone No')}}  
            <input type="text" name="phone_no" value="9572284955" class="form-control" placeholder="Phone No"   value="{{ $profile->phone_no }}" required data-parsley-trigger="keyup"  data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-maxlength='10' data-parsley-minlength='10' data-parsley-required-message="Please enter phone no"> 
        </div>  

        <div class="form-holder">
                {{Form::label('dob', 'Date of Birth')}}
                {{ Form::date('dob', \Carbon\Carbon::now(), ['class' => 'form-control'])}} 
         </div>

        <div class="form-holder"> 
          {{Form::label('gender', 'Gender')}} 
          <p>
            Male: <input type="radio" name="gender" id="gender" value="Male" required="" data-parsley-required-message="Please chose gender" >
            Female: <input type="radio" name="gender" id="gender" value="Female" checked >
          </p>    
        </div>
    </div>
        
        <div class="form-row">            
             <div class="form-holder">
                {{Form::label('marital_status', 'Marital Status')}}
                <p>                
                {{Form::label('marital_status', 'Yes')}}
                {{Form::radio('marital_status', 'Yes', true)}}
                {{Form::label('marital_status', 'No')}}
                {{Form::radio('marital_status', 'No', false)}}
                </p>
            </div> 
             <div class="form-holder">
                {{Form::label('gotra', 'Gotra')}}
                {{Form::select('gotra', Helper::Gotra(),$profile->gotra, ['class' => 'form-control','required data-parsley-trigger'=>'keyup',' data-parsley-required-message'=>'Please select gotra'])}}            
            </div>

         <div class="form-holder"> 
            {{Form::label('native', 'Native Place')}}  
                <input type="text" name="native_place" id="native_place" class="form-control" placeholder="Native Place"  value="{{$profile->gotra}}" > 
        </div>

            <div class="form-holder"> 
                {{Form::label('Preferred Location', 'Preferred Location')}} 
                <p>
                Residence: <input type="radio" name="preferred_location" id="preferred_location"  value="Residence" required="" data-parsley-required-message="Please chose preferred location">
                Office: <input type="radio" name="preferred_location" id="preferred_location" value="Office" checked >
                </p> 
            </div> 
     </div>
     
<hr>
  <Address>{{Form::label('address', 'Residential Address')}} </Address> 
    <div class="form-row">
        <div class="form-holder"> 
         {{Form::label('pincode', 'Pin Code')}} 
            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pincode" required data-parsley-trigger="keyup"  data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-maxlength='6' data-parsley-minlength='6' data-parsley-required-message="Please enter pincode" value="{{$profile->pincode}}"> 
        </div>
         <div class="form-holder">    
         {{Form::label('state', 'State')}}         
            <input type="text" name="state" id="state" class="form-control" placeholder="State" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter state name"  value="{{$profile->state}}">
        </div>
          <div class="form-holder"> 
     {{Form::label('city', 'City')}}           
            <input type="text" name="city" id="city" class="form-control" placeholder="City" required data-parsley-trigger="keyup"  data-parsley-required-message="Please enter city name"  value="{{$profile->city}}">
        </div>
    </div>
<div class="form-row">
   
        <div class="form-holder">  
         {{Form::label('place', 'Post Office')}}  
            <select id="post_office" name="post_office" class="form-control" required data-parsley-trigger="keyup"  data-parsley-required-message="Please select post office"  value="{{$profile->post_office}}"> 
            <option value=""> --Select-- </option>
        </select>

        </div> 

        <div class="form-holder">  
         {{Form::label('address', 'Address')}}  
             
 <textarea type="text" name="address" id="address" value="Hemjapur" class="form-control" placeholder="Address" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter address"></textarea>
        </div>  
    </div> 
 
 <!-- Official address  -->

 <hr>
  <Address>{{Form::label('address', 'Official Address')}} </Address> 
    <div class="form-row">
        <div class="form-holder"> 
         {{Form::label('pincode', 'PinCode')}} 
            <input type="text" name="off_pincode" id="off_pincode" class="form-control" placeholder="Pincode" required data-parsley-trigger="keyup"  data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-maxlength='6' data-parsley-minlength='6' data-parsley-required-message="Please enter pincode"> 
        </div>
         <div class="form-holder">    
         {{Form::label('state', 'State')}}         
            <input type="text" name="off_state" id="off_state" class="form-control" placeholder="State" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter state name">
        </div>
          <div class="form-holder"> 
     {{Form::label('city', 'City')}}           
            <input type="text" name="off_city" id="off_city" class="form-control" placeholder="City" required data-parsley-trigger="keyup"  data-parsley-required-message="Please enter city name">
        </div>
    </div>
<div class="form-row">
   
        <div class="form-holder">  
         {{Form::label('place', 'Post Office')}}  
            <select id="off_post_office" name="off_post_office" class="form-control" required data-parsley-trigger="keyup" data-parsley-required-message="Please select post office"> 
                <option value=""> --Select-- </option>
        </select>

        </div> 

         <div class="form-holder">  
           {{Form::label('address', 'Address')}}               
            <textarea type="text" name="off_address" id="off_address" value="Delhi" class="form-control" placeholder="Address" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter address"></textarea>
         </div>  
    </div> 
<!-- End  -->

   <div class="actions clearfix">
        <ul role="menu" aria-label="Pagination">
            <li class="disabled" aria-disabled="true"></li>
                <li aria-hidden="false" class="disabled" aria-disabled="true">  
                    <button type="submit" name="submit" id="step1_submit" role="menuitem" >Next</button>
                </li>
        </ul>
   </div>
    
    {{ Form::close() }}
</section>  

 
@endsection




