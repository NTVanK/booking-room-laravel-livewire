<form wire:submit.prevent='login' class="form-control p-3 shadow login">

    <div class="">
        <a href="{{ route('home') }}" class="col navbar-brand d-flex align-items-center gap-2">
            <img src="{{ asset('assets\image\Logo.png') }}" height="38" alt="Logo">
            <span class='fw-bold fs-3'>The Line</span>
        </a>
    </div>

    <h3 class='w-100 text-center my-5'>Đăng nhập Admin</h3>

    <hr>

    <div class="form-floating my-2">
        <input type="text" class="form-control" id="floatingInput" wire:model='admin' placeholder="admin">
        <label for="floatingInput">Tên đăng nhâp</label>
    </div>
    @error('user')
        <div class="form-control bg-danger-subtle text-danger fw-bold">{{$message}}</div>
    @enderror
    <div class="form-floating my-2">
        <input type="password" class="form-control" id="floatingPassword" wire:model='password' placeholder="Password">
        <label for="floatingPassword">Mật khẩu</label>
    </div>
    @error('password')
        <div class="form-control bg-danger-subtle text-danger fw-bold">{{$message}}</div>
    @enderror

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <hr>

    <button type="submit" class="btn btn-lg">Đăng nhập</button>

    <style>
        .login {
            width: 450px;

            h3 {
                filter: drop-shadow(0 5px 3px white);
                background: -webkit-linear-gradient(317deg, rgba(0, 60, 255, 0.81) 0%, rgb(255 0 123) 70%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            button {
                width: 100%;
                border: none;
                color: white;
                font-weight: bold;
                background: -webkit-linear-gradient(317deg, rgba(0, 60, 255, 0.81) 0%, rgb(255 0 123) 70%);
                transition: 0.25s;

                &:hover {
                    box-shadow: 0 3px 5px black;
                    transform: 0.25s;
                }
            }
        }
    </style>
</form>
