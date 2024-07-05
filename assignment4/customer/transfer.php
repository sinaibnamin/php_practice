<?php
$page_title = 'Transfer Page';
$current_page = "transfer";
include 'header.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  try {
    $amount =  $_POST['amount'];
    $email =  $_POST['email'];
    $customer->transfer($amount, $email);
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}




?>
  <!-- Current Balance Stat -->
  <dl
    class="mx-auto grid grid-cols-1 gap-px sm:grid-cols-2 lg:grid-cols-4">
    <div
      class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
      <dt class="text-sm font-medium leading-6 text-gray-500">
        Current Balance
      </dt>
      <dd
        class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
        $<?= $customer->currentBalance(); ?>
      </dd>
    </div>
  </dl>

  <hr />


    <?php if ($flash = $customer->getFlashMsg()): ?>
        <div class="flash-container mb-4">
            <?php echo $flash; ?>
        </div>
    <?php endif; ?>



  <!-- Transfer Form -->
  <div class="sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
      <div class="mt-4 text-sm text-gray-500">
        <form
          action="./transfer.php"
          method="POST">
          <!-- Recipient's Email Input -->
          <input
            type="email"
            name="email"
            id="email"
            class="block w-full ring-0 outline-none py-2 text-gray-800 border-b placeholder:text-gray-400 md:text-4xl"
            placeholder="Recipient's Email Address"
            required />

          <!-- Amount -->
          <div class="relative mt-4 md:mt-8">
            <div
              class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-0">
              <span class="text-gray-400 md:text-4xl">$</span>
            </div>
            <input
              type="number"
              name="amount"
              id="amount"
              class="block w-full ring-0 outline-none pl-4 py-2 md:pl-8 text-gray-800 border-b border-b-emerald-500 placeholder:text-gray-400 md:text-4xl"
              placeholder="0.00"
              required />
          </div>

          <!-- Submit Button -->
          <div class="mt-5">
            <button
              type="submit"
              class="w-full px-6 py-3.5 text-base font-medium text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 rounded-lg md:text-xl text-center">
              Proceed
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php 
include 'footer.php'; 
?>