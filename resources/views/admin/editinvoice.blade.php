@extends('layouts.admin-app')
@section('content')

  <style type="text/css">
    .hidden{
      display: none;
    }
    .card-title{
      font-size: 15px !important;
    }
    .ginger-module-highlighter{
        background: none 0% 0% / auto repeat scroll padding-box border-box rgb(255, 255, 255) !important;
    }
    


 td > span {
  width: 100px; 
  
}

 td.sn > span{
  width: 20px !important; 
  
}

 td.account > span{
  width: 180px !important; 
  
}


td > span {
  word-wrap: break-word;
  overflow-wrap: break-word;
}

    
    /* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

span[contenteditable] { display: inline-block; }

/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 100%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 2px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }



header { margin: 0 0 3em; }
header:after { clear: both; content: ""; display: table; }

header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.013em 0; }
header address { float: left; font-size: 100%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em;font-size: 15px; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 100%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }

/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
	padding-right: 11px;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
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
   


  <div class="content-wrapper" style="background:#fff !important;">

    <div class="content-header row no-print">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h2 class="content-header-title float-left mb-0">Invoice</h2>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">

                <li class="breadcrumb-item">
                  <a href="#"> Home </a>
                </li>
                <li class="breadcrumb-item">
                  <a href="#">Invoice</a>
                </li>
                <li class="breadcrumb-item">
                Edit                                </li>
              </ol> 
            </div>
          </div>
        </div>
      </div>

    </div>              
    <form method="post" action="{{config('app.baseURL')}}/admin/invoice/add">
    <div class="content-body" id="Many" >
        <input name="sr_id" type="hidden" value="{{$invoice->sr_id}}" class="sr_id" />
		<?php echo $invoice->content; ?>
  </div>
  <br><br>
  
   <div class="row no-print">
                
                <div class="col-lg-6">
                  <div class="form-submit mt-10 mb-30" style="margin-top: 20px;">

                   <button type="button" id="target" class="btn btn-success">Save Changes</button>
                    <a href="{{config('app.baseURL')}}/admin/invoice"><button type="button" class="btn btn-danger">Cancel
   </button></a>
                 </div>
               </div>
               <div class="col-lg-2">
                </div>
                     <div class="col-lg-4">
  <div class="form-submit mt-10 mb-30 text-center" style="text-align:center;margin-top: 20px;">
      
   <button type="button" onclick="window.print();" class="btn btn-success waves-effect waves-light no-print">Print
   </button>
  
 </div>
</div>
               
               
               
             </div>
             </form>




<br>
</div>
<script>
    /* Shivving (IE8 is not supported, but at least it won't look as awful)
/* ========================================================================== */


$( "#target" ).click(function() {
  var content=$(".content-body").html();
  var sr_id=$('.sr_id').val();
    var content=$(".content-body").html();
  var biller_name_one=$( ".biller_name_one" ).text();
  var biller_name_two=$( ".biller_name_one" ).text();
   var bank_name=$( ".bank_name" ).text();
   var amount=$( ".total_commission" ).text();
   
   var bank_name = bank_name.replace("Bank Name:", "");
var biller_name_one = biller_name_one.replace("Branch Name:", "");


  $.ajax({
     type: "post",
      url : "https://jfinserv.com/admin/invoice/editsave",
    data : { "content" : content,"biller_name_one" : biller_name_one,"biller_name_two" : biller_name_two,"bank_name" : bank_name,"amount" : amount,"sr_id":sr_id },
     success: function (result) {
       
       window.location.href = "https://jfinserv.com/admin/invoice";

     },
     error: function (xhr, textStatus, errorThrown) {
       alert(textStatus + ':' + errorThrown); 
     }
   });
  
  
  
});

(function (document) {
	var
	head = document.head = document.getElementsByTagName('head')[0] || document.documentElement,
	elements = 'article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output picture progress section summary time video x'.split(' '),
	elementsLength = elements.length,
	elementsIndex = 0,
	element;

	while (elementsIndex < elementsLength) {
		element = document.createElement(elements[++elementsIndex]);
	}

	element.innerHTML = 'x<style>' +
		'article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}' +
		'audio[controls],canvas,video{display:inline-block}' +
		'[hidden],audio{display:none}' +
		'mark{background:#FF0;color:#000}' +
	'</style>';

	return head.insertBefore(element.lastChild, head.firstChild);
})(document);

/* Prototyping
/* ========================================================================== */

(function (window, ElementPrototype, ArrayPrototype, polyfill) {
	function NodeList() { [polyfill] }
	NodeList.prototype.length = ArrayPrototype.length;

	ElementPrototype.matchesSelector = ElementPrototype.matchesSelector ||
	ElementPrototype.mozMatchesSelector ||
	ElementPrototype.msMatchesSelector ||
	ElementPrototype.oMatchesSelector ||
	ElementPrototype.webkitMatchesSelector ||
	function matchesSelector(selector) {
		return ArrayPrototype.indexOf.call(this.parentNode.querySelectorAll(selector), this) > -1;
	};

	ElementPrototype.ancestorQuerySelectorAll = ElementPrototype.ancestorQuerySelectorAll ||
	ElementPrototype.mozAncestorQuerySelectorAll ||
	ElementPrototype.msAncestorQuerySelectorAll ||
	ElementPrototype.oAncestorQuerySelectorAll ||
	ElementPrototype.webkitAncestorQuerySelectorAll ||
	function ancestorQuerySelectorAll(selector) {
		for (var cite = this, newNodeList = new NodeList; cite = cite.parentElement;) {
			if (cite.matchesSelector(selector)) ArrayPrototype.push.call(newNodeList, cite);
		}

		return newNodeList;
	};

	ElementPrototype.ancestorQuerySelector = ElementPrototype.ancestorQuerySelector ||
	ElementPrototype.mozAncestorQuerySelector ||
	ElementPrototype.msAncestorQuerySelector ||
	ElementPrototype.oAncestorQuerySelector ||
	ElementPrototype.webkitAncestorQuerySelector ||
	function ancestorQuerySelector(selector) {
		return this.ancestorQuerySelectorAll(selector)[0] || null;
	};
})(this, Element.prototype, Array.prototype);

/* Helper Functions
/* ========================================================================== */

function generateTableRow() {
	var emptyColumn = document.createElement('tr');

	emptyColumn.innerHTML = '<td><a class="cut">-</a><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' +
		'<td><span contenteditable></span></td>' ;

	return emptyColumn;
}

function parseFloatHTML(element) {
	return parseFloat(element.innerHTML.replace(/[^\d\.\-]+/g, '')) || 0;
}

function parsePrice(number) {
	return number.toFixed(2);
}

/* Update Number
/* ========================================================================== */

function updateNumber(e) {
	var
	activeElement = document.activeElement,
	value = parseFloat(activeElement.innerHTML),
	wasPrice = activeElement.innerHTML == parsePrice(parseFloatHTML(activeElement));

	if (!isNaN(value) && (e.keyCode == 38 || e.keyCode == 40 || e.wheelDeltaY)) {
		e.preventDefault();

		value += e.keyCode == 38 ? 1 : e.keyCode == 40 ? -1 : Math.round(e.wheelDelta * 0.025);
		value = Math.max(value, 0);

		activeElement.innerHTML = wasPrice ? parsePrice(value) : value;
	}
	
	if(e.keyCode == 86 || e.keyCode == 67 || e.keyCode == 91){
	    alert("ctrl use is prevented");
	   e.preventDefault();
	}

	updateInvoice();
}

/* Update Invoice
/* ========================================================================== */

function updateInvoice() {
    	var net = 0;
    		var gst = 0;
	var total = 0;
	var cells, price, total, a, i;

	// update inventory cells
	// ======================

	for (var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i) {
		// get inventory row cells
		cells = a[i].querySelectorAll('span:last-child');
		
// 		cells[0].innerHTML = parseFloatHTML(cells[0])+1;

		// set price as cell[2] * cell[3]
		
		percentage_cell=parseFloatHTML(cells[7])/100;
// 		if(cells[8]!=0 && cells[8]!="undefined" && cells[8]!=null && cells[8]!="null"){
		    
// 		    gst_cell=parseFloatHTML(cells[8])/100;
// 		}else{
// 		    gst_cell=0;
// 		}
// 		console.log(parseFloatHTML(cells[8]));
// 		console.log(parseFloatHTML(cells[5]));
		 actual_total_price=parseFloatHTML(cells[4]);
		calculation_one=parseFloat(percentage_cell)*parseFloat(actual_total_price);
// 		calculation_two=parseFloat(gst_cell)*parseFloat(calculation_one);
		
		total_price=calculation_one;
		
		price = Math.round(total_price,2);
	

		// add price to total
		net += price;

		// set row total
		cells[8].innerHTML = price;
	}

	// update balance cells
	// ====================

	// get balance cells
	cells = document.querySelectorAll('table.balance td:last-child span:last-child');

	// set total
	cells[0].innerHTML = net;
	
		
		    
		    gst_cell=18/100;
		
		
		gst_amount=gst_cell*net;
		
		

	// set balance and meta balance
	cells[1].innerHTML = parsePrice(gst_amount);
	cells[2].innerHTML = parsePrice(net + gst_amount);
	

	// update prefix formatting
	// ========================

	var prefix = document.querySelector('#prefix').innerHTML;
	for (a = document.querySelectorAll('[data-prefix]'), i = 0; a[i]; ++i) a[i].innerHTML = prefix;

	// update price formatting
	// =======================

	for (a = document.querySelectorAll('span[data-prefix] + span'), i = 0; a[i]; ++i) if (document.activeElement != a[i]) a[i].innerHTML = parsePrice(parseFloatHTML(a[i]));
}

/* On Content Load
/* ========================================================================== */

function onContentLoad() {
	updateInvoice();

	var
	input = document.querySelector('input'),
	image = document.querySelector('img');

	function onClick(e) {
		var element = e.target.querySelector('[contenteditable]'), row;

		element && e.target != document.documentElement && e.target != document.body && element.focus();

		if (e.target.matchesSelector('.add')) {
			document.querySelector('table.inventory tbody').appendChild(generateTableRow());
		}
		else if (e.target.className == 'cut') {
			row = e.target.ancestorQuerySelector('tr');

			row.parentNode.removeChild(row);
		}

		updateInvoice();
	}

	function onEnterCancel(e) {
		e.preventDefault();

		image.classList.add('hover');
	}

	function onLeaveCancel(e) {
		e.preventDefault();

		image.classList.remove('hover');
	}

	function onFileInput(e) {
		image.classList.remove('hover');

		var
		reader = new FileReader(),
		files = e.dataTransfer ? e.dataTransfer.files : e.target.files,
		i = 0;

		reader.onload = onFileLoad;

		while (files[i]) reader.readAsDataURL(files[i++]);
	}

	function onFileLoad(e) {
		var data = e.target.result;

		image.src = data;
	}

	if (window.addEventListener) {
		document.addEventListener('click', onClick);

		document.addEventListener('mousewheel', updateNumber);
		document.addEventListener('keydown', updateNumber);

		document.addEventListener('keydown', updateInvoice);
		document.addEventListener('keyup', updateInvoice);

		input.addEventListener('focus', onEnterCancel);
		input.addEventListener('mouseover', onEnterCancel);
		input.addEventListener('dragover', onEnterCancel);
		input.addEventListener('dragenter', onEnterCancel);

		input.addEventListener('blur', onLeaveCancel);
		input.addEventListener('dragleave', onLeaveCancel);
		input.addEventListener('mouseout', onLeaveCancel);

		input.addEventListener('drop', onFileInput);
		input.addEventListener('change', onFileInput);
	}
}

window.addEventListener && document.addEventListener('DOMContentLoaded', onContentLoad);

</script>

@endsection