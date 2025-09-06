<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class Controller extends BaseController
{
    protected array $rtData = [];
    protected array $testRtData = [];
    protected string $APP_ENV = '';
    protected array $SERVER_VERSION = ['version' => ''];

    use AuthorizesRequests, ValidatesRequests;
    public function __construct()
    {
        $this->APP_ENV = config('app.env');
        $this->SERVER_VERSION['version'] = config('app.version');
        $this->SERVER_VERSION['app_env'] = $this->APP_ENV;
    }

    public function setReturnData(string $key='emptyKey', $data){
        $this->rtData[$key] = $data;
    }

    public function setTestReturnData(string $key='emptyTestKey', $data){
        $this->testRtData[$key] = $data;
    }

    public function sendResult(int $httpStatus=200, string $msg='ok'){
        $data = [
            'server' => $this->SERVER_VERSION,
            'success' => true,
            'message' => $msg,
            'data' => $this->rtData,
        ];

        // 테스트 서버일때만 testData가 보이도록 추가
        if($this->APP_ENV === 'development'){
            $data['testData'] = $this->testRtData;
        }

        return response()->json($data, $httpStatus);
    }

    public function sendErrorResult(string $msg, int $httpStatus=200){
        $data = [
            'success' => false,
            'server' => $this->SERVER_VERSION,
            'message' => $msg,
            'data' => $this->rtData,
        ];

        // 테스트 서버일때만 testData가 보이도록 추가
        if($this->APP_ENV === 'development'){
            $data['testData'] = $this->testRtData;
        }

        return response()->json($data, $httpStatus);
    }
}
