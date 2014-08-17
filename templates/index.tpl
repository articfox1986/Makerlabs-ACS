{include file="header.tpl"}
        <!-- Make sure all your bars are the first things in your <body> -->
        <header class="bar bar-nav">
            <h1 class="title">MakerLabs Access Control</h1>
        </header>
        <nav class="bar bar-tab">
            <a class="tab-item active" href="http://makerlabs.co.za"  data-ignore="push">
                Powered by Makerlabs.co.za
            </a>
        </nav>
        <!-- Wrap all non-bar HTML in the .content div (this is actually what scrolls) -->
        <div class="content">
            <div class="card">
                <p class="content-padded">Access control app for Makerlabs front gate. If you would like access. please login via google plus</p>
            </div>
            <p class="content-padded"><a href="login_with_google.php" data-ignore="push">
                    <button class="btn btn-negative btn-block">
                        <i class="fa fa-google-plus" style="width:16px; height:20px"></i>
                        Sign in with Google
                    </button></a>
            </p>
        </div>
{include file="footer.tpl"}