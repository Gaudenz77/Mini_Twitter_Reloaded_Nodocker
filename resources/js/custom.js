
/* toggle start---------------- */

/* function toggleDarkMode() {
    alert('Dark Mode');
    document.body.classList.toggle('dark-mode');
    } */

   /*  const replyForm = document.querySelector('#reply-form'); */

// Listen for click events on all reply buttons
document.querySelectorAll('.reply-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Get the ID of the message being replied to
        const messageId = btn.getAttribute('data-message-id');
        // Set the parent ID of the reply form to the message ID
        document.querySelector('#parent-id').value = messageId;
        // Insert the reply form below the message
        const message = btn.parentNode;
        message.appendChild(document.querySelector('#reply-form'));
        // Show the reply form
        document.querySelector('#reply-form').style.display = 'block';
    });
});

// Listen for click events on the cancel button
document.querySelector('#cancel-btn').addEventListener('click', () => {
    // Hide the reply form
    document.querySelector('#reply-form').style.display = 'none';
});

/* -------------------------------- */

// Check local storage for the user's preference
const isDarkMode = localStorage.getItem('darkMode') === 'true';

// Set the initial state of the toggle based on the user's preference
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
if (isDarkMode) {
  toggleSwitch.checked = true;
  document.documentElement.setAttribute('data-theme', 'dark');
}

// Listen for changes to the toggle and update local storage and the page accordingly
toggleSwitch.addEventListener('change', function(e) {
  if (e.target.checked) {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('darkMode', 'true');
  } else {
    document.documentElement.setAttribute('data-theme', 'light');
    localStorage.setItem('darkMode', 'false');
  }
});