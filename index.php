<?php include("./system/config.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BadyetKo</title>
    <link rel="icon" href="./assets/Logo.png" type="image/icon type">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/landingpage.css">
</head>

<body>
    <header>
        <nav>
            <a href="index.php">
                <img src="./assets/landingpage/light logo.png" alt="Logo">
            </a>

            <ul>
                <li><a href="#" class="active-page">Home</a></li>
                <li><a href="#about-us">About Us</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="./screens/signuppage.php" id="sign-up-cta">Sign up</a></li>
            </ul>
        </nav>
        <img class="illustration" src="./assets/landingpage/hero-illustration.jpg" alt="">
    </header>
    <main>
        <section class="card intro">
            <h1>Take Control of Your Budget with <span>BadyetKo!</span></h1>
            <p class="sibline">Mange your expenses effortlessly and achieve your financial goals.</p>

            <div class="ctas">
                <a href="./screens/signuppage.php" class="sign-up-now">Sign up now</a>
                <a href="#faqs" class="read-more">
                    <img src="./assets/Logo.png" alt="">
                    Check FAQs
                </a>
            </div>
        </section>

        <section class="card features">
            <div class="card">
                <img src="./assets/landingpage/budget-tracking.png" alt="">
                <h2 class="feature-name">Budget tracking</h2>
                <p class="feature-description">Easily monitor your income and expenses to stay on top of your finances.</p>
            </div>

            <div class="card">
                <img src="./assets/landingpage/expense-categorization.png" alt="">
                <h2 class="feature-name">Expenses categorization</h2>
                <p class="feature-description">Organize your spending into categories to better understand your financial habits.</p>
            </div>

            <div class="card">
                <img src="./assets/landingpage/saving-goals.png" alt="">
                <h2 class="feature-name">Saving goals</h2>
                <p class="feature-description">Set and track specific savings targets to help you reach your financial aspirations.</p>
            </div>
        </section>

        <section id="about-us" class="card about-us">
            <h3>About BadyetKo</h3>
            <p class="about-description">
                BadyetKo is a budgeting app designed specifically for students to help them manage their finances, track expenses, and achieve their savings goals easily.
            </p>

            <div class="about-card">
                <h4>
                    <img src="./assets/landingpage/icons/mission.png" alt="">
                    Our mission
                </h4>
                <p>Our mission is to empower students to take control of their money so they can make smart spending decisions and save for their future.</p>
            </div>

            <div class="about-card">
                <h4>
                    <img src="./assets/landingpage/icons/story.png" alt="">
                    Our story
                </h4>
                <p>BadyetKo was created to help students tackle the challenges of managing their money. Our goal is to make budgeting simple and accessible for everyone, allowing students to take charge of their finances.</p>
            </div>
        </section>

        <section id="faqs" class="card">
            <h5>FAQs</h5>

            <div class="faq-cards">
                <div class="faq-card">
                    <div class="icon">
                        <img src="./assets/landingpage/icons/free.png" alt="">
                    </div>

                    <p class="question">
                        Is BudgetKo free to use?
                    </p>

                    <div class="answer">
                        Yes, BadyetKo offers a free with essential features for budgeting and expense tracking. We may offer optional premium features in the future.
                    </div>
                </div>

                <div class="faq-card">
                    <div class="icon">
                        <img src="./assets/landingpage/icons/device.png" alt="">
                    </div>

                    <p class="question">
                        Can i access BadyetKo on multiple devices?
                    </p>

                    <div class="answer">
                        Yes, BadyetKo is web-based and can be accessed from any device with internet access. Just log in with your email and password.
                    </div>
                </div>

                <div class="faq-card">
                    <div class="icon">
                        <img src="./assets/landingpage/icons/save.png" alt="">
                    </div>

                    <p class="question">
                        How does BadyetKo help me save money?
                    </p>

                    <div class="answer">
                        BadyetKo allows you to set specific savings goals, track your spending, and identify where you can cut down expenses, making it easier to save money over time.
                    </div>
                </div>
            </div>
        </section>

        <section class="card sponsor">
            <h5>Designed for Students, Built for Your Goals!</h5>
            <a href="./screens/signuppage.php" class="light-big-cta">Sign up now</a>
        </section>

        <div class="card footer" id="contact">
            <h5>Contact us</h5>
            <div class="contacts">
                <div class="left">
                    <p class="message">
                        Email, call, or message us on our social media platforms for feedback, inquiries, and support.
                    </p>

                    <div class="copy">
                        <img class="logo-footer" src="./assets/landingpage/light logo.png" alt="">
                        <p class="copyright">&copy; 2024 BadyetKo</p>
                    </div>
                </div>
                <div class="right">
                    <a href="#">
                        <img src="./assets/landingpage/icons/email.png" alt="">
                        22ur0005@psu.edu.ph
                    </a>

                    <a href="#">
                        <img src="./assets/landingpage/icons/phone.png" alt="">
                        +63 950 1731 751
                    </a>

                    <a href="#">
                        <img src="./assets/landingpage/icons/facebook.png" alt="">
                        silverdave.ramos.3
                    </a>
                </div>
            </div>
        </div>

    </main>

    <script>
        window.addEventListener('scroll', (e) => {
            if (window.scrollY > 10) {
                document.querySelector('header').classList.add('header-blur')
            } else {
                document.querySelector('header').classList.remove('header-blur')
            }
        })
    </script>
</body>

</html>

<?php
// header("Location: http://localhost/badyetko/screens/loginpage.php");
?>