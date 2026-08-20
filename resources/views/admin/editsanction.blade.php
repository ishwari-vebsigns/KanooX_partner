  @extends('layouts.admin-app')
  @section('content')

  <style type="text/css">
    .hidden{
      display: none;
    }
    .sanctionsave{
        display: none !important;
    }
    .col, .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col-auto, .col-lg, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-auto, .col-md, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md-auto, .col-sm, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-auto {
       
       padding-right: 4px !important;
    padding-left: 8px !important; 
    }
     textarea{
        height: 38px !important;
    overflow: hidden;
    }
    .card-title{
      font-size: 14px !important;
    }
    .form-control:disabled, .form-control[readonly] {
      background-color: #a6e7efd6 !important;
      opacity: 1;
    }
    .form-group {
      margin-bottom: 0.8rem !important;
    }
    .move-right{
      padding-left: 15px;
      padding-right: 15px;
    }
    .btn-align{
        margin-left:20px;
    }
    #input_fields_wrap  .form-control{
        width: 95% !important;
        margin-left:15px !important;
    }
    
     #input_fields_wrap  label{
        
        margin-left:15px !important;
    }
    
    
  @media print {
        
    .no-print{
        
        display:none;
    }
    .disposal-income-one{
        margin-top:22%;
    }
        
    }
    .label-input{
      padding: 0px !important;
    height: 19px;
    }
    .main-label{
      font-weight: 600;
      /*background: #1e90ff;*/
    /*padding: 3px;*/
    /*padding-right: 2px;*/
    /*color: #fff;*/
    }
    .main-label-itr{
       font-weight: 600;
    /*   background: #1e90ff;
        padding-right: 3px;*/
    /*padding: 3px;*/
    /*color: #fff;*/
    }
  
    .col-md-2{
      padding-right: 0px !important;
      padding-left: 0px !important;
    }

  </style>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
   


  <div class="content-wrapper">

    <div class="content-header row no-print">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Eligiblity Calculation</h2>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">

                <li class="breadcrumb-item">
                  <a href="#"> Home </a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#">Eligiblity Calculation</a>
                </li>
                <li class="breadcrumb-item">
                Edit                                </li>
              </ol> 
            </div>
          </div>
        </div>
      </div>

    </div>                    
    <div class="content-body card" id="Many">

      <!-- Simple Validation start -->
      <div class="newcontent"> <?php echo $sanction->content; ?></div>
     
      
      <div class="row" style="display: inline-flex !important;margin-bottom:20px;">

 <div class="col-lg-6" style="margin-left:30px;" >
  <div class="form-submit mt-10 mb-30">
 
   <button type="button" id="targetnew" class="btn btn-success">Save Changes
   </button style="margin-right:20px;">
    <a href="{{config('app.baseURL')}}/admin/sanctioncalculatorhistory"><button type="button" class="btn btn-danger">Cancel
   </button></a>
 </div>
</div>
<div class="col-lg-1">
    
</div>
<div class="col-lg-4" style="text-align:right;margin-right:30px;">
      <button type="button" onclick="window.print();" class="btn btn-success waves-effect waves-light no-print">Print
   </button>
</div>
<br>
</div>
</div>
</div>
  
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{config('app.baseURL')}}/assets/js/jquery.abacus.min.js"></script>
    <script type="text/javascript">
    $( "#targetnew" ).click(function() {
        var sanction_id="{{$sanction->sanction_calc_id}}";
  var content=$(".newcontent").html();
  var name=$( ".name" ).val();
  var dob=$( ".dob" ).val();
   var age=$( ".age" ).val();
   var loan_amount=$( ".loan_amount" ).val();
   var interest_rate=$( ".interest_rate" ).val();
   var time_period=$( ".time_period" ).val();
    var emi=$( ".emi" ).val();
    var date=$( ".date" ).val();


    $.ajax({
     type: "post",
     url : "https://jfinserv.com/admin/calculate/editsave",
    data : { "sanction_id":sanction_id, "content" : content,"name" : name,"dob" : dob,"age" : age,"interest_rate" : interest_rate,"time_period" : time_period,"emi" : emi,"date" : date },
     success: function (result) {
       
      window.location.href = "https://jfinserv.com/admin/sanctioncalculatorhistory";

     },
     error: function (xhr, textStatus, errorThrown) {
       alert(textStatus + ':' + errorThrown); 
     }
   });
  
  
  
});

        $('input[type=text]').abacus();
    </script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#otherAdd').click(function(){

      var income_name1=$("#income_name1").val();
      alert(income_name1);
      var income_year1b=$("#income_year1b").val();
      alert(income_year1b);
      var income_year2b=$("#income_year2b").val();
      var income_year3b=$("#income_year3b").val();
      if (income_year1b==undefined || income_year1b==null || income_year1b=="") {
        var income_year1b=0;
      }
      if (income_year2b==undefined || income_year2b==null || income_year2b=="") {
        var income_year2b=0;
      }
      if (income_year3b==undefined || income_year3b==null || income_year3b=="") {
        var income_year3b=0;
      }

      var income_name2=$("#income_name2").val();
      var income_year1b2=$("#income_year1b2").val();
      var income_year2b2=$("#income_year2b2").val();
      var income_year3b2=$("#income_year3b2").val();

      if (income_year1b2==undefined || income_year1b2==null || income_year1b2=="") {
        var income_year1b2=0;
      }
      if (income_year2b2==undefined || income_year2b2==null || income_year2b2=="") {
        var income_year2b2=0;
      }
      if (income_year3b2==undefined || income_year3b2==null || income_year3b2=="") {
        var income_year3b2=0;
      }

      var income_name3=$("#income_name3").val();
      var income_year1b3=$("#income_year1b3").val();
      var income_year2b3=$("#income_year2b3").val();
      var income_year3b3=$("#income_year3b3").val();
      if (income_year1b3==undefined || income_year1b3==null || income_year1b3=="") {
        var income_year1b3=0;
      }
      if (income_year2b3==undefined || income_year2b3==null || income_year2b3=="") {
        var income_year2b3=0;
      }
      if (income_year3b3==undefined || income_year3b3==null || income_year3b3=="") {
        var income_year3b3=0;
      }

      var income_name4=$("#income_name4").val();
      var income_year1b4=$("#income_year1b4").val();
      var income_year2b4=$("#income_year2b4").val();
      var income_year3b4=$("#income_year3b4").val();
      if (income_year1b4==undefined || income_year1b4==null || income_year1b4=="") {
        var income_year1b4=0;
      }
      if (income_year2b4==undefined || income_year2b4==null || income_year2b4=="") {
        var income_year2b4=0;
      }
      if (income_year3b4==undefined || income_year3b4==null || income_year3b4=="") {
        var income_year3b4=0;
      }

      var income_name5=$("#income_name5").val();
      var income_year1b5=$("#income_year1b5").val();
      var income_year2b5=$("#income_year2b5").val();
      var income_year3b5=$("#income_year3b5").val();
      if (income_year1b5==undefined || income_year1b5==null || income_year1b5=="") {
        var income_year1b5=0;
      }
      if (income_year2b5==undefined || income_year2b5==null || income_year2b5=="") {
        var income_year2b5=0;
      }
      if (income_year3b5==undefined || income_year3b5==null || income_year3b5=="") {
        var income_year3b5=0;
      }

      var income_name6=$("#income_name6").val();
      var income_year1b6=$("#income_year1b6").val();
      var income_year2b6=$("#income_year2b6").val();
      var income_year3b6=$("#income_year3b6").val();
      if (income_year1b6==undefined || income_year1b6==null || income_year1b6=="") {
        var income_year1b6=0;
      }
      if (income_year2b6==undefined || income_year2b6==null || income_year2b6=="") {
        var income_year2b6=0;
      }
      if (income_year3b6==undefined || income_year3b6==null || income_year3b6=="") {
        var income_year3b6=0;
      }

      var income_name7=$("#income_name7").val();
      var income_year1b7=$("#income_year1b7").val();
      var income_year2b7=$("#income_year2b7").val();
      var income_year3b7=$("#income_year3b7").val();
      if (income_year1b7==undefined || income_year1b7==null || income_year1b7=="") {
        var income_year1b7=0;
      }
      if (income_year2b7==undefined || income_year2b7==null || income_year2b7=="") {
        var income_year2b7=0;
      }
      if (income_year3b7==undefined || income_year3b7==null || income_year3b7=="") {
        var income_year3b7=0;
      }

    });
  });
</script>
<script type="text/javascript">
  $('.incomemodal').click(function(){
    $('#incomeModal').show();
    $('#incomeModal').removeClass('fade');

  });

</script>
<script type="text/javascript">
  $('#cls').click(function(){
    $('#incomeModal').hide();
    $('#incomeModal').addClass('fade');    

  });
</script>
<script type="text/javascript">
  $('#close').click(function(){
    $('#incomeModal').hide();
    $('#incomeModal').addClass('fade');    

  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var max_income_fields = 7; 
    var oi = 1; 
    $("#add_multiple_oi").click(function(e){ 
      e.preventDefault();

      if(oi < max_income_fields){ 
        oi++;


        $("#modalmultiple_field").append('<div class="row mb-1 addeddiv'+oi+'"><div value="addeddiv'+oi+'" class="col-md-1"><a id="removeoi"><i class="fa fa-minus"></i></a></div><div class="col-md-3"><input class="form-control" type="text" name="income_name'+oi+'" id="income_name'+oi+'"></div><div class="col-md-2 mr-1"><input class="form-control income_year1b'+oi+'" type="text" name="income_year1b'+oi+'" value="0" id="income_year1b'+oi+'"></div><div class="col-md-2 mr-1"><input class="form-control income_year2b'+oi+'" type="text" name="income_year2b'+oi+'" value="0" id="income_year2b'+oi+'"></div><div class="col-md-2 mr-1"><input class="form-control income_year3b'+oi+'" type="text" name="income_year3b'+oi+'" value="0" id="income_year3b'+oi+'"></div></div>');
      }

    });
    
    $("#modalmultiple_field").on("click", '#removeoi', function(e){ 

      e.preventDefault();
      var a=$(this).parent('div').attr('value'); 
      $(this).closest('.'+a).remove();
       oi--;
    });
  });
</script>

   <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="{{config('app.baseURL')}}/assets/js/jquery.abacus.min.js"></script>
    <script type="text/javascript">
        $('input[type=text]').abacus();
    </script>
<script type="text/javascript">


  /*start of code for add and delete step 3*/

  $(document).ready(function() {

    var max_fields = 10; 

    var x = 1; 
    $("#add_field_button").click(function(e){ 

      e.preventDefault();

      if(x < max_fields){ 
        x++;


        $("#input_fields_wrap").append("<div class='col-md-12' style='display: inline-flex;padding: 0px;'> <div class='col-md-2' ><div class='form-group'><textarea type='text' class='form-control required bank_name'  rows='1' value='0' id='proposalTitle3' name='bank_name[]''></textarea></div></div><div class='col-md-2' ><div class='form-group'><textarea type='text' class='form-control required sanction_date' value='0'  rows='1' id='proposalTitle3' name='sanction_date[]'></textarea> </div></div><div class='col-md-2' > <div class='form-group'><textarea type='number' class='form-control required loan_amount' value='0'  rows='1' id='loan_amount' name='loan_amount[]'></textarea></div></div><div class='col-md-2' > <div class='form-group'> <textarea type='number' class='form-control required o_s_balance' value='0' id='o_s_balance' rows='1' name='o_s_balance[]'></textarea></div></div><div class='col-md-2' ><div class='form-group'><input type='number' class='form-control required running_emi"+x+"' value='0' id='proposalTitle3' name='emi[]'></div></div><br><a class='btn btn btn-outline-primary btn-sm dlt btn-align' style='height:40px;margin-top:0.1%;'><i class='fa fa-minus'></i></a></div>");
      }

    });
    
    $("#input_fields_wrap").on("click",".dlt", function(e){ //user click on remove text


      e.preventDefault(); $(this).parent('div').remove(); x--;
    });

     var max_fields_one = 10; 

    var x_one = 1; 

       $("#add_field_button_one").click(function(e){ 

      e.preventDefault();

      if(x_one < max_fields_one){ 
        x_one++;


        $("#input_fields_wrap_one").append('<div class="col-md-12" style="display: inline-flex;padding: 0px;"><div class="form-group" style="margin-right:15px;width:60%;"><textarea type="text" class="form-control required project_name" value="0" rows="1" id="proposalTitle3" name="project_name[]"></textarea></div><div class="form-group"><input type="text" class="form-control required project_cost'+x_one+'" value="0" id="proposalTitle3" name="project_cost[]"></div><a class="btn btn btn-outline-primary btn-sm dlt btn-align" style="height:29px;margin-top:1.1%;""><i class="fa fa-minus"></i></a></div>');
      }

    });
    
    $("#input_fields_wrap_one").on("click",".dlt", function(e){ //user click on remove text


      e.preventDefault(); $(this).parent('div').remove(); x_one--;
    });
  });


   


    




  /*end of code for add and delete step 3*/


  $(document).ready(function() {
    var max_fields = 20; 

    var x = 1; 
    $("#add_dep1_button").click(function(e){ 

      e.preventDefault();

      if(x < max_fields){ 
        x++;


        $("#input_fields_wrap_dep").append("<div class='col-md-12' style='display: inline-flex;padding: 0px;'><div class='col-md-10' ><div class='form-group'><label for='proposalTitle3'></label><input type='text' class='form-control required' id='proposalTitle3' name='other_dep[]'></div></div><br><a class='btn btn btn-outline-primary btn-sm dlt btn-align' style='height:40px;margin-top:1.5%;'><i class='fa fa-minus'></i></a></div>");
      }

    });
    
    $("#input_fields_wrap_dep").on("click",".dlt", function(e){ //user click on remove text


      e.preventDefault(); $(this).parent('div').remove(); x--;
    });
  });





</script>
<script>
 function show1() {
  var radioButton = document.getElementById("salariedTab");
  radioButton.checked = false;

  $('.working').addClass('hidden');
  $('.business').removeClass('hidden');


}
function show2() {


  $('.business').addClass('hidden');
  $('.working').removeClass('hidden');
  var radioButton = document.getElementById("selfTab");
  radioButton.checked = false;


}



$(".date_of_birth").on("change",function(){
  var selected = $(this).val();
  if(selected != ''){
    var str=selected.split('-');    
    var firstdate=new Date(str[0],str[1],str[2]);


    var today = new Date();        
    var dayDiff = Math.ceil(today.getTime() - firstdate.getTime()) / (1000 * 60 * 60 * 24 * 365);

    // alert(dayDiff);
    var age = parseInt(dayDiff);
    $('.age').val(Math.round(age));
  }
});

$('input').on('blur focusout',function(){

  $('#Many').find("input[type=text]").each(function() {
  var value=$(this).val();
  if (value==undefined || value==null || value=="") {
    $(this).val(0);
  }else{
      $(this).attr('value',value);
  }
   });

  });
  
  $('textarea').on('blur focusout',function(){

  $('#Many').find("textarea").each(function() {
  var value=$(this).val();
 
      $(this).text(value);
  
   });

  });

$('input').on('keyup blur focusout',function(){

      $(this).val($(this).val().replace(/\s+/g, ''));
    
//     jQuery.fn.abacus=function(options){var options=jQuery.extend({error:!1,comment:!1,calculatewrapper:!1,calculate:!1,oncalculate:!1,onendcalculate:!1,onready:!1,onfocus:!1,onblur:!1,onerror:!1,onenter:!1,onescape:!1,oninput:!1,ifnull:"",sign:!0},options),convert=function(e,n){var a="0",o="",t="00";if(2!=(n=n||(n=2))){t="";for(var l=0;l<n;l++)t+=String("0")}if(!isNaN(parseFloat(e))){o=(a=parseFloat(Math.abs(e)).toFixed(n).toString()).substr(a.indexOf(".")+1,n).toString(),a=parseInt(a).toString();for(var u=/(\d+)(\d{3})/;u.test(a);)a=a.replace(u,"$1 $2");if(o!=t){var r=/[0]*$/g;a+="."+o.replace(r,"")}e<0&&(a="−"+a)}return a};return this.each(function(){var nchars=new RegExp(/[\!\@\#\№\$\%\^\&\=\[\]\\\'\;\{\}\|\"\:\<\>\?~\`\_A-ZА-Яa-zа-я]/),chars="1234567890+-/*,. ",errTimer=void 0,focusObj=this,valueBack=0,valueYng=0,metic=new RegExp(/[\+\-\*\/]/),meticI=new RegExp(/^[\+\-\*\/]/),toValueBack=!1;jQuery(this).blur(function(){if(toValueBack&&(valueYng=valueBack),toValueBack=!1,options.sign)e=valueYng<0?"-":"";else var e="";0!=(valueYng=Math.abs(valueYng))?($(focusObj).val(e+convert(valueYng)),options.onblur&&options.onblur(focusObj,e+convert(valueYng))):($(focusObj).val(options.ifnull),options.onblur&&options.onblur(focusObj,options.ifnull))}),jQuery(this).keypress(function(e){var n;if(e.charCode?(n=String.fromCharCode(e.charCode),c=e.charCode):(n=String.fromCharCode(e.which),c=e.which),37==c||39==c)return!0;e.ctrlKey||nchars.test(n)||13==e.keyCode&&(options.onenter&&setTimeout(function(){options.onenter(focusObj,valueYng)},100),focusObj.blur())}),jQuery(this).keyup(function(e){if(valueYng=String(focusObj.value).replace(/ /g,"").replace(/,/g,"."),27==e.keyCode)return toValueBack=!0,options.onescape&&options.onescape(focusObj,valueBack),void focusObj.blur();var comp=metic.test(valueYng);if(comp){if(comp=meticI.test(valueYng)){var tStr=String(valueBack)+String(valueYng);try{valueYng=parseFloat(eval(tStr),10),valueYng=isNaN(valueYng)?0:valueYng,valueYng=isFinite(valueYng)?valueYng:0,jQuery(options.calculate).html(convert(valueYng))}catch(e){valueYng=0,jQuery(options.calculate).html(valueYng)}}else{var tStr=String(valueYng);try{valueYng=parseFloat(eval(tStr),10),valueYng=isNaN(valueYng)?0:valueYng,valueYng=isFinite(valueYng)?valueYng:0,jQuery(options.calculate).html(convert(valueYng))}catch(e){valueYng=0,jQuery(options.calculate).html(valueYng)}}options.oncalculate&&options.oncalculate(valueYng)}else isNaN(parseFloat(valueYng,10))?(valueYng=0,jQuery(options.calculate).html(valueYng)):jQuery(options.calculate).html(convert(parseFloat(valueYng,10))),options.onendcalculate&&options.onendcalculate(valueYng);options.oninput&&options.oninput(this,e.keyCode)}),options.onready&&options.onready(this)})};
//   $('input').abacus();

// $('#compose_form').find("input[type=text] , textarea ").each(function() {
//     $(this).val('');
//    });

if($('.year_one_check').is(':checked')){
    
    year_one_check=12;
}else{
    year_one_check=0;
}


if($('.year_two_check').is(':checked')){
    
    year_two_check=12;
}else{
    year_two_check=0;
}

if($('.year_three_check').is(':checked')){
    
    year_three_check=12;
}else{
    year_three_check=0;
}

var total_year_month=parseFloat(year_one_check)+parseFloat(year_two_check)+parseFloat(year_three_check);

if($('.co_year_one_check').is(':checked')){
    
    co_year_one_check=12;
}else{
    co_year_one_check=0;
}


if($('.co_year_two_check').is(':checked')){
    
    co_year_two_check=12;
}else{
    co_year_two_check=0;
}

if($('.co_year_three_check').is(':checked')){
    
    co_year_three_check=12;
}else{
    co_year_three_check=0;
}

var co_total_co_year_month=parseFloat(co_year_one_check)+parseFloat(co_year_two_check)+parseFloat(co_year_three_check);

if($('.co1_year_one_check').is(':checked')){
    
    co1_year_one_check=12;
}else{
    co1_year_one_check=0;
}


if($('.co1_year_two_check').is(':checked')){
    
    co1_year_two_check=12;
}else{
    co1_year_two_check=0;
}

if($('.co1_year_three_check').is(':checked')){
    
    co1_year_three_check=12;
}else{
    co1_year_three_check=0;
}

var co1_total_co_year_month=parseFloat(co1_year_one_check)+parseFloat(co1_year_two_check)+parseFloat(co1_year_three_check);

if($('.co2_year_one_check').is(':checked')){
    
    co2_year_one_check=12;
}else{
    co2_year_one_check=0;
}


if($('.co2_year_two_check').is(':checked')){
    
    co2_year_two_check=12;
}else{
    co2_year_two_check=0;
}

if($('.co2_year_three_check').is(':checked')){
    
    co2_year_three_check=12;
}else{
    co2_year_three_check=0;
}

var co2_total_co_year_month=parseFloat(co2_year_one_check)+parseFloat(co2_year_two_check)+parseFloat(co2_year_three_check);


if($('.month_one_check').is(':checked')){
    
    month_one_check=1;
}else{
    month_one_check=0;
}


if($('.month_two_check').is(':checked')){
    
    month_two_check=1;
}else{
    month_two_check=0;
}



if($('.month_three_check').is(':checked')){
    
    month_three_check=1;
}else{
    month_three_check=0;
}


if($('.month_four_check').is(':checked')){
    
    month_four_check=1;
}else{
    month_four_check=0;
}


if($('.month_five_check').is(':checked')){
    
    month_five_check=1;
}else{
    month_five_check=0;
}


if($('.month_six_check').is(':checked')){
    
    month_six_check=1;
}else{
    month_six_check=0;
}


var month_check=parseFloat(month_one_check)+parseFloat(month_two_check)+parseFloat(month_three_check)+parseFloat(month_four_check)+parseFloat(month_five_check)+parseFloat(month_six_check)


if($('.co_month_one_check').is(':checked')){
    
    co_month_one_check=1;
}else{
    co_month_one_check=0;
}



if($('.year_two_check').is(':checked')){
    
    co_month_two_check=1;
}else{
    co_month_two_check=0;
}


if($('.co_month_three_check').is(':checked')){
    
    co_month_three_check=1;
}else{
    co_month_three_check=0;
}

if($('.co_month_four_check').is(':checked')){
    
    co_month_four_check=1;
}else{
    co_month_four_check=0;
}


if($('.co_month_five_check').is(':checked')){
    
    co_month_five_check=1;
}else{
    co_month_five_check=0;
}

if($('.co_month_six_check').is(':checked')){
    
    co_month_six_check=1;
}else{
    co_month_six_check=0;
}


var co_month_check=parseFloat(co_month_one_check)+parseFloat(co_month_two_check)+parseFloat(co_month_three_check)+parseFloat(co_month_four_check)+parseFloat(co_month_five_check)+parseFloat(co_month_six_check)

if($('.co1_month_one_check').is(':checked')){
    
    co1_month_one_check=1;
}else{
    co1_month_one_check=0;
}



if($('.co1_month_two_check').is(':checked')){
    
    co1_month_two_check=1;
}else{
    co1_month_two_check=0;
}


if($('.co1_month_three_check').is(':checked')){
    
    co1_month_three_check=1;
}else{
    co1_month_three_check=0;
}

if($('.co1_month_four_check').is(':checked')){
    
    co1_month_four_check=1;
}else{
    co1_month_four_check=0;
}


if($('.co1_month_five_check').is(':checked')){
    
    co1_month_five_check=1;
}else{
    co1_month_five_check=0;
}

if($('.co1_month_six_check').is(':checked')){
    
    co1_month_six_check=1;
}else{
    co1_month_six_check=0;
}


var co1_month_check=parseFloat(co1_month_one_check)+parseFloat(co1_month_two_check)+parseFloat(co1_month_three_check)+parseFloat(co1_month_four_check)+parseFloat(co1_month_five_check)+parseFloat(co1_month_six_check)

    //CoBorrower2 Salaried
    if($('.co2_month_one_check').is(':checked')){
    
    co2_month_one_check=1;
}else{
    co2_month_one_check=0;
}



if($('.co2_month_two_check').is(':checked')){
    
    co2_month_two_check=1;
}else{
    co2_month_two_check=0;
}


if($('.co2_month_three_check').is(':checked')){
    
    co2_month_three_check=1;
}else{
    co2_month_three_check=0;
}

if($('.co2_month_four_check').is(':checked')){
    
    co2_month_four_check=1;
}else{
    co2_month_four_check=0;
}


if($('.co2_month_five_check').is(':checked')){
    
    co2_month_five_check=1;
}else{
    co2_month_five_check=0;
}

if($('.co2_month_six_check').is(':checked')){
    
    co2_month_six_check=1;
}else{
    co2_month_six_check=0;
}


var co2_month_check=parseFloat(co2_month_one_check)+parseFloat(co2_month_two_check)+parseFloat(co2_month_three_check)+parseFloat(co2_month_four_check)+parseFloat(co2_month_five_check)+parseFloat(co2_month_six_check) 

$('.co2_month_six_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_six_show').removeClass('hidden');
   }
   else
   {
    $('.co2_month_six_show').addClass('hidden');
  }    

});
  $('.co2_month_five_check').change(function(){

    if($(this).is(':checked')){
     $('.co2_month_five_show').removeClass('hidden');
   }
   else
   {
    $('.co2_month_five_show').addClass('hidden');
  }    

});
  $('.co2_month_four_check').change(function(){

    if($(this).is(':checked')){
     $('.co2_month_four_show').removeClass('hidden');
   }
   else
   {
    $('.co2_month_four_show').addClass('hidden');
  }    

});
  $('.co2_month_three_check').change(function(){

    if($(this).is(':checked')){
     $('.co2_month_three_show').removeClass('hidden');
   }
   else
   {
    $('.co2_month_three_show').addClass('hidden');
  }    

});
  $('.co2_month_two_check').change(function(){

    if($(this).is(':checked')){
     $('.co2_month_two_show').removeClass('hidden');
   }
   else
   {
    $('.co2_month_two_show').addClass('hidden');
  }    

});
  $('.co2_month_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co2_month_one_show').removeClass('hidden');
   }
   else
   {
    $('.co2_month_one_show').addClass('hidden');
  }    

});

// End of Co-Borrower2 Salaried
    

  var profession_type = $("input[name='profession_type']:checked").val();


  var future_rental=$('.future_rent').val();
  var other_monthy=0;
  var running_emi=$('.running_emi').val();
  if (running_emi==undefined || running_emi==null || running_emi=="") {
   var running_emi=0;
 }
 var running_emi_one=$('.running_emi2').val();
 if (running_emi_one==undefined || running_emi_one==null || running_emi_one=="") {
   var running_emi_one=0;
 }
 var running_emi_two=$('.running_emi3').val();
 if (running_emi_two==undefined || running_emi_two==null || running_emi_two=="") {
   var running_emi_two=0;
 }
 var running_emi_three=$('.running_emi4').val();
 if (running_emi_three==undefined || running_emi_three==null || running_emi_three=="") {
   var running_emi_three=0;
 }
 var running_emi_four=$('.running_emi5').val();
 if (running_emi_four==undefined || running_emi_four==null || running_emi_four=="") {
   var running_emi_four=0;
 }
 var running_emi_five=$('.running_emi6').val();
 if (running_emi_five==undefined || running_emi_five==null || running_emi_five=="") {
   var running_emi_five=0;
 }
 var running_emi_six=$('.running_emi7').val();
 if (running_emi_six==undefined || running_emi_six==null || running_emi_six=="") {
   var running_emi_six=0;
 }
 var running_emi_seven=$('.running_emi8').val();
 if (running_emi_seven==undefined || running_emi_seven==null || running_emi_seven=="") {
   var running_emi_seven=0;
 }
 var running_emi_eight=$('.running_emi9').val();
 if (running_emi_eight==undefined || running_emi_eight==null || running_emi_eight=="") {
   var running_emi_eight=0;
 }
 var running_emi_nine=$('.running_emi10').val();
 if (running_emi_nine==undefined || running_emi_nine==null || running_emi_nine=="") {
   var running_emi_nine=0;
 }
 var running_emi_ten=$('.running_emi11').val();
 if (running_emi_ten==undefined || running_emi_ten==null || running_emi_ten=="") {
   var running_emi_ten=0;
 }
 var running_emi_eleven=$('.running_emi12').val();
 if (running_emi_eleven==undefined || running_emi_eleven==null || running_emi_eleven=="") {
   var running_emi_eleven=0;
 }
 var running_emi_twelve=$('.running_emi13').val();
 if (running_emi_twelve==undefined || running_emi_twelve==null || running_emi_twelve=="") {
   var running_emi_twelve=0;
 }
 var running_emi_thirteen=$('.running_emi14').val();
 if (running_emi_thirteen==undefined || running_emi_thirteen==null || running_emi_thirteen=="") {
   var running_emi_thirteen=0;
 }
 var running_emi_fourteen=$('.running_emi15').val();
 if (running_emi_fourteen==undefined || running_emi_fourteen==null || running_emi_fourteen=="") {
   var running_emi_fourteen=0;
 }
 var running_emi_fifteen=$('.running_emi16').val();
 if (running_emi_fifteen==undefined || running_emi_fifteen==null || running_emi_fifteen=="") {
   var running_emi_fifteen=0;
 }
 var running_emi_sixteen=$('.running_emi17').val();
 if (running_emi_sixteen==undefined || running_emi_sixteen==null || running_emi_sixteen=="") {
   var running_emi_sixteen=0;
 }
 var running_emi_seventeen=$('.running_emi18').val();
 if (running_emi_seventeen==undefined || running_emi_seventeen==null || running_emi_seventeen=="") {
   var running_emi_seventeen=0;
 }
 var running_emi_eighteen=$('.running_emi19').val();
 if (running_emi_eighteen==undefined || running_emi_eighteen==null || running_emi_eighteen=="") {
   var running_emi_eighteen=0;
 }
 var running_emi_nineteen=$('.running_emi20').val();
 if (running_emi_nineteen==undefined || running_emi_nineteen==null || running_emi_nineteen=="") {
   var running_emi_nineteen=0;
 }
 var running_emi_twenty=$('.running_emi21').val();
 if (running_emi_twenty==undefined || running_emi_twenty==null || running_emi_twenty=="") {
   var running_emi_twenty=0;
 }


 var total_emi=parseFloat(running_emi)+parseFloat(running_emi_one)+parseFloat(running_emi_two)+parseFloat(running_emi_three)+parseFloat(running_emi_four)+parseFloat(running_emi_five)+parseFloat(running_emi_six)+parseFloat(running_emi_seven)+parseFloat(running_emi_eight)+parseFloat(running_emi_nine)+parseFloat(running_emi_ten)+parseFloat(running_emi_twelve)+parseFloat(running_emi_thirteen)+parseFloat(running_emi_fourteen)+parseFloat(running_emi_fifteen)+parseFloat(running_emi_sixteen)+parseFloat(running_emi_seventeen)+parseFloat(running_emi_eighteen)+parseFloat(running_emi_nineteen)+parseFloat(running_emi_twenty);

 $('.total_emi_value').val(total_emi);


   var project_cost=$('.project_cost').val();
  if (project_cost==undefined || project_cost==null || project_cost=="") {
   var project_cost=0;
 }
//  var project_cost_one=$('.project_cost2').val();
//  console.log("o"+project_cost_one);
//  if (project_cost_one==undefined || project_cost_one==null || project_cost_one=="") {
//   var project_cost_one=0;
//  }
//  var project_cost_two=$('.project_cost3').val();
//   console.log("wd"+project_cost_two);
//  if (project_cost_two==undefined || project_cost_two==null || project_cost_two=="") {
//   var project_cost_two=0;
//  }
//  var project_cost_three=$('.project_cost4').val();
//  if (project_cost_three==undefined || project_cost_three==null || project_cost_three=="") {
//   var project_cost_three=0;
//  }
//  var project_cost_four=$('.project_cost5').val();
//  if (project_cost_four==undefined || project_cost_four==null || project_cost_four=="") {
//   var project_cost_four=0;
//  }
//  var project_cost_five=$('.project_cost6').val();
//  if (project_cost_five==undefined || project_cost_five==null || project_cost_five=="") {
//   var project_cost_five=0;
//  }
//  var project_cost_six=$('.project_cost7').val();
//  if (project_cost_six==undefined || project_cost_six==null || project_cost_six=="") {
//   var project_cost_six=0;
//  }
//  var project_cost_seven=$('.project_cost8').val();
//  if (project_cost_seven==undefined || project_cost_seven==null || project_cost_seven=="") {
//   var project_cost_seven=0;
//  }
//  var project_cost_eight=$('.project_cost9').val();
//  if (project_cost_eight==undefined || project_cost_eight==null || project_cost_eight=="") {
//   var project_cost_eight=0;
//  }
//  var project_cost_nine=$('.project_cost10').val();
//  if (project_cost_nine==undefined || project_cost_nine==null || project_cost_nine=="") {
//   var project_cost_nine=0;
//  }
//  var project_cost_ten=$('.project_cost11').val();
//  if (project_cost_ten==undefined || project_cost_ten==null || project_cost_ten=="") {
//   var project_cost_ten=0;
//  }
//  var project_cost_eleven=$('.project_cost12').val();
//  if (project_cost_eleven==undefined || project_cost_eleven==null || project_cost_eleven=="") {
//   var project_cost_eleven=0;
//  }
//  var project_cost_twelve=$('.project_cost13').val();
//  if (project_cost_twelve==undefined || project_cost_twelve==null || project_cost_twelve=="") {
//   var project_cost_twelve=0;
//  }
//  var project_cost_thirteen=$('.project_cost14').val();
//  if (project_cost_thirteen==undefined || project_cost_thirteen==null || project_cost_thirteen=="") {
//   var project_cost_thirteen=0;
//  }
//  var project_cost_fourteen=$('.project_cost15').val();
//  if (project_cost_fourteen==undefined || project_cost_fourteen==null || project_cost_fourteen=="") {
//   var project_cost_fourteen=0;
//  }
//  var project_cost_fifteen=$('.project_cost16').val();
//  if (project_cost_fifteen==undefined || project_cost_fifteen==null || project_cost_fifteen=="") {
//   var project_cost_fifteen=0;
//  }
//  var project_cost_sixteen=$('.project_cost17').val();
//  if (project_cost_sixteen==undefined || project_cost_sixteen==null || project_cost_sixteen=="") {
//   var project_cost_sixteen=0;
//  }
//  var project_cost_seventeen=$('.project_cost18').val();
//  if (project_cost_seventeen==undefined || project_cost_seventeen==null || project_cost_seventeen=="") {
//   var project_cost_seventeen=0;
//  }
//  var project_cost_eighteen=$('.project_cost19').val();
//  if (project_cost_eighteen==undefined || project_cost_eighteen==null || project_cost_eighteen=="") {
//   var project_cost_eighteen=0;
//  }
//  var project_cost_nineteen=$('.project_cost20').val();
//  if (project_cost_nineteen==undefined || project_cost_nineteen==null || project_cost_nineteen=="") {
//   var project_cost_nineteen=0;
//  }
//  var project_cost_twenty=$('.project_cost21').val();
//  if (project_cost_twenty==undefined || project_cost_twenty==null || project_cost_twenty=="") {
//   var project_cost_twenty=0;
//  }

// alert(project_cost_two);
 var total_project_cost=parseFloat(project_cost);
 
//  +parseFloat(project_cost_one)+parseFloat(project_cost_two)+parseFloat(project_cost_three)+parseFloat(project_cost_four)+parseFloat(project_cost_five)+parseFloat(project_cost_six)+parseFloat(project_cost_seven)+parseFloat(project_cost_eight)+parseFloat(project_cost_nine)+parseFloat(project_cost_ten)+parseFloat(project_cost_twelve)+parseFloat(project_cost_thirteen)+parseFloat(project_cost_fourteen)+parseFloat(project_cost_fifteen)+parseFloat(project_cost_sixteen)+parseFloat(project_cost_seventeen)+parseFloat(project_cost_eighteen)+parseFloat(project_cost_nineteen)+parseFloat(project_cost_twenty);

 $('.total_project_cost_value').val(total_project_cost);

 var master_rental_margin=$('.master_rental_margin').val();

 var eligilble_rental_income=parseFloat(future_rental)*parseFloat(master_rental_margin)/100;

 var eligilble_other_income=other_monthy;

 $('.eligilble_rental_income').val(eligilble_rental_income);
 $('.eligilble_other_income').val(eligilble_other_income);



    // var future_rental=$('.future_rent').val();
    // var other_monthy=$('.other_monthy').val();

    // if (profession_type=="self") {


      // Salaried Start

      // Month1 Borrower

      var one_salary_gross_income=$(".one_salary_gross_income").val();
      var one_salary_tax=$(".one_salary_tax").val();
      var one_salary_deduction=$(".one_salary_deduction").val();

      var one_net_montly_income=parseFloat(one_salary_gross_income)-parseFloat(one_salary_tax)-parseFloat(one_salary_deduction);
      
      $('.one_net_montly_income').val(one_net_montly_income);




      // Month2 Borrower

      var two_salary_gross_income=$(".two_salary_gross_income").val();
      var two_salary_tax=$(".two_salary_tax").val();
      var two_salary_deduction=$(".two_salary_deduction").val();

      var two_net_montly_income=parseFloat(two_salary_gross_income)-parseFloat(two_salary_tax)-parseFloat(two_salary_deduction);
       
      $('.two_net_montly_income').val(two_net_montly_income);




      // Month3 Borrower
      

      var three_salary_gross_income=$(".three_salary_gross_income").val();
      var three_salary_tax=$(".three_salary_tax").val();
      var three_salary_deduction=$(".three_salary_deduction").val();

      var three_net_montly_income=parseFloat(three_salary_gross_income)-parseFloat(three_salary_tax)-parseFloat(three_salary_deduction);
       
      $('.three_net_montly_income').val(three_net_montly_income);



      // Month4 Borrower


      var four_salary_gross_income=$(".four_salary_gross_income").val();
      var four_salary_tax=$(".four_salary_tax").val();
      var four_salary_deduction=$(".four_salary_deduction").val();

      var four_net_montly_income=parseFloat(four_salary_gross_income)-parseFloat(four_salary_tax)-parseFloat(four_salary_deduction);

      $('.four_net_montly_income').val(four_net_montly_income);



      // Month5 Borrower

      var five_salary_gross_income=$(".five_salary_gross_income").val();
      var five_salary_tax=$(".five_salary_tax").val();
      var five_salary_deduction=$(".five_salary_deduction").val();

      var five_net_montly_income=parseFloat(five_salary_gross_income)-parseFloat(five_salary_tax)-parseFloat(five_salary_deduction);

       $('.five_net_montly_income').val(five_net_montly_income);


      // Month6 Borrower


      var six_salary_gross_income=$(".six_salary_gross_income").val();
      var six_salary_tax=$(".six_salary_tax").val();
      var six_salary_deduction=$(".six_salary_deduction").val();

      var six_net_montly_income=parseFloat(six_salary_gross_income)-parseFloat(six_salary_tax)-parseFloat(six_salary_deduction);

      $('.six_net_montly_income').val(six_net_montly_income);

     // Month1 CoBorrower

     var co_one_salary_gross_income=$(".co_one_salary_gross_income").val();
     var co_one_salary_tax=$(".co_one_salary_tax").val();
     var co_one_salary_deduction=$(".co_one_salary_deduction").val();

     var co_one_net_montly_income=parseFloat(co_one_salary_gross_income)-parseFloat(co_one_salary_tax)-parseFloat(co_one_salary_deduction);

     $('.co_one_net_montly_income').val(co_one_net_montly_income);



      // Month2 CoBorrower

      var co_two_salary_gross_income=$(".co_two_salary_gross_income").val();
      var co_two_salary_tax=$(".co_two_salary_tax").val();
      var co_two_salary_deduction=$(".co_two_salary_deduction").val();

      var co_two_net_montly_income=parseFloat(co_two_salary_gross_income)-parseFloat(co_two_salary_tax)-parseFloat(co_two_salary_deduction);

      $('.co_two_net_montly_income').val(co_two_net_montly_income);




      // Month3 CoBorrower
      

      var co_three_salary_gross_income=$(".co_three_salary_gross_income").val();
      var co_three_salary_tax=$(".co_three_salary_tax").val();
      var co_three_salary_deduction=$(".co_three_salary_deduction").val();

      var co_three_net_montly_income=parseFloat(co_three_salary_gross_income)-parseFloat(co_three_salary_tax)-parseFloat(co_three_salary_deduction);

       $('.co_three_net_montly_income').val(co_three_net_montly_income);


      // Month4 CoBorrower


      var co_four_salary_gross_income=$(".co_four_salary_gross_income").val();
      var co_four_salary_tax=$(".co_four_salary_tax").val();
      var co_four_salary_deduction=$(".co_four_salary_deduction").val();

      var co_four_net_montly_income=parseFloat(co_four_salary_gross_income)-parseFloat(co_four_salary_tax)-parseFloat(co_four_salary_deduction);

        $('.co_four_net_montly_income').val(co_four_net_montly_income);



      // Month5 CoBorrower

      var co_five_salary_gross_income=$(".co_five_salary_gross_income").val();
      var co_five_salary_tax=$(".co_five_salary_tax").val();
      var co_five_salary_deduction=$(".co_five_salary_deduction").val();

      var co_five_net_montly_income=parseFloat(co_five_salary_gross_income)-parseFloat(co_five_salary_tax)-parseFloat(co_five_salary_deduction);

      $('.co_five_net_montly_income').val(co_five_net_montly_income);


      // Month6 CoBorrower


      var co_six_salary_gross_income=$(".co_six_salary_gross_income").val();
      var co_six_salary_tax=$(".co_six_salary_tax").val();
      var co_six_salary_deduction=$(".co_six_salary_deduction").val();

      var co_six_net_montly_income=parseFloat(co_six_salary_gross_income)-parseFloat(co_six_salary_tax)-parseFloat(co_six_salary_deduction);
       
         $('.co_six_net_montly_income').val(co_six_net_montly_income);

      // Month1 CoBorrower1

     var co1_one_salary_gross_income=$(".co1_one_salary_gross_income").val();
     var co1_one_salary_tax=$(".co1_one_salary_tax").val();
     var co1_one_salary_deduction=$(".co1_one_salary_deduction").val();

     var co1_one_net_montly_income=parseFloat(co1_one_salary_gross_income)-parseFloat(co1_one_salary_tax)-parseFloat(co1_one_salary_deduction);

     $('.co1_one_net_montly_income').val(co1_one_net_montly_income);

      // Month2 CoBorrower1

      var co1_two_salary_gross_income=$(".co1_two_salary_gross_income").val();
      var co1_two_salary_tax=$(".co1_two_salary_tax").val();
      var co1_two_salary_deduction=$(".co1_two_salary_deduction").val();

      var co1_two_net_montly_income=parseFloat(co1_two_salary_gross_income)-parseFloat(co1_two_salary_tax)-parseFloat(co1_two_salary_deduction);

      $('.co1_two_net_montly_income').val(co1_two_net_montly_income);




      // Month3 CoBorrower1
      

      var co1_three_salary_gross_income=$(".co1_three_salary_gross_income").val();
      var co1_three_salary_tax=$(".co1_three_salary_tax").val();
      var co1_three_salary_deduction=$(".co1_three_salary_deduction").val();

      var co1_three_net_montly_income=parseFloat(co1_three_salary_gross_income)-parseFloat(co1_three_salary_tax)-parseFloat(co1_three_salary_deduction);

       $('.co1_three_net_montly_income').val(co1_three_net_montly_income);


      // Month4 CoBorrower1


      var co1_four_salary_gross_income=$(".co1_four_salary_gross_income").val();
      var co1_four_salary_tax=$(".co1_four_salary_tax").val();
      var co1_four_salary_deduction=$(".co1_four_salary_deduction").val();

      var co1_four_net_montly_income=parseFloat(co1_four_salary_gross_income)-parseFloat(co1_four_salary_tax)-parseFloat(co1_four_salary_deduction);

        $('.co1_four_net_montly_income').val(co1_four_net_montly_income);



      // Month5 CoBorrower1

      var co1_five_salary_gross_income=$(".co1_five_salary_gross_income").val();
      var co1_five_salary_tax=$(".co1_five_salary_tax").val();
      var co1_five_salary_deduction=$(".co1_five_salary_deduction").val();

      var co1_five_net_montly_income=parseFloat(co1_five_salary_gross_income)-parseFloat(co1_five_salary_tax)-parseFloat(co1_five_salary_deduction);

      $('.co1_five_net_montly_income').val(co1_five_net_montly_income);


      // Month6 CoBorrower1


      var co1_six_salary_gross_income=$(".co1_six_salary_gross_income").val();
      var co1_six_salary_tax=$(".co1_six_salary_tax").val();
      var co1_six_salary_deduction=$(".co1_six_salary_deduction").val();

      var co1_six_net_montly_income=parseFloat(co1_six_salary_gross_income)-parseFloat(co1_six_salary_tax)-parseFloat(co1_six_salary_deduction);
       
         $('.co1_six_net_montly_income').val(co1_six_net_montly_income);


      //Coborrower2 salaried

        // Month1 CoBorrower2

     var co2_one_salary_gross_income=$(".co2_one_salary_gross_income").val();
     var co2_one_salary_tax=$(".co2_one_salary_tax").val();
     var co2_one_salary_deduction=$(".co2_one_salary_deduction").val();

     var co2_one_net_montly_income=parseFloat(co2_one_salary_gross_income)-parseFloat(co2_one_salary_tax)-parseFloat(co2_one_salary_deduction);

     $('.co2_one_net_montly_income').val(co2_one_net_montly_income);

      // Month2 CoBorrower2

      var co2_two_salary_gross_income=$(".co2_two_salary_gross_income").val();
      var co2_two_salary_tax=$(".co2_two_salary_tax").val();
      var co2_two_salary_deduction=$(".co2_two_salary_deduction").val();

      var co2_two_net_montly_income=parseFloat(co2_two_salary_gross_income)-parseFloat(co2_two_salary_tax)-parseFloat(co2_two_salary_deduction);

      $('.co2_two_net_montly_income').val(co2_two_net_montly_income);




      // Month3 CoBorrower2
      

      var co2_three_salary_gross_income=$(".co2_three_salary_gross_income").val();
      var co2_three_salary_tax=$(".co2_three_salary_tax").val();
      var co2_three_salary_deduction=$(".co2_three_salary_deduction").val();

      var co2_three_net_montly_income=parseFloat(co2_three_salary_gross_income)-parseFloat(co2_three_salary_tax)-parseFloat(co2_three_salary_deduction);

       $('.co2_three_net_montly_income').val(co2_three_net_montly_income);


      // Month4 CoBorrower2


      var co2_four_salary_gross_income=$(".co2_four_salary_gross_income").val();
      var co2_four_salary_tax=$(".co2_four_salary_tax").val();
      var co2_four_salary_deduction=$(".co2_four_salary_deduction").val();

      var co2_four_net_montly_income=parseFloat(co2_four_salary_gross_income)-parseFloat(co2_four_salary_tax)-parseFloat(co2_four_salary_deduction);

        $('.co2_four_net_montly_income').val(co2_four_net_montly_income);



      // Month5 CoBorrower2

      var co2_five_salary_gross_income=$(".co2_five_salary_gross_income").val();
      var co2_five_salary_tax=$(".co2_five_salary_tax").val();
      var co2_five_salary_deduction=$(".co2_five_salary_deduction").val();

      var co2_five_net_montly_income=parseFloat(co2_five_salary_gross_income)-parseFloat(co2_five_salary_tax)-parseFloat(co2_five_salary_deduction);

      $('.co2_five_net_montly_income').val(co2_five_net_montly_income);


      // Month6 CoBorrower2


      var co2_six_salary_gross_income=$(".co2_six_salary_gross_income").val();
      var co2_six_salary_tax=$(".co2_six_salary_tax").val();
      var co2_six_salary_deduction=$(".co2_six_salary_deduction").val();

      var co2_six_net_montly_income=parseFloat(co2_six_salary_gross_income)-parseFloat(co2_six_salary_tax)-parseFloat(co2_six_salary_deduction);
       
         $('.co2_six_net_montly_income').val(co2_six_net_montly_income);


         // Average CoBorower2

      var co2_average_salary_gross_income=(parseFloat(co2_one_salary_gross_income)+parseFloat(co2_two_salary_gross_income)+parseFloat(co2_three_salary_gross_income)+parseFloat(co2_four_salary_gross_income)+parseFloat(co2_five_salary_gross_income)+parseFloat(co2_six_salary_gross_income))/parseFloat(co2_month_check);
      
      var co2_average_salary_tax=(parseFloat(co2_one_salary_tax)+parseFloat(co2_two_salary_tax)+parseFloat(co2_three_salary_tax)+parseFloat(co2_four_salary_tax)+parseFloat(co2_five_salary_tax)+parseFloat(co2_six_salary_tax))/parseFloat(co2_month_check);
      var co2_average_salary_deduction=(parseFloat(co2_one_salary_deduction)+parseFloat(co2_two_salary_deduction)+parseFloat(co2_three_salary_deduction)+parseFloat(co2_four_salary_deduction)+parseFloat(co2_five_salary_deduction)+parseFloat(co2_six_salary_deduction))/parseFloat(co2_month_check);


      var co2_average_net_montly_income=(parseFloat(co2_one_net_montly_income)+parseFloat(co2_two_net_montly_income)+parseFloat(co2_three_net_montly_income)+parseFloat(co2_four_net_montly_income)+parseFloat(co2_five_net_montly_income)+parseFloat(co2_six_net_montly_income))/parseFloat(co2_month_check);
      

      $('.co2_average_salary_gross_income').val(Math.round(co2_average_salary_gross_income));
      $('.co2_average_salary_tax').val(Math.round(co2_average_salary_tax));
      $('.co2_average_salary_deduction').val(Math.round(co2_average_salary_deduction));
      $('.co2_average_net_montly_income').val(Math.round(co2_average_net_montly_income));
      //End of COborrower2 Salaried
      // Average Borower

      var average_salary_gross_income=(parseFloat(one_salary_gross_income)+parseFloat(two_salary_gross_income)+parseFloat(three_salary_gross_income)+parseFloat(four_salary_gross_income)+parseFloat(five_salary_gross_income)+parseFloat(six_salary_gross_income))/parseFloat(month_check);
      
      var average_salary_tax=(parseFloat(one_salary_tax)+parseFloat(two_salary_tax)+parseFloat(three_salary_tax)+parseFloat(four_salary_tax)+parseFloat(five_salary_tax)+parseFloat(six_salary_tax))/parseFloat(month_check);

      var average_salary_deduction=(parseFloat(one_salary_deduction)+parseFloat(two_salary_deduction)+parseFloat(three_salary_deduction)+parseFloat(four_salary_deduction)+parseFloat(five_salary_deduction)+parseFloat(six_salary_deduction))/parseFloat(month_check);


      var average_net_montly_income=(parseFloat(one_net_montly_income)+parseFloat(two_net_montly_income)+parseFloat(three_net_montly_income)+parseFloat(four_net_montly_income)+parseFloat(five_net_montly_income)+parseFloat(six_net_montly_income))/parseFloat(month_check);


      $('.average_salary_gross_income').val(Math.round(average_salary_gross_income));
      $('.average_salary_tax').val(Math.round(average_salary_tax));
      $('.average_salary_deduction').val(Math.round(average_salary_deduction));
      $('.average_net_montly_income').val(Math.round(average_net_montly_income));


      // Average CoBorower

      var co_average_salary_gross_income=(parseFloat(co_one_salary_gross_income)+parseFloat(co_two_salary_gross_income)+parseFloat(co_three_salary_gross_income)+parseFloat(co_four_salary_gross_income)+parseFloat(co_five_salary_gross_income)+parseFloat(co_six_salary_gross_income))/parseFloat(co_month_check);
      
      var co_average_salary_tax=(parseFloat(co_one_salary_tax)+parseFloat(co_two_salary_tax)+parseFloat(co_three_salary_tax)+parseFloat(co_four_salary_tax)+parseFloat(co_five_salary_tax)+parseFloat(co_six_salary_tax))/parseFloat(co_month_check);
      var co_average_salary_deduction=(parseFloat(co_one_salary_deduction)+parseFloat(co_two_salary_deduction)+parseFloat(co_three_salary_deduction)+parseFloat(co_four_salary_deduction)+parseFloat(co_five_salary_deduction)+parseFloat(co_six_salary_deduction))/parseFloat(co_month_check);


      var co_average_net_montly_income=(parseFloat(co_one_net_montly_income)+parseFloat(co_two_net_montly_income)+parseFloat(co_three_net_montly_income)+parseFloat(co_four_net_montly_income)+parseFloat(co_five_net_montly_income)+parseFloat(co_six_net_montly_income))/parseFloat(co_month_check);
      

      $('.co_average_salary_gross_income').val(Math.round(co_average_salary_gross_income));
      $('.co_average_salary_tax').val(Math.round(co_average_salary_tax));
      $('.co_average_salary_deduction').val(Math.round(co_average_salary_deduction));
      $('.co_average_net_montly_income').val(Math.round(co_average_net_montly_income));

      // Average CoBorower1

      var co1_average_salary_gross_income=(parseFloat(co1_one_salary_gross_income)+parseFloat(co1_two_salary_gross_income)+parseFloat(co1_three_salary_gross_income)+parseFloat(co1_four_salary_gross_income)+parseFloat(co1_five_salary_gross_income)+parseFloat(co1_six_salary_gross_income))/parseFloat(co1_month_check);
      
      var co1_average_salary_tax=(parseFloat(co1_one_salary_tax)+parseFloat(co1_two_salary_tax)+parseFloat(co1_three_salary_tax)+parseFloat(co1_four_salary_tax)+parseFloat(co1_five_salary_tax)+parseFloat(co1_six_salary_tax))/parseFloat(co1_month_check);
      var co1_average_salary_deduction=(parseFloat(co1_one_salary_deduction)+parseFloat(co1_two_salary_deduction)+parseFloat(co1_three_salary_deduction)+parseFloat(co1_four_salary_deduction)+parseFloat(co1_five_salary_deduction)+parseFloat(co1_six_salary_deduction))/parseFloat(co1_month_check);


      var co1_average_net_montly_income=(parseFloat(co1_one_net_montly_income)+parseFloat(co1_two_net_montly_income)+parseFloat(co1_three_net_montly_income)+parseFloat(co1_four_net_montly_income)+parseFloat(co1_five_net_montly_income)+parseFloat(co1_six_net_montly_income))/parseFloat(co1_month_check);
      

      $('.co1_average_salary_gross_income').val(Math.round(co1_average_salary_gross_income));
      $('.co1_average_salary_tax').val(Math.round(co1_average_salary_tax));
      $('.co1_average_salary_deduction').val(Math.round(co1_average_salary_deduction));
      $('.co1_average_net_montly_income').val(Math.round(co1_average_net_montly_income));




// Self or profession start

      // Brower Start


      // Year1

      var self_itr_year_one=$(".self_itr_year_one").val();
      var self_gross_income_year_one=$(".self_gross_income_year_one").val();

      var self_salary_ren_year_one=$(".self_salary_ren_year_one").val();
      var self_interest_year_one=$(".self_interest_year_one").val();


      var self_agriculture_income_year_one=$(".self_agriculture_income_year_one").val();
      var self_other_income_year_one=$(".self_other_income_year_one").val();
      var self_depreciation_year_one=$(".self_depreciation_year_one").val();
      var self_tax_year_one=$(".self_tax_year_one").val();
      var self_other_ded_year_one=$(".self_other_ded_year_one").val();

      

// Year2

var self_itr_year_two=$(".self_itr_year_two").val();
var self_gross_income_year_two=$(".self_gross_income_year_two").val();
 var self_salary_ren_year_two=$(".self_salary_ren_year_two").val();
      var self_interest_year_two=$(".self_interest_year_two").val();
var self_agriculture_income_year_two=$(".self_agriculture_income_year_two").val();
var self_other_income_year_two=$(".self_other_income_year_two").val();
var self_depreciation_year_two=$(".self_depreciation_year_two").val();
var self_tax_year_two=$(".self_tax_year_two").val();
var self_other_ded_year_two=$(".self_other_ded_year_two").val();

// Year3

var self_itr_year_three=$(".self_itr_year_three").val();
var self_gross_income_year_three=$(".self_gross_income_year_three").val();

 var self_salary_ren_year_three=$(".self_salary_ren_year_three").val();
      var self_interest_year_three=$(".self_interest_year_three").val();

var self_agriculture_income_year_three=$(".self_agriculture_income_year_three").val();
var self_other_income_year_three=$(".self_other_income_year_three").val();
var self_depreciation_year_three=$(".self_depreciation_year_three").val();
var self_tax_year_three=$(".self_tax_year_three").val();
var self_other_ded_year_three=$(".self_other_ded_year_three").val();




  // borrower latest year monthly average
  var self_latest_monthly_average_gross=parseFloat(self_gross_income_year_three)/12;
  console.log(self_latest_monthly_average_gross);
   
    var self_salary_ren_latest_monthly_average=parseFloat(self_salary_ren_year_three)/12;
      var self_interest_latest_monthly_average=parseFloat(self_interest_year_three)/12;

  var self_latest_monthly_average_agriculture=parseFloat(self_agriculture_income_year_three)/12;
  var self_latest_monthly_average_other_income=parseFloat(self_other_income_year_three)/12;
  var self_latest_monthly_average_depreciation=parseFloat(self_depreciation_year_three)/12;

  var self_latest_monthly_average_tax=parseFloat(self_tax_year_three)/12;
  var self_latest_monthly_average_ded=parseFloat(self_other_ded_year_three)/12;

   // borrower All year monthly Average

   var self_all_monthly_average_gross=(parseFloat(self_gross_income_year_one)+parseFloat(self_gross_income_year_two)+parseFloat(self_gross_income_year_three))/parseFloat(total_year_month);


    var self_all_monthly_average_ren=(parseFloat(self_salary_ren_year_one)+parseFloat(self_salary_ren_year_two)+parseFloat(self_salary_ren_year_three))/parseFloat(total_year_month);
     var self_all_monthly_average_intrest=(parseFloat(self_interest_year_one)+parseFloat(self_interest_year_two)+parseFloat(self_interest_year_three))/parseFloat(total_year_month);

   console.log(self_all_monthly_average_gross+ " " +total_year_month);
   var self_all_monthly_average_agriculture=(parseFloat(self_agriculture_income_year_one)+parseFloat(self_agriculture_income_year_two)+parseFloat(self_agriculture_income_year_three))/parseFloat(total_year_month);
   var self_all_monthly_average_other_income=(parseFloat(self_other_income_year_one)+parseFloat(self_other_income_year_two)+parseFloat(self_other_income_year_three))/parseFloat(total_year_month);
   var self_all_monthly_average_depreciation=(parseFloat(self_depreciation_year_one)+parseFloat(self_depreciation_year_two)+parseFloat(self_depreciation_year_three))/parseFloat(total_year_month);

   var self_all_monthly_average_tax=(parseFloat(self_tax_year_one)+parseFloat(self_tax_year_two)+parseFloat(self_tax_year_three))/parseFloat(total_year_month);
   var self_all_monthly_average_ded=(parseFloat(self_other_ded_year_one)+parseFloat(self_other_ded_year_two)+parseFloat(self_other_ded_year_three))/parseFloat(total_year_month);



// borrower Total Gross
var self_total_gross_year_one=parseFloat(self_gross_income_year_one)+parseFloat(self_agriculture_income_year_one)+parseFloat(self_other_income_year_one)+parseFloat(self_depreciation_year_one)+parseFloat(self_salary_ren_year_one)+parseFloat(self_interest_year_one);

var self_total_gross_year_two=parseFloat(self_gross_income_year_two)+parseFloat(self_agriculture_income_year_two)+parseFloat(self_other_income_year_two)+parseFloat(self_depreciation_year_two)+parseFloat(self_salary_ren_year_two)+parseFloat(self_interest_year_two);
var self_total_gross_year_three=parseFloat(self_gross_income_year_three)+parseFloat(self_agriculture_income_year_three)+parseFloat(self_other_income_year_three)+parseFloat(self_depreciation_year_three)+parseFloat(self_salary_ren_year_three)+parseFloat(self_interest_year_three);
// borrower latest year average_total_income
var self_total_year_three_average=parseFloat(self_latest_monthly_average_gross)+parseFloat(self_latest_monthly_average_agriculture)+parseFloat(self_latest_monthly_average_other_income)+parseFloat(self_latest_monthly_average_depreciation)+parseFloat(self_salary_ren_latest_monthly_average)+parseFloat(self_interest_latest_monthly_average);

  // borrower all average_total_income
  var self_total_year_all_average=parseFloat(self_all_monthly_average_gross)+parseFloat(self_all_monthly_average_agriculture)+parseFloat(self_all_monthly_average_other_income)+parseFloat(self_all_monthly_average_depreciation)+parseFloat(self_all_monthly_average_ren)+parseFloat(self_all_monthly_average_intrest);




// borrower Total Deduction
var self_total_deduction_year_one=parseFloat(self_tax_year_one)+parseFloat(self_other_ded_year_one);
var self_total_deduction_year_two=parseFloat(self_tax_year_two)+parseFloat(self_other_ded_year_two);
var self_total_deduction_year_three=parseFloat(self_tax_year_three)+parseFloat(self_other_ded_year_three);
// borrower average_total_deduction
var self_total_deduction_year_three_average=parseFloat(self_latest_monthly_average_tax)+parseFloat(self_latest_monthly_average_ded);

  // borrower all average_total_deduction
  var self_total_deduction_year_all_average=parseFloat(self_all_monthly_average_tax)+parseFloat(self_latest_monthly_average_ded);


  // gross push && deduct push
  $('.self_total_gross_year_one').val(Math.round(self_total_gross_year_one));
  $('.self_total_gross_year_two').val(Math.round(self_total_gross_year_two));
  $('.self_total_gross_year_three').val(Math.round(self_total_gross_year_three));
  $('.self_total_deduction_year_one').val(Math.round(self_total_deduction_year_one));
  $('.self_total_deduction_year_two').val(Math.round(self_total_deduction_year_two));
  $('.self_total_deduction_year_three').val(Math.round(self_total_deduction_year_three));

    // latest average push
    $('.self_latest_monthly_average_gross').val(Math.round(self_latest_monthly_average_gross));
     $('.self_salary_monthly_average_gross').val(Math.round(self_salary_ren_latest_monthly_average));
      $('.self_interest_monthly_average_gross').val(Math.round(self_interest_latest_monthly_average));
    $('.self_latest_monthly_average_agriculture').val(Math.round(self_latest_monthly_average_agriculture));
    $('.self_latest_monthly_average_other_income').val(Math.round(self_latest_monthly_average_other_income));
    $('.self_latest_monthly_average_depreciation').val(Math.round(self_latest_monthly_average_depreciation));
    $('.self_latest_monthly_average_tax').val(Math.round(self_latest_monthly_average_tax));
    $('.self_latest_monthly_average_ded').val(Math.round(self_latest_monthly_average_ded));

    // all average push
    $('.self_all_monthly_average_gross').val(Math.round(self_all_monthly_average_gross));
    
    $('.self_salary_ren_avg_all').val(Math.round(self_all_monthly_average_ren));
      $('.self_interest_avg_all').val(Math.round(self_all_monthly_average_intrest));

    $('.self_all_monthly_average_agriculture').val(Math.round(self_all_monthly_average_agriculture));
    $('.self_all_monthly_average_other_income').val(Math.round(self_all_monthly_average_other_income));
    $('.self_all_monthly_average_depreciation').val(Math.round(self_all_monthly_average_depreciation));
    $('.self_all_monthly_average_tax').val(Math.round(self_all_monthly_average_tax));
    $('.self_all_monthly_average_ded').val(Math.round(self_all_monthly_average_ded));


    // total avg income/deduction latest & all

    $('.self_total_deduction_year_three_average').val(Math.round(self_total_deduction_year_three_average));
    $('.self_total_deduction_year_all_average').val(Math.round(self_total_deduction_year_all_average));
    $('.self_total_year_three_average').val(Math.round(self_total_year_three_average));
    $('.self_total_year_all_average').val(Math.round(self_total_year_all_average));



    // Brower End


    // Co Brower


    // Cobrower

      // Year1

// var co_self_itr_year_one=$(".co_self_itr_year_one").val();
// var co_self_gross_income_year_one=$(".co_self_gross_income_year_one").val();
// var co_self_agriculture_income_year_one=$(".co_self_agriculture_income_year_one").val();
// var co_self_other_income_year_one=$(".co_self_other_income_year_one").val();
// var co_self_depreciation_year_one=$(".co_self_depreciation_year_one").val();
// var co_self_tax_year_one=$(".co_self_tax_year_one").val();
// var co_self_other_ded_year_one=$(".co_self_other_ded_year_one").val();

// Year2

// var co_self_itr_year_two=$(".co_self_itr_year_two").val();
// var co_self_gross_income_year_two=$(".co_self_gross_income_year_two").val();
// var co_self_agriculture_income_year_two=$(".co_self_agriculture_income_year_two").val();
// var co_self_other_income_year_two=$(".co_self_other_income_year_two").val();
// var co_self_depreciation_year_two=$(".co_self_depreciation_year_two").val();
// var co_self_tax_year_two=$(".co_self_tax_year_two").val();
// var co_self_other_ded_year_two=$(".co_self_other_ded_year_two").val();

// Year3

// var co_self_itr_year_three=$(".co_self_itr_year_three").val();
// var co_self_gross_income_year_three=$(".co_self_gross_income_year_three").val();
// var co_self_agriculture_income_year_three=$(".co_self_agriculture_income_year_three").val();
// var co_self_other_income_year_three=$(".co_self_other_income_year_three").val();
// var co_self_depreciation_year_three=$(".co_self_depreciation_year_three").val();
// var co_self_tax_year_three=$(".co_self_tax_year_three").val();
// var co_self_other_ded_year_three=$(".co_self_other_ded_year_three").val();
  
  //**************
    //*********CoBorrower2*********
    // Year1

      var co2_self_itr_year_one=$(".co2_self_itr_year_one").val();
      var co2_self_gross_income_year_one=$(".co2_self_gross_income_year_one").val();
 
      var selfco2_salary_ren_year_one=$(".selfco2_salary_ren_year_one").val();
      var selfco2_interest_year_one=$(".selfco2_interest_year_one").val();

      var co2_self_agriculture_income_year_one=$(".co2_self_agriculture_income_year_one").val();
      var co2_self_other_income_year_one=$(".co2_self_other_income_year_one").val();
      var co2_self_depreciation_year_one=$(".co2_self_depreciation_year_one").val();
      var co2_self_tax_year_one=$(".co2_self_tax_year_one").val();
      var co2_self_other_ded_year_one=$(".co2_self_other_ded_year_one").val();

      // Year2

var co2_self_itr_year_two=$(".co2_self_itr_year_two").val();
var co2_self_gross_income_year_two=$(".self2_gross_income_year_two").val();
 
       var selfco2_salary_ren_year_two=$(".self2_salary_ren_year_two").val();
      var selfco2_interest_year_two=$(".self2_interest_year_two").val();

var co2_self_agriculture_income_year_two=$(".self2_agriculture_income_year_two").val();
var co2_self_other_income_year_two=$(".self2_other_income_year_two").val();
var co2_self_depreciation_year_two=$(".self2_depreciation_year_two").val();
var co2_self_tax_year_two=$(".self2_tax_year_two").val();
var co2_self_other_ded_year_two=$(".self2_other_ded_year_two").val();

// Year3

var co2_self_itr_year_three=$(".self2_itr_year_three").val();
var co2_self_gross_income_year_three=$(".self2_gross_income_year_three").val();

var selfco2_salary_ren_year_three=$(".self2_salary_ren_year_three").val();
var selfco2_interest_year_three=$(".self2_interest_year_three").val();

var co2_self_agriculture_income_year_three=$(".self2_agriculture_income_year_three").val();
var co2_self_other_income_year_three=$(".self2_other_income_year_three").val();
var co2_self_depreciation_year_three=$(".self2_depreciation_year_three").val();
var co2_self_tax_year_three=$(".self2_tax_year_three").val();
var co2_self_other_ded_year_three=$(".self2_other_ded_year_three").val();




  // coborrower1 latest year monthly average
  var co2_self_latest_monthly_average_gross=parseFloat(co2_self_gross_income_year_three)/12;
  console.log(co2_self_latest_monthly_average_gross);


  var co2_self_latest_monthly_average_ren=parseFloat(selfco2_salary_ren_year_three)/12;
  var co2_self_latest_monthly_average_interest=parseFloat(selfco2_interest_year_three)/12;


  var co2_self_latest_monthly_average_agriculture=parseFloat(co2_self_agriculture_income_year_three)/12;
  var co2_self_latest_monthly_average_other_income=parseFloat(co2_self_other_income_year_three)/12;
  var co2_self_latest_monthly_average_depreciation=parseFloat(co2_self_depreciation_year_three)/12;

  var co2_self_latest_monthly_average_tax=parseFloat(co2_self_tax_year_three)/12;
  var co2_self_latest_monthly_average_ded=parseFloat(co2_self_other_ded_year_three)/12;

   // Coborrower2 All year monthly Average

   var co2_self_all_monthly_average_gross=(parseFloat(co2_self_gross_income_year_one)+parseFloat(co2_self_gross_income_year_two)+parseFloat(co2_self_gross_income_year_three))/parseFloat(co2_total_co_year_month);

      var co2_self_all_monthly_average_ren=(parseFloat(selfco2_salary_ren_year_one)+parseFloat(selfco2_salary_ren_year_two)+parseFloat(selfco2_salary_ren_year_three))/parseFloat(co2_total_co_year_month);
         var co2_self_all_monthly_average_interest=(parseFloat(selfco2_interest_year_one)+parseFloat(selfco2_interest_year_two)+parseFloat(selfco2_interest_year_three))/parseFloat(co2_total_co_year_month);

   console.log(co2_self_all_monthly_average_gross);
   var co2_self_all_monthly_average_agriculture=(parseFloat(co2_self_agriculture_income_year_one)+parseFloat(co2_self_agriculture_income_year_two)+parseFloat(co2_self_agriculture_income_year_three))/parseFloat(co2_total_co_year_month);
   var co2_self_all_monthly_average_other_income=(parseFloat(co2_self_other_income_year_one)+parseFloat(co2_self_other_income_year_two)+parseFloat(co2_self_other_income_year_three))/parseFloat(co2_total_co_year_month);
   var co2_self_all_monthly_average_depreciation=(parseFloat(co2_self_depreciation_year_one)+parseFloat(co2_self_depreciation_year_two)+parseFloat(co2_self_depreciation_year_three))/parseFloat(co2_total_co_year_month);

   var co2_self_all_monthly_average_tax=(parseFloat(co2_self_tax_year_one)+parseFloat(co2_self_tax_year_two)+parseFloat(co2_self_tax_year_three))/parseFloat(co2_total_co_year_month);
   var co2_self_all_monthly_average_ded=(parseFloat(co2_self_other_ded_year_one)+parseFloat(co2_self_other_ded_year_two)+parseFloat(co2_self_other_ded_year_three))/parseFloat(co2_total_co_year_month);

// Coborrower2 Total Gross
var co2_self_total_gross_year_one=parseFloat(co2_self_gross_income_year_one)+parseFloat(co2_self_agriculture_income_year_one)+parseFloat(co2_self_other_income_year_one)+parseFloat(co2_self_depreciation_year_one)+parseFloat(selfco2_salary_ren_year_one)+parseFloat(selfco2_interest_year_one);

var co2_self_total_gross_year_two=parseFloat(co2_self_gross_income_year_two)+parseFloat(co2_self_agriculture_income_year_two)+parseFloat(co2_self_other_income_year_two)+parseFloat(co2_self_depreciation_year_two)+parseFloat(selfco2_salary_ren_year_two)+parseFloat(selfco2_interest_year_two);

var co2_self_total_gross_year_three=parseFloat(co2_self_gross_income_year_three)+parseFloat(co2_self_agriculture_income_year_three)+parseFloat(co2_self_other_income_year_three)+parseFloat(co2_self_depreciation_year_three)+parseFloat(selfco2_salary_ren_year_three)+parseFloat(selfco2_interest_year_three);
// Coborrower2 latest year average_total_income
var co2_self_total_year_three_average=parseFloat(co2_self_latest_monthly_average_gross)+parseFloat(co2_self_latest_monthly_average_agriculture)+parseFloat(co2_self_latest_monthly_average_other_income)+parseFloat(co2_self_latest_monthly_average_depreciation)+parseFloat(co2_self_latest_monthly_average_ren)+parseFloat(co2_self_latest_monthly_average_interest);

  // Coborrower2 all average_total_income
  var co2_self_total_year_all_average=parseFloat(co2_self_all_monthly_average_gross)+parseFloat(co2_self_all_monthly_average_agriculture)+parseFloat(co2_self_all_monthly_average_other_income)+parseFloat(co2_self_all_monthly_average_depreciation)+parseFloat(co2_self_all_monthly_average_ren)+parseFloat(co2_self_all_monthly_average_interest);




// Coborrower2 Total Deduction
var co2_self_total_deduction_year_one=parseFloat(co2_self_tax_year_one)+parseFloat(co2_self_other_ded_year_one);
var co2_self_total_deduction_year_two=parseFloat(co2_self_tax_year_two)+parseFloat(co2_self_other_ded_year_two);
var co2_self_total_deduction_year_three=parseFloat(co2_self_tax_year_three)+parseFloat(co2_self_other_ded_year_three);
// Coborrower2 average_total_deduction
var co2_self_total_deduction_year_three_average=parseFloat(co2_self_latest_monthly_average_tax)+parseFloat(co2_self_latest_monthly_average_ded);

  // Coborrower2 all average_total_deduction
  var co2_self_total_deduction_year_all_average=parseFloat(co2_self_all_monthly_average_tax)+parseFloat(co2_self_latest_monthly_average_ded);

 // gross push && deduct push
  $('.co2_self_total_gross_year_one').val(Math.round(co2_self_total_gross_year_one));
  $('.self2_total_gross_year_two').val(Math.round(co2_self_total_gross_year_two));
  $('.self2_total_gross_year_three').val(Math.round(co2_self_total_gross_year_three));
  $('.co2_self_total_deduction_year_one').val(Math.round(co2_self_total_deduction_year_one));
  $('.self2_total_deduction_year_two').val(Math.round(co2_self_total_deduction_year_two));
  $('.self2_total_deduction_year_three').val(Math.round(co2_self_total_deduction_year_three));

    // latest average push
    $('.self2_latest_monthly_average_gross').val(Math.round(co2_self_latest_monthly_average_gross));

        $('.self2_salary_monthly_average_gross').val(Math.round(co2_self_latest_monthly_average_ren));
            $('.self2_interest_monthly_average_gross').val(Math.round(co2_self_latest_monthly_average_interest));


    $('.self2_latest_monthly_average_agriculture').val(Math.round(co2_self_latest_monthly_average_agriculture));
    $('.self2_latest_monthly_average_other_income').val(Math.round(co2_self_latest_monthly_average_other_income));
    $('.self2_latest_monthly_average_depreciation').val(Math.round(co2_self_latest_monthly_average_depreciation));
    $('.self2_latest_monthly_average_tax').val(Math.round(co2_self_latest_monthly_average_tax));
    $('.self2_latest_monthly_average_ded').val(Math.round(co2_self_latest_monthly_average_ded));

    // all average push
    $('.co2_self_all_monthly_average_gross').val(Math.round(co2_self_all_monthly_average_gross));
     
       $('.selfco2_salary_ren_all_monthly_average_gross').val(Math.round(co2_self_all_monthly_average_ren));
            $('.selfco2_interest_all_monthly_average_gross').val(Math.round(co2_self_all_monthly_average_interest));

    $('.co2_self_all_monthly_average_agriculture').val(Math.round(co2_self_all_monthly_average_agriculture));
    $('.co2_self_all_monthly_average_other_income').val(Math.round(co2_self_all_monthly_average_other_income));
    $('.co2_self_all_monthly_average_depreciation').val(Math.round(co2_self_all_monthly_average_depreciation));
    $('.co2_self_all_monthly_average_tax').val(Math.round(co2_self_all_monthly_average_tax));
    $('.co2_self_all_monthly_average_ded').val(Math.round(co2_self_all_monthly_average_ded));


    // total avg income/deduction latest & all

    $('.self2_total_deduction_year_three_average').val(Math.round(co2_self_total_deduction_year_three_average));
    $('.co2_self_total_deduction_year_all_average').val(Math.round(co2_self_total_deduction_year_all_average));
    $('.self2_total_year_three_average').val(Math.round(co2_self_total_year_three_average));
    $('.co2_self_total_year_all_average').val(Math.round(co2_self_total_year_all_average));

  //*********CoBorrower1*********
    // Year1

      var co1_self_itr_year_one=$(".co1_self_itr_year_one").val();
      var co1_self_gross_income_year_one=$(".co1_self_gross_income_year_one").val();
 
      var selfco1_salary_ren_year_one=$(".selfco1_salary_ren_year_one").val();
      var selfco1_interest_year_one=$(".selfco1_interest_year_one").val();

      var co1_self_agriculture_income_year_one=$(".co1_self_agriculture_income_year_one").val();
      var co1_self_other_income_year_one=$(".co1_self_other_income_year_one").val();
      var co1_self_depreciation_year_one=$(".co1_self_depreciation_year_one").val();
      var co1_self_tax_year_one=$(".co1_self_tax_year_one").val();
      var co1_self_other_ded_year_one=$(".co1_self_other_ded_year_one").val();

      // Year2

var co1_self_itr_year_two=$(".co1_self_itr_year_two").val();
var co1_self_gross_income_year_two=$(".self1_gross_income_year_two").val();
 
       var selfco1_salary_ren_year_two=$(".self1_salary_ren_year_two").val();
      var selfco1_interest_year_two=$(".self1_interest_year_two").val();

var co1_self_agriculture_income_year_two=$(".self1_agriculture_income_year_two").val();
var co1_self_other_income_year_two=$(".self1_other_income_year_two").val();
var co1_self_depreciation_year_two=$(".self1_depreciation_year_two").val();
var co1_self_tax_year_two=$(".self1_tax_year_two").val();
var co1_self_other_ded_year_two=$(".self1_other_ded_year_two").val();

// Year3

var co1_self_itr_year_three=$(".self1_itr_year_three").val();
var co1_self_gross_income_year_three=$(".self1_gross_income_year_three").val();

       var selfco1_salary_ren_year_three=$(".self1_salary_ren_year_three").val();
      var selfco1_interest_year_three=$(".self1_interest_year_three").val();

var co1_self_agriculture_income_year_three=$(".self1_agriculture_income_year_three").val();
var co1_self_other_income_year_three=$(".self1_other_income_year_three").val();
var co1_self_depreciation_year_three=$(".self1_depreciation_year_three").val();
var co1_self_tax_year_three=$(".self1_tax_year_three").val();
var co1_self_other_ded_year_three=$(".self1_other_ded_year_three").val();




  // coborrower1 latest year monthly average
  var co1_self_latest_monthly_average_gross=parseFloat(co1_self_gross_income_year_three)/12;
  console.log(co1_self_latest_monthly_average_gross);


  var co1_self_latest_monthly_average_ren=parseFloat(selfco1_salary_ren_year_three)/12;
  var co1_self_latest_monthly_average_interest=parseFloat(selfco1_interest_year_three)/12;


  var co1_self_latest_monthly_average_agriculture=parseFloat(co1_self_agriculture_income_year_three)/12;
  var co1_self_latest_monthly_average_other_income=parseFloat(co1_self_other_income_year_three)/12;
  var co1_self_latest_monthly_average_depreciation=parseFloat(co1_self_depreciation_year_three)/12;

  var co1_self_latest_monthly_average_tax=parseFloat(co1_self_tax_year_three)/12;
  var co1_self_latest_monthly_average_ded=parseFloat(co1_self_other_ded_year_three)/12;

   // Coborrower1 All year monthly Average

   var co1_self_all_monthly_average_gross=(parseFloat(co1_self_gross_income_year_one)+parseFloat(co1_self_gross_income_year_two)+parseFloat(co1_self_gross_income_year_three))/parseFloat(co1_total_co_year_month);

      var co1_self_all_monthly_average_ren=(parseFloat(selfco1_salary_ren_year_one)+parseFloat(selfco1_salary_ren_year_two)+parseFloat(selfco1_salary_ren_year_three))/parseFloat(co1_total_co_year_month);
         var co1_self_all_monthly_average_interest=(parseFloat(selfco1_interest_year_one)+parseFloat(selfco1_interest_year_two)+parseFloat(selfco1_interest_year_three))/parseFloat(co1_total_co_year_month);

   console.log(co1_self_all_monthly_average_gross);
   var co1_self_all_monthly_average_agriculture=(parseFloat(co1_self_agriculture_income_year_one)+parseFloat(co1_self_agriculture_income_year_two)+parseFloat(co1_self_agriculture_income_year_three))/parseFloat(co1_total_co_year_month);
   var co1_self_all_monthly_average_other_income=(parseFloat(co1_self_other_income_year_one)+parseFloat(co1_self_other_income_year_two)+parseFloat(co1_self_other_income_year_three))/parseFloat(co1_total_co_year_month);
   var co1_self_all_monthly_average_depreciation=(parseFloat(co1_self_depreciation_year_one)+parseFloat(co1_self_depreciation_year_two)+parseFloat(co1_self_depreciation_year_three))/parseFloat(co1_total_co_year_month);

   var co1_self_all_monthly_average_tax=(parseFloat(co1_self_tax_year_one)+parseFloat(co1_self_tax_year_two)+parseFloat(co1_self_tax_year_three))/parseFloat(co1_total_co_year_month);
   var co1_self_all_monthly_average_ded=(parseFloat(co1_self_other_ded_year_one)+parseFloat(co1_self_other_ded_year_two)+parseFloat(co1_self_other_ded_year_three))/parseFloat(co1_total_co_year_month);

// Coborrower1 Total Gross
var co1_self_total_gross_year_one=parseFloat(co1_self_gross_income_year_one)+parseFloat(co1_self_agriculture_income_year_one)+parseFloat(co1_self_other_income_year_one)+parseFloat(co1_self_depreciation_year_one)+parseFloat(selfco1_salary_ren_year_one)+parseFloat(selfco1_interest_year_one);

var co1_self_total_gross_year_two=parseFloat(co1_self_gross_income_year_two)+parseFloat(co1_self_agriculture_income_year_two)+parseFloat(co1_self_other_income_year_two)+parseFloat(co1_self_depreciation_year_two)+parseFloat(selfco1_salary_ren_year_two)+parseFloat(selfco1_interest_year_two);

var co1_self_total_gross_year_three=parseFloat(co1_self_gross_income_year_three)+parseFloat(co1_self_agriculture_income_year_three)+parseFloat(co1_self_other_income_year_three)+parseFloat(co1_self_depreciation_year_three)+parseFloat(selfco1_salary_ren_year_three)+parseFloat(selfco1_interest_year_three);
// Coborrower1 latest year average_total_income
var co1_self_total_year_three_average=parseFloat(co1_self_latest_monthly_average_gross)+parseFloat(co1_self_latest_monthly_average_agriculture)+parseFloat(co1_self_latest_monthly_average_other_income)+parseFloat(co1_self_latest_monthly_average_depreciation)+parseFloat(co1_self_latest_monthly_average_ren)+parseFloat(co1_self_latest_monthly_average_interest);

  // Coborrower1 all average_total_income
  var co1_self_total_year_all_average=parseFloat(co1_self_all_monthly_average_gross)+parseFloat(co1_self_all_monthly_average_agriculture)+parseFloat(co1_self_all_monthly_average_other_income)+parseFloat(co1_self_all_monthly_average_depreciation)+parseFloat(co1_self_all_monthly_average_ren)+parseFloat(co1_self_all_monthly_average_interest);




// Coborrower1 Total Deduction
var co1_self_total_deduction_year_one=parseFloat(co1_self_tax_year_one)+parseFloat(co1_self_other_ded_year_one);
var co1_self_total_deduction_year_two=parseFloat(co1_self_tax_year_two)+parseFloat(co1_self_other_ded_year_two);
var co1_self_total_deduction_year_three=parseFloat(co1_self_tax_year_three)+parseFloat(co1_self_other_ded_year_three);
// Coborrower1 average_total_deduction
var co1_self_total_deduction_year_three_average=parseFloat(co1_self_latest_monthly_average_tax)+parseFloat(co1_self_latest_monthly_average_ded);

  // Coborrower1 all average_total_deduction
  var co1_self_total_deduction_year_all_average=parseFloat(co1_self_all_monthly_average_tax)+parseFloat(co1_self_latest_monthly_average_ded);

 // gross push && deduct push
  $('.co1_self_total_gross_year_one').val(Math.round(co1_self_total_gross_year_one));
  $('.self1_total_gross_year_two').val(Math.round(co1_self_total_gross_year_two));
  $('.self1_total_gross_year_three').val(Math.round(co1_self_total_gross_year_three));
  $('.co1_self_total_deduction_year_one').val(Math.round(co1_self_total_deduction_year_one));
  $('.self1_total_deduction_year_two').val(Math.round(co1_self_total_deduction_year_two));
  $('.self1_total_deduction_year_three').val(Math.round(co1_self_total_deduction_year_three));

    // latest average push
    $('.self1_latest_monthly_average_gross').val(Math.round(co1_self_latest_monthly_average_gross));

        $('.self1_salary_monthly_average_gross').val(Math.round(co1_self_latest_monthly_average_ren));
            $('.self1_interest_monthly_average_gross').val(Math.round(co1_self_latest_monthly_average_interest));


    $('.self1_latest_monthly_average_agriculture').val(Math.round(co1_self_latest_monthly_average_agriculture));
    $('.self1_latest_monthly_average_other_income').val(Math.round(co1_self_latest_monthly_average_other_income));
    $('.self1_latest_monthly_average_depreciation').val(Math.round(co1_self_latest_monthly_average_depreciation));
    $('.self1_latest_monthly_average_tax').val(Math.round(co1_self_latest_monthly_average_tax));
    $('.self1_latest_monthly_average_ded').val(Math.round(co1_self_latest_monthly_average_ded));

    // all average push
    $('.co1_self_all_monthly_average_gross').val(Math.round(co1_self_all_monthly_average_gross));
     
       $('.selfco1_salary_ren_all_monthly_average_gross').val(Math.round(co1_self_all_monthly_average_ren));
            $('.selfco1_interest_all_monthly_average_gross').val(Math.round(co1_self_all_monthly_average_interest));

    $('.co1_self_all_monthly_average_agriculture').val(Math.round(co1_self_all_monthly_average_agriculture));
    $('.co1_self_all_monthly_average_other_income').val(Math.round(co1_self_all_monthly_average_other_income));
    $('.co1_self_all_monthly_average_depreciation').val(Math.round(co1_self_all_monthly_average_depreciation));
    $('.co1_self_all_monthly_average_tax').val(Math.round(co1_self_all_monthly_average_tax));
    $('.co1_self_all_monthly_average_ded').val(Math.round(co1_self_all_monthly_average_ded));


    // total avg income/deduction latest & all

    $('.self1_total_deduction_year_three_average').val(Math.round(co1_self_total_deduction_year_three_average));
    $('.co1_self_total_deduction_year_all_average').val(Math.round(co1_self_total_deduction_year_all_average));
    $('.self1_total_year_three_average').val(Math.round(co1_self_total_year_three_average));
    $('.co1_self_total_year_all_average').val(Math.round(co1_self_total_year_all_average));




//*******************************
      // Year1

      var co_self_itr_year_one=$(".co_self_itr_year_one").val();
      var co_self_gross_income_year_one=$(".co_self_gross_income_year_one").val();
 
      var selfco_salary_ren_year_one=$(".selfco_salary_ren_year_one").val();
      var selfco_interest_year_one=$(".selfco_interest_year_one").val();

      var co_self_agriculture_income_year_one=$(".co_self_agriculture_income_year_one").val();
      var co_self_other_income_year_one=$(".co_self_other_income_year_one").val();
      var co_self_depreciation_year_one=$(".co_self_depreciation_year_one").val();
      var co_self_tax_year_one=$(".co_self_tax_year_one").val();
      var co_self_other_ded_year_one=$(".co_self_other_ded_year_one").val();

// Year2

var co_self_itr_year_two=$(".co_self_itr_year_two").val();
var co_self_gross_income_year_two=$(".co_self_gross_income_year_two").val();
 
       var selfco_salary_ren_year_two=$(".selfco_salary_ren_year_two").val();
      var selfco_interest_year_two=$(".selfco_interest_year_two").val();

var co_self_agriculture_income_year_two=$(".co_self_agriculture_income_year_two").val();
var co_self_other_income_year_two=$(".co_self_other_income_year_two").val();
var co_self_depreciation_year_two=$(".co_self_depreciation_year_two").val();
var co_self_tax_year_two=$(".co_self_tax_year_two").val();
var co_self_other_ded_year_two=$(".co_self_other_ded_year_two").val();

// Year3

var co_self_itr_year_three=$(".co_self_itr_year_three").val();
var co_self_gross_income_year_three=$(".co_self_gross_income_year_three").val();

       var selfco_salary_ren_year_three=$(".selfco_salary_ren_year_three").val();
      var selfco_interest_year_three=$(".selfco_interest_year_three").val();

var co_self_agriculture_income_year_three=$(".co_self_agriculture_income_year_three").val();
var co_self_other_income_year_three=$(".co_self_other_income_year_three").val();
var co_self_depreciation_year_three=$(".co_self_depreciation_year_three").val();
var co_self_tax_year_three=$(".co_self_tax_year_three").val();
var co_self_other_ded_year_three=$(".co_self_other_ded_year_three").val();




  // borrower latest year monthly average
  var co_self_latest_monthly_average_gross=parseFloat(co_self_gross_income_year_three)/12;
  console.log(co_self_latest_monthly_average_gross);


  var co_self_latest_monthly_average_ren=parseFloat(selfco_salary_ren_year_three)/12;
  var co_self_latest_monthly_average_interest=parseFloat(selfco_interest_year_three)/12;


  var co_self_latest_monthly_average_agriculture=parseFloat(co_self_agriculture_income_year_three)/12;
  var co_self_latest_monthly_average_other_income=parseFloat(co_self_other_income_year_three)/12;
  var co_self_latest_monthly_average_depreciation=parseFloat(co_self_depreciation_year_three)/12;

  var co_self_latest_monthly_average_tax=parseFloat(co_self_tax_year_three)/12;
  var co_self_latest_monthly_average_ded=parseFloat(co_self_other_ded_year_three)/12;

   // borrower All year monthly Average

   var co_self_all_monthly_average_gross=(parseFloat(co_self_gross_income_year_one)+parseFloat(co_self_gross_income_year_two)+parseFloat(co_self_gross_income_year_three))/parseFloat(co_total_co_year_month);

      var co_self_all_monthly_average_ren=(parseFloat(selfco_salary_ren_year_one)+parseFloat(selfco_salary_ren_year_two)+parseFloat(selfco_salary_ren_year_three))/parseFloat(co_total_co_year_month);
         var co_self_all_monthly_average_interest=(parseFloat(selfco_interest_year_one)+parseFloat(selfco_interest_year_two)+parseFloat(selfco_interest_year_three))/parseFloat(co_total_co_year_month);

   console.log(co_self_all_monthly_average_gross);
   var co_self_all_monthly_average_agriculture=(parseFloat(co_self_agriculture_income_year_one)+parseFloat(co_self_agriculture_income_year_two)+parseFloat(co_self_agriculture_income_year_three))/parseFloat(co_total_co_year_month);
   var co_self_all_monthly_average_other_income=(parseFloat(co_self_other_income_year_one)+parseFloat(co_self_other_income_year_two)+parseFloat(co_self_other_income_year_three))/parseFloat(co_total_co_year_month);
   var co_self_all_monthly_average_depreciation=(parseFloat(co_self_depreciation_year_one)+parseFloat(co_self_depreciation_year_two)+parseFloat(co_self_depreciation_year_three))/parseFloat(co_total_co_year_month);

   var co_self_all_monthly_average_tax=(parseFloat(co_self_tax_year_one)+parseFloat(co_self_tax_year_two)+parseFloat(co_self_tax_year_three))/parseFloat(co_total_co_year_month);
   var co_self_all_monthly_average_ded=(parseFloat(co_self_other_ded_year_one)+parseFloat(co_self_other_ded_year_two)+parseFloat(co_self_other_ded_year_three))/parseFloat(co_total_co_year_month);



// borrower Total Gross
var co_self_total_gross_year_one=parseFloat(co_self_gross_income_year_one)+parseFloat(co_self_agriculture_income_year_one)+parseFloat(co_self_other_income_year_one)+parseFloat(co_self_depreciation_year_one)+parseFloat(selfco_salary_ren_year_one)+parseFloat(selfco_interest_year_one);

var co_self_total_gross_year_two=parseFloat(co_self_gross_income_year_two)+parseFloat(co_self_agriculture_income_year_two)+parseFloat(co_self_other_income_year_two)+parseFloat(co_self_depreciation_year_two)+parseFloat(selfco_salary_ren_year_two)+parseFloat(selfco_interest_year_two);

var co_self_total_gross_year_three=parseFloat(co_self_gross_income_year_three)+parseFloat(co_self_agriculture_income_year_three)+parseFloat(co_self_other_income_year_three)+parseFloat(co_self_depreciation_year_three)+parseFloat(selfco_salary_ren_year_three)+parseFloat(selfco_interest_year_three);
// borrower latest year average_total_income
var co_self_total_year_three_average=parseFloat(co_self_latest_monthly_average_gross)+parseFloat(co_self_latest_monthly_average_agriculture)+parseFloat(co_self_latest_monthly_average_other_income)+parseFloat(co_self_latest_monthly_average_depreciation)+parseFloat(co_self_latest_monthly_average_ren)+parseFloat(co_self_latest_monthly_average_interest);

  // borrower all average_total_income
  var co_self_total_year_all_average=parseFloat(co_self_all_monthly_average_gross)+parseFloat(co_self_all_monthly_average_agriculture)+parseFloat(co_self_all_monthly_average_other_income)+parseFloat(co_self_all_monthly_average_depreciation)+parseFloat(co_self_all_monthly_average_ren)+parseFloat(co_self_all_monthly_average_interest);




// borrower Total Deduction
var co_self_total_deduction_year_one=parseFloat(co_self_tax_year_one)+parseFloat(co_self_other_ded_year_one);
var co_self_total_deduction_year_two=parseFloat(co_self_tax_year_two)+parseFloat(co_self_other_ded_year_two);
var co_self_total_deduction_year_three=parseFloat(co_self_tax_year_three)+parseFloat(co_self_other_ded_year_three);
// borrower average_total_deduction
var co_self_total_deduction_year_three_average=parseFloat(co_self_latest_monthly_average_tax)+parseFloat(co_self_latest_monthly_average_ded);

  // borrower all average_total_deduction
  var co_self_total_deduction_year_all_average=parseFloat(co_self_all_monthly_average_tax)+parseFloat(co_self_latest_monthly_average_ded);




  // gross push && deduct push
  $('.co_self_total_gross_year_one').val(Math.round(co_self_total_gross_year_one));
  $('.co_self_total_gross_year_two').val(Math.round(co_self_total_gross_year_two));
  $('.co_self_total_gross_year_three').val(Math.round(co_self_total_gross_year_three));
  $('.co_self_total_deduction_year_one').val(Math.round(co_self_total_deduction_year_one));
  $('.co_self_total_deduction_year_two').val(Math.round(co_self_total_deduction_year_two));
  $('.co_self_total_deduction_year_three').val(Math.round(co_self_total_deduction_year_three));

    // latest average push
    $('.co_self_latest_monthly_average_gross').val(Math.round(co_self_latest_monthly_average_gross));

        $('.selfco_salary_ren_monthly_average_gross').val(Math.round(co_self_latest_monthly_average_ren));
            $('.selfco_interest_monthly_average_gross').val(Math.round(co_self_latest_monthly_average_interest));


    $('.co_self_latest_monthly_average_agriculture').val(Math.round(co_self_latest_monthly_average_agriculture));
    $('.co_self_latest_monthly_average_other_income').val(Math.round(co_self_latest_monthly_average_other_income));
    $('.co_self_latest_monthly_average_depreciation').val(Math.round(co_self_latest_monthly_average_depreciation));
    $('.co_self_latest_monthly_average_tax').val(Math.round(co_self_latest_monthly_average_tax));
    $('.co_self_latest_monthly_average_ded').val(Math.round(co_self_latest_monthly_average_ded));

    // all average push
    $('.co_self_all_monthly_average_gross').val(Math.round(co_self_all_monthly_average_gross));
     
       $('.selfco_salary_ren_all_monthly_average_gross').val(Math.round(co_self_all_monthly_average_ren));
            $('.selfco_interest_all_monthly_average_gross').val(Math.round(co_self_all_monthly_average_interest));

    $('.co_self_all_monthly_average_agriculture').val(Math.round(co_self_all_monthly_average_agriculture));
    $('.co_self_all_monthly_average_other_income').val(Math.round(co_self_all_monthly_average_other_income));
    $('.co_self_all_monthly_average_depreciation').val(Math.round(co_self_all_monthly_average_depreciation));
    $('.co_self_all_monthly_average_tax').val(Math.round(co_self_all_monthly_average_tax));
    $('.co_self_all_monthly_average_ded').val(Math.round(co_self_all_monthly_average_ded));


    // total avg income/deduction latest & all

    $('.co_self_total_deduction_year_three_average').val(Math.round(co_self_total_deduction_year_three_average));
    $('.co_self_total_deduction_year_all_average').val(Math.round(co_self_total_deduction_year_all_average));
    $('.co_self_total_year_three_average').val(Math.round(co_self_total_year_three_average));
    $('.co_self_total_year_all_average').val(Math.round(co_self_total_year_all_average));




    // Co Brower End




  // gross_income disposal

  var total_monthly_gross_income=parseFloat(self_total_year_three_average)+parseFloat(co_self_total_year_three_average)+parseFloat(eligilble_rental_income)+
  parseFloat(eligilble_other_income)+parseFloat(six_salary_gross_income)+parseFloat(co_six_salary_gross_income);

  var total_monthly_gross_income_two=parseFloat(self_total_year_all_average)+parseFloat(co_self_total_year_all_average)+parseFloat(eligilble_rental_income)+
  parseFloat(eligilble_other_income)+parseFloat(average_salary_gross_income)+parseFloat(co_average_salary_gross_income);


  var new_deduction=parseFloat(self_total_deduction_year_three_average)+parseFloat(co_self_total_deduction_year_three_average)+parseFloat(six_salary_deduction)+parseFloat(co_six_salary_deduction);

  var new_deduction_two=parseFloat(self_total_deduction_year_all_average)+parseFloat(co_self_total_deduction_year_all_average)+parseFloat(average_salary_deduction)+parseFloat(co_average_salary_deduction);

  var net_income_after_tax=parseFloat(total_monthly_gross_income)-parseFloat(new_deduction);

  var net_income_after_tax_two=parseFloat(total_monthly_gross_income_two)-parseFloat(new_deduction_two);

  var net_income_deduction=parseFloat(net_income_after_tax)-parseFloat(total_emi);

  var net_income_deduction_two=parseFloat(net_income_after_tax_two)-parseFloat(total_emi);

  var amount_condition=125000;

var master_income_margin=$('.master_income_margin').val();

$('.marginprecentageset').html("<span>"+master_income_margin+"%</span>");

  if (parseFloat(total_monthly_gross_income)<parseFloat(amount_condition)) {
    var gross_income_fourty=parseFloat(total_monthly_gross_income)*parseFloat(master_income_margin)/100;
  }else{
    var gross_income_fourty=50000;
  }

  if (parseFloat(total_monthly_gross_income)>=parseFloat(amount_condition)) {
    var gross_income_fourty=50000;
  }

  if (parseFloat(total_monthly_gross_income_two)<parseFloat(amount_condition)) {
    var gross_income_fourty_two=parseFloat(total_monthly_gross_income_two)*parseFloat(master_income_margin)/100;
  }else{
   var gross_income_fourty_two=50000;
 }

 if (parseFloat(total_monthly_gross_income_two)>=parseFloat(amount_condition)) {
  var gross_income_fourty_two=50000;
}

var total_disposal_income=parseFloat(net_income_deduction)-parseFloat(gross_income_fourty);

var total_disposal_income_two=parseFloat(net_income_deduction_two)-parseFloat(gross_income_fourty_two);






// alert(total_monthly_gross_income);

$('.total_monthly_gross_income').val(Math.round(total_monthly_gross_income));
$('.total_monthly_gross_income_two').val(Math.round(total_monthly_gross_income_two));

$('.new_deduction').val(Math.round(new_deduction));
$('.new_deduction_two').val(Math.round(new_deduction_two));

$('.net_income_after_tax').val(Math.round(net_income_after_tax));
$('.net_income_after_tax_two').val(Math.round(net_income_after_tax_two));


$('.other_emi').val(Math.round(total_emi));
$('.other_emi_two').val(Math.round(total_emi));

$('.net_income_deduction').val(Math.round(net_income_deduction));
$('.net_income_deduction_two').val(Math.round(net_income_deduction_two));

$('.net_income_deduction').val(Math.round(net_income_deduction));
$('.net_income_deduction_two').val(Math.round(net_income_deduction_two));

$('.40_gross_income').val(Math.round(gross_income_fourty));
$('.40_gross_income_two').val(Math.round(gross_income_fourty_two));

$('.total_disposal_income').val(Math.round(total_disposal_income));
$('.total_disposal_income_two').val(Math.round(total_disposal_income_two));

var dob=$('.age').val();
var dob_month=parseFloat(dob)*12;

var remaining_age=(70*12)-dob_month;



if (remaining_age<=360) {
  var max_eligibile_term_month=remaining_age;
}

if (remaining_age>360) {
  var max_eligibile_term_month=360;
}

var add_max_eligibile_term_month=parseFloat(max_eligibile_term_month)+60;

if (add_max_eligibile_term_month<=360) {

 var max_eligibile_term_relax=add_max_eligibile_term_month;
}

if (add_max_eligibile_term_month>360) {

  var max_eligibile_term_relax=360;
}

var reverse_emi_amount=$('.reverse_emi_amount').val(Math.round(total_disposal_income_two));

var reverse_emi_amount_one=$('.reverse_emi_amount_one').val(Math.round(total_disposal_income));

// var reverse_time_period=$('.reverse_time_period').val(Math.round(max_eligibile_term_relax));

var reverse_time_period=$('.reverse_time_period').val();

var reverse_time_period_one=$('.reverse_time_period_one').val();

var reverse_interest=$('.reverse_interest').val();

var reverse_interest_one=$('.reverse_interest_one').val();

var reverse_emi_amount=$('.reverse_emi_amount').val(Math.round(total_disposal_income_two));

// var reverse_time_period=$('.reverse_time_period').val(Math.round(max_eligibile_term_month));

var reverse_time_period=$('.reverse_time_period').val();

var reverse_time_period_one=$('.reverse_time_period_one').val();

var reverse_interest=$('.reverse_interest').val();

var reverse_interest_month=parseFloat(reverse_interest)/1200;

var reverse_interest_month_one=parseFloat(reverse_interest_one)/1200;


var reverse_emi_calculation_top=Math.pow(1+parseFloat(reverse_interest_month),reverse_time_period)-1;

var reverse_emi_calculation_top_one=Math.pow(1+parseFloat(reverse_interest_month_one),reverse_time_period_one)-1;

var reverse_emi_calculation_bottom=Math.pow(1+parseFloat(reverse_interest_month),reverse_time_period);

var reverse_emi_calculation_bottom_one=Math.pow(1+parseFloat(reverse_interest_month_one),reverse_time_period_one);

var reverse_emi_calculation_bottom=parseFloat(reverse_interest_month)*parseFloat(reverse_emi_calculation_bottom);

var reverse_emi_calculation_bottom_one=parseFloat(reverse_interest_month_one)*parseFloat(reverse_emi_calculation_bottom_one);

var reverse_emi_calculation=parseFloat(reverse_emi_calculation_top)/parseFloat(reverse_emi_calculation_bottom);

var reverse_emi_calculation_one=parseFloat(reverse_emi_calculation_top_one)/parseFloat(reverse_emi_calculation_bottom_one);

var reverse_principle_monthly=parseFloat(total_disposal_income_two)*parseFloat(reverse_emi_calculation_top);

var reverse_principle_monthly_one=parseFloat(total_disposal_income)*parseFloat(reverse_emi_calculation_top_one);

var principle_amount=parseFloat(reverse_principle_monthly)/parseFloat(reverse_emi_calculation_bottom);

var principle_amount_one=parseFloat(reverse_principle_monthly_one)/parseFloat(reverse_emi_calculation_bottom_one);

// var total_reverse_loan_amount=parseFloat(total_disposal_income_two)*parseFloat(remaining_age);

// var reverse_loan_amount_rs=parseFloat(reverse_interest)/100*parseFloat(total_reverse_loan_amount);

// var reverse_loan_amount_rs=parseFloat(total_reverse_loan_amount)-parseFloat(reverse_loan_amount_rs);


$('.reverse_loan_amount_rs').val(Math.round(principle_amount));

$('.reverse_loan_amount_rs_one').val(Math.round(principle_amount_one));

// var total_reverse_loan_amount=parseFloat(total_disposal_income_two)*parseFloat(reverse_time_period);

// var reverse_loan_amount_rs=parseFloat(reverse_interest)/100*parseFloat(total_reverse_loan_amount);

// var reverse_loan_amount_rs=parseFloat(total_reverse_loan_amount)-parseFloat(reverse_loan_amount_rs);


// console.log("xcvcxv"+total_disposal_income_two);

// console.log(reverse_interest);

// console.log(reverse_time_period);


// console.log("loan"+total_reverse_loan_amount);

// console.log("percentage"+reverse_loan_amount_rs);

// console.log("loanrs"+reverse_time_period);

// $('.reverse_loan_amount_rs').val(Math.round(reverse_loan_amount_rs));



if (dob<45) {
  
  var quantam_applicant=(parseFloat(self_total_year_all_average)+parseFloat(average_net_montly_income))*72;
  var quantam_applicant_one=(parseFloat(co_self_total_year_all_average)+parseFloat(co_average_net_montly_income))*72;

}

if (dob>=45) {
  var quantam_applicant=(parseFloat(self_total_year_all_average)+parseFloat(average_net_montly_income))*60;
  var quantam_applicant_one=(parseFloat(co_self_total_year_all_average)+parseFloat(co_average_net_montly_income))*60;
}

max_quantom_loan_home=parseFloat(quantam_applicant)+parseFloat(quantam_applicant_one);

$('.quantam_applicant').val(Math.round(quantam_applicant));
$('.quantam_applicant_one').val(Math.round(quantam_applicant_one));
$('.max_quantom_loan_home').val(Math.round(max_quantom_loan_home));

$('.maximum_age_month').val(dob_month);

$('.remaining_age').val(remaining_age);

$('.max_eligibile_term_month').val(Math.round(max_eligibile_term_month));

$('.max_eligibile_term_relax').val(Math.round(max_eligibile_term_relax));


var interest_rate=$('.interest_rate').val();
var number_of_month=$('.number_of_month').val();

var interestRate = parseFloat(interest_rate)/1200; // or (5/100) this rate is annual
var presentValue = 100000; //this is loan 

function PMT(ir,np, pv, fv = 0){ 
 var presentValueInterstFector = Math.pow((1 + ir), np);
 var pmt = ir * pv  * (presentValueInterstFector + fv)/(presentValueInterstFector-1); 
 return pmt;
}

var pmt_value = PMT(parseFloat(interestRate), parseFloat(number_of_month), parseFloat(presentValue)) - 1; //output
$('.emi_per_lakh').val(Math.round(pmt_value));

var eligilble_as_per_average_income=(parseFloat(total_disposal_income_two)/parseFloat(pmt_value))*100000;
var eligilble_as_per_latest=(parseFloat(total_disposal_income)/parseFloat(pmt_value))*100000;

$('.eligilble_as_per_average_income').val(Math.round(eligilble_as_per_average_income));

$('.eligilble_as_per_latest').val(Math.round(eligilble_as_per_latest));

var ltv_mkt_property=$('.ltv_mkt_property').val();
var ltv_cost_of_project=$('.ltv_cost_of_project').val();

var ltv_loan_amount_applied=$('.ltv_loan_amount_applied').val();
var ltv_takeover=$('.ltv_takeover').val();

var value_to_be_consider=Math.min(parseFloat(ltv_mkt_property),parseFloat(ltv_cost_of_project));

// alert(value_to_be_consider);

if (value_to_be_consider!=undefined && value_to_be_consider!=null && value_to_be_consider!="" && value_to_be_consider!=NaN) {

  $('.value_to_be_consider').val(value_to_be_consider);
}else{
  var value_to_be_consider=0;
  $('.value_to_be_consider').val(value_to_be_consider);
}

var master_ltv_margin_one=$('.master_ltv_margin_one').val();
var master_ltv_margin_two=$('.master_ltv_margin_two').val();
var master_ltv_margin_three=$('.master_ltv_margin_three').val();


if (value_to_be_consider<=3333333) {

  var value_to_be_consider_two=parseFloat(value_to_be_consider)*(parseFloat(master_ltv_margin_one)/100);

}else if(value_to_be_consider>333333 && value_to_be_consider<10000000){

  var value_to_be_consider_two=parseFloat(value_to_be_consider)*(parseFloat(master_ltv_margin_two)/100);

}else if(value_to_be_consider>=10000000){

 var value_to_be_consider_two=parseFloat(value_to_be_consider)*(parseFloat(master_ltv_margin_three)/100); 

}else{
  var value_to_be_consider_two=0; 
}

$('.value_to_be_consider_two').val(value_to_be_consider_two);

$('.ltv_takeover_two').val(ltv_takeover);


var maximum_eligible_loan = Math.min(parseFloat(ltv_loan_amount_applied),parseFloat(eligilble_as_per_average_income),Math.max(parseFloat(value_to_be_consider_two),parseFloat(ltv_takeover)),parseFloat(max_quantom_loan_home));

$('.maximum_eligible_loan_average').val(maximum_eligible_loan);

var maximum_eligible_loan_latest = Math.min(parseFloat(ltv_loan_amount_applied),parseFloat(eligilble_as_per_latest),Math.max(parseFloat(value_to_be_consider_two),parseFloat(ltv_takeover)),parseFloat(max_quantom_loan_home));


$('.maximum_eligible_loan_year_month').val(maximum_eligible_loan_latest);


var loan_amount_rs=$('.loan_amount_rs').val();
var interest=$('.interest').val();
var time_period=$('.time_period').val();

var interest=parseFloat(interest)/1200;

var loan_final_emil = PMT(parseFloat(interest), parseFloat(time_period), parseFloat(loan_amount_rs)) - 1;


$('.final_emi').val(Math.round(loan_final_emil));

// }else{


// }




});



$('.max_term_check').change(function(){

    if($(this).is(':checked')){
     $('.max_ter').removeClass('hidden');
   }
   else
   {
    $('.max_ter').addClass('hidden');
  }    

});



$('.max_quantum_check').change(function(){

    if($(this).is(':checked')){
     $('.max_qua').removeClass('hidden');
   }
   else
   {
    $('.max_qua').addClass('hidden');
  }    

});




    $('.year_one_check').change(function(){

    if($(this).is(':checked')){
     $('.year_one_show').removeClass('hidden');
   }
   else
   {
    $('.year_one_show').addClass('hidden');
  }    

});

    $('.average_itr').change(function(){

    if($(this).is(':checked')){
     $('.average_itr_hidden').addClass('hidden');
   }
   else
   {
    $('.average_itr_hidden').removeClass('hidden');
  }    

});



        $('.year_two_check').change(function(){

    if($(this).is(':checked')){
     $('.year_two_show').removeClass('hidden');
   }
   else
   {
    $('.year_two_show').addClass('hidden');
  }    

});

                $('.year_three_check').change(function(){

    if($(this).is(':checked')){
     $('.year_three_show').removeClass('hidden');
   }
   else
   {
    $('.year_three_show').addClass('hidden');
  }    

});

 $('.co2_year_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co2_year_one_show').removeClass('hidden');
   }
   else
   {
    $('.co2_year_one_show').addClass('hidden');
  }    

});
 $('.co2_year_two_check').change(function(){

    if($(this).is(':checked')){
     $('.year2_two_show').removeClass('hidden');
   }
   else
   {
    $('.year2_two_show').addClass('hidden');
  }    

});

  $('.co2_year_three_check').change(function(){

    if($(this).is(':checked')){
     $('.year2_three_show').removeClass('hidden');
   }
   else
   {
    $('.year2_three_show').addClass('hidden');
  }    

});

$('.co1_year_two_check').change(function(){

    if($(this).is(':checked')){
     $('.year1_two_show').removeClass('hidden');
   }
   else
   {
    $('.year1_two_show').addClass('hidden');
  }    

});

  $('.co1_year_three_check').change(function(){

    if($(this).is(':checked')){
     $('.year1_three_show').removeClass('hidden');
   }
   else
   {
    $('.year1_three_show').addClass('hidden');
  }    

});

    $('.month_one_check').change(function(){

    if($(this).is(':checked')){
     $('.month_one_show').removeClass('hidden');
   }
   else
   {
    $('.month_one_show').addClass('hidden');
  }    

});

  $('.month_two_check').change(function(){

    if($(this).is(':checked')){
     $('.month_two_show').removeClass('hidden');
   }
   else
   {
    $('.month_two_show').addClass('hidden');
  }    

});

  $('.month_three_check').change(function(){

    if($(this).is(':checked')){
     $('.month_three_show').removeClass('hidden');
   }
   else
   {
    $('.month_three_show').addClass('hidden');
  }    

});


  $('.month_four_check').change(function(){

    if($(this).is(':checked')){
     $('.month_four_show').removeClass('hidden');
   }
   else
   {
    $('.month_four_show').addClass('hidden');
  }    

});


  $('.month_five_check').change(function(){

    if($(this).is(':checked')){
     $('.month_five_show').removeClass('hidden');
   }
   else
   {
    $('.month_five_show').addClass('hidden');
  }    

});

  $('.month_six_check').change(function(){

    if($(this).is(':checked')){
     $('.month_six_show').removeClass('hidden');
   }
   else
   {
    $('.month_six_show').addClass('hidden');
  }    

});

 $('.co1_year_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_year_one_show').removeClass('hidden');
   }
   else
   {
    $('.co1_year_one_show').addClass('hidden');
  }    

});
  $('.co_year_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co_year_one_show').removeClass('hidden');
   }
   else
   {
    $('.co_year_one_show').addClass('hidden');
  }    

});

        $('.co_year_two_check').change(function(){

    if($(this).is(':checked')){
     $('.co_year_two_show').removeClass('hidden');
   }
   else
   {
    $('.co_year_two_show').addClass('hidden');
  }    

});

                $('.co_year_three_check').change(function(){

    if($(this).is(':checked')){
     $('.co_year_three_show').removeClass('hidden');
   }
   else
   {
    $('.co_year_three_show').addClass('hidden');
  }    

});



    $('.co_month_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_one_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_one_show').addClass('hidden');
  }    

});

  $('.co_month_two_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_two_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_two_show').addClass('hidden');
  }    

});

  $('.co_month_three_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_three_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_three_show').addClass('hidden');
  }    

});


  $('.co_month_four_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_four_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_four_show').addClass('hidden');
  }    

});


  $('.co_month_five_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_five_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_five_show').addClass('hidden');
  }    

});

  $('.co_month_six_check').change(function(){

    if($(this).is(':checked')){
     $('.co_month_six_show').removeClass('hidden');
   }
   else
   {
    $('.co_month_six_show').addClass('hidden');
  }    

});
 $('.co1_month_six_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_six_show').removeClass('hidden');
   }
   else
   {
    $('.co1_month_six_show').addClass('hidden');
  }    

});
  $('.co1_month_five_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_five_show').removeClass('hidden');
   }
   else
   {
    $('.co1_month_five_show').addClass('hidden');
  }    

});
  $('.co1_month_four_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_four_show').removeClass('hidden');
   }
   else
   {
    $('.co1_month_four_show').addClass('hidden');
  }    

});
  $('.co1_month_three_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_three_show').removeClass('hidden');
   }
   else
   {
    $('.co1_month_three_show').addClass('hidden');
  }    

});
  $('.co1_month_two_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_two_show').removeClass('hidden');
   }
   else
   {
    $('.co1_month_two_show').addClass('hidden');
  }    

});
  $('.co1_month_one_check').change(function(){

    if($(this).is(':checked')){
     $('.co1_month_one_show').removeClass('hidden');
   }
   else
   {
    $('.co1_month_one_show').addClass('hidden');
  }    

});

  $('.existing_loan_check1').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan1').removeClass('hidden');
   }
   else
   {
    $('.existing_loan1').addClass('hidden');
  }    

});
   $('.existing_loan_check2').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan2').removeClass('hidden');
   }
   else
   {
    $('.existing_loan2').addClass('hidden');
  }    

});

  $('.existing_loan_check').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan').removeClass('hidden');
   }
   else
   {
    $('.existing_loan').addClass('hidden');
  }    

});
   $('.existing_loan_co1').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan_co_check1').removeClass('hidden');
   }
   else
   {
    $('.existing_loan_co_check1').addClass('hidden');
  }    

});

   $('.existing_loan_co2').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan_co_check2').removeClass('hidden');
   }
   else
   {
    $('.existing_loan_co_check2').addClass('hidden');
  }    

});

  $('.existing_loan_co').change(function(){

    if($(this).is(':checked')){
     $('.existing_loan_co_check').removeClass('hidden');
   }
   else
   {
    $('.existing_loan_co_check').addClass('hidden');
  }    

});

    $('.master_parameter').change(function(){

    if($(this).is(':checked')){
     $('.master_paramete_div').removeClass('hidden');
   }
   else
   {
    $('.master_paramete_div').addClass('hidden');
  }    

});

// $('input').abacus();
  


  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type', 'info') }}";
  switch(type){
    case 'info':
    toastr.info("{{ Session::get('message') }}");
    break;

    case 'warning':
    toastr.warning("{{ Session::get('message') }}");
    break;
    case 'success':
    toastr.success("{{ Session::get('message') }}");
    break;
    case 'error':
    toastr.error("{{ Session::get('message') }}");
    break;
  }
  @endif


</script>





<script type="text/javascript">
  $('.incomemodal').click(function(){

    $('#incomeModal').show();
    $('#incomeModal').removeClass('fade');

  });

</script>
<script type="text/javascript">
  $('#cls').click(function(){
    $('#incomeModal').hide();
    $('#incomeModal').addClass('fade');    

  });
</script>
<script type="text/javascript">
  $('#close').click(function(){
    $('#incomeModal').hide();
    $('#incomeModal').addClass('fade');    

  });
</script>
<!-- datatable js -->
@endsection