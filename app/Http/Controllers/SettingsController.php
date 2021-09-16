<?php

namespace App\Http\Controllers;

use App\Services\DTO\ResponseDTO;
use App\Services\Settings\SettingsService;
use Illuminate\Http\Request;


class SettingsController extends Controller
{


    private $responseDTO;
    private $settingsService;

    /**
     * SettingsController constructor.
     * @param $responseDTO
     * @param $settingsService
     */
    public function __construct(ResponseDTO $responseDTO, SettingsService $settingsService)
    {
        $this->responseDTO = $responseDTO;
        $this->settingsService = $settingsService;
    }

    /**
     *
     * @Get("get-settings/{module}")
     * @param $module
     */
    public function getSettings($module)
    {
        $this->responseDTO = $this->settingsService->getSettings($module);
        return respond($this->responseDTO);
    }


}
