@extends('layouts.admin-app')
@section('content')
<style>
  .form-select{
    background-color: #dfdfdf;
    padding: 12px;
    border-radius: 10px;
  }
  .select-selected {
    border-radius: 10px;
  }
  .avatar{
    background-color: #c3c3c300 !important;
  }
    .navpaddingone{
        padding-left:20px;
    }
    .nav-pills>li.active>a.navpaddingone {
    color: #fff;
    background-color: #542f6d;
    padding: 10px;
    border-radius: 5px;
    margin-left: 10px;
}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div class="content-wrapper">

  <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
          <h2 class="content-header-title float-left mb-0">Services</h2>
          <div class="breadcrumb-wrapper col-12">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="#"> Home </a>
              </li>
              <li class="breadcrumb-item">
                <a href="#"> Services </a>
              </li>
              
              <li class="breadcrumb-item">
              All                                </li>
            </ol> 
          </div>
        </div>
      </div>
    </div>

  </div>                    
  
  <div class="app-content">
                <div class="row-cols-1 divinternetMsg">
                </div>
                <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>

                <div id="AlertMessage" class="messagealert">
                    <div id="customAlerts">
                    </div>
                </div>

                <div id="MainContent">

    <!-- <div class="d-flex align-items-center mb-4">
        <div><span class="material-icons text-primary">feed</span>&nbsp;&nbsp;</div>
        <h5>Commission Structures </h5>
    </div> -->
<div class="card">


    <div class="card-body row" id="scrollingTabs">
        <div class="col-12">
            <div class="col-lg-6 col-md-12 form-group">
                <select class="form-select mb-0" aria-label="Default select example" id="ddlServices">
                    <option selected="" value="#Loan">Loan</option>
                    <option value="#Insurance">Insurance</option>
                    <option value="#Cards">Cards</option>
                    
                </select>
            </div>
        </div>
        <div class="row">
<div class="col-md-12">
<div class="table-wrap">
<table id="myTable" class="table table-responsive-xl">
<thead>
<tr>
<th>Id</th>
<th>Email</th>
<th>Name</th>
<th>Agent Name</th>
<th>Commssion</th>
<th>Service</th>
<th>Loan ID</th>
<th>Bank Name</th>
<th>Loan Amount</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr class="alert" role="alert">
<td>
<label class="checkbox-wrap checkbox-primary">
<input type="checkbox" checked="">
<span class="checkmark"></span>
</label>
</td>
<td class="d-flex align-items-center">
<div class="img" style="background-image: url(images/person_1.jpg);"></div>
<div class="pl-3 email">
<span>markotto@email.com</span>

</div>
</td>
<td>Markotto89</td>
<td>ABC</td>
<td>12%</td>
<td>Loan</td>
<td>093223</td>
<td>Kotak Bank</td>
<td>120000</td>

<td class="status"><span class="active">Active</span></td>
<td>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true"><i class="feather icon-x"></i></span>
</button>
</td>
</tr>
<tr class="alert" role="alert">
<td>
<label class="checkbox-wrap checkbox-primary">
<input type="checkbox">
<span class="checkmark"></span>
</label>
</td>
<td class="d-flex align-items-center">
<div class="img" style="background-image: url(images/person_2.jpg);"></div>
<div class="pl-3 email">
<span>jacobthornton@email.com</span>

</div>
</td>
<td>Jacobthornton</td>
<td>XYZ</td>
<td>12%</td>
<td>Loan</td>
<td>823234</td>
<td>Kotak Bank</td>
<td>1410000</td>
<td class="status"><span class="waiting">Waiting for Resassignment</span></td>
<td>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true"><i class="feather icon-x"></i></span>
</button>
</td>
</tr>
<tr class="alert" role="alert">
<td>
<label class="checkbox-wrap checkbox-primary">
<input type="checkbox">
<span class="checkmark"></span>
</label>
</td>
<td class="d-flex align-items-center">
<div class="img" style="background-image: url(images/person_3.jpg);"></div>
<div class="pl-3 email">
<span>larrybird@email.com</span>

</div>
</td>
<td>Larry_bird</td>
<td>ABC</td>
<td>12%</td>
<td>Loan</td>
<td>203112</td>
<td>Kotak Bank</td>
<td>1120000</td>
<td class="status"><span class="active">Active</span></td>
<td>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true"><i class="feather icon-x"></i></span>
</button>
</td>
</tr>
<tr class="alert" role="alert">
<td>
<label class="checkbox-wrap checkbox-primary">
<input type="checkbox">
<span class="checkmark"></span>
</label>
</td>
<td class="d-flex align-items-center">
<div class="img" style="background-image: url(images/person_4.jpg);"></div>
<div class="pl-3 email">
<span>johndoe@email.com</span>

</div>
</td>
<td>Johndoe1990</td>
<td>XYZ</td>
<td>12%</td>
<td>Loan</td>
<td>90399</td>
<td>Kotak Bank</td>
<td>3400000</td>
<td class="status"><span class="active">Active</span></td>
<td>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true"><i class="feather icon-x"></i></span>
</button>
</td>
</tr>
<tr class="alert" role="alert">
<td class="border-bottom-0">
<label class="checkbox-wrap checkbox-primary">
<input type="checkbox">
<span class="checkmark"></span>
</label>
</td>
<td class="d-flex align-items-center border-bottom-0">
<div class="img" style="background-image: url(images/person_1.jpg);"></div>
<div class="pl-3 email">
<span>garybird@email.com</span>

</div>
</td>
<td class="border-bottom-0">Garybird_2020</td>
<td>ABC</td>
<td>12%</td>
<td>Loan</td>
<td>030232</td>
<td>Kotak Bank</td>
<td>9010000</td>
<td class="status border-bottom-0"><span class="waiting">Waiting for Resassignment</span></td>
<td class="border-bottom-0">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true"><i class="feather icon-x"></i></span>
</button>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
    </div>
</div>

           
         
        </div>
    </div>
</div>

<style>
    #scrollingTabs li.active > a span {
        border: none;
        background: #007cc2;
        color: #fff;
        transition: all 0.20s linear 0s;
        position: relative;
    }

    #scrollingTabs {
        border-bottom: 0;
    }

        #scrollingTabs li {
            float: none;
        }

            #scrollingTabs li > a {
                padding: 0 !important;
                position: relative;
                margin-bottom: 15px;
            }

                #scrollingTabs li > a span {
                    padding: 10px;
                    display: inline-block;
                }

            #scrollingTabs li.active > a:after {
                top: 50%;
                position: absolute;
                right: -24px;
                border: 12px solid transparent;
                border-left-color: #007cc2;
                content: '';
                transform: translatey(-45%);
            }

            #scrollingTabs li > a span {
                background: #efefef;
                display: block;
            }

    .ddlscrollTab {
        border: 1px solid lightgrey;
        padding: 5px;
    }

        .ddlscrollTab:hover {
            background-color: lightgrey;
        }

        .ddlscrollTab .btn-group.open .dropdown-toggle {
            -webkit-box-shadow: none;
            box-shadow: none;
        }

    #ddlscrollingTabs {
        height: 300px;
        overflow-y: scroll;
        width: 100%;
    }

    .ddlscrollTab .btn-group {
        width: 100%;
    }

    #scrollingTabs li.active > a:after {
        display: none;
    }
</style>
<script>
    $(document).ready(function () {

        $('select[id="ddlServices"]').on('change', function () {
            $('.tab-content div.tab-pane').removeClass('active');
            $(this.value).addClass('active')
        });

        $('#scrollingTabs a').on('click', function () {
            $(document).scrollTop(0);
        });

    });

</script>
</div>
</div>

</div>


<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

