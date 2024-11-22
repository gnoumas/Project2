<?php

$page_title = "NGF GYM - Legal Information";
$footer_year = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            padding: 20px;
        }

        header {
            background-color: #ff7fbf; 
            color: white;
            text-align: center;
            padding: 20px 0;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            font-size: 2.5em;
            font-family: 'Cursive', sans-serif;
        }

        h2 {
            font-size: 1.8em;
            color: #ff4097; 
            margin-bottom: 10px;
        }

        p, li {
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        ul li {
            margin-bottom: 10px;
            line-height: 1.5;
        }

        a {
            color: #ff4097;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        section {
            margin-bottom: 30px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        footer {
            text-align: center;
            margin-top: 40px;
            background-color: #ff7fbf;
            padding: 15px;
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        footer p {
            font-size: 1.2em;
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        form {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ff4097;
            border-radius: 8px;
            font-size: 1em;
            width: 100%;
            max-width: 500px;
        }

        input[type="submit"] {
            background-color: #ff4097;
            color: white;
            border: none;
            padding: 15px;
            font-size: 1.1em;
            cursor: pointer;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }

        input[type="submit"]:hover {
            background-color: #ff007f;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            header h1 {
                font-size: 2em;
            }

            h2 {
                font-size: 1.5em;
            }

            section {
                padding: 15px;
            }

            footer p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>NGF GYM - Legal Information</h1>
    </header>

    <section>
        <h2>Terms and Conditions</h2>
        <p>By accessing or using the services of NGF GYM, you agree to comply with the following terms:</p>
        <ul>
            <li>You must be at least 18 years of age or have parental consent to use our services.</li>
            <li>You agree to follow all safety guidelines and instructions from our staff and trainers.</li>
            <li>NGF GYM is not responsible for any injuries or accidents that occur during your workout.</li>
            <li>Membership fees are non-refundable once paid. Please review the pricing details before joining.</li>
            <li>NGF GYM reserves the right to cancel or suspend your membership if these terms are violated.</li>
        </ul>
    </section>

    <section>
        <h2>Privacy Policy</h2>
        <p>We respect your privacy and are committed to protecting your personal information. Here’s how we handle your data:</p>
        <ul>
            <li>Personal data is collected only when necessary for membership registration and communication.</li>
            <li>Your data will never be sold or shared with third parties without your consent, except as required by law.</li>
            <li>We use industry-standard security measures to protect your personal information.</li>
            <li>You may request access to your data or request corrections at any time.</li>
        </ul>
    </section>

    <section>
        <h2>Liability Disclaimer</h2>
        <p>NGF GYM is not responsible for any personal injuries, accidents, or property damage that may occur during the use of our gym facilities or services. By using our services, you accept full responsibility for your actions and health.</p>
    </section>

    <section>
        <h2>Contact Information</h2>
        <p>If you have any questions or concerns about the legal information provided, please contact us at:</p>
        <ul>
            <li>Email: <a href="mailto:info@ngfgym.com">info@ngfgym.com</a></li>
            <li>Phone: (123) 456-7890</li>
            <li>Address: 123 Fitness St., Bronx, NY 10458</li>
        </ul>
    </section>

    <footer>
        <p>&copy; <?php echo $footer_year; ?> NGF GYM. All rights reserved.</p>
    </footer>

</body>
</html>