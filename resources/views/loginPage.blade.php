<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../node_modules/">
    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- font awesome link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom css file link -->
    <link href="{{ asset('css/form/loginPage.css') }}" rel="stylesheet" type="text/css" media="all" />
</head>

<body>

    <section>
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <div class="logo">
                                LO
                                <br>
                                GO
                            </div>
                            <h2 class="text-center">
                                Login to your account
                            </h2>
                            <p class="text-muted text-center pb-3">Welcome back!</p>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div>
                                    <p class="fw-bold">Email</p>
                                    <input type="text" name="email" id=" " class="form-control py-2"
                                        placeholder="Enter email">
                                </div>
                                @error('email')
                                    <small style="color:#fa0303;margin-top:0.3rem"> {{ $message }}</small>
                                @enderror
                                <div class="mt-3">
                                    <p class="fw-bold">Password</p>
                                    <input type="password" name="password" id="" class="form-control py-2"
                                        placeholder="Enter password">
                                </div>
                                @error('password')
                                    <small style="color:#fa0303;margin-top:0.3rem"> {{ $message }}</small>
                                @enderror
                                <div class="text-center mt-3">
                                    <button class="w-100 login-btn mt-3">
                                        Sign in
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
