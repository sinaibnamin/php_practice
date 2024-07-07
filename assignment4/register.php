<?php 
require 'db_init.php';
require 'vendor/autoload.php';
use App\Controller\CustomerController;

$customer = new CustomerController($db);

$customer->checkLogout();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $customer->create($first_name, $last_name, $email, $password);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}


?>
<!DOCTYPE html>
<html
  class="h-full bg-white"
  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link
      rel="preconnect"
      href="https://fonts.googleapis.com" />
    <link
      rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet" />

    <style>
      * {
        font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont,
          'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans',
          'Helvetica Neue', sans-serif;
      }
    </style>

    <title>Create A New Account</title>
  </head>
  <body class="h-full bg-slate-100">
    <div class="flex flex-col justify-center min-h-full py-12 sm:px-6 lg:px-8">
      <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <div class="flex justify-center">
        <a href="/" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7 2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m6 0v5a2 2 0 0 1-2 2H9a2 2 0 0 1-2-2v-5m0 0v6a2 2 0 0 1 2 2h6a2 2 0 0 1 2-2v-6z"></path></svg>
          <span class="ml-2">Go to Homepage</span>
        </a>
      </div>
        <h2
          class="mt-6 text-2xl font-bold leading-9 tracking-tight text-center text-gray-900">
          Create A New Account
        </h2>
      </div>

   

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
        <div class="px-6 py-12 bg-white shadow sm:rounded-lg sm:px-12">
       
          <?php if ($flash = $customer->getFlashMsg()): ?>
              <div class="flash-container mb-4">
                  <?php echo $flash; ?>
              </div>
          <?php endif; ?>

            
     
          <form
            class="space-y-6"
            action="./register.php"
            method="POST">
            <div>
              <label
                for="name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >First name</label
              >
              <div class="mt-2">
                <input
                  id="name"
                  name="first_name"
                  type="text"
                  required
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 p-2" />
              </div>
            </div>
            <div>
              <label
                for="last_name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Last name</label
              >
              <div class="mt-2">
                <input
                  id="last_name"
                  name="last_name"
                  type="text"
                  required
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 p-2" />
              </div>
            </div>

            <div>
              <label
                for="email"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Email address</label
              >
              <div class="mt-2">
                <input
                  id="email"
                  name="email"
                  type="email"
                  autocomplete="email"
                  required
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 p-2" />
              </div>
            </div>

            <div>
              <label
                for="password"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Password</label
              >
              <div class="mt-2">
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  required
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 p-2" />
              </div>
            </div>

            <div>
              <button
                type="submit"
                class="flex w-full justify-center rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                Register
              </button>
            </div>
          </form>
        </div>

        <p class="mt-10 text-sm text-center text-gray-500">
          Already a customer?
          <a
            href="./login.php"
            class="font-semibold leading-6 text-emerald-600 hover:text-emerald-500"
            >Sign-in</a
          >
        </p>
      </div>
    </div>
  </body>
</html>
