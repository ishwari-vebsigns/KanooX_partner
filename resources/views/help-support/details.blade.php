@extends('layouts.admin-app')
@section('content')
<style>
     #newcat {
    /* display: flex; */

    overflow-y: scroll;
    flex-wrap: nowrap !important;
}
#newcat::-webkit-scrollbar {
    display: none;
}
  .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EEE;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 300px;
  font-size: 14px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: rgba(51, 65, 85, 1);
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}

</style>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{$base_url}}/admin/help&support/all">Support</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Support Details</a></li>
                        </ol>
                    </div>
                </div>

            
  


@if(Auth::user()->kyc_status==0 && Auth::user()->role_id==2)
  <div class="row-cols-1 divekyc"><div class="alert alert-style-light alert-danger">Please complete your KYC to proceed. To complete KYC <a href="/#/Dashboard">click here</a>.</div></div>
@endif   
       <div class="row">
       <div class="col-lg-6">
                        <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text"><i class="icofont icofont-tasks-alt m-r-5"></i> Task Details</h5>
                          </div>
                        <div class="table-content">
                      <div class="project-table">
                        <table  class="table  dt-responsive nowrap">
                          <tbody>
                            <tr>
                              <td><i class="icofont icofont-meeting-add"></i>Updated:</td>
                              <td class="text-right">{{$support->updated_at->format('Y-m-d')}}</td>
                            </tr>
                            <tr>
                              <td><i class="icofont icofont-id-card"></i> Created:</td>
                              <td class="text-right">{{$support->created_at->format('Y-m-d')}}</td>
                            </tr>          
                            <tr>
                              <td><i class="icofont icofont-ui-love-add"></i> Added by:</td>
                              <td class="text-right">{{$support->user->name}}</td>
                            </tr>
                            <!-- <tr>
                              <td><i class="icofont icofont-washing-machine"></i> Status: </td>
                              <td class="text-right">
                                <select style="width:100px;" class="form-control select-box" id="complaint_status_id" name="complaint_status_id">

                                </select>
                              </td>

                            </tr> -->

                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card-header">
                  <h5 class="card-header-text"><i class="icofont icofont-tasks-alt m-r-5"></i> Description (Complaint Type: {{$support->comment}})</h5>
                </div>
                    <div class="table-content">
                      <div class="project-table">
                        <table  class="table  dt-responsive nowrap">
                          <tbody>
                            <tr>
                              <td><i class="icofont icofont-meeting-add"></i>Description:</td>
                              <td class="text-right">{{$support->message}}</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                        </div>
                    </div>
                    
                  @include('admin.chatbox')
                  @if(Auth::user()->role_id==1)
                  <div id="container">
                    <main id="chatbox">
                      <header>
                        <div>
                          @if(Auth::user()->role_id==1)
                          <h2>Chat with {{$support->user->name}}</h2>
                          @else
                          <h2>Chat with Admin</h2>
                          @endif
                          {{-- <h3>already 1902 messages</h3> --}}
                        </div>
                      </header>
                      <ul id="chat">
                        @foreach($comments as $comment)
                        @if($comment->username->role_id == 2)
                        <li class="you">
                          <div class="entete">
                            <span class="status green"></span>
                            <h2>{{$comment->username->name}}</h2>
                            <h3>{{$comment->updated_at}}</h3>
                          </div>
                          <div class="triangle"></div>
                          <div class="message">
                            {{$comment->commentname}}
                          </div>
                        </li>
                        @else
                        <li class="me">
                          <div class="entete">
                            <h3>{{$comment->updated_at}}</h3>
                            <h2>{{$comment->username->name}}</h2>
                            <span class="status blue"></span>
                          </div>
                          <div class="triangle"></div>
                          <div class="message">
                            {{$comment->commentname}}
                          </div>
                        </li>
                        @endif
                       @endforeach
                      </ul>
                      <footer>
                        <form action="{{$support->support_id}}" method="POST">
                          @csrf
                        <textarea name="comment" rows="1" placeholder="Type your message"></textarea>
                        <button id="sendbutton" class="btn btn-primary">Send</button>
                        </form>
                      </footer>
                    </main>
                  </div>
                  @else
                  <div id="container">
                    <main id="chatbox">
                      <header>
                        <div>
                          @if(Auth::user()->role_id==1)
                          <h2>Chat with Agent</h2>
                          @else
                          <h2>Chat with Admin</h2>
                          @endif
                          {{-- <h3>already 1902 messages</h3> --}}
                        </div>
                      </header>
                      <ul id="chat">
                        @foreach($comments as $comment)
                        @if($comment->username->role_id == 1)
                        <li class="you">
                          <div class="entete">
                            <span class="status green"></span>
                            <h2>{{$comment->username->name}}</h2>
                            <h3>{{$comment->updated_at}}</h3>
                          </div>
                          <div class="triangle"></div>
                          <div class="message">
                            {{$comment->commentname}}
                          </div>
                        </li>
                        @else
                        <li class="me">
                          <div class="entete">
                            <h3>{{$comment->updated_at}}</h3>
                            <h2>{{$comment->username->name}}</h2>
                            <span class="status blue"></span>
                          </div>
                          <div class="triangle"></div>
                          <div class="message">
                            {{$comment->commentname}}
                          </div>
                        </li>
                        @endif
                       @endforeach
                      </ul>
                      <footer>
                        <form action="{{$support->support_id}}" method="POST">
                          @csrf
                        <textarea name="comment" rows="1" placeholder="Type your message"></textarea>
                        <button id="sendbutton" class="btn btn-primary">Send</button>
                        </form>
                      </footer>
                    </main>
                  </div>
                  @endif
                        </div>
                    </div>
       </div>

</div>
</div>

<script class="">
   
  $( document ).ready(function() {
     <?php if(session()->has('success')){ ?> 
         
         toastr.success("{{Session::get('success')}}");
        <?php session()->forget('success'); ?>
        <?php }?>
});
</script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
@endsection

