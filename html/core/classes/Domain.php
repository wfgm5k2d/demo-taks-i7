<?php
use GuzzleHttp\Client;

class Domain
{
    private string $sApiUrl = 'https://vrdemo.virtreg.ru/vr-api';
    private string $sOperator = 'demo';
    private string $sPassword = 'demo';
    private string $sToken = '';
    private string $sClientId = '';
    private $obClient = NULL;

    public function __construct()
    {
        $this->getToken();
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getToken () {
        $this->obClient = new Client([
            'base_uri' => $this->sApiUrl,
        ]);

        $response = $this->obClient->request('POST', '', [
            'json' => [
                "version" => "2.0",
                'method' => 'authLogin',
                "id" => "",
                'params' => [
                    'login' => $this->sOperator,
                    'password' => $this->sPassword,
                ]
            ]
        ]);

        $obAuthorize = Helper::decode($response->getBody());
        $this->sToken = $obAuthorize->result->token;
        $this->sClientId = $obAuthorize->result->operator->id;
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function domainCreate($sComment = '', $sDomainName, $sDescription, $arNservers = [], $bDelegated = false, $bNsTest = false, $bAutoRenew = false, $bAutoPark = false) {
        $this->obClient = new Client([
            'base_uri' => $this->sApiUrl,
        ]);

        $response = $this->obClient->request('POST', '', [
            'json' => [
                "version" => "2.0",
                'method' => 'domainCreate',
                "id" => "",
                'params' => [
                    'auth' => [
                        'token' => $this->sToken,
                    ],
                    'clientId' => $this->sClientId,
                    'noCheck' => true,
                    'domain' => $this->generateObDomain($sComment, $sDomainName, $sDescription, $arNservers, $bDelegated, $bNsTest, $bAutoRenew, $bAutoPark),
                ]
            ]
        ]);

        return Helper::decode($response->getBody());
    }

    private function generateObDomain($sComment = '', $sDomainName, $sDescription = '', $arNservers = [], $bDelegated = false, $bNsTest = false, $bAutoRenew = false, $bAutoPark = false) {
        return [
            'comment' => $sComment,
            'name' => $sDomainName, // validating
            'description' => $sDescription, //validating
            'nservers' => $arNservers,
            'delegated' => $bDelegated, // признак разрешения делегирования домена
            'nsTest' => $bNsTest, // признак необходимости тестирования name-серверов при делегировании домена
            'autoRenew' => $bAutoRenew, // признак разрешения автоматического продления домена
            'autoPark' => $bAutoPark, // признак разрешения автоматической парковки домена
        ];
    }
}