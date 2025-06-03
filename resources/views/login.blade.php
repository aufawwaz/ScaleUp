<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login ScaleUp</title>
</head>
<body style="background: linear-gradient(#007AFF, #0E315D);" class="h-[100dvh]">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between px-[5vw] py-[3vh] h-full gap-0 md:gap-[3vw]">
        
        <div class="fade-move-up text-white px-[1rem] py-[1rem] md:w-1/2 md:md:max-w-[480px] md:ml-auto md:mr-0 h-[60%] flex flex-col-reverse gap-1" style="transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;">
            <p class="text-base">Atur produk, transaksi, saldo, dan pelanggan dengan mudah dalam satu platform</p>
            <h3 class="text-3xl font-bold">Kelola Bisnis dalam Satu Tempat dengan Mudah</h3>
        </div>

        <div class="fade-move-up container bg-white rounded-[20px] px-[3rem] py-[1rem] md:w-1/2 md:max-w-[480px] md:mr-auto md:ml-0" style="transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;">
            <div class="flex items-center justify-start">
                <img src="/asset/scaleUp_logo.svg" alt="" class="w-10">
                <p class="text-primary-900 text-2xl transform -translate-x-1.25">cale<b>Up</b></p>
            </div>

            <h2 class="text-dark text-3xl text-center font-bold py-[1rem]">Login</h2>
            <button
                onclick="" 
                class="rounded-[12px] border-1 border-gray p-2 w-full flex flex-row justify-center items-center gap-1 cursor-pointer"
            >
                <img src="/asset/ic_google.svg" alt="" style="width: 12px;">
                <p class="text-dark text-sm font-bold mb-0.5">Sign in with Google</p>
            </button>
            
            <div class="flex items-center justify-center gap-x-[8px] h-[32px]">
                <hr class="w-[30%] border-gray">
                <p class="text-gray mb-1">or</p>
                <hr class="w-[30%] border-gray">
            </div>

            <form action="{{ route('login.process') }}" method="POST" class="flex flex-col gap-[16px] mb-[3rem]">
                @csrf
                <x-input-form type="text" name="email" icon="/asset/ic_email.svg" placeholder="Email"/>
                <x-input-form type="password" name="password" icon="/asset/ic_password.svg" placeholder="Password"/>
                
                <div class="flex justify-between">
                    <div class="flex gap-2 items-center">
                        <input type="checkbox" name="remember_me" class="accent-gray checked:accent-primary h-[24px]">
                        <p class="text-sm mb-0.5">Remember Me</p>
                    </div>
                    <a href="" class="text-sm text-primary">Forgot Password?</a>
                </div>

                <button type="submit" class="rounded-[12px] border-1 bg-primary-900 p-3 w-full font-bold text-white text-sm cursor-pointer">
                    Login
                </button>

                <p class="text-sm">
                    Don't have an account?
                    <a href="{{ route("register") }}" class="text-sm text-primary">Create Account</a>
                </p>
            </form>
        </div>
    </div>
</body>
</html>


<style>
    .fade-move-up {
        opacity: 0;
        transform: translateY(40px);
    }
    .fade-move-up.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.fade-move-up').forEach(function(el, i) {
            setTimeout(() => el.classList.add('show'), 200 + i * 150);
        });
    });
</script>