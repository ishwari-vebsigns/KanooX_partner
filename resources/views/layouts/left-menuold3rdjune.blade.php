
@if(Auth::user()!=null)
<style>
   
</style>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                {{-- <div class="profile" id="jobs" style="display: none;"> --}}
                    {{-- <img src="https://cdn4.vectorstock.com/i/1000x1000/06/18/male-avatar-profile-picture-vector-10210618.jpg" alt="profile_picture"> --}}
                    {{-- <a href="{{$base_url}}/admin/agent-profile"><i class="ti-pencil" style="font-size:20px;"></i></a> --}}
                    {{-- <h3>{{Auth::user()->name}}</h3> --}}
                    {{-- @if(Auth::user()->role_id==2) --}}
                    {{-- <p>Agent ID:{{Auth::user()->new_id}}</p> --}}
                    {{-- @endif --}}
                {{-- </div> --}}
                    <li class="nav-label first">Main Menu</li>
                    <li><a href="{{$base_url}}/admin/dashboard" aria-expanded="false"><i class="fa fa-tachometer" aria-hidden="true"></i><span
                    class="nav-text">Dashboard</span></a></li>
                    @if(Auth::user()->role_id==1)
                    <li><a href="{{$base_url}}/admin/role/all" aria-expanded="false"><i class="fa-solid fa-person-circle-question"></i><span
                        class="nav-text">Roles</span></a></li>
                    @endif
                    @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                    <li class="nav-label">Services</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-boxes-stacked"></i><span class="nav-text">Services</span></a>
                        <ul aria-expanded="false">
                        @foreach($mservices->take(3) as $service)
                            <li><a href="{{$base_url}}/admin/services/{{$service->service_id}}">{{$service->service_name}}</a></li>
                        @endforeach   
                        </ul>
                    </li>
                    @endif 
                    
                    @if(Auth::user()->role_id==1)
                    <li class="nav-label">Services</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-regular fa-boxes-stacked"></i><span class="nav-text">Services</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{$base_url}}/admin/service/all">Services</a></li>
                            <li><a href="{{$base_url}}/admin/sub-services/all">Sub-Services</a></li>
                        </ul>
                    </li>
                    <li><a href="{{$base_url}}/admin/bank/all" aria-expanded="false"><i class="fa-solid fa-chart-simple"></i><span
                        class="nav-text">Banks</span></a></li>
                    @endif
                     @if(Auth::user()->role_id==1 || Auth::user()->role_id==2)
                            <li><a href="{{$base_url}}/admin/sub-agent/all" aria-expanded="false"><i class="fa-sharp fa-solid fa-users"></i><span
                                class="nav-text">Sub Agents</span></a></li>
                            <li><a href="{{$base_url}}/admin/user/all" aria-expanded="false"><i class="fa-solid fa-user-group"></i><span
                                    class="nav-text">Users</span></a></li>
                    @endif
                    <li class="nav-label">Settings</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-gear"></i><span class="nav-text">Settings</span></a>
                        <ul aria-expanded="false">
                            @if(Auth::user()->role_id==1)
                            
                            <!-- <li><a href="{{$base_url}}/admin/commission/all" aria-expanded="false"><i class="fa-solid fa-rectangle-list"></i><span
                                        class="nav-text">Commissions</span></a></li> -->
                            <li><a href="{{$base_url}}/admin/agent-commission/all" aria-expanded="false"><i class="fa-solid fa-rectangle-list"></i><span
                                        class="nav-text">Agent Commissions</span></a></li>
                            <li><a href="{{$base_url}}/admin/notification/all" aria-expanded="false"><i class="fa-solid fa-bell"></i><span
                                    class="nav-text">Notifications</span></a></li> 
                            <li><a href="{{$base_url}}/admin/pincode/all" aria-expanded="false"><i class="fa-solid fa-map-location"></i><span
                                    class="nav-text">Pincodes</span></a></li>    
                             <li><a href="{{$base_url}}/admin/walletreason/all" aria-expanded="false"><i class="fa-solid fa-wallet"></i><span
                                class="nav-text">Wallet History</span></a></li>  
                            @endif
                           
                            @if(Auth::user()->role_id==2 || Auth::user()->role_id==3)
                            <li><a href="{{$base_url}}/admin/training" aria-expanded="false"><i class="fa-solid fa-tv"></i><span
                                        class="nav-text">Training</span></a></li>
                            @else
                            <li><a href="{{$base_url}}/admin/training/all" aria-expanded="false"><i class="fa-solid fa-tv"></i><span
                                class="nav-text">Training Videos</span></a></li>
                            @endif
                            <li><a href="{{$base_url}}/admin/help&support/all" aria-expanded="false"><i class="fa-solid fa-headset"></i><span
                                class="nav-text">Help and Support</span></a></li> 
                        </ul>
                    </li>         
                    <li class="nav-label">Reports</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa-solid fa-table"></i><span class="nav-text">Reports</span></a>
                        <ul aria-expanded="false">
                            @if(Auth::user()->role_id==1)
                            <li><a href="{{$base_url}}/admin/report/agent-report">Agent Report</a></li>
                            @endif
                            <li><a href="{{$base_url}}/admin/all-customers">All Customer Report</a></li>
                            <li><a href="{{$base_url}}/admin/report/commision-report">Commission Report</a></li>
                            <li><a href="{{$base_url}}/admin/report/customer-report">Loan Report</a></li>
                        </ul>
                    </li>
                    
                    <li><a href="{{$base_url}}/admin/agent-profile" aria-expanded="false"><i class="fa-solid fa-user"></i><span
                                class="nav-text">Profile</span></a></li>
                    </li>
                    <li><a href="{{$base_url}}/admin/change-password" aria-expanded="false"><i class="fa-solid fa-lock"></i><span
                        class="nav-text">Change Password</span></a></li>
                    </li>
                </ul>
            </div>


        </div>
@endif

    <script src="{{$base_url}}/js/quixnav-init.js"></script>
    <script src="{{$base_url}}/js/custom.min.js"></script>