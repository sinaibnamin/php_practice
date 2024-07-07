<?php
$page_title = 'Add Customer Page';
$current_page = "customer";
include 'header.php';


use App\Controller\CustomerController;

$customer = new CustomerController($db);

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

<?php if ($flash = $customer->getFlashMsg()): ?>
    <div class="flash-container mb-4">
        <?php echo $flash; ?>
    </div>
<?php endif; ?>



  <form action="/admin/add_customer.php" method="POST"
    class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
    <div class="px-4 py-6 sm:p-8">
      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label
            for="first_name"
            class="block text-sm font-medium leading-6 text-gray-900"
            >First Name</label
          >
          <div class="mt-2">
            <input
              type="text"
              name="first_name"
              id="first_name"
              autocomplete="given-name"
              required
              class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <label
            for="last_name"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Last Name</label
          >
          <div class="mt-2">
            <input
              type="text"
              name="last_name"
              id="last_name"
              autocomplete="family-name"
              required
              class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <label
            for="email"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Email Address</label
          >
          <div class="mt-2">
            <input
              type="email"
              name="email"
              id="email"
              autocomplete="email"
              required
              class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <label
            for="password"
            class="block text-sm font-medium leading-6 text-gray-900"
            >Password</label
          >
          <div class="mt-2">
            <input
              type="password"
              name="password"
              id="password"
              autocomplete="password"
              required
              class="block w-full p-2 text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-sky-600 sm:text-sm sm:leading-6" />
          </div>
        </div>
      </div>
    </div>
    <div
      class="flex items-center justify-end px-4 py-4 border-t gap-x-6 border-gray-900/10 sm:px-8">
      <button
        type="reset"
        class="text-sm font-semibold leading-6 text-gray-900">
        Cancel
      </button>
      <button
        type="submit"
        class="px-3 py-2 text-sm font-semibold text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
        Create Customer
      </button>
    </div>
  </form>

<?php 
include 'footer.php'; 
?>