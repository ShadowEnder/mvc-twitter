<footer class="footer mt-auto py-3">

    <div class="container">
        <span class="text-muted">&copy; My Website 2019</span>
    </div>

</footer>

<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="loginAlert"></div>
                    <form>
                       <input type="hidden" id="loginActive" name="loginActive" value="1">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <!--<button type="submit" class="btn btn-primary">Login</button>-->
                    </form>
                </div>
                <div class="modal-footer">
                    <!--<a id="toggleLogin">Sign Up</a>-->
                    <button type="button" class="btn btn-info" id="toggleLogin">Sign Up?</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="loginSignupButton">Login</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        $("#toggleLogin").click(function() {
            if($("#loginActive").val() == "1") {
                $("#loginActive").val("0");
                $("#loginModalTitle").html("Sign Up");
                $("#loginSignupButton").html("Sign Up");
                $("#toggleLogin").html("Login?");
            } else {
                $("#loginActive").val("1");
                $("#loginModalTitle").html("Login");
                $("#loginSignupButton").html("Login");
                $("#toggleLogin").html("Sign Up?");
            }
        });

        $("#loginSignupButton").click(function() {
            $.ajax({
                type: "POST",
                url: "actions.php?action=loginSignup",
                data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(),
                success: function(result) {
                    if(result == 1) {

                        window.location.assign("http://testdomain-webdev-com.stackstaging.com/mvc-twitter/");

                    } else {

                        $("#loginAlert").html(result).show();

                    }
                }
            });
        });

        $(".toggleFollow").click(function() {

            var id = $(this).attr("data-userId");

            $.ajax({
                type: "POST",
                url: "actions.php?action=toggleFollow",
                data: "userId=" + id,
                success: function(result) {
                    if(result == "1") {

                        $("a[data-userId='" + id + "']").html("Follow");

                    } else if (result == "2") {

                        $("a[data-userId='" + id + "']").html("Unfollow");

                    }
                }
            });

        });

        $("#postTweetButton").click(function() {
            $.ajax({
                type: "POST",
                url: "actions.php?action=postTweet",
                data: "tweetContent=" + $("#tweetContent").val(),
                success: function(result) {
                    
                    if(result == "1") {

                        $("#tweetSuccess").show();
                        $("#tweetFail").hide();

                    } else if (result != "") {

                        $("#tweetFail").html(result).show();
                        $("#tweetSuccess").hide();

                    }

                }
            });
        });

    </script>

  </body>
</html>