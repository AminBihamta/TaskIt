document.addEventListener('DOMContentLoaded', function() {
  // Logic for Add user popup
  const close = document.getElementById("close");
  const open = document.getElementById("add-user-btn");
  const popup = document.getElementById("popup");

  open.addEventListener("click", () => popup.classList.add("show-popup"));
  close.addEventListener("click", () => popup.classList.remove("show-popup"));
  window.addEventListener('click', e => {
      e.target === popup ? popup.classList.remove("show-popup") : false;
  });

  // Logic for Update username popup
  function closeUpdateNamePopup() {
      document.getElementById('Username-popup').style.display = 'none';
  }

  const close_Update_UserName = document.getElementById("Update-user-name-close");
  close_Update_UserName.addEventListener("click", closeUpdateNamePopup);

  function UpdateName_form(email) {
      document.getElementById('Username-popup').style.display = 'block';
      document.getElementById('user-email').value = email;
  }

  const popup_Update_UserName = document.getElementById("Username-popup");
  window.addEventListener('click', e => {
      e.target === popup_Update_UserName ? closeUpdateNamePopup() : false;
  });

  // Logic for Update password popup
  function closeUpdatePasswordPopup() {
      document.getElementById('Password-popup').style.display = 'none';
  }

  const close_Update_Password = document.getElementById('Update-password-close');
  close_Update_Password.addEventListener('click', closeUpdatePasswordPopup);

  function UpdatePassword_form(email) {
      document.getElementById('Password-popup').style.display = 'block';
      document.getElementById('user-email-password').value = email;
  }

  const popup_Update_Password = document.getElementById("Password-popup");
  window.addEventListener('click', e => {
      e.target === popup_Update_Password ? closeUpdatePasswordPopup() : false;
  });

  // Logic for Remove user popup
  function closeRemoveUserPopup() {
      document.getElementById('Remove-user-popup').style.display = 'none';
  }

  const close_Remove_User = document.getElementById('Remove-user-close');
  close_Remove_User.addEventListener('click', closeRemoveUserPopup);

  function RemoveUser_form(email) {
      document.getElementById('Remove-user-popup').style.display = 'block';
      document.getElementById('user-email-remove').value = email;
  }

  const popup_Remove_User = document.getElementById("Remove-user-popup");
  window.addEventListener('click', e => {
      e.target === popup_Remove_User ? closeRemoveUserPopup() : false;
  });

  //Logic for Filter popup
  function closeFilterPopup(){
    document.getElementById('filter-popup-container').style.display = 'none';
  }

  const filterPopupContainer = document.getElementById('filter-popup-container');
  
  const filterBtn = document.getElementById('filter-btn');
  filterBtn.addEventListener('click', () => filterPopupContainer.style.display = 'block');

  const filter_popup = document.getElementById('filter-popup-container');
  window.addEventListener('click', e => {
    e.target === filter_popup ? closeFilterPopup() : false;
});


  // Make the functions globally accessible
  window.UpdateName_form = UpdateName_form;
  window.UpdatePassword_form = UpdatePassword_form;
  window.RemoveUser_form = RemoveUser_form;
});


