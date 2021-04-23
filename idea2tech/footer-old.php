<!--==== Contact ====  -->
<!--==== Contact ====  -->
<div class="contact">
    <div class="container">
     
       <div class="title">Contact US</div>
        <form class="info col-md-6"  method="post">
            <?php 
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $name = ucfirst($_POST['name']);
                    $email = ucfirst($_POST['email']);
                    $message = $_POST['message'];
                    $emsg = 'Name: ' . $name . "\n"
                            .'Email: '.$email. "\n"
                            . 'Massage: '. $message . "\n";
                    $header = 'From: ' . $email . "\n";
                    
                    if(strlen($name) < 5){
                        echo "<div class='alert alert-danger'>Your name should be more than 4 Char.</div>";
                    }elseif(strlen($email) < 7){
                        echo "<div class='alert alert-danger'>Please enter you Email.</div>";
                    }elseif(strlen($message) < 15){
                        echo "<div class='alert alert-danger'>Your Message is too Short.</div>";
                    }else{
                        mail('info@ideas2tech.net' , 'Massage From ' . $name, $emsg, $header);
                        echo "<div class='alert alert-success'>Thank you, we have received your message and will get back to you within 24 hours.</div>";
                    }
                }
            ?> 
            <table width='100%'>
                <tr>
                    <td>Name: &nbsp;</td>
                    <td><input class="form-control" type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Email: &nbsp;</td>
                    <td><input class="form-control" type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Massage: &nbsp;</td>
                    <td><textarea rows="7" class="form-control" name="message"></textarea></td>
                </tr>
            </table>
            <input type="submit" value="Send" class="btn button"/>
            <p>Address: 7 El Bahrin St, 7th floor</p>
            <p>Email: support@ideas2tech.net</p>
            <p>Tel: 01101981111, 00966565999922</p>
        </form>
        
        <div class="map col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d610.2222548032782!2d31.321557043330273!3d30.095951766972572!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14581588413eaea7%3A0x948d33764f8cd050!2s7+Al+Bahreen%2C+El-Montaza%2C+Heliopolis%2C+Cairo+Governorate%2C+Egypt!5e0!3m2!1sen!2s!4v1506301732320"  height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
            
        </div>
    </div>
    
    <div class="footer">
      <h5>IDEAS2TECH &#126; 2017 all Rights reserved</h5>
    </div>
</div>  
    
    
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <script src="js/index.js"></script>
</body>