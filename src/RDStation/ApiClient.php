<?php 

namespace Umobi\RDStation;

use GuzzleHttp\Client;
use Umobi\RDStation\Exception\RDStationException;

class ApiClient {

    private $apiUrl = "/";

    private $defaultIdentifier = "rdstation-laravel-integrator";

    private $token;

    private $privateToken;


    public function __construct($config = [], $url = "https://www.rdstation.com.br/api", $version = "1.3")
    {
        if (!isset($config['token']) || !isset($config['private_token'])) {
            throw new RDStationException("Check the `rdstation` settings");
        }
        $this->token = $config['token'];
        $this->privateToken = $config['private_token'];
        $this->apiUrl = $url . "/" . rtrim($version);
    }

    public function register($identifier = null, $data = [])
    {
        if (!isset($identifier)) {
            throw new RDStationException("RDStation requires a identifier for a lead registration");
        }

        if (!isset($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new RDStationException("Lead email field must be present and valid.");
        }

        $data['identificador'] = $identifier;

        if(empty($data["client_id"]) && !empty($_COOKIE["rdtrk"]) && ($rdtrk = json_decode($_COOKIE["rdtrk"])))
            $data["client_id"] = $rdtrk->id;
        if(empty($data["c_utmz"]) && !empty($_COOKIE["__utmz"]))
            $data["c_utmz"] = $_COOKIE["__utmz"];
        if(empty($data["traffic_source"]) && !empty($_COOKIE["__trf_src"]))
            $data["traffic_source"] = $_COOKIE["__trf_src"];

        $data = $this->extractCommonFields($data);

        try {
            return $this->request('POST', '/conversions', $data);
        } catch (\Exception $e) {
            throw new RDStationException($e->getMessage(), $e->getCode(), $e);
        }
    }

    private function extractCommonFields($data = [])
    {
        if (isset($data['name'])) {
            $data['nome'] = $data['name'];
            unset($data['name']);
        }
        if (isset($data['phone_number'])) {
            $data['celular'] = $data['phone_number'];
            unset($data['phone_number']);
        }

        return $data;
    }

    private function request($method, $path, $params = array()) {
        $url = $this->apiUrl.rtrim($path, '/');

        $params['token_rdstation'] = $this->token;

        $client = new Client([
            'base_uri' => $url,
        ]);

        if (!strcmp($method, "POST")) {
            $response = $client->post('', array(
                'json'    => $params,
            ));
        } else if (!strcmp($method, "GET")) {
            $response = $client->get('', array(
                'query' => $params,
            ));
        } else if (!strcmp($method, "DELETE")) {
            $response = $client->delete('', array(
                'query' => $params,
            ));
        }
        $responseData = \GuzzleHttp\json_decode($response->getBody(), true);
        $status = $response->getStatusCode();

        return array("status" => $status, "response" => $responseData);
    }
}