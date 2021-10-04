<?php
	require_once 'vendor/autoload.php';
	use GuzzleHttp\Client;
	$link = "https://fasten.com";
	$access_token = "AQXGVCvAXBi1MY3JCuWbKrwwFHRC5rHKsmdeUqjK-6W2N2lYmn74086p6eWmy0gCYJNKTpN0fT4gdHH1hKuX8363MoWsCD-2BfyvEr6P_NMiMh2Iry4wGP1lXhqf0Lyo_2GxOWR_RHtG-97pnIz5Humxuy0L5MXXk2uTtTQjdM0d6SpNUqv_E_CY8Ta3eVtAZgc1TVV1M8Dad8m47hab85urPRQwAdQu8xHn3eVPGbOlfm0VG8ztKw_x3BXEXLNgy1ObQkvej-IPKhPjyaSNJugxaFP4xBfAAF3cDIrYaEJ52wIIKm7GLpfPh27t37vuv53z1fC-KuljUIiNyH_-OxH7bSfmRA";
	$linkedin_id = "KDKqZHMAyy";
	$body = new \stdClass();
	$body->content = new \stdClass();
	$body->content->contentEntities[0] = new \stdClass();
	$body->text = new \stdClass();
	$body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
	$body->content->contentEntities[0]->entityLocation = $link;
	$body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = 'https://annualreport2018.grandvision.com/xmlpages/tan/images/25420/901000/901002/1850.jpg';
	$body->content->title = 'Susanwwwwwwwwwwwwwwwww gardner';
	$body->owner = 'urn:li:person:'.$linkedin_id;
	$body->text->text = 'Susan Gardner, LCSW BCD - Counswwwwwwwwwwwelor | Massapequa, NY';
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
		echo "Post is shared on linkedin successfully";
	}catch(Exception $e){
		echo $e->getMessage(). ' for link '.$link;
	}
 ?>