<?php

namespace PutYourZikBundle\Controller;

use PutYourZikBundle\Entity\Publication;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Publication controller.
 *
 */
class PublicationController extends Controller
{
    /**
     * Lists all publication entities.
     *
     */
    public function indexAction()
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

        $publications = $em->getRepository('PutYourZikBundle:Publication')->findAllWithUser();

        $jsonPublications = $serializer->serialize($publications, 'json');

         return new Response($jsonPublications);
    }

    /**
     * Creates a new publication entity.
     *
     */
    public function newAction(Request $request)
    {

        $publication = new Publication();

        $data = $request->getContent();
        $result = json_decode($data, true);
        
        $publication->setContent($result['content']);
        $publication->setDate($result['date']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($publication);
        $em->flush();

        return new JsonResponse('success', 200);

    }

    /**
     * Finds and displays a publication entity.
     *
     */
    public function showAction(Publication $publication)
    {
        //$deleteForm = $this->createDeleteForm($publication);

    	$encoders = array(new XmlEncoder(), new JsonEncoder());
    	$normalizer = new ObjectNormalizer();
    	        $normalizer->setCircularReferenceLimit(1);
    	        $normalizer->setCircularReferenceHandler(function ($object) {
    	            return $object->getId();
    	        });
    	        $normalizers = array($normalizer);    	$serializer = new Serializer($normalizers, $encoders);
    	$serializer = new Serializer($normalizers, $encoders);

        $em = $this->getDoctrine()->getManager();

        $publication = $em->getRepository('PutYourZikBundle:Publication')->find($publication);

        $jsonPublication = $serializer->serialize($publication, 'json');

        // return $jsonPublications;

        return $this->render('publication/show.html.twig', array(
            'publication' => $publication,
            'publication' => $jsonPublication,
            //'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     */
    // public function editAction(Request $request, Publication $publication)
    // {
    //     $deleteForm = $this->createDeleteForm($publication);
    //     $editForm = $this->createForm('PutYourZikBundle\Form\PublicationType', $publication);
    //     $editForm->handleRequest($request);

    //     if ($editForm->isSubmitted() && $editForm->isValid()) {
    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('publication_edit', array('id' => $publication->getId()));
    //     }

    //     return $this->render('publication/edit.html.twig', array(
    //         'publication' => $publication,
    //         'edit_form' => $editForm->createView(),
    //         'delete_form' => $deleteForm->createView(),
    //     ));
    // }

    // /**
    //  * Deletes a publication entity.
    //  *
    //  */
    // public function deleteAction(Request $request, Publication $publication)
    // {
    //     $form = $this->createDeleteForm($publication);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->remove($publication);
    //         $em->flush();
    //     }

    //     return $this->redirectToRoute('publication_index');
    // }

    // /**
    //  * Creates a form to delete a publication entity.
    //  *
    //  * @param Publication $publication The publication entity
    //  *
    //  * @return \Symfony\Component\Form\Form The form
    //  */
    // private function createDeleteForm(Publication $publication)
    // {
    //     return $this->createFormBuilder()
    //         ->setAction($this->generateUrl('publication_delete', array('id' => $publication->getId())))
    //         ->setMethod('DELETE')
    //         ->getForm()
    //     ;
    // }
}
