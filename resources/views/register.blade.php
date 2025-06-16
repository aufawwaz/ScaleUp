<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register ScaleUp</title>

    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body style="overflow-y: auto;" class="min-h-dvh bg-white font-poppins">
    <!-- AOS Initialization -->
    <script>
        AOS.init({
            duration: 500, 
            once: false, 
        });
    </script>

    <div class="flex w-full min-h-dvh justify-center items-center">
        
        <div data-aos="fade-right" class="inset-shadow-sm shadow-2xl overflow-clip bg-primary-gradient flex rounded-[20px] items-center justify-between w-8/12">
            {{-- onboard --}}
            <div class="relative w-full h-[28rem] overflow-hidden text-white md:ml-auto mb-4 md:mb-0 md:mr-0 flex flex-col justify-center gap-2" style="transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;">
                <div data-aos="fade-up" data-aos-delay="300" id="auto-scroll" class="flex h-full transition-transform duration-700 ease-in-out mb-4">
                    <div class="w-full px-20 h-full flex-shrink-0 flex flex-col items-center justify-center">
                        <img src="/asset/onboard_1.svg" alt="" class="h-[260px] mb-[1rem]">
                        <h3 class="text-xl font-bold text-center mb-3">Kelola Bisnis dalam Satu Tempat dengan Mudah</h3>
                        <p class="text-xs text-center">Atur produk, transaksi, saldo, dan pelanggan dengan mudah dalam satu platform</p>
                    </div>

                    <div class="w-full h-full px-20 flex-shrink-0 flex flex-col items-center justify-center ">
                        <img src="/asset/onboard_2.svg" alt="" class="h-[260px] mb-[1rem]">
                        <h3 class="text-xl font-bold text-center mb-3">Pengetahuan adalah Kunci Bisnis Berkembang</h3>
                        <p class="text-xs text-center">Pelajari dan Temukan insight bisnis melalui Knowledge Card dan ambil keputusan dengan percaya diri</p>
                    </div>

                    <div class="w-full h-full px-20 flex-shrink-0 flex flex-col items-center justify-center ">
                        <img src="/asset/onboard_3.svg" alt="" class="h-[260px] mb-[1rem]">
                        <h3 class="text-xl font-bold text-center mb-3">Catat & Kendalikan Keuanganmu Secara Real-Time</h3>
                        <p class="text-xs text-center">Pantau saldo dan transaksi bisnis secara instan untuk pengelolaan yang lebih efisien</p>
                    </div>
                </div>
                <div data-aos="zoom-in" data-aos-delay="500" class="w-full h-3 flex gap-1.5 justify-center items-center">
                    <div class="circle current" onclick="getSlide(0)"></div>
                    <div class="circle" onclick="getSlide(1)"></div>
                    <div class="circle" onclick="getSlide(2)"></div>
                </div>
            </div>

            {{-- form register ygy --}}
            <div class="container bg-white px-[3rem] py-[1rem] w-3/4" style="transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;">
                <div data-aos="fade-right" data-aos-delay="300" class="flex mt-5 mb-2 items-center justify-start">
                    <img src="{{ asset('asset\logo.svg') }}" alt="" class="w-10">
                    <p class="text-primary text-2xl transform -translate-x-1.25">cale<b>Up</b></p>
                </div>

                <div data-aos="fade-up" data-aos-delay="500">   
                    <h2 class="text-dark text-2xl text-center font-bold py-[1rem] mb-2">Sign Up</h2>
                    <button class="rounded-[12px] border-1 border-gray h-[44px] w-full flex flex-row justify-center items-center gap-1 cursor-pointer hover:border-primary hover:scale-105 transition">
                        <img src="/asset/ic_google.svg" alt="" style="width: 12px;">
                        <p class="text-dark text-xs font-bold mb-0.5">Sign up with Google</p>
                    </button>

                    <div class="flex items-center justify-center gap-x-[8px] h-[32px]">
                        <hr class="w-[30%] border-gray">
                        <p class="text-gray text-xs mb-1">or</p>
                        <hr class="w-[30%] border-gray">
                    </div>
                    
                    <form action="{{ route('register.process') }}" method="POST" class="flex flex-col gap-[16px] mb-[2rem]">
                        @csrf
                        <x-input-form autocomplete="off" type="text" name="name" icon="/asset/ic_user.svg" placeholder="Name"/>
                        <x-input-form autocomplete="off" type="email" name="email" icon="/asset/ic_email.svg" placeholder="Email"/>
                        <div class="flex gap-[0.7rem]">
                            <x-input-form autocomplete="off" type="password" name="password" icon="/asset/ic_password.svg" placeholder="Password"/>
                            <x-input-form autocomplete="off" type="password" name="password_confirmation" icon="/asset/ic_password.svg" placeholder="Confirm Password"/>
                        </div>

                        <div data-aos="zoom-in" data-aos-delay="800" class="w-full flex flex-col gap-[16px]">
                            <div class="flex gap-2 items-center mt-4">
                                <input type="checkbox" name="remember_me" class="accent-gray checked:accent-primary h-[24px]">
                                <p class="text-xs mb-0.5">I agree to
                                    <a href="" class="text-xs text-primary"> Terms & Conditions</a>
                                </p>
                            </div>
                            
                            <x-custom-button type="submit" size="md"><span class="text-sm font-bold">Sign Up</span></x-custom-button>

                            <p class="text-xs">
                                Already have an account? 
                                <a href="{{ route('login') }}" class="text-xs text-primary">Sign in</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!-- Styling dan script dari login.blade.php -->
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
        width: 18px;
        height: 9px;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
        background: white;
    }
</style>
<script>
    // fade in
    window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.fade-move-up').forEach(function(el, i) {
            setTimeout(() => el.classList.add('show'), 200 + i * 150);
        });
    });

    // onboard logic
    let currentSlide = 0;
    const totalSlides = 3;
    const autoScroll = document.getElementById('auto-scroll');

    function updateScroll() {
        if (!autoScroll) return;
        const slideWidth = autoScroll.children[0].offsetWidth;
        autoScroll.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        document.querySelectorAll('.circle').forEach(function(c, i){
            if (i == currentSlide) c.classList.add('current');
            else c.classList.remove('current');
        })
    }
    
    function startAutoScroll(){
        if (!autoScroll) return;
        autoScrollInterval = setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateScroll();
        }, 4000);
    }
    if (autoScroll) startAutoScroll();

    window.addEventListener('resize', function(){
        currentSlide = 0;
        updateScroll();
    })

    function getSlide(toSlide){
        currentSlide = toSlide;
        updateScroll();

        clearInterval(autoScrollInterval)
        startAutoScroll()
    }
</script>