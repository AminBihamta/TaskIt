
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body id="body">

<?php 
require_once ("../config.php"); 
session_start();
?>
    <header>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="128"
          height="56"
          viewBox="0 0 128 56"
          fill="none"
        >
          <path
            d="M0.828057 34.6478C0.624675 34.3281 0.43582 33.8923 0.261492 33.3403C0.0871639 32.7882 0 32.2072 0 31.597C0 30.4639 0.246964 29.6503 0.740893 29.1564C1.26388 28.6625 1.93213 28.4155 2.74566 28.4155H21.7474C21.9508 28.7351 22.1396 29.1709 22.314 29.723C22.4883 30.275 22.5755 30.8561 22.5755 31.4663C22.5755 32.5994 22.314 33.4129 21.791 33.9069C21.2971 34.4008 20.6433 34.6478 19.8298 34.6478H14.9922V54.7826C14.6726 54.8697 14.1641 54.9569 13.4668 55.0441C12.7986 55.1312 12.1303 55.1748 11.4621 55.1748C10.7938 55.1748 10.1982 55.1167 9.6752 55.0005C9.18127 54.9133 8.75997 54.739 8.41132 54.4775C8.06266 54.216 7.80117 53.8528 7.62684 53.3879C7.45252 52.9231 7.36535 52.3129 7.36535 51.5575V34.6478H0.828057Z"
            fill="white"
          />
          <path
            d="M33.4444 50.2501C33.9383 50.2501 34.4758 50.2065 35.0569 50.1193C35.6671 50.0031 36.1174 49.8578 36.408 49.6835V46.197L33.2701 46.4585C32.4565 46.5166 31.7883 46.6909 31.2653 46.9815C30.7423 47.272 30.4808 47.7078 30.4808 48.2889C30.4808 48.87 30.6987 49.3494 31.1345 49.7271C31.5994 50.0758 32.3694 50.2501 33.4444 50.2501ZM33.0957 33.1224C34.6647 33.1224 36.0884 33.2822 37.3668 33.6018C38.6742 33.9214 39.7783 34.4153 40.679 35.0836C41.6087 35.7228 42.3206 36.5508 42.8145 37.5678C43.3084 38.5556 43.5554 39.7323 43.5554 41.0979V50.8602C43.5554 51.6156 43.3375 52.2403 42.9017 52.7342C42.4949 53.1991 42.001 53.6059 41.4199 53.9545C39.5313 55.0876 36.8728 55.6542 33.4444 55.6542C31.9045 55.6542 30.5099 55.5089 29.2605 55.2184C28.0402 54.9278 26.9797 54.492 26.079 53.9109C25.2074 53.3298 24.5246 52.589 24.0307 51.6883C23.5658 50.7876 23.3334 49.7416 23.3334 48.5504C23.3334 46.5456 23.929 45.0057 25.1202 43.9307C26.3115 42.8557 28.1564 42.1874 30.6551 41.926L36.3644 41.3158V41.0107C36.3644 40.1682 35.9867 39.5725 35.2313 39.2239C34.5049 38.8462 33.4444 38.6573 32.0498 38.6573C30.9457 38.6573 29.8707 38.7735 28.8247 39.006C27.7787 39.2384 26.8345 39.5289 25.9919 39.8776C25.6142 39.6161 25.2946 39.2239 25.0331 38.7009C24.7716 38.1489 24.6408 37.5823 24.6408 37.0012C24.6408 36.2458 24.8152 35.6501 25.1638 35.2143C25.5415 34.7494 26.1081 34.3572 26.8635 34.0376C27.7061 33.718 28.694 33.4856 29.8271 33.3403C30.9893 33.195 32.0788 33.1224 33.0957 33.1224Z"
            fill="white"
          />
          <path
            d="M65.9541 48.6375C65.9541 50.8457 65.1261 52.5744 63.47 53.8238C61.8139 55.0731 59.3733 55.6978 56.1482 55.6978C54.9279 55.6978 53.7948 55.6106 52.7488 55.4363C51.7028 55.262 50.8022 55.0005 50.0467 54.6518C49.3204 54.2741 48.7393 53.8092 48.3035 53.2572C47.8967 52.7052 47.6933 52.0515 47.6933 51.296C47.6933 50.5987 47.8386 50.0176 48.1291 49.5528C48.4197 49.0588 48.7683 48.6521 49.1751 48.3325C50.0177 48.7973 50.9765 49.2186 52.0515 49.5963C53.1556 49.945 54.4195 50.1193 55.8431 50.1193C56.7438 50.1193 57.4266 49.9886 57.8915 49.7271C58.3854 49.4656 58.6324 49.1169 58.6324 48.6811C58.6324 48.2744 58.4581 47.9548 58.1094 47.7223C57.7607 47.4899 57.1796 47.301 56.3661 47.1558L55.0587 46.8943C52.5309 46.4004 50.6424 45.6304 49.393 44.5845C48.1727 43.5094 47.5626 41.9841 47.5626 40.0084C47.5626 38.9333 47.795 37.96 48.2599 37.0883C48.7247 36.2167 49.3785 35.4903 50.2211 34.9092C51.0636 34.3282 52.066 33.8778 53.2282 33.5582C54.4195 33.2386 55.7269 33.0788 57.1506 33.0788C58.2256 33.0788 59.228 33.166 60.1578 33.3403C61.1166 33.4856 61.9446 33.718 62.6419 34.0376C63.3392 34.3572 63.8913 34.7785 64.298 35.3015C64.7048 35.7954 64.9082 36.391 64.9082 37.0883C64.9082 37.7566 64.7774 38.3377 64.5159 38.8316C64.2835 39.2965 63.9784 39.6888 63.6007 40.0084C63.3683 39.8631 63.0196 39.7178 62.5548 39.5725C62.0899 39.3982 61.5814 39.2529 61.0294 39.1367C60.4774 38.9914 59.9108 38.8752 59.3297 38.7881C58.7777 38.7009 58.2692 38.6573 57.8043 38.6573C56.8455 38.6573 56.1046 38.7735 55.5816 39.006C55.0587 39.2093 54.7972 39.5435 54.7972 40.0084C54.7972 40.328 54.9424 40.5894 55.233 40.7928C55.5235 40.9962 56.0756 41.1851 56.8891 41.3594L58.2401 41.6645C61.0294 42.3037 63.0051 43.1898 64.1673 44.323C65.3585 45.427 65.9541 46.8652 65.9541 48.6375Z"
            fill="white"
          />
          <path
            d="M77.773 45.151V54.7826C77.4534 54.8697 76.945 54.9569 76.2477 55.0441C75.5504 55.1312 74.8676 55.1748 74.1993 55.1748C73.5311 55.1748 72.9354 55.1167 72.4125 55.0005C71.9185 54.9133 71.4972 54.739 71.1486 54.4775C70.7999 54.216 70.5384 53.8528 70.3641 53.3879C70.1898 52.9231 70.1026 52.3129 70.1026 51.5575V28.5463C70.4222 28.4882 70.9307 28.4155 71.628 28.3284C72.3253 28.2121 72.9935 28.154 73.6327 28.154C74.301 28.154 74.8821 28.2121 75.376 28.3284C75.899 28.4155 76.3348 28.5898 76.6835 28.8513C77.0321 29.1128 77.2936 29.476 77.468 29.9409C77.6423 30.4058 77.7294 31.0159 77.7294 31.7713V38.7009L86.7945 28.2848C88.7702 28.2848 90.1794 28.6625 91.0219 29.4179C91.8936 30.1443 92.3294 31.0159 92.3294 32.0328C92.3294 32.7883 92.1406 33.5001 91.7628 34.1683C91.3851 34.8366 90.775 35.592 89.9324 36.4346L84.4846 41.8824C85.211 42.6959 85.9664 43.5385 86.7509 44.4101C87.5645 45.2527 88.3489 46.0953 89.1043 46.9379C89.8888 47.7514 90.6297 48.5359 91.327 49.2913C92.0534 50.0467 92.6781 50.7149 93.201 51.296C93.201 51.9352 93.0848 52.5018 92.8524 52.9957C92.6199 53.4896 92.3004 53.9109 91.8936 54.2596C91.5159 54.6082 91.0801 54.8697 90.5861 55.0441C90.0922 55.2184 89.5692 55.3055 89.0172 55.3055C87.8259 55.3055 86.8526 55.015 86.0972 54.4339C85.3418 53.8238 84.6154 53.1119 83.9181 52.2984L77.773 45.151Z"
            fill="white"
          />
          <path
            d="M103.72 54.9133C103.4 54.9714 102.921 55.044 102.281 55.1312C101.671 55.2474 101.047 55.3055 100.407 55.3055C99.7682 55.3055 99.1871 55.262 98.6641 55.1748C98.1702 55.0876 97.7489 54.9133 97.4002 54.6518C97.0516 54.3903 96.7756 54.0417 96.5722 53.6059C96.3979 53.141 96.3107 52.5454 96.3107 51.819V34.0812C96.6303 34.0231 97.0952 33.9504 97.7053 33.8633C98.3445 33.7471 98.9837 33.6889 99.6229 33.6889C100.262 33.6889 100.829 33.7325 101.323 33.8197C101.846 33.9069 102.281 34.0812 102.63 34.3427C102.979 34.6042 103.24 34.9674 103.415 35.4322C103.618 35.868 103.72 36.4492 103.72 37.1755V54.9133Z"
            fill="white"
          />
          <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M116.543 49.2913C116.078 48.9717 115.845 48.4342 115.845 47.6788V41.0979H119.811C120.567 41.0979 121.162 40.88 121.598 40.4442C122.063 39.9793 122.295 39.2384 122.295 38.2215C122.295 37.6404 122.208 37.1174 122.034 36.6525C121.889 36.1586 121.729 35.7518 121.555 35.4322H115.845V17.7856L108.524 24.4759V48.2017C108.524 50.8166 109.206 52.7052 110.572 53.8673C111.966 55.0295 113.942 55.6106 116.499 55.6106C118.591 55.6106 120.044 55.262 120.857 54.5647C121.7 53.8673 122.121 52.9667 122.121 51.8626C122.121 51.3106 122.019 50.8457 121.816 50.468C121.642 50.0612 121.424 49.698 121.162 49.3784C120.814 49.4947 120.407 49.5963 119.942 49.6835C119.477 49.7416 119.027 49.7707 118.591 49.7707C117.719 49.7707 117.037 49.6109 116.543 49.2913ZM115.845 4.64388V3.53014C115.845 2.07741 115.482 1.13313 114.756 0.697313C114.058 0.232438 113.071 0 111.792 0C111.124 0 110.485 0.0581093 109.875 0.174328C109.293 0.261493 108.843 0.348657 108.524 0.435822V3.53014V11.8121L115.845 4.64388Z"
            fill="white"
          />
          <path
            d="M98.3711 30.4697L86.8969 18.9972C86.2075 18.308 86.2075 17.1905 86.8969 16.5012L89.3933 14.0051C90.0826 13.3158 91.2004 13.3158 91.8897 14.0051L99.6193 21.7334L120.156 2.24157C120.845 1.55232 123.207 -0.501265 125.56 1.78677L128.001 4.40167C128.001 4.40167 128.001 4.40167 126.83 5.55256L100.868 30.4697C100.178 31.159 99.0604 31.159 98.3711 30.4697Z"
            fill="#5531E5"
          />
        </svg>
  
        <a href="logout_admin.php">Log out</a>
      </header>

      <!-- Add user popup -->
      <section class="popup-container" id="popup">
        <section class="popup">
          <button class="close-btn" id="close">x</button>
          <div class="popup-content">
                <h1>Add New User</h1>
                <form class="popup-form" action="addUser.php" method="post">
                  <div class="userInputs">
                    <label for="type">Enter user type</label>
                    <select name="type">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                  </div>

                  <div class="userInputs">
                      <label for="name" required>Enter user name</label>
                      <input type="text" name="name"/>
                  </div>

                  <div class="userInputs">
                      <label for="email" required>Enter user e-mail</label>
                      <input type="email" name="email"/>
                  </div>
                  
                  <div class="userInputs">
                      <label for="pass">Enter user password</label>
                      <input type="password" id="pass" name="pass" required />
                  </div>

                  <div id="submit" class="submit_button">
                  <input  class="submit" type="Submit" value="Submit">
                </form>
          </div>
        </section>

      </section>

      <h1>
      <?php
      echo "Welcome ";
      echo $_SESSION['$userNickname'];
      echo "!";
      ?>
      </h1>

    <main>
        <div id="user-management">
            <div id="controls">
                <button id="add-user-btn">+ New User</button>
                <div class="search-container">
                    <form id="search-bar-form" action="" method="POST">
                    <input type="text" id="search-user" name="search_email" placeholder="Search by e-mail">
                    <span class="icon"><svg fill="#FFFFFF" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 50 50" width="20px" height="20px"><path d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z"/></svg></span>
                    </form>
                </div>
                
                <button id="filter-btn">
                    <svg
                      style="padding-top: 3px"
                      xmlns="http://www.w3.org/2000/svg"
                      width="12"
                      height="12"
                      viewBox="0 0 20 18"
                      fill="none"
                    >
                      <path
                        d="M0.916946 2.52429L7.6731 10.3847V16.6154L11.8269 13.8462V10.3847L18.5831 2.52429C18.968 2.0743 18.6447 1.38477 18.0479 1.38477H1.45209C0.855332 1.38477 0.532028 2.0743 0.916946 2.52429Z"
                        stroke="white"
                        stroke-width="1.5"
                        stroke-miterlimit="10"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      /></svg
                    >Filter
                  </button>
            </div>
            
            <?php 
  
            $search_email = '';
            $filter_type = '';

            if(isset($_POST['filter_type']) && ($_POST['filter_type']!="No filtering")){
              $filter_type = $_POST['filter_type'];
              $query = "SELECT Email, NickName, UserType FROM user WHERE UserType LIKE '%" . mysqli_real_escape_string($conn, $filter_type) . "%'";
            }
            elseif (isset($_POST['search_email']) && !empty($_POST['search_email'])) {
                $search_email = $_POST['search_email'];
                $query = "SELECT Email, NickName, UserType FROM user WHERE Email LIKE '%" . mysqli_real_escape_string($conn, $search_email) . "%'";
            } 
            else {
                $query = "SELECT Email, NickName, UserType FROM user";
            }
            $result = mysqli_query($conn, $query);
            ?>
            <table>
                <thead text-align="center">
                    <tr>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                      <?php
                      if(mysqli_num_rows($result) > 0){                  
                      while ($row = mysqli_fetch_assoc($result)) { ?>
                      
                      <tr>
                        <td><?php echo $row['NickName'];?></td>
                        <td><?php echo $row['UserType'];?></td>
                        <td>
                          <div class="actions">
                              <button id="update_userName_btn_<?php echo $row['Email']; ?>" onclick="UpdateName_form('<?php echo $row['Email']; ?>')">Update Username</button>
                              <button id="update_password_btn_<?php echo $row['Email']; ?>" onclick="UpdatePassword_form('<?php echo $row['Email']; ?>')">Update Password</button>
                              <button id="remove_user_btn_<?php echo $row['Email']; ?>" onclick="RemoveUser_form('<?php echo $row['Email']; ?>')">Remove User</button>
                          </div>
                        </td>
                      </tr>

                      <?php
                      }} else { ?>
                      <tr><td colspan="3" style="text-align: center" ><?php echo "No record found"; ?> </tr></tr>
                    <?php
                    }
                      ?>
                    
                </tbody>
                
            </table>

            <!-- Username Popup -->
            <section class="Username-popup-container" id="Username-popup">
                                          <section class="Username-popup">
                                            <button class="close-btn" id="Update-user-name-close">x</button>
                                            <div class="popup-content">
                                                  <h1>Update Username</h1>
                                                  <form class="popup-form" action="UpdateUserName.php" method="post">

                                                    <div class="userInputs">
                                                        <label for="name" required>Enter new username</label>
                                                        <input type="text" name="new-username"/>
                                                    </div>
                                                        <input type="hidden" name="email" id="user-email"/>
                                                    

                                                    <div id="submit" class="submit_button">
                                                    <input  class="submit" type="Submit" value="Submit" >
                                                    </div>
                                                  </form>
                                            </div>
                                          </section>

                                        </section>
            <!-- Password Popup -->
            <section class="Password-popup-container" id="Password-popup">
                                          <section class="Password-popup">
                                            <button class="close-btn" id="Update-password-close">x</button>
                                            <div class="popup-content">
                                                  <h1>Update Password</h1>
                                                  <form class="popup-form" action="UpdatePassword.php" method="post">

                                                    <div class="userInputs">
                                                        <label for="name" required>Enter new password</label>
                                                        <input type="password" name="new-password"/>
                                                    </div>
                                                        <input type="hidden" name="email" id="user-email-password"/>
                                                    

                                                    <div id="submit" class="submit_button">
                                                    <input  class="submit" type="Submit" value="Submit" >
                                                    </div>
                                                  </form>
                                            </div>
                                          </section>

                                        </section>

            <!-- Remove User Popup -->
            <section class="Remove-user-popup-container" id="Remove-user-popup">
                                          <section class="Remove-user-popup">
                                            
                                            <div class="popup-content">
                                                  <h1>Are you sure you want to remove this user?</h1>
                                                  <form class="popup-form" action="RemoveUser.php" method="post">
                                                        <input type="hidden" name="email" id="user-email-remove"/>
                                                    <div class="remove-options">
                                                    <div id="submit" class="submit_button_remove_user">
                                                    <input  class="submit_remove_user" type="Submit" value="Yes" >
                                                    <button type="button" id="Remove-user-close">No</button>
                                                    </div>
                                                    </div>
                                                  </form>
                                            </div>
                                          </section>

                                        </section>
            <!-- Filter Popup -->
            <section class="filter-popup-container" id="filter-popup-container">
                                        <section class="filter-popup-content">
                                            
                                            <form action="" method="POST">
                                                <h2>Choose type:</h2>
                                                <div class="filter-div-content">
                                                <label for="user-type-user">
                                                    <input type="radio" id="user-type-user" name="filter_type" value="User">
                                                    User
                                                </label><br>
                                                <label for="user-type-admin">
                                                    <input type="radio" id="user-type-admin" name="filter_type" value="Admin">
                                                    Admin
                                                </label><br>
                                                <label for="user-type-all">
                                                    <input type="radio" id="user-type-all" name="filter_type" value="No filtering">
                                                    All
                                                </label><br>
                                                </div>
                                                <button type="submit">Apply Filter</button>
                                                
                                            </form>
                                            
                                        </section>
                                    </section>


          
        </div>
        
    </main>
                  <script>
                  if (window.history.replaceState){
                      window.history.replaceState(null, null, window.location.href);
                  }
                  </script>

                  <script src="script.js"></script>
</body>
</html>
