<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login ScaleUp</title>
</head>
<body style="background: linear-gradient(#007AFF, #0E315D); overflow-y: auto;" class="min-h-screen md:h-full">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between px-[5vw] py-[3vh] md:h-[100vh] gap-[6vh] md:gap-[3vw]">
        
        <div class="fade-move-up relative w-full h-[32rem] md:w-[480px] overflow-hidden text-white md:ml-auto mb-4 md:mb-0 md:mr-0 flex flex-col justify-center gap-2" style="transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;">
            <div id="auto-scroll" class="flex h-full transition-transform duration-700 ease-in-out">
                <div class="w-full h-full flex-shrink-0 flex flex-col items-center justify-center px-4">
                    <img src="/asset/onboard_1.svg" alt="" class="w-[275px] mb-[1rem]">
                    <h3 class="text-2xl font-bold">Kelola Bisnis dalam Satu Tempat dengan Mudah</h3>
                    <p class="text-sm">Atur produk, transaksi, saldo, dan pelanggan dengan mudah dalam satu platform</p>
                </div>

                <div class="w-full h-full flex-shrink-0 flex flex-col items-center justify-center px-4">
                    <img src="/asset/onboard_2.svg" alt="" class="w-[275px] mb-[1rem]">
                    <h3 class="text-2xl font-bold">Pengetahuan adalah Kunci Bisnis Berkembang</h3>
                    <p class="text-sm">Pelajari dan Temukan insight bisnis melalui Knowledge Card dan ambil keputusan dengan percaya diri</p>
                </div>

                <div class="w-full h-full flex-shrink-0 flex flex-col items-center justify-center px-4">
                    <img src="/asset/onboard_3.svg" alt="" class="w-[275px] mb-[1rem]">
                    <h3 class="text-2xl font-bold">Catat & Kendalikan Keuanganmu Secara Real-Time</h3>
                    <p class="text-sm">Pantau saldo dan transaksi bisnis secara instan untuk pengelolaan yang lebih efisien</p>
                </div>
            </div>
            <div class="w-full h-3 flex gap-1 justify-center items-center">
                <div class="circle current" onclick="getSlide(0)"></div>
                <div class="circle" onclick="getSlide(1)"></div>
                <div class="circle" onclick="getSlide(2)"></div>
            </div>
        </div>


        <div class="fade-move-up container bg-white rounded-[20px] px-[3rem] py-[1rem] md:w-1/2 md:max-w-[480px] md:min-w-[360px] md:mr-auto md:ml-0" style="transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;">
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
    .circle{
        width: 8px;
        height: 8px;
        border-radius: 4px;
        background-color: lightgray;
        cursor: pointer;
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
    }
    .circle.current{
        transform: scale(1.3, 1.3);
        background-color: white;
    }
</style>
<script>
    window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.fade-move-up').forEach(function(el, i) {
            setTimeout(() => el.classList.add('show'), 200 + i * 150);
        });
    });

    let currentSlide = 0;
    const totalSlides = 3;
    const autoScroll = document.getElementById('auto-scroll');

    function updateScroll() {
        const slideWidth = autoScroll.children[0].offsetWidth;
        autoScroll.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        document.querySelectorAll('.circle').forEach(function(c, i){
            if (i == currentSlide) c.classList.add('current');
            else c.classList.remove('current');
        })
    }
    
    function startAutoScroll(){
        autoScrollInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateScroll();
        }, 3000);
    }
    startAutoScroll()

    window.addEventListener('resize', function(){
        currentSlide = 0;
        updateScroll
    })

    function getSlide(toSlide){
        currentSlide = toSlide;
        updateScroll();

        clearInterval(autoScrollInterval)
        startAutoScroll()
    }
</script>