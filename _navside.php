<nav class="fixed top-0 z-50 w-full bg-blue-950 shadow-md">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
          </svg>
        </button>
        <a href="dashboard.php" class="flex ms-2 md:me-24">
          <img src="assets/img/system/sq-logo.png" class="h-6 me-3" alt="Print-Max Logo" />
          <p class="text-neutral-100 font-regular invisible md:visible">PRINT<span class="font-bold">MAX</span></p>
        </a>
      </div>
      <div class="flex items-center">
        <div class="flex items-center ms-3">
          <div>
            <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <img class="w-8 h-8 rounded-full border-white border-2" src="assets/img/system/avatar.png" alt="user photo">
            </button>
          </div>
          <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow w-full sm:w-64" id="dropdown-user">
            <div class="px-4 py-3" role="none">
              <p class="text-sm text-gray-900 font-semibold" role="none">
                <?= $_SESSION["name"]; ?>
              </p>
              <p class="text-xs text-gray-700 font-normal" role="none">
                <?= $_SESSION["role_name"]; ?>
              </p>
            </div>
            <ul class="py-1" role="none">
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Earnings</a>
              </li>
              <li>
                <a href="signout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-blue-950 sm:translate-x-0" aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-blue-950">
    <ul class="space-y-2 font-regular">
      <?php
      include_once 'conn.php';
      $role_id = $_SESSION['role_id'];
      $query = mysqli_query($con, "SELECT * FROM menu WHERE menu_access LIKE '%$role_id%'");
      while ($menus = mysqli_fetch_array($query)) {
      ?>
        <li class="hover:bg-neutral-950 rounded-lg hover:opacity-50">
          <a href="<?= $menus['menu_url']; ?>" class="flex items-center p-2 text-neutral-100 rounded-lg font-medium">
            <i class="fa <?= $menus['menu_icon']; ?> fa-sm fa-fw text-neutral-300"></i>
            <span class="ms-3 ml-2"><?= $menus['menu_title']; ?></span>
          </a>
        </li>
      <?php } ?>
      <li class="pt-96">
        <hr class="opacity-50">
      </li>
      <li class="hover:bg-neutral-950 rounded-lg hover:opacity-50">
        <a href="signout.php" class="flex items-center p-2 text-red-600 rounded-lg">
          <i class="fa fa-sign-out fa-rotate-180 fa-md fa-fw text-red-800"></i>
          <span class="ms-3 ml-2">Sign out</span>
        </a>
      </li>
    </ul>
  </div>
</aside>