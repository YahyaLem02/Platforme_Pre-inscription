<div class="mb-3">
        <label for="choixFiliere" class="form-label">Choisissez une filière :</label>
        <select name="choixFiliere1" id="choixFiliere1" class="form-select choixFiliere">
        <option value=""
                                                                data-translate="Choisissez une option">Choisissez une
                                                                option</option>
                                                            <?php
                                                            $xmlFile = '../xml/BaseXml.xml';
                                                            $xml = simplexml_load_file($xmlFile);
                                                            
                                                            if ($xml !== false) {
                                                                $candidat = $xml->xpath("//candidat[@Utilisateur='" . $_SESSION['cin'] . "']/Diplome/@filiereDiplome");
                                                            
                                                                if (!empty($candidat)) {
                                                                    $idFS = (string) $candidat[0];
                                                                    $filiereSouhaite = $xml->xpath("//FiliereDiplome[@idFiliere='$idFS']/@filliereSouhaitee");
                                                            
                                                                    if (!empty($filiereSouhaite)) {
                                                                        $filiereSouhaite = (string) $filiereSouhaite[0];
                                                                        $filiereSouhaiteList = $xml->xpath("//FiliereSouhaite[@lang='" . $_SESSION['lang'] . "' and @idFiliere='$filiereSouhaite']/intituleFiliere");
                                                            
                                                                        if (!empty($filiereSouhaiteList)) {
                                                                            foreach ($filiereSouhaiteList as $filiere) {
                                                                                echo '<option value="' . $filiere . '">' . $filiere . '</option>';
                                                                            }
                                                                        } else {
                                                                            echo '<option value="">Aucune filière trouvée</option>';
                                                                        }
                                                                    } else {
                                                                        echo '<option value="">Filière souhaitée non trouvée</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Filière du candidat non trouvée</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">Impossible de charger le fichier XML</option>';
                                                            }
                                                            ?>        </select>
    </div>

    <!-- Menu déroulant 2 -->
    <div class="mb-3">
        <label for="choice2" class="form-label">Choix 2</label>
        <select name="choixFiliere2" id="choixFiliere2" class="form-select choixFiliere">
<option value=""
                                                                data-translate="Choisissez une option">Choisissez une
                                                                option</option>
                                                            <?php
                                                            $xmlFile = '../xml/BaseXml.xml';
                                                            $xml = simplexml_load_file($xmlFile);
                                                            
                                                            if ($xml !== false) {
                                                                $filiereSouhaiteList = $xml->xpath("//FiliereSouhaite[@lang='" . $_SESSION['lang'] . "']/intituleFiliere");
                                                            
                                                                if (!empty($filiereSouhaiteList)) {
                                                                    foreach ($filiereSouhaiteList as $filiere) {
                                                                        echo '<option value="' . $filiere . '">' . $filiere . '</option>';
                                                                    }
                                                                } else {
                                                                    echo '<option value="">Aucune filière trouvée</option>';
                                                                }
                                                            } else {
                                                                echo '<option value="">Impossible de charger le fichier XML</option>';
                                                            }
                                                            ?>        </select>
    </div>

    <!-- Menu déroulant 3 -->
    <div class="mb-3">
        <label for="choice3" class="form-label">Choix 3</label>
        <select name="choixFiliere3" id="choixFiliere3" class="form-select choixFiliere">
            <!-- Options -->
        </select>
    </div>