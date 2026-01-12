@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card user-details-card shadow-sm">
                <div class="card-body align-items-center">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://picsum.photos/id/1/200/200" alt="User Image" class=" me-4">
                        </div>
                        <div class="col-md-8">
                            <div class="user-info">
                               
                                <div class="info-item">
                                    <span class="info-label">First Name: </span>
                                    <span class="info-value">John</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Last Name: </span>
                                    <span class="info-value">Doe</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Username: </span>
                                    <span class="info-value">john.doe</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email: </span>
                                    <span class="info-value">john.doe@example.com</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Mobile: </span>
                                    <span class="info-value">+11234567890</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Address: </span>
                                    <span class="info-value">123 Main St, Springfield, USA</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer bg-light">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <div class="info-item">
                                <span class="info-label">Email Verified: </span>
                                <span class="info-value">Yes</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="info-item">
                                <span class="info-label">SMS Verified: </span>
                                <span class="info-value">No</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="info-item">
                                <span class="info-label">KYC Verified: </span>
                                <span class="info-value">No</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="info-item">
                                <span class="info-label">Two-Factor Verified: </span>
                                <span class="info-value">Yes</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4">
                            <div class="info-item">
                                <span class="info-label">Two-Factor Status: </span>
                                <span class="info-value">Enabled</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script>

    </script>
@endpush

