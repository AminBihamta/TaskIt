function reloadPage() {
  location.reload();
}

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById("addtask").addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the form from submitting the traditional way

      const formData = new FormData(this);

      fetch("addTask.php", {
          method: "POST",
          body: formData,
          credentials: "same-origin" // This line is important for maintaining the session
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert("Task added successfully");
              closePopup("overlay");
              document.getElementById("addtask").reset();
          } else {
              alert("Failed to add task: " + data.message);
          }
      })
      .catch(error => {
          alert("An error occurred: " + error.message);
      });
  });

  document.getElementById("updatetask").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    const formData = new FormData(this);

    const updatedData = Object.fromEntries(formData.entries());

    // Check if any changes were made
    const hasChanges = Object.keys(updatedData).some(key => {
        return updatedData[key] !== originalTaskData[key];
    });

    if (!hasChanges) {
        // No changes were made, just close the overlay
        closeUpdatePopup();
        return;
    }

    fetch("updateTask.php", {
        method: "POST",
        body: formData,
        credentials: "same-origin" // This line is important for maintaining the session
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeUpdate();
            location.reload(); // Reload the page to show updated task
        } else {
            alert("No Updates Made: " + data.message);
            closeUpdate();
        }
    })
    .catch(error => {
        alert("An error occurred: " + error.message);
    });
  });
  document.getElementById("updateOverlay").addEventListener("click", function(event) {
    closeUpdatePopup(event);
  });


});

function openPopup() {
  document.getElementById("overlay").style.display = "flex";
}

function closePopup(id) {
  document.getElementById("overlay").style.display = "none";
}

function allowDrop(ev) {
  ev.preventDefault();
}

function drag(ev) {
  ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
  ev.preventDefault();
  var taskId = ev.dataTransfer.getData("text");
  var taskElement = document.getElementById(taskId);
  var newStatus = ev.target.closest(".kanbanBoardColumn").dataset.status;

  // Move the task visually
  ev.target.closest(".kanbanBoardColumn").appendChild(taskElement);

  // Update the database
  updateTaskStatus(taskId.split("-")[1], newStatus);
}

function updateTaskStatus(taskId, newStatus) {
  fetch("update_task_status.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: "taskId=" + taskId + "&newStatus=" + newStatus,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log("Task status updated successfully");
      } else {
        console.error("Failed to update task status");
        // You might want to move the task back or show an error message
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });

  setTimeout(reloadPage, 100);
}



function openUpdatePopup(taskId) {
  fetch(`getTaskDetails.php?taskId=${taskId}`)
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        populateUpdateForm(data.task);
        document.getElementById("updateOverlay").style.display = "flex";
      } else {
        alert("Failed to fetch task details: " + data.message);
      }
    })
    .catch(error => {
      alert("An error occurred: " + error.message);
    });
}

let originalTaskData = {};

function populateUpdateForm(task) {

  originalTaskData = {...task }; // Make a copy of the task data for comparison purposes

  let missingFields = [];
  const fields = [
    {id: "updateTaskId", key: "TaskID"},
    { id: "updateTaskTitle", key: "TaskTitle" },
    { id: "update-task-date", key: "DueDate" },
    { id: "update-task-priority", key: "Priority" },
    { id: "update-task-status", key: "Status" },
    { id: "update-task-desc", key: "TaskDescription" },
    { id: "update-categories", key: "CategoryName" }
  ];



  fields.forEach(field => {
    const element = document.getElementById(field.id);
    if (element) {
      element.value = task[field.key] || '';
    } else {
      missingFields.push(field.id);
    }
  });

  if (missingFields.length > 0) {
    alert("The following fields are missing: " + missingFields.join(", "));
  }
}

function closeUpdatePopup(event) {
  if (event.target == document.getElementById("updateOverlay")) {
    document.getElementById("updateOverlay").style.display = "none";
  }
}

function closeUpdate() {
  document.getElementById("updateOverlay").style.display = "none";
}

// Function to delete a task
function deleteTask(taskId) {
  if (confirm("Are you sure you want to delete this task?")) {
      fetch("deleteTask.php", {
          method: "POST",
          headers: {
              "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `taskId=${taskId}`,
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              alert(data.message);
              closeUpdatePopup();
              location.reload(); // Reload the page to reflect the deletion
          } else {
              alert("Error deleting task: " + data.message);
          }
      })
      .catch(error => {
          alert("An error occurred: " + error.message);
      });
  }
}

// Function to close the delete popup
function closeDeletePopup() {
  document.getElementById("deleteOverlay").style.display = "none";
}

// Assuming you have a button with class 'delete-task-button' for deleting tasks
document.querySelectorAll('.delete-task-button').forEach(button => {
  button.addEventListener('click', function() {
      const taskId = this.dataset.taskId; // Assuming the button has a data attribute for taskId
      deleteTask(taskId);
  });
});

