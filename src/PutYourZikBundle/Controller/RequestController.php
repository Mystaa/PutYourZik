<?php

namespace PutYourZikBundle\Controller;

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

    public function getInfosAction(Request $request, $id) {


        $data = $request->getContent();
        $result = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();
        $newuser = $em->getRepository('PutYourZikBundle:User')->find($id);

        $newuser->setNom($result['nom']);
        $newuser->setPrenom($result['prenom']);
        $newuser->setUsername($result['username']);
        $newuser->setSchool($result['school']);
        $newuser->setInstagram($result['instagram']);
        $newuser->setFacebook($result['facebook']);
        $newuser->setLinkedin($result['linkedin']);
        $newuser->setEmail($result['email']);
        $newuser->setPassword($result['password']);
        $newuser->setAvatar($result['avatar']);

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

    public function getAllPlaylistAction() {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $playlist = $em->getRepository('PutYourZikBundle:Playlist')->findAll();

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

    public function getPlaylistByUserAction($id)
    {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $pluser = $em->getRepository('PutYourZikBundle:Playlist')->findPlaylistByUser($id);

        $jsonify = $serializer->serialize($pluser, 'json');

        return new Response($jsonify);

    }
    public function getMusicByPlaylistAction($id, $pl_id)
    {

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(1);
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();
        $musicpl = $em->getRepository('PutYourZikBundle:Music')->findMusicByPlaylist($id, $pl_id);

        $jsonify = $serializer->serialize($musicpl, 'json');

        return new Response($jsonify);

    }
}
