<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link rel="stylesheet" href="css/header.css" />
  <title>Header</title>
  <style>
    @import url("https://fonts.googleapis.com/css?family=Open+Sans");

    body {
      margin: 0;
      padding: 0;
      /*   font-family: "Open Sans", sans-serif; */
      font-family: "Arial", sans-serif;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background-color: white;
    }

    .active {
      text-decoration: underline;
    }

    .logo img {
      max-width: 300px;
      height: auto;
      padding-left: 20px;
    }

    .top-header-container {
      display: flex;
      gap: 10px;
      padding-right: 20px;
      align-items: center;
    }

    .top-header-container button {
      background-color: #1434a4;
      color: white;
      width: 150px;
      height: 50px;
      font-size: 16px;
      border-style: none;
      cursor: pointer;
    }

    .top-header-container button:hover {
      background-color: #27285C;
    }

    .top-header-container a {
      padding: 5px 10px;
      text-decoration: none;
      color: black;
    }

    .top-header-container a:hover {
      text-decoration: underline;
    }

    .pages-header {
      background-color: #1434a4;
      color: white;
      padding: 20px 0;
      position: sticky;
      top: 0;
      z-index: 999;
    }

    .pages-header-container {
      max-width: 100%;
      margin: 0 auto;
      display: flex;
      justify-content: center;
    }

    .pages-header-container nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: space-between;
    }

    .pages-header-container nav ul li {
      margin-left: 140px;
    }

    .pages-header-container nav ul li:first-child {
      margin-left: 0;
    }

    .pages-header-container nav ul li a {
      color: white;
      text-decoration: none;
      font-size: 20px;
    }

    .pages-header-container nav ul li a:hover {
      border-bottom: 3px solid white;
      padding-bottom: 2px;
    }

    .space-10px {
      width: 100%;
      height: 10px;
    }

    .space-50px {
      width: 100%;
      height: 50px;
    }

    .negspace-10px {
      width: 100%;
      margin-top: -10px;
    }

    .negspace-50px {
      width: 100%;
      margin-top: -50px;
    }
  </style>
</head>

<body>
  <header aria-labelledby="related-nav-heading" role="banner">
    <div class="left-container">
      <div class="logo">
        <a href="../../">
          <img src="https://cdn.glitch.global/fdf75b2b-7e9a-4bb3-986a-bd88e96d179a/logo.png?v=1687373287862" alt="Website Logo" />
        </a>
      </div>
    </div>
    <div class="top-header-container">
      <nav>
        <a href="../../project-title">
          <button type="button">Upload Project +</button>
        </a>
        <a href="../../contact">Contact Us</a>
        <a href="../../login.html">Log In</a>
        <a href="../../signup.html">Sign Up</a>
      </nav>
    </div>
  </header>

  <div class="pages-header">
    <div class="pages-header-container">
      <nav>
        <ul>
          <li><a href="../../projects">Projects</a></li>
          <li><a href="../../hackathons.html">Hackathons</a></li>
          <li><a href="../../tutorials">Tutorials</a></li>
          <li><a href="../../makers.html">Makers</a></li>
          <li><a href="../../forums.html">Forums</a></li>
          <li><a href="../../about">About Us</a></li>
        </ul>
      </nav>
    </div>
  </div>
</body>

</html>