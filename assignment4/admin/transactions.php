<?php
$page_title = 'Transaction Page';
$current_page = "transaction";
include 'header.php';

?>
  <!-- List of All The Transactions -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-gray-700">
          List of transactions made by the customers.
        </p>
      </div>
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div
          class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
          <thead>
              <tr>
                <th
                  scope="col"
                  class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                  Transaction Type
                </th>
                <th
                  scope="col"
                  class="whitespace-nowrap py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                  From account
                </th>
                <th
                  scope="col"
                  class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                  To account
                </th>
                <th
                  scope="col"
                  class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                  Amount
                </th>
                <th
                  scope="col"
                  class="whitespace-nowrap px-2 py-3.5 text-left text-sm font-semibold text-gray-900">
                  Date
                </th>
              </tr>
            </thead>
            <?php 
            $red_class = "text-red-600";
            $green_class = "text-emerald-600";
            ?>
            <tbody class="divide-y divide-gray-200 bg-white">
             
            <?php foreach($admin->getAllTransactions() as $transaction): ?>
              <tr>
                <td
                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-0 <?= $transaction['color'] == 'red' ? $red_class : $green_class; ?>">
                  <?= $transaction['type']; ?>
                </td>
                <td
                  class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-500 sm:pl-0">
                  <?= $transaction['from_account_email']; ?>
                </td>
                <td
                  class="whitespace-nowrap px-2 py-4 text-sm font-medium text-gray-500">
                  <?= $transaction['to_account_email'] ?? 'N/A'; ?>
                </td>
                <td
                  class="whitespace-nowrap px-2 py-4 text-sm <?= $transaction['color'] == 'red' ? $red_class : $green_class; ?>">
                  <?= $transaction['currency_sign'] . $transaction['amount']; ?>
                </td>
                <td
                  class="whitespace-nowrap px-2 py-4 text-sm text-gray-500">
                  <?= $transaction['timestamp']; ?>
                </td>
              </tr>
              <?php endforeach; ?>

              <?php if(count($admin->getAllTransactions()) == 0): ?>
                <tr >
                <td colspan="5"
                  class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-center <?= $red_class ?>">
                  Sorry! no transaction here.
                </td>
           
              </tr>
              <?php endif; ?>



            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
<?php 
include 'footer.php'; 
?>