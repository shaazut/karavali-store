<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>Karavali Rubber and Enterprises - Contact</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        /* Header */
        .header {
            background-color: #1abc9c;
            padding: 20px;
            text-align: center;
            overflow: hidden;
        }
        .contact-info {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0; /* Remove the bottom margin */
}

.info-item {
    text-align: center;
    margin-bottom: 20px; /* Add some bottom margin to the info items */
}

form {
    margin-top: 20px; /* Add some top margin to the form */
}
        .header img {
            height: 120px;
            width: 80px;
            margin-right: 10px;
            float: left;
        }

        .header h1 {
            display: inline-block;
            margin: 20px;
            font-size: 55px;
            color: #fff;
        }

        /* Navigation Bar */
        .navbar {
            background-color: #1abc9c;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            float: right;
            color: #fff;
            text-decoration: none;
            padding: 10px 16px;
            margin-right: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .navbar a:hover {
            background-color: #16a085;
        }

        /* Content */
        .content {
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .content h2 {
            color: #1abc9c;
        }

        .content h3 {
            color: #16a085;
        }

        
        form input,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }

        form button {
            background-color: #1abc9c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #16a085;
        }

        /* Footer */
        .footer {
            background-color: #2c3e50;
            padding: 20px;
            text-align: center;
            color: #fff;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }
        

input[type="submit"] {
  background-color: #1abc9c;
  color: #fff;
  border: none;
  padding: 6px 12px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: 120px;
}

input[type="submit"]:hover {
  background-color: #16a085;
}
        /* Media Queries */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 40px;
            }

            .header img {
                height: 80px;
                width: 60px;
            }

            .navbar a {
                float: none;
                display: block;
                text-align: center;
                margin-right: 0;
                margin-bottom: 5px;
            }

            .contact-info {
                flex-direction: column;
                align-items: center;
            }

            .info-item {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="images/logo.jpg" alt="Logo">
        <h1>Karavali Rubber and Enterprises</h1>
    </div>
    <div class="navbar">
        <a href="dashboard.php">Home</a>
    </div>
    <div class="content">
    <h2>Contact Us</h2>
    <p>Have a question or need assistance? Feel free to reach out to us using the contact information below, and we'll get back to you as soon as possible.</p>
    <div class="contact-info">
        <div class="info-item">
            <i class="fa fa-map-marker"></i>
            <h3>Address</h3>
            <p><strong>Mashroora,puttur-574201<br>UT Mohammed Shaaz,Uppinangady-574241</strong></p>
        </div>
        <div class="info-item">
            <i class="fa fa-phone"></i>
            <h3>Phone</h3>
            <p><strong>+91 8105770843<br>+91 9880835039</strong></p>
        </div>
        <div class="info-item">
            <i class="fa fa-envelope"></i>
            <h3>Email</h3>
            <p><strong>mashrooramashu64@gmail.com<br>utshaaz2@gmail.com</strong></p>
        </div>
    </div>
    <form action="https://formsubmit.co/el/jupuye">
        <input type="submit" value="Contact Us" />
    </form>
    <br>
    <br>
</div>
    <div class="footer">
            <p>&copy; Karavali Rubber and Enterprises</p>
    </div>
</body>
</html>