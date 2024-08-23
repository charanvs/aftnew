@extends('frontend.main_master')

@section('title')
  AFT-PB | Tenders & Notifications
@endsection

@section('main')
<div class="container my-5">
    <h2 class="text-center mb-4">Tenders and Notifications</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Closing Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Display Tenders -->
                <tr>
                    <td colspan="5" class="bg-primary text-white text-center font-weight-bold py-2" style="font-size: 1.25rem;">
                        Tenders
                    </td>
                </tr>
                @foreach($items as $item)
                    @if($item->type == 'Tender')
                        <tr>
                            <td class="align-middle">{{ $item->title }}</td>
                            <td class="align-middle">{{ $item->description }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->closing_date)->format('d-m-Y') }}</td>
                            <td class="align-middle">
                                <a href="{{ asset('upload/tender_notifications/' . $item->pdfname) }}" class="btn btn-primary" target="_blank">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach

                <!-- Display Notifications -->
                <tr>
                    <td colspan="5" class="bg-secondary text-white text-center font-weight-bold py-2" style="font-size: 1.25rem;">
                        Notifications
                    </td>
                </tr>
                @foreach($items as $item)
                    @if($item->type == 'Notification')
                        <tr>
                            <td class="align-middle">{{ $item->title }}</td>
                            <td class="align-middle">{{ $item->description }}</td>
                            <td class="align-middle">{{ \Carbon\Carbon::parse($item->closing_date)->format('d-m-Y') }}</td>
                            <td class="align-middle">
                                <a href="{{ asset('upload/tender_notifications/' . $item->pdfname) }}" class="btn btn-primary" target="_blank">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $items->links() }}
    </div>
</div>
@endsection
