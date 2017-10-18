<?php

namespace Kanboard\Api\Authorization;

/**
 * Class ActorAuthorization
 *
 * @package Kanboard\Api\Authorization
 * @author  Paulo
 */
class ActorAuthorization extends ProjectAuthorization
{
    public function check($class, $method, $actor_id)
    {
        if ($this->userSession->isLogged()) {
            $actor = $this->actorModel->getById($actor_id);
            
            if (! empty($actor)) {
                $this->checkProjectPermission($class, $method, $actor['project_id']);
            }
        }
    }
}
