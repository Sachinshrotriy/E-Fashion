

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
    <!-- ... Other meta tags and styles ... -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <style>
        body {
  font-family: Arial, sans-serif;
  background-color: #f5f5f5;
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container {
  background-color: #fff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
}

h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

form label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

form input[type="text"],
form input[type="email"],
form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

form textarea {
  resize: vertical;
}

button {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

button:hover {
  background-color: #0056b3;
}

button:focus {
  outline: none;
}
  </style>

</head>
<body>
  <div class="container">
    <h1>Contact Us</h1>
    <form id="contactForm" action="#" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="4" required></textarea>
      
      <button type="button" id="submitBtn">Submit</button>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById("contactForm");
      const submitBtn = document.getElementById("submitBtn");

      submitBtn.addEventListener("click", function() {
        // You can perform form validation here if needed

        // Simulate form submission, replace with your actual submission logic
        console.log("Form submitted!");
        
        // Clear form inputs after submission
        form.reset();
      });
    });
  </script>
  <script>
  document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contactForm");
    const submitBtn = document.getElementById("submitBtn");

    submitBtn.addEventListener("click", function() {
      // You can perform form validation here if needed

      // Simulate form submission
      console.log("Form submitted!");

      // Show a pop-up using SweetAlert
      Swal.fire({
        icon: 'success',
        title: 'Thank You!',
        text: 'Your message has been submitted successfully.',
        confirmButtonText: 'OK'
      });

      // Clear form inputs after submission
      form.reset();
    });
  });
</script>

</body>
</html>
