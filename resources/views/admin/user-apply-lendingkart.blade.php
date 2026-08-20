@extends('layouts.admin-app')
@section('content')
<div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            @if(Auth::user()!=null)
                            <h4>Hi, welcome {{Auth::user()->name}}!</h4>
                            @if(Auth::user()->role_id==2)
                            <p class="mb-0">Agent ID: {{Auth::user()->new_id}}</p>
                            @endif
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Customer Registration</a></li>
                        </ol>
                    </div>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">User Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-validation">
                                    @if(Auth::user()!=null)
                                    <form class="form-valide" action="apply-user" method="post" enctype='multipart/form-data'>
                                    @else
                                    <form class="form-valide" action="apply-user?access_code={{$code}}" method="post" enctype='multipart/form-data'>
                                    @endif
                                      @csrf
                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-username">Name of Customer
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('user_name') ? ' has-error' : '' }}">
                                                    <input type="text" class="form-control" id="val-username" name="user_name" value="{{old('user_name', $user_loan->customer_name)}}" placeholder="Enter a Name of Customer..">
                                                        @if ($errors->has('user_name'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('user_name') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-phoneus">Phone
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('contact_no', $user_loan->contact_no)}}" id="val-phoneus" name="phone" placeholder="Enter contact number" >
                                                        @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-email">Email <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Customer valid email..">
                                                        @if ($errors->has('email'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                 </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('pincode', $user_loan->pincode)}}" id="val-range" name="pincode" placeholder="Customer 6 digit Pincode" >
                                                        @if ($errors->has('pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Business Age(in Months)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('business_age') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('business_age')}}" name="business_age" placeholder="Enter Your business Age in Months">
                                                        @if ($errors->has('business_age'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('business_age') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Business Revenue(in Rupees)
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('business_revenue') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('business_revenue')}}" name="business_revenue" placeholder="Enter Your business Revenue">
                                                        @if ($errors->has('business_revenue'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('business_revenue') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Company Incorporation Date
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('company_incor_date') ? 'has-error' : '' }}">
                                                        <input type="date" class="form-control" id="val-range" value="{{old('company_incor_date')}}" name="company_incor_date" placeholder="Customer Company Incorporation Date" >
                                                        @if ($errors->has('company_incor_date'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('company_incor_date') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-suggestions">Business Address <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('business_address') ? 'has-error' : '' }}">
                                                        <textarea class="form-control" id="val-suggestions" name="business_address" rows="3" placeholder="Business Address/ Office Address please..." >{{old('business_address')}}</textarea>
                                                        @if ($errors->has('business_address'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('business_address') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Business Pincode
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pincode') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('business_pincode')}}" id="val-range" name="business_pincode" placeholder="6 digit Business/Office Pincode" >
                                                        @if ($errors->has('business_pincode'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('business_pincode') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Date of Birth
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('dob') ? 'has-error' : '' }}">
                                                        <input type="date" class="form-control" value="{{old('dob')}}" id="val-range" name="dob" placeholder="Date of Birth" >
                                                        @if ($errors->has('dob'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('dob') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Loan Amount
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('loan_amount') ? ' has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('loan_amount')}}" name="loan_amount" placeholder="Your Loan amount">
                                                        @if ($errors->has('loan_amount'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('loan_amount') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Registered As
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="registeredas" required>
                                                            <option value="">Please select</option>
                                                            <option value="Proprietorship">Proprietorship</option>
                                                            <option value="Partnership">Partnership</option>
                                                            <option value="Pvt. Ltd.">Pvt. Ltd.</option>
                                                            <option value="LLP">LLP</option>
                                                            <option value="Limited Company">Limited Company</option>
                                                            <option value="One Person Company">One Person Company</option>
                                                            <option value="Not Registered">Not Registered</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Business Run By
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="businessRunBy" required>
                                                            <option value="">Please select</option>
                                                            <option value="Self">Self</option>
                                                            <option value="Spouse">Spouse</option>
                                                            <option value="Relative">Relative</option>
                                                            <option value="Parent">Parent</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">nature Of Business
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="natureOfBusiness" required>
                                                            <option value="">Please select</option>
                                                            <option value="Importer">Importer</option>
                                                            <option value="Trader">Trader</option>
                                                            <option value="Exporter">Exporter</option>
                                                            <option value="Service">Service</option>
                                                            <option value="Others">Others</option>
                                                            <option value="Manufacturer">Manufacturer</option>
                                                            <option value="Retailer">Retailer</option>
                                                            <option value="Distributor">Distributor</option>
                                                            <option value="Online Seller">Online Seller</option>
                                                            <option value="Offline Seller">Offline Seller</option>
                                                            <option value="CSC/VLE">CSC/VLE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Product Category
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="productCategory" required>
                                                            <option value="">Please select</option>
                                                            <option value="Advisory services (legal, business, educational, psychological etc.)">Advisory services (legal, business, educational, psychological etc.)</option>
                                                            <option value="Aircel distributor / R-com distributor">Aircel distributor / R-com distributor</option>
                                                            <option value="Apparel, Readymade garments">Apparel, Readymade garments</option>
                                                            <option value="Arms and ammunition dealers">Arms and ammunition dealers</option>
                                                            <option value="Arts, design and other creative services">Arts, design and other creative services</option>
                                                            <option value="Automobile accessories / service centre">Automobile accessories / service centre</option>
                                                            <option value="Automotive parts">Automotive parts</option>
                                                            <option value="BPO/KPO & facility management">BPO/KPO & facility management</option>
                                                            <option value="Bar / Liquor">Bar / Liquor</option>
                                                            <option value="CSC, photocopying and other documents and ID (Aadhar, PAN) related services, Kisan seva kendra">CSC, photocopying and other documents and ID (Aadhar, PAN) related services, Kisan seva kendra</option>
                                                            <option value="Cab Services">Cab Services</option>
                                                            <option value="Camera, CCTV and related accessories">Camera, CCTV and related accessories</option>
                                                            <option value="Cargo and retail transport service">Cargo and retail transport service</option>
                                                            <option value="Chain restaurant / verified income">Chain restaurant / verified income</option>
                                                            <option value="Chemist, Retail health accessories, medicines and supplements">Chemist, Retail health accessories, medicines and supplements</option>
                                                            <option value="Clinics, hospital,nursing home, lab, gym, pet clinic etc.">Clinics, hospital,nursing home, lab, gym, pet clinic etc.</option>
                                                            <option value="Computer, Mobile and related accessories">Computer, Mobile and related accessories</option>
                                                            <option value="Computer, mobile and camera repairing service">Computer, mobile and camera repairing service</option>
                                                            <option value="Construction equipment including building, road, sewage etc.">Construction equipment including building, road, sewage etc.</option>
                                                            <option value="Construction material like cement, bricks, sand etc">Construction material like cement, bricks, sand etc</option>
                                                            <option value="Corporate services / Corporate bookings">Corporate services / Corporate bookings</option>
                                                            <option value="Cotton bales, Textile manufacturing">Cotton bales, Textile manufacturing</option>
                                                            <option value="Countdown Timers, Electronic Scoreboards and Digital Clocks">Countdown Timers, Electronic Scoreboards and Digital Clocks</option>
                                                            <option value="Courier">Courier</option>
                                                            <option value="Design, Fabrication & Painting Services">Design, Fabrication & Painting Services</option>
                                                            <option value="Distributor of cooking/commercial Gas">Distributor of cooking/commercial Gas</option>
                                                            <option value="Eco-friendly solutions for industry (solar, greenhouse, biomass, recycling, etc.)">Eco-friendly solutions for industry (solar, greenhouse, biomass, recycling, etc.)</option>
                                                            <option value="Edible Oil business">Edible Oil business</option>
                                                            <option value="Educational Institute (Pre-school, school, college, coaching center, library etc.)">Educational Institute (Pre-school, school, college, coaching center, library etc.)</option>
                                                            <option value="Educational products (books, educational toys, stationeries, e-learning etc.)">Educational products (books, educational toys, stationeries, e-learning etc.)</option>
                                                            <option value="Electronic sensors, devices">Electronic sensors, devices</option>
                                                            <option value="Entertainment Event">Entertainment Event</option>
                                                            <option value="Equipment used in agriculture">Equipment used in agriculture</option>
                                                            <option value="Event Management">Event Management</option>
                                                            <option value="Fabric (woven and non-woven) & textiles">Fabric (woven and non-woven) & textiles</option>
                                                            <option value="Facility Management Services">Facility Management Services</option>
                                                            <option value="Fibres, threads, buttons and other raw materials supplier to textile industry">Fibres, threads, buttons and other raw materials supplier to textile industry</option>
                                                            <option value="Film Producer">Film Producer</option>
                                                            <option value="Financial service providers (Chit funds/ small finance companies/Stock broking Companies)">Financial service providers (Chit funds/ small finance companies/Stock broking Companies)</option>
                                                            <option value="Financial service providers (DSA,agents and other intermediators)">Financial service providers (DSA,agents and other intermediators)</option>
                                                            <option value="Financial service providers (NBFCs/ Other money lending companies)">Financial service providers (NBFCs/ Other money lending companies)</option>
                                                            <option value="Fire fighting equipment, safety materials">Fire fighting equipment, safety materials</option>
                                                            <option value="Footwear, bags, cosmetics and other fashion accessories">Footwear, bags, cosmetics and other fashion accessories</option>
                                                            <option value="Freight forwarding services">Freight forwarding services</option>
                                                            <option value="Furniture & Fixtures (including on rent)">Furniture & Fixtures (including on rent)</option>
                                                            <option value="Grocery/ Kirana store / Departmental Store">Grocery/ Kirana store / Departmental Store</option>
                                                            <option value="Hardware & Fittings (ceramics, tiles, cables, lights etc.)">Hardware & Fittings (ceramics, tiles, cables, lights etc.)</option>
                                                            <option value="Hardware provider to telecom industry">Hardware provider to telecom industry</option>
                                                            <option value="Heavy machineries & Robotics">Heavy machineries & Robotics</option>
                                                            <option value="Home & Kitchen Appliances">Home & Kitchen Appliances</option>
                                                            <option value="Home Decor, interior items, kitchen accessories, toys, gift articles">Home Decor, interior items, kitchen accessories, toys, gift articles</option>
                                                            <option value="Hotels, resorts and club">Hotels, resorts and club</option>
                                                            <option value="Housekeeping products">Housekeeping products</option>
                                                            <option value="Housekeeping, security & industrial labour supply">Housekeeping, security & industrial labour supply</option>
                                                            <option value="Imitation jewellery">Imitation jewellery</option>
                                                            <option value="Industrial and customized software, applications and ITES">Industrial and customized software, applications and ITES</option>
                                                            <option value="Installation and repair services for telecom products">Installation and repair services for telecom products</option>
                                                            <option value="Intelligence Agencies/ Private Security Firms">Intelligence Agencies/ Private Security Firms</option>
                                                            <option value="Interior Designers">Interior Designers</option>
                                                            <option value="Jewellery, precious metals and stones">Jewellery, precious metals and stones</option>
                                                            <option value="Live Stock Trading">Live Stock Trading</option>
                                                            <option value="Law services, astrological services, etc.">Law services, astrological services, etc.</option>
                                                            <option value="Leather Trading">Leather Trading</option>
                                                            <option value="Material handling service provider">Material handling service provider</option>
                                                            <option value="Medical, non-medical & wellness equipments">Medical, non-medical & wellness equipments</option>
                                                            <option value="Mining & Mining Products">Mining & Mining Products</option>
                                                            <option value="Mobile and related accessories">Mobile and related accessories</option>
                                                            <option value="Mobile recharge, Telecom, DTH, data service provider (telephone, internet,broadband, ISP, leased line etc.)">Mobile recharge, Telecom, DTH, data service provider (telephone, internet,broadband, ISP, leased line etc.)</option>
                                                            <option value="Musical Instruments, bulbs, tubelights">Musical Instruments, bulbs, tubelights</option>
                                                            <option value="Networking, storage, data management and other support services">Networking, storage, data management and other support services</option>
                                                            <option value="Non-metal products like wood, paper, plastic, glass, etc">Non-metal products like wood, paper, plastic, glass, etc</option>
                                                            <option value="Oils, Paint, Chemicals and petroleum products">Oils, Paint, Chemicals and petroleum products</option>
                                                            <option value="Other metals, alloys, minerals and their scraps">Other metals, alloys, minerals and their scraps</option>
                                                            <option value="Others">Others</option>
                                                            <option value="Outdoor furniture (swings etc.)">Outdoor furniture (swings etc.)</option>
                                                            <option value="Outsourced consultancy (recruitment, research, placement, transcription, visa etc.)">Outsourced consultancy (recruitment, research, placement, transcription, visa etc.)</option>
                                                            <option value="Pet Shop, Pet Clinic & Pet Grooming Parlour">Pet Shop, Pet Clinic & Pet Grooming Parlour</option>
                                                            <option value="Petrol pump & Gas station">Petrol pump & Gas station</option>
                                                            <option value="Power">Power</option>
                                                            <option value="Professional services (branding, media, architecture, saloon, beauty parlour etc.)">Professional services (branding, media, architecture, saloon, beauty parlour etc.)</option>
                                                            <option value="Property dealing & management (Rent, lease or Sell)">Property dealing & management (Rent, lease or Sell)</option>
                                                            <option value="Raw materials and parts used for manufacturing">Raw materials and parts used for manufacturing</option>
                                                            <option value="Real estate developer, Civil contractor">Real estate developer, Civil contractor</option>
                                                            <option value="Renewal (other than Via)">Renewal (other than Via)</option>
                                                            <option value="Repair and maintenance services">Repair and maintenance services</option>
                                                            <option value="Repair and servicing of household appliances">Repair and servicing of household appliances</option>
                                                            <option value="Restaurants, Cafes, food outlets & catering">Restaurants, Cafes, food outlets & catering</option>
                                                            <option value="Retail and standard softwares, applications and ITES">Retail and standard softwares, applications and ITES</option>
                                                            <option value="Seeds, Fertilizer, Pesticides, Cattle feeds and agricultural products">Seeds, Fertilizer, Pesticides, Cattle feeds and agricultural products</option>
                                                            <option value="Shares/Bitcoins/Old coins trading or Other speculative activities">Shares/Bitcoins/Old coins trading or Other speculative activities</option>
                                                            <option value="Shipping Services">Shipping Services</option>
                                                            <option value="Supplier for switches,cables etc">Supplier for switches,cables etc</option>
                                                            <option value="Support services (facilitators, intermediators, agents, etc.)">Support services (facilitators, intermediators, agents, etc.)</option>
                                                            <option value="Support services to industries like industrial design, warehousing, testing, repairing etc.">Support services to industries like industrial design, warehousing, testing, repairing etc.</option>
                                                            <option value="Tax planners / Auditors">Tax planners / Auditors</option>
                                                            <option value="Tea / coffee vending machine & Tea / Coffee powder to Government / corporates">Tea / coffee vending machine & Tea / Coffee powder to Government / corporates</option>
                                                            <option value="Ticket, Travel & Tour Packages">Ticket, Travel & Tour Packages</option>
                                                            <option value="Tobacco Products">Tobacco Products</option>
                                                            <option value="Tools and equipments including electricals,transformers, inverters and batteries">Tools and equipments including electricals,transformers, inverters and batteries</option>
                                                            <option value="Vegetables, Fruits, Milk and other dairy products, Spices, Sea-food and food-processing">Vegetables, Fruits, Milk and other dairy products, Spices, Sea-food and food-processing</option>
                                                            <option value="Vehicles (New/second hand)">Vehicles (New/second hand)</option>
                                                            <option value="Via cases">Via cases</option>
                                                        </select>
                                                        @if ($errors->has('productCategory'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('productCategory') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-skill">Gender
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6">
                                                        <select class="form-control" id="val-skill" name="gender" required>
                                                            <option value="">Please select</option>
                                                            <option value="MALE">Male</option>
                                                            <option value="FEMALE">Female</option>
                                                            <option value="OTHER">Other</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">GST No.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('gst_no') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" value="{{old('gst_no')}}" id="val-range" name="gst_no" placeholder="GST Number">
                                                        @if ($errors->has('gst_no'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('gst_no') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="val-range">Pancard No.
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-6 {{ $errors->has('pan_card') ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control" id="val-range" value="{{old('pan_card')}}" name="pan_card" placeholder="Your PAN Number" required>
                                                        @if ($errors->has('pan_card'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('pan_card') }}</strong>
                                                        </span> 
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-8 ml-auto">
                                                        <button name ="save" type="submit" class="btn btn-primary">Submit</button>
                                                        <button name ="cancel" type="submit" class="btn btn-light">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script class="">
 @if(session()->has('success'))
    document.querySelector(".sweet-success").onclick = function () {
        swal("Hey, Good job !!", "You clicked the button !!", "success");
    };
@endif

</script>

@endsection

