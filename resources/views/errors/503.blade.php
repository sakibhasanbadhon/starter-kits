<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance Mode</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex align-items-center min-vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body text-center p-5">
                        <!-- Icon -->
                        <div class="display-1 text-primary mb-4">
                            <i class="bi bi-gear"></i>
                        </div>

                        <!-- Title -->
                        <h1 class="h2 fw-bold mb-3">Under Maintenance</h1>

                        <!-- Description -->
                        <p class="text-secondary mb-4">
                            We're performing scheduled maintenance.
                            We'll be back online shortly.
                        </p>

                        <!-- Time Estimate -->
                        {{-- <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                <i class="bi bi-clock me-2"></i>30-45 mins
                            </span>

                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill">
                                <i class="bi bi-calendar me-2"></i>Mar 10, 2026
                            </span>
                        </div> --}}

                        <!-- Contact Button -->
                        <a href="mailto:support@example.com" class="btn btn-primary rounded-pill px-5 py-2">
                            <i class="bi bi-envelope me-2"></i>Contact Support
                        </a>

                        <!-- Footer -->
                        <hr class="my-4">
                        <p class="text-secondary small mb-0">
                            &copy; 2026 Your Company
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
