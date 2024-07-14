document.addEventListener("DOMContentLoaded", () => {
    const addTaskBtn = document.getElementById("add-task-btn");
    const addTaskModal = document.getElementById("add-task-modal");
    const addTaskSaveBtn = document.getElementById("add-task-save-btn");
    const newTaskTitle = document.getElementById("new-task-title");
    const newTaskDate = document.getElementById("new-task-date");
    const newTaskPriority = document.getElementById("new-task-priority");
    const newTaskNotes = document.getElementById("new-task-notes");
    const todoLane = document.getElementById("todo-lane");

    const editTaskModal = document.getElementById("edit-task-modal");
    const editTitle = document.getElementById("edit-task-title");
    const editDate = document.getElementById("edit-task-date");
    const editPriority = document.getElementById("edit-task-priority");
    const editCategory = document.getElementById("edit-task-category");
    const editNotes = document.getElementById("edit-task-notes");
    const saveTaskBtn = document.getElementById("save-task-btn");
    const deleteTaskBtn = document.getElementById("delete-task-btn");
    let currentTask = null;

    addTaskBtn.addEventListener("click", () => {
        addTaskModal.style.display = "block";
    });

    addTaskSaveBtn.addEventListener("click", () => {
        const title = newTaskTitle.value;
        if (!title) return;

        const taskContainer = document.createElement("div");
        taskContainer.classList.add("task-container");

        const newTask = document.createElement("p");
        newTask.classList.add("task");
        newTask.setAttribute("draggable", "true");
        newTask.innerText = title;

        taskContainer.appendChild(newTask);
        todoLane.appendChild(taskContainer);

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

        addTaskModal.style.display = "none";
        newTaskTitle.value = "";
        newTaskDate.value = "";
        newTaskPriority.value = "low";
        newTaskNotes.value = "";
    });

    window.addEventListener("click", (e) => {
        if (e.target === addTaskModal) {
            addTaskModal.style.display = "none";
        }
        if (e.target === editTaskModal) {
            editTaskModal.style.display = "none";
        }
    });

    const openEditModal = (taskTitle) => {
        editTitle.value = taskTitle;
        editDate.value = "";
        editPriority.value = "low";
        editCategory.value = "chores";
        editNotes.value = "";
        editTaskModal.style.display = "block";
    };

    saveTaskBtn.addEventListener("click", () => {
        if (currentTask) {
            currentTask.innerText = editTitle.value;
        }
        editTaskModal.style.display = "none";
    });

    deleteTaskBtn.addEventListener("click", () => {
        if (currentTask) {
            currentTask.parentElement.remove();
        }
        editTaskModal.style.display = "none";
    });

    const draggables = document.querySelectorAll(".task");
    const droppables = document.querySelectorAll(".swim-lane");

    draggables.forEach((task) => {
        task.addEventListener("dragstart", () => {
            task.classList.add("is-dragging");
        });
        task.addEventListener("dragend", () => {
            task.classList.remove("is-dragging");
        });
    });

    droppables.forEach((zone) => {
        zone.addEventListener("dragover", (e) => {
            e.preventDefault();
            const bottomTask = insertAboveTask(zone, e.clientY);
            const curTask = document.querySelector(".is-dragging");
            if (!bottomTask) {
                zone.appendChild(curTask);
            } else {
                zone.insertBefore(curTask, bottomTask);
            }
        });
    });

    const insertAboveTask = (zone, mouseY) => {
        const els = zone.querySelectorAll(".task:not(.is-dragging)");
        let closestTask = null;
        let closestOffset = Number.NEGATIVE_INFINITY;
        els.forEach((task) => {
            const { top } = task.getBoundingClientRect();
            const offset = mouseY - top;
            if (offset < 0 && offset > closestOffset) {
                closestOffset = offset;
                closestTask = task;
            }
        });
        return closestTask;
    };
});
