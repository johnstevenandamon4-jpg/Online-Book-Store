<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Online Book Store')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background-color: #f5f6fa;
            color: #212529;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .main-content {
            padding-top: 30px;
            padding-bottom: 40px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .table th {
            white-space: nowrap;
        }

        .page-title {
            font-weight: 600;
        }

        /* Pagination layout */
        .pagination {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0;
            margin-bottom: 0;
        }

        .pagination .page-item {
            display: block;
        }

        .pagination .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            min-height: 38px;
            padding: 0.375rem 0.75rem;
        }

        /* Prevent oversized Laravel pagination SVG icons */
        .pagination svg,
        nav[role="navigation"] svg {
            width: 16px !important;
            height: 16px !important;
            min-width: 16px !important;
            min-height: 16px !important;
            max-width: 16px !important;
            max-height: 16px !important;
            display: inline-block !important;
            vertical-align: middle;
            overflow: hidden;
        }

        .pagination .page-link svg {
            width: 16px !important;
            height: 16px !important;
        }

        nav[role="navigation"] p {
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('books.index') }}">
                Online Book Store
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">
                            Books
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.index') }}">
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('authors.index') }}">
                            Authors
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customers.index') }}">
                            Customers
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            Orders
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container main-content">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <strong>Please correct the following errors:</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <small>Online Book Store Management System</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const storagePrefix = 'online_book_store_form_draft:';
            const pendingKey = storagePrefix + 'pending_submission';

            function getDraftKey(form) {
                return storagePrefix
                    + window.location.pathname
                    + '|'
                    + form.action
                    + '|'
                    + (form.querySelector('input[name="_method"]')?.value || form.method);
            }

            function getFormFields(form) {
                return Array.from(form.elements).filter(function (field) {
                    if (!field.name || field.disabled) {
                        return false;
                    }

                    if (['submit', 'button', 'reset', 'file', 'password'].includes(field.type)) {
                        return false;
                    }

                    if (field.type === 'hidden' && field.name !== '_method') {
                        return false;
                    }

                    return ['INPUT', 'SELECT', 'TEXTAREA'].includes(field.tagName);
                });
            }

            function readForm(form) {
                const values = {};

                getFormFields(form).forEach(function (field) {
                    if (field.type === 'checkbox') {
                        if (!values[field.name]) {
                            values[field.name] = [];
                        }

                        if (field.checked) {
                            values[field.name].push(field.value);
                        }
                    } else if (field.type === 'radio') {
                        if (field.checked) {
                            values[field.name] = field.value;
                        } else if (!(field.name in values)) {
                            values[field.name] = null;
                        }
                    } else {
                        values[field.name] = field.value;
                    }
                });

                return values;
            }

            function restoreForm(form, values) {
                getFormFields(form).forEach(function (field) {
                    if (!(field.name in values)) {
                        return;
                    }

                    if (field.type === 'checkbox') {
                        field.checked = Array.isArray(values[field.name])
                            && values[field.name].includes(field.value);
                    } else if (field.type === 'radio') {
                        field.checked = values[field.name] === field.value;
                    } else {
                        field.value = values[field.name] ?? '';
                    }
                });
            }

            // Clear the last submitted draft only after Laravel confirms success.
            const successAlert = document.querySelector('.alert-success');

            if (successAlert) {
                try {
                    const submittedDraftKey = sessionStorage.getItem(pendingKey);

                    if (submittedDraftKey) {
                        sessionStorage.removeItem(submittedDraftKey);
                        sessionStorage.removeItem(pendingKey);
                    }
                } catch (error) {
                    console.warn('Unable to clear the saved form draft.', error);
                }
            }

            document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(function (form) {
                // Ignore search, filter, and other forms without named fields.
                const fields = getFormFields(form);

                if (fields.length === 0) {
                    return;
                }

                const draftKey = getDraftKey(form);

                try {
                    const savedDraft = sessionStorage.getItem(draftKey);

                    // Laravel's old() values take priority after a validation failure.
                    const hasValidationErrors = form.querySelector('.is-invalid');

                    if (savedDraft && !hasValidationErrors) {
                        restoreForm(form, JSON.parse(savedDraft));
                    }
                } catch (error) {
                    console.warn('Unable to restore the saved form draft.', error);
                }

                function saveDraft() {
                    try {
                        sessionStorage.setItem(draftKey, JSON.stringify(readForm(form)));
                    } catch (error) {
                        console.warn('Unable to save the form draft.', error);
                    }
                }

                form.addEventListener('input', saveDraft);
                form.addEventListener('change', saveDraft);

                form.addEventListener('submit', function () {
                    saveDraft();

                    try {
                        sessionStorage.setItem(pendingKey, draftKey);
                    } catch (error) {
                        console.warn('Unable to track the form submission.', error);
                    }
                });
            });
        });
    </script>

</body>
</html>
