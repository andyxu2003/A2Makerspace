<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <title>Contact Us</title>

  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="css/contact.css" />
  <style>
    body {
      height: 100vh;
      width: 100vw;
    }

    .container {
      display: flex;
      height: 100%;
      width: 100%;
    }

    .gray-container {
      background-color: #f2f2f2;
      width: 50%;
      padding-top: 4%;
    }

    .white-container {
      width: 50%;
      padding-top: 4%;
      /* border-right: 2px solid lightgray; */
    }

    .heading {
      font-size: 50px;
      text-align: center;
      margin: 45px 0;
    }

    .subheading {
      margin-top: 20px;
      margin-bottom: 50px;
      font-size: 30px;
      text-align: center;
      color: #1434a4;
    }

    .form-container {
      width: 60%;
      margin: 0 auto;
    }

    .form-container label,
    .form-container input,
    .form-container textarea {
      display: block;
      margin-bottom: 10px;
    }

    .form-container label {
      font-size: 20px;
    }

    .form-container input,
    .form-container textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 30px;
      font-size: 16px;
      border: 2px solid gray;
    }

    .form-container textarea {
      font-family: "Trebuchet MS", sans-serif;
    }

    .button-container {
      display: flex;
      justify-content: center;
      padding-top: 20px;
    }

    .button-container button {
      padding: 15px 25px;
      background-color: #1434a4;
      color: white;
      border: none;
      font-size: 20px;
      border-radius: 15px;
      cursor: pointer;
      transition-duration: 0.3s;
    }

    .button-container button:hover {
      background-color: #202a44;
    }

    .contact-info-container {
      display: flex;
      flex-wrap: wrap;
      margin: 0 20%;
      /* border: 2px solid lightgray; */
      padding: 40px;
      box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
      background-color: #f6f6f6;
    }

    .contact-info-container>.icon {
      width: 15%;
    }

    .icon img {
      width: 100%;
      height: auto;
    }

    .contact-info-container>.text {
      width: 75%;
      height: auto;
      display: flex;
      align-items: center;
      font-size: 20px;
    }

    .contact-info-container>.blank {
      width: 10%;
    }

    .contact-info-container>.gap {
      height: 60px;
      width: calc(100% / 3);
    }
  </style>

  <script>
    function validateForm() {
      var nameInput = document.getElementById("name");
      var phoneInput = document.getElementById("phone");
      var emailInput = document.getElementById("email");
      var messageInput = document.getElementById("message");

      var phonePattern = /^\d+$/;
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      var errorMessage = "";

      if (!phoneInput.value.match(phonePattern)) {
        errorMessage += "Invalid phone number. Please enter only numbers.\n";
      }

      if (!emailInput.value.match(emailPattern)) {
        errorMessage +=
          "Invalid email address. Please enter a valid email.\n";
      }

      if (errorMessage !== "") {
        alert(errorMessage);
        return false;
      }

      // The form is valid, you can proceed with submission or further processing.
      return true;
    }
  </script>
</head>

<body>
  <?php include('head.php'); ?>

  <div class="heading">Contact Us</div>
  <div class="container">
    <div class="white-container">
      <div class="subheading">Get in touch</div>
      <div class="contact-info-container">
        <div class="icon">
          <img src="images/mail-icon.png" alt="email icon" />
        </div>
        <div class="blank"></div>
        <div class="text">Email: example@example.com</div>

        <div class="gap"></div>
        <div class="gap"></div>
        <div class="gap"></div>

        <div class="icon">
          <img src="images/phone-icon.png" alt="phone icon" />
        </div>
        <div class="blank"></div>
        <div class="text">Phone: (XXX) XXX-XXXX</div>

        <div class="gap"></div>
        <div class="gap"></div>
        <div class="gap"></div>

        <div class="icon">
          <img src="images/pin-icon.png" alt="pin icon" />
        </div>
        <div class="blank"></div>
        <div class="text">Address: 200 Boston Ave, Medford, MA 02155</div>
      </div>
    </div>

    <div class="gray-container">
      <div class="subheading">How can we help? Send us a message</div>
      <div class="form-container">
        <form onsubmit="return validateForm()">
          <label for="name">Name</label>
          <input type="text" id="name" name="name" placeholder="Enter Name" required />

          <label for="phone">Phone Number (##########)</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter Phone Number" required />

          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter Email" required />

          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Write your message here" required></textarea>

          <div class="button-container">
            <button type="submit">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>