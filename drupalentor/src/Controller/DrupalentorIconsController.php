<?php
/**
 * @file
 * Contains \Drupal\drupalentor\Controller\DrupalentorController.
 */

namespace Drupal\drupalentor\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;




class DrupalentorIconsController extends ControllerBase{

   

    public function icons(Request $request) {

         return new JsonResponse([]);
    }

}
