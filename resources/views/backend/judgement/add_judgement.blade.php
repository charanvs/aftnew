@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="{{ asset('backend/assets/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet" />

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Judgement</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Judgement</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        <div class="main-body">
            <!--start stepper one-->
            <h6 class="text-uppercase">Judgement Details</h6>
            <hr>
            <div id="stepper1" class="bs-stepper">
                <div class="card">
                    <div class="card-header">
                        <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                            <div class="step" data-target="#step-1">
                                <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="step-1">
                                    <div class="bs-stepper-circle">1</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Case Details</h5>
                                        <p class="mb-0 steper-sub-title">Enter Case Information</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#step-2">
                                <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="step-2">
                                    <div class="bs-stepper-circle">2</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Parties & Advocates</h5>
                                        <p class="mb-0 steper-sub-title">Petitioner and Respondent Information</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#step-3">
                                <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="step-3">
                                    <div class="bs-stepper-circle">3</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Judgement Details</h5>
                                        <p class="mb-0 steper-sub-title">Enter Judgement Information</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bs-stepper-line"></div>
                            <div class="step" data-target="#step-4">
                                <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="step-4">
                                    <div class="bs-stepper-circle">4</div>
                                    <div class="">
                                        <h5 class="mb-0 steper-title">Additional Info</h5>
                                        <p class="mb-0 steper-sub-title">Enter Additional Information</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bs-stepper-content">
                            <form onSubmit="return false">
                                <!-- Step 1: Case Details -->
                                <div id="step-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                    <h5 class="mb-1">Case Information</h5>
                                    <div class="row g-3">
                                        <!-- Location Select -->
                                        <div class="col-12 col-lg-6">
                                            <label for="location" class="form-label">Location</label>
                                            <select class="form-select" id="location" aria-label="Select Location">
                                                <option selected disabled>Select Location</option>
                                                <option value="Delhi">Delhi</option>
                                                <option value="Chandigarh">Chandigarh</option>
                                                <option value="Chennai">Chennai</option>
                                                <option value="Mumbai">Mumbai</option>
                                                <option value="Kochi">Kochi</option>
                                                <option value="Kolkata">Kolkata</option>
                                                <option value="Srinagar">Srinagar</option>
                                                <option value="Lucknow">Lucknow</option>
                                                <option value="Jabalpur">Jabalpur</option>
                                                <option value="Jaipur">Jaipur</option>
                                            </select>
                                        </div>
                                
                                        <!-- Registration Number -->
                                        {{-- <div class="col-12 col-lg-6">
                                            <label for="regno" class="form-label">Registration Number</label>
                                            <input type="text" class="form-control" id="regno" placeholder="Registration Number">
                                        </div> --}}
                                
                                        <!-- Case Type -->
                                        <div class="col-12 col-lg-6">
                                            <label for="case_type" class="form-label">Case Type</label>
                                            <select class="form-select" id="case_type" aria-label="Select Case Type">
                                                <option selected disabled>Select Case Type</option>
                                                <option value="OA">OA</option>
                                                <option value="TA">TA</option>
                                                <option value="AT">AT</option>
                                                <option value="CA">CA</option>
                                                <option value="RA">RA</option>
                                                <option value="MA">MA</option>
                                                <option value="WP(C)">WP(C)</option>
                                                <option value="MA (Ex)">MA (Ex)</option>
                                            </select>
                                        </div>
                                        
                                
                                        <!-- File Number -->
                                        <div class="col-12 col-lg-6">
                                            <label for="file_no" class="form-label">File Number</label>
                                            <input type="text" class="form-control" id="file_no" placeholder="File Number">
                                        </div>
                                
                                        <!-- Year -->
                                        <div class="col-12 col-lg-6">
                                            <label for="year" class="form-label">Year</label>
                                            <select class="form-select" id="year" aria-label="Select Year">
                                                <option selected disabled>Select Year</option>
                                                @for ($year = 2024; $year >= 2009; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        
                                
                                        <!-- Next Button -->
                                        <div class="col-12 col-lg-6">
                                            <button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                        </div>
                                    </div>
                                </div>
                                

                                <!-- Step 2: Parties & Advocates -->
                                <div id="step-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                    <h5 class="mb-1">Parties & Advocates</h5>
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="petitioner" class="form-label">Petitioner</label>
                                            <input type="text" class="form-control" id="petitioner" placeholder="Petitioner">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="respondent" class="form-label">Respondent</label>
                                            <input type="text" class="form-control" id="respondent" placeholder="Respondent">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="padvocate" class="form-label">Petitioner's Advocate</label>
                                            <input type="text" class="form-control" id="padvocate" placeholder="Petitioner's Advocate">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="radvocate" class="form-label">Respondent's Advocate</label>
                                            <input type="text" class="form-control" id="radvocate" placeholder="Respondent's Advocate">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-outline-secondary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                <button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Judgement Details -->
                                <div id="step-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                                    <h5 class="mb-1">Judgement Information</h5>
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="corum" class="form-label">Corum</label>
                                            <input type="text" class="form-control" id="corum" placeholder="Corum">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="court_no" class="form-label">Court Number</label>
                                            <input type="text" class="form-control" id="court_no" placeholder="Court Number">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-outline-secondary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                <button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: Additional Info -->
                                <div id="step-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                                    <h5 class="mb-1">Additional Information</h5>
                                    <div class="row g-3">
                                        <div class="col-12 col-lg-6">
                                            <label for="dpdf" class="form-label">PDF File</label>
                                            <input type="text" class="form-control" id="dpdf" placeholder="PDF File">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="remarks" class="form-label">Remarks</label>
                                            <input type="text" class="form-control" id="remarks" placeholder="Remarks">
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <label for="location" class="form-label">Location</label>
                                            <input type="text" class="form-control" id="location" placeholder="Location">
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-outline-secondary px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                <button class="btn btn-success px-4" onclick="stepper1.next()">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end stepper one-->
        </div>
    </div>
</div>

<script src="{{ asset('backend/assets/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script>
    var stepper1 = new Stepper(document.querySelector('#stepper1'), {
        linear: false,
        animation: true
    });
</script>
@endsection
