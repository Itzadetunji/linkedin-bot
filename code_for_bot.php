<?php 
	require_once 'connection.php';
	require_once 'vendor/autoload.php';
    use GuzzleHttp\Client;
	$input = file_get_contents('php://input');
	$update = json_decode($input);
	$message = $update->message;
	$chat_id = $message->chat->id;
	$message_id = $message->message_id;
	$token = "2011288280:AAHdLHzFf48kTWaNn5qYVw2xjO-e1l3hOPU";
	$text = $message->text;
	$reply_message = $message->reply_to_message->text;
	$reply_message_id = $message->reply_to_message->message_id;
	$message_4 = "Send me a message called '/a_post' then reply '/a_post' the post you want to send.";
	if ($text == '/start') {
		file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$message_4");
	}
	if ($reply_message == '/a_post' && $text != '/post_it') {
		$txt = "Your post: $text. Reply '/a_post' with '/post_it' to send the post.";
		file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$txt&reply_to_message_id=$reply_message_id");
		$my_insert_query = "INSERT INTO hngtwitterbot (id,message_id,reply_message_id,post_message) VALUES (null, '$message_id', '$reply_message_id', '$text')";
		$execute_query = mysqli_query($conn, $my_insert_query);
	}
	if ($text == '/post_it') {
		$sql = "SELECT id, message_id, reply_message_id, post_message FROM hngtwitterbot WHERE reply_message_id='$reply_message_id'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
		    $post_message = $row["post_message"];
		  }
		}
		$link = "https://test.com";
		$access_token = "AQXGVCvAXBi1MY3JCuWbKrwwFHRC5rHKsmdeUqjK-6W2N2lYmn74086p6eWmy0gCYJNKTpN0fT4gdHH1hKuX8363MoWsCD-2BfyvEr6P_NMiMh2Iry4wGP1lXhqf0Lyo_2GxOWR_RHtG-97pnIz5Humxuy0L5MXXk2uTtTQjdM0d6SpNUqv_E_CY8Ta3eVtAZgc1TVV1M8Dad8m47hab85urPRQwAdQu8xHn3eVPGbOlfm0VG8ztKw_x3BXEXLNgy1ObQkvej-IPKhPjyaSNJugxaFP4xBfAAF3cDIrYaEJ52wIIKm7GLpfPh27t37vuv53z1fC-KuljUIiNyH_-OxH7bSfmRA";
		$linkedin_id = "KDKqZHMAyy";
		$body = new \stdClass();
		$body->content = new \stdClass();
		$body->content->contentEntities[0] = new \stdClass();
		$body->text = new \stdClass();
		$body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
		$body->content->contentEntities[0]->entityLocation = $link;
		$body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = 'https://miro.medium.com/max/1400/0*5RLp-IJkJC6dLHvV.jpg';
		$body->content->title = 'Test';
		$body->owner = 'urn:li:person:'.$linkedin_id;
		$body->text->text = $post_message;
		$body_json = json_encode($body, true);

		try{
			$client = new Client(['base_uri' => 'https://api.linkedin.com']);
			$response = $client->request('POST', '/v2/shares',[
				'headers' => [
					"Authorization" =>  "Bearer " . $access_token,
					"Content-Type" => "application/json",
					"x-li-format" =>"json"
				],
				'body' => $body_json,
			]);
			if ($response->getStatusCode() !== 201) {
				echo 'Error: '.$response->getLastBody()->errors[0]->message;
			}
			file_get_contents("https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=Post is shared on linkedin successfully");
		}catch(Exception $e){
			echo $e->getMessage(). ' for link '.$link;
		}
	}
?>