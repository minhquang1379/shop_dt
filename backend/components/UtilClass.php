<?php


namespace backend\components;


use ReflectionClass;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use function GuzzleHttp\Psr7\str;

class UtilClass
{
    protected  $source = [];
    public function __construct()
    {
        $this->source = $this->getControllerPath();
    }

    public function getByString( $source , $needle){
        $pos = strrpos($source, $needle);
        return substr($source, $pos + 1, strlen($source) - $pos);
    }
    public function getRoutes(){
        $data = [];
        $templates = $this->getControllerPath();
        foreach( $templates as $template){
            $data = ArrayHelper::merge($data,[$this->getAllController($template)]);
        }
        $data = $this->mergeRoutes($data);
        return $data;
    }
    public function mergeRoutes($data){
        $result = [];
        foreach ( $data as $key => $item){
            $result = ArrayHelper::merge($result, $item);
        }
        return $result;
    }
    public function getAllController($template){
        $path = $source = $template;
        $path = str_replace('\controllers','', $path);
        $data = array();
        $files = FileHelper::findFiles($source, ['fileType'=>['php']]);
        if(strrpos($path,'backend/modules') > 0){
            $path = $this->getByString($path, '/backend');
        }else{
            $path = $this->getByString($path, '/');
        }

        $controllers = [];
        foreach($files as $file) {
            require_once $file;
            $fileName = basename($file, '.php');
            if (($pos = strpos($fileName, 'Controller')) > 0 && $fileName != 'ItemController' && $fileName != 'RoleController' && $fileName != 'AssignmentController'&& $fileName != 'RolesController') {
                $controllers[$path.'.'.$fileName] = $fileName;
            }
        }
        $data[$path] = $controllers;
        return $data;
    }
    public function getAction($value){
        $array = explode('.',$value);
        $f = new ReflectionClass($array[0].'\controllers\\'.$array[1]);
        $methods = array();
        foreach($f->getMethods() as $m){
            if (preg_match('/^action+\w{2,}/', $m->name) && ($pos = stripos($m->name, 'ajax')) == 0 ) {
                $methods[] = str_replace("action", "", $m->name);
            }
        }
        return $methods;
    }
    public function getFullModulePath($moduleId){
        $path = '';
       foreach ($this->source as $alias){
           if(strripos($alias,$moduleId) > 0){
               $path = str_replace('\\controllers','', $alias);
               if(strrpos($path,'backend/modules') > 0){
                   $path = $this->getByString($path, '/backend');
               }else{
                   $path = $this->getByString($path, '/');
               }
           }
           $path = str_replace('/','\\',$path);
       }
       return $path;
    }
    public function getControllerPath(){
        $template = array();
        $backend = Yii::getAlias('@backend');
        $backendController = $backend.'\controllers';
        $template[] = $backendController;
        $pathModules = $backend.'/modules';
        $modules = FileHelper::findDirectories($pathModules, false);
        if(isset($modules)){
            foreach ($modules as $module){
                if( ( $pos = strrpos($module,'controllers'))>0)
                    $template[]= $module;
            }
        }
        return $template;
    }
}