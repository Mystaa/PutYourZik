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

    public function getAllUsersAction(){

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $allusers = $em->getRepository('PutYourZikBundle:User')->findAll();

        $jsonify = $serializer->serialize($allusers, 'json');

        return new Response($jsonify);
    }

    public function getUsersAction($id){

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('PutYourZikBundle:User')->find($id);

        $jsonify = $serializer->serialize($users, 'json');

        return new Response($jsonify);
    }

    public function getPlaylistAction($id) {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $playlist = $em->getRepository('PutYourZikBundle:Playlist')->find($id);

        $jsonify = $serializer->serialize($playlist, 'json');

        return new Response($jsonify);
    }

    public function getPublicationAction($id) {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $publication = $em->getRepository('PutYourZikBundle:Publication')->find($id);

        $jsonify = $serializer->serialize($publication, 'json');

        return new Response($jsonify);
    }

    public function getAllPublicationAction() {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $publication = $em->getRepository('PutYourZikBundle:Publication')->findAll();

        $jsonify = $serializer->serialize($publication, 'json');

        return new Response($jsonify);
    }

    public function verifAction(Request $request) {

        $data = $request->getContent();
        $result = json_decode($data, true);

        $mail = $result['mail'];
        $token = $result['token'];

        $em = $this->getDoctrine()->getManager();
        $test = $em->getRepository('PutYourZikBundle:User')->findToken($mail, $token);

        if ($test) {
            echo 'ok';
        }
        else {
            echo 'non';
        }

        return $this->render('PutYourZikBundle:Default:index.html.twig');
    }
}
