<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>About Us</title>

    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/about.css" />
    <style>
      .cover-img {
        width: 100%;
        height: 500px;
        object-fit: cover;
      }

      .heading {
        text-align: center;
        margin: 50px 0;
        font-size: 50px;
        font-weight: bold;
      }

      .white-container,
      .gray-container {
        padding-top: 1%;
        padding-bottom: 6%;
      }

      .white-container {
        background-color: white;
      }

      .gray-container {
        background-color: #f6f6f6;
      }

      .text {
        margin: 0 12%;
        margin-top: -15px;
        font-size: 18px;
        line-height: 1.8;
      }

      .team-container {
        margin: 70px 20% 0 20%;
        display: flex;
        justify-content: space-between;
      }

      .portrait-container img {
        width: 170px;
      }

      .portrait-container > .caption {
        text-align: center;
        font-size: 18px;
        line-height: 2;
        margin-top: 10px;
      }
    </style>
  </head>
  <body>

    <?php include('head.php'); ?>

    <img
      src="images/about.jpeg"
      class="cover-img"
      alt="about page cover image"
    />

    <div class="white-container">
      <div class="heading">About Us</div>
      <div class="text">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Id consectetur purus
        ut faucibus. Gravida in fermentum et sollicitudin ac orci phasellus.
        Vitae elementum curabitur vitae nunc sed velit dignissim sodales ut.
        Ipsum nunc aliquet bibendum enim. Iaculis urna id volutpat lacus laoreet
        non curabitur. A scelerisque purus semper eget. Donec ac odio tempor
        orci dapibus. Magna etiam tempor orci eu. Nunc sed blandit libero
        volutpat sed cras. Dictum at tempor commodo ullamcorper a lacus
        vestibulum sed. Viverra aliquet eget sit amet tellus cras adipiscing
        enim. Quis vel eros donec ac odio tempor. Gravida arcu ac tortor
        dignissim convallis aenean et. Sed id semper risus in hendrerit gravida
        rutrum quisque non. Ut pharetra sit amet aliquam id diam maecenas
        ultricies mi. Eget duis at tellus at. Cras fermentum odio eu feugiat
        pretium nibh. Amet aliquam id diam maecenas. Id faucibus nisl tincidunt
        eget nullam non.
      </div>
    </div>

    <div class="gray-container">
      <div class="space-10px"></div>
      <div class="heading">Our Mission</div>
      <div class="text">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Id consectetur purus
        ut faucibus. Gravida in fermentum et sollicitudin ac orci phasellus.
        Vitae elementum curabitur vitae nunc sed velit dignissim sodales ut.
        Ipsum nunc aliquet bibendum enim. Iaculis urna id volutpat lacus laoreet
        non curabitur. A scelerisque purus semper eget. Donec ac odio tempor
        orci dapibus. Magna etiam tempor orci eu. Nunc sed blandit libero
        volutpat sed cras. Dictum at tempor commodo ullamcorper a lacus
        vestibulum sed. Viverra aliquet eget sit amet tellus cras adipiscing
        enim. Quis vel eros donec ac odio tempor. Gravida arcu ac tortor
        dignissim convallis aenean et. Sed id semper risus in hendrerit gravida
        rutrum quisque non. Ut pharetra sit amet aliquam id diam maecenas
        ultricies mi. Eget duis at tellus at. Cras fermentum odio eu feugiat
        pretium nibh. Amet aliquam id diam maecenas. Id faucibus nisl tincidunt
        eget nullam non.
      </div>
    </div>

    <div class="white-container">
      <div class="heading">Our Team</div>
      <div class="team-container">
        <div class="portrait-container">
          <img src="images/user-icon.png" />
          <div class="caption">
            Name
            <br />
            Title
          </div>
        </div>
        <div class="portrait-container">
          <img src="images/user-icon.png" />
          <div class="caption">
            Name
            <br />
            Title
          </div>
        </div>
        <div class="portrait-container">
          <img src="images/user-icon.png" />
          <div class="caption">
            Name
            <br />
            Title
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
