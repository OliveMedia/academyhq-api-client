<?php

namespace AcademyHQ\API\Repository\OMA;

use AcademyHQ\API\Common\Credentials;
use AcademyHQ\API\ValueObjects as VO;
use Guzzle\Http\Client as GuzzleClient;
use AcademyHQ\API\Repository\BaseRepository;
use AcademyHQ\API\HTTP\Request\Request as Request;

class ThirdPartyRepository extends BaseRepository
{
    public function __construct(Credentials $credentials)
    {
        parent::__construct();
        $this->credentials = $credentials;
        $this->base_url .= '/third-party';
    }

    /*
    Parameters :
        @current_page : num | null
        @per_page : num | null
        @direction : asc | desc | null
        @sort_by : name | created_at | null
        @search : employer's name | null
        @status : active | inactive | null
    */
    public function listEmployers(
        VO\Integer $current_page,
        VO\Integer $per_page,
        VO\StringVO $direction = null,
        VO\StringVO $sort_by = null,
        VO\StringVO $search = null,
        VO\StringVO $status = null
    ) {

        $request = new Request(
            new GuzzleClient,
            $this->credentials,
            VO\HTTP\Url::fromNative($this->base_url . '/list/employers'),
            new VO\HTTP\Method('POST')
        );

        $request_parameters = array(
            'current_page' => $current_page->__toInteger(),
            'per_page' => $per_page->__toInteger(),
        );

        if ($direction) {
            $request_parameters['direction'] = $direction->__toString();
        }

        if ($sort_by) {
            $request_parameters['sort_by'] = $sort_by->__toString();
        }

        if ($search) {
            $request_parameters['search'] = $search->__toString();
        }

        if ($status) {
            $request_parameters['status'] = $status->__toString();
        }

        $response = $request->send($request_parameters);

        $data = $response->get_data();

        return $data;
    }
}
