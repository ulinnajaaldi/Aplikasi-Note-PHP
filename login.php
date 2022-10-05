<?php
require "functions.php";
session_start();

//cek cookie
if (isset($_COOKIE['login'])) {
    if ($_COOKIE['login'] == 'true') {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if (isset($_POST['remember'])) {
                //buat cookie
                setcookie('login', 'true', time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html data-theme="light">

<head>
    <meta charset=" UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catatan Ku</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.31.0/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <nav class="flex justify-between px-16 py-3 border-b border-black">
        <div class="flex">
            <img src="./src/image/Logo.svg" alt="">
        </div>
        <ul class="flex col gap-3">
            <li><a class="btn btn-ghost" id="btnLogin">Login</a></li>
            <li><a class="btn btn-ghost" id="btnRegister" href="register.php">Register</a></li>
        </ul>
    </nav>
    <section class="mt-5 flex justify-center gap-32" data-aos="zoom-in">
        <div class="text-center">
            <img src="./src/image/GambarUtama.svg" alt="">
            <h1 class="font-bold text-5xl w-96">Atur berbagai tugasmu disini!</h1>
            <h3 class="font-bold text-2xl mt-6">Praktis, cepat dan gratis!</h3>
        </div>
        <div class="w-96 mt-32">
            <form method="POST" id="tiket">
                <div class="block mx-auto mt-5">
                    <label for="email" class=" block text-sm font-medium text-slate-700">
                        Email
                    </label>
                    <input type="email" value="<?php echo $email; ?>" name="email" id="email" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Email" required />
                </div>
                <div class="block mx-auto mt-5">
                    <label for="password" class=" block text-sm font-medium text-slate-700">
                        Password
                    </label>
                    <input type="password" value="<?php echo $password; ?>" name="password" id="password" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Password" required />
                </div>
                <div class="grid place-items-end mt-5">
                    <button class="bg-cyan-300  hover:bg-cyan-500 w-40 h-9 drop-shadow-lg font-semibold text-base rounded-md " name="submit" id="loginBtn">Login</button>
                </div>
            </form>
        </div>
    </section>

</body>

</html>