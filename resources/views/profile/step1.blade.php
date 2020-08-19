@extends('profile.layouts.app')
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

 
  <div class="alert alert-danger" style="display:none">  </div>
    {{ Form::open(array('url' => 'step2','method'=>'POST','id'=>'step1Frm')) }}
    @csrf
    <div class="form-row">
        <div class="form-holder">
        
            <i class="zmdi zmdi-account"></i>
            <input type="text" name="fullname" id="fullname" class="form-control  @error('fullname') is-invalid @enderror" placeholder="Name" value="{{ old('fullname') }}" autocomplete="fullname" autofocus>
            
            <small class="text-danger">{{ $errors->first('fullname') }}</small>
<div id="error" class="mt-3 text-danger"></div>
        </div>
       <div class="form-holder">
            <i class="zmdi zmdi-phone"></i>
            <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="Phone No"  value="{{ old('phone') }}" autocomplete="phone" autofocus>
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
   
        
        <div class="form-row">
           
            <div class="form-holder"> 
             {{Form::label('gender', 'Gender')}}  
             <br>
             {{Form::label('gender', 'Male')}}  
             {{Form::radio('gender', '0')}}
             {{Form::label('gender', 'Female')}} 
             {{Form::radio('gender', '1')}} 
             
        </div>
        <div class="form-holder">
        {{Form::label('dob', 'Date of Birth')}}
        {{ Form::date('dob', \Carbon\Carbon::now(), ['class' => 'form-control'])}} 
        </div>
        </div>
    
 <div class="form-row">
      <div class="form-holder">
        {{Form::label('gotra', 'Gotra')}}
        {{Form::select('gotra', Gotra(), null, ['class' => 'form-control'])}}            
        </div>
    <div class="form-holder">
       <!-- Marital Status -->
        {{Form::label('mstatus', 'Marital Status')}}
        <br>
        {{Form::label('mstatus', 'Yes')}}
        {{Form::radio('mstatus', '1', false,['onchange' => 'getValue(this.value)'])}}
        {{Form::label('mstatus', 'No')}}
        {{Form::radio('mstatus', '0', false,['onchange' => 'getValue(this.value)'])}}
        </div> 

        
        </div>
 
<div  id="myDIV" style="display:none">
  <div class="form-row">
        <div class="form-holder"> 
        {{Form::label('spouseName', 'Spouse Name')}}
            <input type="text" name="spouseName" id="spouseName" class="form-control" placeholder="Spouse Name" maxlength="6"> 
        </div>
         <div class="form-holder">  
         {{Form::label('spouseName', 'Spouse Blood Group')}}          
            <input type="text" name="spouseBloodGroup" id="spouseBloodGroup" class="form-control" placeholder="Spouse's Blood Group" >
        </div>
         
    </div>
</div>


    <div class="form-row">
        <div class="form-holder">  
            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pin code" maxlength="6"> 
        </div>
         <div class="form-holder">            
            <input type="text" name="state" id="state" class="form-control" placeholder="State" >
        </div>
         
    </div>
<div class="form-row">
    <div class="form-holder">            
            <input type="text" name="city" id="city" class="form-control" placeholder="City" >
        </div>
        <div class="form-holder">   
            <select id="place" name="place" class="form-control"> 
                <option value=""> --Select-- </option>
        </select>

        </div> 
    </div>
     

   <div class="actions clearfix">
        <ul role="menu" aria-label="Pagination">
            <li class="disabled" aria-disabled="true"></li>
                <li aria-hidden="false" class="disabled" aria-disabled="true">  
                    <button type="submit" name="submit" id="submit" role="menuitem">Next</button>
                </li>
        </ul>
   </div>
    
    {{ Form::close() }}
</section>  

 
@endsection


<script>
function getValue(val){
   var x = document.getElementById("myDIV");
  if(val=='1'){
       x.style.display = "block";
  }
  if(val=='0'){
        x.style.display = "none";
  }
    
}
</script>

