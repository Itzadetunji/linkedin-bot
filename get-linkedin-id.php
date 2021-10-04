<?php 
	require_once 'config.php';
	require_once 'vendor/autoload.php';
	use GuzzleHttp\Client;

	$access_token = 'AQXGVCvAXBi1MY3JCuWbKrwwFHRC5rHKsmdeUqjK-6W2N2lYmn74086p6eWmy0gCYJNKTpN0fT4gdHH1hKuX8363MoWsCD-2BfyvEr6P_NMiMh2Iry4wGP1lXhqf0Lyo_2GxOWR_RHtG-97pnIz5Humxuy0L5MXXk2uTtTQjdM0d6SpNUqv_E_CY8Ta3eVtAZgc1TVV1M8Dad8m47hab85urPRQwAdQu8xHn3eVPGbOlfm0VG8ztKw_x3BXEXLNgy1ObQkvej-IPKhPjyaSNJugxaFP4xBfAAF3cDIrYaEJ52wIIKm7GLpfPh27t37vuv53z1fC-KuljUIiNyH_-OxH7bSfmRA';
	try {
		$client = new Client(['base_uri' => 'https://api.linkedin.com']);
		$response = $client->request('GET', '/v2/me', [
			'headers' => [
				"Authorization" => "Bearer " . $access_token,
			],
		]);
		$data = json_decode($response->getBody()->getContents(),true);
		$linkedin_profile_id = $data['id']; //store this id somewhere
		echo $linkedin_profile_id;
	} catch (Exception $e) {	
		echo $e->getMessage();	
	}
 ?>