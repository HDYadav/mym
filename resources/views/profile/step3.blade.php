@extends('profile.layouts.app')
@section('title', 'Professionl Details')
@section('content')
  <!-- SECTION 1 -->
<h4></h4> 
 
<section> 

  <h3>Professionl Details:</h3> 
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="0"
  aria-valuemin="70" aria-valuemax="100" style="width:70%">
    <span class="sr-only">70% Complete</span>
  </div>
</div>

 
  <div class="alert alert-danger" style="display:none">  </div>
    {{ Form::open(array('url' => 'profile_professionl','method'=>'POST','id'=>'step3Frm')) }}
    @csrf   
    <div class="form-row">
         <div class="form-holder"> 
             <label for="exampleEduQua">Educational Qualification</label>
                {{Form::select('education_qualification', Helper::edu(), null, ['class' => 'form-control','required data-parsley-trigger'=>'keyup',' data-parsley-required-message'=>'Please select educational qualification'])}}            
         </div>
    <div class="form-holder"> 
       
        <label for="exampleprofession">Profession</label>          
         <input type="text" name="profession" id="profession" class="form-control" placeholder="Profession" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter profession">           
    </div> 
    </div> 
    <div class="form-row">
          
    <div class="form-holder"> 
        <label for="exampleNatureOfWork">Working at</label>            
         <input type="text" name="working" id="working" class="form-control" placeholder="Where you are working" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter working at">
        
    </div> 
        <div class="form-holder">
         <label for="exampleNatureOfWork">Nature of Work</label>         
             <input type="text" name="nature_of_work" id="nature_of_work" class="form-control" placeholder="Nature of Work" required data-parsley-trigger="keyup" data-parsley-required-message="Please enter nature of work">
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




