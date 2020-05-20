<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Form\FormError;

use App\Entity\Casiers;
use App\Form\CasiersType;

class CasierController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(Request $request)
    {
        return $this->redirectToRoute('casier_list');
    }

    /**
     * @Route("/casiers", name="casier_list")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $pageTitle = "Liste des Casiers";
        $boxTitle = "Liste des Casiers";
        $list = $em->getRepository(Casiers::class)->findAll();
        return $this->render('casier/index.html.twig', [
            'app_name' => 'Coplan Portail',
            'page_title' => $pageTitle,
            'box_title' => $boxTitle,
            'path_add' => "casier_add",
            'path_update' => "casier_update",
            'path_delete' => "casier_delete",
            'list' => $list
        ]);
    }
    /**
     * @Route("/casiers/add", name="casier_add")
     */
    public function add(Request $request)
    {
        $pageTitle = "Ajouter un Casier";
        $boxTitle = "Ajouter un Casier";
        $successMsg = "Casier ajouté avec succès : id : ";
        $em = $this->getDoctrine()->getManager();
        $casier = new Casiers();
        $form = $this->createForm(CasiersType::class, $casier);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()) {
                $casier = $form->getData();
                $em->persist($casier);
                $em->flush();
                $casierId = $casier->getId();
                $this->addFlash(
                      'success',
                      $successMsg . $casierId
                  );
                return $this->redirectToRoute('casier_list');
            }
        }
        return $this->render('casier/add.html.twig', [
            'app_name' => 'Coplan Portail',
            'page_title' => $pageTitle,
            'box_title' => $boxTitle,
            'path_list' => "casier_list",
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/casiers/update/{id}", name="casier_update")
     */
    public function update(Request $request, $id)
    {
        $pageTitle = "Modifier un Casier";
        $boxTitle = "Modifier un Casier";

        $successMsg = "Casier modifié avec succès ";
        $em = $this->getDoctrine()->getManager();
        $casier = $em->getRepository(Casiers::class)->find($id);
        $form = $this->createForm(CasiersType::class, $casier);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            if ($form->isValid()) {
                $casier = $form->getData();
                $em->persist($casier);
                $em->flush();
                $this->addFlash(
                      'success',
                      $successMsg
                  );
                return $this->redirectToRoute('casier_list');
            }
        }
        return $this->render('casier/modif.html.twig', [
            'app_name' => 'Coplan Portail',
            'page_title' => $pageTitle,
            'box_title' => $boxTitle,
            'path_list' => "casier_list",
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/casiers/delete/{id}", name="casier_delete")
     */
    public function delete(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $successMsg = "Casier supprimé avec succès";
        $errorMsg = "Opération échouée !";
        try {
            $casier = $em->getRepository(Casiers::class)->find($id);
            $em->remove($casier);
            $em->flush();
            $this->addFlash(
                  'success',
                  $successMsg
              );
        } catch (\Exception $e) {
            $this->addFlash(
                  'error',
                  $errorMsg
              );
        }
        return $this->redirectToRoute('casier_list');
    }
}
