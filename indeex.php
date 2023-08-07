<!-- Assurez-vous d'inclure la bibliothèque jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Votre code HTML -->
<form id="annonceForm" method="POST">
  <label for="motif">Déposer une annonce</label>
  <select id="motifSelect">
    <option value="car">Voiture</option>
    <option value="estate">Immobilier</option>
    <option value="clothing">Vêtement</option>
  </select>
</form>

<!-- Ajoutez un bouton pour charger le module -->
<button id="loadModuleBtn" onclick="loadModule()">Charger le module</button>

<!-- Élément pour afficher le contenu du module chargé -->
<div id="moduleContainer"></div>

<!-- Votre script JavaScript -->
<script>
  function loadModule() {
    var selectedOption = $('#motifSelect').val();
    var moduleUrl = '';

    switch (selectedOption) {
      case 'car':
        moduleUrl = 'vendre-voiture.php';
        break;
      case 'estate':
        moduleUrl = 'vendre-immobilier.php'; // Remplacez fetchestate.php par le nom de votre fichier correspondant pour l'immobilier
        break;
      case 'clothing':
        moduleUrl = 'vendre-vetement.php'; // Remplacez fetchclothing.php par le nom de votre fichier correspondant pour les vêtements
        break;
      default:
        // Gérer le cas où aucune option n'est sélectionnée ou aucune correspondance n'est trouvée
        return;
    }

    // Charger le module correspondant en utilisant AJAX avec jQuery
    $.ajax({
      url: moduleUrl,
      type: 'GET',
      dataType: 'html',
      success: function (data) {
        // Insérer le contenu du module dans l'élément avec l'ID "moduleContainer"
        $('#moduleContainer').html(data);

        // Cacher le formulaire et le bouton une fois que le module est chargé
        $('#annonceForm').hide();
        $('#loadModuleBtn').hide();
      },
      error: function (xhr, status, error) {
        // Gérer les erreurs de chargement du module
        console.error('Erreur lors du chargement du module : ', error);
      }
    });
  }
</script>
