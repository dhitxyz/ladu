<el-dialog>
  <dialog id="dialog" aria-labelledby="dialog-title"
    class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">

    <el-dialog-backdrop class="fixed inset-0 bg-black/50 transition-opacity"></el-dialog-backdrop>

    <div tabindex="0"
      class="flex min-h-full items-center justify-center p-4 focus:outline-none">

      <el-dialog-panel
        class="relative w-full max-w-150 transform overflow-hidden py-10 rounded-lg bg-white text-left shadow-xl">

        <div class="relative pb-6">
          <h3 id="dialog-title" class="text-xl font-semibold text-gray-800 text-center">
            MASUK
          </h3>

          <button type="button" command="close" commandfor="dialog"
            class="cursor-pointer absolute right-8 top-1 text-gray-400 hover:text-gray-600 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>

        <div class="w-full flex items-center my-2">
          <hr class="grow border-gray-300">
        </div>

        <form method="POST" action="{{ route('login') }}">
          @csrf

          <div class="flex flex-col items-center space-y-4 py-4">

            <div class="w-[65%]">
              <label class="text-[12px] text-gray-600 font-semibold">
                Email, No. telp, atau username
              </label>
              <input type="text" name="login" required autocomplete="username"
                class="w-full mt-1 px-3 py-3 rounded-md text-sm border border-gray-300 focus:border-[#a51a39] focus:ring-2 focus:ring-red-100 outline-none transition">
            </div>

            <div class="w-[65%]">
              <label class="text-[12px] text-gray-600 font-semibold">
                Password
              </label>
              <input type="password" name="password" required
                class="w-full mt-1 px-3 py-3 rounded-md text-sm border border-gray-300 focus:border-[#a51a39] focus:ring-2 focus:ring-red-100 outline-none transition">
            </div>

            <button type="submit"
              class="cursor-pointer w-[65%] mt-2 py-3 bg-[#a51a39] text-white text-sm font-semibold rounded-md hover:bg-[#aa0b33] transition">
              LOGIN
            </button>

            <div class="w-full flex items-center my-2">
              <hr class="grow border-gray-300">
            </div>

            <div class="w-[65%] pt-6 text-center text-sm text-gray-600">
              Anda memiliki punya akun? <br><br>
              <a href="{{ route('register') }}" class="text-[#a51a39] font-semibold hover:underline">
                DAFTAR SEKARANG
              </a>
            </div>

          </div>
        </form>

      </el-dialog-panel>
    </div>

  </dialog>
</el-dialog>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const dialog = document.getElementById('dialog');

  dialog.addEventListener('toggle', function () {
    if (dialog.open) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }
  });
});
</script>
