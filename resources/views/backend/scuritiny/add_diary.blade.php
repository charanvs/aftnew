@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link href="{{ asset('backend/assets/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet" />

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Diary</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Diary</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        <div class="main-body">
            <!--start stepper one-->
            <h6 class="text-uppercase">Diary Details</h6>
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
                                        <!-- Diary Number -->
                                        <div class="col-12 col-lg-6">
                                            <label for="diary_no" class="form-label">Diary Number</label>
                                            <input type="text" class="form-control" id="diary_no" placeholder="Diary Number">
                                        </div>

                                        <!-- Date -->
                                        <div class="col-12 col-lg-6">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="text" class="form-control" id="date" placeholder="Date">
                                        </div>

                                        <!-- Presented By -->
                                        <div class="col-12 col-lg-6">
                                            <label for="presented_by" class="form-label">Presented By</label>
                                            <input type="text" class="form-control" id="presented_by" placeholder="Presented By">
                                        </div>

                                        <!-- Nature of Document -->
                                        <div class="col-12 col-lg-6">
                                            <label for="nature_of_doc" class="form-label">Nature of Document</label>
                                            <input type="text" class="form-control" id="nature_of_doc" placeholder="Nature of Document">
                                        </div>

                                        <!-- Reviewed By -->
                                        <div class="col-12 col-lg-6">
                                            <label for="reviewed_by" class="form-label">Reviewed By</label>
                                            <input type="text" class="form-control" id="reviewed_by" placeholder="Reviewed By">
                                        </div>

                                        <!-- Associated With -->
                                        <div class="col-12 col-lg-6">
                                            <label for="associated_with" class="form-label">Associated With</label>
                                            <input type="text" class="form-control" id="associated_with" placeholder="Associated With">
                                        </div>

                                        <!-- Date of Presentation -->
                                        <div class="col-12 col-lg-6">
                                            <label for="date_of_presentation" class="form-label">Date of Presentation</label>
                                            <input type="text" class="form-control" id="date_of_presentation" placeholder="Date of Presentation">
                                        </div>

                                        <!-- Nature of Grievance -->
                                        <div class="col-12 col-lg-6">
                                            <label for="nature_of_grievance" class="form-label">Nature of Grievance</label>
                                            <input type="text" class="form-control" id="nature_of_grievance" placeholder="Nature of Grievance">
                                        </div>

                                        <!-- Nature of Grievance Code -->
                                        <div class="col-12 col-lg-6">
                                            <label for="nature_of_grievance_code" class="form-label">Nature of Grievance Code</label>
                                            <input type="text" class="form-control" id="nature_of_grievance_code" placeholder="Nature of Grievance Code">
                                        </div>

                                        <!-- Subject -->
                                        <div class="col-12 col-lg-6">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" class="form-control" id="subject" placeholder="Subject">
                                        </div>

                                        <!-- Subject Code -->
                                        <div class="col-12 col-lg-6">
                                            <label for="subject_code" class="form-label">Subject Code</label>
                                            <input type="text" class="form-control" id="subject_code" placeholder="Subject Code">
                                        </div>

                                        <!-- Result -->
                                        <div class="col-12 col-lg-6">
                                            <label for="result" class="form-label">Result</label>
                                            <input type="text" class="form-control" id="result" placeholder="Result">
                                        </div>

                                        <!-- Section Officer Remark -->
                                        <div class="col-12">
                                            <label for="section_officer_remark" class="form-label">Section Officer Remark</label>
                                            <textarea class="form-control" id="section_officer_remark" rows="3" placeholder="Section Officer Remark"></textarea>
                                        </div>

                                        <!-- Deputy Registrar Remark -->
                                        <div class="col-12">
                                            <label for="deputy_registrar_remark" class="form-label">Deputy Registrar Remark</label>
                                            <textarea class="form-control" id="deputy_registrar_remark" rows="3" placeholder="Deputy Registrar Remark"></textarea>
                                        </div>

                                        <!-- Registrar Remark -->
                                        <div class="col-12">
                                            <label for="registrar_remark" class="form-label">Registrar Remark</label>
                                            <textarea class="form-control" id="registrar_remark" rows="3" placeholder="Registrar Remark"></textarea>
                                        </div>

                                        <!-- Not Completed Observations -->
                                        <div class="col-12 col-lg-6">
                                            <label for="not_completed_observations" class="form-label">Not Completed Observations</label>
                                            <input type="text" class="form-control" id="not_completed_observations" placeholder="Not Completed Observations">
                                        </div>

                                        <!-- Case Type -->
                                        <div class="col-12 col-lg-6">
                                            <label for="casetype" class="form-label">Case Type</label>
                                            <input type="text" class="form-control" id="casetype" placeholder="Case Type">
                                        </div>

                                        <!-- Number of Applicants -->
                                        <div class="col-12 col-lg-6">
                                            <label for="no_of_applicants" class="form-label">Number of Applicants</label>
                                            <input type="text" class="form-control" id="no_of_applicants" placeholder="Number of Applicants">
                                        </div>

                                        <!-- Number of Respondents -->
                                        <div class="col-12 col-lg-6">
                                            <label for="no_of_respondents" class="form-label">Number of Respondents</label>
                                            <input type="text" class="form-control" id="no_of_respondents" placeholder="Number of Respondents">
                                        </div>

                                        <!-- Initial -->
                                        <div class="col-12 col-lg-6">
                                            <label for="initial" class="form-label">Initial</label>
                                            <input type="text" class="form-control" id="initial" placeholder="Initial">
                                        </div>

                                        <!-- Remark -->
                                        <div class="col-12">
                                            <label for="remark" class="form-label">Remark</label>
                                            <textarea class="form-control" id="remark" rows="3" placeholder="Remark"></textarea>
                                        </div>

                                        <!-- CA Remark -->
                                        <div class="col-12">
                                            <label for="ca_remark" class="form-label">CA Remark</label>
                                            <textarea class="form-control" id="ca_remark" rows="3" placeholder="CA Remark"></textarea>
                                        </div>

                                        <!-- Notification Remark -->
                                        <div class="col-12">
                                            <label for="notification_remark" class="form-label">Notification Remark</label>
                                            <textarea class="form-control" id="notification_remark" rows="3" placeholder="Notification Remark"></textarea>
                                        </div>

                                        <!-- Notification Date -->
                                        <div class="col-12 col-lg-6">
                                            <label for="notification_date" class="form-label">Notification Date</label>
                                            <input type="text" class="form-control" id="notification_date" placeholder="Notification Date">
                                        </div>

                                        <!-- Nature of Grievance Other -->
                                        <div class="col-12 col-lg-6">
                                            <label for="nature_of_grievance_other" class="form-label">Nature of Grievance Other</label>
                                            <input type="text" class="form-control" id="nature_of_grievance_other" placeholder="Nature of Grievance Other">
                                        </div>

                                        <!-- Next Button -->
                                        <div class="col-12">
                                            <button class="btn btn-primary px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Add remaining steps here if necessary -->
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
