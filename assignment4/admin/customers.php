<?php
$customer_query_email = '';
if(isset($_GET['customer_email'])){
  $customer_query_email = $_GET['customer_email'];
}



$page_title = 'Customers Page';
$current_page = "customer";
include 'header.php';

?>
  <!-- List of All The Customers -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-gray-600">
          A list of all the customers including their name, email and
          profile picture.
        </p>
      </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a
          href="./add_customer.php"
          type="button"
          class="block px-3 py-2 text-sm font-semibold text-center text-white rounded-md shadow-sm bg-sky-600 hover:bg-sky-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-600">
          Add Customer
        </a>
      </div>
    </div>




<form action="/admin/customers.php" method="get" class="flex items-center py-5">
  <input type="text" name="customer_email" id="customer_email" class="mr-2 w-1/4 px-3 py-2 text-gray-700 border border-blue-500 rounded-md focus:outline-none focus:ring-1 focus:ring-sky-500" placeholder="enter email"
  value="<?= $customer_query_email ?>"
  >
  <button type="submit" class="inline-flex items-center px-4 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z"></path></svg>
    <span class="ml-2">Search</span>
  </button>
</form>









    <!-- Users List -->
    <div class="flow-root mt-8">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <ul
          role="list"
          class="divide-y divide-gray-100">          
        
          <?php foreach($admin->getAllCustomer($customer_query_email) as $customer): ?>
          <li
            class="relative flex justify-between px-4 py-5 gap-x-6 hover:bg-gray-50 sm:px-6 lg:px-8">
            <div class="flex gap-x-4">
              <!-- You can either use image or name initials as avatar -->
             
              <span
                class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-sky-500">
                <span
                  class="text-xl font-medium leading-none text-white"
                  ><?= createTwoLetter($customer['first_name'], $customer['last_name']) ?></span
                >
              </span>

              <div class="flex-auto min-w-0">
                <p
                  class="text-sm font-semibold leading-6 text-gray-900">
                  <a href="./customer_transactions.php?customer_email=<?= $customer['email'] ?>">
                    <span
                      class="absolute inset-x-0 bottom-0 -top-px"></span>
                    <?= $customer['first_name']. " " .$customer['last_name'] ?>
                  </a>
                </p>
                <p class="flex mt-1 text-xs leading-5 text-gray-500">
                  <a
                    href="./customer_transactions.php?customer_email=<?= $customer['email'] ?>"
                    class="relative truncate hover:underline"
                    ><?= $customer['email'] ?></a
                  >
                </p>
              </div>
            </div>
          </li>
          <?php endforeach; ?>

          <?php if(count($admin->getAllCustomer()) == 0): ?>
            <li>
                <p 
                  class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center text-red-600">
                  Sorry! no customer here.
                </p>
            </li>
          <?php endif; ?>


          

        
        </ul>
      </div>
    </div>
  </div>
<?php 
include 'footer.php'; 
?>