<?php
$page_title = 'Dashboard Page';
$current_page = "dashboard";
include 'header.php';

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

  <!-- List of All The Transactions -->
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <p class="mt-2 text-sm text-gray-700">
          Here's a list of all your transactions which inlcuded
          receiver's name, email, amount and date.
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
              <?php foreach($customer->customerAllTransaction() as $transaction): ?>
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
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?php 
include 'footer.php'; 
?>