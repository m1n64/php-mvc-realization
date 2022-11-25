<?php
namespace App\Middlewares;


use App\Core\Middleware\AbstractMiddleware;
use App\Core\Model\Interfaces\ModelInterface;
use App\Models\UserIp;
use GuzzleHttp\Client;

class GetCountryByIp extends AbstractMiddleware
{

    /**
     * @var ModelInterface
     */
    protected ModelInterface $model;

    public function __construct(
        UserIp $userIp,
    )
    {
        parent::__construct();
        $this->model = $userIp;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(): void
    {
        $ip = $_SERVER["REMOTE_ADDR"];

        $client = new Client();
        $response = $client->get("http://ip-api.com/json/$ip")
            ->getBody()
            ->getContents();

        $response = json_decode($response);

        $country = @$response->country ?? "World";
        $city = @$response->city ?? "Undefined";

        $currentCountry = $this->model->select()->where("ip", $ip)->execute();

        if ($currentCountry->count() == 0) {
            $this->model->insertData([
                "ip"=>$ip,
                "country"=>$country,
                "city"=>$city
            ]);
        }

    }
}