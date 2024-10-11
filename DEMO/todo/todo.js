// Add a new task to the list
function addTask() {
    const taskInput = document.getElementById('new-task');
    const taskText = taskInput.value.trim();

    if (taskText !== '') {
        const taskList = document.getElementById('task-list');
        const li = document.createElement('li');
        const span = document.createElement('span');
        span.textContent = taskText;

        // Create Edit button
        const editButton = document.createElement('button');
        editButton.textContent = 'Edit';
        editButton.className = 'edit';
        editButton.onclick = function () {
            const newTaskText = prompt('Edit task:', span.textContent);
            if (newTaskText && newTaskText.trim() !== '') {
                span.textContent = newTaskText.trim();
            }
        };

        // Create Delete button
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.onclick = function () {
            taskList.removeChild(li);
        };

        // Append elements to task
        li.appendChild(span);
        li.appendChild(editButton);
        li.appendChild(deleteButton);
        taskList.appendChild(li);

        // Clear the input field
        taskInput.value = '';
    }
}
