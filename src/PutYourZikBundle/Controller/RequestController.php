<?php

namespace PutYourZikBundle\Controller;

use PutYourZikBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class RequestController extends Controller
{
    public function requestAction()
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('PutYourZikBundle:User')->findAll();

        $jsonuser = $serializer->serialize($user, 'json');


        return $this->render('PutYourZikBundle:Default:index.html.twig', array('response' => $jsonuser));
    }

    public function getInfosAction(Request $request) {

        $newuser = new User();

        $data = $request->getContent();
        $result = json_decode($data, true);

        $newuser->setUsername($result['username']);
        $newuser->setEmail($result['mail']);
        $newuser->setPassword($result['mdp']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($newuser);
        $em->flush();

        return new JsonResponse('success', 200);
    }

    public function userPlaylistsActions () {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository('PutYourZikBundle:User')->findOneBy('id');

    }
}
