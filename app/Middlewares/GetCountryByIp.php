<?php
namespace App\Middlewares;


use App\Core\Middleware\AbstractMiddleware;
use App\Models\UserIp;
use GuzzleHttp\Client;

class GetCountryByIp extends AbstractMiddleware
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(): void
    {
        $ip = $_SERVER["REMOTE_ADDR"];
        $model = new UserIp();

        $client = new Client();
        $response = $client->get("http://ip-api.com/json/$ip")
            ->getBody()
            ->getContents();

        $response = json_decode($response);

        $country = @$response->country ?? "World";
        $city = @$response->city ?? "Undefined";

        $currentCountry = $model->select()->where("ip", $ip)->execute();

        if ($currentCountry->count() == 0) {
            $model->insertData([
                "ip"=>$ip,
                "country"=>$country,
                "city"=>$city
            ]);
        }

    }
}