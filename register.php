<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
	header("Location: index.php");
}

if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (username, email, password)
					VALUES ('$username', '$email', '$password')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Registrasi Sukses.')</script>";
				$username = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Sudah ada.')</script>";
		}
	} else {
		echo "<script>alert('Password Tidak cocok.')</script>";
	}
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
			<li><a class="btn btn-ghost" id="btnLogin" href="index.php">Login</a></li>
			<li><a class="btn btn-ghost" id="btnRegister">Register</a></li>
		</ul>
	</nav>
	<section class="mt-5 flex justify-center gap-32" data-aos="zoom-in">
		<div class="text-center">
			<img src="./src/image/GambarUtama.svg" alt="">
			<h1 class="font-bold text-5xl w-96">Atur berbagai tugasmu disini!</h1>
			<h3 class="font-bold text-2xl mt-6">Praktis, cepat dan gratis!</h3>
		</div>
		<div class="w-96 mt-20">
			<form method="POST" id="tiket">
				<div class="block mx-auto mt-5">
					<label for="username" class=" block text-sm font-medium text-slate-700">
						Username
					</label>
					<input type="text" name="username" id="username" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Username" value="<?php echo $username; ?>" required />
				</div>
				<div class="block mx-auto mt-5">
					<label for="email" class=" block text-sm font-medium text-slate-700">
						Email
					</label>
					<input type="email" name="email" id="email" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Example@gmail.com" value="<?php echo $email; ?>" required />
				</div>
				<div class="block mx-auto mt-5">
					<label for="password" class=" block text-sm font-medium text-slate-700">
						Password
					</label>
					<input type="password" name="password" id="password" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Password" value="<?php echo $_POST['password']; ?>" required />
				</div>
				<div class="block mx-auto mt-5">
					<label for="cpassword" class=" block text-sm font-medium text-slate-700">
						Confirm Password
					</label>
					<input type="password" name="cpassword" id="cpassword" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Confirm Password" value="<?php echo $_POST['cpassword']; ?>" required />
				</div>
				<div class="grid place-items-end mt-5">
					<button class="bg-cyan-300  hover:bg-cyan-500 w-40 h-9 drop-shadow-lg font-semibold text-base rounded-md " name="submit" id="registerBtn">Register</button>
				</div>
			</form>
		</div>
	</section>

</body>

</html>