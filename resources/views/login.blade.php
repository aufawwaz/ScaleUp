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
    <div class=" flex flex-col px-[5vw] py-[3vh]">
        <div class="text-white px-[1rem] py-[1rem]">
            <h3 class="text-xl font-bold">Kelola Bisnis dalam Satu Tempat dengan Mudah</h3>
            <p class="text-base">Atur produk, transaksi, saldo, dan pelanggan dengan mudah dalam satu platform</p>
        </div>
        <div class="container bg-white rounded-[20px] px-[3rem] py-[1rem]">
            <p class="text-primary-900 text-xl">cale<b>Up</b></p>

            <h2 class="text-dark text-3xl text-center font-bold py-[1rem]">Login</h2>
            <button class="text-dark text-base font-bold rounded-[12px] border-1 border-gray p-2 w-full">
                {{-- <img src="google.png" alt="" style="width: 16px;"">  --}}
                Sign in with Google
            </button>
            <div class="flex items-center justify-center gap-x-[8px]">
                <hr class="w-[30%] border-gray">
                <p class="text-gray">or</p>
                <hr class="w-[30%] border-gray">
            </div>
            <form action="">
                <input type="text" placeholder="Email"  class="rounded-[12px] border-1 border-gray p-2 w-full">
            </form>
        </div>
    </div>
</body>
</html>