<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Connexion | SKGS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Admin panel login page." name="description" />
    <meta content="Author" name="author" />
    <link rel="shortcut icon" href="{{ asset('assets/images/logoKOF.png') }}">
    <link href="{{ asset('template/ubold/layouts/assets/css/config/purple/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/ubold/layouts/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMg0lZSYLqTw/ey4HsBR5hfBc5p6bBhF23HOZf4" crossorigin="anonymous">

    <style>
        .footer {
            background-color: #1394CF;
            color: white;
            position: relative;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 0;
        }

        .footer a {
            color: #b0b0b0;
        }

        .main-container {
            min-height: calc(100vh - 50px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 0;
        }
    </style>
</head>

<body class="authentication-bg">

    <div class="main-container">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <a href="{{ route('admin.dashboard') }}" class="logo">
                                        <img src="{{ asset('assets/images/logoKOF.png') }}" alt="logo" height="22">
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Entrez votre adresse email et votre mot de passe pour accéder au panneau d'administration.</p>
                                </div>

                                <form method="POST" action="{{ route('admin.login.submit') }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="emailaddress" class="form-label">Email</label>
                                        <input
                                            class="form-control @error('email') is-invalid @enderror"
                                            type="email"
                                            id="emailaddress"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            placeholder="Entrez votre email">


                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                required
                                                placeholder="Entrez votre mot de passe">
                                            <div class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                                <i id="eye-icon" class="fas fa-eye"></i>
                                                <i id="eye-slash-icon" class="fas fa-eye-slash d-none"></i>
                                            </div>
                                        </div>

                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                            <label class="form-check-label" for="checkbox-signin">Se rappeler de moi</label>
                                        </div>
                                    </div>

                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary" type="submit">Connexion</button>
                                    </div>
                                </form>

                            </div> <!-- end card-body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end account-pages -->
    </div> <!-- end main-container -->

    <footer class="footer">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-md-12">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> &copy; SKGS powered by <a href="https://kofcorporation.com/">flutter_dave</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('d-none');
                eyeSlashIcon.classList.remove('d-none');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('d-none');
                eyeSlashIcon.classList.add('d-none');
            }
        });
    </script>
</body>
</html>
