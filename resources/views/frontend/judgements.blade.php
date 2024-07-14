@extends('frontend.main_master')
@section('main')

@section('title')
Judgements | AFT PB
@endsection


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Judgements</a></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="datatable" class="table table-bordered dt-responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                    <tr>
                                    <th>S No</th>
            <th>Case Type</th>
            <th>File No</th>
            <th>Year</th>
            <th>Petitioner</th>
            <th>MOD</th>
            <th>DOD</th>
            <th>Adv.</th>
            <th>R Adv.</th>




                                </tr>
                                </thead>


                                <tbody>
                                    @php($i = 1)
                                    @foreach($judgements as $key => $item)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td>{{ $item->case_type }}</td>
                                    <td>{{ $item->file_no }}</td>
                                    <td>{{ $item->year }}</td>
                                    <td>{{ $item->petitioner }}</td>
                                    <td>{{ $item->mod }}</td>
                                    <td>{{ $item->dod }}</td>
                                    <td>{{ $item->padvocate }}</td>
                                    <td>{{ $item->radvocate }}</td>



                                </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->





@endsection