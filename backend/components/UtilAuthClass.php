<?php


namespace backend\components;


class UtilAuthClass
{
    public function changeAction($moduleId, $controllerId, $postAction = [], $roleId){
        $util = new UtilClass();
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole($roleId);
        $childRole = $auth->getChildren($role->name);
        $controllerAction = $util->getAction($moduleId.'.'.$controllerId.'Controller');
        foreach($controllerAction as $action){
            if( isset($postAction) && in_array($action, $postAction)){
                if(!isset($childRole[$moduleId.'-'.$controllerId.'-'.$action])){
                    if( ($permission = $auth->getPermission($moduleId.'-'.$controllerId.'-'.$action)) == null){
                        $permission = $auth->createPermission($moduleId.'-'.$controllerId.'-'.$action);
                        $permission->description = $action;
                        $auth->add($permission);
                        $auth->addChild($role, $permission);
                    }else{
                        $auth->addChild($role, $permission);
                    }
                }
            }else{
                if(isset($childRole[$moduleId.'-'.$controllerId.'-'.$action])
                    && ($permission = $auth->getPermission($moduleId.'-'.$controllerId.'-'.$action))!=null){
                    $auth->removeChild($role, $permission);
                }
            }
        }
    }
    public function createAction($moduleId, $controllerId, $postAction = [], $roleId){
        if(isset($postAction)){
            $auth = \Yii::$app->authManager;
            $role = $auth->getRole($roleId);
            foreach ($postAction as $action){
                if(($permission =  $auth->getPermission($moduleId.'-'.$controllerId.'-'.$action)) == null){
                    $permission = $auth->createPermission($moduleId.'-'.$controllerId.'-'.$action);
                    $permission->description = $action;
                    $auth->add($permission);
                    $auth->addChild($role, $permission);
                }else{
                    $auth->addChild($role, $permission);
                }
            }
        }
    }
}