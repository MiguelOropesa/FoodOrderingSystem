<?php include('partials-front/menu.php'); ?>
    <div class="mainbox">
        <p class="title">Frequently Asked Questions</p>
        <div class="questions-container">

            <div class="question-container">
                <div class="question">
                    <p>Do you have any promo?</p>
                    <button type="button" class="question-button">
                        <span class="show-answer"><i class="fas fa-angle-down"></i></span>
                        <span class="hide-answer"><i class="fas fa-angle-up"></i></span>
                    </button>
                </div>
                <div class="answer">
                    <p>Please visit our facebook page '<a href="#">Flavorful Feasts</a>' to be notified of any ongoing promotions.</p>
                </div>
            </div>

            <div class="question-container">
                <div class="question">
                    <p>Where is your store located?</p>
                    <button type="button" class="question-button">
                        <span class="show-answer"><i class="fas fa-angle-down"></i></span>
                        <span class="hide-answer"><i class="fas fa-angle-up"></i></span>
                    </button>
                </div>
                <div class="answer">
                    <p>Our store is located at 4102, Flavor Feast Restaurant, Molino 6 soldiers el grande Street, Bacoor Cavite City</p>
                </div>
            </div>

            <div class="question-container">
                <div class="question">
                    <p>Contact Information</p>
                    <button type="button" class="question-button">
                        <span class="show-answer"><i class="fas fa-angle-down"></i></span>
                        <span class="hide-answer"><i class="fas fa-angle-up"></i></span>
                    </button>
                </div>
                <div class="answer">
                    <p> For further inquiries, you can contact us through this number, +63 920 954 1882. You can also contact us in our social media accounts:
                    <ul>
                        <li>
                            <a href="#">Facebook</a>
                        </li>
                        <li>
                            <a href="#">Instagram</a>
                        </li>
                        <li>
                            <a href="#">Twitter</a>
                        </li>
                    </ul>
                    
                    </p>
                </div>
            </div>

        </div>

    </div>
    <style>
    /* CSS for FAQ Page*/
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: rgb(225, 225, 225);
        }

        .main {
            max-width: 800px;
            margin: 0 auto;
            padding: 25px;
            background-color: rgb(255, 255, 255);
            margin-top: 100px;
            border-radius: 5px;
            box-shadow: 0 0 20px rgb(160, 160, 160);
        }

        .title {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .questions-container {
            overflow: hidden;
        }

        .question-container {
            border-radius: 5px;
            border-bottom: 1px solid rgb(180, 180, 180);
            margin: 5px;
        }

        .question {
            background-color: rgb(245, 245, 245);
            padding: 12px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .answer {
            padding: 10px;
            display: none;
        }

        .question p {
            font-size: 20px;
        }

        .question-button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .show-answer {
            display: none;
        }

        .hide-answer {
            display: inline-block;
        }

        .active .show-answer {
            display: inline-block;
        }

        .active .hide-answer {
            display: none;
        }

        .active .answer {
            display: block;
        }
    </style>
    <!-- Script JS -->
    <script src="./script.js"></script>
<?php include('partials-front/footer.php'); ?>