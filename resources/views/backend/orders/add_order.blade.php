@extends('admin.admin_dashboard')
@section('admin')
  <div class="page-content">
    <h6 class="mb-0 text-uppercase">Add Orders</h6>
    <hr />
    <div class="card">
        <div class="card-body p-4">
            <h5 class="mb-4">Add Order</h5>
            <form class="row g-3" method="POST" action="{{ route('store.order') }}">
                @csrf
                <div class="col-md-6">
                    <label for="registration_no" class="form-label">Registration No</label>
                     <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-atom'></i></span>
                        <input type="text" class="form-control" id="registration_no" name="registration_no" value="{{ old('registration_no', $registration->registration_no) }}" readonly>
                      </div>
                      @error('registration_no')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-6">
                    <label for="date_of_order" class="form-label">Date of Order</label>
                     <div class="input-group">
                        <span class="input-group-text"><i class='bx bxs-calendar-event'></i></span>
                        <input type="text" class="form-control" id="date_of_order" name="date_of_order" value="{{ old('date_of_order', $dol) }}" readonly>
                      </div>
                      @error('date_of_order')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-12">
                    <label for="applicants" class="form-label">Applicant Name</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-user'></i></span>
                        <input type="text" class="form-control" id="applicants" name="applicants" value="{{ old('applicants', $registration->applicant) }}">
                      </div>
                      @error('applicants')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-12">
                    <label for="padvocate" class="form-label">Party Advocate</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-user-plus'></i></span>
                        <input type="text" class="form-control" id="padvocate" name="padvocate" value="{{ old('padvocate', $registration->padvocate) }}">
                      </div>
                      @error('padvocate')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-12">
                    <label for="radvocate" class="form-label">Respondent Advocate</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-user-check'></i></span>
                        <input type="text" class="form-control" id="radvocate" name="radvocate" value="{{ old('radvocate', $registration->radvocate) }}">
                      </div>
                      @error('radvocate')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-12">
                    <label for="respondent" class="form-label">Respondent</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-user-circle'></i></span>
                        <input type="text" class="form-control" id="respondent" name="respondent" value="{{ old('respondent', $registration->respondent) }}">
                      </div>
                      @error('respondent')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-6">
                    <label for="court_no" class="form-label">Court No</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-grid-horizontal'></i></span>
                        <select class="form-select" id="court_no" name="court_no">
                            <option selected>Select court</option>
                            <option value="1" {{ old('court_no') == 1 ? 'selected' : '' }}>One</option>
                            <option value="2" {{ old('court_no') == 2 ? 'selected' : '' }}>Two</option>
                            <option value="3" {{ old('court_no') == 3 ? 'selected' : '' }}>PR Court</option>
                          </select>
                      </div>
                      @error('court_no')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-6">
                    <label for="sno_cause_list" class="form-label">S.No. of Cause List</label>
                     <div class="input-group">
                        <span class="input-group-text"><i class='bx bx-grid-small'></i></span>
                        <input type="text" class="form-control" id="sno_cause_list" name="sno_cause_list" value="{{ old('sno_cause_list') }}">
                      </div>
                      @error('sno_cause_list')
                          <div class="text-danger">{{ $message }}</div>
                      @enderror
                </div>
                <div class="col-md-12">
                    <div class="d-md-flex d-grid align-items-center gap-3">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

   <!-- Modal -->
   <div class="modal fade" id="addContentModal" tabindex="-1" aria-labelledby="addContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addContentModalLabel">Add Contents</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="contentEditor" class="form-label">Content</label>
                        <textarea id="contentEditor" class="form-control"></textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
  </div>
@endsection
@section('scripts')
    <!-- Include the editor's script, e.g., TinyMCE or CKEditor -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: '#contentEditor',
          height: 300,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
          ],
          toolbar: 'undo redo | formatselect | bold italic backcolor | \
          alignleft aligncenter alignright alignjustify | \
          bullist numlist outdent indent | removeformat | help'
        });
    </script>
@endsection
