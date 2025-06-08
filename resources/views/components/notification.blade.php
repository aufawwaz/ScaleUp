@if ($success && $success->any())
    <div id="notif-success" class="bg-success-100 text-success text-xs p-2 rounded-lg mb-2 flex justify-between items-center transition-all border-1 border-success duration-300 ease-in-out">
        <ul>
            @foreach ($success->all() as $s)
            <li>{{ $s }}</li>
            @endforeach
        </ul>
        <div class="text-xl cursor-pointer hover:scale-105 transition-all" onclick="closeNotif('notif-success')">×</div>
    </div>
@endif

@if ($errors && $errors->any())
    <div id="notif-error" class="bg-danger-100 text-danger text-xs p-2 rounded-lg mb-2 flex justify-between items-center border-1 border-danger transition-all duration-300 ease-in-out">
        <ul>
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
        <div class="text-xl cursor-pointer hover:scale-105 transition-all" onclick="closeNotif('notif-error')">×</div>
    </div>
@endif

<style>
  .wipe-out {
    opacity: 0;
    transform: scaleY(0.2) translateY(-100%);
    transition: opacity 0.2s ease, transform 0.2s ease;
  }
</style>

<script>
  function closeNotif(id) {
    const notif = document.getElementById(id);
    notif.classList.add('wipe-out');
    setTimeout(() => notif.remove(), 200);
  }
</script>