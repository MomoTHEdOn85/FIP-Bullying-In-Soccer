<?php /** @noinspection ALL */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_POST) {
    $recipient = "immamaayoub18@gmail.com";
    $subject = 'Thanks for reaching us';
    $visitor_name         = "";
    $visitor_email        = "";
    $message      = "";
    $fail = array();

    if (isset($_POST['firstname']) && !empty($_POST['firstname'])) {
        //validation
        if(preg_match ("^[a-zA-z]*$", $_POST['firstname'])){
            $visitor_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        }else{
            array_push($fail, "First Name should only be letters.");
        }
    }else{
        array_push($fail, "Firstname field is empty");
    }
    if (isset($_POST['lastname']) && !empty($_POST['lastname'])) {
        //validation
        if(preg_match ("^[a-zA-z]*$", $_POST['lastname'])){
            $visitor_name .= " " . filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        }else{
            array_push($fail,"Last Name should be letters");
        }
    }else{
        array_push($fail, "lastname field is empty");
    }
    //validation
    $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        if (preg_match($pattern,$_POST['email'])){
            $email = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email']);
            $visitor_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        }else{
            array_push($fail,"Invalid email address");
        }

    }else{
        array_push($fail, "Email field is empty");
    }

    if (isset($_POST['message']) && !empty($_POST['message'])) {
        $clean = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
        $message = htmlspecialchars($clean);
    }else{
        array_push($fail, "message field is empty");
    }

    $headers = "From: i_am_awesome@awesome.com" . "\r\n" .
    "Reply-To: jump_off_a_bridge@example.com" . "\r\n" .
    "X-Mailer: PHP/" . phpversion();
    
    if (count($fail)==0) {
        mail($recipient, $subject, $message, $headers);
        $results['message'] = sprintf('Thank you, message sent, %s. You will get a reply as soon as we see your message', $visitor_name);
    } else {
        $results['fail'] = $fail;
        header('HTTP/1.1 488 You Did NOT fill out the form correctly');
        die(json_encode(["message" => $fail]));
    }
} else {
    $results['message'] = 'No submission';
}

echo json_encode($results);

?>