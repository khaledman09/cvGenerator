<?php
/**
 * Created by PhpStorm.
 * User: USERA
 * Date: 20/08/2016
 * Time: 01:32
 */
include 'randomizer.php';

if(isset($_POST["cvsQuantity"])){
    $cvsQuantity = $_POST["cvsQuantity"];
    $xml = new DOMDocument("1.0", "UTF-8");

    $all = $xml->createElement("all");
    $all = $xml->appendChild($all);

    for($index = 1; $index <= $cvsQuantity; $index++){
        $candidature = $xml->createElement("candidature");
        $candidature = $all->appendChild($candidature);
        /*
         * Generer les coordonnées de candidature
         */
        $coordonnees = $xml->createElement("coordonnées");
        $coordonnees = $candidature->appendChild($coordonnees);

        $personData = generate_random_name();                // generer le nom, prenom, et le sexe d'une personne random
        $nom = $xml->createElement("nom", $personData['lastName']);
        $nom = $coordonnees->appendChild($nom);
        $prenom = $xml->createElement("prénom", $personData['firstName']);
        $prenom = $coordonnees->appendChild($prenom);
        $sexe = $xml->createElement("sexe", $personData['gender']);
        $sexe = $coordonnees->appendChild($sexe);

        $birth_dayData = generate_random_birth_day();                       // generer la date de naissance au random
        $date_de_naissance = $xml->createElement("date_de_naissance", $birth_dayData);
        $date_de_naissance = $coordonnees->appendChild($date_de_naissance);

        $addressData = generate_random_address();                           // generer une adresse au random
        $lieu_de_naissance = $xml->createElement("lieu_de_naissance", $addressData["wilaya"]);
        $lieu_de_naissance = $coordonnees->appendChild($lieu_de_naissance);
        $adresse = $xml->createElement("adresse", $addressData["adresse"]);
        $adresse = $coordonnees->appendChild($adresse);
        $commune = $xml->createElement("commune", $addressData["commune"]);
        $commune = $coordonnees->appendChild($commune);
        $wilaya = $xml->createElement("wilaya", $addressData["wilaya"]);
        $wilaya = $coordonnees->appendChild($wilaya);
        $code_postal = $xml->createElement("code_postal", $addressData["code_postal"]);
        $code_postal = $coordonnees->appendChild($code_postal);
        $nationalite = $xml->createElement("nationalité", "Algérienne");
        $nationalite = $coordonnees->appendChild($nationalite);

        $service_nationalData = generate_random_service_national();
        $service_national = $xml->createElement("situation_service_national", $service_nationalData);
        $service_national = $coordonnees->appendChild($service_national);

        $telephoneData = generate_random_telephone();
        $telephone = $xml->createElement("télephone", $telephoneData);
        $telephone = $coordonnees->appendChild($telephone);

        $mobileData = generate_random_mobile();
        $mobile = $xml->createElement("mobile", $mobileData);
        $mobile = $coordonnees->appendChild($mobile);

        $emailData = generate_random_email($personData['lastName']);
        $email = $xml->createElement("email", $emailData);
        $email = $coordonnees->appendChild($email);

        /*
         * Generer le niveau d'étude
         */
        $niveaudetude = $xml->createElement("niveau_etudes");
        $niveaudetude = $candidature->appendChild($niveaudetude);

        $niveaudetudeData = generate_random_niveau_etudes(substr($birth_dayData, 6));
        $diplome = $xml->createElement("diplôme", $niveaudetudeData['diplome']);
        $diplome = $niveaudetude->appendChild($diplome);
        $niveau = $xml->createElement("niveau", $niveaudetudeData['niveau']);
        $niveau = $niveaudetude->appendChild($niveau);
        $annee = $xml->createElement("annee", $niveaudetudeData['annee']);
        $annee = $niveaudetude->appendChild($annee);
        $specialite = $xml->createElement("spécialité", $niveaudetudeData['specialite']);
        $specialite = $niveaudetude->appendChild($specialite);
        $etablissement = $xml->createElement("etablissement", $niveaudetudeData['etablissement']);
        $etablissement = $niveaudetude->appendChild($etablissement);

        /*
         * Generer les formations
         */
        $formationData = generate_random_formations(substr($birth_dayData, 6));
        if($formationData[4] > 0){
            $formation = $xml->createElement("formations_supplémentaires");
            $formation = $candidature->appendChild($formation);

            for($i = 0; $i < $formationData[4]; $i++){
                $formationA = $xml->createElement("formation");
                $formationA = $formation->appendChild($formationA);
                $certificat = $xml->createElement("certificat", $formationData[$i]['certificat']);
                $certificat = $formationA->appendChild($certificat);
                $specialite = $xml->createElement("spécialité", $formationData[$i]['specialite']);
                $specialite = $formationA->appendChild($specialite);
                $annee = $xml->createElement("annee", $formationData[$i]['annee']);
                $annee = $formationA->appendChild($annee);
                $etablissmenet = $xml->createElement("etablissmenet", $formationData[$i]['etablissmenet']);
                $etablissmenet = $formationA->appendChild($etablissmenet);
            }
        }

        /*
         * Generer les experiences
         */
        $experienceData = generate_random_experiences(substr($birth_dayData, 6));
        if($experienceData[5] > 0){
            $experience = $xml->createElement("experiences_proffessionnelles");
            $experience = $candidature->appendChild($experience);

            for($i = 0; $i < $experienceData[5]; $i++){
                $experienceA = $xml->createElement("experience");
                $experienceA = $experience->appendChild($experienceA);
                $de = $xml->createElement("de", $experienceData[$i]['de']);
                $de = $experienceA->appendChild($de);
                $a = $xml->createElement("a", $experienceData[$i]['a']);
                $a = $experienceA->appendChild($a);
                $poste = $xml->createElement("poste", $experienceData[$i]['poste']);
                $poste = $experienceA->appendChild($poste);
                $organisme = $xml->createElement("organisme", $experienceData[$i]['organisme']);
                $organisme = $experienceA->appendChild($organisme);
            }
        }

        /*
         * Generer les conditions
         */
        $conditionData = generate_random_conditions();
        $condition = $xml->createElement("conditions_de_travail");
        $condition = $candidature->appendChild($condition);

        $lieu_premier = $xml->createElement("Lieu_daffectation_souhaité_premier_choix", $conditionData['lieu_premier']);
        $lieu_premier = $condition->appendChild($lieu_premier);
        $lieu_deuxieme = $xml->createElement("Lieu_daffectation_souhaité_deuxieme_choix", $conditionData['lieu_deuxieme']);
        $lieu_deuxieme = $condition->appendChild($lieu_deuxieme);
        $disponibilite = $xml->createElement("Disponibilité", $conditionData['disponibilite']);
        $disponibilite = $condition->appendChild($disponibilite);
        $deplacement = $xml->createElement("Possibilité_deffectuer_des_déplacements", $conditionData['deplacement']);
        $deplacement = $condition->appendChild($deplacement);

        /*
         * Generer les potentiels linguistiques
         */
        $linguistiquesData = generate_random_linguistiques();
        $linguistiques = $xml->createElement("potentiel_linguistiques");
        $linguistiques = $candidature->appendChild($linguistiques);

        $arabe = $xml->createElement("Langue_arabe");
        $arabe = $linguistiques->appendChild($arabe);
        $arabe_ecrit = $xml->createElement("Ecrit", $linguistiquesData['arabe_ecrit']);
        $arabe_ecrit = $arabe->appendChild($arabe_ecrit);
        $arabe_parle = $xml->createElement("Parlé", $linguistiquesData['arabe_parle']);
        $arabe_parle = $arabe->appendChild($arabe_parle);

        $française = $xml->createElement("Langue_française");
        $française = $linguistiques->appendChild($française);
        $française_ecrit = $xml->createElement("Ecrit", $linguistiquesData['française_ecrit']);
        $française_ecrit = $française->appendChild($française_ecrit);
        $française_parle = $xml->createElement("Parlé", $linguistiquesData['française_parle']);
        $française_parle = $française->appendChild($française_parle);

        $anglaise = $xml->createElement("Langue_anglaise");
        $anglaise = $linguistiques->appendChild($anglaise);
        $anglaise_ecrit = $xml->createElement("Ecrit", $linguistiquesData['anglaise_ecrit']);
        $anglaise_ecrit = $anglaise->appendChild($anglaise_ecrit);
        $anglaise_parle = $xml->createElement("Parlé", $linguistiquesData['anglaise_parle']);
        $anglaise_parle = $anglaise->appendChild($anglaise_parle);

        /*
         * Generer les connaissances
         */
        $connaissancesData = generate_random_connaissances();
        if($connaissancesData[1] > 0){
            $connaissances = $xml->createElement("connaissances_acquises", $connaissancesData[0]);
            $connaissances = $candidature->appendChild($connaissances);
        }
    }

    $xml->FormatOutput = true;
    $string_value = $xml->saveXML();
    if(!is_dir('XML'))
        mkdir('XML', 0700);
    $fileName = "XML\\" . $cvsQuantity . "_cv_" . time() . ".xml";
    $xml->save($fileName);

    echo "Les cvs sont generer avec succes";
    header("refresh:3, url=" . $fileName);

} else {
    echo "Vous devez venir ici en saisissant la form dans la page d'accueil<br><br>Vous allez etre rediger vers cette page...<br>
Si ça prendre bcp de temps clickez sur le lien <a href='index.php'>Accueil</a> ";
    header("refresh:5,url=index.php");
}
