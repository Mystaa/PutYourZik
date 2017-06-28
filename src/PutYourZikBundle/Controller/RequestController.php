<?php

namespace PutYourZikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
        $comment = $em->getRepository('PutYourZikBundle:Comments')->findAll();
        $music = $em->getRepository('PutYourZikBundle:Music')->findAll();
        $playlist = $em->getRepository('PutYourZikBundle:Playlist')->findAll();
        $tag = $em->getRepository('PutYourZikBundle:Tag')->findAll();
        $publication = $em->getRepository('PutYourZikBundle:Tag')->findAll();

        $jsonuser = $serializer->serialize($user, 'json');
        $jsoncomment = $serializer->serialize($comment, 'json');
        $jsonmusic = $serializer->serialize($music, 'json');
        $jsonplaylist = $serializer->serialize($playlist, 'json');
        $jsontag = $serializer->serialize($tag, 'json');
        $jsonpublication = $serializer->serialize($publication, 'json');

        $response = new Response($jsonuser, $jsoncomment, $jsonmusic, $jsonplaylist, $jsonpublication, $jsontag);
        return $response;
    }
}
