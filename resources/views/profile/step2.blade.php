@extends('profile.layouts.app')
@section('title', 'Family Information')
@section('content')
  <!-- SECTION 1 -->
<h4></h4> 
 
<section> 

  <h3>Family Information:</h3> 
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="0"
  aria-valuemin="20" aria-valuemax="100" style="width:20%">
    <span class="sr-only">50% Complete</span>
  </div>
</div>

 
  <div class="alert alert-danger" style="display:none">  </div>
    {{ Form::open(array('url' => '#','method'=>'POST','id'=>'step2Frm')) }}
    @csrf
    <div class="form-row">
      <div class="form-holder">
        <label for="exampleSpouseName">Spouse Name</label>             
            <input type="text" name="spouse_name" id="spouse_name" value="spouserName" class="form-control" value=""  placeholder="Enter Spouse Name" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter spouse name">
      </div>
        <div class="form-holder">
            {{Form::label('anniversay', 'Anniversary Date')}}
            {{ Form::date('anniversary_date', \Carbon\Carbon::now(), ['class' => 'form-control'])}} 
        </div> 
            <div class="form-holder">
                <label for="exampleSpouseBloodGroup">Spouse's Blood Group</label>             
                    {{Form::select('spouse_blood_group',Helper::bloodGroup(), 3, ['class' => 'form-control','required data-parsley-trigger'=>'keyup','data-parsley-required-message'=>'Please select blood group'])}}
            </div>
    </div> 
    <div class="form-row">
        <div class="form-holder">
                <label for="exampleTotalChild">Total Child</label>             
                    {{Form::select('total_child',Helper::Child(), 1, ['class' => 'form-control','required data-parsley-trigger'=>'keyup','data-parsley-required-message'=>'Please spouse blood group','onchange'=>'totalChild(this.value)'])}}
            </div>
    </div>
 


    <div id="container"></div>


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
  function totalChild(val){
  $("#container").html(" ");
    var i;
    var text;
    for(i = 1; i <= val; i++) {
        $("#container").append('<strong>Details of Child '+ i +'</strong><hr><div class="form-row"><div class="form-holder"><label for="exampleSpouseName">Prefix </label> {{Form::select('prefix[]',Helper::prefix(), null, ['class' => 'form-control','required data-parsley-trigger'=>'keyup','data-parsley-required-message'=>'Please prefix'])}}</div><div class="form-holder"><label for="exampleSpouseName">First Name </label><input type="text" name="first_name[]" id="first_name" class="form-control" value=""  placeholder="Enter First Name" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter first name"></div><div class="form-holder"><label for="exampleSpouseName">Middle Name </label><input type="text" name="middle_name[]" id="middle_name" class="form-control" value=""  placeholder="Enter Middle Name" ></div><div class="form-holder"><label for="exampleSpouseName">Last Name </label><input type="text" name="last_name[]" id="last_name" class="form-control" value=""  placeholder="Enter Last Name" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter last name"></div></div><div class="form-row"><div class="form-holder"><label for="exampleSpouseName">Date Of Birth</label>{{ Form::date('dob[]', \Carbon\Carbon::now(),['class' => 'form-control'])}} </div><div class="form-holder"><label for="exampleSpouseName">Area of interest</label><input type="text" name="area_of_interest[]" id="area_of_interest" class="form-control" value=""  placeholder="Enter Area of interest" required data-parsley-trigger="keyup" data-parsley-required-message="Please area of interest"></div><div class="form-holder"><label for="exampleSpouseName">Achievement</label><input type="text" name="achievement[]" id="achievement" class="form-control" value="" placeholder="Enter Achievement" required data-parsley-trigger="keyup" data-parsley-required-message="Please achievement"></div></div>');
    }   

  }
</script>

