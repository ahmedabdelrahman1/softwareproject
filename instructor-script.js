document.addEventListener('DOMContentLoaded', function () {
    // Prompt for a password to access the instructor page
    const password = prompt('Please enter the instructor password:');

    // Check if the password is correct
    if (password !== '1234') {
        alert('Access denied. Incorrect password.');
        // Redirect to the home page or some other page
        window.location.href = 'index.html';
    } else {
        const courseList = document.getElementById('course-list');

        // Retrieve the courses from localStorage or initialize an empty array
        let courses = JSON.parse(localStorage.getItem('courses')) || [];

        // Function to display courses in the course list
        function displayCourses() {
            courseList.innerHTML = ''; // Clear the list

            courses.forEach((course, index) => {
                const courseItem = document.createElement('li');
                courseItem.textContent = `Course: ${course.name} - Cost: $${course.cost}`;

                // Create an "Edit" button for instructors
                const editButton = document.createElement('button');
                editButton.textContent = 'Edit';
                editButton.addEventListener('click', function () {
                    // Allow instructors to edit course details
                    const updatedCourseName = prompt('Enter the updated course name:', course.name);
                    const updatedCourseCost = prompt('Enter the updated course cost:', course.cost);

                    if (updatedCourseName !== null && updatedCourseCost !== null) {
                        // Update the course details
                        courses[index].name = updatedCourseName;
                        courses[index].cost = parseFloat(updatedCourseCost);

                        // Store the updated course list in localStorage
                        localStorage.setItem('courses', JSON.stringify(courses));

                        displayCourses(); // Refresh the course list
                    }
                });

                // Create a "Remove" button for instructors
                const removeButton = document.createElement('button');
                removeButton.textContent = 'Remove';
                removeButton.addEventListener('click', function () {
                    // Remove the course from the list and local storage
                    courses.splice(index, 1);
                    localStorage.setItem('courses', JSON.stringify(courses));
                    displayCourses(); // Refresh the course list
                });

                courseItem.appendChild(editButton);
                courseItem.appendChild(removeButton);
                courseList.appendChild(courseItem);
            });
        }

        // Display the courses on page load
        displayCourses();

        // Handle the form submission for adding new courses
        const addCourseForm = document.getElementById('add-course-form');

        addCourseForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const courseName = document.getElementById('courseName').value;
            const courseCost = document.getElementById('courseCost').value;

            if (courseName && courseCost) {
                const course = {
                    name: courseName,
                    cost: parseFloat(courseCost),
                };

                courses.push(course);

                // Store the updated course list in localStorage
                localStorage.setItem('courses', JSON.stringify(courses));

                // Display the updated list of courses
                displayCourses();

                // Clear the form fields
                addCourseForm.reset();
            }
        });
    }
});
