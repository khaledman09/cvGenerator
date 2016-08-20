<?php
/*
 *  NAMES
 */
$male = "Barakah Benayoun Bari Zerhouni Uthman Nasri Yasir Habib Aram Boutella Myron Zabana Rahimat Harrachi Zakiyah Aruj Rami Madjer Mustafa Didouche Najjar Youcef Mahomet Fahas Fathi Chouikh Ibrahim Messaoudi Tahar Benzema Aram Beghal Zahi Zeroual Jahara Massi Allah Didouche Coman Belounis Kamaal Youcef Khalif Zakaria Nasim Tarik Nabil Atlan Eyad Laroussi Qadim Boudjedra Hashim Belloumi Mahomet Benzema Azhaire Djermouni Fouad Ammar Habib Azoulay Abel Arkour Tahar Brahimi Kharim Aym Aziz Sahnoun Nadir Chabani Tareec Ramdane Qabil Fellag Azzam Fergani Ahron Khelfaoui Eyad Bacri Barakah Aboulker Saleem Bitat Rahul Ayache Sofiane Benayoun Yacoub Massi Kamel Ressam Tareq Saadi Walid Skandrani Anissa Zekkal Kalb Hadj Malik Ziani Ibrahim Bouamama Zahi Yacine Nibal Menouar Yardan Saadi Sami Zeroual Yanis Massi Sarni Hanoune Hamal Mami Yasin Hamina Sahir Doumaz Zahi Khadra Ghassan Ziani Kalid Djebar Hamden Feraoun Jabir Litim Latif Menouar Altair Seghir Alva Bacri Saleem Boudjedra Alawi Benita Rauf Fahas Rahul Tannoudji Rashad Djaballah Mahomet Belounis Kalid Mekhloufi Najee Bouamama Mustafa Halimi Tarafah Sidi Yanis Alloula Rafiq Djaout Feroz Ramdane Faris Boudjedra Bilal Benita Yousef Feraoun Najjar Aruj Hamal Kermali Alawi Zeroual Ghassan Chaou Saddam Behired Baqer Chabani Arpiar Benzema Umar Hadj Hachemi Youcef Najee Hasni Ameer Ayache Yanis Didouche Kaeleb Bacri Jahara Belghoul Ebrahim Harrachi Rashaad Salem Reyhan Aboulker Tahar Amirouche Burhan Zidane Tarafah Attali Gaspar Amrani Naif Derrida Mostafa Wadoud Lounes Didouche Basim Khadra Sak Fahas Mustafa Bouteflika Kadin Benguigui Hannan Azoulay Malik Zerhouni Kahill Benlabed Zafar Hanin Hafiz Madjer Hakim Saadi";
$female = "Safa Mammeri Aiesha Aboulker Alhena Taha Tameka Arkour Zalika Hamou Qistina Boudiaf Hadil Madani Rana Bensoussan Ziazan Djaballah Karyan Tifour Jazmynn Boutella Sadira Salhi Mahala Azoulay Rayya Benayoun Gazala Menouar Mimi Lakhdar Jehan Kouiret Fadila Amirouche Zayn Partyka Naida Bensoussan Safiwah Nahnah Maleka Derrida Fayza Chaou Malika Benita Zahirah Didouche Hadya Ramdane Naf Rimitti Altaira Habib Farhana Aboulker Atiya Lakhdar Melek Taha Atia Fellag Sarah Ksentini Asima Hanoune Fayza Sidi Asia Bouchiba Rana Salhi Jamelia Rimitti Qitarah Messaoudi Ismahane Mammeri Samia Azoulay Alimaia Tifour Meriem Allouache Bahira Attali Nuray Slimani Maysa Sadi Azra Bensoussan Selima Benchabla Zubaida Fellag Aida Kerbouche Gazala Gamouh Hana Brahimi Noya Benlabed Adara Tannoudji Fatina Chouikh Rahi Belghoul Melek Amrouche Zuleyka Kouiret Amirah Amrani Maya Youcef Naida Kateb Zafina Benlabed Meriem Madjer Fareeda Alloula Asima Zakaria Fairuza Bensoussan Khadijah Kerbouche Salimah Benida Jazmynn Amrani Nina Belounis Salome Brahimi Rowa Fergani Adalia Alloula Nedaa Nahnah Sabiya Bouali Thara Khelfaoui Selima Kateb Fatina Hanin Adara Sadi Ismahane Belkacem";
// to add more names go to http://fantasynamegenerators.com/algerian-names.php , and then add the male names to the $male variable and the female names to the $female variables
$males = explode(" ", $male);
$females = explode(" ", $female);

function generate_male_name(){
    global $males;
    $randomNumber = rand(0, sizeof($males) - 1);
    if($randomNumber % 2 != 0)
        $randomNumber--;

    $data = [
        'firstName' => $males[$randomNumber],
        'lastName' => $males[$randomNumber + 1],
        'gender' => 'Homme'
    ];

    return $data;
}

function generate_female_name(){
    global $females;
    $randomNumber = rand(0, sizeof($females) - 1);
    if($randomNumber % 2 != 0)
        $randomNumber--;

    $data = [
        'firstName' => $females[$randomNumber],
        'lastName' => $females[$randomNumber + 1],
        'gender' => 'Femme'
    ];

    return $data;
}

function generate_random_name(){
    global $males, $females;
    $randomNumber = rand(1, 2);
    if($randomNumber == 1)
        return generate_male_name($males);
    else
        return generate_female_name($females);
}

/*
 * Date de naissance
 */

function generate_random_birth_day(){
    $day = rand(1, 28);
    if($day < 10)
        $day = "0" . $day;
    $month = rand(1, 12);
    if($month < 10)
        $month = "0" . $month;
    return $day . "/" . $month . "/" . rand(1960, 1991);
}

include 'algeriaJSON.php';
$algeriaData = json_decode($algeria, true);

function generate_random_address(){
    global $algeriaData;
    $randomWilayaID = rand(1, 48);
    if($randomWilayaID < 10)
        $randomWilayaID = "0" . $randomWilayaID;
    $randomWilaya = $algeriaData[$randomWilayaID];
    $randomCommuneID = array_keys($randomWilaya["Communes"])[rand(0, sizeof($randomWilaya["Communes"]) - 1)];
    $randomCommune = $randomWilaya["Communes"][$randomCommuneID];
    $data = [
        'wilaya' => $randomWilaya["Nom"],
        'commune' => $randomCommune,
        'adresse' => "Cité " . rand(1, 5) . "00 logts, batiment " . rand(1,30) . " num " . rand(1, 10),
        'code_postal' => $randomCommuneID
    ];

    return $data;
}

function generate_random_service_national(){
    $service_national = ["Néant", "Accompli", "Sursitaire", "Report d'incorporation", "Dispensé"];
    return $service_national[rand(0, sizeof($service_national) -1)];
}

function generate_random_telephone(){
    return "0" . rand(2, 4) . rand(0, 9) . rand(100000, 999999);
}

function generate_random_mobile(){
    return "0" . rand(5, 7) . rand(4, 9) . rand(1000000, 9999999);
}

$email_providers = ["@gmail.com", "@hotmail.fr", "@hotmail.com", "@outlook.com", "@outlook.fr", "@live.com", "@live.fr", "@aol.com", "@mail.com"];
function generate_random_email($name){
    global $email_providers;
    return $name . rand(100, 999) . $email_providers[rand(0, sizeof($email_providers) - 1)];
}


function generate_random_niveau_etudes($birthYear){
    $diplome = ["CAP1", "CAP2", "BAC", "Technicien", "TS", "DEUA", "Licence", "CAPA", "Ingénieur", "Medecin", "DES", "Master", "Doctorat", "Autres"];
    $niveau = ["Primaire", "CEM", "Lycée", "Terminal", "BAC+1", "BAC+2", "BAC+3", "BAC+4", "BAC+5", "BAC+6"];
    $specialite = ["Mathématiques et Informatique", "Science de la Matière", "Sciences et Technologie", "Science de la Nature et de la Vie", "Science de la Terre et de l’Univers"];
    $etablissement = "ABCDEFGHIGLMNORST";
    $data = [
        'diplome' => $diplome[rand(0, sizeof($diplome) - 1)],
        'niveau' => $niveau[rand(0, sizeof($niveau) - 1)],
        'annee' => rand($birthYear + 16, 2016),
        'specialite' => $specialite[rand(0, sizeof($specialite) - 1)],
        'etablissement' => "U" . $etablissement[rand(0, 16)] . $etablissement[rand(0, 16)] . $etablissement[rand(0, 16)]
    ];
    return $data;
}

function generate_random_formations($birthYear){
    $randomString = "ABCDEFGHIGLMNORST";
    $specialite = ["Mathématiques et Informatique", "Science de la Matière", "Sciences et Technologie", "Science de la Nature et de la Vie", "Science de la Terre et de l’Univers"];
    $nombreDeFormations = rand(0, 3);
    $data[4] = $nombreDeFormations;
    for($i = 0; $i < $nombreDeFormations; $i++){
        $data[$i]["certificat"] = $randomString[rand(0, 16)] . $randomString[rand(0, 16)] . $randomString[rand(0, 16)];
        $data[$i]["specialite"] = $specialite[rand(0, sizeof($specialite) - 1)];
        $data[$i]["annee"] = rand($birthYear + 16, 2016);
        $data[$i]["etablissmenet"] = "U" . $randomString[rand(0, 16)] . $randomString[rand(0, 16)] . $randomString[rand(0, 16)];
    }
    return $data;
}

function generate_random_experiences($birthYear){
    $postes = ["Manager", "Technicien", "Stagier", "HR", "Comptable", "Directeur", "Chef de service", "Autre"];
    $randomString = "ABCDEFGHIGLMNORST";
    $nombreDeJobs = rand(0, 4);
    $data[5] = $nombreDeJobs;
    $randomDeYear = $birthYear + 16;
    for($i = 0; $i < $nombreDeJobs; $i++){
        $randomDeYear = rand($randomDeYear, 2015);
        $data[$i]["de"] = rand(1, 12) . "/" . $randomDeYear;
        $randomAYear = rand($randomDeYear + 1, 2016);
        $data[$i]["a"] = rand(1, 12) . "/" . $randomAYear;
        $data[$i]["poste"] = $postes[rand(0, sizeof($postes) - 1)];
        $data[$i]["organisme"] = $randomString[rand(0, 16)] . $randomString[rand(0, 16)] . $randomString[rand(0, 16)];
        $randomDeYear = $randomAYear + 1;
        if($randomDeYear >= 2016){
            $data[5] = $i + 1;
            return $data;
        }
    }
    return $data;
}

function generate_random_conditions(){
    $lieu = ["Alger", "Hassi Messaoud", "Hassi Rmel", "Arzew", "Skikda"];
    $dispo = ["Immédiate", "Dans 1 semaine", "Dans 15 jours", "Dans 1 mois", "Dans 2 mois", "Dans 3 mois"];
    $deplacement = ["Oui", "Non"];

    $data = [
        "lieu_premier" => $lieu[rand(0, sizeof($lieu) -1)],
        "lieu_deuxieme" => $lieu[rand(0, sizeof($lieu) -1)],
        "disponibilite" => $dispo[rand(0, sizeof($dispo) -1)],
        "deplacement" => $deplacement[rand(0, 1)],
    ];
    return $data;
}

function generate_random_linguistiques(){
    $niveau = ["Faible", "Moyen", "Bien", "Excelent"];

    $data = [
        "arabe_ecrit" => $niveau[rand(0, 3)],
        "arabe_parle" => $niveau[rand(0, 3)],
        "française_ecrit" => $niveau[rand(0, 3)],
        "française_parle" => $niveau[rand(0, 3)],
        "anglaise_ecrit" => $niveau[rand(0, 3)],
        "anglaise_parle" => $niveau[rand(0, 3)],
    ];
    return $data;
}

function generate_random_connaissances(){
    $nombreCon = rand(0, 5);
    $data[1] = $nombreCon;
    $data[0]= "";
    for($i = 0; $i < $nombreCon; $i++){
        $data[0] .= "Connaissance " . ($i + 1) . "\n";
    }
    return $data;
}