@extends('admin.layouts.app')


@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary card-outline">
            <div class="card-body p-5">
                 <form action="{{ route('admin.system.maintenance.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <!-- Title and Status Row -->
                        <div class="row  mb-4">
                            <div class="col-md-8">
                                <label for="title" class="form-label fw-semibold text-secondary">
                                    <i class="fas fa-heading me-2 text-primary"></i>Maintenance Title
                                </label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg rounded-3 border-1 bg-light"
                                       value="{{ @$systemMaintenance->title ?? '' }}"
                                       placeholder="e.g., Scheduled System Update"
                                       style="padding: 12px 20px;">

                            </div>
                            <div class="col-md-4">
                                <label for="title" class="form-label fw-semibold text-secondary">
                                    <i class="fas fa-check-circle me-2 text-primary"></i>Status
                                </label>
                                <select name="status" id="" class="form-control select2 rounded-3 border-1 bg-light" style="padding: 12px 20px;">
                                    <option value="1" {{ $systemMaintenance->status == 1 ? 'selected' : '' }}> Active</option>
                                    <option value="0" {{ $systemMaintenance->status == 0 ? 'selected' : '' }}> Inactive</option>
                                </select>
                            </div>

                        
                        </div>

                        <!-- Details Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="details" class="form-label fw-semibold text-secondary">
                                    <i class="fas fa-align-left me-2 text-primary"></i>Maintenance Details
                                </label>
                                <textarea name="details" id="details" rows="6" class="form-control rounded-3 border-1 bg-light" placeholder="Describe what's being updated, estimated downtime, and any important information for users..."
                                          style="padding: 15px; resize: vertical;">{{ @$systemMaintenance->details ?? '' }}</textarea>
                                <small class="text-secondary mt-2 d-block">
                                    <i class="fas fa-info-circle me-1"></i>Provide detailed information about the maintenance
                                </small>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex gap-3 justify-content-center">
                                    <button type="submit"
                                            class="btn btn-primary px-5 py-3 rounded-3 shadow-sm hover-lift"
                                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; transition: all 0.3s;">
                                        <i class="fas fa-save me-2"></i> Save Changes
                                    </button>


                                </div>
                            </div>
                        </div>

                        <!-- Form Footer Note -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="text-center small text-secondary">
                                    <i class="fas fa-shield-alt me-1 text-primary"></i>
                                    Changes will take effect immediately after saving
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>






@endsection


@push('script')
    <script>



    </script>
@endpush
