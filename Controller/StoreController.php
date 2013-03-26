<?php

namespace Ivoba\EasySlotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ivoba\EasySlotBundle\Store;

class StoreController extends Controller {

    public function indexAction() {
        $S = $this->get('ivoba.easyslot');
        $slots = $S->load();
        return $this->render('IvobaEasySlotBundle:Default:index.html.twig', array('slots' => $slots));
    }

    public function deleteAction() {
	$translator = $this->container->get('translator');
        $del = $this->getRequest()->get('key', false);
        if ($del) {
            $S = $this->get('ivoba.easyslot');
            $slots = $S->load();
            if ($S->delete($del)) {
                $S->persist();
                $this->get('session')->setFlash('ui-state-highlight', $translator->trans('deleted slot'));
            } else {
                $this->get('session')->setFlash('ui-state-error', $translator->trans('couldnt delete slot'));
            }
        }
        return $this->redirect($this->generateUrl('IvobaEasySlotBundle_admin'));
    }

    public function saveAction() {
	$translator = $this->container->get('translator');
        $S = $this->get('ivoba.easyslot');
        $post = $this->getRequest()->request->all();
        if(!empty($post)) {
            foreach ($post['Collection'] as $key => $value) {
                if (empty($key)) {
                    $key = time();
                }
                $f = (object) $value;
                $S->create($key, $f);
            }
            $S->persist();
            $this->get('session')->setFlash('ui-state-highlight', $translator->trans('saved slots'));
        }
        return $this->redirect($this->generateUrl('IvobaEasySlotBundle_admin'));
    }
    
    public function exportAction() {
        $S = $this->get('ivoba.easyslot');
        return $S->export();
    }

}
