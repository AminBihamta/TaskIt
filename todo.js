document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("todo-form");
    const input = document.getElementById("todo-input");
    const todoLane = document.getElementById("todo-lane");
    const editModal = document.getElementById("edit-task-modal");
    const editTitle = document.getElementById("edit-task-title");
    const editDate = document.getElementById("edit-task-date");
    const editPriority = document.getElementById("edit-task-priority");
    const editNotes = document.getElementById("edit-task-notes");
    const saveTaskBtn = document.getElementById("save-task-btn");
    let currentTask = null;
  
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const value = input.value;
      if (!value) return;
  
      addTask(value, todoLane);
      input.value = "";
    });
  
    const addTask = (value, lane) => {
      const taskContainer = document.createElement("div");
      taskContainer.classList.add("task-container");
  
      const newTask = document.createElement("p");
      newTask.classList.add("task");
      newTask.setAttribute("draggable", "true");
      newTask.innerText = value;
  
      taskContainer.appendChild(newTask);
      lane.appendChild(taskContainer);
  
      newTask.addEventListener("dragstart", () => {
        newTask.classList.add("is-dragging");
      });
  
      newTask.addEventListener("dragend", () => {
        newTask.classList.remove("is-dragging");
      });
  
      newTask.addEventListener("click", () => {
        currentTask = newTask;
        openEditModal(newTask.innerText);
      });
    };
  
    const openEditModal = (taskTitle) => {
      editTitle.value = taskTitle;
      editDate.value = "";
      editPriority.value = "low";
      editNotes.value = "";
      editModal.style.display = "block";
    };
  
    saveTaskBtn.addEventListener("click", () => {
      if (currentTask) {
        currentTask.innerText = editTitle.value;
      }
      editModal.style.display = "none";
    });
  
    window.addEventListener("click", (e) => {
      if (e.target === editModal) {
        editModal.style.display = "none";
      }
    });
  });
  