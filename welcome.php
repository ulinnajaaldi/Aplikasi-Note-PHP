<?php
session_start();
require 'function.php';
?>

<!doctype html>
<html data-theme="light">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.31.0/dist/full.css" rel="stylesheet" type="text/css" />

    <title>Tambah</title>
</head>

<body>
    <nav class="flex justify-between px-16 py-3 border-b border-black">
        <div class="flex">
            <img src="./src/image/Logo.svg" alt="">
        </div>
        <ul class="flex col gap-3">
            <li><a class="btn btn-ghost" id="btnLogout" href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <!-- 1 -->
    <div class="my-10 mx-16">
        <label for="my-modal-3" class="btn btn-outline btn-success btn-sm">+ Tambah Data</label>
    </div>

    <?php
    $query = "SELECT * FROM note";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $note) {
    ?>
            <section class="bg-amber-400 w-[450px] rounded-lg items-center m-auto px-10 py-5 text-white mt-3">
                <div class="flex justify-between font-bold">
                    <h3><?= $note['judul'] ?></h3>
                    <h3><?= $note['deadline'] ?></h3>
                </div>
                <p class="mt-3">
                <h3><?= $note['catatan'] ?></h3>
                </p>
                <div class="mt-3 flex gap-2 justify-end">
                    <label for="my-modal-5" class="btn btn-success btn-sm text-white">Edit</label>

                    <label for="my-modal-2" class="btn btn-error btn-sm text-white">Delete</label>
                </div>
            </section>

            <!-- Modal Delete -->
            <input type="checkbox" id="my-modal-2" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box relative">
                    <label for="my-modal-2" class="btn btn-sm btn-circle absolute right-2 top-2 btn-error btn-outline">✕</label>
                    <p class="py-4 text-center">Konfirmasi catatan akan dihapus!</p>
                    <form action="code.php" method="POST" class="flex justify-center">
                        <button name="delete_note" value="<?= $note['id']; ?>" class="btn btn-info btn-sm px-12 text-white ">
                            Ya!
                        </button>
                    </form>
                </div>
            </div>

            <!-- Modal Edit -->
            <input type="checkbox" id="my-modal-5" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box relative">
                    <label for="my-modal-5" class="btn btn-sm btn-circle absolute right-2 top-2 btn-error btn-outline">✕</label>
                    <h3 class="text-lg font-bold text-center">Edit Catatan</h3>
                    <form method="POST" id="tiket" action="code.php">
                        <input type="hidden" name="note_id" value="<?= $note['id']; ?>">

                        <div class="block mx-auto mt-5">
                            <label for="judul" class="block text-sm font-medium text-slate-700">
                                Judul
                            </label>
                            <input type="text" value="<?= $note['judul']; ?>" name="judul" id="judul" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        </div>
                        <div class="block mx-auto mt-5">
                            <label for="catatan" class="block text-sm font-medium text-slate-700">
                                Catatan
                            </label>
                            <textarea type="text" name="catatan" id="catatan" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1"><?= $note['catatan']; ?></textarea>
                        </div>
                        <div class="block mx-auto mt-5">
                            <label for="deadline" class="block text-sm font-medium text-slate-700">
                                Tenggat Waktu
                            </label>
                            <input type="date" value="<?= $note['deadline']; ?>" name="deadline" id="deadline" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                        </div>
                        <div class="flex justify-end">
                            <button class="btn btn-info btn-sm mt-5 text-white" name="update_catatan">
                                Update Catatan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
    <?php
        }
    } else {
        echo "<section class='mt-20'>
        <img
          src='./src/image/Kosong.svg'
          alt='Kosong.svg'
          class='flex items-center m-auto'
        />
        <div class='flex flex-col items-center'>
          <h3 class='font-bold text-lg'>Tidak ada catatan di sini...</h3>
          <p class='text-sm text-center'>
            Tambahkan catatan dan dapatkan mengatur diri <br />
            Anda dengan cara terbaik!
          </p>
        </div>
      </section>";
    }
    ?>

    <!-- Modal -->
    <input type="checkbox" id="my-modal-3" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative">
            <label for="my-modal-3" class="btn btn-sm btn-circle absolute right-2 top-2 btn-error btn-outline">✕</label>
            <h3 class="text-lg font-bold text-center">Tambahkan Catatan</h3>
            <form method="POST" id="tiket" action="code.php">
                <div class="block mx-auto mt-5">
                    <label for="judul" class="block text-sm font-medium text-slate-700">
                        Judul
                    </label>
                    <input type="text" name="judul" id="judul" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Judul" required />
                </div>
                <div class="block mx-auto mt-5">
                    <label for="catatan" class="block text-sm font-medium text-slate-700">
                        Catatan
                    </label>
                    <textarea type="text" name="catatan" id="catatan" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Catatan"></textarea>
                </div>
                <div class="block mx-auto mt-5">
                    <label for="deadline" class="block text-sm font-medium text-slate-700">
                        Tenggat Waktu
                    </label>
                    <input type="date" name="deadline" id="deadline" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" />
                </div>
                <div class="flex justify-end">
                    <button class="btn btn-info btn-sm mt-5 text-white" name="save_catatan">
                        Simpan Catatan
                    </button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>