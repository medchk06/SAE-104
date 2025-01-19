<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class EportfolioController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        $data = [
            'name' => 'CHOUKRI MOHAMMED ISLAM',
            'age' => 18,
            'origin' => 'Morocco',
            'program' => 'Networks and Telecommunications',
            'school' => 'IUT de Roanne',
            'description' => 'Le Bachelor en Réseaux et Télécommunications est un programme de trois ans conçu pour former des professionnels de niveau intermédiaire dans les domaines des réseaux, des télécommunications et des systèmes d\'information. Ce programme fournit aux étudiants les compétences techniques et les connaissances nécessaires pour concevoir, mettre en œuvre, configurer et maintenir des systèmes de communication modernes et des réseaux.',
            'objectives' => [
                'Administration des réseaux',
                'Conversion des entreprises et des utilisateurs',
                'Création d\'outils et d\'applications logicielles pour l\'informatique',
            ],
        ];

        return $this->render('eportfolio/index.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/home_en', name: 'home_en')]
    public function indexEn(): Response
    {
        $data = [
            'name' => 'CHOUKRI MOHAMMED ISLAM',
            'age' => 18,
            'origin' => 'Morocco',
            'program' => 'Networks and Telecommunications',
            'school' => 'IUT de Roanne',
            'description' => 'The Bachelor in Networks and Telecommunications is a three-year program designed to train intermediate-level professionals in the fields of networks, telecommunications, and information systems. This program provides students with the technical skills and knowledge necessary to design, implement, configure, and maintain modern communication systems and networks.',
            'objectives' => [
                'Network administration',
                'Business and user conversion',
                'Creation of tools and software applications for computing',
            ],
        ];

        return $this->render('eportfolio/index_en.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/cv', name: 'cv')]
    public function cv(): Response
    {
        $data = [
            'jobTitle' => 'Alternance Sécurité et Réseaux - 2 ans | 2 semaines / 2 semaines',
            'formations' => [
                'BUT Réseaux et Télécommunications',
                'Baccalauréat Scientifique'
            ],
            'experiences' => [
                'Stage chez Entreprise X',
                'Développeur Web chez Entreprise Y'
            ],
            'competences' => [
                'Réseaux',
                'Programmation',
                'Sécurité',
                'Gestion de projet'
            ],
            'langues' => [
                'Français',
                'Anglais'
            ],
        ];

        return $this->render('eportfolio/cv.html.twig', [
            'data' => $data,
        ]);
    }

    #[Route('/form', name: 'form')]
    public function form(): Response
    {
        return $this->render('eportfolio/form.html.twig');
    }

    #[Route('/download_cv', name: 'download_cv', methods: ['POST'])]
    public function downloadCv(Request $request): BinaryFileResponse
    {
        // Récupérez les données du formulaire
        $firstName = $request->request->get('first_name');
        $lastName = $request->request->get('last_name');
        $email = $request->request->get('email');

        // Vous pouvez ajouter ici une logique pour enregistrer les informations du visiteur si nécessaire

        // Chemin vers le fichier CV
        $filePath = $this->getParameter('kernel.project_dir') . '/public/cv choukri.pdf';

        // Vérifiez si le fichier existe
        if (!file_exists($filePath)) {
            throw $this->createNotFoundException('Le fichier CV n\'existe pas.');
        }

        // Renvoyez le fichier en tant que réponse
        $response = new BinaryFileResponse($filePath);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'cv_choukri_mohammed_islam.pdf' // Nom du fichier téléchargé
        );

        return $response;
    }

    #[Route('/projects', name: 'projects')]
    public function projects(): Response
    {
        return $this->render('eportfolio/projects.html.twig');
    }
}