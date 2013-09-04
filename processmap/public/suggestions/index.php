<?php

require "vendor/autoload.php";

$app = new \Slim\Slim();

$app->get('/', function() {
    readfile('form.html');
});

$app->post('/submit', function() use ($app){	
	$req = $app->request();
	//POST variable
	$suggestion = $req->post('suggestion');
	$subject = $req->post('subject');
	
	$suggestion_formatted = "<p>". nl2br($suggestion) ."</p>";
	
	$transport = Swift_SmtpTransport::newInstance('webmail.duarte.com', 587, 'tls')
	  ->setUsername('webmaster')
	  ->setPassword('du4rte');
	
	$mailer = Swift_Mailer::newInstance($transport);
	
	// submit with SwiftMailer
	$message = Swift_Message::newInstance()
	  // Give the message a subject
	  ->setSubject("Suggestion: ". $subject)
	  // Set the From address with an associative array
	  ->setFrom(array('webmaster@duarte.com' => 'Suggestion Box'))
	  // Set the To addresses with an associative array
	  ->setTo(array('nancy@duarte.com','drew@duarte.com','kerry@duarte.com'))
	  // Give it a body
	  ->setBody("$subject\n\n$suggestion")
	  // And optionally an alternative body
	  ->addPart("<h4>$subject</h4> $suggestion_formatted", 'text/html');
	
	$result = $mailer->send($message);
	
});

$app->run();