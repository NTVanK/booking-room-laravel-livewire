<div class="container form-control my-5 p-4 shadow" id='booking'>
    @if ($tab)
        <div class="row justify-content-around login">
            <form wire:submit.prevent='login' class="col-xl-5 text-center">
                <h3 class="my-3">Đăng nhập</h3>
                <div class="form-floating my-2">
                    <input type="text" class="form-control" id="floatingInput" wire:model='email' placeholder="email">
                    <label for="floatingInput">Email đăng nhập</label>
                </div>
                @error('user')
                    <div class="form-control bg-danger-subtle text-danger fw-bold">{{ $message }}</div>
                @enderror
                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="floatingPassword" wire:model='password'
                        placeholder="Password">
                    <label for="floatingPassword">Mật khẩu</label>
                </div>
                @error('password')
                    <div class="form-control bg-danger-subtle text-danger fw-bold">{{ $message }}</div>
                @enderror

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" class="btn">Đăng nhập ngay</button>
            </form>
            <div class="vr"></div>
            <div class='col-xl-5'>
                <livewire:layout.register/>
            </div>
        </div>
    @else
        <livewire:layout.bookRoom />
    @endif

    <style>
        .login {
            width: 100%;

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
</div>
