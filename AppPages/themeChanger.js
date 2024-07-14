//changes themes of page to pink, cyan, orange, light or back to purple
//saves info in cookie and loads the cookie file whenever the user re-visits the site

//* cookie functionality
// Function to set a cookie
function setCookie(name, value, days) {
  const d = new Date();
  d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
  const expires = "expires=" + d.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// Function to get a cookie
function getCookie(name) {
  const cname = name + "=";
  const decodedCookie = decodeURIComponent(document.cookie);
  const ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(cname) == 0) {
      return c.substring(cname.length, c.length);
    }
  }
  return "";
}

//* changing theme functionality
// Function to apply theme, changes the values of each var in css to match the theme
function applyTheme(theme) {
  //change to pink
  if (theme === "pink") {
    document.documentElement.style.setProperty("--Primary-color", "#E531C8");
    document.documentElement.style.setProperty(
      "--Light-Purple-Text-Color",
      "#FDAFFF"
    );
    document.documentElement.style.setProperty(
      "--Done-Background-color",
      "#7B1A60"
    );
    document.documentElement.style.setProperty(
      "--Purple-Background-Fill",
      "#2A1622"
    );
  }

  //change to cyan
  else if (theme === "cyan") {
    document.documentElement.style.setProperty("--Primary-color", "#2CB6A5");
    document.documentElement.style.setProperty(
      "--Light-Purple-Text-Color",
      "#AFE7FF"
    );
    document.documentElement.style.setProperty(
      "--Done-Background-color",
      "#1A697B"
    );
    document.documentElement.style.setProperty(
      "--Purple-Background-Fill",
      "#162A25"
    );
  }

  //change to orange
  else if (theme === "orange") {
    document.documentElement.style.setProperty("--Primary-color", "#B67F2C");
    document.documentElement.style.setProperty(
      "--Light-Purple-Text-Color",
      "#FFD6AF"
    );
    document.documentElement.style.setProperty(
      "--Done-Background-color",
      "#784B16"
    );
    document.documentElement.style.setProperty(
      "--Purple-Background-Fill",
      "#2A2316"
    );
  }

  //change to purple
  else if (theme === "purple") {
    document.documentElement.style.setProperty("--Primary-color", "#5531E5");
    document.documentElement.style.setProperty(
      "--Light-Purple-Text-Color",
      "#BFAFFF"
    );
    document.documentElement.style.setProperty(
      "--Done-Background-color",
      "#2D1A7B"
    );
    document.documentElement.style.setProperty(
      "--Purple-Background-Fill",
      "#16172A"
    );
  }
}

//*updating theme for webapp and cookies functionality
//function changes the theme of webapp and updates the cookie
document.addEventListener("DOMContentLoaded", (event) => {
  //applies pre-exsisting theme from cookie if found
  const savedTheme = getCookie("theme");
  if (savedTheme) {
    applyTheme(savedTheme);
  }

  //changes theme and cookie to pink if button is pressed
  const changeToPinkButton = document.getElementsByClassName("changeToPink")[0];
  changeToPinkButton.addEventListener("click", () => {
    setCookie("theme", "pink", 30);
    applyTheme("pink");
    console.log("theme trying to change");
    location.reload();
    console.log("theme changed to pink");
  });

  //changes theme and cookie to cyan
  const changeToCyanButton = document.getElementsByClassName("changeToCyan")[0];
  changeToCyanButton.addEventListener("click", () => {
    setCookie("theme", "cyan", 30);
    applyTheme("cyan");
    location.reload();
  });

  //changes theme and cookie to orange
  const changeToOrangeButton =
    document.getElementsByClassName("changeToOrange")[0];
  changeToOrangeButton.addEventListener("click", () => {
    setCookie("theme", "orange", 30);
    applyTheme("orange");
    location.reload();
  });

  //changes theme and cookie to purple
  const changeToPurpleButton =
    document.getElementsByClassName("changeToPurple")[0];
  changeToPurpleButton.addEventListener("click", () => {
    setCookie("theme", "purple", 30);
    applyTheme("purple");
    location.reload();
  });
});
