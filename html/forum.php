<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Main</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <link href="/styles/style.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="/scripts/script.js"></script>

</head>

<body >

    <header>
        <div id="headerimg">
            <a href="home.html" name="home"><img src="/images/plain_logo.png" class="blackLogo"></a>
        </div>

        <div id="headerTitle">
            <h1>Labo 10</h1>
        </div>

        <div id="header-btns" >   
            <button id="themeToggle">🌑</button>
        </div>
    </header>

    <nav>
        <div class="collapseBtn">
            <button id="collapseBtn">➖</button>
        </div>

        <div class="dropdown" id="selectors">
            <a href="home.html" name="home"><button type="button" class="btn btn-primary" >Home</button></a>
            <a href="forum.html" name="main"><button type="button" class="btn btn-primary">Forum</button></a>

        </div>

        <div id="signBtns">
            <a href="Register.html" name="signin" id="signin"><button id="signUpbtn" type="button" >Register</button></a>
            <a href="index.html" name="signin" id="signin" > <button id="signinbtn" type="button" >Login </button></a>   
        </div>
    </nav>


    <main>
        <aside>
            <!--Obviously would have to be dynamically filled-->
            <table class="hide-text">
                <tr>
                    <th colspan="2">Table</th>
                </tr>
                <tr>
                    <td>user1</td>
                    <td>1234</td>
                </tr>
                <tr>
                    <td>user2</td>
                    <td>456</td>
                </tr>
                <tr>
                    <td>user3</td>
                    <td>3525</td>
                </tr>
                <tr>
                    <td>user4</td>
                    <td>62525</td>
                </tr>
                <tr>
                    <td>user5</td>
                    <td>34</td>
                </tr>
                <tr>
                    <td>user6</td>
                    <td>7543</td>
                </tr>
                <tr>
                    <td>user7</td>
                    <td>25563</td>
                </tr>
                <tr>
                    <td>user8</td>
                    <td>3453</td>
                </tr>
            </table>
        </aside>
    
        <content > 
            <h1>Welcome to the blog page!</h1>
            <button id="test">Test</button>

            <div class="contact-container">
                <form action="#" method="post">
                    
                    <div class="form-group">
                        <label for="message">Your Message:</label>
                        <textarea id="contactMessage" name="message" rows="4" maxlength="250" oninput="updateCharCount(this)"required></textarea>
                        <div id="charCount">Characters remaining: 250</div>
                    </div>
                    <button type="delete" class="submit-button" id="blogSubmit">Submit</button>
                    <button type="submit" class="submit-button" id="blogDelete">Delete</button>

                </form>
            </div>

            <div id="blogSpace"> 

                <div class="contact-container">
                    <div class="form-group">
                        <textarea id="contactMessage" name="message" rows="4" readonly></textarea>
                        <div id="charCount">Post Written by:<p></p></div>
                    </div>
                </div>
                
            </div>

            

            
        </content>
    </main>
    
    <footer>
        <h5>Privacy policy &nbsp | &nbsp Terms and condition</h5>
        <h5>© 2024 
        <img src="/images/plain_logo_white.png" alt="Image of logo" width="50px" class="whiteLogo">
        All rights reserved</h5>
    </footer>
</body>
</html>