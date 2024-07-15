<?php
session_start();
require_once ('../config.php');

$userEmail = $_SESSION['$userEmail'];
$sql = "SELECT * FROM task WHERE Email = ? ORDER BY DueDate DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();

$tasks = [
  'Todo' => [],
  'In-Progress' => [],
  'Done' => []
];

while ($row = $result->fetch_assoc()) {
  $tasks[$row['Status']][] = $row;
}
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="dashboardStyles2.css" />
  <script src="themeChanger.js"></script>
  <script src="dsahboardScript.js"></script>
</head>

<body>
  <header>
    <svg xmlns="http://www.w3.org/2000/svg" width="128" height="56" viewBox="0 0 128 56" fill="none">
      <path
        d="M0.828057 34.6478C0.624675 34.3281 0.43582 33.8923 0.261492 33.3403C0.0871639 32.7882 0 32.2072 0 31.597C0 30.4639 0.246964 29.6503 0.740893 29.1564C1.26388 28.6625 1.93213 28.4155 2.74566 28.4155H21.7474C21.9508 28.7351 22.1396 29.1709 22.314 29.723C22.4883 30.275 22.5755 30.8561 22.5755 31.4663C22.5755 32.5994 22.314 33.4129 21.791 33.9069C21.2971 34.4008 20.6433 34.6478 19.8298 34.6478H14.9922V54.7826C14.6726 54.8697 14.1641 54.9569 13.4668 55.0441C12.7986 55.1312 12.1303 55.1748 11.4621 55.1748C10.7938 55.1748 10.1982 55.1167 9.6752 55.0005C9.18127 54.9133 8.75997 54.739 8.41132 54.4775C8.06266 54.216 7.80117 53.8528 7.62684 53.3879C7.45252 52.9231 7.36535 52.3129 7.36535 51.5575V34.6478H0.828057Z"
        fill="white" />
      <path
        d="M33.4444 50.2501C33.9383 50.2501 34.4758 50.2065 35.0569 50.1193C35.6671 50.0031 36.1174 49.8578 36.408 49.6835V46.197L33.2701 46.4585C32.4565 46.5166 31.7883 46.6909 31.2653 46.9815C30.7423 47.272 30.4808 47.7078 30.4808 48.2889C30.4808 48.87 30.6987 49.3494 31.1345 49.7271C31.5994 50.0758 32.3694 50.2501 33.4444 50.2501ZM33.0957 33.1224C34.6647 33.1224 36.0884 33.2822 37.3668 33.6018C38.6742 33.9214 39.7783 34.4153 40.679 35.0836C41.6087 35.7228 42.3206 36.5508 42.8145 37.5678C43.3084 38.5556 43.5554 39.7323 43.5554 41.0979V50.8602C43.5554 51.6156 43.3375 52.2403 42.9017 52.7342C42.4949 53.1991 42.001 53.6059 41.4199 53.9545C39.5313 55.0876 36.8728 55.6542 33.4444 55.6542C31.9045 55.6542 30.5099 55.5089 29.2605 55.2184C28.0402 54.9278 26.9797 54.492 26.079 53.9109C25.2074 53.3298 24.5246 52.589 24.0307 51.6883C23.5658 50.7876 23.3334 49.7416 23.3334 48.5504C23.3334 46.5456 23.929 45.0057 25.1202 43.9307C26.3115 42.8557 28.1564 42.1874 30.6551 41.926L36.3644 41.3158V41.0107C36.3644 40.1682 35.9867 39.5725 35.2313 39.2239C34.5049 38.8462 33.4444 38.6573 32.0498 38.6573C30.9457 38.6573 29.8707 38.7735 28.8247 39.006C27.7787 39.2384 26.8345 39.5289 25.9919 39.8776C25.6142 39.6161 25.2946 39.2239 25.0331 38.7009C24.7716 38.1489 24.6408 37.5823 24.6408 37.0012C24.6408 36.2458 24.8152 35.6501 25.1638 35.2143C25.5415 34.7494 26.1081 34.3572 26.8635 34.0376C27.7061 33.718 28.694 33.4856 29.8271 33.3403C30.9893 33.195 32.0788 33.1224 33.0957 33.1224Z"
        fill="white" />
      <path
        d="M65.9541 48.6375C65.9541 50.8457 65.1261 52.5744 63.47 53.8238C61.8139 55.0731 59.3733 55.6978 56.1482 55.6978C54.9279 55.6978 53.7948 55.6106 52.7488 55.4363C51.7028 55.262 50.8022 55.0005 50.0467 54.6518C49.3204 54.2741 48.7393 53.8092 48.3035 53.2572C47.8967 52.7052 47.6933 52.0515 47.6933 51.296C47.6933 50.5987 47.8386 50.0176 48.1291 49.5528C48.4197 49.0588 48.7683 48.6521 49.1751 48.3325C50.0177 48.7973 50.9765 49.2186 52.0515 49.5963C53.1556 49.945 54.4195 50.1193 55.8431 50.1193C56.7438 50.1193 57.4266 49.9886 57.8915 49.7271C58.3854 49.4656 58.6324 49.1169 58.6324 48.6811C58.6324 48.2744 58.4581 47.9548 58.1094 47.7223C57.7607 47.4899 57.1796 47.301 56.3661 47.1558L55.0587 46.8943C52.5309 46.4004 50.6424 45.6304 49.393 44.5845C48.1727 43.5094 47.5626 41.9841 47.5626 40.0084C47.5626 38.9333 47.795 37.96 48.2599 37.0883C48.7247 36.2167 49.3785 35.4903 50.2211 34.9092C51.0636 34.3282 52.066 33.8778 53.2282 33.5582C54.4195 33.2386 55.7269 33.0788 57.1506 33.0788C58.2256 33.0788 59.228 33.166 60.1578 33.3403C61.1166 33.4856 61.9446 33.718 62.6419 34.0376C63.3392 34.3572 63.8913 34.7785 64.298 35.3015C64.7048 35.7954 64.9082 36.391 64.9082 37.0883C64.9082 37.7566 64.7774 38.3377 64.5159 38.8316C64.2835 39.2965 63.9784 39.6888 63.6007 40.0084C63.3683 39.8631 63.0196 39.7178 62.5548 39.5725C62.0899 39.3982 61.5814 39.2529 61.0294 39.1367C60.4774 38.9914 59.9108 38.8752 59.3297 38.7881C58.7777 38.7009 58.2692 38.6573 57.8043 38.6573C56.8455 38.6573 56.1046 38.7735 55.5816 39.006C55.0587 39.2093 54.7972 39.5435 54.7972 40.0084C54.7972 40.328 54.9424 40.5894 55.233 40.7928C55.5235 40.9962 56.0756 41.1851 56.8891 41.3594L58.2401 41.6645C61.0294 42.3037 63.0051 43.1898 64.1673 44.323C65.3585 45.427 65.9541 46.8652 65.9541 48.6375Z"
        fill="white" />
      <path
        d="M77.773 45.151V54.7826C77.4534 54.8697 76.945 54.9569 76.2477 55.0441C75.5504 55.1312 74.8676 55.1748 74.1993 55.1748C73.5311 55.1748 72.9354 55.1167 72.4125 55.0005C71.9185 54.9133 71.4972 54.739 71.1486 54.4775C70.7999 54.216 70.5384 53.8528 70.3641 53.3879C70.1898 52.9231 70.1026 52.3129 70.1026 51.5575V28.5463C70.4222 28.4882 70.9307 28.4155 71.628 28.3284C72.3253 28.2121 72.9935 28.154 73.6327 28.154C74.301 28.154 74.8821 28.2121 75.376 28.3284C75.899 28.4155 76.3348 28.5898 76.6835 28.8513C77.0321 29.1128 77.2936 29.476 77.468 29.9409C77.6423 30.4058 77.7294 31.0159 77.7294 31.7713V38.7009L86.7945 28.2848C88.7702 28.2848 90.1794 28.6625 91.0219 29.4179C91.8936 30.1443 92.3294 31.0159 92.3294 32.0328C92.3294 32.7883 92.1406 33.5001 91.7628 34.1683C91.3851 34.8366 90.775 35.592 89.9324 36.4346L84.4846 41.8824C85.211 42.6959 85.9664 43.5385 86.7509 44.4101C87.5645 45.2527 88.3489 46.0953 89.1043 46.9379C89.8888 47.7514 90.6297 48.5359 91.327 49.2913C92.0534 50.0467 92.6781 50.7149 93.201 51.296C93.201 51.9352 93.0848 52.5018 92.8524 52.9957C92.6199 53.4896 92.3004 53.9109 91.8936 54.2596C91.5159 54.6082 91.0801 54.8697 90.5861 55.0441C90.0922 55.2184 89.5692 55.3055 89.0172 55.3055C87.8259 55.3055 86.8526 55.015 86.0972 54.4339C85.3418 53.8238 84.6154 53.1119 83.9181 52.2984L77.773 45.151Z"
        fill="white" />
      <path
        d="M103.72 54.9133C103.4 54.9714 102.921 55.044 102.281 55.1312C101.671 55.2474 101.047 55.3055 100.407 55.3055C99.7682 55.3055 99.1871 55.262 98.6641 55.1748C98.1702 55.0876 97.7489 54.9133 97.4002 54.6518C97.0516 54.3903 96.7756 54.0417 96.5722 53.6059C96.3979 53.141 96.3107 52.5454 96.3107 51.819V34.0812C96.6303 34.0231 97.0952 33.9504 97.7053 33.8633C98.3445 33.7471 98.9837 33.6889 99.6229 33.6889C100.262 33.6889 100.829 33.7325 101.323 33.8197C101.846 33.9069 102.281 34.0812 102.63 34.3427C102.979 34.6042 103.24 34.9674 103.415 35.4322C103.618 35.868 103.72 36.4492 103.72 37.1755V54.9133Z"
        fill="white" />
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M116.543 49.2913C116.078 48.9717 115.845 48.4342 115.845 47.6788V41.0979H119.811C120.567 41.0979 121.162 40.88 121.598 40.4442C122.063 39.9793 122.295 39.2384 122.295 38.2215C122.295 37.6404 122.208 37.1174 122.034 36.6525C121.889 36.1586 121.729 35.7518 121.555 35.4322H115.845V17.7856L108.524 24.4759V48.2017C108.524 50.8166 109.206 52.7052 110.572 53.8673C111.966 55.0295 113.942 55.6106 116.499 55.6106C118.591 55.6106 120.044 55.262 120.857 54.5647C121.7 53.8673 122.121 52.9667 122.121 51.8626C122.121 51.3106 122.019 50.8457 121.816 50.468C121.642 50.0612 121.424 49.698 121.162 49.3784C120.814 49.4947 120.407 49.5963 119.942 49.6835C119.477 49.7416 119.027 49.7707 118.591 49.7707C117.719 49.7707 117.037 49.6109 116.543 49.2913ZM115.845 4.64388V3.53014C115.845 2.07741 115.482 1.13313 114.756 0.697313C114.058 0.232438 113.071 0 111.792 0C111.124 0 110.485 0.0581093 109.875 0.174328C109.293 0.261493 108.843 0.348657 108.524 0.435822V3.53014V11.8121L115.845 4.64388Z"
        fill="white" />
      <path
        d="M98.3711 30.4697L86.8969 18.9972C86.2075 18.308 86.2075 17.1905 86.8969 16.5012L89.3933 14.0051C90.0826 13.3158 91.2004 13.3158 91.8897 14.0051L99.6193 21.7334L120.156 2.24157C120.845 1.55232 123.207 -0.501265 125.56 1.78677L128.001 4.40167C128.001 4.40167 128.001 4.40167 126.83 5.55256L100.868 30.4697C100.178 31.159 99.0604 31.159 98.3711 30.4697Z"
        fill="#5531E5" />
    </svg>
    <form id="themeButtonContainer">
      <button type="button" style="width: 30px; height: 30px" class="theme-button changeToPink"></button>
      <button type="button" style="width: 30px; height: 30px" class="theme-button changeToCyan"></button>
      <button type="button" style="width: 30px; height: 30px" class="theme-button changeToOrange"></button>
      <button type="button" style="width: 30px; height: 30px" class="theme-button changeToPurple"></button>
    </form>


    <div>
      <a href="alltasks.php">All Tasks</a>
      <a style="margin-left: 20px;" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="45" height="46"
          viewBox="0 0 45 46" fill="none">
          <g clip-path="url(#clip0_274_53)">
            <path
              d="M35.3979 25.6614H14.0625C13.3166 25.6614 12.6012 25.3651 12.0738 24.8377C11.5463 24.3102 11.25 23.5948 11.25 22.8489C11.25 22.103 11.5463 21.3876 12.0738 20.8602C12.6012 20.3327 13.3166 20.0364 14.0625 20.0364H35.3979L31.7615 16.4C31.2365 15.8721 30.9423 15.1575 30.9433 14.413C30.9444 13.6686 31.2406 12.9549 31.767 12.4284C32.2934 11.902 33.0071 11.6058 33.7516 11.6047C34.4961 11.6037 35.2106 11.8979 35.7385 12.4229L44.176 20.8604C44.4373 21.1215 44.6445 21.4315 44.7859 21.7727C44.9272 22.1139 45 22.4796 45 22.8489C45 23.2183 44.9272 23.584 44.7859 23.9252C44.6445 24.2664 44.4373 24.5764 44.176 24.8375L35.7385 33.275C35.4777 33.5373 35.1676 33.7456 34.8261 33.8879C34.4846 34.0301 34.1183 34.1037 33.7484 34.1042C33.3784 34.1047 33.012 34.0322 32.6701 33.8909C32.3282 33.7495 32.0175 33.5421 31.7559 33.2805C31.4943 33.0189 31.2869 32.7082 31.1456 32.3663C31.0042 32.0244 30.9317 31.658 30.9323 31.288C30.9328 30.9181 31.0063 30.5519 31.1486 30.2103C31.2909 29.8688 31.4991 29.5588 31.7615 29.2979L35.3979 25.6614Z"
              fill="white" />
            <path
              d="M2.8125 0.348877H25.3125C25.6819 0.348668 26.0477 0.421272 26.389 0.56254C26.7304 0.703807 27.0405 0.910966 27.3017 1.17217C27.5629 1.43338 27.7701 1.74351 27.9113 2.08483C28.0526 2.42616 28.1252 2.79198 28.125 3.16138V8.78638C28.125 9.5323 27.8287 10.2477 27.3012 10.7751C26.7738 11.3026 26.0584 11.5989 25.3125 11.5989C24.5666 11.5989 23.8512 11.3026 23.3238 10.7751C22.7963 10.2477 22.5 9.5323 22.5 8.78638V5.97388H5.625V39.7239H22.5V36.9114C22.5 36.1655 22.7963 35.4501 23.3238 34.9226C23.8512 34.3952 24.5666 34.0989 25.3125 34.0989C26.0584 34.0989 26.7738 34.3952 27.3012 34.9226C27.8287 35.4501 28.125 36.1655 28.125 36.9114V42.5364C28.1252 42.9058 28.0526 43.2716 27.9113 43.6129C27.7701 43.9542 27.5629 44.2644 27.3017 44.5256C27.0405 44.7868 26.7304 44.9939 26.389 45.1352C26.0477 45.2765 25.6819 45.3491 25.3125 45.3489H2.8125C2.4431 45.3491 2.07728 45.2765 1.73595 45.1352C1.39463 44.9939 1.0845 44.7868 0.823295 44.5256C0.562089 44.2644 0.354928 43.9542 0.213661 43.6129C0.0723941 43.2716 -0.000209506 42.9058 0 42.5364V3.16138C-0.000209506 2.79198 0.0723941 2.42616 0.213661 2.08483C0.354928 1.74351 0.562089 1.43338 0.823295 1.17217C1.0845 0.910966 1.39463 0.703807 1.73595 0.56254C2.07728 0.421272 2.4431 0.348668 2.8125 0.348877Z"
              fill="white" />
          </g>
          <defs>
            <clipPath id="clip0_274_53">
              <rect width="45" height="45" fill="white" transform="matrix(-1 0 0 1 45 0.348877)" />
            </clipPath>
          </defs>
        </svg></a>
    </div>


  </header>

  <h1>
    <?php
    echo "Welcome ";
    echo $_SESSION['$userNickname'];
    echo "!";
    ?>
  </h1>


  <div class="boxedDiv">
    <div class="space-evenly-items">
      <button style="width: 50%" onclick="openPopup()">
        + Add a new task
      </button>
      <div class="dropdown">
        <button class="dropbtn"> <svg style="padding-top: 5px" width="23" height="14" viewBox="0 0 23 14" fill="none">
            <path
              d="M13.0278 13.5H10.4722C10.104 13.5 9.80556 13.2015 9.80556 12.8333C9.80556 12.4651 10.104 12.1667 10.4722 12.1667H13.0278C13.396 12.1667 13.6944 12.4651 13.6944 12.8333C13.6944 13.2015 13.396 13.5 13.0278 13.5ZM21.5833 1.83333H1.91667C1.54848 1.83333 1.25 1.53486 1.25 1.16667C1.25 0.798476 1.54848 0.5 1.91667 0.5H21.5833C21.9515 0.5 22.25 0.798477 22.25 1.16667C22.25 1.53486 21.9515 1.83333 21.5833 1.83333ZM17.9167 7.66667H5.58333C5.21514 7.66667 4.91667 7.36819 4.91667 7C4.91667 6.63181 5.21514 6.33333 5.58333 6.33333H17.9167C18.2849 6.33333 18.5833 6.63181 18.5833 7C18.5833 7.36819 18.2849 7.66667 17.9167 7.66667Z"
              fill="white" stroke="white" />
          </svg>Sort
        </button>
        <div class="dropdown-content">
          <a href="dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="13" viewBox="0 0 11 13"
              fill="none">
              <path
                d="M10.1578 8.96221L6.32497 12.6675C6.11325 12.8892 5.82488 13 5.5073 13C5.18972 13 4.905 12.8892 4.68963 12.6675L0.842216 8.96221C0.385928 8.52259 0.385928 7.80591 0.842216 7.3663C1.2985 6.92668 2.03586 6.92668 2.49215 7.3663L4.3319 9.14692V1.13043C4.3319 0.50611 4.8539 0 5.5 0C6.1461 0 6.6681 0.50611 6.6681 1.13043V9.14692L8.50785 7.3663C8.96414 6.92668 9.7015 6.92668 10.1578 7.3663C10.6141 7.80591 10.6141 8.5189 10.1578 8.96221Z"
                fill="white" />
            </svg>Date</a>
          <a href="dashboardDateAsc.php"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="13"
              viewBox="0 0 11 13" fill="none">
              <path
                d="M0.842216 4.03779L4.67503 0.332481C4.88675 0.110827 5.17512 0 5.4927 0C5.81028 0 6.095 0.110827 6.31037 0.332481L10.1578 4.03779C10.6141 4.47741 10.6141 5.19409 10.1578 5.6337C9.7015 6.07332 8.96414 6.07332 8.50785 5.6337L6.6681 3.85308L6.6681 11.8696C6.6681 12.4939 6.1461 13 5.5 13C4.8539 13 4.3319 12.4939 4.3319 11.8696L4.3319 3.85308L2.49215 5.6337C2.03586 6.07332 1.2985 6.07332 0.842216 5.6337C0.385928 5.19409 0.385928 4.4811 0.842216 4.03779Z"
                fill="white" />
            </svg>Date</a>
          <a href="dashboardPriorityDesc.php"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="13"
              viewBox="0 0 11 13" fill="none">
              <path
                d="M10.1578 8.96221L6.32497 12.6675C6.11325 12.8892 5.82488 13 5.5073 13C5.18972 13 4.905 12.8892 4.68963 12.6675L0.842216 8.96221C0.385928 8.52259 0.385928 7.80591 0.842216 7.3663C1.2985 6.92668 2.03586 6.92668 2.49215 7.3663L4.3319 9.14692V1.13043C4.3319 0.50611 4.8539 0 5.5 0C6.1461 0 6.6681 0.50611 6.6681 1.13043V9.14692L8.50785 7.3663C8.96414 6.92668 9.7015 6.92668 10.1578 7.3663C10.6141 7.80591 10.6141 8.5189 10.1578 8.96221Z"
                fill="white" />
            </svg>Priority</a>
          <a href="dashboardPriorityAsc.php"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="13"
              viewBox="0 0 11 13" fill="none">
              <path
                d="M0.842216 4.03779L4.67503 0.332481C4.88675 0.110827 5.17512 0 5.4927 0C5.81028 0 6.095 0.110827 6.31037 0.332481L10.1578 4.03779C10.6141 4.47741 10.6141 5.19409 10.1578 5.6337C9.7015 6.07332 8.96414 6.07332 8.50785 5.6337L6.6681 3.85308L6.6681 11.8696C6.6681 12.4939 6.1461 13 5.5 13C4.8539 13 4.3319 12.4939 4.3319 11.8696L4.3319 3.85308L2.49215 5.6337C2.03586 6.07332 1.2985 6.07332 0.842216 5.6337C0.385928 5.19409 0.385928 4.4811 0.842216 4.03779Z"
                fill="white" />
            </svg>Priority</a>

        </div>
      </div>
    </div>
    <div id="kanbanboardContainer">
      <?php
      $columns = ['Todo' => 'Todo', 'In-Progress' => 'In Progress', 'Done' => 'Done'];
      foreach ($columns as $status => $title):
        ?>
        <div class="kanbanBoardColumn <?php echo strtolower(str_replace(' ', '', $title)); ?>Column" ondrop="drop(event)"
          ondragover="allowDrop(event)" data-status="<?php echo $status; ?>">
          <p class="kanbanColumnHeading"><?php echo $title; ?></p>
          <?php foreach ($tasks[$status] as $task): ?>
            <div class="taskItem" draggable="true" ondragstart="drag(event)" id="task-<?php echo $task['TaskID']; ?>"
              onclick="openUpdatePopup(<?php echo $task['TaskID']; ?>)" data-task-id="<?php echo $task['TaskID']; ?>">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="41" viewBox="0 0 20 41" fill="none">
                <path
                  d="M0 2C0 0.895431 0.895431 0 2 0H18C19.1046 0 20 0.89543 20 2V39C20 40.1046 19.1046 41 18 41H2C0.895431 41 0 40.1046 0 39V2Z"
                  fill="#5531E5" />
              </svg>
              <div class="taskDetialsContainer">
                <p class="taskTitle"><?php echo htmlspecialchars($task['TaskTitle']); ?></p>
                <div>
                  <p class="taskDetail" style="border-right: 1px solid">
                    <?php echo date('Y/m/d', strtotime($task['DueDate'])); ?>
                  </p>
                  <p class="taskDetail" style="border-right: 1px solid">
                    <?php echo $task['Priority']; ?>
                  </p>
                  <p class="taskDetail">
                    <?php
                    $categoryId = $task['CategoryID'];
                    $categoryName = "N/A";
                    if ($categoryId) {
                      $catStmt = $conn->prepare("SELECT CategoryName FROM category WHERE CategoryID = ?");
                      $catStmt->bind_param("i", $categoryId);
                      $catStmt->execute();
                      $catResult = $catStmt->get_result();
                      if ($catRow = $catResult->fetch_assoc()) {
                        $categoryName = $catRow['CategoryName'];
                      }
                      $catStmt->close();
                    }
                    echo htmlspecialchars($categoryName);
                    ?>
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div id="overlay" class="overlay">
    <div class="popup">
      <div class="TaskContainer">
        <form id="addtask" action="addTask.php" method="post">
          <div class="title-row">
            <input type="text" id="taskTitle" placeholder="Task Title Goes Here" name="TaskTitle" required>
          </div>

          <div class="form-row1">
            <div class="date">
              <label for="task-date"><img src="../media/Calendaricon.svg" alt="Calender"></label>
              <input required type="date" id="task-date" name="DueDate">
            </div>

            <div class="priority">
              <label for="task-priority"><img src="../media/priorityIcon.svg" alt="Priority"></label>
              <select required id="task-priority" name="Priority">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
            </div>
          </div>

          <div class="form-row2">
            <div class="category">
              <label for="task-category"><img src="../media/categoryIcon.svg" alt="Category"></label>
              <input list="category-options" id="categories" name="Category">
              <datalist id="category-options">
              </datalist>
            </div>

            <div class="status">
              <label for="task-status"><img src="../media/statusIcon.svg" alt="Status"></label>
              <select required id="task-status" name="Status" placeholder="Status">
                <option value="Todo">Todo</option>
                <option value="In-Progress">In Progress</option>
                <option value="Done">Done</option>
              </select>
              </select>
            </div>
          </div>
          <div class="notes-row">
            <label for="task-desc"><img src="../media/descriptionIcon.svg" alt="desc"></label>
            <textarea id="task-desc" name="taskDescription" placeholder="Description"></textarea>
          </div>

          <div class="add-button">
            <button class="button" type="submit"> Add Task </button>
          </div>

        </form>

      </div>
    </div>
  </div>

  <div id="updateOverlay" class="overlay" onclick="closePopup(event)">
    <div class="popup">
      <div class="TaskContainer">
        <form id="updatetask" action="updateTask.php" method="post">
          <input type="hidden" id="updateTaskId" name="updateTaskId" value="">
          <div class="title-row">
            <input type="text" id="updateTaskTitle" name="updateTaskTitle" required>
            <button class="delete-task-button" type="button" onclick="deleteTask()"><img
                src="../media/deleteIcon.svg"></button>
          </div>

          <div class="form-row1">
            <div class="date">
              <label for="update-task-date"><img src="../media/Calendaricon.svg" alt="Calender"></label>
              <input required type="date" id="update-task-date" name="update-task-date">
            </div>

            <div class="priority">
              <label for="update-task-priority"><img src="../media/priorityIcon.svg" alt="Priority"></label>
              <select required id="update-task-priority" name="update-task-priority">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
              </select>
            </div>
          </div>

          <div class="form-row2">
            <div class="category">
              <label for="update-task-category"><img src="../media/categoryIcon.svg" alt="Category"></label>
              <input list="category-options" id="update-categories" name="update-categories">
              <datalist id="category-options">
              </datalist>
            </div>

            <div class="status">
              <label for="update-task-status"><img src="../media/statusIcon.svg" alt="Status"></label>
              <select required id="update-task-status" name="update-task-status" placeholder="Status">
                <option value="Todo">Todo</option>
                <option value="In-Progress">In Progress</option>
                <option value="Done">Done</option>
              </select>
              </select>
            </div>
          </div>
          <div class="notes-row">
            <label for="update-task-desc"><img src="../media/descriptionIcon.svg" alt="desc"></label>
            <textarea id="update-task-desc" name="update-task-desc" placeholder="Description"></textarea>
          </div>

          <div class="add-button">
            <button class="button" type="submit"> Submit Task </button>
          </div>

        </form>

      </div>
    </div>
  </div>

</body>

</html>