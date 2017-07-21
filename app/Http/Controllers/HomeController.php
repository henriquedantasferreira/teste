<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $cfgDigitalGrow;
    private $SEARCH_COURSE_PARAMETER = 'searchvalue';

    public function __construct()
    {
        $this->cfgDigitalGrow = config('digital-grow');
    }

    public function __invoke()
    {
       return view('HomeControllerTest', ['name' => 'lalala']);

        /*$courses = $this->getCourses();
        return view('home', [
            'digitalGrowUrl' => array_get($this->cfgDigitalGrow, 'baseUrl'),
            'courses' => $courses,
            'searchCourseParameter' => $this->SEARCH_COURSE_PARAMETER
        ]);*/
    }

    private function getCourses()
    {
        $moodleApiCfg = array_get($this->cfgDigitalGrow, 'moodleApi');
        $coursesServiceCfg = array_get($moodleApiCfg, 'service.publicCourses');
        $coursesCacheKey = array_get($coursesServiceCfg, 'cacheKey');
        if (Cache::has($coursesCacheKey)) {
            $courses = Cache::get($coursesCacheKey);
        } else {
            $courses = [];
            $cacheExpiration = array_get($coursesServiceCfg, 'cacheExpiration', 10);
            $client = new HttpClient();
            $method = array_get($moodleApiCfg, 'method');
            $requestUrl = array_get($moodleApiCfg, 'url');
            $res = $client->request($method, $requestUrl, $this->buildRequestQuery($moodleApiCfg, $coursesServiceCfg));
            $responseBody = $res->getBody();
            try {
                $courses = (\GuzzleHttp\json_decode($responseBody->getContents()));
            } catch (\InvalidArgumentException $exception) {
                // TODO: Error handling
            }
            if (!empty($courses)) {
                // remove the first course, since it's information about the site and not a course
                $courses = array_slice($courses, 1);
                // after getting the data, save it to cache
                Cache::put($coursesCacheKey, $courses, $cacheExpiration);
            }
        }
        return $courses;
    }

    private function buildRequestQuery(array $moodleApiCfg, array $serviceCfg, array $override = []): array {
        if (empty($moodleApiCfg) && empty($requestCfg)) {
            return [];
        }
        return [
            'query' => array_merge(array_get($moodleApiCfg, 'commonRequestVars'), array_get($serviceCfg, 'requestVars'), $override)
        ];
    }

    public function searchCourse(Request $request)
    {
        $courses = [];
        $searchValue = $request->input($this->SEARCH_COURSE_PARAMETER);
        $moodleApiCfg = array_get($this->cfgDigitalGrow, 'moodleApi');
        $requestUrl = array_get($moodleApiCfg, 'url');
        $method = array_get($moodleApiCfg, 'method');
        $searchServiceCfg = array_get($moodleApiCfg, 'service.searchCouses');
        $client = new HttpClient();
        $res = $client->request($method, $requestUrl, $this->buildRequestQuery($moodleApiCfg, $searchServiceCfg, ['criteriavalue' => $searchValue]));
        $responseBody = $res->getBody();
        try {
            $courses = (\GuzzleHttp\json_decode($responseBody->getContents()));
        } catch (\InvalidArgumentException $exception) {
            // TODO: Error handling
        }
        $courses = $courses->courses;
        return view('home', [
            'digitalGrowUrl' => array_get($this->cfgDigitalGrow, 'baseUrl'),
            'courses' => $courses,
            'searchCourseParameter' => $this->SEARCH_COURSE_PARAMETER
        ]);
    }

    public function abc(){
        return view('HomeControllerTest', ['name' => 'oioioi']);
    }

    public function elastic(){
        return view('createindex');
    }

    public function outracoisa(){
        return view('welcome', ['name' => 'outra coisa']);
    }

    public function welcome(){
        return view('welcome', ['name' => 'henrique']);
    }

    public function helloworld(){
        return view('welcome', ['name' => 'hello world']);
    }

    public function outraoutracoisa(){
        return view('welcome', ['name'=> $_GET['nome']]);
    }

    public function formresult(){

        return view('welcome',['name' => $_POST['username']]);
    }

    public function addindexels(){
        return view('elasticview', ['addindex'=>$_POST['el_index'], 'type'=>$_POST['el_type'], 'id'=>$_POST['el_id'], 'body'=>$_POST['el_body']]);
    }

    public function searchindexls(){
        return view('elasticview', ['index' => $_POST['el_searchindex']]);
    }
    
}
